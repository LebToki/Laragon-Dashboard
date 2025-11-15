<?php
/**
 * Laragon Dashboard - Server Vitals API
 * Version: 3.0.0
 * Description: API endpoint for server monitoring data
 */

// Start output buffering to catch any stray output
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load configuration
require_once __DIR__ . '/../config.php';

// Clear any output that may have been generated
ob_clean();

// Set JSON header before any output
header('Content-Type: application/json');

// Get server vitals data
function getServerVitals() {
    $vitals = [
        'cpu' => [
            'current' => 0,
            'history' => []
        ],
        'memory' => [
            'current' => 0,
            'total' => 0,
            'used' => 0,
            'free' => 0,
            'history' => []
        ],
        'disk' => [
            'current' => 0,
            'total' => 0,
            'used' => 0,
            'free' => 0,
            'drives' => []
        ],
        'network' => [
            'speed' => 0,
            'upload' => 0,
            'download' => 0,
            'history' => []
        ],
        'services' => [
            'running' => 0,
            'stopped' => 0,
            'total' => 0
        ]
    ];
    
    // Get CPU usage (Windows)
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Get CPU usage using WMI
        $output = @shell_exec('wmic cpu get loadpercentage /value 2>&1');
        if ($output && preg_match('/LoadPercentage=(\d+)/', $output, $matches)) {
            $vitals['cpu']['current'] = (int)$matches[1];
        }
        
        // Get memory info
        $output = @shell_exec('wmic OS get TotalVisibleMemorySize,FreePhysicalMemory /value 2>&1');
        if ($output) {
            preg_match('/TotalVisibleMemorySize=(\d+)/', $output, $totalMatches);
            preg_match('/FreePhysicalMemory=(\d+)/', $output, $freeMatches);
            if (!empty($totalMatches[1]) && !empty($freeMatches[1])) {
                $totalKB = (int)$totalMatches[1];
                $freeKB = (int)$freeMatches[1];
                $usedKB = $totalKB - $freeKB;
                
                $vitals['memory']['total'] = round($totalKB / 1024 / 1024, 2); // GB
                $vitals['memory']['free'] = round($freeKB / 1024 / 1024, 2); // GB
                $vitals['memory']['used'] = round($usedKB / 1024 / 1024, 2); // GB
                $vitals['memory']['current'] = round(($usedKB / $totalKB) * 100, 2);
            }
        }
        
        // Get disk usage
        $drives = ['C:', 'D:', 'E:'];
        foreach ($drives as $drive) {
            $output = @shell_exec('wmic logicaldisk where "DeviceID=\'' . $drive . '\'" get Size,FreeSpace /value 2>&1');
            if ($output) {
                preg_match('/Size=(\d+)/', $output, $sizeMatches);
                preg_match('/FreeSpace=(\d+)/', $output, $freeMatches);
                if (!empty($sizeMatches[1]) && !empty($freeMatches[1])) {
                    $total = (int)$sizeMatches[1];
                    $free = (int)$freeMatches[1];
                    $used = $total - $free;
                    $percent = round(($used / $total) * 100, 2);
                    
                    $vitals['disk']['drives'][] = [
                        'drive' => $drive,
                        'total' => round($total / 1024 / 1024 / 1024, 2), // GB
                        'used' => round($used / 1024 / 1024 / 1024, 2), // GB
                        'free' => round($free / 1024 / 1024 / 1024, 2), // GB
                        'percent' => $percent
                    ];
                    
                    // Use C: drive as primary
                    if ($drive === 'C:') {
                        $vitals['disk']['current'] = $percent;
                        $vitals['disk']['total'] = round($total / 1024 / 1024 / 1024, 2);
                        $vitals['disk']['used'] = round($used / 1024 / 1024 / 1024, 2);
                        $vitals['disk']['free'] = round($free / 1024 / 1024 / 1024, 2);
                    }
                }
            }
        }
        
        // Get service status
        $services = ['Apache2.4', 'MySQL'];
        $running = 0;
        foreach ($services as $service) {
            $output = @shell_exec('sc query "' . $service . '" 2>&1');
            if (strpos($output, 'RUNNING') !== false) {
                $running++;
            }
        }
        $vitals['services']['running'] = $running;
        $vitals['services']['stopped'] = count($services) - $running;
        $vitals['services']['total'] = count($services);
    }
    
    // Generate history data (last 24 hours, hourly intervals)
    $now = time();
    for ($i = 23; $i >= 0; $i--) {
        $timestamp = $now - ($i * 3600);
        $hour = date('H:i', $timestamp);
        
        // Simulate CPU history (in real app, this would come from database/logs)
        $vitals['cpu']['history'][] = [
            'time' => $hour,
            'value' => rand(10, 80) // Simulated data
        ];
        
        // Simulate memory history
        $vitals['memory']['history'][] = [
            'time' => $hour,
            'value' => rand(30, 90) // Simulated data
        ];
        
        // Simulate network history
        $vitals['network']['history'][] = [
            'time' => $hour,
            'upload' => rand(0, 100),
            'download' => rand(0, 200)
        ];
    }
    
    // Set current network speed (simulated)
    $vitals['network']['speed'] = rand(50, 500);
    $vitals['network']['upload'] = rand(10, 50);
    $vitals['network']['download'] = rand(50, 200);
    
    return $vitals;
}

try {
    $vitals = getServerVitals();
    ob_clean();
    echo json_encode([
        'success' => true,
        'data' => $vitals
    ]);
    ob_end_flush();
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    ob_end_flush();
} catch (Error $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    ob_end_flush();
}

