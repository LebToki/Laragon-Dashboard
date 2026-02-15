<?php
/**
 * Laragon Dashboard - Tools API
 * Version: 3.0.0
 * Description: API endpoint for development tools (Composer, NPM, Git, Cache, PHP Info)
 */

// Start output buffering to catch any stray output
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load configuration
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

// Clear any output that may have been generated
ob_clean();

// Set JSON header before any output
header('Content-Type: application/json');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

if (!defined('LARAGON_ROOT')) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Laragon root not defined']);
    ob_end_flush();
    exit;
}

// Get document root
$documentRoot = defined('DOCUMENT_ROOT') ? DOCUMENT_ROOT : (defined('LARAGON_ROOT') ? LARAGON_ROOT . '/www' : '');

// Find Composer executable
function findComposer() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return 'composer'; // Try global composer
    }
    
    // Check Laragon's composer location
    $composerPath = $laragonRoot . '/bin/composer/composer.phar';
    if (file_exists($composerPath)) {
        return escapeshellarg($composerPath);
    }
    
    // Try global composer
    return 'composer';
}

// Find NPM executable
function findNPM() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return 'npm'; // Try global npm
    }
    
    // Check Laragon's Node.js location
    $nodeDirs = glob($laragonRoot . '/bin/nodejs/node-*');
    if (!empty($nodeDirs)) {
        usort($nodeDirs, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $npmPath = $nodeDirs[0] . '/npm.cmd';
        if (file_exists($npmPath)) {
            return escapeshellarg($npmPath);
        }
    }
    
    // Try global npm
    return 'npm';
}

// Find Git executable
function findGit() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return 'git'; // Try global git
    }
    
    // Check Laragon's Git location
    $gitPath = $laragonRoot . '/bin/git/cmd/git.exe';
    if (file_exists($gitPath)) {
        return escapeshellarg($gitPath);
    }
    
    // Try global git
    return 'git';
}

// Execute command in project directory
function executeCommand($command, $projectPath, $timeout = 300) {
    if (empty($projectPath) || !is_dir($projectPath)) {
        return ['success' => false, 'error' => 'Invalid project path'];
    }
    
    $oldCwd = getcwd();
    chdir($projectPath);
    
    // Execute command with timeout
    $descriptorspec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w']
    ];
    
    $process = proc_open($command, $descriptorspec, $pipes);
    
    if (!is_resource($process)) {
        chdir($oldCwd);
        return ['success' => false, 'error' => 'Failed to execute command'];
    }
    
    // Set timeout
    $startTime = time();
    $output = '';
    $error = '';
    
    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);
    
    while (true) {
        $read = [$pipes[1], $pipes[2]];
        $write = null;
        $except = null;
        
        $changed = stream_select($read, $write, $except, 1);
        
        if ($changed > 0) {
            foreach ($read as $pipe) {
                if ($pipe === $pipes[1]) {
                    $output .= fread($pipe, 8192);
                } elseif ($pipe === $pipes[2]) {
                    $error .= fread($pipe, 8192);
                }
            }
        }
        
        $status = proc_get_status($process);
        if (!$status['running']) {
            break;
        }
        
        if ((time() - $startTime) > $timeout) {
            proc_terminate($process);
            chdir($oldCwd);
            return ['success' => false, 'error' => 'Command timeout'];
        }
    }
    
    // Read remaining output
    $output .= stream_get_contents($pipes[1]);
    $error .= stream_get_contents($pipes[2]);
    
    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    
    $returnCode = proc_close($process);
    chdir($oldCwd);
    
    return [
        'success' => $returnCode === 0,
        'output' => $output,
        'error' => $error,
        'return_code' => $returnCode
    ];
}

