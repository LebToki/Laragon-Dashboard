<?php
/**
 * Laragon Dashboard - Databases API
 * Version: 1.0.0
 * Description: API endpoint for managing MySQL databases
 */

// Start output buffering
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Load configuration and helpers
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

// Set JSON header
header('Content-Type: application/json');

$action = $_GET['action'] ?? 'list';

try {
    // CSRF check for destructive actions
    $destructiveActions = ['create', 'delete'];
    if (in_array($action, $destructiveActions)) {
        $token = $_POST['csrf_token'] ?? '';
        if (!verifyCSRFToken($token)) {
            throw new Exception('CSRF token validation failed');
        }
    }

    switch ($action) {
        case 'list':
            $databases = \LaragonDashboard\Core\Databases::list();
            ob_clean();
            echo json_encode(['success' => true, 'data' => $databases]);
            break;

        case 'create':
            $name = $_POST['name'] ?? '';
            if (empty($name)) throw new Exception('Database name is required');
            
            $result = \LaragonDashboard\Core\Databases::create($name);
            ob_clean();
            echo json_encode(['success' => $result, 'message' => $result ? 'Database created' : 'Failed to create database']);
            break;

        case 'delete':
            $name = $_POST['name'] ?? '';
            if (empty($name)) throw new Exception('Database name is required');
            
            $result = \LaragonDashboard\Core\Databases::drop($name);
            ob_clean();
            echo json_encode(['success' => $result, 'message' => $result ? 'Database deleted' : 'Failed to delete database']);
            break;

        case 'backup':
            $name = $_POST['name'] ?? ($_GET['name'] ?? '');
            if (empty($name)) throw new Exception('Database name is required');
            
            $result = \LaragonDashboard\Core\Databases::backup($name);
            ob_clean();
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Backup created: ' . $result['filename'], 'data' => $result]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to create database backup']);
            }
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
