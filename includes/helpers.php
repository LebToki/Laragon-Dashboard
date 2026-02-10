<?php
/**
 * Laragon Dashboard - Helper Functions
 * Version: 3.1.6
 * Provides utility functions for the dashboard
 */

// Start output buffering to prevent stray output
ob_start();

/**
 * Get Laragon root directory
 */
if (!function_exists('getLaragonRoot')) {
    function getLaragonRoot() {
        // Check environment variable first
        if (getenv('LARAGON_ROOT')) {
            return getenv('LARAGON_ROOT');
        }
        
        // Check common Laragon installation paths
        $possiblePaths = ['C:/laragon', 'D:/laragon', 'E:/laragon'];
        
        // Also check if we're being accessed through Laragon's web server
        if (isset($_SERVER['DOCUMENT_ROOT'])) {
            $docRoot = $_SERVER['DOCUMENT_ROOT'];
            // Check if the document root contains 'laragon'
            if (stripos($docRoot, 'laragon') !== false) {
                return $docRoot;
            }
        }
        
        foreach ($possiblePaths as $path) {
            if (is_dir($path)) {
                return $path;
            }
        }
        
        // Default fallback
        return 'C:/laragon';
    }
}

/**
 * Get Laragon sendmail directory
 */
if (!function_exists('getLaragonSendmailDir')) {
    function getLaragonSendmailDir() {
        $laragonRoot = getLaragonRoot();
        $sendmailPath = $laragonRoot . '/bin/sendmail/output/';
        
        // Create directory if it doesn't exist
        if (!is_dir($sendmailPath)) {
            @mkdir($sendmailPath, 0755, true);
        }
        
        return $sendmailPath;
    }
}

/**
 * Get Laragon domain suffix
 */
if (!function_exists('getLaragonDomainSuffix')) {
    function getLaragonDomainSuffix() {
        return '.local';
    }
}

/**
 * Get application version
 */
if (!function_exists('getAppVersion')) {
    function getAppVersion() {
        // Check for VERSION file
        $versionFile = dirname(__DIR__) . '/VERSION';
        if (file_exists($versionFile)) {
            $version = trim(file_get_contents($versionFile));
            if (!empty($version)) {
                return $version;
            }
        }
        
        // Try to get from Git
        $gitHeadFile = dirname(__DIR__) . '/.git/HEAD';
        if (file_exists($gitHeadFile)) {
            $headContent = trim(file_get_contents($gitHeadFile));
            if (preg_match('/refs\/heads\/(.+)$/', $headContent, $matches)) {
                $branch = $matches[1];
                // Try to get the latest commit hash
                $headRefFile = dirname(__DIR__) . '/.git/' . trim(file_get_contents(dirname(__DIR__) . '/.git/HEAD'));
                if (file_exists($headRefFile)) {
                    $commitHash = substr(trim(file_get_contents($headRefFile)), 0, 7);
                    return 'dev-' . $branch . '+' . $commitHash;
                }
                return 'dev-' . $branch;
            } elseif (preg_match('/([a-f0-9]+)/', $headContent, $matches)) {
                // Detached HEAD state
                return 'dev-detached+' . substr($matches[1], 0, 7);
            }
        }
        
        // Fallback to APP_VERSION constant if defined
        if (defined('APP_VERSION')) {
            return APP_VERSION;
        }
        
        return '3.0.0';
    }
}

/**
 * Get Apache version
 */
if (!function_exists('getApacheVersion')) {
    function getApacheVersion() {
        $output = @shell_exec('httpd -v 2>&1');
        if ($output && preg_match('/Apache\/(\d+\.\d+\.\d+)/', $output, $matches)) {
            return $matches[1];
        }
        
        // Alternative: Try to get from Laragon
        $laragonRoot = getLaragonRoot();
        $apachePath = $laragonRoot . '/bin/apache/httpd-2.4.*/bin/httpd.exe';
        if (glob($apachePath)) {
            return '2.4.x';
        }
        
        return 'Unknown';
    }
}

