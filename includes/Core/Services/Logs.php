<?php

namespace LaragonDashboard\Core\Services;

/**
 * Logs Class
 * Version: 4.0.3
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
        $apachePatterns = [
            $laragonRoot . '/bin/apache/httpd-*/logs/error.log',
            $laragonRoot . '/bin/apache/apache-*/logs/error.log',
            $laragonRoot . '/logs/apache_error.log'
        ];
        
        $apacheErrorLog = null;
        foreach ($apachePatterns as $pattern) {
            $matched = glob($pattern);
            if (!empty($matched)) {
                $apacheErrorLog = $matched[0];
                break;
            }
        }

        if ($apacheErrorLog) {
            $logFiles['apache_error'] = [
                'name' => 'Apache Error Log',
                'path' => $apacheErrorLog,
                'icon' => 'solar:server-bold',
                'color' => 'danger'
            ];
            $apacheAccessLog = dirname($apacheErrorLog) . '/access.log';
            if (file_exists($apacheAccessLog)) {
                $logFiles['apache_access'] = [
                    'name' => 'Apache Access Log',
                    'path' => $apacheAccessLog,
                    'icon' => 'solar:server-path-bold',
                    'color' => 'primary'
                ];
            }
        }
        
        // PHP
        $phpPatterns = [
            $laragonRoot . '/tmp/php_errors.log',
            $laragonRoot . '/logs/php_errors.log',
            $laragonRoot . '/bin/php/php-*/php_errors.log',
            dirname(php_ini_loaded_file()) . '/php_errors.log'
        ];

        $phpErrorLog = null;
        foreach ($phpPatterns as $pattern) {
            $matched = glob($pattern);
            if (!empty($matched)) {
                $phpErrorLog = $matched[0];
                break;
            }
        }
        
        if ($phpErrorLog && file_exists($phpErrorLog)) {
            $logFiles['php'] = [
                'name' => 'PHP Error Log',
                'path' => $phpErrorLog,
                'icon' => 'solar:code-bold',
                'color' => 'purple'
            ];
        }

        // MySQL
        $mysqlPatterns = [
            $laragonRoot . '/data/mysql-*/mysqld.log',
            $laragonRoot . '/data/mysql-*/mysql.log',
            $laragonRoot . '/data/mysql-*/error.log',
            $laragonRoot . '/data/mariadb-*/mysqld.log',
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
                'icon' => 'solar:database-bold',
                'color' => 'info'
            ];
        }

        // Project Logs (Dashboard itself)
        $dashboardLog = $laragonRoot . '/www/Laragon-Dashboard/logs/app.log';
        if (file_exists($dashboardLog)) {
            $logFiles['dashboard'] = [
                'name' => 'Dashboard Log',
                'path' => $dashboardLog,
                'icon' => 'solar:scanner-bold',
                'color' => 'success'
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
            $handle = @fopen($path, 'r');
            if (!$handle) {
                return false;
            }

            $fileSize = filesize($path);
            $lines_array = [];
            
            // If file is small, just read everything
            if ($fileSize < 1024 * 512) { // 512KB
                $content_raw = file_get_contents($path);
                $lines_raw = explode("\n", $content_raw);
                $lines_array = array_slice($lines_raw, -$lines);
                $totalLines = count($lines_raw);
            } else {
                // Efficient tail for large files
                $buffer = 4096;
                fseek($handle, 0, SEEK_END);
                $pos = ftell($handle);
                $count = 0;
                $output = '';

                while ($pos > 0 && $count < $lines + 1) {
                    $readSize = min($pos, $buffer);
                    $pos -= $readSize;
                    fseek($handle, $pos);
                    $chunk = fread($handle, $readSize);
                    $output = $chunk . $output;
                    $count = substr_count($output, "\n");
                }

                $lines_raw = explode("\n", $output);
                $lines_array = array_slice($lines_raw, -$lines);
                // Approximate total lines based on average line length (fine for UI)
                $totalLines = (int)($fileSize / 100); 
            }
            
            fclose($handle);
            
            // Clean up lines
            $final_content = implode("\n", array_map(function($l) {
                return rtrim($l, "\r\n");
            }, $lines_array));

            return [
                'content' => $final_content ?: '(Empty log file)',
                'total_lines' => $totalLines,
                'displayed_lines' => count($lines_array),
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
