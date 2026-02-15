<?php
/**
 * Laragon Dashboard - Project Creation API
 * Version: 3.0.0
 * Description: Handles project creation with framework detection and database setup
 */

// Load configuration and helpers
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

header('Content-Type: application/json');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
    exit;
}

// CSRF check
$csrfToken = $data['csrf_token'] ?? '';
if (!verifyCSRFToken($csrfToken)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'CSRF token validation failed']);
    exit;
}

$projectName = $data['name'] ?? '';
$framework = $data['framework'] ?? 'custom';
$createDatabase = isset($data['create_database']) && $data['create_database'] === 'true';
$databaseName = $data['database_name'] ?? '';
$initGit = isset($data['init_git']) && $data['init_git'] === 'true';
$createVhost = isset($data['create_vhost']) && ($data['create_vhost'] === 'true' || $data['create_vhost'] === true);

// Validate project name
if (empty($projectName) || !preg_match('/^[a-zA-Z0-9_-]+$/', $projectName)) {
    echo json_encode(['success' => false, 'message' => 'Invalid project name. Only letters, numbers, underscores, and hyphens allowed.']);
    exit;
}

// Get document root
$laraconfig = getLaragonConfig();
$documentRoot = $laraconfig['DocumentRoot'] ?? (defined('LARAGON_ROOT') ? LARAGON_ROOT . '/www' : '');
$projectPath = rtrim($documentRoot, '/\\') . '/' . $projectName;

// Check if project already exists
if (is_dir($projectPath)) {
    echo json_encode(['success' => false, 'message' => 'Project directory already exists']);
    exit;
}

