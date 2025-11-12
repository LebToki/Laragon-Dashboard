<?php
/**
 * Services Manager API for Laragon Dashboard
 * Provides service control for Apache, MySQL, Redis, etc.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'status';

// Detect Laragon installation path
function getLaragonPath() {
    $possiblePaths = [
        'C:/laragon',
        'D:/laragon',
        'E:/laragon',
        getenv('LARAGON_ROOT') ?: ''
    ];
    
    foreach ($possiblePaths as $path) {
        if (!empty($path) && is_dir($path) && file_exists($path . '/laragon.exe')) {
            return $path;
        }
    }
    
    // Try to detect from document root
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    if (strpos($docRoot, 'laragon') !== false) {
        $parts = explode('laragon', $docRoot);
        return $parts[0] . 'laragon';
    }
    
    return 'C:/laragon'; // Default fallback
}

function checkServiceStatus($serviceName) {
    $output = shell_exec("sc query \"$serviceName\" 2>&1");
    if (strpos($output, 'RUNNING') !== false) {
        return 'running';
    } elseif (strpos($output, 'STOPPED') !== false) {
        return 'stopped';
    }
    return 'unknown';
}

function getServiceStatus() {
    $services = [
        'Apache' => 'Apache2.4',
        'MySQL' => 'MySQL',
        'Nginx' => 'nginx',
        'Redis' => 'Redis',
        'Memcached' => 'memcached'
    ];
    
    $status = [];
    foreach ($services as $name => $serviceName) {
        $status[$name] = checkServiceStatus($serviceName);
    }
    
    return $status;
}

try {
    switch ($action) {
        case 'status':
            $status = getServiceStatus();
            echo json_encode([
                'success' => true,
                'services' => $status
            ]);
            break;
            
        case 'start':
        case 'stop':
        case 'restart':
            $service = $_GET['service'] ?? '';
            if (empty($service)) {
                throw new Exception('Service name required');
            }
            
            $serviceMap = [
                'Apache' => 'Apache2.4',
                'MySQL' => 'MySQL',
                'Nginx' => 'nginx',
                'Redis' => 'Redis',
                'Memcached' => 'memcached'
            ];
            
            $serviceName = $serviceMap[$service] ?? $service;
            $command = '';
            
            if ($action === 'start') {
                $command = "net start \"$serviceName\"";
            } elseif ($action === 'stop') {
                $command = "net stop \"$serviceName\"";
            } elseif ($action === 'restart') {
                $command = "net stop \"$serviceName\" && timeout /t 2 /nobreak >nul && net start \"$serviceName\"";
            }
            
            if (!empty($command)) {
                $output = shell_exec($command . ' 2>&1');
                DashboardLogger::info("Service $action: $service", ['output' => $output]);
                
                // Wait a moment and check status
                sleep(1);
                $newStatus = checkServiceStatus($serviceName);
                
                echo json_encode([
                    'success' => true,
                    'message' => "Service $action command executed",
                    'status' => $newStatus,
                    'output' => $output
                ]);
            } else {
                throw new Exception('Invalid action');
            }
            break;
            
        case 'get_ports':
            // Get listening ports
            $output = shell_exec('netstat -ano | findstr LISTENING 2>&1');
            $lines = explode("\n", trim($output));
            $ports = [];
            
            foreach ($lines as $line) {
                if (preg_match('/\s+(\d+\.\d+\.\d+\.\d+):(\d+)\s+/', $line, $matches)) {
                    $port = (int)$matches[2];
                    if ($port > 0 && $port < 65536) {
                        $ports[] = [
                            'address' => $matches[1],
                            'port' => $port
                        ];
                    }
                }
            }
            
            // Remove duplicates and sort
            $uniquePorts = [];
            foreach ($ports as $port) {
                $key = $port['address'] . ':' . $port['port'];
                if (!isset($uniquePorts[$key])) {
                    $uniquePorts[$key] = $port;
                }
            }
            
            echo json_encode([
                'success' => true,
                'ports' => array_values($uniquePorts)
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Services Manager Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

