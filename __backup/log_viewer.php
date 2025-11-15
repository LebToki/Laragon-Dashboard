<?php
/**
 * Log Viewer API for Laragon Dashboard
 * Provides log file viewing functionality
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'list_logs';

function getLaragonPath() {
    $possiblePaths = [
        'C:/laragon',
        'D:/laragon',
        'E:/laragon',
        getenv('LARAGON_ROOT') ?: ''
    ];
    
    foreach ($possiblePaths as $path) {
        if (!empty($path) && is_dir($path)) {
            return $path;
        }
    }
    
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    if (strpos($docRoot, 'laragon') !== false) {
        $parts = explode('laragon', $docRoot);
        return $parts[0] . 'laragon';
    }
    
    return 'C:/laragon';
}

function getLogFiles() {
    $laragonPath = getLaragonPath();
    $logs = [];
    
    // Apache logs
    $apacheLogs = [
        $laragonPath . '/bin/apache/httpd-2.4.xx/logs/error.log',
        $laragonPath . '/bin/apache/httpd-2.4.xx/logs/access.log',
        $laragonPath . '/logs/apache_error.log',
        $laragonPath . '/logs/apache_access.log'
    ];
    
    // PHP logs
    $phpLogs = [
        $laragonPath . '/bin/php/php-*/php_error.log',
        ini_get('error_log'),
        __DIR__ . '/logs/dashboard_' . date('Y-m-d') . '.log'
    ];
    
    // MySQL logs
    $mysqlLogs = [
        $laragonPath . '/bin/mysql/mysql-*/data/*.err',
        $laragonPath . '/logs/mysql_error.log'
    ];
    
    // Check Apache logs
    foreach ($apacheLogs as $log) {
        if (file_exists($log)) {
            $logs[] = [
                'name' => basename($log),
                'path' => $log,
                'type' => 'Apache',
                'size' => filesize($log),
                'modified' => filemtime($log)
            ];
        }
    }
    
    // Check PHP logs
    foreach ($phpLogs as $log) {
        if (file_exists($log)) {
            $logs[] = [
                'name' => basename($log),
                'path' => $log,
                'type' => 'PHP',
                'size' => filesize($log),
                'modified' => filemtime($log)
            ];
        }
    }
    
    // Check MySQL logs
    foreach ($mysqlLogs as $log) {
        if (file_exists($log)) {
            $logs[] = [
                'name' => basename($log),
                'path' => $log,
                'type' => 'MySQL',
                'size' => filesize($log),
                'modified' => filemtime($log)
            ];
        }
    }
    
    // Check dashboard logs
    $dashboardLogDir = __DIR__ . '/logs';
    if (is_dir($dashboardLogDir)) {
        $files = glob($dashboardLogDir . '/*.log');
        foreach ($files as $file) {
            $logs[] = [
                'name' => basename($file),
                'path' => $file,
                'type' => 'Dashboard',
                'size' => filesize($file),
                'modified' => filemtime($file)
            ];
        }
    }
    
    return $logs;
}

try {
    switch ($action) {
        case 'list_logs':
            $logs = getLogFiles();
            echo json_encode([
                'success' => true,
                'logs' => $logs
            ]);
            break;
            
        case 'read_log':
            $logPath = $_GET['path'] ?? '';
            $lines = (int)($_GET['lines'] ?? 100);
            
            if (empty($logPath)) {
                throw new Exception('Log path required');
            }
            
            // Security: Only allow reading from specific directories
            $allowedDirs = [
                getLaragonPath(),
                __DIR__ . '/logs',
                ini_get('error_log') ? dirname(ini_get('error_log')) : ''
            ];
            
            $allowed = false;
            foreach ($allowedDirs as $dir) {
                if (!empty($dir) && strpos(realpath($logPath), realpath($dir)) === 0) {
                    $allowed = true;
                    break;
                }
            }
            
            if (!$allowed || !file_exists($logPath)) {
                throw new Exception('Log file not found or access denied');
            }
            
            // Read last N lines
            $content = file_get_contents($logPath);
            $allLines = explode("\n", $content);
            $lastLines = array_slice($allLines, -$lines);
            
            echo json_encode([
                'success' => true,
                'lines' => $lastLines,
                'total_lines' => count($allLines),
                'showing' => count($lastLines)
            ]);
            break;
            
        case 'clear_log':
            $logPath = $_GET['path'] ?? '';
            
            if (empty($logPath)) {
                throw new Exception('Log path required');
            }
            
            // Security check
            $allowedDirs = [
                __DIR__ . '/logs'
            ];
            
            $allowed = false;
            foreach ($allowedDirs as $dir) {
                if (!empty($dir) && strpos(realpath($logPath), realpath($dir)) === 0) {
                    $allowed = true;
                    break;
                }
            }
            
            if (!$allowed || !file_exists($logPath)) {
                throw new Exception('Log file not found or access denied');
            }
            
            file_put_contents($logPath, '');
            DashboardLogger::info("Log cleared: $logPath");
            
            echo json_encode([
                'success' => true,
                'message' => 'Log cleared successfully'
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Log Viewer Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

