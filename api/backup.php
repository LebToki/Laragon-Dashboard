<?php
/**
 * Laragon Dashboard - Backup API
 * Version: 3.0.0
 * Description: API endpoint for backup operations
 */

// Start output buffering to catch any stray output
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load configuration
require_once __DIR__ . '/../config.php';

// Clear any output that may have been generated
ob_clean();

// Set JSON header before any output (only if not included from another file)
if (!isset($GLOBALS['_backup_include_mode'])) {
    header('Content-Type: application/json');
}

$action = $_GET['action'] ?? 'list';

if (!defined('LARAGON_ROOT')) {
    ob_clean();
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Laragon root not defined']);
    ob_end_flush();
    exit;
}

// Get MySQL connection settings
$mysqlHost = defined('MYSQL_HOST') ? MYSQL_HOST : 'localhost';
$mysqlUser = defined('MYSQL_USER') ? MYSQL_USER : 'root';
$mysqlPassword = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';

// Find mysqldump.exe
function findMySQLDump() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return null;
    }
    
    $mysqlDirs = glob($laragonRoot . '/bin/mysql/mysql-*');
    if (empty($mysqlDirs)) {
        return null;
    }
    
    // Sort by modification time (most recent first)
    usort($mysqlDirs, function($a, $b) {
        return filemtime($b) - filemtime($a);
    });
    
    foreach ($mysqlDirs as $mysqlDir) {
        $mysqldump = $mysqlDir . '/bin/mysqldump.exe';
        if (file_exists($mysqldump)) {
            return $mysqldump;
        }
    }
    
    return null;
}

// Get list of databases
function getDatabaseList() {
    global $mysqlHost, $mysqlUser, $mysqlPassword;
    
    try {
        $link = @mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword);
        if (!$link) {
            return [];
        }
        
        $databases = [];
        $result = mysqli_query($link, "SHOW DATABASES");
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $dbName = $row[0];
                // Skip system databases
                if (!in_array($dbName, ['information_schema', 'performance_schema', 'mysql', 'sys'])) {
                    $databases[] = $dbName;
                }
            }
            mysqli_free_result($result);
        }
        mysqli_close($link);
        
        return $databases;
    } catch (Exception $e) {
        return [];
    }
}

// Get backup directory
function getBackupDirectory() {
    $backupDir = __DIR__ . '/../uploaded/backups';
    if (!is_dir($backupDir)) {
        @mkdir($backupDir, 0755, true);
    }
    return $backupDir;
}

