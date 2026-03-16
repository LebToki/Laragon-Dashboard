<?php

// A simple test runner for Router::resolve()

$testFile = __FILE__;

// Helper to run a test in a separate process to catch exits (like handle404/handle401)
function runTestProcess($getParams, $mockAuth = true) {
    global $testFile;

    $getStr = http_build_query($getParams);
    $authFlag = $mockAuth ? '1' : '0';

    // We execute the same script but with a special flag
    $cmd = "php " . escapeshellarg($testFile) . " process_test " . escapeshellarg($getStr) . " " . $authFlag . " 2>&1";

    $output = [];
    $returnVar = 0;
    exec($cmd, $output, $returnVar);

    return [
        'output' => implode("\n", $output),
        'exitCode' => $returnVar
    ];
}

// -----------------------------------------------------------------------------
// This block runs when executed as a subprocess
// -----------------------------------------------------------------------------
if (isset($argv[1]) && $argv[1] === 'process_test') {
    parse_str($argv[2], $_GET);
    $mockAuth = $argv[3] === '1';

    // We need to fake defining APP_ROOT so Router can resolve pagesDir
    if (!defined('APP_ROOT')) {
        define('APP_ROOT', __DIR__ . '/..');
    }

    // We mock missing functions called by layouts
    if (!function_exists('getCSRFToken')) {
        function getCSRFToken() { return 'mock_token'; }
    }
    if (!function_exists('url')) {
        function url($path) { return '/' . ltrim($path, '/'); }
    }
    if (!function_exists('t')) {
        function t($key, $default = '') { return $default ?: $key; }
    }
    if (!function_exists('getSiteConfig')) {
        function getSiteConfig($key, $default = '') { return $default; }
    }
    if (!function_exists('assets')) {
        function assets($path) { return '/assets/' . ltrim($path, '/'); }
    }
    if (!function_exists('is_plugin_active')) {
        function is_plugin_active() { return false; }
    }

    // Create the mock Security class in the right namespace
    $mockClass = '
    namespace LaragonDashboard\Core {
        class Security {
            public static $authenticated = true;
            public static function isAuthenticated() {
                return self::$authenticated;
            }
        }
    }
    ';
    eval($mockClass);

    \LaragonDashboard\Core\Security::$authenticated = $mockAuth;

    require_once __DIR__ . '/../includes/Router.php';

    $router = new Router();

    // Mock testing a route with requires_auth
    $reflection = new ReflectionClass($router);
    $routesProp = $reflection->getProperty('routes');
    $routesProp->setAccessible(true);
    $routes = $routesProp->getValue($router);
    $routes['secure_page'] = [
        'file' => 'dashboard.php', // Assuming this exists or tests fail because it doesn't? No, dashboard is file=>null. Let's use projects.php
        'title' => 'Secure Page',
        'requires_auth' => true,
    ];
    // Create a dummy file or use an existing one to avoid 404 in Route that requires auth
    $routes['secure_page']['file'] = 'projects.php';
    $routesProp->setValue($router, $routes);

    // Start output buffering to catch any output from handle404/handle401
    ob_start();
    try {
        $result = $router->resolve();
        $output = ob_get_clean();

        echo json_encode([
            'result' => $result,
            'output' => $output,
            'currentPage' => $router->getCurrentPage(),
            'currentParams' => $router->getParams()
        ]);
        exit(0);
    } catch (Throwable $e) {
        $output = ob_get_clean();
        // Since handle404 calls exit;, it won't be caught by Throwable.
        // We will just let it exit and capture output.
    }
}

// -----------------------------------------------------------------------------
// The main test runner
// -----------------------------------------------------------------------------
$testsPassed = 0;
$testsFailed = 0;

function assertTest($name, $condition, $message = '') {
    global $testsPassed, $testsFailed;
    if ($condition) {
        echo "✅ PASS: $name\n";
        $testsPassed++;
    } else {
        echo "❌ FAIL: $name\n";
        if ($message) {
            echo "   Reason: $message\n";
        }
        $testsFailed++;
    }
}

echo "Testing Router::resolve()...\n\n";

// Test 1: Empty page defaults to dashboard
$result = runTestProcess([]);
$data = json_decode($result['output'], true);
$passed = ($data !== null && $data['result'] === null && $data['currentPage'] === 'dashboard');
assertTest("Empty page defaults to dashboard", $passed, "Expected result=null, currentPage='dashboard'");

// Test 2: Invalid page characters (triggers 404 because sanitizePageName returns '')
$result = runTestProcess(['page' => 'invalid page!']);
// json_decode fails because handle404 outputs HTML
$data = json_decode($result['output'], true);
$passed = ($data === null && stripos($result['output'], 'Page Not Found') !== false);
assertTest("Invalid characters trigger 404", $passed, "Expected 404 output");

// Test 3: Existing route that requires no auth
$result = runTestProcess(['page' => 'projects']);
$data = json_decode($result['output'], true);
$expectedPath = str_replace('\\', '/', realpath(__DIR__ . '/../pages/projects.php'));
$actualPath = isset($data['result']) ? str_replace('\\', '/', realpath($data['result'])) : '';
$passed = ($data !== null && $actualPath === $expectedPath && $data['currentPage'] === 'projects');
assertTest("Valid route resolves file", $passed, "Expected projects.php path");

// Test 4: Existing route, params are extracted
$result = runTestProcess(['page' => 'mailbox', 'view' => 'read', 'id' => '123']);
$data = json_decode($result['output'], true);
$passed = ($data !== null && isset($data['currentParams']['view']) && $data['currentParams']['view'] === 'read' && isset($data['currentParams']['id']) && $data['currentParams']['id'] === '123');
assertTest("Valid route extracts parameters", $passed, "Expected currentParams view=read, id=123");

// Test 5: Route that requires auth, but unauthenticated
$result = runTestProcess(['page' => 'secure_page'], false);
// handle401 outputs JSON
$passed = (strpos($result['output'], 'Unauthorized') !== false);
assertTest("Route requires auth, blocks unauthenticated", $passed, "Expected Unauthorized JSON response");

// Test 6: Route that requires auth, and authenticated
$result = runTestProcess(['page' => 'secure_page'], true);
$data = json_decode($result['output'], true);
$passed = ($data !== null && isset($data['currentPage']) && $data['currentPage'] === 'secure_page');
assertTest("Route requires auth, allows authenticated", $passed, "Expected route to resolve properly");

// Test 7: Non-existent page (404)
$result = runTestProcess(['page' => 'does_not_exist']);
$data = json_decode($result['output'], true);
$passed = ($data === null && stripos($result['output'], 'Page Not Found') !== false);
assertTest("Non-existent page triggers 404", $passed, "Expected 404 output");

echo "\nTests Completed: $testsPassed Passed, $testsFailed Failed\n";

if ($testsFailed > 0) {
    exit(1);
}
exit(0);
