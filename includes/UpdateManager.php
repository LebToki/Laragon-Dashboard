<?php
/**
 * Laragon Dashboard - Update Manager
 * Handles automatic updates from GitHub while preserving user configuration
 * 
 * Version: 1.0.0
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
            $currentVersion = defined('APP_VERSION') ? APP_VERSION : '3.0.0';
            
            try {
                $url = "{$this->githubApiUrl}/{$this->githubRepo}/releases/latest";
                $release = $this->fetchFromGitHub($url);
                
                if (!$release) {
                    return ['available' => false, 'error' => 'Failed to fetch release information'];
                }
                
                $latestVersion = $this->normalizeVersion($release['tag_name']);
                $currentVersionNormalized = $this->normalizeVersion($currentVersion);
                
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
            $currentVersion = defined('APP_VERSION') ? APP_VERSION : '3.0.0';
            $backupName = "{$timestamp}_v{$currentVersion}";
            $backupPath = $this->backupDir . '/' . $backupName;
            
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
            
            file_put_contents($backupPath . '/manifest.json', json_encode($manifest, JSON_PRETTY_PRINT));
            
            return $backupPath;
        }
        
        /**
         * Download update package
         * 
         * @param string $downloadUrl Download URL from GitHub
         * @return string Path to downloaded ZIP file
         */
        public function downloadUpdate($downloadUrl) {
            $zipPath = $this->tempDir . '/update.zip';
            
            // Download file
            $ch = curl_init($downloadUrl);
            $fp = fopen($zipPath, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard-Updater/1.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 5 minutes
            
            $success = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            fclose($fp);
            
            if (!$success || $httpCode !== 200) {
                @unlink($zipPath);
                throw new Exception("Failed to download update: HTTP {$httpCode}");
            }
            
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
            $extractPath = $this->tempDir . '/extracted';
            
            // Clean extract directory
            if (is_dir($extractPath)) {
                $this->deleteDirectory($extractPath);
            }
            @mkdir($extractPath, 0755, true);
            
            // Extract ZIP
            $zip = new ZipArchive();
            if ($zip->open($zipPath) !== true) {
                throw new Exception('Failed to open update package');
            }
            
            $zip->extractTo($extractPath);
            $zip->close();
            
            // Find the actual dashboard directory in extracted files
            $dashboardPath = $this->findDashboardDirectory($extractPath);
            
            if (!$dashboardPath) {
                throw new Exception('Could not find dashboard directory in update package');
            }
            
            // Migrate configuration before replacing files
            $configMigrator = new ConfigMigrator();
            $configMigrator->migrateConfiguration($backupPath, $dashboardPath);
            
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
            $this->replaceFiles($dashboardPath, $preservePaths);
            
            // Clean up
            $this->deleteDirectory($extractPath);
            @unlink($zipPath);
            
            return true;
        }
        
        /**
         * Rollback to previous version
         * 
         * @param string $backupPath Path to backup directory
         * @return bool Success status
         */
        public function rollback($backupPath) {
            if (!is_dir($backupPath)) {
                throw new Exception('Backup directory not found');
            }
            
            $manifestPath = $backupPath . '/manifest.json';
            if (!file_exists($manifestPath)) {
                throw new Exception('Backup manifest not found');
            }
            
            $manifest = json_decode(file_get_contents($manifestPath), true);
            
            // Restore backed up files
            foreach ($manifest['files'] as $file) {
                $sourcePath = $file['backup_path'];
                $destPath = $this->appRoot . '/' . $file['path'];
                
                $destDir = dirname($destPath);
                if (!is_dir($destDir)) {
                    @mkdir($destDir, 0755, true);
                }
                
                if (file_exists($sourcePath)) {
                    @copy($sourcePath, $destPath);
                }
            }
            
            return true;
        }
        
        /**
         * Verify installation after update
         * 
         * @return bool Verification status
         */
        public function verifyInstallation() {
            // Check if config.php loads without errors
            try {
                if (!defined('APP_ROOT')) {
                    require_once $this->appRoot . '/config.php';
                }
                
                // Test critical functions
                if (!function_exists('getLaragonRoot')) {
                    return false;
                }
                
                // Verify config values are preserved
                $prefs = getDashboardPreferences();
                if ($prefs === null) {
                    return false;
                }
                
                return true;
            } catch (Exception $e) {
                error_log("Update verification failed: " . $e->getMessage());
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
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Laragon-Dashboard/1.0');
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode !== 200) {
                return false;
            }
            
            return json_decode($response, true);
        }
        
        /**
         * Normalize version string for comparison
         */
        private function normalizeVersion($version) {
            // Remove 'v' prefix if present
            $version = ltrim($version, 'vV');
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
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($sourcePath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST
            );
            
            foreach ($iterator as $item) {
                $relativePath = str_replace($sourcePath . '/', '', $item->getPathname());
                
                // Skip preserved paths
                $shouldPreserve = false;
                foreach ($preservePaths as $preservePath) {
                    if (strpos($relativePath, $preservePath) === 0) {
                        $shouldPreserve = true;
                        break;
                    }
                }
                
                if ($shouldPreserve) {
                    continue;
                }
                
                $destPath = $this->appRoot . '/' . $relativePath;
                
                if ($item->isDir()) {
                    if (!is_dir($destPath)) {
                        @mkdir($destPath, 0755, true);
                    }
                } else {
                    $destDir = dirname($destPath);
                    if (!is_dir($destDir)) {
                        @mkdir($destDir, 0755, true);
                    }
                    @copy($item->getPathname(), $destPath);
                }
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