/**
 * Get current PHP version (simplified to avoid truncation)
 */
if (!function_exists('getCurrentPHPVersion')) {
    function getCurrentPHPVersion() {
        // Simply return the running PHP version to avoid truncation
        return htmlspecialchars(PHP_VERSION);
    }
}

/**
 * Get MySQL version
 */
if (!function_exists('getMySQLVersion')) {
    function getMySQLVersion() {
        // Try to get MySQL version from command line
        $output = @shell_exec('mysql -V 2>&1');
        if ($output && preg_match('/(\d+\.\d+\.\d+)/', $output, $matches)) {
            return $matches[1] . ' (MySQL)';
        }
        
        // Alternative: Try Laragon's MySQL path
        $laragonRoot = getLaragonRoot();
        $mysqlPath = $laragonRoot . '/bin/mysql/mysql-*/bin/mysql.exe';
        if (glob($mysqlPath)) {
            return 'MySQL (Laragon)';
        }
        
        return 'MySQL';
    }
}

/**
 * Get OpenSSL version
 */
if (!function_exists('getOpenSSLVersion')) {
    function getOpenSSLVersion() {
        $output = @shell_exec('openssl version 2>&1');
        if ($output && preg_match('/OpenSSL\s+(\S+)/', $output, $matches)) {
            return $matches[1];
        }
        
        return 'OpenSSL';
    }
}

/**
 * Get PHP SAPI
 */
if (!function_exists('getPHPSAPI')) {
    function getPHPSAPI() {
        return PHP_SAPI;
    }
}

/**
 * Get document root
 */
if (!function_exists('getDocumentRoot')) {
    function getDocumentRoot() {
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        
        // Check if it's a Laragon www directory
        if (stripos($docRoot, 'laragon') !== false) {
            return $docRoot;
        }
        
        // Check if there's a www subdirectory in Laragon
        $laragonRoot = getLaragonRoot();
        $wwwPath = $laragonRoot . '/www';
        if (is_dir($wwwPath)) {
            return $wwwPath;
        }
        
        return $docRoot ?: $laragonRoot . '/www';
    }
}

/**
 * Get Laragon version
 */
if (!function_exists('getLaragonVersion')) {
    function getLaragonVersion() {
        $laragonRoot = getLaragonRoot();
        $versionFile = $laragonRoot . '/laragon.ini';
        
        if (file_exists($versionFile)) {
            $content = @file_get_contents($versionFile);
            if (preg_match('/version=(\d+\.\d+\.\d+)/', $content, $matches)) {
                return $matches[1];
            }
        }
        
        // Try to find Laragon executable
        $laragonExe = $laragonRoot . '/laragon.exe';
        if (file_exists($laragonExe)) {
            $versionInfo = @file_get_contents($laragonExe, false, null, 0, 100);
            if (preg_match('/(\d+\.\d+\.\d+)/', $versionInfo, $matches)) {
                return $matches[1];
            }
        }
        
        return 'Laragon';
    }
}

/**
 * Get all projects from www directory
 */
if (!function_exists('getAllProjects')) {
    function getAllProjects() {
        $laragonRoot = getLaragonRoot();
        $wwwPath = $laragonRoot . '/www';
        
        if (!is_dir($wwwPath)) {
            return [];
        }
        
        $projects = [];
        $ignoredProjects = getIgnoredProjects();
        
        $dirs = glob($wwwPath . '/*', GLOB_ONLYDIR);
        
        foreach ($dirs as $dir) {
            $name = basename($dir);
            
            // Skip hidden directories and common non-project directories
            if ($name[0] === '.' || in_array($name, ['laragon', 'dashboard', 'phpmyadmin', 'adminer', 'phppgadmin'])) {
                continue;
            }
            
            // Skip ignored projects
            if (in_array($name, $ignoredProjects)) {
                continue;
            }
            
            $project = analyzeProject($dir, $name);
            if ($project) {
                $projects[] = $project;
            }
        }
        
        return $projects;
    }
}

