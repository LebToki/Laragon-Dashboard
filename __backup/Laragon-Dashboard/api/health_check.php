<?php
/**
 * Application: Laragon | Health Check API
 * Description: System health monitoring and alerts
 * Version: 2.6.0
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json');

if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$health = [
    'success' => true,
    'timestamp' => date('Y-m-d H:i:s'),
    'system' => getSystemHealth(),
    'services' => getServicesHealth(),
    'ports' => checkPorts(),
    'alerts' => []
];

// Check for critical issues
if ($health['system']['cpu'] > 90) {
    $health['alerts'][] = ['level' => 'critical', 'message' => 'CPU usage is above 90%'];
}

if ($health['system']['memory']['percent'] > 90) {
    $health['alerts'][] = ['level' => 'critical', 'message' => 'Memory usage is above 90%'];
}

if ($health['system']['disk']['percent'] > 90) {
    $health['alerts'][] = ['level' => 'warning', 'message' => 'Disk usage is above 90%'];
}

echo json_encode($health);

function getSystemHealth() {
    // CPU usage (Windows)
    $cpu = 0;
    if (function_exists('exec')) {
        $output = shell_exec('wmic cpu get loadpercentage /value 2>&1');
        if (preg_match('/LoadPercentage=(\d+)/', $output, $matches)) {
            $cpu = (int)$matches[1];
        }
    }
    
    // Memory usage
    $memTotal = 0;
    $memFree = 0;
    if (function_exists('exec')) {
        $output = shell_exec('wmic OS get TotalVisibleMemorySize,FreePhysicalMemory /value 2>&1');
        if (preg_match('/TotalVisibleMemorySize=(\d+)/', $output, $matches)) {
            $memTotal = (int)$matches[1] * 1024; // Convert KB to bytes
        }
        if (preg_match('/FreePhysicalMemory=(\d+)/', $output, $matches)) {
            $memFree = (int)$matches[1] * 1024;
        }
    }
    $memUsed = $memTotal - $memFree;
    $memPercent = $memTotal > 0 ? round(($memUsed / $memTotal) * 100, 2) : 0;
    
    // Disk usage
    $diskTotal = disk_total_space('C:');
    $diskFree = disk_free_space('C:');
    $diskUsed = $diskTotal - $diskFree;
    $diskPercent = $diskTotal > 0 ? round(($diskUsed / $diskTotal) * 100, 2) : 0;
    
    return [
        'cpu' => $cpu,
        'memory' => [
            'total' => $memTotal,
            'used' => $memUsed,
            'free' => $memFree,
            'percent' => $memPercent
        ],
        'disk' => [
            'total' => $diskTotal,
            'used' => $diskUsed,
            'free' => $diskFree,
            'percent' => $diskPercent
        ]
    ];
}

function getServicesHealth() {
    $services = ['Apache', 'MySQL', 'Redis'];
    $status = [];
    
    foreach ($services as $service) {
        $status[$service] = checkServiceStatus($service);
    }
    
    return $status;
}

function checkServiceStatus($serviceName) {
    $output = shell_exec("sc query \"{$serviceName}\" 2>&1");
    if (strpos($output, 'RUNNING') !== false) {
        return 'running';
    } elseif (strpos($output, 'STOPPED') !== false) {
        return 'stopped';
    }
    return 'unknown';
}

function checkPorts() {
    $ports = [80, 443, 3306, 6379];
    $status = [];
    
    foreach ($ports as $port) {
        $status[$port] = isPortOpen($port);
    }
    
    return $status;
}

function isPortOpen($port) {
    $connection = @fsockopen('localhost', $port, $errno, $errstr, 1);
    if ($connection) {
        fclose($connection);
        return true;
    }
    return false;
}

