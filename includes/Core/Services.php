<?php

namespace LaragonDashboard\Core;

/**
 * Services Class
 * Version: 1.1.0
 * Handles service management (Apache, MySQL, etc.) and resource monitoring
 */
class Services {
    
    // Service name mapping
    private static $serviceMap = [
        'Apache' => 'Apache2.4',
        'MySQL' => 'MySQL',
        'PostgreSQL' => 'postgresql',
        'Nginx' => 'nginx',
        'Redis' => 'Redis',
        'Memcached' => 'memcached',
        'MongoDB' => 'MongoDB',
        'Mailpit' => 'Mailpit'
    ];

    /**
     * Get real service name
     */
    public static function getRealName($name) {
        return self::$serviceMap[$name] ?? $name;
    }

    /**
     * Check if a service is running
     */
    public static function isRunning($name) {
        $realName = self::getRealName($name);
        $output = @shell_exec('sc query "' . $realName . '" 2>&1');
        return $output && stripos($output, 'RUNNING') !== false;
    }

    /**
     * Start a service
     */
    public static function start($name) {
        $realName = self::getRealName($name);
        $output = @shell_exec('net start "' . $realName . '" 2>&1');
        return strpos($output, 'was started successfully') !== false || strpos($output, 'running') !== false;
    }

    /**
     * Stop a service
     */
    public static function stop($name) {
        $realName = self::getRealName($name);
        $output = @shell_exec('net stop "' . $realName . '" 2>&1');
        return strpos($output, 'was stopped successfully') !== false || strpos($output, 'stopped') !== false;
    }

    /**
     * Check if a port is in use
     */
    public static function isPortInUse($port) {
        $port = intval($port);
        $output = @shell_exec('netstat -an | findstr :' . $port . ' 2>&1');
        return !empty(trim($output));
    }

    /**
     * Get resource usage for a service (Windows)
     */
    public static function getResourceUsage($name) {
        $realName = self::getRealName($name);
        
        // Find PID
        $output = @shell_exec('tasklist /FI "SERVICES eq ' . $realName . '" /FO CSV /NH 2>&1');
        if (empty($output) || strpos($output, 'No tasks') !== false) {
            return ['cpu' => 0, 'ram' => 0, 'pid' => 0];
        }

        // Parse CSV output
        $data = str_getcsv($output);
        if (count($data) < 5) return ['cpu' => 0, 'ram' => 0, 'pid' => 0];

        $pid = intval($data[1]);
        $ramRaw = $data[4]; // e.g. "12,345 K"
        $ram = floatval(str_replace([',', ' ', 'K'], '', $ramRaw)) / 1024; // MB

        // For CPU, we use wmic fallback or 0
        $cpu = 0;
        $cpuOutput = @shell_exec('wmic process where ProcessId=' . $pid . ' get PercentProcessorTime /value 2>&1');
        if ($cpuOutput && preg_match('/PercentProcessorTime=(\d+)/i', $cpuOutput, $matches)) {
            $cpu = intval($matches[1]);
        }

        return [
            'cpu' => $cpu,
            'ram' => round($ram, 2),
            'pid' => $pid
        ];
    }
}