/**
 * Analyze a project directory
 */
if (!function_exists('analyzeProject')) {
    function analyzeProject($path, $name) {
        $project = [
            'name' => $name,
            'path' => $path,
            'url' => 'http://' . $name . '.local',
            'platform' => 'Unknown',
            'icon' => 'solar:folder-bold',
            'iconify' => null,
            'color' => 'primary',
            'is_wordpress' => false,
            'has_composer' => file_exists($path . '/composer.json'),
            'has_npm' => file_exists($path . '/package.json'),
            'has_git' => is_dir($path . '/.git'),
            'git_branch' => null,
            'git_status' => null,
            'favicon' => null,
        ];
        
        // Check for WordPress
        if (file_exists($path . '/wp-config.php') || file_exists($path . '/wp-includes/version.php')) {
            $project['platform'] = 'WordPress';
            $project['icon'] = 'devicon-plain:wordpress';
            $project['color'] = 'primary';
            $project['is_wordpress'] = true;
            
            // Try to find WordPress favicon
            $wpContentPath = $path . '/wp-content';
            if (is_dir($wpContentPath)) {
                $faviconPath = findFile($wpContentPath, ['favicon.ico', 'favicon.png', 'site-icon.png']);
                if ($faviconPath) {
                    $project['favicon'] = str_replace($laragonRoot . '/www/', '', $faviconPath);
                }
            }
        }
        // Check for Laravel
        elseif (file_exists($path . '/artisan')) {
            $project['platform'] = 'Laravel';
            $project['icon'] = 'devicon-plain:laravel';
            $project['color'] = 'danger';
        }
        // Check for Drupal
        elseif (file_exists($path . '/core/lib/Drupal.php') || file_exists($path . '/autoload.php')) {
            $project['platform'] = 'Drupal';
            $project['icon'] = 'devicon-plain:drupal';
            $project['color'] = 'info';
        }
        // Check for CodeIgniter
        elseif (file_exists($path . '/index.php') && file_exists($path . '/system/core/Controller.php')) {
            $project['platform'] = 'CodeIgniter';
            $project['icon'] = 'devicon-plain:codeigniter';
            $project['color'] = 'warning';
        }
        // Check for Symfony
        elseif (file_exists($path . '/bin/console') || (is_dir($path . '/src') && file_exists($path . '/composer.json') && strpos(file_get_contents($path . '/composer.json'), 'symfony/framework-bundle') !== false)) {
            $project['platform'] = 'Symfony';
            $project['icon'] = 'devicon-plain:symfony';
            $project['color'] = 'dark';
        }
        // Check for CakePHP
        elseif (file_exists($path . '/config/bootstrap.php') && file_exists($path . '/src/Controller/AppController.php')) {
            $project['platform'] = 'CakePHP';
            $project['icon'] = 'devicon-plain:cakephp';
            $project['color'] = 'success';
        }
        // Check for Joomla
        elseif (file_exists($path . '/configuration.php') && (file_exists($path . '/includes/defines.php') || file_exists($path . '/libraries/cms/version/version.php'))) {
            $project['platform'] = 'Joomla';
            $project['icon'] = 'devicon-plain:joomla';
            $project['color'] = 'info';
        }
        // Check for static HTML
        elseif (file_exists($path . '/index.html') && !file_exists($path . '/composer.json') && !file_exists($path . '/package.json')) {
            $project['platform'] = 'Static HTML';
            $project['icon'] = 'devicon-plain:html5';
            $project['color'] = 'warning';
        }
        // Check for Node.js
        elseif (file_exists($path . '/package.json') && !file_exists($path . '/composer.json')) {
            $project['platform'] = 'Node.js';
            $project['icon'] = 'devicon-plain:nodejs';
            $project['color'] = 'success';
        }
        // Default to PHP
        else {
            $project['platform'] = 'PHP';
            $project['icon'] = 'devicon-plain:php';
            $project['color'] = 'primary';
        }
        
        // Try to find favicon for non-WordPress projects
        if (!$project['favicon']) {
            $faviconPath = findFile($path, ['favicon.ico', 'favicon.png', 'favicon.svg']);
            if ($faviconPath) {
                $project['favicon'] = str_replace($laragonRoot . '/www/', '', $faviconPath);
            }
        }
        
        // Check for Git branch and status
        if ($project['has_git']) {
            $branch = @shell_exec('cd ' . escapeshellarg($path) . ' && git rev-parse --abbrev-ref HEAD 2>&1');
            $project['git_branch'] = trim($branch) ?: 'unknown';
            
            $status = @shell_exec('cd ' . escapeshellarg($path) . ' && git status --porcelain 2>&1');
            $project['git_status'] = !empty(trim($status)) ? 'modified' : 'clean';
        }
        
        return $project;
    }
}

