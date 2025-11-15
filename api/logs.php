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

// Load configuration
require_once __DIR__ . '/../config.php';

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
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    $logFiles = [];
    
    if (empty($laragonRoot) || !is_dir($laragonRoot)) {
        return $logFiles;
    }
    
    // Find Apache installation directory (dynamic version)
    $apacheDirs = glob($laragonRoot . '/bin/apache/httpd-*/logs/error.log');
    $apacheErrorLog = !empty($apacheDirs) ? $apacheDirs[0] : null;
    $apacheAccessLog = null;
    if ($apacheErrorLog) {
        $apacheAccessLog = dirname($apacheErrorLog) . '/access.log';
        if (!file_exists($apacheAccessLog)) {
            $apacheAccessLog = null;
        }
    }
    
    // Find MySQL installation directory (dynamic version)
    $mysqlDirs = glob($laragonRoot . '/data/mysql-*/mysqld.log');
    $mysqlLog = !empty($mysqlDirs) ? $mysqlDirs[0] : null;
    
    // PHP error log
    $phpErrorLog = $laragonRoot . '/tmp/php_errors.log';
    
    // Define log files with actual paths
    $logPatterns = [
        'apache_error' => [
            'name' => 'Apache Error Log',
            'path' => $apacheErrorLog,
            'icon' => 'devicon-plain:apache',
            'color' => 'danger'
        ],
        'apache_access' => [
            'name' => 'Apache Access Log',
            'path' => $apacheAccessLog,
            'icon' => 'devicon-plain:apache',
            'color' => 'primary'
        ],
        'php' => [
            'name' => 'PHP Error Log',
            'path' => file_exists($phpErrorLog) ? $phpErrorLog : null,
            'icon' => 'file-icons:php',
            'color' => 'purple'
        ],
        'mysql' => [
            'name' => 'MySQL Log',
            'path' => $mysqlLog,
            'icon' => 'tabler:brand-mysql',
            'color' => 'info'
        ]
    ];
    
    // Only add log files that exist
    foreach ($logPatterns as $key => $pattern) {
        if (!empty($pattern['path']) && file_exists($pattern['path']) && is_readable($pattern['path'])) {
            $logFiles[$key] = [
                'name' => $pattern['name'],
                'path' => $pattern['path'],
                'icon' => $pattern['icon'] ?? 'solar:file-text-bold',
                'color' => $pattern['color'] ?? 'secondary'
            ];
        }
    }
    
    return $logFiles;
}

// Read log file content
function readLogFile($path, $lines = 1000) {
    if (!file_exists($path)) {
        return ['success' => false, 'error' => 'Log file not found: ' . $path];
    }
    
    if (!is_readable($path)) {
        return ['success' => false, 'error' => 'Log file is not readable'];
    }
    
    try {
        // Handle download request
        if (isset($_GET['download']) && $_GET['download'] == '1') {
            ob_clean();
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="' . basename($path) . '"');
            readfile($path);
            ob_end_flush();
            exit;
        }
        
        // Read last N lines (more efficient for large files)
        $file = new SplFileObject($path);
        $file->seek(PHP_INT_MAX);
        $totalLines = $file->key() + 1;
        
        $startLine = max(0, $totalLines - $lines);
        $file->seek($startLine);
        
        $content = [];
        while (!$file->eof()) {
            $line = $file->current();
            if ($line !== false) {
                $content[] = rtrim($line, "\r\n");
            }
            $file->next();
        }
        
        return [
            'success' => true,
            'content' => implode("\n", $content),
            'total_lines' => $totalLines,
            'displayed_lines' => count($content),
            'path' => $path
        ];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Handle requests
try {
    switch ($action) {
        case 'list':
            $logs = scanLogFiles();
            echo json_encode([
                'success' => true,
                'logs' => $logs
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
            
            $lines = isset($_GET['lines']) ? intval($_GET['lines']) : 1000;
            $result = readLogFile($logs[$logType]['path'], $lines);
            ob_clean();
            echo json_encode($result);
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

