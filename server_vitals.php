<?php
header('Content-Type: application/json');

// Fetch uptime
$uptime = shell_exec('uptime');

// Fetch memory usage
$memoryUsage = shell_exec('free -m');

// Fetch disk usage
$diskUsage = shell_exec('df -h');

// Prepare data for charts
$uptimeData = [/* Add your uptime data here */];
$uptimeLabels = ['Time1', 'Time2', 'Time3']; // Add your time labels here

$memoryUsageData = [/* Add your memory usage data here */];
$memoryUsageLabels = ['Total', 'Used', 'Free']; // Memory usage categories

$diskUsageData = [/* Add your disk usage data here */];
$diskUsageLabels = ['Used', 'Available']; // Disk usage categories

echo json_encode([
    'uptime' => $uptime,
    'memoryUsage' => $memoryUsage,
    'diskUsage' => $diskUsage,
    'uptimeData' => $uptimeData,
    'uptimeLabels' => $uptimeLabels,
    'memoryUsageData' => $memoryUsageData,
    'memoryUsageLabels' => $memoryUsageLabels,
    'diskUsageData' => $diskUsageData,
    'diskUsageLabels' => $diskUsageLabels,
]);
