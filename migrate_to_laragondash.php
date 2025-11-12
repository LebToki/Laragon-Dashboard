<?php
/**
 * Migration script to reorganize files into LaragonDash folder
 * Run this once to restructure the project
 */

$baseDir = __DIR__;
$laragonDashDir = $baseDir . '/LaragonDash';

// Files to move to LaragonDash
$filesToMove = [
    'assets',
    'includes',
    'logs',
    'tests',
    'config.php',
    'database_manager.php',
    'server_vitals.php',
    'project_search.php',
    'services_manager.php',
    'log_viewer.php',
    'quick_tools.php',
    'bcrypt_generator.php',
    'backup_manager.php',
    'CHANGELOG.md',
    'README.md',
    'production-ready.php',
    'test_dashboard.php'
];

// Create LaragonDash directory
if (!is_dir($laragonDashDir)) {
    mkdir($laragonDashDir, 0755, true);
    echo "Created LaragonDash directory\n";
}

// Move files
foreach ($filesToMove as $file) {
    $source = $baseDir . '/' . $file;
    $dest = $laragonDashDir . '/' . $file;
    
    if (file_exists($source) || is_dir($source)) {
        if (is_dir($source)) {
            // Copy directory recursively
            copyDirectory($source, $dest);
            // Remove original
            deleteDirectory($source);
        } else {
            // Copy file
            copy($source, $dest);
            unlink($source);
        }
        echo "Moved: $file\n";
    }
}

// Create new index.php in LaragonDash
$newIndexContent = file_get_contents($baseDir . '/index.php');
// Update all paths to be relative to LaragonDash
$newIndexContent = str_replace("__DIR__ . '/", "__DIR__ . '/", $newIndexContent);
$newIndexContent = str_replace("'./", "'./", $newIndexContent);
file_put_contents($laragonDashDir . '/index.php', $newIndexContent);

// Create simple root index.php
$rootIndex = <<<'PHP'
<?php
/**
 * Laragon Dashboard - Root Entry Point
 * Version: 2.6.0
 */
if (file_exists(__DIR__ . '/LaragonDash/index.php')) {
    require_once __DIR__ . '/LaragonDash/index.php';
} else {
    die('LaragonDash application not found. Please ensure the LaragonDash folder exists.');
}
PHP;
file_put_contents($baseDir . '/index_new.php', $rootIndex);

echo "\nMigration complete!\n";
echo "Please review index_new.php and replace index.php with it.\n";

function copyDirectory($source, $dest) {
    if (!is_dir($dest)) {
        mkdir($dest, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $destPath = $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            copy($item, $destPath);
        }
    }
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    rmdir($dir);
}

