<?php
/**
 * Laragon Dashboard Configuration
 * Version: 3.0.0
 * Author: Tarek Tarabichi
 * Company: 2TInteractive (2tinteractive.com)
 * Project Start: Early 2024
 * GitHub: https://github.com/LebToki/Laragon-Dashboard
 */

// Application Information (only define if not already defined)
if (!defined('APP_NAME')) {
    define('APP_NAME', 'Laragon Dashboard');
}
if (!defined('APP_VERSION')) {
    define('APP_VERSION', '3.0.0');
}
if (!defined('APP_AUTHOR')) {
    define('APP_AUTHOR', 'Tarek Tarabichi');
}
if (!defined('APP_COMPANY')) {
    define('APP_COMPANY', '2TInteractive');
}
if (!defined('APP_COMPANY_URL')) {
    define('APP_COMPANY_URL', 'https://2tinteractive.com');
}
if (!defined('APP_GITHUB')) {
    define('APP_GITHUB', 'https://github.com/LebToki/Laragon-Dashboard');
}
if (!defined('APP_START_YEAR')) {
    define('APP_START_YEAR', '2024');
}

// Application Settings (only define if not already defined)
if (!defined('APP_DEBUG')) {
    define('APP_DEBUG', true); // Set to false in production
}
if (!defined('APP_ENV')) {
    define('APP_ENV', 'development'); // development, staging, production
}

// Path Definitions (only define if not already defined)
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__FILE__));
}
if (!defined('TEMPLATE_ROOT')) {
    define('TEMPLATE_ROOT', APP_ROOT . '/template');
}
if (!defined('ASSETS_ROOT')) {
    define('ASSETS_ROOT', APP_ROOT . '/assets');
}
if (!defined('PARTIALS_ROOT')) {
    define('PARTIALS_ROOT', APP_ROOT . '/partials');
}
if (!defined('INCLUDES_ROOT')) {
    define('INCLUDES_ROOT', APP_ROOT . '/includes');
}
if (!defined('LOGS_ROOT')) {
    define('LOGS_ROOT', APP_ROOT . '/logs');
}
if (!defined('CACHE_ROOT')) {
    define('CACHE_ROOT', APP_ROOT . '/cache');
}

// URL Path Definitions (relative to web root)
if (!defined('BASE_URL')) {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $basePath = dirname($scriptName);
    if ($basePath === '/' || $basePath === '\\' || $basePath === '.') {
        $basePath = '';
    } else {
        $basePath = rtrim(str_replace('\\', '/', $basePath), '/');
    }
    define('BASE_URL', $basePath);
}
if (!defined('ASSETS_URL')) {
    define('ASSETS_URL', BASE_URL . '/assets');
}
if (!defined('TEMPLATE_URL')) {
    define('TEMPLATE_URL', BASE_URL . '/template');
}

/**
 * Auto-detect Laragon installation path
 */
function getLaragonRoot() {
    // Check environment variable first
    $envPath = getenv('LARAGON_ROOT');
    if (!empty($envPath) && is_dir($envPath) && file_exists($envPath . '/laragon.exe')) {
        return rtrim(str_replace('\\', '/', $envPath), '/');
    }
    
    // Try common installation paths
    $possiblePaths = ['C:/laragon', 'D:/laragon', 'E:/laragon'];
    foreach ($possiblePaths as $path) {
        if (is_dir($path) && file_exists($path . '/laragon.exe')) {
            return $path;
        }
    }
    
    // Try to detect from document root
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    if (strpos($docRoot, 'laragon') !== false) {
        $parts = explode('laragon', $docRoot);
        $detectedPath = $parts[0] . 'laragon';
        if (is_dir($detectedPath) && file_exists($detectedPath . '/laragon.exe')) {
            return str_replace('\\', '/', $detectedPath);
        }
    }
    
    // Default fallback
    return 'C:/laragon';
}

/**
 * Get Laragon general preferences from laragon.ini
 */
