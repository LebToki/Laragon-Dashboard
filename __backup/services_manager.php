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

function getApacheVersion() {
    $laragonPath = getLaragonPath();
    
    // Try different Apache paths
    $apachePaths = [
        $laragonPath . '/bin/apache/httpd/httpd.exe',
        $laragonPath . '/bin/apache/apache*/bin/httpd.exe'
    ];
    
    // Try glob pattern for versioned Apache directories
    $apacheGlob = glob($laragonPath . '/bin/apache/apache*/bin/httpd.exe');
    if (!empty($apacheGlob)) {
        $apachePaths = array_merge($apachePaths, $apacheGlob);
    }
    
    foreach ($apachePaths as $httpdPath) {
        if (file_exists($httpdPath)) {
            // Try PowerShell to get file version
            $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $httpdPath) . '\').VersionInfo.FileVersion"';
            $version = @shell_exec($command);
            if ($version && trim($version) !== '') {
                $parts = explode('.', trim($version));
                if (count($parts) >= 2) {
                    return $parts[0] . '.' . $parts[1] . '.' . ($parts[2] ?? '0');
                }
                return trim($version);
            }
            
            // Fallback: try to get from httpd -v
            $output = @shell_exec('"' . $httpdPath . '" -v 2>&1');
            if ($output && preg_match('/Apache\/([\d.]+)/i', $output, $matches)) {
                return $matches[1];
            }
        }
    }
    
    // Last resort: try to get from SERVER_SOFTWARE
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
    if (preg_match('/Apache\/([\d.]+)/i', $serverSoftware, $matches)) {
        return $matches[1];
    }
    
    return 'Unknown';
}

function getMySQLVersion() {
    $laragonPath = getLaragonPath();
    $mysqlPath = $laragonPath . '/bin/mysql/mysql-*/bin/mysql.exe';
    $mysqlExes = glob($mysqlPath);
    if (!empty($mysqlExes)) {
        $output = @shell_exec('"' . $mysqlExes[0] . '" --version 2>&1');
        if ($output && preg_match('/Ver\s+([\d.]+)/i', $output, $matches)) {
            return $matches[1];
        }
    }
    // Try to connect and get version
    error_reporting(0);
    $link = @mysqli_connect('localhost', 'root', '');
    if ($link) {
        $version = mysqli_get_server_info($link);
        mysqli_close($link);
        if ($version) {
            return $version;
        }
    }
    return 'Unknown';
}

function getMailpitVersion() {
    $laragonPath = getLaragonPath();
    $mailpitPath = $laragonPath . '/bin/mailpit/mailpit.exe';
    if (file_exists($mailpitPath)) {
        $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $mailpitPath) . '\').VersionInfo.FileVersion"';
        $version = @shell_exec($command);
        if ($version && trim($version) !== '') {
            $parts = explode('.', trim($version));
            if (count($parts) >= 2) {
                return $parts[0] . '.' . $parts[1] . '.' . ($parts[2] ?? '0');
            }
            return trim($version);
        }
    }
    // Try to get from mailpit --version
    $output = @shell_exec('"' . $mailpitPath . '" --version 2>&1');
    if ($output && preg_match('/([\d.]+)/', $output, $matches)) {
        return $matches[1];
    }
    return 'Unknown';
}

/**
 * Get Laragon general preferences from laragon.ini
 * Returns array of preferences or defaults
 */
