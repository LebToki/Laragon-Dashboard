<?php

/**
 * Laragon Dashboard - Autoloader
 * Automatically loads classes from the includes/Core directory
 */
spl_autoload_register(function ($class) {
    $prefix = 'LaragonDashboard\\Core\\';
    $base_dir = __DIR__ . '/Core/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
