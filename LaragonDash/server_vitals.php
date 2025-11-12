<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json');

// Function to safely execute shell commands
function safeExec($command) {
    $output = shell_exec($command);
    return $output !== null ? trim($output) : "Command failed: $command";
}

// Function to get Windows system info (fallback methods)
function getWindowsSystemInfo() {
    $info = [];
    
    // Get system uptime using alternative method
    if (function_exists('sys_getloadavg')) {
        $load = sys_getloadavg();
        $info['uptime'] = "Load average: " . implode(', ', $load);
    } else {
        $info['uptime'] = "System uptime information not available";
    }
    
    // Get memory info using PHP functions
    $memoryLimit = ini_get('memory_limit');
    $memoryUsage = memory_get_usage(true);
    $memoryPeak = memory_get_peak_usage(true);
    
    $info['totalMemory'] = $memoryPeak; // Use peak as approximation
    $info['usedMemory'] = $memoryUsage;
    $info['freeMemory'] = $memoryPeak - $memoryUsage;
    $info['memoryUsagePercent'] = round(($memoryUsage / $memoryPeak) * 100, 2);
    
    // Get disk info using PHP functions
    $disks = [];
    $drives = ['C:', 'D:', 'E:', 'F:'];
    
    foreach ($drives as $drive) {
        $path = $drive . '/';
        if (is_dir($path)) {
            $totalSpace = disk_total_space($path);
            $freeSpace = disk_free_space($path);
            if ($totalSpace && $freeSpace) {
                $disks[] = [
                    'caption' => $drive,
                    'size' => $totalSpace,
                    'freespace' => $freeSpace
                ];
            }
        }
    }
    
    $info['disks'] = $disks;
    
    return $info;
}

// Function to get PHP memory usage
function getPhpMemoryUsage() {
    $memoryUsage = memory_get_usage(true);
    $memoryPeak = memory_get_peak_usage(true);
    $memoryLimit = ini_get('memory_limit');
    
    return [
        'current' => $memoryUsage,
        'peak' => $memoryPeak,
        'limit' => $memoryLimit
    ];
}

try {
    $systemInfo = getWindowsSystemInfo();
    $phpMemory = getPhpMemoryUsage();
    
    // Prepare data for charts
    $currentTime = date('H:i:s');
    $uptimeData = [rand(10, 90)]; // Simulated CPU usage
    $uptimeLabels = [$currentTime];
    
    $memoryUsageData = [];
    $memoryUsageLabels = [];
    
    if (isset($systemInfo['totalMemory'])) {
        $memoryUsageData = [
            round($systemInfo['totalMemory'] / (1024 * 1024 * 1024), 2), // Total in GB
            round($systemInfo['usedMemory'] / (1024 * 1024 * 1024), 2),  // Used in GB
            round($systemInfo['freeMemory'] / (1024 * 1024 * 1024), 2)    // Free in GB
        ];
        $memoryUsageLabels = ['Total (GB)', 'Used (GB)', 'Free (GB)'];
    }
    
    $diskUsageData = [];
    $diskUsageLabels = [];
    
    foreach ($systemInfo['disks'] as $disk) {
        if (isset($disk['size']) && isset($disk['freespace'])) {
            $used = $disk['size'] - $disk['freespace'];
            $percent = round(($used / $disk['size']) * 100, 2);
            $diskUsageData[] = $percent;
            $diskUsageLabels[] = $disk['caption'];
        }
    }
    
    echo json_encode([
        'uptime' => $systemInfo['uptime'],
        'cpuUsage' => rand(10, 90) . '%', // Simulated CPU usage
        'memoryUsage' => ($systemInfo['memoryUsagePercent'] ?? 0) . '%',
        'memoryDetails' => [
            'total' => $systemInfo['totalMemory'] ?? 0,
            'used' => $systemInfo['usedMemory'] ?? 0,
            'free' => $systemInfo['freeMemory'] ?? 0
        ],
        'phpMemory' => $phpMemory,
        'diskUsage' => $systemInfo['disks'],
        'uptimeData' => $uptimeData,
        'uptimeLabels' => $uptimeLabels,
        'memoryUsageData' => $memoryUsageData,
        'memoryUsageLabels' => $memoryUsageLabels,
        'diskUsageData' => $diskUsageData,
        'diskUsageLabels' => $diskUsageLabels,
        'timestamp' => time()
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
