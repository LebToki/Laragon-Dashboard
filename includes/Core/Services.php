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
     * Wait until a service reaches the expected running state.
     *
     * `sc` is asynchronous: it returns while the service is still
     * START_PENDING/STOP_PENDING, so a fixed sleep(1) reports the wrong answer
     * on slow machines (MySQL, Apache) and makes restart look broken.
     */
    private static function waitFor($name, $running, $timeoutSec = 20) {
        $deadline = microtime(true) + $timeoutSec;
        do {
            if (self::isRunning($name) === $running) {
                return true;
            }
            usleep(250000);
        } while (microtime(true) < $deadline);
        return false;
    }

    /**
     * Start a service
     */
    public static function start($name) {
        $realName = self::getRealName($name);
        @shell_exec('sc start "' . $realName . '" 2>&1');
        return self::waitFor($name, true);
    }

    /**
     * Stop a service
     */
    public static function stop($name) {
        $realName = self::getRealName($name);
        @shell_exec('sc stop "' . $realName . '" 2>&1');
        return self::waitFor($name, false);
    }

    /**
     * Restart a service: stop, wait for STOPPED, start, wait for RUNNING.
     *
     * There was no restart at all before - the API listed it as a destructive
     * action but had no handler, so the request fell through to "Invalid
     * action".
     */
    public static function restart($name) {
        $realName = self::getRealName($name);
        @shell_exec('sc stop "' . $realName . '" 2>&1');
        if (!self::waitFor($name, false)) {
            return false;
        }
        @shell_exec('sc start "' . $realName . '" 2>&1');
        return self::waitFor($name, true);
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
