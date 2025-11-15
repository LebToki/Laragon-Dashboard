<?php
/**
 * Application: Laragon | Services Helpers
 * Description: Heavy helper functions for server information
 * Version: 2.6.1
 */

if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__, 2));
}

if (!defined('DASHBOARD_ROOT')) {
    define('DASHBOARD_ROOT', dirname(__DIR__, 1));
}

/**
 * Get Laragon configuration
 */
function getLaragonConfig() {
    if (!defined('APP_ROOT')) {
        return [];
    }
    
    $laragonIniPath = APP_ROOT . '/usr/laragon.ini';
    if (!file_exists($laragonIniPath)) {
        $laragonRoot = dirname(APP_ROOT);
        $laragonIniPath = $laragonRoot . '/usr/laragon.ini';
    }
    
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
        $mysqlPassword = getenv('MYSQL_PASSWORD');
        if (!$mysqlPassword && is_array($laraconfig) && isset($laraconfig['MySQLRootPassword'])) {
            $mysqlPassword = $laraconfig['MySQLRootPassword'];
        }
        if (!$mysqlPassword) {
            $mysqlPassword = '';
        }
        
        // Get MySQL host
        $mysqlHost = MYSQL_HOST ?? getenv('MYSQL_HOST') ?: 'localhost';
        
        // Get MySQL user
        $mysqlUser = MYSQL_USER ?? getenv('MYSQL_USER') ?: 'root';
        
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
 * Get PHP version (simple string version for display)
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
 * Get Laragon version
 */
function getLaragonVersion() {
    try {
        if (!defined('APP_ROOT')) {
            return 'Unknown';
        }
        
        $laragonIniPath = APP_ROOT . '/usr/laragon.ini';
        if (!file_exists($laragonIniPath)) {
            $laragonRoot = dirname(APP_ROOT);
            $laragonIniPath = $laragonRoot . '/usr/laragon.ini';
        }
        
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $laragonRoot = 'C:/laragon';
        if (strpos($docRoot, 'laragon') !== false) {
            $parts = explode('laragon', $docRoot);
            if (!empty($parts[0])) {
                $laragonRoot = $parts[0] . 'laragon';
            }
        }
        
        // Try to get version from laragon.exe
        $laragonExePath = str_replace('/', DIRECTORY_SEPARATOR, $laragonRoot . '/laragon.exe');
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
                    
                    // Format: 8.3.0.25 (1006) - check for build number in parentheses
                    if ($build) {
                        // Try to get build number from file properties or ini
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

