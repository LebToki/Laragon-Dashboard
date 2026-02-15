<?php
/**
 * Laragon Dashboard - Project Progress API
 * Version: 1.0.0
 * Reads project creation logs for real-time progress
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

if (function_exists('check_auth')) {
    check_auth();
}

header('Content-Type: application/json');

$logFile = $_GET['log'] ?? '';

if (empty($logFile)) {
    echo json_encode(['success' => false, 'message' => 'No log file specified']);
    exit;
}

// Security check: only allow logs starting with "create_" and ending with ".log"
if (!preg_match('/^create_[a-zA-Z0-9_-]+\.log$/', $logFile)) {
    echo json_encode(['success' => false, 'message' => 'Invalid log file']);
    exit;
}

$logPath = dirname(__DIR__) . '/logs/' . $logFile;

if (!file_exists($logPath)) {
    echo json_encode(['success' => false, 'message' => 'Log file not found']);
    exit;
}

$content = file_get_contents($logPath);

echo json_encode([
    'success' => true,
    'content' => $content,
    'completed' => (strpos($content, 'Project creation completed successfully!') !== false || strpos($content, 'ERROR:') !== false)
]);
