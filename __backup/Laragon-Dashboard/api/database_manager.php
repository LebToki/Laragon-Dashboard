<?php
/**
 * Application: Laragon | Database Management API
 * Description: Enhanced database operations with create/delete, user management, import/export
 * Version: 2.6.0
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/database.php';

header('Content-Type: application/json');

if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'list_databases';

try {
    switch ($action) {
        case 'list_databases':
            echo json_encode(listDatabases());
            break;
        case 'create_database':
            $dbName = $_POST['name'] ?? '';
            echo json_encode(createDatabase($dbName));
            break;
        case 'delete_database':
            $dbName = $_POST['name'] ?? '';
            echo json_encode(deleteDatabase($dbName));
            break;
        case 'list_tables':
            $dbName = $_GET['database'] ?? '';
            echo json_encode(listTables($dbName));
            break;
        case 'run_query':
            $dbName = $_POST['database'] ?? '';
            $query = $_POST['query'] ?? '';
            echo json_encode(runQuery($dbName, $query));
            break;
        case 'export_database':
            $dbName = $_GET['database'] ?? '';
            exportDatabase($dbName);
            break;
        case 'import_database':
            $dbName = $_POST['database'] ?? '';
            $file = $_FILES['file'] ?? null;
            echo json_encode(importDatabase($dbName, $file));
            break;
        default:
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function listDatabases() {
    $db = DatabaseHelper::getConnection();
    $stmt = $db->query("SHOW DATABASES");
    $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Filter out system databases
    $systemDbs = ['information_schema', 'performance_schema', 'mysql', 'sys'];
    $databases = array_filter($databases, function($db) use ($systemDbs) {
        return !in_array($db, $systemDbs);
    });
    
    $result = [];
    foreach ($databases as $dbName) {
        $size = getDatabaseSize($dbName);
        $result[] = [
            'name' => $dbName,
            'size' => $size
        ];
    }
    
    return ['success' => true, 'databases' => array_values($result)];
}

function createDatabase($dbName) {
    if (empty($dbName) || !preg_match('/^[a-zA-Z0-9_]+$/', $dbName)) {
        return ['success' => false, 'message' => 'Invalid database name'];
    }
    
    $db = DatabaseHelper::getConnection();
    $stmt = $db->prepare("CREATE DATABASE `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $stmt->execute();
    
    return ['success' => true, 'message' => 'Database created successfully'];
}

function deleteDatabase($dbName) {
    if (empty($dbName)) {
        return ['success' => false, 'message' => 'Database name required'];
    }
    
    $db = DatabaseHelper::getConnection();
    $stmt = $db->prepare("DROP DATABASE `{$dbName}`");
    $stmt->execute();
    
    return ['success' => true, 'message' => 'Database deleted successfully'];
}

function listTables($dbName) {
    if (empty($dbName)) {
        return ['success' => false, 'message' => 'Database name required'];
    }
    
    $db = DatabaseHelper::getConnection();
    $stmt = $db->query("USE `{$dbName}`");
    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $result = [];
    foreach ($tables as $table) {
        $size = getTableSize($dbName, $table);
        $rows = getTableRows($dbName, $table);
        $result[] = [
            'name' => $table,
            'rows' => $rows,
            'size' => $size
        ];
    }
    
    return ['success' => true, 'tables' => $result];
}

function runQuery($dbName, $query) {
    if (empty($dbName) || empty($query)) {
        return ['success' => false, 'message' => 'Database name and query required'];
    }
    
    // Security: Only allow SELECT, SHOW, DESCRIBE, EXPLAIN
    $allowedPrefixes = ['SELECT', 'SHOW', 'DESCRIBE', 'DESC', 'EXPLAIN'];
    $queryUpper = strtoupper(trim($query));
    $isAllowed = false;
    
    foreach ($allowedPrefixes as $prefix) {
        if (strpos($queryUpper, $prefix) === 0) {
            $isAllowed = true;
            break;
        }
    }
    
    if (!$isAllowed) {
        return ['success' => false, 'message' => 'Only SELECT, SHOW, DESCRIBE, and EXPLAIN queries are allowed'];
    }
    
    try {
        $db = DatabaseHelper::getConnection();
        $stmt = $db->prepare("USE `{$dbName}`");
        $stmt->execute();
        
        $stmt = $db->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return [
            'success' => true,
            'rows' => count($results),
            'data' => $results
        ];
    } catch (Exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
}

function exportDatabase($dbName) {
    if (empty($dbName)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Database name required']);
        exit;
    }
    
    $laragonRoot = getLaragonRoot();
    $mysqldump = $laragonRoot . '/bin/mysql/mysql-8.4.3/bin/mysqldump.exe';
    
    if (!file_exists($mysqldump)) {
        // Try to find any mysqldump
        $mysqlDir = $laragonRoot . '/bin/mysql';
        if (is_dir($mysqlDir)) {
            $dirs = scandir($mysqlDir);
            foreach ($dirs as $dir) {
                if ($dir !== '.' && $dir !== '..' && is_dir($mysqlDir . '/' . $dir)) {
                    $testPath = $mysqlDir . '/' . $dir . '/bin/mysqldump.exe';
                    if (file_exists($testPath)) {
                        $mysqldump = $testPath;
                        break;
                    }
                }
            }
        }
    }
    
    if (!file_exists($mysqldump)) {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'mysqldump not found']);
        exit;
    }
    
    $filename = $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';
    $filepath = sys_get_temp_dir() . '/' . $filename;
    
    $command = escapeshellarg($mysqldump) . ' -u root ' . escapeshellarg($dbName) . ' > ' . escapeshellarg($filepath) . ' 2>&1';
    exec($command, $output, $returnVar);
    
    if ($returnVar === 0 && file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        readfile($filepath);
        unlink($filepath);
        exit;
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Export failed: ' . implode("\n", $output)]);
        exit;
    }
}

function importDatabase($dbName, $file) {
    if (empty($dbName) || !$file || $file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Invalid file upload'];
    }
    
    $laragonRoot = getLaragonRoot();
    $mysql = $laragonRoot . '/bin/mysql/mysql-8.4.3/bin/mysql.exe';
    
    if (!file_exists($mysql)) {
        return ['success' => false, 'message' => 'MySQL client not found'];
    }
    
    $tmpFile = $file['tmp_name'];
    $command = escapeshellarg($mysql) . ' -u root ' . escapeshellarg($dbName) . ' < ' . escapeshellarg($tmpFile) . ' 2>&1';
    exec($command, $output, $returnVar);
    
    if ($returnVar === 0) {
        return ['success' => true, 'message' => 'Database imported successfully'];
    } else {
        return ['success' => false, 'message' => 'Import failed: ' . implode("\n", $output)];
    }
}

function getDatabaseSize($dbName) {
    $db = DatabaseHelper::getConnection();
    $stmt = $db->query("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS size_mb FROM information_schema.tables WHERE table_schema = '{$dbName}'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['size_mb'] ?? 0;
}

function getTableSize($dbName, $tableName) {
    $db = DatabaseHelper::getConnection();
    $stmt = $db->query("SELECT ROUND(((data_length + index_length) / 1024 / 1024), 2) AS size_mb FROM information_schema.tables WHERE table_schema = '{$dbName}' AND table_name = '{$tableName}'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['size_mb'] ?? 0;
}

function getTableRows($dbName, $tableName) {
    try {
        $db = DatabaseHelper::getConnection();
        $stmt = $db->prepare("USE `{$dbName}`");
        $stmt->execute();
        $stmt = $db->query("SELECT COUNT(*) as count FROM `{$tableName}`");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    } catch (Exception $e) {
        return 0;
    }
}

