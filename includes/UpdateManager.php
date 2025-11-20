<?php
/**
 * Laragon Dashboard - Update Manager
 * Handles automatic updates from GitHub while preserving user configuration
 * 
 * Version: 1.1.0
 * Enhanced with better error handling, logging, and version detection
 */

if (!class_exists('UpdateManager')) {
    class UpdateManager {
        private $appRoot;
        private $backupDir;
        private $tempDir;
        private $githubRepo = 'LebToki/Laragon-Dashboard';
        private $githubApiUrl = 'https://api.github.com/repos';
        
        public function __construct() {
            $this->appRoot = defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__);
            $this->backupDir = $this->appRoot . '/backups';
            $this->tempDir = $this->appRoot . '/temp/update';
            
            // Create directories if they don't exist
            if (!is_dir($this->backupDir)) {
                @mkdir($this->backupDir, 0755, true);
            }
            if (!is_dir($this->tempDir)) {
                @mkdir($this->tempDir, 0755, true);
            }
        }
        
        /**
         * Check for available updates from GitHub
         * 
         * @return array Update information or false if no update available
         */
        public function checkForUpdates() {
            // Use getAppVersion() if available, otherwise fall back to APP_VERSION constant
            if (function_exists('getAppVersion')) {
                $currentVersion = getAppVersion();
            } else {
                $currentVersion = defined('APP_VERSION') ? APP_VERSION : '3.0.0';
            }
            
            try {
                $url = "{$this->githubApiUrl}/{$this->githubRepo}/releases/latest";
                $release = $this->fetchFromGitHub($url);
                
                if (!$release) {
                    error_log("UpdateManager: Failed to fetch release information from GitHub");
                    return ['available' => false, 'error' => 'Failed to fetch release information'];
                }
                
                $latestVersion = $this->normalizeVersion($release['tag_name']);
                $currentVersionNormalized = $this->normalizeVersion($currentVersion);
                
                // Skip update check if current version is a dev version (starts with 'dev-')
                if (strpos($currentVersionNormalized, 'dev-') === 0) {
                    error_log("UpdateManager: Skipping update check for dev version: {$currentVersionNormalized}");
                    return ['available' => false, 'current_version' => $currentVersion, 'latest_version' => $release['tag_name'], 'dev_version' => true];
                }
                
                $updateAvailable = version_compare($latestVersion, $currentVersionNormalized, '>');
                
                if ($updateAvailable) {
                    // Find ZIP asset
                    $zipAsset = null;
                    foreach ($release['assets'] as $asset) {
                        if (strpos($asset['name'], '.zip') !== false) {
                            $zipAsset = $asset;
                            break;
                        }
                    }
                    
                    return [
                        'available' => true,
                        'current_version' => $currentVersion,
                        'latest_version' => $release['tag_name'],
                        'version' => $release['tag_name'],
                        'name' => $release['name'],
                        'body' => $release['body'],
                        'published_at' => $release['published_at'],
                        'download_url' => $zipAsset ? $zipAsset['browser_download_url'] : null,
                        'download_size' => $zipAsset ? $zipAsset['size'] : 0,
                        'release_url' => $release['html_url']
                    ];
                }
                
                return ['available' => false, 'current_version' => $currentVersion, 'latest_version' => $release['tag_name']];
            } catch (Exception $e) {
                return ['available' => false, 'error' => $e->getMessage()];
            }
        }
        
        /**
         * Create backup of current installation
         * 
         * @return string Backup directory path
         */
        public function backupCurrentInstallation() {
            $timestamp = date('Y-m-d_His');
            // Use getAppVersion() if available, otherwise fall back to APP_VERSION constant
            if (function_exists('getAppVersion')) {
                $currentVersion = getAppVersion();
            } else {
                $currentVersion = defined('APP_VERSION') ? APP_VERSION : '3.0.0';
            }
            $backupName = "{$timestamp}_v{$currentVersion}";
            $backupPath = $this->backupDir . '/' . $backupName;
            
            error_log("UpdateManager: Creating backup: {$backupPath}");
            
            if (!is_dir($backupPath)) {
                @mkdir($backupPath, 0755, true);
            }
            
            // Files to backup
            $filesToBackup = [
                'config.php',
                'data/preferences.json',
                'data/license.json', // If exists
            ];
            
            $backedUpFiles = [];
            
            foreach ($filesToBackup as $file) {
                $sourcePath = $this->appRoot . '/' . $file;
                if (file_exists($sourcePath)) {
                    $destPath = $backupPath . '/' . basename($file) . '.backup';
                    if (@copy($sourcePath, $destPath)) {
                        $backedUpFiles[] = [
                            'path' => $file,
                            'backup_path' => $destPath,
                            'checksum' => md5_file($sourcePath)
                        ];
                    }
                }
            }
            
            // Create manifest
            $manifest = [
                'version' => $currentVersion,
                'timestamp' => date('c'),
                'backup_name' => $backupName,
                'files' => $backedUpFiles,
                'config_keys' => $this->extractConfigKeys()
            ];
            
            $manifestPath = $backupPath . '/manifest.json';
            if (@file_put_contents($manifestPath, json_encode($manifest, JSON_PRETTY_PRINT)) === false) {
                error_log("UpdateManager: Failed to write manifest file: {$manifestPath}");
                throw new Exception('Failed to create backup manifest');
            }
            
            error_log("UpdateManager: Backup created successfully: {$backupPath}");
            return $backupPath;
        }
        
        /**
         * Download update package
         * 
         * @param string $downloadUrl Download URL from GitHub
         * @return string Path to downloaded ZIP file
         */
        public function downloadUpdate($downloadUrl) {
            if (empty($downloadUrl)) {
                throw new Exception('Download URL is required');
            }
            
            $zipPath = $this->tempDir . '/update.zip';
            
            // Clean up any existing update file
            if (file_exists($zipPath)) {
                @unlink($zipPath);
            }
            
            error_log("UpdateManager: Downloading update from: {$downloadUrl}");
            
            // Download file
            $ch = curl_init($downloadUrl);
            $fp = fopen($zipPath, 'wb');
            if (!$fp) {
                curl_close($ch);
                throw new Exception("Failed to create temporary file for download");
            }
            
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard-Updater/1.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 5 minutes
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            
            $success = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            fclose($fp);
            
            if (!$success || $httpCode !== 200) {
                @unlink($zipPath);
                $errorMsg = $error ?: "HTTP {$httpCode}";
                error_log("UpdateManager: Download failed: {$errorMsg}");
                throw new Exception("Failed to download update: {$errorMsg}");
            }
            
            // Verify file was downloaded and has content
            if (!file_exists($zipPath) || filesize($zipPath) === 0) {
                @unlink($zipPath);
                throw new Exception("Downloaded file is empty or invalid");
            }
            
            error_log("UpdateManager: Download completed successfully: " . filesize($zipPath) . " bytes");
            return $zipPath;
        }
        
        /**
         * Install downloaded update
         * 
         * @param string $zipPath Path to downloaded ZIP file
         * @param string $backupPath Path to backup directory
         * @return bool Success status
         */
        public function installUpdate($zipPath, $backupPath) {
            if (empty($zipPath) || !file_exists($zipPath)) {
                throw new Exception('Update package not found');
            }
            
            if (empty($backupPath) || !is_dir($backupPath)) {
                throw new Exception('Backup directory not found. Cannot proceed without backup.');
            }
            
            error_log("UpdateManager: Starting installation. ZIP: {$zipPath}, Backup: {$backupPath}");
            
            $extractPath = $this->tempDir . '/extracted';
            
            // Clean extract directory
            if (is_dir($extractPath)) {
                $this->deleteDirectory($extractPath);
            }
            if (!@mkdir($extractPath, 0755, true)) {
                throw new Exception('Failed to create extraction directory');
            }
            
            // Extract ZIP
            error_log("UpdateManager: Extracting ZIP file...");
            $zip = new ZipArchive();
            $zipResult = $zip->open($zipPath);
            if ($zipResult !== true) {
                $errorMsg = "Failed to open ZIP file (code: {$zipResult})";
                error_log("UpdateManager: {$errorMsg}");
                throw new Exception($errorMsg);
            }
            
            if (!$zip->extractTo($extractPath)) {
                $zip->close();
                throw new Exception('Failed to extract update package');
            }
            $zip->close();
            error_log("UpdateManager: ZIP extracted successfully");
            
            // Find the actual dashboard directory in extracted files
            $dashboardPath = $this->findDashboardDirectory($extractPath);
            
            if (!$dashboardPath || !file_exists($dashboardPath . '/config.php')) {
                $this->deleteDirectory($extractPath);
                throw new Exception('Could not find dashboard directory in update package');
            }
            
            error_log("UpdateManager: Dashboard directory found: {$dashboardPath}");
            
            // Migrate configuration before replacing files
            try {
                error_log("UpdateManager: Migrating configuration...");
                $configMigrator = new ConfigMigrator();
                $configMigrator->migrateConfiguration($backupPath, $dashboardPath);
                error_log("UpdateManager: Configuration migrated successfully");
            } catch (Exception $e) {
                error_log("UpdateManager: Configuration migration failed: " . $e->getMessage());
                // Don't fail the update if migration fails, but log it
            }
            
            // Files/directories to preserve (user data)
            $preservePaths = [
                'data/preferences.json',
                'data/license.json',
                'data/backups/',
                'backups/',
                'logs/',
                'temp/',
            ];
            
            // Replace files while preserving user data
            error_log("UpdateManager: Replacing files...");
            $this->replaceFiles($dashboardPath, $preservePaths);
            error_log("UpdateManager: Files replaced successfully");
            
            // Clean up
            $this->deleteDirectory($extractPath);
            @unlink($zipPath);
            
            error_log("UpdateManager: Installation completed successfully");
            return true;
        }
        
        /**
         * Rollback to previous version
         * 
         * @param string $backupPath Path to backup directory
         * @return bool Success status
         */
        public function rollback($backupPath) {
            if (empty($backupPath) || !is_dir($backupPath)) {
                throw new Exception('Backup directory not found: ' . $backupPath);
            }
            
            $manifestPath = $backupPath . '/manifest.json';
            if (!file_exists($manifestPath)) {
                throw new Exception('Backup manifest not found: ' . $manifestPath);
            }
            
            error_log("UpdateManager: Starting rollback from backup: {$backupPath}");
            
            $manifestContent = @file_get_contents($manifestPath);
            if (!$manifestContent) {
                throw new Exception('Failed to read backup manifest');
            }
            
            $manifest = json_decode($manifestContent, true);
            if (!is_array($manifest) || !isset($manifest['files'])) {
                throw new Exception('Invalid backup manifest format');
            }
            
            $restoredFiles = [];
            $failedFiles = [];
            
            // Restore backed up files
            foreach ($manifest['files'] as $file) {
                if (!isset($file['backup_path']) || !isset($file['path'])) {
                    error_log("UpdateManager: Invalid file entry in manifest: " . json_encode($file));
                    continue;
                }
                
                $sourcePath = $file['backup_path'];
                $destPath = $this->appRoot . '/' . $file['path'];
                
                if (!file_exists($sourcePath)) {
                    error_log("UpdateManager: Backup file not found: {$sourcePath}");
                    $failedFiles[] = $file['path'];
                    continue;
                }
                
                $destDir = dirname($destPath);
                if (!is_dir($destDir)) {
                    if (!@mkdir($destDir, 0755, true)) {
                        error_log("UpdateManager: Failed to create directory: {$destDir}");
                        $failedFiles[] = $file['path'];
                        continue;
                    }
                }
                
                if (!@copy($sourcePath, $destPath)) {
                    error_log("UpdateManager: Failed to restore file: {$destPath}");
                    $failedFiles[] = $file['path'];
                    continue;
                }
                
                $restoredFiles[] = $file['path'];
            }
            
            if (!empty($failedFiles)) {
                error_log("UpdateManager: Rollback completed with errors. Failed files: " . implode(', ', $failedFiles));
                throw new Exception('Rollback completed but some files failed to restore: ' . implode(', ', $failedFiles));
            }
            
            error_log("UpdateManager: Rollback completed successfully. Restored " . count($restoredFiles) . " files");
            return true;
        }
        
        /**
         * Verify installation after update
         * 
         * @return bool Verification status
         */
        public function verifyInstallation() {
            error_log("UpdateManager: Verifying installation...");
            
            // Check if config.php loads without errors
            try {
                // Check critical files exist
                $criticalFiles = [
                    'config.php',
                    'index.php',
                    'includes/helpers.php'
                ];
                
                foreach ($criticalFiles as $file) {
                    $filePath = $this->appRoot . '/' . $file;
                    if (!file_exists($filePath)) {
                        error_log("UpdateManager: Critical file missing: {$file}");
                        return false;
                    }
                }
                
                // Try to load config
                if (!defined('APP_ROOT')) {
                    require_once $this->appRoot . '/config.php';
                }
                
                // Test critical functions
                $criticalFunctions = [
                    'getLaragonRoot',
                    'getDashboardPreferences',
                    'saveDashboardPreferences'
                ];
                
                foreach ($criticalFunctions as $func) {
                    if (!function_exists($func)) {
                        error_log("UpdateManager: Critical function missing: {$func}");
                        return false;
                    }
                }
                
                // Verify config values are preserved (preferences should still exist)
                try {
                    $prefs = getDashboardPreferences();
                    if ($prefs === null) {
                        error_log("UpdateManager: Preferences could not be loaded");
                        return false;
                    }
                } catch (Exception $e) {
                    error_log("UpdateManager: Error loading preferences: " . $e->getMessage());
                    return false;
                }
                
                error_log("UpdateManager: Installation verified successfully");
                return true;
            } catch (Exception $e) {
                error_log("UpdateManager: Verification failed: " . $e->getMessage());
                return false;
            } catch (Error $e) {
                error_log("UpdateManager: Verification error: " . $e->getMessage());
                return false;
            }
        }
        
        /**
         * Extract configuration keys from current config
         * 
         * @return array List of config keys
         */
        private function extractConfigKeys() {
            $keys = [];
            
            // Extract from config.php
            $configPath = $this->appRoot . '/config.php';
            if (file_exists($configPath)) {
                $content = file_get_contents($configPath);
                preg_match_all('/define\s*\(\s*[\'"](\w+)[\'"]/', $content, $matches);
                if (!empty($matches[1])) {
                    $keys = array_merge($keys, $matches[1]);
                }
            }
            
            // Extract from preferences.json
            $prefsPath = $this->appRoot . '/data/preferences.json';
            if (file_exists($prefsPath)) {
                $prefs = json_decode(file_get_contents($prefsPath), true);
                if (is_array($prefs)) {
                    $keys = array_merge($keys, array_keys($prefs));
                }
            }
            
            return array_unique($keys);
        }
        
        /**
         * Fetch data from GitHub API
         */
        private function fetchFromGitHub($url) {
            if (empty($url)) {
                error_log("UpdateManager: Empty URL provided to fetchFromGitHub");
                return false;
            }
            
            error_log("UpdateManager: Fetching from GitHub API: {$url}");
            
            $ch = curl_init($url);
            if (!$ch) {
                error_log("UpdateManager: Failed to initialize cURL");
                return false;
            }
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard/1.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($httpCode !== 200) {
                $errorMsg = $error ?: "HTTP {$httpCode}";
                error_log("UpdateManager: GitHub API request failed: {$errorMsg}");
                return false;
            }
            
            if ($response === false) {
                error_log("UpdateManager: Failed to fetch response from GitHub API");
                return false;
            }
            
            $data = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                error_log("UpdateManager: Failed to decode JSON response: " . json_last_error_msg());
                return false;
            }
            
            return $data;
        }
        
        /**
         * Normalize version string for comparison
         */
        private function normalizeVersion($version) {
            // Remove 'v' prefix if present
            $version = ltrim($version, 'vV');
            
            // Handle dev versions (e.g., "dev-abc123" or "3.1.4-dev")
            if (strpos($version, 'dev-') === 0) {
                // Extract base version if possible (e.g., "3.1.4-dev-abc123" -> "3.1.4")
                if (preg_match('/^(\d+\.\d+\.\d+)/', $version, $matches)) {
                    return $matches[1];
                }
                return $version; // Return as-is if no base version found
            }
            
            // Remove any dev suffix (e.g., "3.1.4-dev" -> "3.1.4")
            $version = preg_replace('/-dev.*$/', '', $version);
            
            return $version;
        }
        
        /**
         * Find dashboard directory in extracted files
         */
        private function findDashboardDirectory($extractPath) {
            // Check if root is the dashboard
            if (file_exists($extractPath . '/config.php')) {
                return $extractPath;
            }
            
            // Look for Laragon-Dashboard directory
            $dirs = glob($extractPath . '/*', GLOB_ONLYDIR);
            foreach ($dirs as $dir) {
                if (file_exists($dir . '/config.php')) {
                    return $dir;
                }
            }
            
            return null;
        }
        
        /**
         * Replace files while preserving user data
         */
        private function replaceFiles($sourcePath, $preservePaths) {
            if (!is_dir($sourcePath)) {
                throw new Exception('Source path is not a directory: ' . $sourcePath);
            }
            
            $replacedCount = 0;
            $skippedCount = 0;
            $errorCount = 0;
            
            try {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::SELF_FIRST
                );
                
                foreach ($iterator as $item) {
                    $relativePath = str_replace($sourcePath . DIRECTORY_SEPARATOR, '', $item->getPathname());
                    $relativePath = str_replace('\\', '/', $relativePath); // Normalize path separators
                    
                    // Skip preserved paths
                    $shouldPreserve = false;
                    foreach ($preservePaths as $preservePath) {
                        $preservePath = str_replace('\\', '/', $preservePath);
                        if (strpos($relativePath, $preservePath) === 0) {
                            $shouldPreserve = true;
                            $skippedCount++;
                            break;
                        }
                    }
                    
                    if ($shouldPreserve) {
                        continue;
                    }
                    
                    $destPath = $this->appRoot . '/' . $relativePath;
                    
                    try {
                        if ($item->isDir()) {
                            if (!is_dir($destPath)) {
                                if (!@mkdir($destPath, 0755, true)) {
                                    error_log("UpdateManager: Failed to create directory: {$destPath}");
                                    $errorCount++;
                                }
                            }
                        } else {
                            $destDir = dirname($destPath);
                            if (!is_dir($destDir)) {
                                if (!@mkdir($destDir, 0755, true)) {
                                    error_log("UpdateManager: Failed to create directory: {$destDir}");
                                    $errorCount++;
                                    continue;
                                }
                            }
                            
                            if (!@copy($item->getPathname(), $destPath)) {
                                error_log("UpdateManager: Failed to copy file: {$relativePath}");
                                $errorCount++;
                            } else {
                                $replacedCount++;
                            }
                        }
                    } catch (Exception $e) {
                        error_log("UpdateManager: Error processing {$relativePath}: " . $e->getMessage());
                        $errorCount++;
                    }
                }
                
                error_log("UpdateManager: File replacement completed. Replaced: {$replacedCount}, Skipped: {$skippedCount}, Errors: {$errorCount}");
                
                if ($errorCount > 0) {
                    error_log("UpdateManager: Warning: {$errorCount} files failed to replace");
                }
            } catch (Exception $e) {
                error_log("UpdateManager: Fatal error in replaceFiles: " . $e->getMessage());
                throw $e;
            }
        }
        
        /**
         * Delete directory recursively
         */
        private function deleteDirectory($dir) {
            if (!is_dir($dir)) {
                return;
            }
            
            $files = array_diff(scandir($dir), ['.', '..']);
            foreach ($files as $file) {
                $path = $dir . '/' . $file;
                is_dir($path) ? $this->deleteDirectory($path) : @unlink($path);
            }
            @rmdir($dir);
        }
    }
}

