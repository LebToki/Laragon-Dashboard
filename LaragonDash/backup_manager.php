<?php
/**
 * Backup Manager API for Laragon Dashboard
 * Provides backup and export functionality for projects
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

// CSRF protection for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($csrfToken) || !SecurityHelper::validateCSRF($csrfToken)) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit;
    }
}

$action = $_GET['action'] ?? 'list';

try {
    $wwwPath = dirname(__DIR__);
    $backupDir = $wwwPath . '/../backups';
    
    // Ensure backup directory exists
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0755, true);
    }
    
    switch ($action) {
        case 'list':
            $backups = [];
            if (is_dir($backupDir)) {
                $files = glob($backupDir . '/*.zip');
                foreach ($files as $file) {
                    $backups[] = [
                        'name' => basename($file),
                        'date' => date('Y-m-d H:i:s', filemtime($file)),
                        'size' => formatBytes(filesize($file)),
                        'downloadUrl' => '../backups/' . basename($file)
                    ];
                }
                // Sort by date, newest first
                usort($backups, function($a, $b) {
                    return strtotime($b['date']) - strtotime($a['date']);
                });
            }
            
            echo json_encode([
                'success' => true,
                'backups' => $backups
            ]);
            break;
            
        case 'create':
            $projectName = $_POST['project_name'] ?? '';
            $databaseName = $_POST['database_name'] ?? '';
            $includeVendor = isset($_POST['include_vendor']) && $_POST['include_vendor'] === '1';
            $includeCache = isset($_POST['include_cache']) && $_POST['include_cache'] === '1';
            $compress = isset($_POST['compress']) && $_POST['compress'] === '1';
            
            if (empty($projectName)) {
                throw new Exception('Project name is required');
            }
            
            $projectPath = $wwwPath . '/' . $projectName;
            
            if (!is_dir($projectPath)) {
                throw new Exception('Project directory not found');
            }
            
            // Security: Only allow backups from www directory
            if (strpos(realpath($projectPath), realpath($wwwPath)) !== 0) {
                throw new Exception('Invalid project path');
            }
            
            $timestamp = date('Ymd-His');
            $backupFileName = $projectName . '-' . $timestamp . '.zip';
            $backupFilePath = $backupDir . '/' . $backupFileName;
            
            // Create temporary directory for backup
            $tempDir = sys_get_temp_dir() . '/laragon_backup_' . uniqid();
            mkdir($tempDir, 0755, true);
            
            // Copy project files
            $excludeDirs = [];
            if (!$includeVendor) {
                $excludeDirs[] = 'vendor';
                $excludeDirs[] = 'node_modules';
            }
            if (!$includeCache) {
                $excludeDirs[] = 'cache';
                $excludeDirs[] = 'storage/framework/cache';
                $excludeDirs[] = 'storage/framework/sessions';
                $excludeDirs[] = 'storage/framework/views';
            }
            
            copyDirectory($projectPath, $tempDir . '/files', $excludeDirs);
            
            // Backup database if specified
            if (!empty($databaseName)) {
                try {
                    $db = DatabaseHelper::getInstance();
                    if ($db->isConnected()) {
                        $dumpFile = $tempDir . '/' . $databaseName . '-dump.sql';
                        exportDatabase($db, $databaseName, $dumpFile);
                    }
                } catch (Exception $e) {
                    DashboardLogger::warning("Database backup failed: " . $e->getMessage());
                }
            }
            
            // Create ZIP archive
            if ($compress) {
                $zip = new ZipArchive();
                if ($zip->open($backupFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                    addDirectoryToZip($tempDir, $zip, '');
                    $zip->close();
                } else {
                    throw new Exception('Failed to create ZIP archive');
                }
                
                // Clean up temp directory
                deleteDirectory($tempDir);
            } else {
                // Just move the temp directory
                rename($tempDir, $backupFilePath);
            }
            
            DashboardLogger::info("Backup created", [
                'project' => $projectName,
                'file' => $backupFileName
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Backup created successfully',
                'file' => $backupFileName,
                'downloadUrl' => '../backups/' . $backupFileName
            ]);
            break;
            
        case 'delete':
            $fileName = $_POST['file_name'] ?? '';
            
            if (empty($fileName)) {
                throw new Exception('File name is required');
            }
            
            // Security: Only allow deletion of files in backup directory
            $filePath = $backupDir . '/' . basename($fileName);
            if (strpos(realpath($filePath), realpath($backupDir)) !== 0) {
                throw new Exception('Invalid file path');
            }
            
            if (file_exists($filePath)) {
                unlink($filePath);
                DashboardLogger::info("Backup deleted", ['file' => $fileName]);
                echo json_encode(['success' => true, 'message' => 'Backup deleted']);
            } else {
                throw new Exception('Backup file not found');
            }
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Backup Manager Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

function formatBytes($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . ' ' . $units[$pow];
}

function copyDirectory($source, $dest, $excludeDirs = []) {
    if (!is_dir($dest)) {
        mkdir($dest, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $path = $item->getPathname();
        $relativePath = str_replace($source . DIRECTORY_SEPARATOR, '', $path);
        
        // Check if path should be excluded
        $excluded = false;
        foreach ($excludeDirs as $excludeDir) {
            if (strpos($relativePath, $excludeDir) === 0) {
                $excluded = true;
                break;
            }
        }
        
        if ($excluded) {
            continue;
        }
        
        if ($item->isDir()) {
            $destPath = $dest . DIRECTORY_SEPARATOR . $relativePath;
            if (!is_dir($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            $destPath = $dest . DIRECTORY_SEPARATOR . $relativePath;
            copy($path, $destPath);
        }
    }
}

function addDirectoryToZip($dir, $zip, $zipPath) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        
        $filePath = $dir . '/' . $file;
        $zipFilePath = $zipPath . '/' . $file;
        
        if (is_dir($filePath)) {
            $zip->addEmptyDir($zipFilePath);
            addDirectoryToZip($filePath, $zip, $zipFilePath);
        } else {
            $zip->addFile($filePath, $zipFilePath);
        }
    }
}

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    rmdir($dir);
}

function exportDatabase($db, $databaseName, $outputFile) {
    $connection = $db->getConnection();
    $tables = $connection->query("SHOW TABLES FROM `" . str_replace('`', '``', $databaseName) . "`")->fetchAll(PDO::FETCH_COLUMN);
    
    $output = "-- Database dump for {$databaseName}\n";
    $output .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
    $output .= "USE `" . str_replace('`', '``', $databaseName) . "`;\n\n";
    
    foreach ($tables as $table) {
        $output .= "-- Table structure for `{$table}`\n";
        $createTable = $connection->query("SHOW CREATE TABLE `" . str_replace('`', '``', $databaseName) . "`.`" . str_replace('`', '``', $table) . "`")->fetch(PDO::FETCH_ASSOC);
        $output .= $createTable['Create Table'] . ";\n\n";
        
        $output .= "-- Data for table `{$table}`\n";
        $rows = $connection->query("SELECT * FROM `" . str_replace('`', '``', $databaseName) . "`.`" . str_replace('`', '``', $table) . "`")->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($rows) > 0) {
            $columns = array_keys($rows[0]);
            foreach ($rows as $row) {
                $values = array_map(function($val) use ($connection) {
                    return $val === null ? 'NULL' : $connection->quote($val);
                }, array_values($row));
                $output .= "INSERT INTO `{$table}` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $values) . ");\n";
            }
        }
        $output .= "\n";
    }
    
    file_put_contents($outputFile, $output);
}
?>

