<?php

namespace LaragonDashboard\Core;

/**
 * System Class
 * Version: 1.0.0
 * Handles Laragon paths, environment detection, and versioning
 */
class System {
    
    /**
     * Get Laragon root directory
     */
    public static function getLaragonRoot() {
        if (getenv('LARAGON_ROOT')) {
            return getenv('LARAGON_ROOT');
        }
        
        $possiblePaths = ['C:/laragon', 'D:/laragon', 'E:/laragon'];
        
        if (isset($_SERVER['DOCUMENT_ROOT'])) {
            $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
            if (stripos($docRoot, '/laragon/www') !== false) {
                $parts = explode('/www', $docRoot);
                return $parts[0];
            }
            if (stripos($docRoot, 'laragon') !== false) {
                // If it contains laragon but not /www, it might be the root or a subdir
                // Backtrack to the main laragon folder
                $parts = explode('laragon', $docRoot);
                return rtrim($parts[0], '/') . '/laragon';
            }
        }
        
        foreach ($possiblePaths as $path) {
            if (is_dir($path)) {
                return $path;
            }
        }
        
        return 'C:/laragon';
    }

    /**
     * Get Laragon sendmail directory
     */
    public static function getSendmailDir() {
        $laragonRoot = self::getLaragonRoot();
        $sendmailPath = $laragonRoot . '/bin/sendmail/output/';
        
        if (!is_dir($sendmailPath)) {
            @mkdir($sendmailPath, 0755, true);
        }
        
        return $sendmailPath;
    }

    /**
     * Get application version
     */
    public static function getAppVersion() {
        $versionFile = dirname(__DIR__, 2) . '/VERSION';
        if (file_exists($versionFile)) {
            $version = trim(file_get_contents($versionFile));
            if (!empty($version)) {
                return $version;
            }
        }
        
        // Git fallback logic (simplified for the class)
        $gitDir = dirname(__DIR__, 2) . '/.git';
        if (is_dir($gitDir)) {
            // ... git logic could be improved here or moved to a Git helper
            return 'dev-git';
        }
        
        return defined('APP_VERSION') ? APP_VERSION : '3.0.0';
    }

    /**
     * Get storage/disk information
     */
    public static function getDiskInfo($path = null) {
        if (!$path) {
            $path = self::getLaragonRoot();
        }
        
        $total = disk_total_space($path);
        $free = disk_free_space($path);
        $used = $total - $free;
        $percent = $total > 0 ? ($used / $total) * 100 : 0;
        
        return [
            'total' => $total,
            'free' => $free,
            'used' => $used,
            'percent' => round($percent, 2),
            'formatted_total' => self::formatBytes($total),
            'formatted_free' => self::formatBytes($free),
            'formatted_used' => self::formatBytes($used)
        ];
    }

    /**
     * Format bytes to human readable string
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
