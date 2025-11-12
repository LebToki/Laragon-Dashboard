<?php
/**
 * Self-Update Manager for Laragon Dashboard
 * Handles downloading and installing updates
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

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

$action = $_GET['action'] ?? 'check';

try {
    switch ($action) {
        case 'check':
            // Check for updates
            $currentVersion = APP_VERSION;
            $updateUrl = 'https://api.github.com/repos/LebToki/Laragon-Dashboard/releases/latest';
            
            $ch = curl_init($updateUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard/' . $currentVersion);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode === 200 && $response) {
                $data = json_decode($response, true);
                $latestVersion = ltrim($data['tag_name'] ?? 'v' . $currentVersion, 'v');
                $updateAvailable = version_compare($latestVersion, $currentVersion, '>');
                
                echo json_encode([
                    'success' => true,
                    'current_version' => $currentVersion,
                    'latest_version' => $latestVersion,
                    'update_available' => $updateAvailable,
                    'download_url' => $updateAvailable ? ($data['assets'][0]['browser_download_url'] ?? '') : ''
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'error' => 'Unable to check for updates'
                ]);
            }
            break;
            
        case 'download':
            $downloadUrl = $_POST['download_url'] ?? '';
            if (empty($downloadUrl)) {
                throw new Exception('Download URL is required');
            }
            
            $rootDir = dirname(__DIR__);
            $tempFile = $rootDir . '/laragon-dashboard-update.zip';
            
            // Download file with progress tracking
            $result = downloadFileWithProgress($downloadUrl, $tempFile);
            
            if ($result['success']) {
                echo json_encode([
                    'success' => true,
                    'file' => $tempFile,
                    'size' => filesize($tempFile)
                ]);
            } else {
                throw new Exception($result['error'] ?? 'Download failed');
            }
            break;
            
        case 'install':
            $zipFile = $_POST['zip_file'] ?? '';
            if (empty($zipFile) || !file_exists($zipFile)) {
                throw new Exception('Zip file not found');
            }
            
            $rootDir = dirname(__DIR__);
            $backupDir = $rootDir . '/backups/pre-update-' . date('Ymd-His');
            
            // Create backup
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0755, true);
            }
            
            // Backup current installation
            $laragonDashDir = $rootDir . '/LaragonDash';
            if (is_dir($laragonDashDir)) {
                copyDirectory($laragonDashDir, $backupDir . '/LaragonDash');
            }
            
            // Backup root index.php
            if (file_exists($rootDir . '/index.php')) {
                copy($rootDir . '/index.php', $backupDir . '/index.php');
            }
            
            // Extract zip to temp directory
            $tempDir = sys_get_temp_dir() . '/laragon-update-' . uniqid();
            mkdir($tempDir, 0755, true);
            
            $zip = new ZipArchive();
            if ($zip->open($zipFile) === TRUE) {
                $zip->extractTo($tempDir);
                $zip->close();
            } else {
                throw new Exception('Failed to extract zip file');
            }
            
            // Find LaragonDash folder in extracted files
            $extractedLaragonDash = null;
            $files = scandir($tempDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $path = $tempDir . '/' . $file;
                    if (is_dir($path) && $file === 'LaragonDash') {
                        $extractedLaragonDash = $path;
                        break;
                    } elseif (is_dir($path)) {
                        // Check if LaragonDash is inside
                        $innerPath = $path . '/LaragonDash';
                        if (is_dir($innerPath)) {
                            $extractedLaragonDash = $innerPath;
                            break;
                        }
                    }
                }
            }
            
            if (!$extractedLaragonDash) {
                throw new Exception('LaragonDash folder not found in update package');
            }
            
            // Remove old LaragonDash
            if (is_dir($laragonDashDir)) {
                deleteDirectory($laragonDashDir);
            }
            
            // Copy new LaragonDash
            copyDirectory($extractedLaragonDash, $laragonDashDir);
            
            // Update root index.php if it exists in the update
            $newIndexPath = $tempDir . '/index.php';
            if (file_exists($newIndexPath)) {
                copy($newIndexPath, $rootDir . '/index.php');
            }
            
            // Clean up
            deleteDirectory($tempDir);
            unlink($zipFile);
            
            DashboardLogger::info("Update installed successfully", [
                'backup' => $backupDir
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Update installed successfully',
                'backup_location' => $backupDir
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Update Manager Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

function downloadFileWithProgress($url, $destination) {
    $ch = curl_init($url);
    $fp = fopen($destination, 'w');
    
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard');
    curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, function($resource, $downloadSize, $downloaded, $uploadSize, $uploaded) {
        if ($downloadSize > 0) {
            $progress = round(($downloaded / $downloadSize) * 100, 2);
            // Store progress in session or file for AJAX polling
            $_SESSION['download_progress'] = $progress;
        }
    });
    curl_setopt($ch, CURLOPT_NOPROGRESS, false);
    
    $result = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    fclose($fp);
    
    if ($result && $httpCode === 200) {
        return ['success' => true];
    } else {
        if (file_exists($destination)) {
            unlink($destination);
        }
        return ['success' => false, 'error' => $error ?: 'HTTP ' . $httpCode];
    }
}

function copyDirectory($source, $dest) {
    if (!is_dir($dest)) {
        mkdir($dest, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $destPath = $dest . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($destPath)) {
                mkdir($destPath, 0755, true);
            }
        } else {
            copy($item, $destPath);
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
?>