function getLaragonPreferences() {
    $laragonRoot = getLaragonRoot();
    $iniFile = $laragonRoot . '/usr/laragon.ini';
    
    // Default preferences
    $defaults = [
        'StartAllAutomatically' => false,
        'DocumentRoot' => $laragonRoot . '/www',
        'DataDirectory' => $laragonRoot . '/data',
        'HostnameFormat' => '{name}.local',
        'AutoBackup' => false,
        'BackupInterval' => 8,
        'AutoUpdate' => false,
        'RunOnWindowsStart' => false,
        'RunMinimized' => false,
        'AutoCreateVirtualHosts' => true
    ];
    
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile);
        if ($config) {
            // Map Laragon ini keys to our preference keys
            $keyMap = [
                'StartAll' => 'StartAllAutomatically',
                'StartAllAutomatically' => 'StartAllAutomatically',
                'DocumentRoot' => 'DocumentRoot',
                'DataDirectory' => 'DataDirectory',
                'HostnameFormat' => 'HostnameFormat',
                'AutoBackup' => 'AutoBackup',
                'BackupInterval' => 'BackupInterval',
                'AutoUpdate' => 'AutoUpdate',
                'RunOnWindowsStart' => 'RunOnWindowsStart',
                'RunMinimized' => 'RunMinimized',
                'AutoCreateVirtualHosts' => 'AutoCreateVirtualHosts'
            ];
            
            foreach ($keyMap as $iniKey => $prefKey) {
                if (isset($config[$iniKey])) {
                    $value = $config[$iniKey];
                    // Convert string booleans to actual booleans
                    if (is_string($value)) {
                        $value = trim($value);
                        if (strtolower($value) === 'true' || $value === '1') {
                            $value = true;
                        } elseif (strtolower($value) === 'false' || $value === '0' || $value === '') {
                            $value = false;
                        }
                    }
                    $defaults[$prefKey] = $value;
                }
            }
            
            // Also check for numeric values
            if (isset($config['BackupInterval']) && is_numeric($config['BackupInterval'])) {
                $defaults['BackupInterval'] = (int)$config['BackupInterval'];
            }
        }
    }
    
    // Normalize paths
    if (isset($defaults['DocumentRoot'])) {
        $defaults['DocumentRoot'] = str_replace('\\', '/', $defaults['DocumentRoot']);
    }
    if (isset($defaults['DataDirectory'])) {
        $defaults['DataDirectory'] = str_replace('\\', '/', $defaults['DataDirectory']);
    }
    
    return $defaults;
}

/**
 * Auto-detect domain suffix from Laragon configuration
 */
function getLaragonDomainSuffix() {
    $preferences = getLaragonPreferences();
    $hostnameFormat = $preferences['HostnameFormat'] ?? '{name}.local';
    
    // Extract suffix from format like "{name}.local"
    if (preg_match('/\.([a-z0-9\-]+)$/i', $hostnameFormat, $matches)) {
        return '.' . $matches[1];
    }
    
    // Fallback: check laragon.ini directly
    $laragonRoot = getLaragonRoot();
    $iniFile = $laragonRoot . '/usr/laragon.ini';
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile);
        if ($config && isset($config['DomainSuffix'])) {
            $suffix = trim($config['DomainSuffix']);
            if (!empty($suffix) && $suffix[0] !== '.') {
                $suffix = '.' . $suffix;
            }
            return $suffix;
        }
    }
    
    // Default fallback
    return '.local';
}

/**
 * Auto-detect sendmail output directory
 */
function getLaragonSendmailDir() {
    $laragonRoot = getLaragonRoot();
    $sendmailDir = $laragonRoot . '/bin/sendmail/output';
    
    // Create directory if it doesn't exist
    if (!is_dir($sendmailDir)) {
        $parentDir = dirname($sendmailDir);
        if (!is_dir($parentDir)) {
            @mkdir($parentDir, 0755, true);
        }
        @mkdir($sendmailDir, 0755, true);
    }
    
    if (is_dir($sendmailDir) || @mkdir($sendmailDir, 0755, true)) {
        return rtrim(str_replace('\\', '/', $sendmailDir), '/') . '/';
    }
    
    // Fallback to default (still try to create it)
    $fallbackDir = rtrim($laragonRoot, '/') . '/bin/sendmail/output';
    if (!is_dir($fallbackDir)) {
        $parentDir = dirname($fallbackDir);
        if (!is_dir($parentDir)) {
            @mkdir($parentDir, 0755, true);
        }
        @mkdir($fallbackDir, 0755, true);
    }
    
    return $fallbackDir . '/';
}