/**
 * Find a file in a directory recursively
 */
if (!function_exists('findFile')) {
    function findFile($dir, $filenames) {
        foreach ($filenames as $filename) {
            $path = $dir . '/' . $filename;
            if (file_exists($path)) {
                return $path;
            }
        }
        
        // Search in subdirectories
        $subdirs = glob($dir . '/*', GLOB_ONLYDIR);
        foreach ($subdirs as $subdir) {
            $result = findFile($subdir, $filenames);
            if ($result) {
                return $result;
            }
        }
        
        return null;
    }
}

/**
 * Get list of ignored projects
 */
if (!function_exists('getIgnoredProjects')) {
    function getIgnoredProjects() {
        $ignoredFile = dirname(__DIR__) . '/data/ignored_projects.json';
        
        if (file_exists($ignoredFile)) {
            $content = @file_get_contents($ignoredFile);
            if ($content) {
                $ignored = json_decode($content, true);
                if (is_array($ignored)) {
                    return $ignored;
                }
            }
        }
        
        return [];
    }
}

/**
 * Ignore a project
 */
if (!function_exists('ignoreProject')) {
    function ignoreProject($projectName) {
        $ignored = getIgnoredProjects();
        
        if (!in_array($projectName, $ignored)) {
            $ignored[] = $projectName;
            
            $ignoredFile = dirname(__DIR__) . '/data/ignored_projects.json';
            @file_put_contents($ignoredFile, json_encode($ignored, JSON_PRETTY_PRINT));
        }
    }
}

/**
 * Unignore a project
 */
if (!function_exists('unignoreProject')) {
    function unignoreProject($projectName) {
        $ignored = getIgnoredProjects();
        $ignored = array_filter($ignored, function($name) use ($projectName) {
            return $name !== $projectName;
        });
        
        $ignoredFile = dirname(__DIR__) . '/data/ignored_projects.json';
        @file_put_contents($ignoredFile, json_encode(array_values($ignored), JSON_PRETTY_PRINT));
    }
}

/**
 * Get services status
 */
if (!function_exists('getServicesStatus')) {
    function getServicesStatus() {
        $services = [
            'Apache' => ['name' => 'Apache', 'display' => 'Apache', 'port' => 80],
            'MySQL' => ['name' => 'MySQL', 'display' => 'MySQL', 'port' => 3306],
            'Redis' => ['name' => 'Redis', 'display' => 'Redis', 'port' => 6379],
            'Memcached' => ['name' => 'Memcached', 'display' => 'Memcached', 'port' => 11211],
            'PostgreSQL' => ['name' => 'PostgreSQL', 'display' => 'PostgreSQL', 'port' => 5432],
        ];
        
        $status = [];
        
        foreach ($services as $key => $service) {
            $status[$key] = [
                'name' => $service['display'],
                'running' => isPortInUse($service['port']),
                'port' => $service['port'],
            ];
            
            // Try Windows service check as well
            $output = @shell_exec('sc query "' . $service['name'] . '" 2>&1');
            $status[$key]['windows_service'] = strpos($output, 'RUNNING') !== false;
        }
        
        return $status;
    }
}

