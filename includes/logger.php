<?php
/**
 * Error Handler and Logger for Laragon Dashboard
 * Provides centralized error handling and logging functionality
 */

require_once __DIR__ . '/config.php';

class DashboardLogger {
    private static $logFile = null;
    
    public static function init() {
        if (self::$logFile === null) {
            $logDir = __DIR__ . '/logs';
            if (!is_dir($logDir)) {
                mkdir($logDir, 0755, true);
            }
            self::$logFile = $logDir . '/dashboard_' . date('Y-m-d') . '.log';
        }
    }
    
    public static function log($level, $message, $context = []) {
        self::init();
        
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $logEntry = "[$timestamp] [$level] $message$contextStr" . PHP_EOL;
        
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    public static function error($message, $context = []) {
        self::log('ERROR', $message, $context);
    }
    
    public static function warning($message, $context = []) {
        self::log('WARNING', $message, $context);
    }
    
    public static function info($message, $context = []) {
        self::log('INFO', $message, $context);
    }
    
    public static function debug($message, $context = []) {
        if (APP_DEBUG) {
            self::log('DEBUG', $message, $context);
        }
    }
}

// Set up error handlers
set_error_handler(function($severity, $message, $file, $line) {
    DashboardLogger::error("PHP Error: $message", [
        'file' => $file,
        'line' => $line,
        'severity' => $severity
    ]);
    
    if (APP_DEBUG) {
        echo "<div class='alert alert-danger'>Error: $message in $file on line $line</div>";
    }
});

set_exception_handler(function($exception) {
    DashboardLogger::error("Uncaught Exception: " . $exception->getMessage(), [
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString()
    ]);
    
    if (APP_DEBUG) {
        echo "<div class='alert alert-danger'>Exception: " . $exception->getMessage() . "</div>";
    } else {
        echo "<div class='alert alert-danger'>An error occurred. Please try again later.</div>";
    }
});

// Log dashboard access
DashboardLogger::info("Dashboard accessed", [
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    'request_uri' => $_SERVER['REQUEST_URI'] ?? 'unknown'
]);
?>
