<?php

namespace LaragonDashboard\Core\Services;

/**
 * Logs Class
 * Version: 1.0.0
 * Handles log file discovery and reading
 */
class Logs {
    
    /**
     * Scan for available log files
     */
    public static function scan() {
        $laragonRoot = \LaragonDashboard\Core\System::getLaragonRoot();
        $logFiles = [];
        
        // Apache
        $apacheDirs = glob($laragonRoot . '/bin/apache/httpd-*/logs/error.log');
        if (empty($apacheDirs)) {
            // Try explicit version if common pattern fails
            $apacheDirs = glob($laragonRoot . '/bin/apache/httpd-2.4.*/logs/error.log');
        }
        
        $apacheErrorLog = !empty($apacheDirs) ? $apacheDirs[0] : null;
        if ($apacheErrorLog) {
            $logFiles['apache_error'] = [
                'name' => 'Apache Error Log',
                'path' => $apacheErrorLog,
                'icon' => 'devicon-plain:apache',
                'color' => 'danger'
            ];
            $apacheAccessLog = dirname($apacheErrorLog) . '/access.log';
            if (file_exists($apacheAccessLog)) {
                $logFiles['apache_access'] = [
                    'name' => 'Apache Access Log',
                    'path' => $apacheAccessLog,
                    'icon' => 'devicon-plain:apache',
                    'color' => 'primary'
                ];
            }
        }
        
        // PHP
        $phpErrorLog = $laragonRoot . '/tmp/php_errors.log';
        if (!file_exists($phpErrorLog)) {
            // Check in logs folder too
            $phpErrorLog = $laragonRoot . '/logs/php_errors.log';
        }
        
        if (file_exists($phpErrorLog)) {
            $logFiles['php'] = [
                'name' => 'PHP Error Log',
                'path' => $phpErrorLog,
                'icon' => 'file-icons:php',
                'color' => 'purple'
            ];
        } else {
            // Try to find any php_errors.log in tmp or logs
            $tmpLogs = glob($laragonRoot . '/tmp/*.log');
            foreach ($tmpLogs as $log) {
                if (stripos(basename($log), 'php') !== false && stripos(basename($log), 'error') !== false) {
                    $logFiles['php'] = [
                        'name' => 'PHP Error Log',
                        'path' => $log,
                        'icon' => 'file-icons:php',
                        'color' => 'purple'
                    ];
                    break;
                }
            }
        }
        
        // MySQL
        $mysqlPatterns = [
            $laragonRoot . '/data/mysql-*/mysqld.log',
            $laragonRoot . '/data/mysql-*/mysql.log',
            $laragonRoot . '/bin/mysql/mysql-*/data/mysqld.log',
            $laragonRoot . '/data/mysqld.log'
        ];
        
        $mysqlLog = null;
        foreach ($mysqlPatterns as $pattern) {
            $matched = glob($pattern);
            if (!empty($matched)) {
                $mysqlLog = $matched[0];
                break;
            }
        }
        
        if ($mysqlLog) {
            $logFiles['mysql'] = [
                'name' => 'MySQL Log',
                'path' => $mysqlLog,
                'icon' => 'tabler:brand-mysql',
                'color' => 'info'
            ];
        }
        
        return $logFiles;
    }

    /**
     * Read N lines from a log file
     */
    public static function read($path, $lines = 1000) {
        if (!file_exists($path) || !is_readable($path)) {
            return false;
        }

        try {
            $file = new \SplFileObject($path);
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
                'content' => implode("\n", $content),
                'total_lines' => $totalLines,
                'displayed_lines' => count($content),
                'path' => $path
            ];
        } catch (\Exception $e) {
            if (class_exists('\\LaragonDashboard\\Core\\Logger')) {
                \LaragonDashboard\Core\Logger::error("Failed to read log file $path: " . $e->getMessage());
            }
            return false;
        }
    }

    /**
     * Clear a log file
     */
    public static function clear($path) {
        if (file_exists($path) && is_writable($path)) {
            return file_put_contents($path, '') !== false;
        }
        return false;
    }
}
