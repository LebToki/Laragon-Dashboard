<?php
/**
 * Cache Helper for Laragon Dashboard
 * Provides file-based caching for improved performance
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/logger.php';

class CacheHelper {
    private static $cacheDir = null;
    private static $defaultTTL = 300; // 5 minutes
    
    public static function init() {
        if (self::$cacheDir === null) {
            self::$cacheDir = __DIR__ . '/../cache';
            if (!is_dir(self::$cacheDir)) {
                mkdir(self::$cacheDir, 0755, true);
            }
        }
    }
    
    public static function get($key) {
        self::init();
        
        $cacheFile = self::$cacheDir . '/' . md5($key) . '.cache';
        
        if (!file_exists($cacheFile)) {
            return null;
        }
        
        $data = unserialize(file_get_contents($cacheFile));
        
        if ($data['expires'] < time()) {
            unlink($cacheFile);
            return null;
        }
        
        DashboardLogger::debug("Cache hit for key: $key");
        return $data['value'];
    }
    
    public static function set($key, $value, $ttl = null) {
        self::init();
        
        if ($ttl === null) {
            $ttl = self::$defaultTTL;
        }
        
        $cacheFile = self::$cacheDir . '/' . md5($key) . '.cache';
        $data = [
            'value' => $value,
            'expires' => time() + $ttl,
            'created' => time()
        ];
        
        file_put_contents($cacheFile, serialize($data), LOCK_EX);
        DashboardLogger::debug("Cache set for key: $key (TTL: $ttl)");
    }
    
    public static function delete($key) {
        self::init();
        
        $cacheFile = self::$cacheDir . '/' . md5($key) . '.cache';
        
        if (file_exists($cacheFile)) {
            unlink($cacheFile);
            DashboardLogger::debug("Cache deleted for key: $key");
        }
    }
    
    public static function clear() {
        self::init();
        
        $files = glob(self::$cacheDir . '/*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
        
        DashboardLogger::info("Cache cleared");
    }
    
    public static function cleanup() {
        self::init();
        
        $files = glob(self::$cacheDir . '/*.cache');
        $cleaned = 0;
        
        foreach ($files as $file) {
            $data = unserialize(file_get_contents($file));
            if ($data['expires'] < time()) {
                unlink($file);
                $cleaned++;
            }
        }
        
        DashboardLogger::info("Cache cleanup completed", ['cleaned_files' => $cleaned]);
        return $cleaned;
    }
    
    public static function getStats() {
        self::init();
        
        $files = glob(self::$cacheDir . '/*.cache');
        $totalSize = 0;
        $expiredCount = 0;
        $validCount = 0;
        
        foreach ($files as $file) {
            $totalSize += filesize($file);
            $data = unserialize(file_get_contents($file));
            
            if ($data['expires'] < time()) {
                $expiredCount++;
            } else {
                $validCount++;
            }
        }
        
        return [
            'total_files' => count($files),
            'valid_files' => $validCount,
            'expired_files' => $expiredCount,
            'total_size' => $totalSize,
            'total_size_mb' => round($totalSize / 1024 / 1024, 2)
        ];
    }
    
    public static function remember($key, $callback, $ttl = null) {
        $value = self::get($key);
        
        if ($value === null) {
            $value = $callback();
            self::set($key, $value, $ttl);
        }
        
        return $value;
    }
}
?>
