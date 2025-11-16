<?php
/**
 * Laragon Dashboard - Mailpit API Proxy
 * Version: 3.0.0
 * Description: Proxy endpoint for Mailpit API to avoid CORS issues
 */

// Load configuration
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Mailpit API configuration
// Try to get Mailpit port from Laragon config
$laraconfig = function_exists('getLaragonConfig') ? getLaragonConfig() : [];
$mailpitHttpPort = $laraconfig['MailpitHTTPPort'] ?? '8025';
$mailpitApiUrl = 'http://localhost:' . $mailpitHttpPort . '/api/v1';

$action = $_GET['action'] ?? 'messages';
$messageId = $_GET['id'] ?? '';

// Check if Mailpit is running
function checkMailpitRunning() {
    global $mailpitApiUrl;
    $ch = curl_init($mailpitApiUrl . '/messages?limit=1');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpCode === 200;
}

if (!$mailpitRunning = checkMailpitRunning()) {
    http_response_code(503);
    echo json_encode([
        'success' => false,
        'error' => 'Mailpit is not running',
        'message' => 'Please start Mailpit from Laragon\'s service manager'
    ]);
    exit;
}

try {
    $url = '';
    
    switch ($action) {
        case 'messages':
            $limit = $_GET['limit'] ?? 50;
            $start = $_GET['start'] ?? 0;
            $query = $_GET['query'] ?? '';
            
            $url = $mailpitApiUrl . '/messages?limit=' . intval($limit) . '&start=' . intval($start);
            if (!empty($query)) {
                $url .= '&query=' . urlencode($query);
            }
            break;
            
        case 'message':
            if (empty($messageId)) {
                throw new Exception('Message ID required');
            }
            $url = $mailpitApiUrl . '/message/' . urlencode($messageId);
            break;
            
        case 'delete':
            if (empty($messageId)) {
                throw new Exception('Message ID required');
            }
            $url = $mailpitApiUrl . '/message/' . urlencode($messageId);
            $method = 'DELETE';
            break;
            
        case 'search':
            $query = $_GET['query'] ?? '';
            if (empty($query)) {
                throw new Exception('Search query required');
            }
            $url = $mailpitApiUrl . '/search?query=' . urlencode($query);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
    // Make request to Mailpit API
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    if (isset($method) && $method === 'DELETE') {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        throw new Exception('CURL Error: ' . $error);
    }
    
    if ($httpCode !== 200) {
        http_response_code($httpCode);
        echo json_encode([
            'success' => false,
            'error' => 'Mailpit API error',
            'http_code' => $httpCode,
            'response' => substr($response, 0, 200) // Include first 200 chars for debugging
        ]);
        exit;
    }
    
    // Decode and re-encode to ensure valid JSON and add debugging info
    $decoded = json_decode($response, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        // If response is not valid JSON, return error
        throw new Exception('Invalid JSON response from Mailpit: ' . json_last_error_msg() . '. Response: ' . substr($response, 0, 200));
    }
    
    // For messages action, ensure we have the expected structure
    if ($action === 'messages') {
        // Mailpit API returns: { "total": X, "messages": [...] }
        // Ensure messages array exists even if empty
        if (!isset($decoded['messages'])) {
            $decoded['messages'] = [];
        }
        if (!isset($decoded['total'])) {
            $decoded['total'] = count($decoded['messages']);
        }
    }
    
    // Return the properly formatted response
    echo json_encode($decoded);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

