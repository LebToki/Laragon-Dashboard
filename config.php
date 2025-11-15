<?php
/**
 * Laragon Dashboard Configuration
 * Version: 3.0.2
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
    define('APP_VERSION', '3.0.2');
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

// Suppress errors for API endpoints (they handle their own error reporting)
if (basename($_SERVER['PHP_SELF'] ?? '') === 'files.php' || 
    basename($_SERVER['PHP_SELF'] ?? '') === 'logs.php' ||
    basename($_SERVER['PHP_SELF'] ?? '') === 'vitals.php' ||
    basename($_SERVER['PHP_SELF'] ?? '') === 'services.php' ||
    basename($_SERVER['PHP_SELF'] ?? '') === 'preferences.php' ||
    basename($_SERVER['PHP_SELF'] ?? '') === 'mailpit.php') {
    @ini_set('display_errors', 0);
    @error_reporting(0);
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
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF'] ?? '';
    $basePath = dirname($scriptName);
    
    // Normalize path separators
    $basePath = str_replace('\\', '/', $basePath);
    
    // Handle root cases
    if ($basePath === '/' || $basePath === '\\' || $basePath === '.' || $basePath === '') {
        $basePath = '';
    } else {
        // Remove trailing slash and ensure it starts with /
        $basePath = rtrim($basePath, '/');
        if (substr($basePath, 0, 1) !== '/') {
            $basePath = '/' . $basePath;
        }
    }
    
    define('BASE_URL', $basePath);
}
if (!defined('ASSETS_URL')) {
    // Ensure ASSETS_URL starts with / if BASE_URL is not empty
    $assetsPath = BASE_URL . '/assets';
    if (BASE_URL === '' && substr($assetsPath, 0, 1) !== '/') {
        $assetsPath = '/' . $assetsPath;
    }
    define('ASSETS_URL', $assetsPath);
}
if (!defined('TEMPLATE_URL')) {
    define('TEMPLATE_URL', BASE_URL . '/template');
}

/**
 * Scan all drives for Laragon installations
 * Returns array of detected Laragon paths
 */
function scanForLaragonInstallations() {
    $installations = [];
    $drives = [];
    
    // Check common drives first
    $commonDrives = ['C', 'D', 'E', 'F'];
    foreach ($commonDrives as $drive) {
        $drives[] = $drive;
    }
    
    // Scan all available drives dynamically on Windows
    if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $output = @shell_exec('wmic logicaldisk get name 2>nul');
        if ($output) {
            preg_match_all('/([A-Z]):/', $output, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $drive) {
                    if (!in_array($drive, $drives)) {
                        $drives[] = $drive;
                    }
                }
            }
        }
    }
    
    // Check each drive for Laragon installation
    foreach ($drives as $drive) {
        $path = $drive . ':/laragon';
        if (is_dir($path) && file_exists($path . '/laragon.exe')) {
            // Verify it's a valid Laragon installation
            if (file_exists($path . '/usr/laragon.ini')) {
                $installations[] = [
                    'path' => rtrim(str_replace('\\', '/', $path), '/'),
                    'drive' => $drive,
                    'valid' => true,
                    'has_ini' => file_exists($path . '/usr/laragon.ini')
                ];
            }
        }
    }
    
    return $installations;
}

/**
 * Get Dashboard preferences (stored in JSON file)
 * Allows overriding Laragon detection
 */
function getDashboardPreferences() {
    $dataDir = APP_ROOT . '/data';
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }
    
    $prefsFile = $dataDir . '/preferences.json';
    $defaults = [
        'laragon_root' => null, // null means auto-detect
        'mysql_host' => null,
        'mysql_user' => null,
        'mysql_password' => null,
        'document_root' => null,
        'domain_suffix' => null,
    ];
    
    if (file_exists($prefsFile)) {
        $content = @file_get_contents($prefsFile);
        if ($content) {
            $prefs = @json_decode($content, true);
            if (is_array($prefs)) {
                return array_merge($defaults, $prefs);
            }
        }
    }
    
    return $defaults;
}

/**
 * Save Dashboard preferences
 */
function saveDashboardPreferences(array $preferences) {
    $dataDir = APP_ROOT . '/data';
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0755, true);
    }
    
    $prefsFile = $dataDir . '/preferences.json';
    $existing = getDashboardPreferences();
    $merged = array_merge($existing, $preferences);
    
    // Remove null values to allow auto-detection
    $merged = array_filter($merged, function($value) {
        return $value !== null && $value !== '';
    });
    
    return @file_put_contents($prefsFile, json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
}

/**
 * Auto-detect Laragon installation path with dynamic drive scanning
 * Priority: Dashboard Preferences > Environment Variable > Dynamic Detection > Document Root > Default
 */
