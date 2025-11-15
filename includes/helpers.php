<?php
/**
 * Laragon Dashboard - Helper Functions
 * Version: 3.0.0
 * Description: Helper functions for server information and utilities
 */

if (!defined('APP_ROOT')) {
    require_once __DIR__ . '/../config.php';
}

// Load i18n translation helper
if (file_exists(__DIR__ . '/i18n.php')) {
    require_once __DIR__ . '/i18n.php';
}

/**
 * Get Laragon configuration from laragon.ini
 */
if (!function_exists('getLaragonConfig')) {
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
}

/**
 * Get Apache version
 */
if (!function_exists('getApacheVersion')) {
    function getApacheVersion() {
        if (!defined('LARAGON_ROOT')) {
            return 'Unknown';
        }
        
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
}

/**
 * Get MySQL version
 */
if (!function_exists('getMySQLVersion')) {
    function getMySQLVersion() {
        try {
            $laraconfig = getLaragonConfig();
            $oldErrorReporting = error_reporting(0);
            
            // Get MySQL password
            $mysqlPassword = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';
            if (!$mysqlPassword && is_array($laraconfig) && isset($laraconfig['MySQLRootPassword'])) {
                $mysqlPassword = $laraconfig['MySQLRootPassword'];
            }
            
            // Get MySQL host and user
            $mysqlHost = defined('MYSQL_HOST') ? MYSQL_HOST : 'localhost';
            $mysqlUser = defined('MYSQL_USER') ? MYSQL_USER : 'root';
            
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
}

/**
 * Get PHP version
 */
if (!function_exists('getCurrentPHPVersion')) {
    function getCurrentPHPVersion() {
        return PHP_VERSION;
    }
}

/**
 * Get PHP ini file path
 */
if (!function_exists('getPHPIniPath')) {
    function getPHPIniPath() {
        $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
        if (empty($laragonRoot)) {
            return null;
        }
        
        // Get PHP version (e.g., "8.3.16")
        $phpVersion = PHP_VERSION;
        
        // Try to find php.ini in Laragon's PHP directory
        $phpDirs = glob($laragonRoot . '/bin/php/php-*');
        if (empty($phpDirs)) {
            return null;
        }
        
        // Find the directory that matches the current PHP version
        foreach ($phpDirs as $phpDir) {
            if (strpos(basename($phpDir), $phpVersion) !== false || 
                strpos($phpDir, str_replace('.', '', $phpVersion)) !== false) {
                $iniPath = $phpDir . '/php.ini';
                if (file_exists($iniPath)) {
                    return $iniPath;
                }
            }
        }
        
        // Fallback: use php --ini output
        $output = @shell_exec('php --ini 2>&1');
        if ($output && preg_match('/Loaded Configuration File:\s*(.+)/i', $output, $matches)) {
            $iniPath = trim($matches[1]);
            if (file_exists($iniPath)) {
                return $iniPath;
            }
        }
        
        // Last fallback: check the most recent PHP directory
        usort($phpDirs, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        $iniPath = $phpDirs[0] . '/php.ini';
        if (file_exists($iniPath)) {
            return $iniPath;
        }
        
        return null;
    }
}

/**
 * Get MySQL ini file path
 */
if (!function_exists('getMySQLIniPath')) {
    function getMySQLIniPath() {
        $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
        if (empty($laragonRoot)) {
            return null;
        }
        
        // Get MySQL version
        $mysqlVersion = getMySQLVersion();
        if ($mysqlVersion === 'MySQL not running!' || empty($mysqlVersion)) {
            // Try to find any MySQL installation
            $mysqlDirs = glob($laragonRoot . '/bin/mysql/mysql-*');
            if (!empty($mysqlDirs)) {
                // Sort by modification time (most recent first)
                usort($mysqlDirs, function($a, $b) {
                    return filemtime($b) - filemtime($a);
                });
                
                // Check common locations for my.ini
                foreach ($mysqlDirs as $mysqlDir) {
                    $possiblePaths = [
                        $mysqlDir . '/bin/my.ini',
                        $mysqlDir . '/my.ini',
                        $mysqlDir . '/my-default.ini'
                    ];
                    
                    foreach ($possiblePaths as $iniPath) {
                        if (file_exists($iniPath)) {
                            return $iniPath;
                        }
                    }
                }
            }
            return null;
        }
        
        // Extract version number from MySQL version string (e.g., "8.0.35" from "8.0.35-0ubuntu0.22.04.1")
        if (preg_match('/(\d+\.\d+\.\d+)/', $mysqlVersion, $matches)) {
            $versionNum = $matches[1];
        } else {
            $versionNum = '';
        }
        
        // Find MySQL directory matching the version
        $mysqlDirs = glob($laragonRoot . '/bin/mysql/mysql-*');
        if (empty($mysqlDirs)) {
            return null;
        }
        
        // Try to find directory matching the version
        foreach ($mysqlDirs as $mysqlDir) {
            $dirName = basename($mysqlDir);
            if (!empty($versionNum) && strpos($dirName, $versionNum) !== false) {
                // Check common locations for my.ini
                $possiblePaths = [
                    $mysqlDir . '/bin/my.ini',
                    $mysqlDir . '/my.ini',
                    $mysqlDir . '/my-default.ini'
                ];
                
                foreach ($possiblePaths as $iniPath) {
                    if (file_exists($iniPath)) {
                        return $iniPath;
                    }
                }
            }
        }
        
        // Fallback: use the most recent MySQL directory
        usort($mysqlDirs, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });
        
        foreach ($mysqlDirs as $mysqlDir) {
            $possiblePaths = [
                $mysqlDir . '/bin/my.ini',
                $mysqlDir . '/my.ini',
                $mysqlDir . '/my-default.ini'
            ];
            
            foreach ($possiblePaths as $iniPath) {
                if (file_exists($iniPath)) {
                    return $iniPath;
                }
            }
        }
        
        return null;
    }
}

/**
 * Get OpenSSL version
 */
if (!function_exists('getOpenSSLVersion')) {
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
}

/**
 * Get PHP SAPI
 */
if (!function_exists('getPHPSAPI')) {
    function getPHPSAPI() {
        return php_sapi_name();
    }
}

/**
 * Get Document Root
 */
if (!function_exists('getDocumentRoot')) {
    function getDocumentRoot() {
        return $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown';
    }
}

/**
 * Get language configuration
 */
if (!function_exists('getLanguageConfig')) {
    function getLanguageConfig() {
        try {
            // Try multiple possible paths for language config
            $possiblePaths = [
                APP_ROOT . '/i18n/languages.php',
                __DIR__ . '/../i18n/languages.php',
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
}

/**
 * Get Laragon version
 */
if (!function_exists('getLaragonVersion')) {
    function getLaragonVersion() {
        if (!defined('LARAGON_ROOT')) {
            return 'Unknown';
        }
        
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
}

/**
 * Get platform icon and gradient variant
 */
if (!function_exists('getPlatformIcon')) {
    function getPlatformIcon($platform) {
        $icons = [
            'WordPress' => 'devicon-plain:wordpress',
            'Laravel' => 'devicon-plain:laravel',
            'Drupal' => 'devicon-plain:drupal',
            'Joomla' => 'devicon-plain:joomla',
            'Symfony' => 'devicon-plain:symfony',
            'CakePHP' => 'devicon-plain:cakephp',
            'Python' => 'devicon-plain:python',
            'Next.js' => 'devicon-plain:nextjs',
            'Vue.js' => 'devicon-plain:vuejs',
            'React' => 'devicon-plain:react',
            'Angular' => 'devicon-plain:angular',
            'PHP' => 'devicon-plain:php',
            'ASP.NET' => 'devicon-plain:dotnetcore',
            'TypeScript' => 'devicon-plain:typescript',
            'Node.js' => 'devicon-plain:nodejs',
            'Other' => 'solar:folder-bold'
        ];
        
        return $icons[$platform] ?? $icons['Other'];
    }
}

/**
 * Get gradient variant number (1-10) for platform
 */
if (!function_exists('getPlatformGradient')) {
    function getPlatformGradient($platform, $index = 0) {
        // Map platforms to gradient variants (1-10)
        $gradientMap = [
            'WordPress' => 1,
            'Laravel' => 2,
            'Drupal' => 3,
            'Joomla' => 4,
            'Symfony' => 5,
            'CakePHP' => 6,
            'Python' => 7,
            'Next.js' => 8,
            'Vue.js' => 9,
            'React' => 10,
            'Angular' => 1, // Cycle back
            'Other' => 2
        ];
        
        $baseGradient = $gradientMap[$platform] ?? (($index % 10) + 1);
        
        // If we have multiple projects of same platform, cycle through variants
        return (($baseGradient + $index) % 10) + 1;
    }
}

/**
 * Detect favicon in common locations
 */
if (!function_exists('detectFavicon')) {
    function detectFavicon($folderPath) {
        // Common favicon locations (in order of priority)
        $faviconPaths = [
            // Root directory
            $folderPath . '/favicon.ico',
            $folderPath . '/favicon.png',
            $folderPath . '/favicon.jpg',
            $folderPath . '/favicon.jpeg',
            $folderPath . '/favicon.svg',
            
            // images/ directory
            $folderPath . '/images/favicon.ico',
            $folderPath . '/images/favicon.png',
            $folderPath . '/images/favicon.jpg',
            $folderPath . '/images/favicon.jpeg',
            $folderPath . '/images/favicon.svg',
            
            // assets/images/ directory
            $folderPath . '/assets/images/favicon.ico',
            $folderPath . '/assets/images/favicon.png',
            $folderPath . '/assets/images/favicon.jpg',
            $folderPath . '/assets/images/favicon.jpeg',
            $folderPath . '/assets/images/favicon.svg',
            
            // public/ directory (common in Laravel, Symfony, etc.)
            $folderPath . '/public/favicon.ico',
            $folderPath . '/public/favicon.png',
            $folderPath . '/public/favicon.jpg',
            $folderPath . '/public/favicon.jpeg',
            $folderPath . '/public/favicon.svg',
            
            // public/images/ directory
            $folderPath . '/public/images/favicon.ico',
            $folderPath . '/public/images/favicon.png',
            $folderPath . '/public/images/favicon.jpg',
            $folderPath . '/public/images/favicon.jpeg',
            $folderPath . '/public/images/favicon.svg',
            
            // static/ directory (common in Python/Django)
            $folderPath . '/static/favicon.ico',
            $folderPath . '/static/favicon.png',
            $folderPath . '/static/images/favicon.ico',
            $folderPath . '/static/images/favicon.png',
            
            // assets/ directory
            $folderPath . '/assets/favicon.ico',
            $folderPath . '/assets/favicon.png',
            
            // img/ directory
            $folderPath . '/img/favicon.ico',
            $folderPath . '/img/favicon.png',
        ];
        
        // Check each path
        foreach ($faviconPaths as $faviconPath) {
            if (file_exists($faviconPath) && is_file($faviconPath)) {
                return $faviconPath;
            }
        }
        
        // Check WordPress theme favicons
        if (is_dir($folderPath . '/wp-content/themes')) {
            $themeDirs = glob($folderPath . '/wp-content/themes/*', GLOB_ONLYDIR);
            foreach ($themeDirs as $themeDir) {
                $themeFavicons = [
                    $themeDir . '/favicon.ico',
                    $themeDir . '/favicon.png',
                    $themeDir . '/images/favicon.ico',
                    $themeDir . '/images/favicon.png',
                    $themeDir . '/assets/images/favicon.ico',
                    $themeDir . '/assets/images/favicon.png',
                ];
                foreach ($themeFavicons as $themeFavicon) {
                    if (file_exists($themeFavicon) && is_file($themeFavicon)) {
                        return $themeFavicon;
                    }
                }
            }
        }
        
        // Try to extract favicon from HTML files (index.html, index.php, etc.)
        $htmlFiles = [
            $folderPath . '/index.html',
            $folderPath . '/index.php',
            $folderPath . '/index.htm',
            $folderPath . '/public/index.html',
            $folderPath . '/public/index.php',
        ];
        
        foreach ($htmlFiles as $htmlFile) {
            if (file_exists($htmlFile) && is_file($htmlFile)) {
                $content = @file_get_contents($htmlFile);
                if ($content) {
                    // Look for favicon links in HTML
                    if (preg_match('/<link[^>]*rel=["\'](?:shortcut\s+)?icon["\'][^>]*href=["\']([^"\']+)["\']/i', $content, $matches)) {
                        $faviconHref = $matches[1];
                        // Resolve relative paths
                        if (strpos($faviconHref, 'http') === 0) {
                            continue; // Skip absolute URLs
                        }
                        // Remove query strings and anchors
                        $faviconHref = preg_replace('/[?#].*$/', '', $faviconHref);
                        // Remove leading slash if present
                        $faviconHref = ltrim($faviconHref, '/');
                        // Build full path
                        $htmlDir = dirname($htmlFile);
                        $resolvedPath = $htmlDir . '/' . $faviconHref;
                        $resolvedPath = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $resolvedPath);
                        // Normalize path
                        $resolvedPath = realpath($resolvedPath);
                        if ($resolvedPath && file_exists($resolvedPath) && is_file($resolvedPath)) {
                            return $resolvedPath;
                        }
                    }
                }
            }
        }
        
        return null;
    }
}

/**
 * Detect project platform from directory
 */
if (!function_exists('detectProjectPlatform')) {
    function detectProjectPlatform($folderPath) {
        $platform = 'Other';
        $icon = 'solar:folder-bold';
        $color = 'secondary';
        
        // Detect favicon first (comprehensive search)
        $favicon = detectFavicon($folderPath);
        
        // Platform detection (check WordPress first via wp-admin)
        $isWordPress = false;
        if (file_exists($folderPath . '/wp-admin') || file_exists($folderPath . '/wp-config.php') || file_exists($folderPath . '/wp-load.php')) {
            $platform = 'WordPress';
            $icon = 'solar:document-bold';
            $color = 'primary';
            $isWordPress = true;
        } elseif (file_exists($folderPath . '/artisan') && is_dir($folderPath . '/app') && file_exists($folderPath . '/composer.json')) {
            $platform = 'Laravel';
            $icon = 'solar:code-bold';
            $color = 'danger';
        } elseif ((file_exists($folderPath . '/core') || file_exists($folderPath . '/web/core')) && file_exists($folderPath . '/composer.json')) {
            $platform = 'Drupal';
            $icon = 'solar:code-square-bold';
            $color = 'warning';
        } elseif (file_exists($folderPath . '/administrator') && file_exists($folderPath . '/configuration.php')) {
            $platform = 'Joomla';
            $icon = 'solar:widget-5-bold';
            $color = 'success';
        } elseif (file_exists($folderPath . '/bin/console') && file_exists($folderPath . '/composer.json')) {
            $platform = 'Symfony';
            $icon = 'solar:settings-bold';
            $color = 'info';
        } elseif (file_exists($folderPath . '/bin/cake') && file_exists($folderPath . '/composer.json')) {
            $platform = 'CakePHP';
            $icon = 'solar:cake-bold';
            $color = 'secondary';
        } elseif (file_exists($folderPath . '/app.py') || (is_dir($folderPath . '/static') && file_exists($folderPath . '/requirements.txt'))) {
            $platform = 'Python';
            $icon = 'solar:code-2-bold';
            $color = 'warning';
        } elseif (file_exists($folderPath . '/package.json') && file_exists($folderPath . '/next.config.js')) {
            $platform = 'Next.js';
            $icon = 'solar:code-2-bold';
            $color = 'info';
        } elseif (file_exists($folderPath . '/package.json') && file_exists($folderPath . '/vue.config.js')) {
            $platform = 'Vue.js';
            $icon = 'solar:code-2-bold';
            $color = 'success';
        } elseif (file_exists($folderPath . '/package.json') && file_exists($folderPath . '/angular.json')) {
            $platform = 'Angular';
            $icon = 'solar:code-2-bold';
            $color = 'danger';
        } elseif (file_exists($folderPath . '/package.json') && file_exists($folderPath . '/react')) {
            $platform = 'React';
            $icon = 'solar:code-2-bold';
            $color = 'primary';
        } else {
            // Detect by file extensions if no framework detected
            $phpFiles = glob($folderPath . '/*.php');
            $aspxFiles = array_merge(
                glob($folderPath . '/*.aspx') ?: [],
                glob($folderPath . '/*.asp') ?: []
            );
            $tsFiles = array_merge(
                glob($folderPath . '/*.ts') ?: [],
                file_exists($folderPath . '/tsconfig.json') ? [$folderPath . '/tsconfig.json'] : []
            );
            $jsFiles = file_exists($folderPath . '/package.json') ? [$folderPath . '/package.json'] : [];
            
            if (!empty($phpFiles)) {
                $platform = 'PHP';
                $icon = 'devicon-plain:php';
                $color = 'info';
            } elseif (!empty($aspxFiles)) {
                $platform = 'ASP.NET';
                $icon = 'devicon-plain:dotnetcore';
                $color = 'primary';
            } elseif (!empty($tsFiles)) {
                $platform = 'TypeScript';
                $icon = 'devicon-plain:typescript';
                $color = 'info';
            } elseif (!empty($jsFiles)) {
                $platform = 'Node.js';
                $icon = 'devicon-plain:nodejs';
                $color = 'success';
            }
        }
        
        // Get iconify icon for platform
        $iconifyIcon = getPlatformIcon($platform);
        
        // If WordPress and no favicon found, ensure WordPress icon is used
        if ($isWordPress && !$favicon) {
            // WordPress icon will be used as fallback
        }
        
        return [
            'platform' => $platform,
            'icon' => $iconifyIcon,
            'iconify' => $iconifyIcon,
            'color' => $color,
            'favicon' => $favicon
        ];
    }
}

/**
 * Get all projects from document root
 */
if (!function_exists('getAllProjects')) {
    function getAllProjects() {
        if (!defined('LARAGON_ROOT')) {
            return [];
        }
        
        $laraconfig = getLaragonConfig();
        $documentRoot = $laraconfig['DocumentRoot'] ?? (LARAGON_ROOT . '/www');
        
        if (!is_dir($documentRoot)) {
            return [];
        }
        
        // Determine URL protocol
        $url = 'http';
        if (isset($laraconfig['SSLEnabled']) && $laraconfig['SSLEnabled'] == 1) {
            $url = 'https';
        } elseif (isset($laraconfig['Port']) && $laraconfig['Port'] == 443) {
            $url = 'https';
        }
        
        $domainSuffix = defined('DOMAIN_SUFFIX') ? DOMAIN_SUFFIX : '.local';
        
        $ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard', 'phpmyadmin'];
        $folders = array_filter(glob($documentRoot . '/*'), 'is_dir');
        sort($folders, SORT_NATURAL | SORT_FLAG_CASE);
        
        $projects = [];
        
        foreach ($folders as $folderPath) {
            $host = basename($folderPath);
            if (in_array($host, $ignore_dirs) || !is_dir($folderPath)) {
                continue;
            }
            
            $detection = detectProjectPlatform($folderPath);
            
            // Convert favicon path to web-accessible URL if it exists
            $faviconUrl = null;
            if ($detection['favicon']) {
                // Normalize path separators
                $faviconPath = str_replace('\\', '/', $detection['favicon']);
                $documentRootNormalized = rtrim(str_replace('\\', '/', $documentRoot), '/');
                
                // Try to find the favicon path relative to document root
                if (stripos($faviconPath, $documentRootNormalized) === 0) {
                    // Favicon is within document root
                    // Remove document root prefix and leading slash
                    $relativePath = substr($faviconPath, strlen($documentRootNormalized));
                    $faviconUrl = ltrim($relativePath, '/'); // Remove leading slash if present
                } else {
                    // Fallback: try to find relative path from project folder
                    $projectPathNormalized = rtrim(str_replace('\\', '/', $folderPath), '/');
                    if (stripos($faviconPath, $projectPathNormalized) === 0) {
                        // Favicon is within project folder
                        $relativePath = substr($faviconPath, strlen($projectPathNormalized));
                        $relativePath = ltrim($relativePath, '/'); // Remove leading slash
                        $faviconUrl = $host . '/' . $relativePath;
                    } else {
                        // Last resort: use project name + filename
                        $faviconUrl = $host . '/' . basename($detection['favicon']);
                    }
                }
            }
            
            // Get gradient variant for this project
            $gradientVariant = getPlatformGradient($detection['platform'], count($projects));
            
            $project = [
                'name' => $host,
                'path' => $folderPath,
                'url' => $url . '://' . $host . $domainSuffix,
                'platform' => $detection['platform'],
                'icon' => $detection['iconify'],
                'iconify' => $detection['iconify'],
                'color' => $detection['color'],
                'favicon' => $faviconUrl,
                'gradient' => $gradientVariant,
                'is_wordpress' => ($detection['platform'] === 'WordPress')
            ];
            
            $projects[] = $project;
        }
        
        return $projects;
    }
}

/**
 * Check if phpMyAdmin is installed
 */
if (!function_exists('isPhpMyAdminInstalled')) {
    function isPhpMyAdminInstalled() {
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $phpmyadminPath = str_replace('\\', '/', $docRoot . '/phpmyadmin');
        
        // Check common locations
        if (is_dir($phpmyadminPath)) {
            return true;
        }
        
        // Check alternative location
        $phpMyAdminPath = str_replace('\\', '/', $docRoot . '/phpMyAdmin');
        if (is_dir($phpMyAdminPath)) {
            return true;
        }
        
        // Check Laragon www directory
        if (defined('LARAGON_ROOT')) {
            $laragonPhpmyadmin = LARAGON_ROOT . '/www/phpmyadmin';
            if (is_dir($laragonPhpmyadmin)) {
                return true;
            }
        }
        
        return false;
    }
}

/**
 * Get phpMyAdmin installation path
 */
if (!function_exists('getPhpMyAdminPath')) {
    function getPhpMyAdminPath() {
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $phpmyadminPath = str_replace('\\', '/', $docRoot . '/phpmyadmin');
        
        if (is_dir($phpmyadminPath)) {
            return $phpmyadminPath;
        }
        
        $phpMyAdminPath = str_replace('\\', '/', $docRoot . '/phpMyAdmin');
        if (is_dir($phpMyAdminPath)) {
            return $phpMyAdminPath;
        }
        
        if (defined('LARAGON_ROOT')) {
            $laragonPhpmyadmin = LARAGON_ROOT . '/www/phpmyadmin';
            if (is_dir($laragonPhpmyadmin)) {
                return $laragonPhpmyadmin;
            }
        }
        
        return null;
    }
}

/**
 * Get phpMyAdmin version if available
 */
if (!function_exists('getPhpMyAdminVersion')) {
    function getPhpMyAdminVersion() {
        $path = getPhpMyAdminPath();
        if (!$path) {
            return null;
        }
        
        // Check for VERSION file
        $versionFile = $path . '/VERSION';
        if (file_exists($versionFile)) {
            $version = trim(@file_get_contents($versionFile));
            if (!empty($version)) {
                return $version;
            }
        }
        
        // Check for version in composer.json
        $composerFile = $path . '/composer.json';
        if (file_exists($composerFile)) {
            $composer = @json_decode(file_get_contents($composerFile), true);
            if (isset($composer['version'])) {
                return $composer['version'];
            }
        }
        
        return null;
    }
}

/**
 * Check if Adminer is installed
 */
if (!function_exists('isAdminerInstalled')) {
    function isAdminerInstalled($basePath = 'assets/adminer') {
        if (!class_exists('AdminerModule')) {
            $adminerModulePath = __DIR__ . '/AdminerModule.php';
            if (file_exists($adminerModulePath)) {
                require_once $adminerModulePath;
            } else {
                return false;
            }
        }
        
        return AdminerModule::check($basePath);
    }
}

/**
 * Get Adminer URL
 */
if (!function_exists('getAdminerUrl')) {
    function getAdminerUrl($basePath = 'assets/adminer', $database = null) {
        if (!class_exists('AdminerModule')) {
            $adminerModulePath = __DIR__ . '/AdminerModule.php';
            if (file_exists($adminerModulePath)) {
                require_once $adminerModulePath;
            } else {
                return null;
            }
        }
        
        $instance = new AdminerModule(['base_path' => $basePath]);
        return $instance->getUrl($database);
    }
}

/**
 * Simple parameter sanitization helper
 * Replaces Router::getParam() functionality
 */
if (!function_exists('getParam')) {
    function getParam($key, $default = '') {
        if (!isset($_GET[$key])) {
            return $default;
        }
        
        $value = $_GET[$key];
        
        // Basic sanitization
        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        
        // Prevent directory traversal
        $value = str_replace(['../', '..\\', '/', '\\'], '', $value);
        
        // Limit length
        if (strlen($value) > 255) {
            $value = substr($value, 0, 255);
        }
        
        return $value;
    }
}

/**
 * Get current page name
 */
if (!function_exists('getCurrentPage')) {
    function getCurrentPage() {
        $page = $_GET['page'] ?? '';
        
        // If no page, check if we're on index.php
        if (empty($page)) {
            $scriptName = basename($_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? 'index.php');
            if ($scriptName === 'index.php' || $scriptName === 'index') {
                return 'dashboard';
            }
            return basename($scriptName, '.php');
        }
        
        // Sanitize page name
        $page = basename($page);
        $page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);
        
        return strtolower($page);
    }
}

