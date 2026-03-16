<?php
require_once "includes/autoload.php";
require_once "includes/UpdateManager.php";

class MockUpdateManager extends UpdateManager {
    public $mockGithubResponse = null;
    public $mockRawFileResponse = null;

    protected function fetchFromGitHub($url) {
        return $this->mockGithubResponse;
    }

    protected function fetchRawFile($url) {
        return $this->mockRawFileResponse;
    }
}

echo "Testing UpdateManager::checkForUpdates()...\n";

$passed = 0;
$failed = 0;

function assertResult($name, $expected, $actual) {
    global $passed, $failed;
    // For arrays, we just check if key values match
    $isMatch = true;
    foreach ($expected as $k => $v) {
        if (!isset($actual[$k]) || $actual[$k] !== $v) {
            $isMatch = false;
            break;
        }
    }

    if ($isMatch) {
        echo "✅ PASS: $name\n";
        $passed++;
    } else {
        echo "❌ FAIL: $name\n";
        echo "   Expected subset: " . json_encode($expected) . "\n";
        echo "   Actual: " . json_encode($actual) . "\n";
        $failed++;
    }
}

// Ensure a base app version for tests
if (!defined('APP_VERSION')) {
    define('APP_VERSION', '3.0.0');
}

// Test 1: GitHub API returns a newer version
$manager1 = new MockUpdateManager();
$manager1->mockGithubResponse = [
    'tag_name' => 'v3.1.0',
    'body' => 'Release notes',
    'assets' => [
        ['name' => 'update.zip', 'browser_download_url' => 'http://example.com/update.zip']
    ]
];
$result1 = $manager1->checkForUpdates();
assertResult("Newer version via GitHub API", [
    'available' => true,
    'latest_version' => '3.1.0'
], $result1);

// Test 2: GitHub API returns an older/same version
$manager2 = new MockUpdateManager();
$manager2->mockGithubResponse = [
    'tag_name' => 'v3.0.0', // Same as APP_VERSION
    'body' => 'Release notes',
    'assets' => []
];
$result2 = $manager2->checkForUpdates();
assertResult("Same version via GitHub API", [
    'available' => false,
    'latest_version' => '3.0.0'
], $result2);

// Test 3: GitHub API fails, falls back to VERSION file (newer version)
$manager3 = new MockUpdateManager();
$manager3->mockGithubResponse = false; // Simulate API failure
$manager3->mockRawFileResponse = '3.2.0';
$result3 = $manager3->checkForUpdates();
assertResult("Fallback to VERSION file (newer version)", [
    'available' => true,
    'latest_version' => '3.2.0'
], $result3);

// Test 4: Current version is a dev build
// We temporarily override the getAppVersion function logic if we can,
// but since the code uses function_exists('getAppVersion'), we can define it if it doesn't exist,
// or we can mock getAppVersion if it doesn't exist.
if (!function_exists('getAppVersion')) {
    function getAppVersion() {
        global $mockAppVersion;
        return $mockAppVersion ?: APP_VERSION;
    }
}

$mockAppVersion = 'dev-main';
$manager4 = new MockUpdateManager();
$manager4->mockGithubResponse = [
    'tag_name' => 'v3.1.0',
    'body' => 'Release notes',
    'assets' => []
];
$result4 = $manager4->checkForUpdates();
assertResult("Dev build skips update", [
    'available' => false,
    'dev_version' => true
], $result4);

echo "\nSummary: $passed passed, $failed failed.\n";
if ($failed > 0) {
    exit(1);
}
