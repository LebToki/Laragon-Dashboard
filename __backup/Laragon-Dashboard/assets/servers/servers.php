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
<div class="tab-content <?php echo $activeTab === 'servers' ? 'active' : ''; ?>" id="servers" style="display: <?php echo $activeTab === 'servers' ? 'block' : 'none'; ?>;">
    <div class="container-fluid px-3 py-4">
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
        
        // Get Apache version from SERVER_SOFTWARE
        $apacheVersion = 'Unknown';
        $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
        if (preg_match('/Apache\/([\d.]+)/i', $serverSoftware, $matches)) {
            $apacheVersion = $matches[1];
        }
        ?>
        <?php
        // Get Laragon version
        $laragonVersion = 'Unknown';
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $laragonRoot = 'C:/laragon';
        if (strpos($docRoot, 'laragon') !== false) {
            $parts = explode('laragon', $docRoot);
            if (!empty($parts[0])) {
                $laragonRoot = $parts[0] . 'laragon';
            }
        }
        $laragonExePath = str_replace('/', DIRECTORY_SEPARATOR, $laragonRoot . '/laragon.exe');
        if (file_exists($laragonExePath)) {
            $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $laragonExePath) . '\').VersionInfo.FileVersion"';
            $version = shell_exec($command);
            if ($version && trim($version) !== '') {
                $versionParts = explode('.', trim($version));
                if (count($versionParts) >= 3) {
                    $laragonVersion = $versionParts[0] . '.' . $versionParts[1] . '.' . $versionParts[2];
                } else {
                    $laragonVersion = trim($version);
                }
            }
        }
        if ($laragonVersion === 'Unknown' && file_exists($laragonIniPath)) {
            $laraconfig = parse_ini_file($laragonIniPath);
            $laragonVersion = $laraconfig['Version'] ?? 'Unknown';
        }
        ?>
        <!-- Create Project Button -->
        <div class="mb-3">
            <button class="btn btn-primary open-project-wizard" style="background: #00adef; border: none; padding: 12px 24px; border-radius: 8px; color: #fff; font-weight: 600; font-family: 'Nunito', sans-serif; cursor: pointer;">
                <iconify-icon icon="mdi:plus-circle"></iconify-icon> Create New Project
            </button>
        </div>
        
        <!-- Row 1: 5 Cards -->
        <div class="row g-3 mb-3">
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-1">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">Apache</span>
                            <h6 class="overviewcard_info mb-0"><?php echo htmlspecialchars($apacheVersion); ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-1">
                            <iconify-icon icon="mdi:web"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-2">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">PHP</span>
                            <h6 class="overviewcard_info mb-0"><?php echo htmlspecialchars(phpversion()); ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-2">
                            <iconify-icon icon="mdi:language-php"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-3">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">MySQL</span>
                            <h6 class="overviewcard_info mb-0"><?php echo $mysqlVersion; ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-3">
                            <iconify-icon icon="mdi:database"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-4">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">OpenSSL</span>
                            <h6 class="overviewcard_info mb-0"><?=$serverInfo['openSsl'];?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-4">
                            <iconify-icon icon="mdi:lock"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-5">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">PHP <?php echo ($serverInfo['isFpm']) ? 'FPM' : 'SAPI'; ?></span>
                            <h6 class="overviewcard_info mb-0"><?php echo $serverInfo['phpSapi']; ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-5">
                            <iconify-icon icon="mdi:code-tags"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
        </div>
        <!-- Row 2: 5 Cards (including Search) -->
        <div class="row g-3 mb-3">
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-6">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon"><?php echo $translations['document_root'] ?? 'Document Root'; ?></span>
                            <h6 class="overviewcard_info mb-0">
                                <?php 
                                $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
                                if (defined('APP_DEBUG') && APP_DEBUG) {
                                    echo htmlspecialchars($docRoot);
                                } else {
                                    echo htmlspecialchars(basename($docRoot));
                                }
                                ?>
                            </h6>
                        </div>
                        <span class="overviewcard-icon-box color-6">
                            <iconify-icon icon="mdi:folder"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-7">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">Host</span>
                            <h6 class="overviewcard_info mb-0"><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-7">
                            <iconify-icon icon="mdi:web-network"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-8">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">PhpMyAdmin</span>
                            <h6 class="overviewcard_info mb-0">
                                <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank" style="color: #1a1a1a; text-decoration: none; font-weight: 700;">
                                    <?php echo $translations['manage_mysql'] ?? 'Manage MySQL'; ?>
                                </a>
                            </h6>
                        </div>
                        <span class="overviewcard-icon-box color-8">
                            <iconify-icon icon="mdi:database-cog"></iconify-icon>
                        </span>
                    </div>
                    <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-9">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content">
                            <span class="overviewcard_icon">Laragon</span>
                            <h6 class="overviewcard_info mb-0"><?php echo htmlspecialchars($laragonVersion); ?></h6>
                        </div>
                        <span class="overviewcard-icon-box color-9">
                            <iconify-icon icon="mdi:elephant"></iconify-icon>
                        </span>
                    </div>
                    <a href="javascript:void(0)" class="overviewcard-btn">View More</a>
                </div>
            </div>
            <div class="col" style="flex: 0 0 20%; max-width: 20%;">
                <div class="overviewcard color-10" style="min-height: 90px;">
                    <div class="overviewcard-header">
                        <div class="overviewcard-content" style="flex: 1;">
                            <span class="overviewcard_icon">Search Projects</span>
                            <input type="text" id="project-search" placeholder="Search..." style="background: transparent; border: none; outline: none; color: #1a1a1a !important; font-family: 'Nunito', Sans-serif, serif; font-size: 18px; font-weight: 700; width: 100%; padding: 0; margin-top: 2px;">
                        </div>
                        <span class="overviewcard-icon-box color-10">
                            <iconify-icon icon="mdi:magnify"></iconify-icon>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content Container -->
    <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px; margin-top: 10px;">
        <div class="container-fluid px-3">
            <div id="project-list" class="row g-2" style="flex-wrap: nowrap; overflow-x: auto; margin: 0;">
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
            $icon = 'mdi:drupal';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/user" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $icon = 'mdi:wordpress';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $icon = 'mdi:joomla';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/administrator" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $icon = 'mdi:laravel';
            $admin_link = '';
            break;
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $icon = 'mdi:symfony';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $icon = 'mdi:language-python';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/Public" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Public Folder</a>';

            $command = 'python ' . htmlspecialchars($host) . '/app.py';
            exec($command, $output, $returnStatus);
            break;
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $icon = 'mdi:cake';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        default:
            $admin_link = '';
            $icon = 'mdi:folder';
            break;
    }

    // Check if WordPress for wp-admin button
    $isWordPress = file_exists($host . '/wp-admin');
    $wpAdminButton = '';
    if ($isWordPress) {
        $wpAdminButton = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank" class="btn btn-sm" style="background-color: #43a047; color: #ffffff; border: none; padding: 4px 12px; border-radius: 4px; font-size: 11px; margin-top: 8px; text-decoration: none; display: inline-block;">wp-admin</a>';
    }
    
    echo '<div class="col-auto mb-2"><div class="overviewcard_sites_compact"><div class="overviewcard_sites_icon"><iconify-icon icon="' . $icon . '" style="font-size: 40px; color: #ffffff;"></iconify-icon></div><div class="overviewcard_sites_content"><div class="overviewcard_sites_title"><a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '" target="_blank" style="color: #FFFFFF; text-decoration: none; font-weight: 600; font-size: 14px;">' . htmlspecialchars($host) . '</a></div>' . ($admin_link ? '<div style="font-size: 11px; color: rgba(255,255,255,0.7); margin-top: 4px;">' . $admin_link . '</div>' : '') . $wpAdminButton . '</div></div></div>';
}
?>
            </div>
        </div>
    </div>
</div>

