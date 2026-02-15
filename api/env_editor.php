<?php
/**
 * Laragon Dashboard - .env Editor API
 * Version: 1.0.0
 * Description: API for reading and writing project environment variables
 */

ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

if (function_exists('check_auth')) {
    check_auth();
}

header('Content-Type: application/json');

$action = $_GET['action'] ?? 'read';
$projectName = $_POST['project'] ?? ($_GET['project'] ?? '');

if (empty($projectName)) {
    ob_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Project name is required']);
    exit;
}

// Sanitize project name
$projectName = basename($projectName);

// Get project path
$laraconfig = getLaragonConfig();
$documentRoot = $laraconfig['DocumentRoot'] ?? (defined('LARAGON_ROOT') ? LARAGON_ROOT . '/www' : '');
$projectPath = rtrim($documentRoot, '/\\') . '/' . $projectName;
$envPath = $projectPath . '/.env';

try {
    if (!is_dir($projectPath)) throw new Exception('Project directory not found');

    switch ($action) {
        case 'read':
            if (!file_exists($envPath)) {
                // Return empty content if .env doesn't exist yet, or maybe a template
                $content = "";
                $exists = false;
            } else {
                $content = file_get_contents($envPath);
                $exists = true;
            }
            ob_clean();
            echo json_encode(['success' => true, 'content' => $content, 'path' => $envPath, 'exists' => $exists]);
            break;

        case 'save':
            if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
                throw new Exception('CSRF token validation failed');
            }
            
            $content = $_POST['content'] ?? null;
            if ($content === null) throw new Exception('No content provided');
            
            // Backup before saving if it exists
            if (file_exists($envPath)) {
                copy($envPath, $envPath . '.bak.' . time());
            }
            
            if (file_put_contents($envPath, $content) === false) {
                throw new Exception('Failed to write .env file. Check permissions.');
            }
            
            ob_clean();
            echo json_encode(['success' => true, 'message' => '.env file saved successfully.']);
            break;

        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

ob_end_flush();
