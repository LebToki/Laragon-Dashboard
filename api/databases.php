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

        case 'get_tables':
            $database = $_GET['database'] ?? '';
            if (empty($database)) throw new Exception('Database name is required');
            
            $tables = \LaragonDashboard\Core\Databases::getTables($database);
            ob_clean();
            echo json_encode(['success' => true, 'data' => $tables]);
            break;

        case 'get_table_structure':
            $database = $_GET['database'] ?? '';
            $table = $_GET['table'] ?? '';
            if (empty($database)) throw new Exception('Database name is required');
            if (empty($table)) throw new Exception('Table name is required');
            
            $structure = \LaragonDashboard\Core\Databases::getTableStructure($database, $table);
            ob_clean();
            echo json_encode(['success' => true, 'data' => $structure]);
            break;

        case 'execute_query':
            // CSRF check for query execution
            $token = $_POST['csrf_token'] ?? '';
            if (!verifyCSRFToken($token)) {
                throw new Exception('CSRF token validation failed');
            }
            
            $database = $_POST['database'] ?? '';
            $query = trim($_POST['query'] ?? '');
            if (empty($database)) throw new Exception('Database name is required');
            if (empty($query)) throw new Exception('Query is required');
            
            // Only allow SELECT queries (read-only safety)
            $queryUpper = strtoupper(ltrim($query));
            if (!preg_match('/^(SELECT|SHOW|DESCRIBE|EXPLAIN)\s/i', $queryUpper)) {
                throw new Exception('Only SELECT, SHOW, DESCRIBE, and EXPLAIN queries are allowed (read-only mode)');
            }
            
            $result = \LaragonDashboard\Core\Databases::executeQuery($database, $query);
            ob_clean();
            echo json_encode($result);
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
