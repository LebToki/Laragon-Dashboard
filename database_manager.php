<?php
/**
 * Database Manager API for Laragon Dashboard
 * Provides database browsing and query execution
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/database.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'list_databases';

try {
    $db = DatabaseHelper::getInstance();
    
    if (!$db->isConnected()) {
        throw new Exception('Database connection failed');
    }
    
    switch ($action) {
        case 'list_databases':
            $databases = $db->getDatabases();
            // Filter out system databases
            $databases = array_filter($databases, function($db) {
                return !in_array($db, ['information_schema', 'performance_schema', 'mysql', 'sys']);
            });
            echo json_encode([
                'success' => true,
                'databases' => array_values($databases)
            ]);
            break;
            
        case 'get_tables':
            $database = $_GET['database'] ?? '';
            if (empty($database)) {
                throw new Exception('Database name required');
            }
            
            $stmt = $db->getConnection()->prepare("SELECT TABLE_NAME, TABLE_ROWS, DATA_LENGTH, INDEX_LENGTH, CREATE_TIME 
                                                    FROM information_schema.TABLES 
                                                    WHERE TABLE_SCHEMA = ? 
                                                    ORDER BY TABLE_NAME");
            $stmt->execute([$database]);
            $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'tables' => $tables
            ]);
            break;
            
        case 'get_table_structure':
            $database = $_GET['database'] ?? '';
            $table = $_GET['table'] ?? '';
            
            if (empty($database) || empty($table)) {
                throw new Exception('Database and table name required');
            }
            
            $stmt = $db->getConnection()->prepare("SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_KEY, COLUMN_DEFAULT, EXTRA
                                                    FROM information_schema.COLUMNS 
                                                    WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ?
                                                    ORDER BY ORDINAL_POSITION");
            $stmt->execute([$database, $table]);
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'columns' => $columns
            ]);
            break;
            
        case 'get_table_data':
            $database = $_GET['database'] ?? '';
            $table = $_GET['table'] ?? '';
            $limit = (int)($_GET['limit'] ?? 100);
            $offset = (int)($_GET['offset'] ?? 0);
            
            if (empty($database) || empty($table)) {
                throw new Exception('Database and table name required');
            }
            
            // Use the database
            $db->getConnection()->exec("USE `" . str_replace('`', '``', $database) . "`");
            
            $stmt = $db->getConnection()->prepare("SELECT COUNT(*) as total FROM `" . str_replace('`', '``', $table) . "`");
            $stmt->execute();
            $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            $stmt = $db->getConnection()->prepare("SELECT * FROM `" . str_replace('`', '``', $table) . "` LIMIT ? OFFSET ?");
            $stmt->execute([$limit, $offset]);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'data' => $data,
                'total' => $total,
                'limit' => $limit,
                'offset' => $offset
            ]);
            break;
            
        case 'execute_query':
            $query = $_POST['query'] ?? '';
            if (empty($query)) {
                throw new Exception('Query is required');
            }
            
            // Security: Only allow SELECT queries for safety
            $queryUpper = trim(strtoupper($query));
            if (strpos($queryUpper, 'SELECT') !== 0 && 
                strpos($queryUpper, 'SHOW') !== 0 && 
                strpos($queryUpper, 'DESCRIBE') !== 0 &&
                strpos($queryUpper, 'EXPLAIN') !== 0) {
                throw new Exception('Only SELECT, SHOW, DESCRIBE, and EXPLAIN queries are allowed');
            }
            
            $stmt = $db->getConnection()->query($query);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'results' => $results,
                'row_count' => count($results)
            ]);
            break;
            
        case 'get_database_size':
            $database = $_GET['database'] ?? '';
            if (empty($database)) {
                throw new Exception('Database name required');
            }
            
            $stmt = $db->getConnection()->prepare("SELECT 
                ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb
                FROM information_schema.tables 
                WHERE table_schema = ?");
            $stmt->execute([$database]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => true,
                'size_mb' => $result['size_mb'] ?? 0
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Database Manager Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

