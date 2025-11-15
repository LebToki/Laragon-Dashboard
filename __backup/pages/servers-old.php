<?php
/**
 * Application: Laragon | Servers Page
 * Description: Full page view for servers & applications
 * Version: 2.6.1
 */

// Load bootstrap
require_once __DIR__ . '/bootstrap.php';

// Load layout top
loadLayoutTop();
?>

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0"><?php echo $translations['header'] ?? 'My Development Server'; ?></h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium"><?php echo $translations['servers_tab'] ?? 'Servers'; ?></li>
        </ul>
    </div>

<!-- Project Wizard -->
<?php include DASHBOARD_ROOT . '/assets/partials/project_wizard.php'; ?>

<!-- Servers Content -->
<?php
// Get Laragon config path using dirname(__DIR__, n)
// From /www/Laragon-Dashboard/pages/servers.php:
// dirname(__DIR__, 2) = /www/ (APP_ROOT)
$laragonIniPath = APP_ROOT . '/usr/laragon.ini';
if (!file_exists($laragonIniPath)) {
    // Try alternative path - go up one level from APP_ROOT
    $laragonRoot = dirname(APP_ROOT);
    $laragonIniPath = $laragonRoot . '/usr/laragon.ini';
}
$laraconfig = file_exists($laragonIniPath) ? parse_ini_file($laragonIniPath) : [];

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
    
    <!-- Server Cards -->
    <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4 mb-24">
        <!-- Apache -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Apache</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars($apacheVersion); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:web" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- PHP -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">PHP</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars(phpversion()); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:language-php" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- MySQL -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">MySQL</p>
                            <h6 class="mb-0"><?php echo $mysqlVersion; ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:database" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- OpenSSL -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">OpenSSL</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars($serverInfo['openSsl']); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:lock" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- PHP FPM/SAPI -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">PHP <?php echo ($serverInfo['isFpm']) ? 'FPM' : 'SAPI'; ?></p>
                            <h6 class="mb-0"><?php echo htmlspecialchars($serverInfo['phpSapi']); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:code-tags" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Document Root -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1"><?php echo $translations['document_root'] ?? 'Document Root'; ?></p>
                            <h6 class="mb-0">
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
                        <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:folder" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Host -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Host</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:web-network" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- PhpMyAdmin -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">PhpMyAdmin</p>
                            <h6 class="mb-0"><?php echo $translations['manage_mysql'] ?? 'Manage MySQL'; ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:database-cog" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank" class="btn btn-primary-100 text-primary-600 text-sm py-1 px-16 mt-12">Admin</a>
                </div>
            </div>
        </div>
        
        <!-- Laragon -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Laragon</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars($laragonVersion); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:elephant" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Projects -->
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div style="flex: 1;">
                            <p class="fw-medium text-primary-light mb-1">Search Projects</p>
                            <input type="text" id="project-search" placeholder="Search..." style="background: transparent; border: none; outline: none; color: #1a1a1a !important; font-family: 'Nunito', Sans-serif, serif; font-size: 18px; font-weight: 700; width: 100%; padding: 0; margin-top: 2px;">
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:magnify" class="text-base text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Cards by Platform -->
<?php
// Collect and group projects by platform
$folders = array_filter(glob(APP_ROOT . '/*'), 'is_dir');
sort($folders, SORT_NATURAL | SORT_FLAG_CASE);

if (isset($laraconfig['SSLEnabled']) && $laraconfig['SSLEnabled'] == 0 || (isset($laraconfig['Port']) && $laraconfig['Port'] == 80)) {
    $url = 'http';
} else {
    $url = 'https';
}

$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];
$platforms = [
    'WordPress' => ['count' => 0, 'icon' => 'solar:document-bold', 'color' => 'primary', 'projects' => []],
    'Laravel' => ['count' => 0, 'icon' => 'solar:code-bold', 'color' => 'danger', 'projects' => []],
    'Drupal' => ['count' => 0, 'icon' => 'solar:code-square-bold', 'color' => 'warning', 'projects' => []],
    'Joomla' => ['count' => 0, 'icon' => 'solar:widget-5-bold', 'color' => 'success', 'projects' => []],
    'Symfony' => ['count' => 0, 'icon' => 'solar:settings-bold', 'color' => 'info', 'projects' => []],
    'CakePHP' => ['count' => 0, 'icon' => 'solar:cake-bold', 'color' => 'secondary', 'projects' => []],
    'Python' => ['count' => 0, 'icon' => 'solar:code-2-bold', 'color' => 'warning', 'projects' => []],
    'Other' => ['count' => 0, 'icon' => 'solar:folder-bold', 'color' => 'secondary', 'projects' => []]
];