/**
 * Check if a port is in use
 */
if (!function_exists('isPortInUse')) {
    function isPortInUse($port) {
        $output = @shell_exec('netstat -an | findstr :' . $port . ' 2>&1');
        return !empty(trim($output));
    }
}

/**
 * Get listening ports
 */
if (!function_exists('getListeningPorts')) {
    function getListeningPorts() {
        $output = @shell_exec('netstat -an 2>&1');
        $ports = [];
        
        if (preg_match_all('/LISTENING\s+(\d+)\s+.*?:(\d+)/', $output, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $ports[] = [
                    'pid' => $match[1],
                    'port' => $match[2],
                ];
            }
        }
        
        return $ports;
    }
}

/**
 * Start a service
 */
if (!function_exists('startService')) {
    function startService($service) {
        $services = [
            'Apache' => 'Apache2.4',
            'MySQL' => 'MySQL',
            'Nginx' => 'Nginx',
        ];
        
        if (isset($services[$service])) {
            $output = @shell_exec('net start "' . $services[$service] . '" 2>&1');
            return strpos($output, 'was started successfully') !== false || strpos($output, 'running') !== false;
        }
        
        return false;
    }
}

/**
 * Stop a service
 */
if (!function_exists('stopService')) {
    function stopService($service) {
        $services = [
            'Apache' => 'Apache2.4',
            'MySQL' => 'MySQL',
            'Nginx' => 'Nginx',
        ];
        
        if (isset($services[$service])) {
            $output = @shell_exec('net stop "' . $services[$service] . '" 2>&1');
            return strpos($output, 'was stopped successfully') !== false || strpos($output, 'stopped') !== false;
        }
        
        return false;
    }
}

/**
 * Restart a service
 */
if (!function_exists('restartService')) {
    function restartService($service) {
        stopService($service);
        sleep(1);
        return startService($service);
    }
}

/**
 * Get log files
 */
if (!function_exists('getLogFiles')) {
    function getLogFiles() {
        $laragonRoot = getLaragonRoot();
        
        $logs = [
            'apache_error' => [
                'name' => 'Apache Error Log',
                'path' => $laragonRoot . '/logs/apache_error.log',
                'type' => 'error',
            ],
            'apache_access' => [
                'name' => 'Apache Access Log',
                'path' => $laragonRoot . '/logs/apache_access.log',
                'type' => 'access',
            ],
            'php_error' => [
                'name' => 'PHP Error Log',
                'path' => $laragonRoot . '/logs/php_error.log',
                'type' => 'error',
            ],
            'mysql_error' => [
                'name' => 'MySQL Error Log',
                'path' => $laragonRoot . '/logs/mysql_error.log',
                'type' => 'error',
            ],
            'mysql_slow' => [
                'name' => 'MySQL Slow Query Log',
                'path' => $laragonRoot . '/logs/mysql_slow.log',
                'type' => 'slow',
            ],
            'laragon' => [
                'name' => 'Laragon Log',
                'path' => $laragonRoot . '/logs/laragon.log',
                'type' => 'laragon',
            ],
        ];
        
        // Filter out non-existent logs
        return array_filter($logs, function($log) {
            return file_exists($log['path']);
        });
    }
}

/**
 * Read log file
 */
if (!function_exists('readLogFile')) {
    function readLogFile($path, $lines = 100) {
        if (!file_exists($path)) {
            return ['error' => 'Log file not found'];
        }
        
        // Use tail command on Windows
        $path = str_replace('\\', '/', $path);
        $output = @shell_exec("powershell -Command \"Get-Content '$path' | Select-Object -Last $lines\" 2>&1");
        
        if (empty($output)) {
            // Fallback to reading entire file
            $output = @file_get_contents($path);
        }
        
        return [
            'content' => $output,
            'lines' => substr_count($output, "\n") + 1,
        ];
    }
}

/**
 * Clear log file
 */
