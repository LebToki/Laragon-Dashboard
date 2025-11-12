<?php
/**
 * Quick Tools API for Laragon Dashboard
 * Provides quick actions like cache clearing, composer commands, etc.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';
require_once __DIR__ . '/includes/database.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';

// CSRF protection for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($csrfToken) || !SecurityHelper::validateCSRF($csrfToken)) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit;
    }
}

function executeCommand($command, $workingDir = null) {
    $descriptorspec = [
        0 => ["pipe", "r"],
        1 => ["pipe", "w"],
        2 => ["pipe", "w"]
    ];
    
    $process = proc_open($command, $descriptorspec, $pipes, $workingDir);
    
    if (!is_resource($process)) {
        return ['success' => false, 'output' => 'Failed to execute command'];
    }
    
    $output = stream_get_contents($pipes[1]);
    $error = stream_get_contents($pipes[2]);
    
    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    
    $returnCode = proc_close($process);
    
    return [
        'success' => $returnCode === 0,
        'output' => $output,
        'error' => $error,
        'return_code' => $returnCode
    ];
}

try {
    switch ($action) {
        case 'clear_cache':
            $cacheDir = __DIR__ . '/cache';
            $cleared = [];
            
            if (is_dir($cacheDir)) {
                $files = glob($cacheDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                        $cleared[] = basename($file);
                    }
                }
            }
            
            // Clear Laravel cache if exists
            $laravelCache = __DIR__ . '/../*/storage/framework/cache';
            $laravelDirs = glob($laravelCache);
            foreach ($laravelDirs as $dir) {
                if (is_dir($dir)) {
                    $files = glob($dir . '/*');
                    foreach ($files as $file) {
                        if (is_file($file)) {
                            unlink($file);
                        }
                    }
                }
            }
            
            DashboardLogger::info("Cache cleared", ['files' => $cleared]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Cache cleared successfully',
                'cleared' => $cleared
            ]);
            break;
            
        case 'optimize_database':
            $db = DatabaseHelper::getInstance();
            if (!$db->isConnected()) {
                throw new Exception('Database not connected');
            }
            
            $database = $_POST['database'] ?? '';
            if (empty($database)) {
                throw new Exception('Database name required');
            }
            
            $tables = $db->getQueryResult("SHOW TABLES FROM `" . str_replace('`', '``', $database) . "`");
            $optimized = [];
            
            foreach ($tables as $table) {
                $tableName = array_values($table)[0];
                $result = $db->executeQuery("OPTIMIZE TABLE `" . str_replace('`', '``', $database) . "`.`" . str_replace('`', '``', $tableName) . "`");
                if ($result) {
                    $optimized[] = $tableName;
                }
            }
            
            echo json_encode([
                'success' => true,
                'message' => 'Database optimized successfully',
                'optimized_tables' => $optimized
            ]);
            break;
            
        case 'composer_command':
            $projectPath = $_POST['project_path'] ?? '';
            $command = $_POST['command'] ?? 'install';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            // Security: Only allow commands from www directory
            $wwwPath = dirname(__DIR__);
            if (strpos(realpath($projectPath), realpath($wwwPath)) !== 0) {
                throw new Exception('Invalid project path');
            }
            
            $allowedCommands = ['install', 'update', 'dump-autoload', 'clear-cache'];
            if (!in_array($command, $allowedCommands)) {
                throw new Exception('Command not allowed');
            }
            
            $fullCommand = "composer $command";
            $result = executeCommand($fullCommand, $projectPath);
            
            DashboardLogger::info("Composer command executed", [
                'project' => $projectPath,
                'command' => $command
            ]);
            
            echo json_encode($result);
            break;
            
        case 'npm_command':
            $projectPath = $_POST['project_path'] ?? '';
            $command = $_POST['command'] ?? 'install';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            // Security check
            $wwwPath = dirname(__DIR__);
            if (strpos(realpath($projectPath), realpath($wwwPath)) !== 0) {
                throw new Exception('Invalid project path');
            }
            
            $allowedCommands = ['install', 'update', 'run build', 'run dev', 'run prod'];
            if (!in_array($command, $allowedCommands)) {
                throw new Exception('Command not allowed');
            }
            
            $fullCommand = "npm $command";
            $result = executeCommand($fullCommand, $projectPath);
            
            DashboardLogger::info("NPM command executed", [
                'project' => $projectPath,
                'command' => $command
            ]);
            
            echo json_encode($result);
            break;
            
        case 'git_status':
            $projectPath = $_POST['project_path'] ?? $_GET['project_path'] ?? '';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            // Security check
            $wwwPath = dirname(__DIR__);
            if (strpos(realpath($projectPath), realpath($wwwPath)) !== 0) {
                throw new Exception('Invalid project path');
            }
            
            if (!is_dir($projectPath . '/.git')) {
                throw new Exception('Not a Git repository');
            }
            
            $result = executeCommand('git status', $projectPath);
            $branchResult = executeCommand('git branch --show-current', $projectPath);
            
            echo json_encode([
                'success' => $result['success'],
                'status' => $result['output'],
                'branch' => trim($branchResult['output']),
                'error' => $result['error']
            ]);
            break;
            
        case 'php_info':
            ob_start();
            phpinfo();
            $phpInfo = ob_get_clean();
            
            echo json_encode([
                'success' => true,
                'phpinfo' => $phpInfo
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Quick Tools Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

