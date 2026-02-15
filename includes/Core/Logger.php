<?php

namespace LaragonDashboard\Core;

/**
 * Logger Class
 * Version: 1.0.0
 * Provides centralized logging functionality
 */
class Logger {
    private static $logFile;

    /**
     * Initialize logger
     */
    public static function init($logFilePath = null) {
        if ($logFilePath) {
            self::$logFile = $logFilePath;
        } else {
            // Default log file
            self::$logFile = dirname(__DIR__, 2) . '/logs/app.log';
        }

        $logDir = dirname(self::$logFile);
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
    }

    /**
     * Log a message
     */
    public static function log($message, $level = 'info') {
        if (!self::$logFile) {
            self::init();
        }

        $timestamp = date('Y-m-d H:i:s');
        $level = strtoupper($level);
        $formattedMessage = "[$timestamp] [$level] $message" . PHP_EOL;

        @file_put_contents(self::$logFile, $formattedMessage, FILE_APPEND);

        // If in debug mode, we might want to also log to system error log or display
        if (defined('APP_DEBUG') && APP_DEBUG) {
            error_log($message);
        }
    }

    public static function info($message) {
        self::log($message, 'info');
    }

    public static function error($message) {
        self::log($message, 'error');
    }

    public static function debug($message) {
        if (defined('APP_DEBUG') && APP_DEBUG) {
            self::log($message, 'debug');
        }
    }
}