// Handle requests
try {
    switch ($action) {
        case 'composer':
            $projectPath = $_POST['project'] ?? '';
            $command = $_POST['command'] ?? 'install';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            $fullPath = rtrim($documentRoot, '/') . '/' . ltrim($projectPath, '/');
            $composer = findComposer();
            
            $allowedCommands = ['install', 'update', 'dump-autoload', 'clear-cache', 'require', 'remove'];
            if (!in_array($command, $allowedCommands)) {
                throw new Exception('Invalid composer command');
            }
            
            $cmd = $composer . ' ' . $command;
            if ($command === 'require' && isset($_POST['package'])) {
                $cmd .= ' ' . escapeshellarg($_POST['package']);
            } elseif ($command === 'remove' && isset($_POST['package'])) {
                $cmd .= ' ' . escapeshellarg($_POST['package']);
            }
            
            $result = executeCommand($cmd, $fullPath);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'npm':
            $projectPath = $_POST['project'] ?? '';
            $command = $_POST['command'] ?? 'install';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            $fullPath = rtrim($documentRoot, '/') . '/' . ltrim($projectPath, '/');
            $npm = findNPM();
            
            $allowedCommands = ['install', 'update', 'run', 'build', 'dev', 'prod'];
            if (!in_array($command, $allowedCommands)) {
                throw new Exception('Invalid npm command');
            }
            
            $cmd = $npm . ' ' . $command;
            if ($command === 'run' && isset($_POST['script'])) {
                $cmd .= ' ' . escapeshellarg($_POST['script']);
            }
            
            $result = executeCommand($cmd, $fullPath);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'git':
            $projectPath = $_POST['project'] ?? '';
            $command = $_POST['command'] ?? 'status';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            $fullPath = rtrim($documentRoot, '/') . '/' . ltrim($projectPath, '/');
            
            if (!is_dir($fullPath . '/.git')) {
                throw new Exception('Not a Git repository');
            }
            
            $git = findGit();
            $allowedCommands = ['status', 'branch', 'log', 'pull', 'push', 'fetch'];
            if (!in_array($command, $allowedCommands)) {
                throw new Exception('Invalid git command');
            }
            
            $cmd = $git . ' ' . $command;
            if ($command === 'log' && isset($_POST['limit'])) {
                $cmd .= ' -' . intval($_POST['limit']);
            }
            
            $result = executeCommand($cmd, $fullPath);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'clear_cache':
            $projectPath = $_POST['project'] ?? '';
            $cacheType = $_POST['type'] ?? 'all';
            
            if (empty($projectPath)) {
                throw new Exception('Project path required');
            }
            
            $fullPath = rtrim($documentRoot, '/') . '/' . ltrim($projectPath, '/');
            $cleared = [];
            
            // Laravel cache
            if ($cacheType === 'all' || $cacheType === 'laravel') {
                $cachePaths = [
                    $fullPath . '/bootstrap/cache',
                    $fullPath . '/storage/framework/cache',
                    $fullPath . '/storage/framework/views',
                    $fullPath . '/storage/framework/sessions'
                ];
                
                foreach ($cachePaths as $cachePath) {
                    if (is_dir($cachePath)) {
                        $files = glob($cachePath . '/*');
                        foreach ($files as $file) {
                            if (is_file($file) && basename($file) !== '.gitignore') {
                                @unlink($file);
                            }
                        }
                        $cleared[] = basename($cachePath);
                    }
                }
            }
            
            // WordPress cache
            if ($cacheType === 'all' || $cacheType === 'wordpress') {
                $wpCachePath = $fullPath . '/wp-content/cache';
                if (is_dir($wpCachePath)) {
                    $files = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator($wpCachePath, RecursiveDirectoryIterator::SKIP_DOTS),
                        RecursiveIteratorIterator::CHILD_FIRST
                    );
                    
                    foreach ($files as $file) {
                        if ($file->isDir()) {
                            @rmdir($file->getRealPath());
                        } else {
                            @unlink($file->getRealPath());
                        }
                    }
                    $cleared[] = 'wordpress';
                }
            }
            
            ob_clean();
            echo json_encode([
                'success' => true,
                'cleared' => $cleared,
                'message' => 'Cache cleared: ' . implode(', ', $cleared)
            ]);
            ob_end_flush();
            break;
            
        case 'php_info':
            ob_start();
            phpinfo();
            $phpinfo = ob_get_clean();
            
            ob_clean();
            echo json_encode([
                'success' => true,
                'phpinfo' => $phpinfo
            ]);
            ob_end_flush();
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    ob_end_flush();
} catch (Error $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
    ob_end_flush();
}