$totalProjects = 0;

foreach ($folders as $folderPath) {
    $host = basename($folderPath);
    if (in_array($host, $ignore_dirs) || !is_dir($folderPath)) {
        continue;
    }

    $platform = 'Other';
    $icon = 'solar:folder-bold';

    switch (true) {
        case file_exists($folderPath . '/wp-admin'):
            $platform = 'WordPress';
            $icon = 'solar:document-bold';
            break;
        case file_exists($folderPath . '/public/index.php') && is_dir($folderPath . '/app') && file_exists($folderPath . '/.env'):
            $platform = 'Laravel';
            $icon = 'solar:code-bold';
            break;
        case (file_exists($folderPath . '/core') || file_exists($folderPath . '/web/core')):
            $platform = 'Drupal';
            $icon = 'solar:code-square-bold';
            break;
        case file_exists($folderPath . '/administrator'):
            $platform = 'Joomla';
            $icon = 'solar:widget-5-bold';
            break;
        case file_exists($folderPath . '/bin/console'):
            $platform = 'Symfony';
            $icon = 'solar:settings-bold';
            break;
        case file_exists($folderPath . '/bin/cake'):
            $platform = 'CakePHP';
            $icon = 'solar:cake-bold';
            break;
        case (file_exists($folderPath . '/') && is_dir($folderPath . '/app.py') && is_dir($folderPath . '/static') && file_exists($folderPath . '/.env')):
            $platform = 'Python';
            $icon = 'solar:code-2-bold';
            break;
    }

    if (isset($platforms[$platform])) {
        $platforms[$platform]['count']++;
        $platforms[$platform]['projects'][] = [
            'name' => $host,
            'path' => $folderPath,
            'url' => $url . '://' . $host . DOMAIN_SUFFIX,
            'icon' => $icon
        ];
        $totalProjects++;
    }
}
?>

    <!-- Project Statistics Cards -->
    <div class="row gy-4">
        <div class="col-xxxl-9">
            <div class="row g-3">
                <!-- Total Projects Card -->
                <div class="col-lg-3 col-sm-6">
                    <div class="card shadow-none border radius-12 bg-gradient-start-1 h-100">
                        <div class="card-body p-16">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                                <div>
                                    <p class="fw-medium text-secondary-light mb-1 text-sm">Total Projects</p>
                                    <h6 class="mb-0"><?php echo $totalProjects; ?></h6>
                                </div>
                                <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                                    <iconify-icon icon="solar:folder-bold" class="text-white text-2xl mb-0"></iconify-icon>
                                </div>
                            </div>
                            <a href="javascript:void(0)" class="btn btn-primary-100 text-primary-600 text-sm py-1 px-16 mt-12" onclick="showAllProjects()">View More</a>
                        </div>
                    </div>
                </div>

                <?php
                // Display platform cards
                $colorMap = [
                    'primary' => 'bg-cyan',
                    'danger' => 'bg-red',
                    'warning' => 'bg-warning-600',
                    'success' => 'bg-success-main',
                    'info' => 'bg-info',
                    'secondary' => 'bg-secondary-600'
                ];

                foreach ($platforms as $platformName => $platformData) {
                    if ($platformData['count'] > 0) {
                        $color = $platformData['color'];
                        $bgColor = $colorMap[$color] ?? 'bg-cyan';
                        ?>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card shadow-none border radius-12 bg-gradient-start-<?php echo ($platformData['count'] % 5) + 1; ?> h-100">
                                <div class="card-body p-16">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                                        <div>
                                            <p class="fw-medium text-secondary-light mb-1 text-sm"><?php echo $platformName; ?> Projects</p>
                                            <h6 class="mb-0"><?php echo $platformData['count']; ?></h6>
                                        </div>
                                        <div class="w-50-px h-50-px <?php echo $bgColor; ?> rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="<?php echo $platformData['icon']; ?>" class="text-white text-2xl mb-0"></iconify-icon>
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" class="btn btn-primary-100 text-primary-600 text-sm py-1 px-16 mt-12" onclick="showPlatformProjects('<?php echo $platformName; ?>')">View More</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Project List Container -->
    <div id="project-list-container" class="mt-24">
        <div class="tab-content-container">
            <div class="d-flex align-items-center justify-content-between mb-16">
                <h6 class="fw-semibold mb-0" id="project-list-title">All Projects</h6>
            </div>
            <div id="project-list" class="row">
                    <?php
                    // Display all projects
                    foreach ($folders as $folderPath) {
                        $host = basename($folderPath);
                        if (in_array($host, $ignore_dirs) || !is_dir($folderPath)) {
                            continue;
                        }

                        $platform = 'Other';
                        $icon = 'solar:folder-bold';
                        $admin_link = '';

                        switch (true) {
                            case file_exists($folderPath . '/wp-admin'):
                                $platform = 'WordPress';
                                $icon = 'solar:document-bold';
                                $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank" class="btn btn-sm btn-success-100 text-success-600 mt-2">wp-admin</a>';
                                break;
                            case file_exists($folderPath . '/public/index.php') && is_dir($folderPath . '/app') && file_exists($folderPath . '/.env'):
                                $platform = 'Laravel';
                                $icon = 'solar:code-bold';
                                break;
                            case (file_exists($folderPath . '/core') || file_exists($folderPath . '/web/core')):
                                $platform = 'Drupal';
                                $icon = 'solar:code-square-bold';
                                $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/user" target="_blank" class="btn btn-sm btn-primary-100 text-primary-600 mt-2">Admin</a>';
                                break;
                            case file_exists($folderPath . '/administrator'):
                                $platform = 'Joomla';
                                $icon = 'solar:widget-5-bold';
                                $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/administrator" target="_blank" class="btn btn-sm btn-primary-100 text-primary-600 mt-2">Admin</a>';
                                break;
                            case file_exists($folderPath . '/bin/console'):
                                $platform = 'Symfony';
                                $icon = 'solar:settings-bold';
                                $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank" class="btn btn-sm btn-primary-100 text-primary-600 mt-2">Admin</a>';
                                break;
                            case file_exists($folderPath . '/bin/cake'):
                                $platform = 'CakePHP';
                                $icon = 'solar:cake-bold';
                                $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank" class="btn btn-sm btn-primary-100 text-primary-600 mt-2">Admin</a>';
                                break;
                            case (file_exists($folderPath . '/') && is_dir($folderPath . '/app.py') && is_dir($folderPath . '/static') && file_exists($folderPath . '/.env')):
                                $platform = 'Python';
                                $icon = 'solar:code-2-bold';
                                break;
                        }
                        ?>
                        <div class="col-3 project-item" data-platform="<?php echo htmlspecialchars($platform); ?>" data-name="<?php echo htmlspecialchars(strtolower($host)); ?>">
                            <div class="card shadow-none border">
                                <div class="card-body p-20">
                                    <div class="d-flex align-items-center gap-3 mb-12">
                                        <div class="w-50-px h-50-px bg-primary-100 text-primary-600 rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="<?php echo $icon; ?>" class="text-2xl"></iconify-icon>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 fw-semibold">
                                                <a href="<?php echo $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX; ?>" target="_blank" class="text-primary-light hover-text-primary">
                                                    <?php echo htmlspecialchars($host); ?>
                                                </a>
                                            </h6>
                                            <span class="text-xs text-secondary-light"><?php echo $platform; ?></span>
                                        </div>
                                    </div>
                                    <?php if ($admin_link): ?>
                                        <div class="d-flex gap-2">
                                            <?php echo $admin_link; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </div>
        </div>
    </div>
</div>

<script>
// Project filtering functions
function showAllProjects() {
    document.querySelectorAll('.project-item').forEach(item => {
        item.style.display = '';
    });
    document.getElementById('project-list-title').textContent = 'All Projects';
}

function showPlatformProjects(platform) {
    document.querySelectorAll('.project-item').forEach(item => {
        if (item.dataset.platform === platform) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
    document.getElementById('project-list-title').textContent = platform + ' Projects';
}

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('project-search');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            document.querySelectorAll('.project-item').forEach(item => {
                const projectName = item.dataset.name;
                if (projectName.includes(searchTerm)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
});
</script>

<?php
// Load layout bottom
loadLayoutBottom();
?>