if (!function_exists('clearLogFile')) {
    function clearLogFile($path) {
        if (file_exists($path)) {
            return @file_put_contents($path, '');
        }
        return false;
    }
}

/**
 * Create a project
 */
if (!function_exists('createProject')) {
    function createProject($name, $type, $options = []) {
        $laragonRoot = getLaragonRoot();
        $wwwPath = $laragonRoot . '/www/' . $name;
        
        if (is_dir($wwwPath)) {
            return ['success' => false, 'error' => 'Project already exists'];
        }
        
        $commands = [];
        
        switch ($type) {
            case 'laravel':
                // Create Laravel project using composer
                $commands[] = 'cd ' . escapeshellarg($laragonRoot . '/www') . ' && composer create-project laravel/laravel ' . escapeshellarg($name) . ' --prefer-dist';
                break;
                
            case 'wordpress':
                // Create WordPress using WP-CLI if available, otherwise download
                $commands[] = 'cd ' . escapeshellarg($laragonRoot . '/www') . ' && if exist wp-cli.phar (php wp-cli.phar core download --locale=en_US) else (curl -O https://wordpress.org/latest.tar.gz && tar -xzf latest.tar.gz && mv wordpress ' . escapeshellarg($name) . ' && del latest.tar.gz)';
                break;
                
            case 'nodejs':
                // Create Node.js project
                $commands[] = 'cd ' . escapeshellarg($wwwPath) . ' && npm init -y';
                break;
                
            case 'static':
                // Create basic static files
                $commands[] = 'mkdir ' . escapeshellarg($wwwPath);
                $commands[] = 'echo "<!DOCTYPE html><html><head><title>' . escapeshellarg($name) . '</title></head><body><h1>' . escapeshellarg($name) . '</h1></body></html>" > ' . escapeshellarg($wwwPath . '/index.html');
                break;
                
            default:
                // Create basic PHP project
                $commands[] = 'mkdir ' . escapeshellarg($wwwPath);
                $commands[] = 'echo "<?php phpinfo();" > ' . escapeshellarg($wwwPath . '/index.php');
        }
        
        $output = [];
        foreach ($commands as $command) {
            exec($command . ' 2>&1', $output);
        }
        
        return [
            'success' => is_dir($wwwPath),
            'output' => implode("\n", $output),
        ];
    }
}

/**
 * Delete a project
 */
if (!function_exists('deleteProject')) {
    function deleteProject($name) {
        $laragonRoot = getLaragonRoot();
        $projectPath = $laragonRoot . '/www/' . $name;
        
        if (!is_dir($projectPath)) {
            return ['success' => false, 'error' => 'Project not found'];
        }
        
        // Use Windows rmdir to remove directory and contents
        $output = @shell_exec('rmdir /s /q "' . str_replace('/', '\\', $projectPath) . '" 2>&1');
        
        return [
            'success' => !is_dir($projectPath),
            'output' => $output,
        ];
    }
}

/**
 * Get dashboard preferences
 */
if (!function_exists('getDashboardPreferences')) {
    function getDashboardPreferences() {
        $prefsFile = dirname(__DIR__) . '/data/preferences.json';
        
        $defaults = [
            'theme' => 'light',
            'compact_sidebar' => false,
            'default_page' => 'dashboard',
            'refresh_interval' => 30,
            'show_system_info' => true,
            'language' => 'en',
            'time_format' => '24h',
            'date_format' => 'Y-m-d',
            'debug_mode' => false,
            'auto_refresh' => false,
            'animations' => true,
        ];
        
        if (file_exists($prefsFile)) {
            $content = @file_get_contents($prefsFile);
            if ($content) {
                $prefs = json_decode($content, true);
                if (is_array($prefs)) {
                    return array_merge($defaults, $prefs);
                }
            }
        }
        
        // Ensure data directory exists
        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0755, true);
        }
        
        // Save defaults
        @file_put_contents($prefsFile, json_encode($defaults, JSON_PRETTY_PRINT));
        
        return $defaults;
    }
}

