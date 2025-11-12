<?php
/**
 * Script to update all paths in index.php to use LaragonDash/ prefix
 */

$indexFile = __DIR__ . '/index.php';
$content = file_get_contents($indexFile);

// Update asset paths
$content = str_replace('href="assets/', 'href="LaragonDash/assets/', $content);
$content = str_replace("href='assets/", "href='LaragonDash/assets/", $content);
$content = str_replace('src="assets/', 'src="LaragonDash/assets/', $content);
$content = str_replace("src='assets/", "src='LaragonDash/assets/", $content);
$content = str_replace('url(assets/', 'url(LaragonDash/assets/', $content);
$content = str_replace('glob(__DIR__ . "/assets/', 'glob(__DIR__ . "/LaragonDash/assets/', $content);

// Update API endpoints
$content = str_replace("'project_search.php", "'LaragonDash/project_search.php", $content);
$content = str_replace('"project_search.php', '"LaragonDash/project_search.php', $content);
$content = str_replace("'server_vitals.php", "'LaragonDash/server_vitals.php", $content);
$content = str_replace('"server_vitals.php', '"LaragonDash/server_vitals.php', $content);
$content = str_replace("'database_manager.php", "'LaragonDash/database_manager.php", $content);
$content = str_replace('"database_manager.php', '"LaragonDash/database_manager.php', $content);
$content = str_replace("'services_manager.php", "'LaragonDash/services_manager.php", $content);
$content = str_replace('"services_manager.php', '"LaragonDash/services_manager.php', $content);
$content = str_replace("'log_viewer.php", "'LaragonDash/log_viewer.php", $content);
$content = str_replace('"log_viewer.php', '"LaragonDash/log_viewer.php', $content);
$content = str_replace("'quick_tools.php", "'LaragonDash/quick_tools.php", $content);
$content = str_replace('"quick_tools.php', '"LaragonDash/quick_tools.php', $content);
$content = str_replace("'bcrypt_generator.php", "'LaragonDash/bcrypt_generator.php", $content);
$content = str_replace('"bcrypt_generator.php', '"LaragonDash/bcrypt_generator.php', $content);
$content = str_replace("'backup_manager.php", "'LaragonDash/backup_manager.php", $content);
$content = str_replace('"backup_manager.php', '"LaragonDash/backup_manager.php', $content);

// Update include paths
$content = str_replace("include 'assets/", "include 'LaragonDash/assets/", $content);
$content = str_replace('include "assets/', 'include "LaragonDash/assets/', $content);

// Update version
$content = str_replace("Version: 2.5.0", "Version: 2.6.0", $content);

file_put_contents($indexFile, $content);
echo "Paths updated in index.php\n";

