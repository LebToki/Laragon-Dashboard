<?php
/**
 * Laragon Dashboard - Project Creation API
 * Version: 3.0.0
 * Description: Handles project creation with framework detection and database setup
 */

// Load configuration and helpers
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

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
    
    // Initialize framework
    switch ($framework) {
        case 'wordpress':
            initializeWordPress($projectPath, $projectName);
            break;
        case 'laravel':
            initializeLaravel($projectPath, $projectName);
            break;
        case 'symfony':
            initializeSymfony($projectPath, $projectName);
            break;
        case 'drupal':
            initializeDrupal($projectPath, $projectName);
            break;
        case 'joomla':
            initializeJoomla($projectPath, $projectName);
            break;
        case 'cakephp':
            initializeCakePHP($projectPath, $projectName);
            break;
        case 'nextjs':
        case 'vuejs':
        case 'react':
        case 'angular':
            initializeNodeProject($projectPath, $projectName, $framework);
            break;
        default:
            initializeCustom($projectPath, $projectName);
    }
    
    // Create database if requested
    if ($createDatabase) {
        $dbName = !empty($databaseName) ? $databaseName : $projectName;
        createDatabase($dbName);
    }
    
    // Initialize Git if requested
    if ($initGit) {
        initializeGit($projectPath);
    }
    
    // Create virtual host configuration
    if ($createVhost) {
        createVirtualHost($projectName, $projectPath);
    }
    
    // Determine domain suffix
    $domainSuffix = defined('DOMAIN_SUFFIX') ? DOMAIN_SUFFIX : '.local';
    $url = 'http://' . $projectName . $domainSuffix;
    
    echo json_encode([
        'success' => true,
        'message' => 'Project created successfully',
        'project_path' => $projectPath,
        'url' => $url
    ]);
    
} catch (Exception $e) {
    // Clean up on error
    if (is_dir($projectPath)) {
        rmdir_recursive($projectPath);
    }
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

/**
 * Initialize WordPress project
 */
function initializeWordPress($path, $name) {
    $readmeContent = <<<MD
# {$name}

WordPress Project

## Installation

To install WordPress, run:

\`\`\`bash
cd {$path}
composer create-project wordpress/wordpress .
\`\`\`

Or download WordPress manually from https://wordpress.org/download/
MD;
    file_put_contents($path . '/README.md', $readmeContent);
    
    $indexContent = <<<PHP
<?php
/**
 * WordPress Installation
 * Run: composer create-project wordpress/wordpress .
 * Or download WordPress from https://wordpress.org/download/
 */
echo "<!DOCTYPE html><html><head><title>{$name}</title></head><body><h1>WordPress Project: {$name}</h1><p>Please install WordPress to continue.</p></body></html>";
PHP;
    file_put_contents($path . '/index.php', $indexContent);
}

/**
 * Initialize Laravel project
 */
function initializeLaravel($path, $name) {
    $readmeContent = <<<MD
# {$name}

Laravel Project

## Installation

To create a new Laravel project, run:

\`\`\`bash
composer create-project laravel/laravel {$name}
\`\`\`

Or use Laravel installer:

\`\`\`bash
laravel new {$name}
\`\`\`
MD;
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize Symfony project
 */
function initializeSymfony($path, $name) {
    $readmeContent = <<<MD
# {$name}

Symfony Project

## Installation

To create a new Symfony project, run:

\`\`\`bash
composer create-project symfony/website-skeleton {$name}
\`\`\`

Or use Symfony CLI:

\`\`\`bash
symfony new {$name}
\`\`\`
MD;
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize Drupal project
 */
function initializeDrupal($path, $name) {
    $readmeContent = <<<MD
# {$name}

Drupal Project

## Installation

To create a new Drupal project, run:

\`\`\`bash
composer create-project drupal/recommended-project {$name}
\`\`\`
MD;
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize Joomla project
 */
function initializeJoomla($path, $name) {
    $readmeContent = <<<MD
# {$name}

Joomla Project

## Installation

Download Joomla from https://downloads.joomla.org/ and extract to this directory.
MD;
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize CakePHP project
 */
function initializeCakePHP($path, $name) {
    $readmeContent = <<<MD
# {$name}

CakePHP Project

## Installation

To create a new CakePHP project, run:

\`\`\`bash
composer create-project --prefer-dist cakephp/app {$name}
\`\`\`
MD;
    file_put_contents($path . '/README.md', $readmeContent);
}

/**
 * Initialize Node.js project (Next.js, Vue.js, React, Angular)
 */
function initializeNodeProject($path, $name, $framework) {
    $readmeContent = <<<MD
# {$name}

{$framework} Project

## Installation

\`\`\`bash
npm install
\`\`\`

## Development

\`\`\`bash
npm run dev
\`\`\`
MD;
    file_put_contents($path . '/README.md', $readmeContent);
    
    // Create package.json based on framework
    $packageJson = [
        'name' => $name,
        'version' => '1.0.0',
        'description' => '',
        'scripts' => []
    ];
    
    switch ($framework) {
        case 'nextjs':
            $packageJson['scripts'] = ['dev' => 'next dev', 'build' => 'next build', 'start' => 'next start'];
            break;
        case 'vuejs':
            $packageJson['scripts'] = ['dev' => 'vite', 'build' => 'vite build'];
            break;
        case 'react':
            $packageJson['scripts'] = ['dev' => 'react-scripts start', 'build' => 'react-scripts build'];
            break;
        case 'angular':
            $packageJson['scripts'] = ['start' => 'ng serve', 'build' => 'ng build'];
            break;
    }
    
    file_put_contents($path . '/package.json', json_encode($packageJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
}

/**
 * Initialize custom/empty project
 */
function initializeCustom($path, $name) {
    $indexContent = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$name}</title>
</head>
<body>
    <h1>Welcome to {$name}</h1>
    <p>Your project is ready!</p>
</body>
</html>
HTML;
    file_put_contents($path . '/index.php', $indexContent);
    
    $readmeContent = <<<MD
# {$name}

Custom Project

## Getting Started

This is a custom project. Start building your application here.
MD;
    file_put_contents($path . '/README.md', $readmeContent);
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

