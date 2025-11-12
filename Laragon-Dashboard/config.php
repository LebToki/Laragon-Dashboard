<?php
// Configuration for Laragon Dashboard

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
 * Auto-detect domain suffix from Laragon configuration
 */
function getLaragonDomainSuffix() {
    $laragonRoot = getLaragonRoot();
    
    // Check laragon.ini file - look for HostnameFormat first
    $iniFile = $laragonRoot . '/usr/laragon.ini';
    if (file_exists($iniFile)) {
        $config = @parse_ini_file($iniFile);
        if ($config && isset($config['HostnameFormat'])) {
            // Extract suffix from format like "{name}.local"
            $format = $config['HostnameFormat'];
            if (preg_match('/\.([a-z0-9\-]+)$/i', $format, $matches)) {
                $suffix = '.' . $matches[1];
                return $suffix;
            }
        }
        // Also check for DomainSuffix if it exists
        if ($config && isset($config['DomainSuffix'])) {
            $suffix = trim($config['DomainSuffix']);
            if (!empty($suffix) && $suffix[0] !== '.') {
                $suffix = '.' . $suffix;
            }
            return $suffix;
        }
    }
    
    // Check etc/apache2/sites-enabled for domain patterns
    $sitesDir = $laragonRoot . '/etc/apache2/sites-enabled';
    if (is_dir($sitesDir)) {
        $files = glob($sitesDir . '/*.conf');
        if (!empty($files)) {
            $content = @file_get_contents($files[0]);
            if ($content && preg_match('/ServerName\s+([^\.]+)\.([^\s]+)/i', $content, $matches)) {
                $suffix = '.' . $matches[2];
                if ($suffix !== '.localhost' && $suffix !== '.127.0.0.1') {
                    return $suffix;
                }
            }
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
    
    // Return the directory path (create it if needed)
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
 * Auto-detect application version from Git
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
    return '2.6.0';
}

// Get Laragon root path
$LARAGON_ROOT = getLaragonRoot();

// Auto-detect BASE_URL
function getBaseUrl() {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $scriptDir = dirname($scriptName);
    
    // If script is in root, base URL is just the host
    if ($scriptDir === '/' || $scriptDir === '\\' || $scriptDir === '.') {
        $baseUrl = $protocol . '://' . $host . '/';
    } else {
        $baseUrl = $protocol . '://' . $host . rtrim($scriptDir, '/') . '/';
    }
    
    return $baseUrl;
}

// Auto-detect configuration values
define('SENDMAIL_OUTPUT_DIR', getenv('SENDMAIL_OUTPUT_DIR') ?: getLaragonSendmailDir());
define('DOMAIN_SUFFIX', getenv('DOMAIN_SUFFIX') ?: getLaragonDomainSuffix());
define('APP_VERSION', getenv('APP_VERSION') ?: getAppVersion());
define('BASE_URL', getenv('BASE_URL') ?: getBaseUrl());

// URL to access PhpMyAdmin. Override with the PHPMYADMIN_URL environment variable.
define('PHPMYADMIN_URL', getenv('PHPMYADMIN_URL') ?: 'http://localhost/phpmyadmin');

// MySQL connection settings. These fall back to Laragon defaults if not set.
define('MYSQL_HOST', getenv('MYSQL_HOST') ?: 'localhost');
define('MYSQL_USER', getenv('MYSQL_USER') ?: 'root');
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD') ?: '');

// Application settings
define('APP_NAME', 'Laragon Dashboard');
define('APP_DEBUG', false);

// Security settings
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);

// File upload settings
define('MAX_UPLOAD_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx']);

// Error reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
