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
            // Check for updates using Git
            $currentVersion = APP_VERSION;
            $rootDir = dirname(__DIR__);
            $gitDir = $rootDir . '/.git';
            
            // Check if this is a git repository
            if (!is_dir($gitDir)) {
                echo json_encode([
                    'success' => false,
                    'error' => 'Not a Git repository'
                ]);
                break;
            }
            
            // Fetch latest from remote
            $output = [];
            $returnCode = 0;
            chdir($rootDir);
            exec('git fetch origin 2>&1', $output, $returnCode);
            
            // Get current branch
            $currentBranch = trim(shell_exec('git rev-parse --abbrev-ref HEAD 2>&1'));
            
            // Get local and remote commit hashes
            $localCommit = trim(shell_exec('git rev-parse HEAD 2>&1'));
            $remoteCommit = trim(shell_exec('git rev-parse origin/' . $currentBranch . ' 2>&1'));
            
            // Get version from git tag or config
            $latestTag = trim(shell_exec('git describe --tags --abbrev=0 origin/' . $currentBranch . ' 2>&1'));
            $latestVersion = $latestTag ? ltrim($latestTag, 'v') : $currentVersion;
            
            // Check if update is available (local != remote)
            $updateAvailable = ($localCommit !== $remoteCommit && !empty($remoteCommit) && strpos($remoteCommit, 'fatal') === false);
            
            // If versions are the same but commits differ, still show update
            if ($updateAvailable && $latestVersion === $currentVersion) {
                $latestVersion = 'dev-' . substr($remoteCommit, 0, 7);
            }
            
            echo json_encode([
                'success' => true,
                'current_version' => $currentVersion,
                'latest_version' => $latestVersion,
                'update_available' => $updateAvailable,
                'current_commit' => substr($localCommit, 0, 7),
                'latest_commit' => substr($remoteCommit, 0, 7),
                'branch' => $currentBranch
            ]);
            break;
            
        case 'install':
            // Install update using Git pull
            $rootDir = dirname(__DIR__);
            $gitDir = $rootDir . '/.git';
            
            if (!is_dir($gitDir)) {
                throw new Exception('Not a Git repository');
            }
            
            // Create backup before updating
            $backupDir = $rootDir . '/backups/pre-update-' . date('Ymd-His');
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
            
            // Change to root directory and pull updates
            chdir($rootDir);
            
            // Get current branch
            $currentBranch = trim(shell_exec('git rev-parse --abbrev-ref HEAD 2>&1'));
            
            // Stash any local changes
            exec('git stash 2>&1', $stashOutput, $stashCode);
            
            // Pull latest changes
            $output = [];
            $returnCode = 0;
            exec('git pull origin ' . escapeshellarg($currentBranch) . ' 2>&1', $output, $returnCode);
            
            // Restore stashed changes if any
            if ($stashCode === 0) {
                exec('git stash pop 2>&1', $stashPopOutput, $stashPopCode);
            }
            
            if ($returnCode !== 0) {
                throw new Exception('Git pull failed: ' . implode("\n", $output));
            }
            
            DashboardLogger::info("Update installed successfully via Git", [
                'backup' => $backupDir,
                'branch' => $currentBranch,
                'output' => implode("\n", $output)
            ]);
            
            echo json_encode([
                'success' => true,
                'message' => 'Update installed successfully via Git pull',
                'backup_location' => $backupDir,
                'branch' => $currentBranch
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