function getLaragonPreferences() {
    $laragonPath = getLaragonPath();
    $iniFile = $laragonPath . '/usr/laragon.ini';
    
    // Default preferences
    $defaults = [
        'StartAllAutomatically' => false,
        'DocumentRoot' => $laragonPath . '/www',
        'DataDirectory' => $laragonPath . '/data',
        'HostnameFormat' => '{name}.local',
        'AutoBackup' => false,
        'BackupInterval' => 8,
        'AutoUpdate' => false,
        'RunOnWindowsStart' => false,
        'RunMinimized' => false,
        'AutoCreateVirtualHosts' => true
    ];
    
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile);
        if ($config) {
            // Map Laragon ini keys to our preference keys
            $keyMap = [
                'StartAll' => 'StartAllAutomatically',
                'StartAllAutomatically' => 'StartAllAutomatically',
                'DocumentRoot' => 'DocumentRoot',
                'DataDirectory' => 'DataDirectory',
                'HostnameFormat' => 'HostnameFormat',
                'AutoBackup' => 'AutoBackup',
                'BackupInterval' => 'BackupInterval',
                'AutoUpdate' => 'AutoUpdate',
                'RunOnWindowsStart' => 'RunOnWindowsStart',
                'RunMinimized' => 'RunMinimized',
                'AutoCreateVirtualHosts' => 'AutoCreateVirtualHosts'
            ];
            
            foreach ($keyMap as $iniKey => $prefKey) {
                if (isset($config[$iniKey])) {
                    $value = $config[$iniKey];
                    // Convert string booleans to actual booleans
                    if (is_string($value)) {
                        $value = trim($value);
                        if (strtolower($value) === 'true' || $value === '1') {
                            $value = true;
                        } elseif (strtolower($value) === 'false' || $value === '0' || $value === '') {
                            $value = false;
                        }
                    }
                    $defaults[$prefKey] = $value;
                }
            }
            
            // Also check for numeric values
            if (isset($config['BackupInterval']) && is_numeric($config['BackupInterval'])) {
                $defaults['BackupInterval'] = (int)$config['BackupInterval'];
            }
        }
    }
    
    // Normalize paths
    if (isset($defaults['DocumentRoot'])) {
        $defaults['DocumentRoot'] = str_replace('\\', '/', $defaults['DocumentRoot']);
    }
    if (isset($defaults['DataDirectory'])) {
        $defaults['DataDirectory'] = str_replace('\\', '/', $defaults['DataDirectory']);
    }
    
    return $defaults;
}

/**
 * Get service port configuration from Laragon preferences
 * Returns configured ports or standard defaults
 */
function getLaragonServicePorts($serviceName) {
    $laragonPath = getLaragonPath();
    $iniFile = $laragonPath . '/usr/laragon.ini';
    
    // Standard default ports (matching Laragon defaults)
    $defaultPorts = [
        'Apache' => ['main' => 80, 'ssl' => 443],
        'MySQL' => ['main' => 3306],
        'PostgreSQL' => ['main' => 5432],
        'Nginx' => ['main' => 8080, 'ssl' => 8443],
        'Memcached' => ['main' => 11211],
        'Redis' => ['main' => 6379],
        'MongoDB' => ['main' => 27017],
        'Mailpit' => ['main' => 1025, 'web' => 8025]
    ];
    
    // Try to read from laragon.ini
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile);
        if ($config) {
            // Laragon stores ports in format like ApachePort, MySQLPort, etc.
            $portKeys = [
                'Apache' => ['ApachePort', 'ApacheSSLPort'],
                'MySQL' => ['MySQLPort'],
                'PostgreSQL' => ['PostgreSQLPort'],
                'Nginx' => ['NginxPort', 'NginxSSLPort'],
                'Memcached' => ['MemcachedPort'],
                'Redis' => ['RedisPort'],
                'MongoDB' => ['MongoDBPort'],
                'Mailpit' => ['MailpitPort', 'MailpitWebPort']
            ];
            
            if (isset($portKeys[$serviceName])) {
                $ports = [];
                $keys = $portKeys[$serviceName];
                foreach ($keys as $key) {
                    if (isset($config[$key]) && is_numeric($config[$key])) {
                        $ports[] = (int)$config[$key];
                    }
                }
                if (!empty($ports)) {
                    return $ports;
                }
            }
        }
    }
    
    // Return defaults if config not found
    return isset($defaultPorts[$serviceName]) ? array_values($defaultPorts[$serviceName]) : [];
}

/**
 * Get actual listening ports for a service
 * Combines configured ports with detected listening ports
 */
function getServicePorts($serviceName) {
    // Get configured ports from Laragon
    $configuredPorts = getLaragonServicePorts($serviceName);
    
    // Also detect from listening ports
    $detectedPorts = [];
    $output = @shell_exec('netstat -ano | findstr LISTENING 2>&1');
    $lines = explode("\n", trim($output));
    
    foreach ($lines as $line) {
        if (preg_match('/\s+(\d+\.\d+\.\d+\.\d+):(\d+)\s+/', $line, $matches)) {
            $port = (int)$matches[2];
            
            // Check if this port matches any configured port for this service
            if (in_array($port, $configuredPorts)) {
                $detectedPorts[] = $port;
            }
        }
    }
    
    // Return detected ports if found, otherwise return configured ports
    return !empty($detectedPorts) ? array_unique($detectedPorts) : $configuredPorts;
}

function checkProcessRunning($processName) {
    $output = @shell_exec('tasklist /FI "IMAGENAME eq ' . $processName . '" 2>&1');
    return $output && strpos($output, $processName) !== false;
}