/**
 * Save dashboard preferences
 */
if (!function_exists('saveDashboardPreferences')) {
    function saveDashboardPreferences($prefs) {
        $prefsFile = dirname(__DIR__) . '/data/preferences.json';
        
        // Ensure data directory exists
        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0755, true);
        }
        
        return @file_put_contents($prefsFile, json_encode($prefs, JSON_PRETTY_PRINT)) !== false;
    }
}

/**
 * Clear all caches
 */
if (!function_exists('clearAllCaches')) {
    function clearAllCaches() {
        $results = [];
        
        // Clear dashboard cache
        $cacheDir = dirname(__DIR__) . '/temp/cache';
        if (is_dir($cacheDir)) {
            $files = glob($cacheDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            $results['dashboard_cache'] = true;
        }
        
        // Clear session cache
        $sessionDir = dirname(__DIR__) . '/temp/sessions';
        if (is_dir($sessionDir)) {
            $files = glob($sessionDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            $results['session_cache'] = true;
        }
        
        // Clear Laragon cache
        $laragonRoot = getLaragonRoot();
        $laragonCache = $laragonRoot . '/data/cache';
        if (is_dir($laragonCache)) {
            $files = glob($laragonCache . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    @unlink($file);
                }
            }
            $results['laragon_cache'] = true;
        }
        
        return $results;
    }
}

/**
 * Optimize databases
 */
if (!function_exists('optimizeDatabases')) {
    function optimizeDatabases() {
        // This would require MySQL credentials
        // For now, return a placeholder
        return [
            'success' => false,
            'message' => 'Database optimization requires MySQL credentials. Please configure in config.php',
        ];
    }
}

/**
 * Run composer command
 */
if (!function_exists('runComposerCommand')) {
    function runComposerCommand($projectPath, $command = 'install') {
        $laragonRoot = getLaragonRoot();
        $composerPath = $laragonRoot . '/bin/composer/composer.phar';
        
        if (!file_exists($composerPath)) {
            return [
                'success' => false,
                'output' => 'Composer not found. Please install Composer in Laragon.',
            ];
        }
        
        $fullCommand = 'php ' . escapeshellarg($composerPath) . ' ' . $command;
        $output = @shell_exec('cd ' . escapeshellarg($projectPath) . ' && ' . $fullCommand . ' 2>&1');
        
        return [
            'success' => strpos($output, 'Generating autoload files') !== false || strpos($output, 'Package operations') !== false,
            'output' => $output,
        ];
    }
}

/**
 * Run npm command
 */
if (!function_exists('runNpmCommand')) {
    function runNpmCommand($projectPath, $command = 'install') {
        $laragonRoot = getLaragonRoot();
        $npmPath = $laragonRoot . '/bin/node/node.exe';
        
        if (!file_exists($npmPath)) {
            return [
                'success' => false,
                'output' => 'Node.js not found. Please install Node.js in Laragon.',
            ];
        }
        
        $fullCommand = $npmPath . ' ' . $command;
        $output = @shell_exec('cd ' . escapeshellarg($projectPath) . ' && ' . $fullCommand . ' 2>&1');
        
        return [
            'success' => strpos($output, 'added') !== false || strpos($output, 'up to date') !== false,
            'output' => $output,
        ];
    }
}

/**
 * Check Git status
 */
if (!function_exists('checkGitStatus')) {
    function checkGitStatus($projectPath) {
        $branch = @shell_exec('cd ' . escapeshellarg($projectPath) . ' && git rev-parse --abbrev-ref HEAD 2>&1');
        $status = @shell_exec('cd ' . escapeshellarg($projectPath) . ' && git status --porcelain 2>&1');
        $remote = @shell_exec('cd ' . escapeshellarg($projectPath) . ' && git remote get-url origin 2>&1');
        
        return [
            'branch' => trim($branch) ?: 'unknown',
            'status' => !empty(trim($status)) ? 'modified' : 'clean',
            'remote' => trim($remote) ?: null,
        ];
    }
}

/**
 * Get Laragon config
 */
if (!function_exists('getLaragonConfig')) {
    function getLaragonConfig() {
        $laragonRoot = getLaragonRoot();
        $configFile = $laragonRoot . '/laragon.ini';
        
        if (!file_exists($configFile)) {
            return [];
        }
        
        $content = @file_get_contents($configFile);
        $config = [];
        
        if (preg_match_all('/^(\w+)=(.*)$/m', $content, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $config[$match[1]] = $match[2];
            }
        }
        
        return $config;
    }
}

/**
 * Fix SMTP configuration
 */
if (!function_exists('fixSMTP')) {
    function fixSMTP() {
        $laragonRoot = getLaragonRoot();
        $phpIni = $laragonRoot . '/bin/php/php.ini';
        $sendmailIni = $laragonRoot . '/bin/sendmail/sendmail.ini';
        
        $results = [];
        
        // Fix php.ini
        if (file_exists($phpIni)) {
            $phpIniContent = @file_get_contents($phpIni);
            
            // Enable mailparse extension
            if (strpos($phpIniContent, 'extension=mailparse') !== false && strpos($phpIniContent, 'extension=mailparse') !== false) {
                // Extension might already be enabled
            } else {
                $phpIniContent .= "\n; Mailparse extension\n";
                $phpIniContent .= "extension=mailparse\n";
                $results['mailparse'] = @file_put_contents($phpIniContent, $phpIni) !== false;
            }
        }
        
        // Configure sendmail.ini
        if (file_exists($sendmailIni)) {
            $sendmailContent = @file_get_contents($sendmailIni);
            
            // Update SMTP settings
            $sendmailContent = str_replace('smtp_server=mail.mydomain.com', 'smtp_server=localhost', $sendmailContent);
            $sendmailContent = str_replace('smtp_port=25', 'smtp_port=1025', $sendmailContent);
            $sendmailContent = str_replace('auth_username=', 'auth_username=', $sendmailContent);
            $sendmailContent = str_replace('auth_password=', 'auth_password=', $sendmailContent);
            $sendmailContent = str_replace('force_sender=', 'force_sender=', $sendmailContent);
            
            $results['sendmail'] = @file_put_contents($sendmailContent, $sendmailIni) !== false;
        }
        
        return $results;
    }
}

/**
 * Translation helper function
 */
if (!function_exists('t')) {
    function t($key, $fallback = '') {
        // This is a placeholder - actual translation would be loaded from i18n files
        return $fallback ?: $key;
    }
}


/**
 * Get PHP ini path
 */
if (!function_exists('getPHPIniPath')) {
    function getPHPIniPath() {
        $laragonConfig = getLaragonConfig();
        $phpVersion = $laragonConfig['php'] ?? null;
        $laragonRoot = getLaragonRoot();
        
        if ($phpVersion) {
            $path = $laragonRoot . '/bin/php/' . $phpVersion . '/php.ini';
            if (file_exists($path)) return $path;
        }
        
        // Fallback: try to find any PHP ini
        $paths = glob($laragonRoot . '/bin/php/php-*/php.ini');
        return !empty($paths) ? $paths[0] : null;
    }
}

/**
 * Get MySQL ini path
 */
if (!function_exists('getMySQLIniPath')) {
    function getMySQLIniPath() {
        $laragonConfig = getLaragonConfig();
        $mysqlVersion = $laragonConfig['mysql'] ?? null;
        $laragonRoot = getLaragonRoot();
        
        if ($mysqlVersion) {
            $path = $laragonRoot . '/bin/mysql/' . $mysqlVersion . '/my.ini';
            if (file_exists($path)) return $path;
        }
        
        // Fallback: try to find any MySQL ini
        $paths = glob($laragonRoot . '/bin/mysql/mysql-*/my.ini');
        return !empty($paths) ? $paths[0] : null;
    }
}

// Clear any output that may have been generated
ob_end_clean();
