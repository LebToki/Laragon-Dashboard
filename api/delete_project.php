<?php
/**
 * Laragon Dashboard - Delete Project API
 * Handles deletion of projects and their associated databases
 * Version: 3.1.0
 */

header('Content-Type: application/json');

// Load configuration
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

if (file_exists(__DIR__ . '/../includes/helpers.php')) {
    require_once __DIR__ . '/../includes/helpers.php';
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

// Get action
$action = $_POST['action'] ?? 'delete';

/**
 * Get database name from project
 * Tries to detect database name from wp-config.php, .env, or config files
 */
function getProjectDatabase($projectPath) {
    $databaseName = null;
    
    // Check for WordPress wp-config.php
    $wpConfig = $projectPath . '/wp-config.php';
    if (file_exists($wpConfig)) {
        $content = file_get_contents($wpConfig);
        if (preg_match("/define\s*\(\s*['\"]DB_NAME['\"]\s*,\s*['\"]([^'\"]+)['\"]/i", $content, $matches)) {
            $databaseName = $matches[1];
        }
    }
    
    // Check for .env file (Laravel, etc.)
    $envFile = $projectPath . '/.env';
    if (!$databaseName && file_exists($envFile)) {
        $content = file_get_contents($envFile);
        if (preg_match("/DB_DATABASE\s*=\s*([^\r\n]+)/i", $content, $matches)) {
            $databaseName = trim($matches[1]);
        }
    }
    
    // Check for config/database.php (Laravel)
    $dbConfig = $projectPath . '/config/database.php';
    if (!$databaseName && file_exists($dbConfig)) {
        $content = file_get_contents($dbConfig);
        if (preg_match("/'database'\s*=>\s*['\"]([^'\"]+)['\"]/i", $content, $matches)) {
            $databaseName = $matches[1];
        }
    }
    
    return $databaseName;
}

/**
 * Delete database
 */
function deleteDatabase($dbName) {
    try {
        // Sanitize database name
        $dbName = preg_replace('/[^a-zA-Z0-9_]/', '', $dbName);
        
        if (empty($dbName)) {
            throw new Exception('Invalid database name');
        }
        
        // Prevent deletion of system databases
        $systemDatabases = ['information_schema', 'mysql', 'performance_schema', 'sys', 'phpmyadmin'];
        if (in_array(strtolower($dbName), $systemDatabases)) {
            throw new Exception('Cannot delete system database');
        }
        
        // Get MySQL credentials
        $mysqlHost = defined('MYSQL_HOST') ? MYSQL_HOST : 'localhost';
        $mysqlUser = defined('MYSQL_USER') ? MYSQL_USER : 'root';
        $mysqlPassword = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';
        
        // Connect to MySQL
        $link = @mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword);
        
        if (!$link) {
            // Try without password
            $link = @mysqli_connect($mysqlHost, $mysqlUser, '');
        }
        
        if (!$link) {
            throw new Exception('Failed to connect to MySQL');
        }
        
        // Check if database exists
        $result = mysqli_query($link, "SHOW DATABASES LIKE '" . mysqli_real_escape_string($link, $dbName) . "'");
        if (mysqli_num_rows($result) === 0) {
            mysqli_close($link);
            return ['success' => true, 'message' => 'Database does not exist'];
        }
        
        // Drop database
        $query = "DROP DATABASE IF EXISTS `" . mysqli_real_escape_string($link, $dbName) . "`";
        if (!mysqli_query($link, $query)) {
            $error = mysqli_error($link);
            mysqli_close($link);
            throw new Exception('Failed to delete database: ' . $error);
        }
        
        mysqli_close($link);
        return ['success' => true, 'message' => 'Database deleted successfully'];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

/**
 * Delete project directory
 */
function deleteProjectDirectory($projectPath) {
    try {
        if (!is_dir($projectPath)) {
            return ['success' => true, 'message' => 'Project directory does not exist'];
        }
        
        // Use recursive directory deletion
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($projectPath, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        
        foreach ($files as $fileinfo) {
            $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
            @$todo($fileinfo->getRealPath());
        }
        
        @rmdir($projectPath);
        
        if (is_dir($projectPath)) {
            throw new Exception('Failed to delete project directory');
        }
        
        return ['success' => true, 'message' => 'Project directory deleted successfully'];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

/**
 * Main delete function
 */
function deleteProject($projectName, $createBackup = true, $deleteDatabase = true) {
    try {
        if (empty($projectName)) {
            throw new Exception('Project name is required');
        }
        
        // Sanitize project name
        $projectName = basename($projectName);
        $projectName = preg_replace('/[^a-zA-Z0-9_-]/', '', $projectName);
        
        if (empty($projectName)) {
            throw new Exception('Invalid project name');
        }
        
        // Get project path
        $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
        $documentRoot = defined('DOCUMENT_ROOT') ? DOCUMENT_ROOT : ($laragonRoot . '/www');
        $projectPath = rtrim($documentRoot, '/\\') . '/' . $projectName;
        
        if (!is_dir($projectPath)) {
            throw new Exception('Project directory not found');
        }
        
        $results = [
            'project' => $projectName,
            'backup_created' => false,
            'database_deleted' => false,
            'project_deleted' => false,
            'database_name' => null
        ];
        
        // Step 1: Detect database
        $databaseName = getProjectDatabase($projectPath);
        $results['database_name'] = $databaseName;
        
        // Step 2: Create backup if requested
        if ($createBackup) {
            try {
                // Include backup functions - need to handle the file carefully
                $backupFile = __DIR__ . '/backup.php';
                if (file_exists($backupFile)) {
                    // Read the file and extract just the function definitions
                    // We'll include it but suppress any output/headers
                    $oldOutputBuffering = ob_get_level();
                    if ($oldOutputBuffering > 0) {
                        ob_end_clean();
                    }
                    ob_start();
                    
                    // Temporarily override header function to prevent JSON corruption
                    $GLOBALS['_backup_include_mode'] = true;
                    include $backupFile;
                    unset($GLOBALS['_backup_include_mode']);
                    
                    $output = ob_get_clean();
                    if ($oldOutputBuffering > 0) {
                        ob_start();
                    }
                    
                    // Call createBackup function directly if available
                    if (function_exists('createBackup')) {
                        $backupResult = createBackup($projectName, $databaseName);
                        if ($backupResult && isset($backupResult['success']) && $backupResult['success']) {
                            $results['backup_created'] = true;
                            $results['backup_timestamp'] = $backupResult['timestamp'] ?? null;
                        }
                    }
                }
            } catch (Exception $e) {
                // Log error but continue with deletion
                error_log('Backup creation failed: ' . $e->getMessage());
            } catch (Throwable $e) {
                // Log error but continue with deletion
                error_log('Backup creation failed: ' . $e->getMessage());
            }
        }
        
        // Step 3: Delete database if requested and found
        if ($deleteDatabase && $databaseName) {
            $dbResult = deleteDatabase($databaseName);
            if ($dbResult['success']) {
                $results['database_deleted'] = true;
            } else {
                // Log error but continue with project deletion
                error_log('Database deletion failed: ' . ($dbResult['error'] ?? 'Unknown error'));
            }
        }
        
        // Step 4: Delete project directory
        $projectResult = deleteProjectDirectory($projectPath);
        if ($projectResult['success']) {
            $results['project_deleted'] = true;
        } else {
            throw new Exception('Failed to delete project: ' . ($projectResult['error'] ?? 'Unknown error'));
        }
        
        return [
            'success' => true,
            'message' => 'Project and database deleted successfully',
            'results' => $results
        ];
        
    } catch (Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

// Handle requests
try {
    switch ($action) {
        case 'delete':
            $projectName = $_POST['project'] ?? '';
            $createBackup = isset($_POST['backup']) ? (bool)$_POST['backup'] : true;
            $deleteDatabase = isset($_POST['delete_database']) ? (bool)$_POST['delete_database'] : true;
            
            if (empty($projectName)) {
                throw new Exception('Project name is required');
            }
            
            $result = deleteProject($projectName, $createBackup, $deleteDatabase);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'check_database':
            // Check if project has associated database
            $projectName = $_POST['project'] ?? '';
            
            if (empty($projectName)) {
                throw new Exception('Project name is required');
            }
            
            $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
            $documentRoot = defined('DOCUMENT_ROOT') ? DOCUMENT_ROOT : ($laragonRoot . '/www');
            $projectPath = rtrim($documentRoot, '/\\') . '/' . basename($projectName);
            
            $databaseName = null;
            if (is_dir($projectPath)) {
                $databaseName = getProjectDatabase($projectPath);
            }
            
            ob_clean();
            echo json_encode([
                'success' => true,
                'has_database' => !empty($databaseName),
                'database_name' => $databaseName
            ]);
            ob_end_flush();
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    ob_end_flush();
}

