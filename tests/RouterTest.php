<?php
require_once "includes/autoload.php";
require_once "vendor/autoload.php";
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {
    private $testFile;

    protected function setUp(): void {
        $this->testFile = __FILE__;
    }

    private function runTestProcess($getParams, $mockAuth = true) {
        $getStr = http_build_query($getParams);
        $authFlag = $mockAuth ? '1' : '0';

        $cmd = "php " . escapeshellarg($this->testFile) . " process_test " . escapeshellarg($getStr) . " " . $authFlag . " 2>&1";

        $output = [];
        $returnVar = 0;
        exec($cmd, $output, $returnVar);

        return [
            'output' => implode("\n", $output),
            'exitCode' => $returnVar
        ];
    }

    public function testEmptyPageDefaultsToDashboard() {
        $result = $this->runTestProcess([]);
        $data = json_decode($result['output'], true);
        $this->assertNotNull($data);
        $this->assertNull($data['result']);
        $this->assertEquals('dashboard', $data['currentPage']);
    }

    public function testInvalidPageCharacters() {
        $result = $this->runTestProcess(['page' => 'invalid page!']);
        $this->assertStringContainsString('Page Not Found', $result['output'], "Expected 404 output");
    }

    public function testExistingRouteNoAuth() {
        $result = $this->runTestProcess(['page' => 'projects']);
        $data = json_decode($result['output'], true);
        $expectedPath = str_replace('\\', '/', realpath(__DIR__ . '/../pages/projects.php'));
        $actualPath = isset($data['result']) ? str_replace('\\', '/', realpath($data['result'])) : '';
        $this->assertEquals($expectedPath, $actualPath);
        $this->assertEquals('projects', $data['currentPage']);
    }

    public function testExistingRouteWithParams() {
        $result = $this->runTestProcess(['page' => 'mailbox', 'view' => 'read', 'id' => '123']);
        $data = json_decode($result['output'], true);
        $this->assertNotNull($data);
        $this->assertEquals('read', $data['currentParams']['view']);
        $this->assertEquals('123', $data['currentParams']['id']);
    }

    public function testRouteRequiresAuthUnauthenticated() {
        $result = $this->runTestProcess(['page' => 'secure_page'], false);
        $this->assertStringContainsString('Unauthorized', $result['output']);
    }

    public function testRouteRequiresAuthAuthenticated() {
        $result = $this->runTestProcess(['page' => 'secure_page'], true);
        $data = json_decode($result['output'], true);
        $this->assertNotNull($data);
        $this->assertEquals('secure_page', $data['currentPage']);
    }

    public function testNonExistentPage() {
        $result = $this->runTestProcess(['page' => 'does_not_exist']);
        $this->assertStringContainsString('Page Not Found', $result['output']);
    }
}

// -----------------------------------------------------------------------------
// This block runs when executed as a subprocess
// -----------------------------------------------------------------------------
if (isset($argv[1]) && $argv[1] === 'process_test') {
    parse_str($argv[2], $_GET);
    $mockAuth = $argv[3] === '1';

    if (!defined('APP_ROOT')) {
        define('APP_ROOT', __DIR__ . '/..');
    }

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

    $reflection = new ReflectionClass($router);
    $routesProp = $reflection->getProperty('routes');
    $routesProp->setAccessible(true);
    $routes = $routesProp->getValue($router);
    $routes['secure_page'] = [
        'file' => 'projects.php',
        'title' => 'Secure Page',
        'requires_auth' => true,
    ];
    $routesProp->setValue($router, $routes);

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
        echo "Throwable: " . $e->getMessage() . "\n" . $output;
        exit(1);
    }
}
