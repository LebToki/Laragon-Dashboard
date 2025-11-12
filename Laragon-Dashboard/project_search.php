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
            $avatar = 'assets/Drupal.svg';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/user" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'assets/Wordpress.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'assets/Joomla.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/administrator" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $avatar = 'assets/Laravel.png';
            $admin_link = '';
            break;
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'assets/Symfony.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $avatar = 'assets/Python.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/Public" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Public Folder</a>';
            break;
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'assets/CakePHP.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        default:
            $admin_link = '';
            $avatar = 'assets/Unknown.png';
            break;
    }

    echo '<div class="overviewcard_sites"><div class="overviewcard_avatar"><img src="' . $avatar . '" style="width:20px; height:20px;"></div><div class="overviewcard_icon"><a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '">' . htmlspecialchars($host) . '</a></div><div class="overviewcard_info">' . $admin_link . '</div></div>';
}
