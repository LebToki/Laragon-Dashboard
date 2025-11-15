<?php
/**
 * Laragon Dashboard - Helper Functions
 * Version: 3.0.0
 * Description: Helper functions for server information and utilities
 */

if (!defined('LARAGON_ROOT')) {
    require_once __DIR__ . '/../config.php';
}

/**
 * Get Laragon configuration from laragon.ini
 */
function getLaragonConfig() {
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
 * Get Apache version
 */
function getApacheVersion() {
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
    if (preg_match('/Apache\/([\d.]+)/i', $serverSoftware, $matches)) {
        return $matches[1];
    }
    
    // Try to get from Laragon path
    $laragonPath = LARAGON_ROOT;
    $apacheGlob = glob($laragonPath . '/bin/apache/apache*/bin/httpd.exe');
    if (!empty($apacheGlob)) {
        $httpdPath = $apacheGlob[0];
        $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $httpdPath) . '\').VersionInfo.FileVersion"';
        $version = @shell_exec($command);
        if ($version && trim($version) !== '') {
            $parts = explode('.', trim($version));
            if (count($parts) >= 2) {
                return $parts[0] . '.' . $parts[1] . '.' . ($parts[2] ?? '0');
            }
            return trim($version);
        }
    }
    
    return 'Unknown';
}

/**
 * Get MySQL version
 */
function getMySQLVersion() {
    try {
        $laraconfig = getLaragonConfig();
        $oldErrorReporting = error_reporting(0);
        
        // Get MySQL password
        $mysqlPassword = MYSQL_PASSWORD ?? '';
        if (!$mysqlPassword && is_array($laraconfig) && isset($laraconfig['MySQLRootPassword'])) {
            $mysqlPassword = $laraconfig['MySQLRootPassword'];
        }
        
        // Get MySQL host and user
        $mysqlHost = MYSQL_HOST ?? 'localhost';
        $mysqlUser = MYSQL_USER ?? 'root';
        
        $link = @mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword);
        if (!$link) {
            $link = @mysqli_connect($mysqlHost, $mysqlUser, '');
        }
        if ($link) {
            $version = mysqli_get_server_info($link);
            mysqli_close($link);
            error_reporting($oldErrorReporting);
            return htmlspecialchars($version);
        }
        error_reporting($oldErrorReporting);
    } catch (Exception $e) {
        // Silently fail
    }
    return 'MySQL not running!';
}

/**
 * Get PHP version
 */
function getCurrentPHPVersion() {
    return PHP_VERSION;
}

/**
 * Get OpenSSL version
 */
function getOpenSSLVersion() {
    try {
        if (function_exists('openssl_version_text')) {
            $openssl = @openssl_version_text();
            if ($openssl && preg_match('/OpenSSL\s+([\d.]+)/i', $openssl, $matches)) {
                return $matches[1];
            }
        }
        
        // Fallback: try to get from SERVER_SOFTWARE
        $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
        if (preg_match('/OpenSSL\/([\d.]+)/i', $serverSoftware, $matches)) {
            return $matches[1];
        }
    } catch (Exception $e) {
        // Silently fail
    }
    
    return 'Unknown';
}

/**
 * Get PHP SAPI
 */
function getPHPSAPI() {
    return php_sapi_name();
}

/**
 * Get Document Root
 */
function getDocumentRoot() {
    return $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown';
}

/**
 * Get language configuration
 */
function getLanguageConfig() {
    try {
        // Try multiple possible paths for language config
        $possiblePaths = [
            ASSETS_ROOT . '/i18n/languages.php',
            APP_ROOT . '/assets/i18n/languages.php',
            __DIR__ . '/../assets/i18n/languages.php',
        ];
        
        foreach ($possiblePaths as $configFile) {
            if ($configFile && file_exists($configFile)) {
                $config = @require $configFile;
                return is_array($config) ? $config : [];
            }
        }
    } catch (Exception $e) {
        // Silently fail
    }
    
    // Return default language config if file not found
    return [
        'en' => ['name' => 'English', 'flag' => 'US'],
        'fr' => ['name' => 'French', 'flag' => 'FR'],
        'de' => ['name' => 'German', 'flag' => 'DE'],
        'es' => ['name' => 'Spanish', 'flag' => 'ES'],
    ];
}

/**
 * Get Laragon version
 */
function getLaragonVersion() {
    try {
        $laragonIniPath = LARAGON_ROOT . '/usr/laragon.ini';
        
        // Try to get version from laragon.exe
        $laragonExePath = LARAGON_ROOT . '/laragon.exe';
        if (file_exists($laragonExePath) && function_exists('shell_exec')) {
            $oldErrorReporting = error_reporting(0);
            $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $laragonExePath) . '\').VersionInfo.FileVersion"';
            $version = @shell_exec($command);
            error_reporting($oldErrorReporting);
            
            if ($version && trim($version) !== '') {
                $versionParts = explode('.', trim($version));
                if (count($versionParts) >= 3) {
                    $major = $versionParts[0];
                    $minor = $versionParts[1];
                    $patch = $versionParts[2];
                    $build = isset($versionParts[3]) ? $versionParts[3] : '';
                    
                    // Try to get build number from ini
                    $buildNumber = '';
                    if (file_exists($laragonIniPath)) {
                        $oldErrorReporting = error_reporting(0);
                        $laraconfig = parse_ini_file($laragonIniPath, false, INI_SCANNER_RAW);
                        error_reporting($oldErrorReporting);
                        if ($laraconfig !== false && is_array($laraconfig)) {
                            $buildNumber = $laraconfig['Build'] ?? '';
                        }
                    }
                    if ($buildNumber) {
                        return $major . '.' . $minor . '.' . $patch . '.' . $build . ' (' . $buildNumber . ')';
                    }
                    if ($build) {
                        return $major . '.' . $minor . '.' . $patch . '.' . $build;
                    }
                    return $major . '.' . $minor . '.' . $patch;
                }
                return trim($version);
            }
        }
        
        // Fallback to ini file
        if (file_exists($laragonIniPath)) {
            $oldErrorReporting = error_reporting(0);
            $laraconfig = parse_ini_file($laragonIniPath, false, INI_SCANNER_RAW);
            error_reporting($oldErrorReporting);
            
            if ($laraconfig !== false && is_array($laraconfig)) {
                $version = $laraconfig['Version'] ?? '';
                $build = $laraconfig['Build'] ?? '';
                if ($version && $build) {
                    return $version . ' (' . $build . ')';
                }
                return $version ?: 'Unknown';
            }
        }
    } catch (Exception $e) {
        // Silently fail
    }
    
    return 'Unknown';
}

