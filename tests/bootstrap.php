<?php
// PHPUnit bootstrap file

// Set up a temporary directory for Laragon root
$GLOBALS['testLaragonRoot'] = sys_get_temp_dir() . '/laragon_test_' . uniqid();
mkdir($GLOBALS['testLaragonRoot'] . '/www', 0777, true);

// Create fake composer script
$composerMock = __DIR__ . '/bin/composer';
file_put_contents($composerMock, "#!/bin/bash\n" .
    "echo \"Mock composer executed with: \$@\"\n" .
    "if [[ \"\$1\" == \"create-project\" && \"\$2\" == \"laravel/laravel\" ]]; then\n" .
    "    mkdir -p \"\$3\"\n" .
    "fi\n"
);
chmod($composerMock, 0755);

// Add tests/bin to PATH so exec() can find our mock commands
putenv('PATH=' . __DIR__ . '/bin:' . getenv('PATH'));

// Override getLaragonRoot before requiring helpers
if (!function_exists('getLaragonRoot')) {
    function getLaragonRoot() {
        return $GLOBALS['testLaragonRoot'];
    }
}

// Require the helpers file
require_once __DIR__ . '/../includes/helpers.php';
