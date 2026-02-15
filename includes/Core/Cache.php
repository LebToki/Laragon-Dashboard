<?php

namespace LaragonDashboard\Core;

/**
 * Cache Class
 * Version: 1.0.0
 * Provides simple file-based caching
 */
class Cache {
    private static $cacheDir;

    public static function init($dir = null) {
        if ($dir) {
            self::$cacheDir = $dir;
        } else {
            self::$cacheDir = dirname(__DIR__, 2) . '/cache/data';
        }

        if (!is_dir(self::$cacheDir)) {
            @mkdir(self::$cacheDir, 0755, true);
        }
    }

    public static function get($key) {
        if (!self::$cacheDir) self::init();
        $file = self::$cacheDir . '/' . md5($key) . '.json';
        
        if (file_exists($file)) {
            $data = json_decode(file_get_contents($file), true);
            if ($data && isset($data['expires']) && $data['expires'] > time()) {
                return $data['value'];
            }
            @unlink($file);
        }
        return null;
    }

    public static function set($key, $value, $ttl = 300) {
        if (!self::$cacheDir) self::init();
        $file = self::$cacheDir . '/' . md5($key) . '.json';
        
        $data = [
            'expires' => time() + $ttl,
            'value' => $value
        ];
        
        return file_put_contents($file, json_encode($data)) !== false;
    }

    public static function delete($key) {
        if (!self::$cacheDir) self::init();
        $file = self::$cacheDir . '/' . md5($key) . '.json';
        if (file_exists($file)) {
            return @unlink($file);
        }
        return false;
    }

    public static function clear() {
        if (!self::$cacheDir) self::init();
        $files = glob(self::$cacheDir . '/*.json');
        foreach ($files as $file) {
            @unlink($file);
        }
    }
}