function getServiceStatus() {
    $laragonPath = getLaragonPath();
    $preferences = getLaragonPreferences();
    $startAllAutomatically = $preferences['StartAllAutomatically'] ?? false;
    
    $services = [];
    
    // Apache
    $apacheStatus = checkServiceStatus('Apache2.4');
    $apachePorts = getServicePorts('Apache');
    // If Start All automatically is enabled, Apache should be enabled
    $apacheEnabled = $startAllAutomatically || $apacheStatus === 'running';
    $services['Apache'] = [
        'status' => $apacheStatus,
        'version' => getApacheVersion(),
        'ports' => $apachePorts,
        'configuredPorts' => getLaragonServicePorts('Apache'),
        'serviceName' => 'Apache2.4',
        'icon' => 'lock',
        'enabled' => $apacheEnabled
    ];
    
    // MySQL
    $mysqlStatus = checkServiceStatus('MySQL');
    $mysqlPorts = getServicePorts('MySQL');
    // If Start All automatically is enabled, MySQL should be enabled
    $mysqlEnabled = $startAllAutomatically || $mysqlStatus === 'running';
    $services['MySQL'] = [
        'status' => $mysqlStatus,
        'version' => getMySQLVersion(),
        'ports' => $mysqlPorts,
        'configuredPorts' => getLaragonServicePorts('MySQL'),
        'serviceName' => 'MySQL',
        'icon' => 'database',
        'enabled' => $mysqlEnabled
    ];
    
    // PostgreSQL
    $postgresStatus = checkServiceStatus('postgresql');
    $postgresPorts = getServicePorts('PostgreSQL');
    $services['PostgreSQL'] = [
        'status' => $postgresStatus !== 'unknown' ? $postgresStatus : (checkProcessRunning('postgres.exe') ? 'running' : 'stopped'),
        'version' => 'Unknown', // Can be enhanced later
        'ports' => $postgresPorts,
        'configuredPorts' => getLaragonServicePorts('PostgreSQL'),
        'serviceName' => 'postgresql',
        'icon' => 'database',
        'enabled' => $postgresStatus !== 'unknown' || checkProcessRunning('postgres.exe')
    ];
    
    // Nginx
    $nginxStatus = checkServiceStatus('nginx');
    $nginxPorts = getServicePorts('Nginx');
    $services['Nginx'] = [
        'status' => $nginxStatus !== 'unknown' ? $nginxStatus : (checkProcessRunning('nginx.exe') ? 'running' : 'stopped'),
        'version' => 'Unknown', // Can be enhanced later
        'ports' => $nginxPorts,
        'configuredPorts' => getLaragonServicePorts('Nginx'),
        'serviceName' => 'nginx',
        'icon' => 'server',
        'enabled' => $nginxStatus !== 'unknown' || checkProcessRunning('nginx.exe')
    ];
    
    // Memcached
    $memcachedStatus = checkServiceStatus('memcached');
    $memcachedPorts = getServicePorts('Memcached');
    $services['Memcached'] = [
        'status' => $memcachedStatus !== 'unknown' ? $memcachedStatus : (checkProcessRunning('memcached.exe') ? 'running' : 'stopped'),
        'version' => 'Unknown',
        'ports' => $memcachedPorts,
        'configuredPorts' => getLaragonServicePorts('Memcached'),
        'serviceName' => 'memcached',
        'icon' => 'memory',
        'enabled' => $memcachedStatus !== 'unknown' || checkProcessRunning('memcached.exe')
    ];
    
    // Redis
    $redisStatus = checkServiceStatus('Redis');
    $redisPorts = getServicePorts('Redis');
    $services['Redis'] = [
        'status' => $redisStatus !== 'unknown' ? $redisStatus : (checkProcessRunning('redis-server.exe') ? 'running' : 'stopped'),
        'version' => 'Unknown',
        'ports' => $redisPorts,
        'configuredPorts' => getLaragonServicePorts('Redis'),
        'serviceName' => 'Redis',
        'icon' => 'memory',
        'enabled' => $redisStatus !== 'unknown' || checkProcessRunning('redis-server.exe')
    ];
    
    // MongoDB
    $mongoStatus = checkServiceStatus('MongoDB');
    $mongoPorts = getServicePorts('MongoDB');
    $services['MongoDB'] = [
        'status' => $mongoStatus !== 'unknown' ? $mongoStatus : (checkProcessRunning('mongod.exe') ? 'running' : 'stopped'),
        'version' => 'Unknown',
        'ports' => $mongoPorts,
        'configuredPorts' => getLaragonServicePorts('MongoDB'),
        'serviceName' => 'MongoDB',
        'icon' => 'database',
        'enabled' => $mongoStatus !== 'unknown' || checkProcessRunning('mongod.exe')
    ];
    
    // Mailpit (check if process is running, not a Windows service)
    $mailpitRunning = checkProcessRunning('mailpit.exe');
    $mailpitPorts = getServicePorts('Mailpit');
    $services['Mailpit'] = [
        'status' => $mailpitRunning ? 'running' : 'stopped',
        'version' => getMailpitVersion(),
        'ports' => $mailpitPorts,
        'configuredPorts' => getLaragonServicePorts('Mailpit'),
        'serviceName' => 'Mailpit',
        'icon' => 'envelope',
        'enabled' => $mailpitRunning || file_exists($laragonPath . '/bin/mailpit/mailpit.exe')
    ];
    
    return $services;
}