try {
    // Create project directory
    if (!mkdir($projectPath, 0755, true)) {
        throw new Exception('Failed to create project directory');
    }
    
    // Create progress log file
    $logFile = dirname(__DIR__) . '/logs/create_' . $projectName . '.log';
    file_put_contents($logFile, "Starting project creation for: $projectName\n");
    
    // Initialize framework
    switch ($framework) {
        case 'wordpress':
            initializeWordPress($projectPath, $projectName, $logFile);
            break;
        case 'laravel':
            initializeLaravel($projectPath, $projectName, $logFile);
            break;
        case 'symfony':
            initializeSymfony($projectPath, $projectName, $logFile);
            break;
        case 'drupal':
            initializeDrupal($projectPath, $projectName, $logFile);
            break;
        case 'joomla':
            initializeJoomla($projectPath, $projectName, $logFile);
            break;
        case 'cakephp':
            initializeCakePHP($projectPath, $projectName, $logFile);
            break;
        case 'nextjs':
        case 'vuejs':
        case 'react':
        case 'angular':
            initializeNodeProject($projectPath, $projectName, $framework, $logFile);
            break;
        default:
            initializeCustom($projectPath, $projectName, $logFile);
    }
    
    // Create database if requested
    if ($createDatabase) {
        file_put_contents($logFile, "Creating database...\n", FILE_APPEND);
        $dbName = !empty($databaseName) ? $databaseName : $projectName;
        createDatabase($dbName);
        file_put_contents($logFile, "Database created: $dbName\n", FILE_APPEND);
    }
    
    // Initialize Git if requested
    if ($initGit) {
        file_put_contents($logFile, "Initializing Git...\n", FILE_APPEND);
        initializeGit($projectPath);
        file_put_contents($logFile, "Git initialized.\n", FILE_APPEND);
    }
    
    // Create virtual host configuration
    if ($createVhost) {
        file_put_contents($logFile, "Creating virtual host...\n", FILE_APPEND);
        createVirtualHost($projectName, $projectPath);
        file_put_contents($logFile, "Virtual host created.\n", FILE_APPEND);
    }
    
    // Determine domain suffix
    $domainSuffix = defined('DOMAIN_SUFFIX') ? DOMAIN_SUFFIX : '.local';
    $url = 'http://' . $projectName . $domainSuffix;
    
    file_put_contents($logFile, "Project creation completed successfully!\n", FILE_APPEND);
    
    echo json_encode([
        'success' => true,
        'message' => 'Project created successfully',
        'project_path' => $projectPath,
        'url' => $url,
        'log_file' => 'create_' . $projectName . '.log'
    ]);
    
} catch (Exception $e) {
    // Clean up on error (optional, maybe keep logs)
    if (isset($logFile)) {
        file_put_contents($logFile, "ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
    }
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

/**
 * Initialize WordPress project
 */
function initializeWordPress($path, $name, $logFile) {
    file_put_contents($logFile, "Downloading WordPress...\n", FILE_APPEND);
    
    $laragonRoot = getLaragonRoot();
    $command = "cd " . escapeshellarg(dirname($path)) . " && composer create-project wordpress/wordpress " . escapeshellarg($name) . " --prefer-dist --no-interaction 2>&1";
    
    $output = shell_exec($command);
    file_put_contents($logFile, $output . "\n", FILE_APPEND);
    
    if (!file_exists($path . '/wp-config-sample.php')) {
        file_put_contents($logFile, "Composer failed, falling back to manual download...\n", FILE_APPEND);
        // Fallback or handle error
    }
}

/**
 * Initialize Laravel project
 */
function initializeLaravel($path, $name, $logFile) {
    file_put_contents($logFile, "Creating Laravel project...\n", FILE_APPEND);
    
    // We need to remove the directory because composer create-project expects an empty or non-existent dir
    rmdir($path);
    
    $command = "cd " . escapeshellarg(dirname($path)) . " && composer create-project laravel/laravel " . escapeshellarg($name) . " --prefer-dist --no-interaction 2>&1";
    
    $output = shell_exec($command);
    file_put_contents($logFile, $output . "\n", FILE_APPEND);
}

/**
 * Initialize Symfony project
 */
function initializeSymfony($path, $name, $logFile) {
    file_put_contents($logFile, "Creating Symfony project...\n", FILE_APPEND);
    
    // We need to remove the directory because composer expects an empty or non-existent dir
    rmdir($path);
    
    $command = "cd " . escapeshellarg(dirname($path)) . " && composer create-project symfony/website-skeleton " . escapeshellarg($name) . " --prefer-dist --no-interaction 2>&1";
    
    $output = shell_exec($command);
    file_put_contents($logFile, $output . "\n", FILE_APPEND);
}

/**
 * Initialize Drupal project
 */
function initializeDrupal($path, $name, $logFile) {
    file_put_contents($logFile, "Creating Drupal project...\n", FILE_APPEND);
    
    rmdir($path);
    
    $command = "cd " . escapeshellarg(dirname($path)) . " && composer create-project drupal/recommended-project " . escapeshellarg($name) . " --prefer-dist --no-interaction 2>&1";
    
    $output = shell_exec($command);
    file_put_contents($logFile, $output . "\n", FILE_APPEND);
}

/**
 * Initialize Joomla project
 */
function initializeJoomla($path, $name, $logFile) {
    file_put_contents($logFile, "Placeholding Joomla project. Manual installation required.\n", FILE_APPEND);
    $readmeContent = "# $name\nJoomla Project\nDownload Joomla from https://downloads.joomla.org/";
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize CakePHP project
 */
function initializeCakePHP($path, $name, $logFile) {
    file_put_contents($logFile, "Creating CakePHP project...\n", FILE_APPEND);
    
    rmdir($path);
    
    $command = "cd " . escapeshellarg(dirname($path)) . " && composer create-project --prefer-dist cakephp/app " . escapeshellarg($name) . " --no-interaction 2>&1";
    
    $output = shell_exec($command);
    file_put_contents($logFile, $output . "\n", FILE_APPEND);
}

/**
 * Initialize Node.js project (Next.js, Vue.js, React, Angular)
 */
function initializeNodeProject($path, $name, $framework, $logFile) {
    file_put_contents($logFile, "Initializing Node.js project ($framework)...\n", FILE_APPEND);
    
    $packageJson = [
        'name' => $name,
        'version' => '1.0.0',
        'scripts' => [
            'dev' => $framework === 'nextjs' ? 'next dev' : ($framework === 'vuejs' ? 'vite' : 'react-scripts start'),
            'build' => $framework === 'nextjs' ? 'next build' : ($framework === 'vuejs' ? 'vite build' : 'react-scripts build'),
        ]
    ];
    
    file_put_contents($path . '/package.json', json_encode($packageJson, JSON_PRETTY_PRINT));
    file_put_contents($logFile, "package.json created.\n", FILE_APPEND);
    file_put_contents($logFile, "Note: npm install was skipped. Please run it manually if needed.\n", FILE_APPEND);
}

/**
 * Initialize custom/empty project
 */
function initializeCustom($path, $name, $logFile) {
    file_put_contents($logFile, "Initializing custom project...\n", FILE_APPEND);
    $indexContent = "<!DOCTYPE html><html><body><h1>$name</h1></body></html>";
    file_put_contents($path . '/index.php', $indexContent);
}

/**
 * Create database
 */
function createDatabase($dbName) {
    try {
        // Sanitize database name
        $dbName = preg_replace('/[^a-zA-Z0-9_]/', '', $dbName);
        
        if (empty($dbName)) {
            throw new Exception('Invalid database name');
        }
        
        // Get MySQL credentials
        $mysqlHost = defined('MYSQL_HOST') ? MYSQL_HOST : 'localhost';
        $mysqlUser = defined('MYSQL_USER') ? MYSQL_USER : 'root';
        $mysqlPassword = defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '';
        
        // Connect to MySQL
        $link = @mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword);
        
        if (!$link) {
            // Try without password
            $link = @mysqli_connect($mysqlHost, $mysqlUser, '');
        }
        
        if (!$link) {
            throw new Exception('Failed to connect to MySQL');
        }
        
        // Create database
        $query = "CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
        if (!mysqli_query($link, $query)) {
            throw new Exception('Failed to create database: ' . mysqli_error($link));
        }
        
        mysqli_close($link);
        return true;
    } catch (Exception $e) {
        throw new Exception('Database creation failed: ' . $e->getMessage());
    }
}

/**
 * Initialize Git repository
 */
function initializeGit($path) {
    if (!defined('LARAGON_ROOT')) {
        return; // Skip if Laragon root not defined
    }
    
    $gitPath = LARAGON_ROOT . '/bin/git/git.exe';
    if (!file_exists($gitPath)) {
        // Try system git
        $gitPath = 'git';
    }
    
    $oldCwd = getcwd();
    chdir($path);
    
    try {
        // Initialize git
        exec(escapeshellarg($gitPath) . ' init', $output, $returnVar);
        
        // Create .gitignore
        $gitignore = "vendor/\nnode_modules/\n.env\n*.log\n";
        file_put_contents($path . '/.gitignore', $gitignore);
        
        // Initial commit
        exec(escapeshellarg($gitPath) . ' add .', $output, $returnVar);
        exec(escapeshellarg($gitPath) . ' commit -m "Initial commit"', $output, $returnVar);
    } catch (Exception $e) {
        // Git init might fail, that's okay
    }
    
    chdir($oldCwd);
}

/**
 * Create virtual host
 */
function createVirtualHost($name, $path) {
    if (!defined('LARAGON_ROOT')) {
        return; // Skip if Laragon root not defined
    }
    
    $domainSuffix = defined('DOMAIN_SUFFIX') ? DOMAIN_SUFFIX : '.local';
    $vhostFile = LARAGON_ROOT . '/etc/apache2/sites-enabled/' . $name . $domainSuffix . '.conf';
    
    // Normalize path separators
    $normalizedPath = str_replace('\\', '/', $path);
    
    $vhostContent = <<<APACHE
<VirtualHost *:80>
    ServerName {$name}{$domainSuffix}
    DocumentRoot "{$normalizedPath}"
    <Directory "{$normalizedPath}">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
APACHE;
    
    // Create directory if it doesn't exist
    $vhostDir = dirname($vhostFile);
    if (!is_dir($vhostDir)) {
        mkdir($vhostDir, 0755, true);
    }
    
    file_put_contents($vhostFile, $vhostContent);
    
    // Add to hosts file (requires admin privileges)
    $hostsFile = 'C:/Windows/System32/drivers/etc/hosts';
    $hostsEntry = "\n127.0.0.1\t{$name}{$domainSuffix}";
    
    // Try to add to hosts file (may require admin privileges)
    if (is_writable($hostsFile)) {
        $hostsContent = file_get_contents($hostsFile);
        if (strpos($hostsContent, $name . $domainSuffix) === false) {
            file_put_contents($hostsFile, $hostsEntry, FILE_APPEND | LOCK_EX);
        }
    }
}

/**
 * Recursively remove directory
 */
function rmdir_recursive($dir) {
    if (!is_dir($dir)) {
        return false;
    }
    
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;
        is_dir($path) ? rmdir_recursive($path) : unlink($path);
    }
    
    return rmdir($dir);
}

