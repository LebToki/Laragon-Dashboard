<?php
/**
 * Laragon Dashboard - Preferences API
 * Version: 3.0.0
 * Description: API endpoint for dashboard preferences
 */

// Load configuration
require_once __DIR__ . '/../config.php';

header('Content-Type: application/json');

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
            
            $prefs = [
                'laragon_root' => $input['laragon_root'] ?? '',
                'mysql_host' => $input['mysql_host'] ?? '',
                'mysql_user' => $input['mysql_user'] ?? '',
                'mysql_password' => $input['mysql_password'] ?? ''
            ];
            
            // Remove empty values
            $prefs = array_filter($prefs, function($value) {
                return $value !== '';
            });
            
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

