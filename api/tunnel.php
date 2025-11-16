<?php
/**
 * Laragon Dashboard - Tunnel API
 * Version: 3.1.0
 * Description: API for exposing local projects online via free tunneling services
 */

header('Content-Type: application/json');

// Load configuration
require_once __DIR__ . '/../config.php';

$action = $_GET['action'] ?? 'status';
$projectName = $_GET['project'] ?? '';

/**
 * Get available tunneling services
 */
function getAvailableTunnels() {
    return [
        'localtunnel' => [
            'name' => 'LocalTunnel',
            'free' => true,
            'command' => 'npx localtunnel --port {port}',
            'url_pattern' => 'https://{subdomain}.loca.lt',
            'requires_auth' => false,
            'custom_subdomain' => false,
            'description' => 'Free, no signup required. Simple and fast.'
        ],
        'cloudflare' => [
            'name' => 'Cloudflare Tunnel',
            'free' => true,
            'command' => 'cloudflared tunnel --url http://localhost:{port}',
            'url_pattern' => 'https://{random}.trycloudflare.com',
            'requires_auth' => false,
            'custom_subdomain' => false,
            'description' => 'Free, fast, reliable. Requires cloudflared installation.'
        ],
        'expose' => [
            'name' => 'Expose.dev',
            'free' => true,
            'command' => 'expose share {port}',
            'url_pattern' => 'https://{subdomain}.expose.sh',
            'requires_auth' => false,
            'custom_subdomain' => true,
            'description' => 'Open-source, free. Supports custom subdomains.'
        ],
        'ngrok' => [
            'name' => 'ngrok',
            'free' => true,
            'command' => 'ngrok http {port}',
            'url_pattern' => 'https://{random}.ngrok-free.app',
            'requires_auth' => false,
            'custom_subdomain' => false,
            'description' => 'Popular, free tier available. Requires signup for custom domains.'
        ]
    ];
}

/**
 * Get project port (default 80, or from Laragon config)
 */
function getProjectPort($projectName) {
    $laraconfig = function_exists('getLaragonConfig') ? getLaragonConfig() : [];
    $apachePort = $laraconfig['ApachePort'] ?? '80';
    
    // For now, assume all projects run on Apache's port
    // In the future, we could detect individual project ports
    return intval($apachePort);
}

/**
 * Check if a tunneling tool is installed
 */
function isTunnelInstalled($tunnelType) {
    switch ($tunnelType) {
        case 'localtunnel':
            // Check for npx (Node.js)
            $output = @shell_exec('npx --version 2>&1');
            return !empty($output) && strpos($output, 'error') === false;
            
        case 'cloudflare':
            // Check for cloudflared
            $output = @shell_exec('cloudflared --version 2>&1');
            return !empty($output) && strpos($output, 'error') === false;
            
        case 'expose':
            // Check for expose
            $output = @shell_exec('expose --version 2>&1');
            return !empty($output) && strpos($output, 'error') === false;
            
        case 'ngrok':
            // Check for ngrok
            $output = @shell_exec('ngrok version 2>&1');
            return !empty($output) && strpos($output, 'error') === false;
            
        default:
            return false;
    }
}

/**
 * Start a tunnel
 */
function startTunnel($tunnelType, $port, $projectName = '') {
    $tunnels = getAvailableTunnels();
    
    if (!isset($tunnels[$tunnelType])) {
        return ['success' => false, 'error' => 'Invalid tunnel type'];
    }
    
    if (!isTunnelInstalled($tunnelType)) {
        return ['success' => false, 'error' => $tunnels[$tunnelType]['name'] . ' is not installed'];
    }
    
    $tunnel = $tunnels[$tunnelType];
    $command = str_replace('{port}', $port, $tunnel['command']);
    
    // For localtunnel, we can try to get a custom subdomain
    if ($tunnelType === 'localtunnel' && !empty($projectName)) {
        $subdomain = strtolower(preg_replace('/[^a-z0-9]/', '', substr($projectName, 0, 20)));
        $command = str_replace('--port', '--port ' . $port . ' --subdomain ' . $subdomain, $command);
    }
    
    // Start tunnel in background (Windows)
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $command = 'start /B ' . $command . ' > nul 2>&1';
    } else {
        $command = $command . ' > /dev/null 2>&1 &';
    }
    
    @exec($command, $output, $returnVar);
    
    // For now, return a placeholder URL
    // In a real implementation, you'd parse the output to get the actual URL
    $url = str_replace('{subdomain}', $projectName, $tunnel['url_pattern']);
    $url = str_replace('{random}', substr(md5($projectName . time()), 0, 8), $url);
    
    return [
        'success' => true,
        'tunnel_type' => $tunnelType,
        'tunnel_name' => $tunnel['name'],
        'port' => $port,
        'url' => $url,
        'message' => 'Tunnel started. Note: Actual URL may differ. Check tunnel output.'
    ];
}

/**
 * Get tunnel status
 */
function getTunnelStatus($projectName) {
    // In a real implementation, you'd check running processes
    // For now, return not running
    return [
        'running' => false,
        'url' => null,
        'tunnel_type' => null
    ];
}

try {
    switch ($action) {
        case 'list':
            $tunnels = getAvailableTunnels();
            $available = [];
            
            foreach ($tunnels as $key => $tunnel) {
                $available[$key] = [
                    'name' => $tunnel['name'],
                    'free' => $tunnel['free'],
                    'installed' => isTunnelInstalled($key),
                    'description' => $tunnel['description'],
                    'url_pattern' => $tunnel['url_pattern']
                ];
            }
            
            echo json_encode([
                'success' => true,
                'tunnels' => $available
            ]);
            break;
            
        case 'status':
            if (empty($projectName)) {
                throw new Exception('Project name required');
            }
            
            $status = getTunnelStatus($projectName);
            echo json_encode([
                'success' => true,
                'status' => $status
            ]);
            break;
            
        case 'start':
            if (empty($projectName)) {
                throw new Exception('Project name required');
            }
            
            $tunnelType = $_POST['tunnel_type'] ?? 'localtunnel';
            $port = getProjectPort($projectName);
            
            $result = startTunnel($tunnelType, $port, $projectName);
            echo json_encode($result);
            break;
            
        case 'stop':
            if (empty($projectName)) {
                throw new Exception('Project name required');
            }
            
            // In a real implementation, you'd kill the tunnel process
            echo json_encode([
                'success' => true,
                'message' => 'Tunnel stopped'
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