try {
    switch ($action) {
        case 'status':
            $status = getServiceStatus();
            $preferences = getLaragonPreferences();
            echo json_encode([
                'success' => true,
                'services' => $status,
                'preferences' => $preferences
            ], JSON_PRETTY_PRINT);
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
                'PostgreSQL' => 'postgresql',
                'Nginx' => 'nginx',
                'Redis' => 'Redis',
                'Memcached' => 'memcached',
                'MongoDB' => 'MongoDB',
                'Mailpit' => 'Mailpit'
            ];
            
            $serviceName = $serviceMap[$service] ?? $service;
            $command = '';
            
            // Services that run as processes, not Windows services
            $processServices = ['Mailpit', 'Nginx', 'Memcached', 'Redis', 'MongoDB', 'PostgreSQL'];
            
            if (in_array($service, $processServices)) {
                $laragonPath = getLaragonPath();
                $processMap = [
                    'Mailpit' => 'mailpit.exe',
                    'Nginx' => 'nginx.exe',
                    'Memcached' => 'memcached.exe',
                    'Redis' => 'redis-server.exe',
                    'MongoDB' => 'mongod.exe',
                    'PostgreSQL' => 'postgres.exe'
                ];
                
                $processName = $processMap[$service] ?? strtolower($service) . '.exe';
                
                if ($action === 'start') {
                    // Try to find and start the executable
                    $exePaths = [
                        $laragonPath . '/bin/' . strtolower($service) . '/' . $processName,
                        $laragonPath . '/bin/' . strtolower($service) . '*/' . $processName
                    ];
                    $exeGlob = glob($laragonPath . '/bin/' . strtolower($service) . '*/' . $processName);
                    if (!empty($exeGlob)) {
                        $exePaths = array_merge($exePaths, $exeGlob);
                    }
                    
                    foreach ($exePaths as $exePath) {
                        if (file_exists($exePath)) {
                            $command = 'start /B "" "' . $exePath . '"';
                            break;
                        }
                    }
                } elseif ($action === 'stop') {
                    $command = 'taskkill /F /IM ' . $processName . ' 2>&1';
                } elseif ($action === 'restart') {
                    $command = 'taskkill /F /IM ' . $processName . ' 2>&1 && timeout /t 2 /nobreak >nul && start /B "" "' . ($exePaths[0] ?? '') . '"';
                }
            } else {
                if ($action === 'start') {
                    $command = "net start \"$serviceName\"";
                } elseif ($action === 'stop') {
                    $command = "net stop \"$serviceName\"";
                } elseif ($action === 'restart') {
                    $command = "net stop \"$serviceName\" && timeout /t 2 /nobreak >nul && net start \"$serviceName\"";
                }
            }
            
            if (!empty($command)) {
                $output = shell_exec($command . ' 2>&1');
                DashboardLogger::info("Service $action: $service", ['output' => $output]);
                
                // Wait a moment and check status
                sleep(1);
                $processServices = ['Mailpit', 'Nginx', 'Memcached', 'Redis', 'MongoDB', 'PostgreSQL'];
                if (in_array($service, $processServices)) {
                    $processMap = [
                        'Mailpit' => 'mailpit.exe',
                        'Nginx' => 'nginx.exe',
                        'Memcached' => 'memcached.exe',
                        'Redis' => 'redis-server.exe',
                        'MongoDB' => 'mongod.exe',
                        'PostgreSQL' => 'postgres.exe'
                    ];
                    $processName = $processMap[$service] ?? strtolower($service) . '.exe';
                    $newStatus = checkProcessRunning($processName) ? 'running' : 'stopped';
                } else {
                    $newStatus = checkServiceStatus($serviceName);
                }
                
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

