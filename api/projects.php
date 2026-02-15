<?php
/**
 * Laragon Dashboard - Projects API
 * Version: 3.1.0
 * Description: API for project management operations
 */

header('Content-Type: application/json');

// Load configuration
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// CSRF check for destructive actions
if ($action === 'ignore' || $action === 'unignore') {
    $token = $_POST['csrf_token'] ?? ($_GET['csrf_token'] ?? '');
    if (!verifyCSRFToken($token)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'error' => 'CSRF token validation failed']);
        exit;
    }
}

/**
 * Get ignored projects list
 */
function getIgnoredProjects() {
    $prefs = function_exists('getDashboardPreferences') ? getDashboardPreferences() : [];
    return $prefs['ignored_projects'] ?? [];
}

/**
 * Save ignored projects list
 */
function saveIgnoredProjects($ignoredProjects) {
    if (!function_exists('getDashboardPreferences')) {
        return false;
    }
    
    $prefs = getDashboardPreferences();
    $prefs['ignored_projects'] = $ignoredProjects;
    
    // Save preferences
    $prefsFile = __DIR__ . '/../data/preferences.json';
    $prefsDir = dirname($prefsFile);
    
    if (!is_dir($prefsDir)) {
        @mkdir($prefsDir, 0755, true);
    }
    
    return @file_put_contents($prefsFile, json_encode($prefs, JSON_PRETTY_PRINT)) !== false;
}

try {
    switch ($action) {
        case 'ignore':
            $projectName = $_POST['project'] ?? '';
            
            if (empty($projectName)) {
                throw new Exception('Project name is required');
            }
            
            $ignoredProjects = getIgnoredProjects();
            
            // Add to ignored list if not already there
            if (!in_array($projectName, $ignoredProjects)) {
                $ignoredProjects[] = $projectName;
                
                if (saveIgnoredProjects($ignoredProjects)) {
                    echo json_encode([
                        'success' => true,
                        'message' => 'Project ignored successfully',
                        'ignored_projects' => $ignoredProjects
                    ]);
                } else {
                    throw new Exception('Failed to save ignored projects list');
                }
            } else {
                echo json_encode([
                    'success' => true,
                    'message' => 'Project is already ignored',
                    'ignored_projects' => $ignoredProjects
                ]);
            }
            break;
            
        case 'unignore':
            $projectName = $_POST['project'] ?? '';
            
            if (empty($projectName)) {
                throw new Exception('Project name is required');
            }
            
            $ignoredProjects = getIgnoredProjects();
            
            // Remove from ignored list
            $ignoredProjects = array_values(array_filter($ignoredProjects, function($item) use ($projectName) {
                return $item !== $projectName;
            }));
            
            if (saveIgnoredProjects($ignoredProjects)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Project unignored successfully',
                    'ignored_projects' => $ignoredProjects
                ]);
            } else {
                throw new Exception('Failed to save ignored projects list');
            }
            break;
            
        case 'list_ignored':
            $ignoredProjects = getIgnoredProjects();
            echo json_encode([
                'success' => true,
                'ignored_projects' => $ignoredProjects
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

