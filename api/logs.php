<?php
/**
 * Laragon Dashboard - Logs API
 * Version: 3.0.0
 * Description: API endpoint for reading log files
 */

// Start output buffering to catch any stray output
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load autoloader 
if (file_exists(__DIR__ . '/../includes/autoload.php')) {
    require_once __DIR__ . '/../includes/autoload.php';
}

// Load configuration
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

// Clear any output that may have been generated
ob_clean();

// Set JSON header before any output
header('Content-Type: application/json');

$action = $_GET['action'] ?? 'read';
$logType = $_GET['type'] ?? '';

if (!defined('LARAGON_ROOT')) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Laragon root not defined']);
    ob_end_flush();
    exit;
}

// Scan for log files in Laragon directory
function scanLogFiles() {
    return \LaragonDashboard\Core\Services\Logs::scan();
}

// Read log file content
function readLogFile($path, $lines = 1000) {
    $result = \LaragonDashboard\Core\Services\Logs::read($path, $lines);
    if ($result === false) {
        return ['success' => false, 'error' => 'Failed to read log file'];
    }
    return array_merge(['success' => true], $result);
}

// Handle requests
try {
    switch ($action) {
        case 'list':
            $logs = scanLogFiles();
            echo json_encode([
                'success' => true,
                'data' => [
                    'logs' => $logs
                ],
                'error' => null
            ]);
            break;
            
        case 'read':
            if (empty($logType)) {
                throw new Exception('Log type required');
            }
            
            $logs = scanLogFiles();
            if (!isset($logs[$logType])) {
                // Try to find by scanning again with updated paths
                $logs = scanLogFiles();
                if (!isset($logs[$logType])) {
                    throw new Exception('Log file not found for type: ' . $logType);
                }
            }
            
            $result = readLogFile($logs[$logType]['path'], $lines);
            ob_clean();
            echo json_encode([
                'success' => $result['success'],
                'data' => $result['success'] ? $result : null,
                'error' => $result['success'] ? null : ($result['error'] ?? 'Unknown error')
            ]);
            break;
            
        case 'clear':
            if (empty($logType)) {
                throw new Exception('Log type required');
            }
            
            $logs = scanLogFiles();
            if (!isset($logs[$logType])) {
                throw new Exception('Log file not found');
            }
            
            $path = $logs[$logType]['path'];
            if (file_put_contents($path, '') === false) {
                throw new Exception('Failed to clear log file');
            }
            
            ob_clean();
            echo json_encode([
                'success' => true,
                'message' => 'Log file cleared successfully'
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
} catch (Error $e) {
    // Handle PHP 7+ errors
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

// End output buffering
ob_end_flush();

