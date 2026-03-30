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
        $output = @shell_exec('sc start "' . $realName . '" 2>&1');
        sleep(1);
        return self::isRunning($name);
    }

    /**
     * Stop a service
     */
    public static function stop($name) {
        $realName = self::getRealName($name);
        $output = @shell_exec('sc stop "' . $realName . '" 2>&1');
        sleep(1);
        return !self::isRunning($name);
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
        
        // Find PID - parse tasklist output line by line
        $output = @shell_exec('tasklist /FI "SERVICES eq ' . $realName . '" /FO CSV 2>&1');
        if (empty($output) || stripos($output, 'No tasks') !== false || stripos($output, 'info: no tasks') !== false) {
            return ['cpu' => 0, 'ram' => 0, 'pid' => 0];
        }

        // Parse each line of CSV output
        $lines = explode("\n", trim($output));
        foreach ($lines as $line) {
            $data = str_getcsv($line);
            if (count($data) < 5) continue;
            
            // Skip header row
            if (stripos($data[0], 'image name') !== false) continue;
            
            // Match the service by name
            if (stripos($data[0], $realName) === false) continue;
            
            $pid = intval($data[1]);
            $ramRaw = $data[4]; // e.g. "12,345 K"
            $ram = floatval(str_replace([',', ' ', 'K'], '', $ramRaw)) / 1024; // MB

            // For CPU, we use wmic
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
        
        return ['cpu' => 0, 'ram' => 0, 'pid' => 0];
    }
}
