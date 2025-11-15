<?php
/**
 * Application: Laragon | Stack Version Management API
 * Description: Handles PHP/MySQL/Apache version management
 * Version: 2.6.0
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json');

if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        echo json_encode(getStackVersions());
        break;
    case 'switch':
        $type = $_POST['type'] ?? '';
        $version = $_POST['version'] ?? '';
        echo json_encode(switchStackVersion($type, $version));
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function getStackVersions() {
    $laragonRoot = getLaragonRoot();
    
    return [
        'success' => true,
        'current' => [
            'php' => phpversion(),
            'apache' => getApacheVersion(),
            'mysql' => getSQLVersion()
        ],
        'available' => [
            'php' => getAvailablePHPVersions($laragonRoot),
            'apache' => getAvailableApacheVersions($laragonRoot),
            'mysql' => getAvailableMySQLVersions($laragonRoot)
        ]
    ];
}

function getAvailablePHPVersions($laragonRoot) {
    $phpDir = $laragonRoot . '/bin/php';
    $versions = [];
    
    if (is_dir($phpDir)) {
        $dirs = scandir($phpDir);
        foreach ($dirs as $dir) {
            if ($dir !== '.' && $dir !== '..' && is_dir($phpDir . '/' . $dir)) {
                $versions[] = $dir;
            }
        }
    }
    
    return $versions;
}

function getAvailableApacheVersions($laragonRoot) {
    $apacheDir = $laragonRoot . '/bin/apache';
    $versions = [];
    
    if (is_dir($apacheDir)) {
        $dirs = scandir($apacheDir);
        foreach ($dirs as $dir) {
            if ($dir !== '.' && $dir !== '..' && is_dir($apacheDir . '/' . $dir)) {
                $versions[] = $dir;
            }
        }
    }
    
    return $versions;
}

function getAvailableMySQLVersions($laragonRoot) {
    $mysqlDir = $laragonRoot . '/bin/mysql';
    $versions = [];
    
    if (is_dir($mysqlDir)) {
        $dirs = scandir($mysqlDir);
        foreach ($dirs as $dir) {
            if ($dir !== '.' && $dir !== '..' && is_dir($mysqlDir . '/' . $dir)) {
                $versions[] = $dir;
            }
        }
    }
    
    return $versions;
}

function switchStackVersion($type, $version) {
    // This would require Laragon.exe integration or manual configuration
    // For now, return a message indicating manual configuration needed
    return [
        'success' => false,
        'message' => 'Version switching requires Laragon.exe. Please use Laragon interface to switch versions.'
    ];
}

function getApacheVersion() {
    $output = shell_exec('httpd -v 2>&1');
    if (preg_match('/Apache\/([0-9.]+)/', $output, $matches)) {
        return $matches[1];
    }
    return 'Unknown';
}

