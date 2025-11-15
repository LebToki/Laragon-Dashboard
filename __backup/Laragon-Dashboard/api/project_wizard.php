<?php
/**
 * Application: Laragon | Project Creation Wizard API
 * Description: Handles project creation with framework detection and database setup
 * Version: 2.6.0
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/database.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$projectName = $_POST['name'] ?? '';
$framework = $_POST['framework'] ?? 'custom';
$createDatabase = isset($_POST['create_database']) && $_POST['create_database'] === 'true';
$databaseName = $_POST['database_name'] ?? '';
$databaseUser = $_POST['database_user'] ?? 'root';
$databasePassword = $_POST['database_password'] ?? '';
$initGit = isset($_POST['init_git']) && $_POST['init_git'] === 'true';

// Validate project name
if (empty($projectName) || !preg_match('/^[a-zA-Z0-9_-]+$/', $projectName)) {
    echo json_encode(['success' => false, 'message' => 'Invalid project name']);
    exit;
}

// Get document root
$docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
$projectPath = rtrim($docRoot, '/\\') . '/' . $projectName;

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
        default:
            initializeCustom($projectPath, $projectName);
    }
    
    // Create database if requested
    if ($createDatabase) {
        $dbName = !empty($databaseName) ? $databaseName : $projectName;
        createDatabase($dbName, $databaseUser, $databasePassword);
    }
    
    // Initialize Git if requested
    if ($initGit) {
        initializeGit($projectPath);
    }
    
    // Create virtual host configuration
    createVirtualHost($projectName, $projectPath);
    
    echo json_encode([
        'success' => true,
        'message' => 'Project created successfully',
        'project_path' => $projectPath,
        'url' => 'http://' . $projectName . '.test'
    ]);
    
} catch (Exception $e) {
    // Clean up on error
    if (is_dir($projectPath)) {
        rmdir_recursive($projectPath);
    }
    
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function initializeWordPress($path, $name) {
    // Create basic WordPress structure
    $indexContent = <<<'PHP'
<?php
/**
 * WordPress Installation
 * Run: wp core download
 */
echo "WordPress project: <?php echo htmlspecialchars($name); ?>";
PHP;
    file_put_contents($path . '/index.php', $indexContent);
    file_put_contents($path . '/README.md', "# WordPress Project: {$name}\n\nRun `wp core download` to install WordPress.");
}

function initializeLaravel($path, $name) {
    // Check if Composer is available
    $composerPath = getLaragonRoot() . '/bin/composer/composer.bat';
    if (file_exists($composerPath)) {
        $command = "cd " . escapeshellarg($path) . " && " . escapeshellarg($composerPath) . " create-project laravel/laravel . 2>&1";
        exec($command, $output, $returnVar);
        if ($returnVar !== 0) {
            throw new Exception('Failed to create Laravel project: ' . implode("\n", $output));
        }
    } else {
        file_put_contents($path . '/README.md', "# Laravel Project: {$name}\n\nRun `composer create-project laravel/laravel .` to install Laravel.");
    }
}

function initializeSymfony($path, $name) {
    $composerPath = getLaragonRoot() . '/bin/composer/composer.bat';
    if (file_exists($composerPath)) {
        $command = "cd " . escapeshellarg($path) . " && " . escapeshellarg($composerPath) . " create-project symfony/skeleton . 2>&1";
        exec($command, $output, $returnVar);
        if ($returnVar !== 0) {
            throw new Exception('Failed to create Symfony project: ' . implode("\n", $output));
        }
    } else {
        file_put_contents($path . '/README.md', "# Symfony Project: {$name}\n\nRun `composer create-project symfony/skeleton .` to install Symfony.");
    }
}

function initializeDrupal($path, $name) {
    file_put_contents($path . '/README.md', "# Drupal Project: {$name}\n\nDownload Drupal from https://www.drupal.org/download");
}

function initializeJoomla($path, $name) {
    file_put_contents($path . '/README.md', "# Joomla Project: {$name}\n\nDownload Joomla from https://downloads.joomla.org");
}

function initializeCustom($path, $name) {
    $indexContent = <<<'HTML'
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($name); ?></title>
</head>
<body>
    <h1>Welcome to <?php echo htmlspecialchars($name); ?></h1>
    <p>Your project is ready!</p>
</body>
</html>
HTML;
    file_put_contents($path . '/index.php', $indexContent);
}

function createDatabase($dbName, $user, $password) {
    try {
        $db = DatabaseHelper::getConnection();
        
        // Sanitize database name
        $dbName = preg_replace('/[^a-zA-Z0-9_]/', '', $dbName);
        
        $stmt = $db->prepare("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $stmt->execute();
        
        return true;
    } catch (Exception $e) {
        throw new Exception('Failed to create database: ' . $e->getMessage());
    }
}

function initializeGit($path) {
    $gitPath = getLaragonRoot() . '/bin/git/git.exe';
    if (file_exists($gitPath)) {
        $commands = [
            "cd " . escapeshellarg($path) . " && " . escapeshellarg($gitPath) . " init",
            "cd " . escapeshellarg($path) . " && " . escapeshellarg($gitPath) . " add .",
            "cd " . escapeshellarg($path) . " && " . escapeshellarg($gitPath) . " commit -m \"Initial commit\""
        ];
        
        foreach ($commands as $command) {
            exec($command, $output, $returnVar);
            if ($returnVar !== 0) {
                // Git init might fail if already initialized, that's okay
            }
        }
    }
}

function createVirtualHost($name, $path) {
    $laragonRoot = getLaragonRoot();
    $vhostFile = $laragonRoot . '/etc/apache2/sites-enabled/' . $name . '.test.conf';
    
    $vhostContent = <<<APACHE
<VirtualHost *:80>
    ServerName {$name}.test
    DocumentRoot "{$path}"
    <Directory "{$path}">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
APACHE;
    
    file_put_contents($vhostFile, $vhostContent);
    
    // Add to hosts file
    $hostsFile = 'C:/Windows/System32/drivers/etc/hosts';
    $hostsEntry = "127.0.0.1\t{$name}.test\n";
    
    if (is_writable($hostsFile) || is_writable(dirname($hostsFile))) {
        file_put_contents($hostsFile, $hostsEntry, FILE_APPEND | LOCK_EX);
    }
}

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

