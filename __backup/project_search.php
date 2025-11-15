<?php
require_once __DIR__ . '/config.php';

$ignored = ['favicon_io'];
$folders = array_filter(glob('*'), 'is_dir');
sort($folders, SORT_NATURAL | SORT_FLAG_CASE);

$laraconfig = @parse_ini_file('../usr/laragon.ini');
if ($laraconfig['SSLEnabled'] == 0 || ($laraconfig['Port'] ?? 80) == 80) {
    $url = 'http';
} else {
    $url = 'https';
}

$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets'];
$q = isset($_GET['q']) ? strtolower($_GET['q']) : '';

foreach ($folders as $host) {
    if (in_array($host, $ignore_dirs) || !is_dir($host)) {
        continue;
    }
    if ($q && stripos($host, $q) === false) {
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
