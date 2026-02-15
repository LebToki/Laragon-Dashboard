<?php
/**
 * Laragon Dashboard AI Agent Bridge
 * Provides system context to the AI Agent
 */

require_once '../config.php';
require_once '../includes/helpers.php';

// Ensure autoloader is loaded for Core classes
if (file_exists('../vendor/autoload.php')) {
    require_once '../vendor/autoload.php';
}

header('Content-Type: application/json');

$action = $_GET['action'] ?? 'snapshot';

if ($action === 'snapshot') {
    $snapshot = [
        'os' => PHP_OS,
        'php_version' => PHP_VERSION,
        'laragon_root' => defined('LARAGON_ROOT') ? LARAGON_ROOT : 'Unknown',
        'document_root' => $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown',
        'memory_limit' => ini_get('memory_limit'),
        'extensions' => [
            'pdo_mysql' => extension_loaded('pdo_mysql'),
            'mysqli' => extension_loaded('mysqli'),
            'curl' => extension_loaded('curl'),
            'mbstring' => extension_loaded('mbstring'),
        ],
        'services' => [], // Placeholder for future service status
        'databases' => [], // Placeholder for database count
        'projects' => [], // Placeholder for project count
    ];

    echo json_encode(['success' => true, 'data' => $snapshot]);
    exit;
}

if ($action === 'command') {
    // Phase 3: Action Handlers (Placeholder)
    echo json_encode(['success' => false, 'message' => 'Action handlers are coming soon in v4.1.x']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid action']);
