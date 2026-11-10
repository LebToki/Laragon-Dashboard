<?php
/**
 * Laragon Dashboard - Preferences API
 * Version: 3.0.0
 * Description: API endpoint for dashboard preferences
 */

// Load configuration
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

// Preferences are a write endpoint: refuse anything that is not a POST so a
// page load, prefetch or crawler cannot rewrite them.
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$csrfToken = $_POST['csrf_token']
    ?? $_SERVER['HTTP_X_CSRF_TOKEN']
    ?? (json_decode(file_get_contents('php://input'), true)['csrf_token'] ?? '');
if (!function_exists('verifyCSRFToken') || !verifyCSRFToken($csrfToken)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'CSRF token validation failed']);
    exit;
}

$action = $_GET['action'] ?? 'save';

if (!function_exists('getDashboardPreferences') || !function_exists('saveDashboardPreferences')) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Preferences functions not available']);
    exit;
}

try {
    switch ($action) {
        case 'save':
            $input = json_decode(file_get_contents('php://input'), true);
            if (!is_array($input) || empty($input)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'error' => 'Empty or invalid preferences payload']);
                exit;
            }
            
            $prefs = [];
            
            // Only include provided values
            if (isset($input['laragon_root'])) {
                $path = trim($input['laragon_root']);
                if (!empty($path)) {
                    $normalizedPath = rtrim(str_replace('\\', '/', $path), '/');
                    if (!is_dir($normalizedPath)) {
                        echo json_encode(['success' => false, 'error' => 'Invalid Laragon Root Path: Directory does not exist']);
                        exit;
                    }
                    $prefs['laragon_root'] = $normalizedPath;
                } else {
                    $prefs['laragon_root'] = null; // Revert to auto-detect
                }
            }
            if (isset($input['mysql_host'])) {
                $prefs['mysql_host'] = $input['mysql_host'];
            }
            if (isset($input['mysql_user'])) {
                $prefs['mysql_user'] = $input['mysql_user'];
            }
            if (isset($input['mysql_password'])) {
                $prefs['mysql_password'] = $input['mysql_password'];
            }
            // Handle checkbox fields - explicitly process them even when set to '0' to allow unsetting
            if (isset($input['auto_update_check'])) {
                $prefs['auto_update_check'] = $input['auto_update_check'] == '1';
            }
            if (isset($input['auto_update_install'])) {
                $prefs['auto_update_install'] = $input['auto_update_install'] == '1';
            }
            if (isset($input['debug_banner'])) {
                $prefs['debug_banner'] = $input['debug_banner'] == '1';
            }
            if (isset($input['last_update_check'])) {
                $prefs['last_update_check'] = $input['last_update_check'];
            }
            if (isset($input['time_format'])) {
                $prefs['time_format'] = $input['time_format'] === '' ? null : $input['time_format'];
            }
            if (isset($input['date_format'])) {
                $prefs['date_format'] = $input['date_format'] === '' ? null : $input['date_format'];
            }
            
            $result = saveDashboardPreferences($prefs);
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Preferences saved successfully' : 'Failed to save preferences'
            ]);
            break;
            
        case 'reset':
            // Delete preferences file
            $prefsFile = __DIR__ . '/../data/preferences.json';
            if (file_exists($prefsFile)) {
                unlink($prefsFile);
            }
            echo json_encode([
                'success' => true,
                'message' => 'Preferences reset successfully'
            ]);
            break;
            
        case 'get':
            $prefs = getDashboardPreferences();
            echo json_encode([
                'success' => true,
                'preferences' => $prefs
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

