<?php
/**
 * Laragon Dashboard - Helper Functions
 * Version: 4.0.0
 * Provides utility functions for the dashboard
 */

// Load core autoloader to ensure dependent classes are available
if (file_exists(__DIR__ . '/autoload.php')) {
    require_once __DIR__ . '/autoload.php';
}

// Start output buffering to prevent stray output
ob_start();

/**
 * Get Laragon root directory
 */
if (!function_exists('getLaragonRoot')) {
    function getLaragonRoot() {
        return \LaragonDashboard\Core\System::getLaragonRoot();
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
        
        return '4.0.0';
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
 * Check if phpMyAdmin is installed
 */
if (!function_exists('isPhpMyAdminInstalled')) {
    function isPhpMyAdminInstalled() {
        $laragonRoot = getLaragonRoot();
        $pmaPath = $laragonRoot . '/etc/apps/phpMyAdmin';
        if (!is_dir($pmaPath)) {
            $pmaPath = $laragonRoot . '/www/phpmyadmin';
        }
        return is_dir($pmaPath);
    }
}

/**
 * Get phpMyAdmin version
 */
if (!function_exists('getPhpMyAdminVersion')) {
    function getPhpMyAdminVersion() {
        $laragonRoot = getLaragonRoot();
        $pmaPath = $laragonRoot . '/etc/apps/phpMyAdmin';
        if (!is_dir($pmaPath)) {
            $pmaPath = $laragonRoot . '/www/phpmyadmin';
        }
        
        if (is_dir($pmaPath)) {
            $versionFile = $pmaPath . '/README';
            if (file_exists($versionFile)) {
                $content = @file_get_contents($versionFile);
                if (preg_match('/Version\s+(\d+\.\d+\.\d+)/', $content, $matches)) {
                    return $matches[1];
                }
            }
        }
        return null;
    }
}

/**
 * Check if Adminer is installed
 */
if (!function_exists('isAdminerInstalled')) {
    function isAdminerInstalled() {
        if (!class_exists('AdminerModule')) {
            require_once __DIR__ . '/AdminerModule.php';
        }
        $adminer = new AdminerModule();
        return $adminer->isInstalled();
    }
}

/**
 * Get Adminer URL
 */
if (!function_exists('getAdminerUrl')) {
    function getAdminerUrl($database = null) {
        if (!class_exists('AdminerModule')) {
            require_once __DIR__ . '/AdminerModule.php';
        }
        $adminer = new AdminerModule();
        return $adminer->getUrl($database);
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
 * Format raw log text to structured HTML
 */
if (!function_exists('formatLogToHtml')) {
    function formatLogToHtml($text) {
        if (empty($text)) return '';
        
        $lines = explode("\n", $text);
        $html = '<div class="table-responsive"><table class="table table-sm table-hover text-xs mb-0"><tbody>';
        
        foreach ($lines as $line) {
            $rowLine = trim($line);
            if (empty($rowLine)) continue;
            
            $bgClass = '';
            $textClass = '';
            
            if (stripos($rowLine, 'error') !== false || stripos($rowLine, 'fatal') !== false || stripos($rowLine, 'critical') !== false) {
                $bgClass = 'bg-danger-50';
                $textClass = 'text-danger-main';
            } elseif (stripos($rowLine, 'warn') !== false) {
                $bgClass = 'bg-warning-50';
                $textClass = 'text-warning-main';
            } elseif (stripos($rowLine, 'info') !== false) {
                $bgClass = 'bg-info-50';
                $textClass = 'text-info-main';
            }
            
            $html .= '<tr class="' . $bgClass . '">';
            $html .= '<td class="font-monospace ' . $textClass . '">' . htmlspecialchars($line) . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</tbody></table></div>';
        return $html;
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
    
    // Create cache directory if it doesn't exist
    $cacheDir = dirname(__DIR__) . '/cache';
    if (!is_dir($cacheDir)) {
        @mkdir($cacheDir, 0755, true);
    }
    $cacheFile = $cacheDir . '/projects_cache.json';
    
    $cache = [];
    if (file_exists($cacheFile)) {
        $cache = json_decode(file_get_contents($cacheFile), true) ?: [];
    }
    
    $dirs = glob($wwwPath . '/*', GLOB_ONLYDIR);
    $cacheUpdated = false;
    
    foreach ($dirs as $dir) {
        $name = basename($dir);
        
        if ($name[0] === '.' || in_array($name, ['laragon', 'dashboard', 'phpmyadmin', 'adminer', 'phppgadmin'])) {
            continue;
        }
        
        if (in_array($name, $ignoredProjects)) {
            continue;
        }
        
        $mtime = filemtime($dir);
        if (isset($cache[$name]) && $cache[$name]['mtime'] === $mtime) {
            $projects[] = $cache[$name]['data'];
        } else {
            $projectData = analyzeProject($dir, $name);
            if ($projectData) {
                $projects[] = $projectData;
                $cache[$name] = [
                    'mtime' => $mtime,
                    'data' => $projectData
                ];
                $cacheUpdated = true;
            }
        }
    }
    
    if ($cacheUpdated) {
        @file_put_contents($cacheFile, json_encode($cache));
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
        
        // Quick look for WordPress favicon
        $commonPaths = ['/wp-content/uploads/favicon.ico', '/favicon.ico', '/favicon.png'];
        foreach ($commonPaths as $relPath) {
            if (file_exists($path . $relPath)) {
                $project['favicon'] = $name . $relPath;
                break;
            }
        }
    }
    // Check for Laravel
    elseif (file_exists($path . '/artisan')) {
        $project['platform'] = 'Laravel';
        $project['icon'] = 'devicon-plain:laravel';
        $project['color'] = 'danger';
        if (file_exists($path . '/public/favicon.ico')) $project['favicon'] = $name . '/public/favicon.ico';
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
        if (file_exists($path . '/favicon.ico')) $project['favicon'] = $name . '/favicon.ico';
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
        if (file_exists($path . '/favicon.ico')) $project['favicon'] = $name . '/favicon.ico';
    }
    
    // Check for Git branch and status (optimized: only branch for now if it's slow)
    if ($project['has_git']) {
        $branch = @shell_exec('cd ' . escapeshellarg($path) . ' && git rev-parse --abbrev-ref HEAD 2>&1');
        $project['git_branch'] = trim((string)$branch) ?: 'unknown';
        
        // Skip detailed status check for large projects or make it optional?
        // For now, keep it but ensure it's not recursive
        $status = @shell_exec('cd ' . escapeshellarg($path) . ' && git status --porcelain 2>&1');
        $project['git_status'] = !empty(trim((string)$status)) ? 'modified' : 'clean';
    }
    
    return $project;
}
}

/**
 * Find a file in a directory recursively
 */
if (!function_exists('findFile')) {
    function findFile($dir, $filenames, $maxDepth = 2, $currentDepth = 0) {
    if ($currentDepth > $maxDepth) {
        return null;
    }

    foreach ($filenames as $filename) {
        $path = $dir . '/' . $filename;
        if (file_exists($path)) {
            return $path;
        }
    }
    
    // Search in subdirectories (limit depth and skip common large folders)
    $subdirs = glob($dir . '/*', GLOB_ONLYDIR);
    if (!$subdirs) return null;

    foreach ($subdirs as $subdir) {
        $name = basename($subdir);
        if (in_array($name, ['node_modules', 'vendor', '.git', 'bower_components', 'cache', 'storage'])) {
            continue;
        }
        $result = findFile($subdir, $filenames, $maxDepth, $currentDepth + 1);
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
        return !empty(trim((string)$output));
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
/**
 * Get Dashboard preferences (stored in JSON file)
 */
if (!function_exists('getDashboardPreferences')) {
    function getDashboardPreferences() {
        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0755, true);
        }
        
        $prefsFile = $dataDir . '/preferences.json';
        $defaults = [
            'laragon_root' => null,
            'mysql_host' => null,
            'mysql_user' => null,
            'mysql_password' => null,
            'document_root' => null,
            'domain_suffix' => null,
            'auto_update_check' => true,
            'auto_update_install' => false,
            'last_update_check' => null,
            'debug_banner' => false,
            'time_format' => null,
            'date_format' => null,
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
}

/**
 * Save Dashboard preferences
 */
if (!function_exists('saveDashboardPreferences')) {
    function saveDashboardPreferences(array $preferences) {
        $dataDir = dirname(__DIR__) . '/data';
        if (!is_dir($dataDir)) {
            @mkdir($dataDir, 0755, true);
        }
        
        $prefsFile = $dataDir . '/preferences.json';
        $existing = getDashboardPreferences();
        
        // Normalize paths before saving
        if (isset($preferences['laragon_root'])) {
            $preferences['laragon_root'] = rtrim(str_replace('\\', '/', $preferences['laragon_root']), '/');
        }
        if (isset($preferences['document_root'])) {
            $preferences['document_root'] = rtrim(str_replace('\\', '/', $preferences['document_root']), '/');
        }
        
        $merged = array_merge($existing, $preferences);
        
        // Remove null and empty string values
        $merged = array_filter($merged, function($value) {
            return $value !== null && $value !== '';
        });
        
        return @file_put_contents($prefsFile, json_encode($merged, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)) !== false;
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
            'branch' => trim((string)$branch) ?: 'unknown',
            'status' => !empty(trim((string)$status)) ? 'modified' : 'clean',
            'remote' => trim((string)$remote) ?: null,
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

/**
 * Generate a CSRF token and store it in the session
 */
if (!function_exists('generateCSRFToken')) {
    function generateCSRFToken() {
        return \LaragonDashboard\Core\Security::generateCSRFToken();
    }
}

/**
 * Get the current CSRF token
 */
if (!function_exists('getCSRFToken')) {
    function getCSRFToken() {
        return \LaragonDashboard\Core\Security::getCSRFToken();
    }
}

/**
 * Verify a CSRF token
 */
if (!function_exists('verifyCSRFToken')) {
    function verifyCSRFToken($token) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
}

/**
 * Check if the user is authenticated
 */
if (!function_exists('is_authenticated')) {
    function is_authenticated() {
        return \LaragonDashboard\Core\Security::isAuthenticated();
    }
}

/**
 * Enforce authentication
 */
if (!function_exists('check_auth')) {
    function check_auth() {
        if (!is_authenticated()) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Authentication required']);
                exit;
            } else {
                header('Location: login.php');
                exit;
            }
        }
    }
}

/**
 * Get structured changelog from CHANGELOG.md
 */
if (!function_exists('getChangelog')) {
    function getChangelog() {
        $changelogFile = dirname(__DIR__) . '/CHANGELOG.md';
        if (!file_exists($changelogFile)) return [];
        
        $content = file_get_contents($changelogFile);
        $lines = explode("\n", $content);
        
        $changelog = [];
        $currentVersion = null;
        
        foreach ($lines as $line) {
            if (preg_match('/^## \[(.*?)\]/', $line, $matches)) {
                $version = $matches[1];
                $currentVersion = $version;
                $changelog[$version] = [
                    'version' => $version,
                    'date' => '',
                    'changes' => []
                ];
                
                if (preg_match('/ - (.*)$/', $line, $dateMatches)) {
                    $changelog[$version]['date'] = $dateMatches[1];
                }
            } elseif ($currentVersion && preg_match('/^- (.*)$/', trim($line), $matches)) {
                $changelog[$currentVersion]['changes'][] = $matches[1];
            }
        }
        
        return $changelog;
    }
}
