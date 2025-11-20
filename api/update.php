<?php
/**
 * Laragon Dashboard - Update API
 * Handles update checking, downloading, and installation
 * 
 * Version: 1.0.0
 */

// Start output buffering
ob_start();

// Disable error display to prevent JSON corruption
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Load configuration
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/UpdateManager.php';
require_once __DIR__ . '/../includes/ConfigMigrator.php';

// Clear any output
ob_clean();

// Set JSON header
header('Content-Type: application/json');

$action = $_GET['action'] ?? 'check';

try {
    $updateManager = new UpdateManager();
    
    switch ($action) {
        case 'check':
            $updateInfo = $updateManager->checkForUpdates();
            ob_clean();
            echo json_encode([
                'success' => true,
                'data' => $updateInfo
            ]);
            break;
            
        case 'backup':
            try {
                $backupPath = $updateManager->backupCurrentInstallation();
                ob_clean();
                echo json_encode([
                    'success' => true,
                    'message' => 'Backup created successfully',
                    'backup_path' => $backupPath
                ]);
            } catch (Exception $e) {
                error_log("Update API: Backup failed - " . $e->getMessage());
                throw $e;
            }
            break;
            
        case 'download':
            $downloadUrl = $_POST['download_url'] ?? $_GET['download_url'] ?? null;
            if (!$downloadUrl) {
                throw new Exception('Download URL required');
            }
            
            try {
                $zipPath = $updateManager->downloadUpdate($downloadUrl);
                ob_clean();
                echo json_encode([
                    'success' => true,
                    'message' => 'Update downloaded successfully',
                    'zip_path' => $zipPath
                ]);
            } catch (Exception $e) {
                error_log("Update API: Download failed - " . $e->getMessage());
                throw $e;
            }
            break;
            
        case 'install':
            $zipPath = $_POST['zip_path'] ?? $_GET['zip_path'] ?? null;
            $backupPath = $_POST['backup_path'] ?? $_GET['backup_path'] ?? null;
            
            if (!$zipPath) {
                throw new Exception('ZIP path is required');
            }
            
            if (!$backupPath) {
                throw new Exception('Backup path is required. Cannot install without backup.');
            }
            
            // Verify paths exist
            if (!file_exists($zipPath)) {
                throw new Exception('ZIP file not found: ' . $zipPath);
            }
            
            if (!is_dir($backupPath)) {
                throw new Exception('Backup directory not found: ' . $backupPath);
            }
            
            try {
                $result = $updateManager->installUpdate($zipPath, $backupPath);
                
                // Verify installation
                $verified = $updateManager->verifyInstallation();
                
                ob_clean();
                echo json_encode([
                    'success' => $result && $verified,
                    'message' => $verified ? 'Update installed successfully' : 'Update installed but verification failed',
                    'verified' => $verified
                ]);
            } catch (Exception $e) {
                error_log("Update API: Installation failed - " . $e->getMessage());
                throw $e;
            }
            break;
            
        case 'rollback':
            $backupPath = $_POST['backup_path'] ?? $_GET['backup_path'] ?? null;
            if (!$backupPath) {
                throw new Exception('Backup path required');
            }
            
            $result = $updateManager->rollback($backupPath);
            ob_clean();
            echo json_encode([
                'success' => $result,
                'message' => $result ? 'Rollback completed successfully' : 'Rollback failed'
            ]);
            break;
            
        case 'verify':
            $verified = $updateManager->verifyInstallation();
            ob_clean();
            echo json_encode([
                'success' => true,
                'verified' => $verified,
                'message' => $verified ? 'Installation verified' : 'Installation verification failed'
            ]);
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
} catch (Error $e) {
    ob_clean();
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

ob_end_flush();

