<?php
/**
 * Services Class - Cross-platform service management
 * Version: 2.0.0
 * Supports Windows (net/sc/query) and Linux (systemctl)
 */

// Service name mapping
$serviceMap = [
    'Apache' => 'Apache2.4',
    'MySQL' => 'MySQL',
    'PostgreSQL' => 'postgresql',
    'Nginx' => 'nginx',
    'Redis' => 'Redis',
    'Memcached' => 'memcached',
    'MongoDB' => 'MongoDB',
    'Mailpit' => 'Mailpit'
];

// Get real service name
function getRealName($name) {
    global $serviceMap;
    return $serviceMap[$name] ?? $name;
}

// Check if Windows or Linux
function _getOS() {
    return strtoupper(substr(php_uname(), 0, 3)) === 'WIN' || strpos(PHP_OS, 'win') !== false ? 'windows' : 'linux';
}

// Check if a service is running
function isServiceRunning($name) {
    $realName = getRealName($name);
    $os = _getOS();
    
    if ($os === 'windows') {
        $output = @shell_exec('sc query "' . $realName . '" 2>&1');
        return $output && stripos($output, 'RUNNING') !== false;
    } else {
        $output = @shell_exec('systemctl is-active "' . $realName . '" 2>&1');
        return $output && trim($output) === 'active';
    }
}

// Start a service
function startService($name) {
    $realName = getRealName($name);
    $os = _getOS();
    
    if ($os === 'windows') {
        $output = @shell_exec('net start "' . $realName . '" 2>&1');
        return strpos($output, 'was started successfully') !== false || strpos($output, 'running') !== false;
    } else {
        $output = @shell_exec('systemctl start "' . $realName . '" 2>&1');
        return strpos($output, 'started successfully') !== false || strpos($output, 'active') !== false;
    }
}

// Stop a service
function stopService($name) {
    $realName = getRealName($name);
    $os = _getOS();
    
    if ($os === 'windows') {
        $output = @shell_exec('net stop "' . $realName . '" 2>&1');
        return strpos($output, 'was stopped successfully') !== false || strpos($output, 'stopped') !== false;
    } else {
        $output = @shell_exec('systemctl stop "' . $realName . '" 2>&1');
        return strpos($output, 'stopped successfully') !== false || strpos($output, 'inactive') !== false;
    }
}

// Check if a port is in use
function isPortInUse($port) {
    $port = intval($port);
    $os = _getOS();
    
    if ($os === 'windows') {
        $output = @shell_exec('netstat -an | findstr :' . $port . ' 2>&1');
        return !empty(trim($output));
    } else {
        $output = @shell_exec('ss -tlnp | grep :' . $port . ' 2>&1');
        return !empty(trim($output));
    }
}

// Get resource usage
function getServiceResourceUsage($name) {
    $realName = getRealName($name);
    $os = _getOS();
    $result = ['cpu' => 0, 'ram' => 0, 'pid' => 0];
    
    if ($os === 'windows') {
        $output = @shell_exec('tasklist /FI "SERVICES eq ' . $realName . '" /FO CSV /NH 2>&1');
        if (empty($output) || strpos($output, 'No tasks') !== false) return $result;
        
        $data = str_getcsv($output);
        if (count($data) < 5) return $result;
        
        $pid = intval($data[1]);
        $ramRaw = $data[4];
        $ram = floatval(str_replace([',', ' ', 'K'], '', $ramRaw)) / 1024;
        
        $cpu = 0;
        $cpuOutput = @shell_exec('wmic process where ProcessId=' . $pid . ' get PercentProcessorTime /value 2>&1');
        if ($cpuOutput && preg_match('/PercentProcessorTime=(\d+)/i', $cpuOutput, $matches)) {
            $cpu = intval($matches[1]);
        }
        
        return ['cpu' => $cpu, 'ram' => round($ram, 2), 'pid' => $pid];
    } else {
        $psOutput = @shell_exec('ps -eo pid,comm,pcpu,pmem --no-headers 2>&1');
        if ($psOutput) {
            $lines = explode("\n", $psOutput);
            foreach ($lines as $line) {
                $parts = explode(" ", trim($line));
                if (count($parts) >= 4) {
                    $pid = intval($parts[0]);
                    $cpu = floatval($parts[2]);
                    $ramP = floatval($parts[3]);
                    $svcLower = strtolower($realName);
                    $commLower = strtolower(trim($parts[1]));
                    if (strpos($commLower, $svcLower) !== false || $pid > 0) {
                        $ramMb = ($ramP / 100) * 16000;
                        return ['cpu' => intval($cpu * 100) / 100, 'ram' => round($ramMb, 2), 'pid' => $pid];
                    }
                }
            }
        }
        
        $stats = @shell_exec('systemctl show "' . $realName . '" --property=MemoryUse --property=CPUUsageNSec 2>&1');
        if ($stats) {
            if (preg_match('/MemoryUse=(\d+)/', $stats, $m)) $result['ram'] = intval($m[1]) / 1024;
            if (preg_match('/CPUUsageNSec=(\d+)/', $stats, $m)) $result['cpu'] = max(0, min(100, intval($m[1]) / 10000000));
        }
        return $result;
    }
}
