<?php
require_once "includes/autoload.php";
use LaragonDashboard\Core\PluginManager;

echo "Testing PluginManager:\n";
$plugins = PluginManager::getAvailablePlugins();
print_r($plugins);

echo "\nInstalled plugins:\n";
$installed = PluginManager::getInstalledPlugins();
print_r($installed);
?>