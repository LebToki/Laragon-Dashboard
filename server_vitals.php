<?php
header('Content-Type: application/json');

// Function to safely execute shell commands
function safeExec($command) {
    $output = shell_exec($command);
    return $output !== null ? trim($output) : "Command failed: $command";
}

// Function to parse memory info
function parseMemInfo($meminfo) {
    $lines = explode("\n", $meminfo);
    $data = [];
    foreach ($lines as $line) {
        if (preg_match('/^(\w+):\s+(\d+)\s+(\w+)$/', $line, $matches)) {
            $data[$matches[1]] = [
                'value' => (int)$matches[2],
                'unit' => $matches[3]
            ];
        }
    }
    return $data;
}

// Function to parse disk usage
function parseDiskUsage($diskinfo) {
    $lines = explode("\n", $diskinfo);
    $data = [];
    foreach ($lines as $line) {
        if (preg_match('/^\/dev\/\w+\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)%\s+(.+)$/', $line, $matches)) {
            $data[] = [
                'filesystem' => $matches[5],
                'total' => (int)$matches[1],
                'used' => (int)$matches[2],
                'available' => (int)$matches[3],
                'use_percent' => (int)$matches[4]
            ];
        }
    }
    return $data;
}

try {
    // Fetch uptime
    $uptime = safeExec('uptime -p');

    // Fetch CPU usage
    $cpuUsage = safeExec("top -bn1 | grep 'Cpu(s)' | sed 's/.*, *\\([0-9.]*\\)%* id.*/\\1/' | awk '{print 100 - $1\"%\"}'");

    // Fetch memory usage
    $memoryInfo = safeExec('cat /proc/meminfo');
    $parsedMemInfo = parseMemInfo($memoryInfo);
    $totalMem = $parsedMemInfo['MemTotal']['value'] ?? 0;
    $freeMem = $parsedMemInfo['MemFree']['value'] ?? 0;
    $usedMem = $totalMem - $freeMem;
    $memoryUsagePercent = round(($usedMem / $totalMem) * 100, 2);

    // Fetch disk usage
    $diskInfo = safeExec('df -k');
    $parsedDiskInfo = parseDiskUsage($diskInfo);

    // Prepare data for charts
    $currentTime = date('H:i:s');
    $uptimeData = [$cpuUsage]; // You might want to store historical data for a real chart
    $uptimeLabels = [$currentTime];
    $memoryUsageData = [$totalMem, $usedMem, $freeMem];
    $memoryUsageLabels = ['Total', 'Used', 'Free'];
    $diskUsageData = array_map(function($disk) { return $disk['use_percent']; }, $parsedDiskInfo);
    $diskUsageLabels = array_map(function($disk) { return $disk['filesystem']; }, $parsedDiskInfo);

    echo json_encode([
        'uptime' => $uptime,
        'cpuUsage' => $cpuUsage,
        'memoryUsage' => "$memoryUsagePercent%",
        'memoryDetails' => [
            'total' => $totalMem,
            'used' => $usedMem,
            'free' => $freeMem
        ],
        'diskUsage' => $parsedDiskInfo,
        'uptimeData' => $uptimeData,
        'uptimeLabels' => $uptimeLabels,
        'memoryUsageData' => $memoryUsageData,
        'memoryUsageLabels' => $memoryUsageLabels,
        'diskUsageData' => $diskUsageData,
        'diskUsageLabels' => $diskUsageLabels,
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
