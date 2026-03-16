<?php
// Simple custom test runner since PHPUnit is not available
$tests = glob('tests/*Test.php');
$passed = 0;
$failed = 0;

class TestCase {
    public function setUp() {}
    public function tearDown() {}
    public function assertTrue($condition, $message = '') {
        if (!$condition) throw new Exception($message ?: 'Failed asserting that condition is true');
    }
    public function assertFalse($condition, $message = '') {
        if ($condition) throw new Exception($message ?: 'Failed asserting that condition is false');
    }
    public function assertEquals($expected, $actual, $message = '') {
        if ($expected !== $actual) throw new Exception($message ?: "Failed asserting that '$actual' matches expected '$expected'");
    }
    public function assertNull($actual, $message = '') {
        if ($actual !== null) throw new Exception($message ?: "Failed asserting that '$actual' is null");
    }
    public function assertNotNull($actual, $message = '') {
        if ($actual === null) throw new Exception($message ?: 'Failed asserting that actual is not null');
    }
}

foreach ($tests as $test) {
    echo "Running $test...\n";
    require_once $test;
    $className = basename($test, '.php');
    if (class_exists($className)) {
        $instance = new $className();
        $methods = get_class_methods($instance);
        foreach ($methods as $method) {
            if (strpos($method, 'test') === 0) {
                try {
                    $instance->setUp();
                    $instance->$method();
                    echo "  [PASS] $method\n";
                    $passed++;
                } catch (Exception $e) {
                    echo "  [FAIL] $method: " . $e->getMessage() . "\n";
                    $failed++;
                } finally {
                    $instance->tearDown();
                }
            }
        }
    }
}

echo "\nTests run: " . ($passed + $failed) . ", Passed: $passed, Failed: $failed\n";
if ($failed > 0) {
    exit(1);
}
