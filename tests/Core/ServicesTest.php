<?php

namespace LaragonDashboard\Core;

require_once __DIR__ . '/../../includes/autoload.php';

/**
 * We mock shell_exec to avoid actual system calls.
 * Because Services::stop() calls @shell_exec directly, defining shell_exec
 * in the LaragonDashboard\Core namespace allows us to intercept the call.
 */
function shell_exec($cmd) {
    global $mock_shell_exec_output;
    global $mock_shell_exec_cmd;
    $mock_shell_exec_cmd = $cmd;
    return $mock_shell_exec_output;
}

// Global variables to control and inspect our mock
$mock_shell_exec_output = '';
$mock_shell_exec_cmd = '';

echo "Testing Services::stop()\n";
echo str_repeat("-", 40) . "\n";

$failed = false;
$testsRun = 0;
$testsPassed = 0;

function assertResult($expected, $actual, $testName) {
    global $failed, $testsRun, $testsPassed;
    $testsRun++;

    if ($expected === $actual) {
        echo "✅ PASS: {$testName}\n";
        $testsPassed++;
    } else {
        echo "❌ FAIL: {$testName}\n";
        echo "   Expected: " . var_export($expected, true) . "\n";
        echo "   Actual:   " . var_export($actual, true) . "\n";
        $failed = true;
    }
}

// ----------------------------------------------------------------------
// Test 1: Service stopped successfully (happy path)
// ----------------------------------------------------------------------
$mock_shell_exec_output = "The Apache2.4 service was stopped successfully.";
$result = Services::stop('Apache');
assertResult(true, $result, "Test 1 (stopped successfully)");

// ----------------------------------------------------------------------
// Test 2: Service is already stopped (edge case, output contains 'stopped')
// ----------------------------------------------------------------------
$mock_shell_exec_output = "The service is already stopped.";
$result = Services::stop('MySQL');
assertResult(true, $result, "Test 2 (already stopped)");

// ----------------------------------------------------------------------
// Test 3: Failed to stop (error condition, access denied or service not found)
// ----------------------------------------------------------------------
$mock_shell_exec_output = "System error 5 has occurred.\nAccess is denied.";
$result = Services::stop('Nginx');
assertResult(false, $result, "Test 3 (failed to stop)");

// ----------------------------------------------------------------------
// Summary
// ----------------------------------------------------------------------
echo str_repeat("-", 40) . "\n";
echo "Results: {$testsPassed} / {$testsRun} tests passed.\n";

if ($failed) {
    exit(1);
}

exit(0);