// Create backup
function createBackup($projectName, $databaseName = null) {
    global $mysqlHost, $mysqlUser, $mysqlPassword;
    
    $backupDir = getBackupDirectory();
    $timestamp = date('Y-m-d_H-i-s');
    
    // Get project path
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    $documentRoot = defined('DOCUMENT_ROOT') ? DOCUMENT_ROOT : ($laragonRoot . '/www');
    
    $projectPath = rtrim($documentRoot, '/') . '/' . $projectName;
    
    if (!is_dir($projectPath)) {
        return ['success' => false, 'error' => 'Project directory not found'];
    }
    
    $backupBaseName = $projectName . '_' . $timestamp;
    $backupBasePath = $backupDir . '/' . $backupBaseName;
    
    // Create project ZIP
    $projectZip = $backupBasePath . '_project.zip';
    $zip = new ZipArchive();
    if ($zip->open($projectZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
        return ['success' => false, 'error' => 'Cannot create project ZIP file'];
    }
    
    // Add project files to ZIP
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($projectPath),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    
    foreach ($files as $file) {
        if (!$file->isDir()) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($projectPath) + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }
    
    $zip->close();
    
    // Create database dump if database is specified
    $dbZip = null;
    if (!empty($databaseName)) {
        $mysqldump = findMySQLDump();
        if (!$mysqldump) {
            return ['success' => false, 'error' => 'mysqldump.exe not found'];
        }
        
        $sqlFile = $backupBasePath . '_database.sql';
        
        // Build mysqldump command with proper password handling
        // Note: -p flag must not have space between flag and password
        $command = escapeshellarg($mysqldump);
        $command .= ' -h ' . escapeshellarg($mysqlHost);
        $command .= ' -u ' . escapeshellarg($mysqlUser);
        if (!empty($mysqlPassword)) {
            // No space between -p and password
            $command .= ' -p' . escapeshellarg($mysqlPassword);
        }
        // If password is empty, omit -p flag (MySQL will use empty password by default)
        $command .= ' ' . escapeshellarg($databaseName);
        $command .= ' > ' . escapeshellarg($sqlFile) . ' 2>&1';
        
        @exec($command, $output, $returnVar);
        
        if ($returnVar === 0 && file_exists($sqlFile)) {
            // Create database ZIP
            $dbZip = $backupBasePath . '_database.zip';
            $zip = new ZipArchive();
            if ($zip->open($dbZip, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                $zip->addFile($sqlFile, basename($sqlFile));
                $zip->close();
                @unlink($sqlFile); // Remove SQL file after zipping
            }
        }
    }
    
    return [
        'success' => true,
        'project' => $projectName,
        'database' => $databaseName,
        'timestamp' => $timestamp,
        'project_zip' => basename($projectZip),
        'database_zip' => $dbZip ? basename($dbZip) : null,
        'project_size' => filesize($projectZip),
        'database_size' => $dbZip ? filesize($dbZip) : 0
    ];
}

// List backups
function listBackups() {
    $backupDir = getBackupDirectory();
    $backups = [];
    
    if (!is_dir($backupDir)) {
        return $backups;
    }
    
    $files = glob($backupDir . '/*_project.zip');
    
    foreach ($files as $file) {
        $basename = basename($file, '_project.zip');
        $parts = explode('_', $basename);
        
        if (count($parts) >= 2) {
            $timestamp = array_pop($parts);
            $projectName = implode('_', $parts);
            
            $dbZip = $backupDir . '/' . $basename . '_database.zip';
            
            $backup = [
                'project' => $projectName,
                'timestamp' => $timestamp,
                'project_zip' => basename($file),
                'database_zip' => file_exists($dbZip) ? basename($dbZip) : null,
                'project_size' => filesize($file),
                'database_size' => file_exists($dbZip) ? filesize($dbZip) : 0,
                'created' => filemtime($file)
            ];
            
            $backups[] = $backup;
        }
    }
    
    // Sort by creation time (newest first)
    usort($backups, function($a, $b) {
        return $b['created'] - $a['created'];
    });
    
    return $backups;
}

// Delete backup
function deleteBackup($projectName, $timestamp) {
    $backupDir = getBackupDirectory();
    $backupBaseName = $projectName . '_' . $timestamp;
    
    $projectZip = $backupDir . '/' . $backupBaseName . '_project.zip';
    $dbZip = $backupDir . '/' . $backupBaseName . '_database.zip';
    
    $deleted = [];
    
    if (file_exists($projectZip)) {
        @unlink($projectZip);
        $deleted[] = 'project';
    }
    
    if (file_exists($dbZip)) {
        @unlink($dbZip);
        $deleted[] = 'database';
    }
    
    return ['success' => !empty($deleted), 'deleted' => $deleted];
}

// Handle requests (only if not included from another file)
if (!isset($GLOBALS['_backup_include_mode'])) {
try {
    switch ($action) {
        case 'list':
            $backups = listBackups();
            ob_clean();
            echo json_encode([
                'success' => true,
                'backups' => $backups
            ]);
            ob_end_flush();
            break;
            
        case 'create':
            $projectName = $_POST['project'] ?? '';
            $databaseName = $_POST['database'] ?? null;
            
            if (empty($projectName)) {
                throw new Exception('Project name required');
            }
            
            $result = createBackup($projectName, $databaseName);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'delete':
            $projectName = $_POST['project'] ?? '';
            $timestamp = $_POST['timestamp'] ?? '';
            
            if (empty($projectName) || empty($timestamp)) {
                throw new Exception('Project name and timestamp required');
            }
            
            $result = deleteBackup($projectName, $timestamp);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'databases':
            $databases = getDatabaseList();
            ob_clean();
            echo json_encode([
                'success' => true,
                'databases' => $databases
            ]);
            ob_end_flush();
            break;
            
        case 'refresh':
            // Refresh/recreate backup
            $projectName = $_POST['project'] ?? '';
            $timestamp = $_POST['timestamp'] ?? '';
            $databaseName = $_POST['database'] ?? null;
            
            if (empty($projectName) || empty($timestamp)) {
                throw new Exception('Project name and timestamp required');
            }
            
            // Delete old backup first
            deleteBackup($projectName, $timestamp);
            
            // Create new backup
            $result = createBackup($projectName, $databaseName);
            ob_clean();
            echo json_encode($result);
            ob_end_flush();
            break;
            
        case 'download_project':
            $projectName = $_GET['project'] ?? '';
            $timestamp = $_GET['timestamp'] ?? '';
            
            if (empty($projectName) || empty($timestamp)) {
                throw new Exception('Project name and timestamp required');
            }
            
            $backupDir = getBackupDirectory();
            $backupBaseName = $projectName . '_' . $timestamp;
            $projectZip = $backupDir . '/' . $backupBaseName . '_project.zip';
            
            if (!file_exists($projectZip)) {
                throw new Exception('Backup file not found');
            }
            
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($projectZip) . '"');
            header('Content-Length: ' . filesize($projectZip));
            ob_clean();
            readfile($projectZip);
            ob_end_flush();
            exit;
            
        case 'download_database':
            $projectName = $_GET['project'] ?? '';
            $timestamp = $_GET['timestamp'] ?? '';
            
            if (empty($projectName) || empty($timestamp)) {
                throw new Exception('Project name and timestamp required');
            }
            
            $backupDir = getBackupDirectory();
            $backupBaseName = $projectName . '_' . $timestamp;
            $dbZip = $backupDir . '/' . $backupBaseName . '_database.zip';
            
            if (!file_exists($dbZip)) {
                throw new Exception('Database backup file not found');
            }
            
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($dbZip) . '"');
            header('Content-Length: ' . filesize($dbZip));
            ob_clean();
            readfile($dbZip);
            ob_end_flush();
            exit;
            
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
} // End of request handling (only if not included)

