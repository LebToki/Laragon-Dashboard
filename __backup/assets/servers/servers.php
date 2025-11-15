<?php
/**
 * Application: Laragon | Servers Tab Partial
 * Description: Servers & Applications tab content
 * Version: 2.6.0
 */

// Get Laragon config path (relative to this file location)
$laragonIniPath = __DIR__ . '/../../../usr/laragon.ini';
if (!file_exists($laragonIniPath)) {
    // Fallback: try relative to document root
    $laragonIniPath = '../../usr/laragon.ini';
}
$laraconfig = file_exists($laragonIniPath) ? parse_ini_file($laragonIniPath) : [];
?>
<div class="tab-content <?php echo $activeTab === 'servers' ? 'active' : ''; ?>" id="servers" style="flex: 1; display: flex; flex-direction: column; overflow-y: auto;">
    <header class="header">
        <div class="header__search"><?php echo $translations['breadcrumb_server_servers'] ?? 'My Development Server Servers & Applications'; ?></div>
        <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
    </header>
    <div class="container-fluid px-3">
        <?php 
        $serverInfo = serverInfo();
        // Strip PHP version from SERVER_SOFTWARE
        $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
        $serverSoftware = preg_replace('/\s+PHP\/[0-9.]+/', '', $serverSoftware);
        
        // Get MySQL version
        error_reporting(0);
        $mysqlPassword = getenv('MYSQL_PASSWORD') ?: ($laraconfig['MySQLRootPassword'] ?? '');
        $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, $mysqlPassword);
        if (!$link) {
            $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, '');
        }
        $mysqlVersion = 'MySQL not running!';
        if ($link) {
            $mysqlVersion = htmlspecialchars(mysqli_get_server_info($link));
        }
        ?>
        <!-- Row 1: Core Server Info -->
        <div class="row g-2 mb-2">
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon"><?php echo $translations['web_server'] ?? 'Web Server'; ?></div>
                    <div class="overviewcard_info"><?php echo $serverInfo['webServer']; ?></div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">PHP</div>
                    <div class="overviewcard_info">
                        <?php echo htmlspecialchars(phpversion()); ?>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">MySQL</div>
                    <div class="overviewcard_info">
                        <?php echo $mysqlVersion; ?>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">OpenSSL</div>
                    <div class="overviewcard_info">
                        <?=$serverInfo['openSsl'];?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row 2: Server Details -->
        <div class="row g-2 mb-2">
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">PHP <?php echo ($serverInfo['isFpm']) ? 'FPM' : 'SAPI'; ?></div>
                    <div class="overviewcard_info"><?php echo $serverInfo['phpSapi']; ?></div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon"><?php echo $translations['document_root'] ?? 'Document Root'; ?></div>
                    <div class="overviewcard_info">
                        <?php 
                        // SECURITY: Only show full path in debug mode, otherwise show relative path
                        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
                        if (defined('APP_DEBUG') && APP_DEBUG) {
                            echo htmlspecialchars($docRoot);
                        } else {
                            // Show only the last directory name for security
                            echo htmlspecialchars(basename($docRoot));
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">Host</div>
                    <div class="overviewcard_info">
                        <?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="overviewcard">
                    <div class="overviewcard_icon">PhpMyAdmin</div>
                    <div class="overviewcard_info">
                        <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank">
                            <?php echo $translations['manage_mysql'] ?? 'Manage MySQL'; ?>
                        </a>
                    </div>
                </div>
                <div class="overviewcard mt-2">
                    <div class="overviewcard_icon">Laragon</div>
                    <div class="overviewcard_info">
                        <?php
$laragonVersion = 'Unknown';
// Try to get version from laragon.exe file properties
// Detect Laragon root directory from document root
$docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
$laragonRoot = 'C:/laragon'; // Default fallback

// Try to extract Laragon root from document root (e.g., C:/laragon/www -> C:/laragon)
if (strpos($docRoot, 'laragon') !== false) {
    $parts = explode('laragon', $docRoot);
    if (!empty($parts[0])) {
        $laragonRoot = $parts[0] . 'laragon';
    }
}

$laragonExePath = str_replace('/', DIRECTORY_SEPARATOR, $laragonRoot . '/laragon.exe');

if (file_exists($laragonExePath)) {
    // Use PowerShell to get file version
    $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $laragonExePath) . '\').VersionInfo.FileVersion"';
    $version = shell_exec($command);
    if ($version && trim($version) !== '') {
        // Extract version number (e.g., "8.3.0.1009" -> "8.3.0")
        $versionParts = explode('.', trim($version));
        if (count($versionParts) >= 3) {
            $laragonVersion = $versionParts[0] . '.' . $versionParts[1] . '.' . $versionParts[2];
        } else {
            $laragonVersion = trim($version);
        }
    }
}
// Fallback to ini file if exe method fails
if ($laragonVersion === 'Unknown' && file_exists($laragonIniPath)) {
    $laraconfig = parse_ini_file($laragonIniPath);
    $laragonVersion = $laraconfig['Version'] ?? 'Unknown';
}
echo htmlspecialchars($laragonVersion);
?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row 3: Search -->
        <div class="row g-2 mb-2">
            <div class="col-3">
                <div class="project-search-card">
                    <i class="fas fa-search" style="color: #666; margin-right: 10px;"></i>
                    <input type="text" id="project-search" placeholder="Search projects...">
                </div>
            </div>
            <div class="col-9">
                <!-- Empty space -->
            </div>
        </div>
    </div>

    <div class="container-fluid px-3">
        <div id="project-list" class="row g-2">
        <?php
$ignored = ['favicon_io'];
$folders = array_filter(glob('*'), 'is_dir');
sort($folders, SORT_NATURAL | SORT_FLAG_CASE);

if (isset($laraconfig['SSLEnabled']) && $laraconfig['SSLEnabled'] == 0 || (isset($laraconfig['Port']) && $laraconfig['Port'] == 80)) {
    $url = 'http';
} else {
    $url = 'https';
}
$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];
foreach ($folders as $host) {
    if (in_array($host, $ignore_dirs) || !is_dir($host)) {
        continue;
    }

    $admin_link = '';
    $app_name = '';
    $avatar = '';

    switch (true) {
        case (file_exists($host . '/core') || file_exists($host . '/web/core')):
            $app_name = ' Drupal ';
            $avatar = 'Laragon-Dashboard/assets/Drupal.svg';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/user" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'Laragon-Dashboard/assets/Wordpress.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'Laragon-Dashboard/assets/Joomla.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/administrator" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $avatar = 'Laragon-Dashboard/assets/Laravel.png';
            $admin_link = '';
            break;
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'Laragon-Dashboard/assets/Symfony.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $avatar = 'Laragon-Dashboard/assets/Python.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/Public" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Public Folder</a>';

            $command = 'python ' . htmlspecialchars($host) . '/app.py';
            exec($command, $output, $returnStatus);
            break;
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'Laragon-Dashboard/assets/CakePHP.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        default:
            $admin_link = '';
            $avatar = 'Laragon-Dashboard/assets/Unknown.png';
            break;
    }

    echo '<div class="col-3"><div class="overviewcard_sites"><div class="overviewcard_avatar"><img src="' . $avatar . '" style="width:20px; height:20px;"></div><div class="overviewcard_icon"><a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '">' . htmlspecialchars($host) . '</a></div><div class="overviewcard_info">' . $admin_link . '</div></div></div>';
}
?>
        </div>
    </div>
</div>

