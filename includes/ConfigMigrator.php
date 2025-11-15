<?php
/**
 * Laragon Dashboard - Configuration Migrator
 * Migrates user configuration during updates
 * 
 * Version: 1.0.0
 */

if (!class_exists('ConfigMigrator')) {
    class ConfigMigrator {
        private $appRoot;
        
        public function __construct() {
            $this->appRoot = defined('APP_ROOT') ? APP_ROOT : dirname(__DIR__);
        }
        
        /**
         * Migrate configuration from backup to new version
         * 
         * @param string $backupPath Path to backup directory
         * @param string $newVersionPath Path to new version directory
         * @return bool Success status
         */
        public function migrateConfiguration($backupPath, $newVersionPath) {
            // Load backup manifest
            $manifestPath = $backupPath . '/manifest.json';
            if (!file_exists($manifestPath)) {
                throw new Exception('Backup manifest not found');
            }
            
            $manifest = json_decode(file_get_contents($manifestPath), true);
            
            // Migrate config.php
            $this->migrateConfigFile($backupPath, $newVersionPath, $manifest);
            
            // Migrate preferences.json
            $this->migratePreferencesFile($backupPath, $newVersionPath);
            
            // Migrate license.json if exists
            $this->migrateLicenseFile($backupPath, $newVersionPath);
            
            return true;
        }
        
        /**
         * Migrate config.php file
         */
        private function migrateConfigFile($backupPath, $newVersionPath, $manifest) {
            $oldConfigPath = $backupPath . '/config.php.backup';
            $newConfigPath = $newVersionPath . '/config.php';
            
            if (!file_exists($oldConfigPath) || !file_exists($newConfigPath)) {
                return false;
            }
            
            // Read old and new configs
            $oldConfig = file_get_contents($oldConfigPath);
            $newConfig = file_get_contents($newConfigPath);
            
            // Extract user-defined constants from old config
            $userConstants = $this->extractUserConstants($oldConfig);
            
            // Extract user-defined constants from new config (if any)
            $newUserConstants = $this->extractUserConstants($newConfig);
            
            // Merge: preserve old user constants, add new ones if not conflicting
            $mergedConstants = array_merge($newUserConstants, $userConstants);
            
            // Find insertion point in new config (after auto-generated section)
            $insertionPoint = $this->findConfigInsertionPoint($newConfig);
            
            // Build merged config
            $mergedConfig = substr($newConfig, 0, $insertionPoint);
            $mergedConfig .= "\n// User customizations (preserved from previous version)\n";
            $mergedConfig .= "// DO NOT MODIFY ABOVE THIS LINE - Auto-generated\n\n";
            
            foreach ($mergedConstants as $name => $value) {
                $mergedConfig .= "if (!defined('{$name}')) {\n";
                $mergedConfig .= "    define('{$name}', " . var_export($value, true) . ");\n";
                $mergedConfig .= "}\n\n";
            }
            
            $mergedConfig .= substr($newConfig, $insertionPoint);
            
            // Write merged config to new version
            file_put_contents($newConfigPath, $mergedConfig);
            
            return true;
        }
        
        /**
         * Migrate preferences.json file
         */
        private function migratePreferencesFile($backupPath, $newVersionPath) {
            $oldPrefsPath = $backupPath . '/preferences.json.backup';
            $newPrefsPath = $newVersionPath . '/data/preferences.json';
            
            if (!file_exists($oldPrefsPath)) {
                return false; // No old preferences to migrate
            }
            
            // Read old preferences
            $oldPrefs = json_decode(file_get_contents($oldPrefsPath), true);
            if (!is_array($oldPrefs)) {
                return false;
            }
            
            // Read new preferences (if exists) or use defaults
            $newPrefs = [];
            if (file_exists($newPrefsPath)) {
                $newPrefs = json_decode(file_get_contents($newPrefsPath), true);
                if (!is_array($newPrefs)) {
                    $newPrefs = [];
                }
            }
            
            // Merge: preserve old values, add new defaults
            $mergedPrefs = array_merge($newPrefs, $oldPrefs);
            
            // Ensure data directory exists
            $dataDir = dirname($newPrefsPath);
            if (!is_dir($dataDir)) {
                @mkdir($dataDir, 0755, true);
            }
            
            // Write merged preferences
            file_put_contents($newPrefsPath, json_encode($mergedPrefs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            
            return true;
        }
        
        /**
         * Migrate license.json file
         */
        private function migrateLicenseFile($backupPath, $newVersionPath) {
            $oldLicensePath = $backupPath . '/license.json.backup';
            $newLicensePath = $newVersionPath . '/data/license.json';
            
            if (!file_exists($oldLicensePath)) {
                return false; // No license to migrate
            }
            
            // Simply copy license file
            $dataDir = dirname($newLicensePath);
            if (!is_dir($dataDir)) {
                @mkdir($dataDir, 0755, true);
            }
            
            @copy($oldLicensePath, $newLicensePath);
            
            return true;
        }
        
        /**
         * Extract user-defined constants from config
         */
        private function extractUserConstants($configContent) {
            $constants = [];
            
            // Find all define() statements
            preg_match_all('/define\s*\(\s*[\'"](\w+)[\'"]\s*,\s*(.+?)\s*\)\s*;/s', $configContent, $matches, PREG_SET_ORDER);
            
            foreach ($matches as $match) {
                $name = $match[1];
                $value = $match[2];
                
                // Skip auto-generated constants (APP_VERSION, APP_NAME, etc.)
                if (in_array($name, ['APP_VERSION', 'APP_NAME', 'APP_AUTHOR', 'APP_COMPANY', 'APP_GITHUB', 'APP_START_YEAR'])) {
                    continue;
                }
                
                // Evaluate value (handle strings, numbers, booleans)
                $evalValue = $this->evaluateConstantValue($value);
                
                $constants[$name] = $evalValue;
            }
            
            return $constants;
        }
        
        /**
         * Evaluate constant value safely
         */
        private function evaluateConstantValue($value) {
            $value = trim($value);
            
            // String value
            if (preg_match('/^[\'"](.*)[\'"]$/', $value, $matches)) {
                return $matches[1];
            }
            
            // Boolean
            if (strtolower($value) === 'true') {
                return true;
            }
            if (strtolower($value) === 'false') {
                return false;
            }
            
            // Number
            if (is_numeric($value)) {
                return strpos($value, '.') !== false ? (float)$value : (int)$value;
            }
            
            // Constant reference (try to resolve)
            if (defined($value)) {
                return constant($value);
            }
            
            // Function call (e.g., getLaragonRoot())
            // We'll preserve the function call as-is
            return $value;
        }
        
        /**
         * Find insertion point in config file for user customizations
         */
        private function findConfigInsertionPoint($configContent) {
            // Look for comment markers
            $markers = [
                '// User customizations',
                '// DO NOT MODIFY',
                '// Auto-generated',
                '// End of auto-generated',
            ];
            
            foreach ($markers as $marker) {
                $pos = strpos($configContent, $marker);
                if ($pos !== false) {
                    // Find end of line
                    $lineEnd = strpos($configContent, "\n", $pos);
                    return $lineEnd !== false ? $lineEnd + 1 : $pos;
                }
            }
            
            // Default: insert before last closing PHP tag or at end
            $lastPhpTag = strrpos($configContent, '?>');
            if ($lastPhpTag !== false) {
                return $lastPhpTag;
            }
            
            return strlen($configContent);
        }
    }
}