function getLaragonRoot() {
    // 1. Check Dashboard Preferences override first
    $prefs = getDashboardPreferences();
    if (!empty($prefs['laragon_root']) && is_dir($prefs['laragon_root']) && file_exists($prefs['laragon_root'] . '/laragon.exe')) {
        return rtrim(str_replace('\\', '/', $prefs['laragon_root']), '/');
    }
    
    // 2. Check environment variable
    $envPath = getenv('LARAGON_ROOT');
    if (!empty($envPath) && is_dir($envPath) && file_exists($envPath . '/laragon.exe')) {
        return rtrim(str_replace('\\', '/', $envPath), '/');
    }
    
    // 3. Dynamic drive scanning (C: through Z:)
    $drives = [];
    // Check common drives first
    $commonDrives = ['C', 'D', 'E', 'F'];
    foreach ($commonDrives as $drive) {
        $drives[] = $drive . ':/laragon';
    }
    
    // Scan all available drives dynamically
    if (function_exists('shell_exec') && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Get all available drives on Windows
        $output = @shell_exec('wmic logicaldisk get name 2>nul');
        if ($output) {
            preg_match_all('/([A-Z]):/', $output, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $drive) {
                    $path = $drive . ':/laragon';
                    if (!in_array($path, $drives)) {
                        $drives[] = $path;
                    }
                }
            }
        }
    }
    
    // Check each drive for Laragon installation
    foreach ($drives as $path) {
        if (is_dir($path) && file_exists($path . '/laragon.exe')) {
            // Verify it's a valid Laragon installation by checking for usr/laragon.ini
            if (file_exists($path . '/usr/laragon.ini')) {
                return rtrim(str_replace('\\', '/', $path), '/');
            }
        }
    }
    
    // 4. Try to detect from document root
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    if (strpos($docRoot, 'laragon') !== false) {
        $parts = explode('laragon', $docRoot);
        $detectedPath = $parts[0] . 'laragon';
        if (is_dir($detectedPath) && file_exists($detectedPath . '/laragon.exe') && file_exists($detectedPath . '/usr/laragon.ini')) {
            return str_replace('\\', '/', $detectedPath);
        }
    }
    
    // 5. Try reading from laragon.ini in common locations (if ini file exists but exe doesn't)
    foreach ($drives as $path) {
        $iniFile = $path . '/usr/laragon.ini';
        if (file_exists($iniFile)) {
            // If ini exists, assume this is the Laragon root
            return rtrim(str_replace('\\', '/', $path), '/');
        }
    }
    
    // 6. Default fallback
    return 'C:/laragon';
}

/**
 * Get Laragon configuration from laragon.ini
 * Reads directly from the ini file (not affected by dashboard preferences)
 */
function getLaragonConfig() {
    if (!defined('LARAGON_ROOT')) {
        return [];
    }
    
    $laragonIniPath = LARAGON_ROOT . '/usr/laragon.ini';
    
    if (!file_exists($laragonIniPath)) {
        return [];
    }
    
    try {
        $oldErrorReporting = error_reporting(0);
        $config = parse_ini_file($laragonIniPath, false, INI_SCANNER_RAW);
        error_reporting($oldErrorReporting);
        
        if ($config === false || !is_array($config)) {
            return [];
        }
        
        return $config;
    } catch (Exception | Error $e) {
        return [];
    }
}

/**
 * Get Laragon general preferences from laragon.ini
 * Dashboard preferences can override these values
 */
function getLaragonPreferences() {
    $laragonRoot = getLaragonRoot();
    $iniFile = $laragonRoot . '/usr/laragon.ini';
    
    // Get dashboard preferences for overrides
    $dashboardPrefs = getDashboardPreferences();
    
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
    
    // Read from laragon.ini if it exists
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile, false, INI_SCANNER_RAW);
        if ($config && is_array($config)) {
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
    
    // Apply Dashboard Preferences overrides (highest priority)
    if (!empty($dashboardPrefs['document_root'])) {
        $defaults['DocumentRoot'] = $dashboardPrefs['document_root'];
    }
    if (!empty($dashboardPrefs['domain_suffix'])) {
        // Convert domain suffix to hostname format if needed
        $suffix = ltrim($dashboardPrefs['domain_suffix'], '.');
        $defaults['HostnameFormat'] = '{name}.' . $suffix;
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

// MySQL connection settings - Priority: Dashboard Preferences > Environment Variable > Laragon Config > Defaults
if (!defined('MYSQL_HOST')) {
    $prefs = getDashboardPreferences();
    $mysqlHost = $prefs['mysql_host'] ?? getenv('MYSQL_HOST');
    if (empty($mysqlHost)) {
        // Try to get from Laragon config
        $laragonConfig = getLaragonConfig();
        $mysqlHost = $laragonConfig['MySQLHost'] ?? 'localhost';
    }
    define('MYSQL_HOST', $mysqlHost ?: 'localhost');
}
if (!defined('MYSQL_USER')) {
    $prefs = getDashboardPreferences();
    $mysqlUser = $prefs['mysql_user'] ?? getenv('MYSQL_USER');
    if (empty($mysqlUser)) {
        // Try to get from Laragon config
        $laragonConfig = getLaragonConfig();
        $mysqlUser = $laragonConfig['MySQLUser'] ?? 'root';
    }
    define('MYSQL_USER', $mysqlUser ?: 'root');
}
if (!defined('MYSQL_PASSWORD')) {
    $prefs = getDashboardPreferences();
    $mysqlPassword = $prefs['mysql_password'] ?? getenv('MYSQL_PASSWORD');
    if ($mysqlPassword === null || $mysqlPassword === '') {
        // Try to get from Laragon config
        $laragonConfig = getLaragonConfig();
        $mysqlPassword = $laragonConfig['MySQLRootPassword'] ?? '';
    }
    define('MYSQL_PASSWORD', $mysqlPassword ?: '');
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
// For API endpoints, always suppress display errors to prevent JSON corruption
$isApiEndpoint = in_array(basename($_SERVER['PHP_SELF'] ?? ''), [
    'files.php', 'logs.php', 'vitals.php', 'services.php', 
    'preferences.php', 'mailpit.php', 'create_project.php'
]);

if ($isApiEndpoint) {
    // API endpoints: suppress all error display
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
} elseif (APP_DEBUG) {
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