/**
 * Get application version from Git or VERSION file
 */
function getAppVersion() {
    $versionFile = __DIR__ . '/VERSION';
    
    // Check for VERSION file first
    if (file_exists($versionFile)) {
        $version = trim(@file_get_contents($versionFile));
        if (!empty($version)) {
            return $version;
        }
    }
    
    // Try to get version from Git
    $gitDir = __DIR__ . '/.git';
    if (is_dir($gitDir)) {
        // Try git describe
        $command = 'cd ' . escapeshellarg(__DIR__) . ' && git describe --tags --always 2>nul';
        $version = @shell_exec($command);
        if ($version) {
            $version = trim($version);
            // Remove 'v' prefix if present
            $version = preg_replace('/^v/', '', $version);
            return $version;
        }
        
        // Fallback to short commit hash
        $command = 'cd ' . escapeshellarg(__DIR__) . ' && git rev-parse --short HEAD 2>nul';
        $hash = @shell_exec($command);
        if ($hash) {
            return 'dev-' . trim($hash);
        }
    }
    
    // Default fallback
    return APP_VERSION;
}

// Get Laragon root path (only define if not already defined)
if (!defined('LARAGON_ROOT')) {
    $LARAGON_ROOT = getLaragonRoot();
    define('LARAGON_ROOT', $LARAGON_ROOT);
}

// Auto-detect configuration values (only define if not already defined)
if (!defined('SENDMAIL_OUTPUT_DIR')) {
    define('SENDMAIL_OUTPUT_DIR', getenv('SENDMAIL_OUTPUT_DIR') ?: getLaragonSendmailDir());
}
if (!defined('DOMAIN_SUFFIX')) {
    define('DOMAIN_SUFFIX', getenv('DOMAIN_SUFFIX') ?: getLaragonDomainSuffix());
}
if (!defined('APP_VERSION_DETECTED')) {
    define('APP_VERSION_DETECTED', getenv('APP_VERSION') ?: getAppVersion());
}

// URL to access PhpMyAdmin (only define if not already defined)
if (!defined('PHPMYADMIN_URL')) {
    define('PHPMYADMIN_URL', getenv('PHPMYADMIN_URL') ?: 'http://localhost/phpmyadmin');
}

// MySQL connection settings (Laragon defaults) - only define if not already defined
if (!defined('MYSQL_HOST')) {
    define('MYSQL_HOST', getenv('MYSQL_HOST') ?: 'localhost');
}
if (!defined('MYSQL_USER')) {
    define('MYSQL_USER', getenv('MYSQL_USER') ?: 'root');
}
if (!defined('MYSQL_PASSWORD')) {
    define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD') ?: '');
}

// Security settings (only define if not already defined)
if (!defined('SESSION_TIMEOUT')) {
    define('SESSION_TIMEOUT', 3600); // 1 hour
}
if (!defined('MAX_LOGIN_ATTEMPTS')) {
    define('MAX_LOGIN_ATTEMPTS', 5);
}
if (!defined('CSRF_TOKEN_NAME')) {
    define('CSRF_TOKEN_NAME', 'csrf_token');
}

// File upload settings (only define if not already defined)
if (!defined('MAX_UPLOAD_SIZE')) {
    define('MAX_UPLOAD_SIZE', 10 * 1024 * 1024); // 10MB
}
if (!defined('ALLOWED_EXTENSIONS')) {
    define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx']);
}

// Error reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Timezone
date_default_timezone_set('UTC');

// Ensure required directories exist
$requiredDirs = [LOGS_ROOT, CACHE_ROOT];
foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

