<?php
/**
 * Laragon Dashboard Sidebar Navigation
 * Version: 3.0.0
 * Author: Tarek Tarabichi (2TInteractive)
 */

// Current page is set by layoutTop.php, but provide fallback
if (!isset($currentPage)) {
    $currentPage = $_GET['page'] ?? '';
    if (empty($currentPage)) {
        $scriptName = $_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? '';
        $currentPage = basename($scriptName, '.php');
        if ($currentPage === 'index' || $currentPage === '') {
            $currentPage = 'servers'; // Default to servers page
        }
    }
}

// Ensure config is loaded
if (!defined('APP_ROOT')) {
    require_once dirname(dirname(dirname(__FILE__))) . '/config.php';
}

// Load translations if available
$translations = [];
$lang = strtolower($_GET['lang'] ?? 'en');
$langFile = ASSETS_ROOT . '/languages/' . $lang . '.json';
if (file_exists($langFile)) {
    $translations = json_decode(file_get_contents($langFile), true) ?? [];
} elseif (file_exists(ASSETS_ROOT . '/languages/en.json')) {
    $translations = json_decode(file_get_contents(ASSETS_ROOT . '/languages/en.json'), true) ?? [];
}
?>
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.php?page=servers" class="sidebar-logo">
            <?php 
            $assetsUrl = defined('ASSETS_URL') ? ASSETS_URL : '../assets';
            ?>
            <img src="<?php echo $assetsUrl; ?>/logo.png" alt="Laragon Dashboard" class="light-logo">
            <img src="<?php echo $assetsUrl; ?>/logo-light.png" alt="Laragon Dashboard" class="dark-logo">
            <img src="<?php echo $assetsUrl; ?>/logo-icon.png" alt="Laragon Dashboard" class="logo-icon">
            <span class="sidebar-title">Laragon</span>
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="index.php?page=servers" class="<?php echo $currentPage === 'servers' ? 'active' : ''; ?>">
                    <iconify-icon icon="carbon:ibm-cloud-bare-metal-servers-vpc" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['servers_tab'] ?? 'Servers'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=mailbox" class="<?php echo $currentPage === 'mailbox' ? 'active' : ''; ?>">
                    <iconify-icon icon="hugeicons:ai-mail-02" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['inbox_tab'] ?? 'Mailbox'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=vitals" class="<?php echo $currentPage === 'vitals' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:vitals" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['vitals_tab'] ?? 'Server\'s Vitals'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=databases" class="<?php echo $currentPage === 'databases' ? 'active' : ''; ?>">
                    <iconify-icon icon="streamline-plump:database-remix" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['databases_tab'] ?? 'Databases'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=services" class="<?php echo $currentPage === 'services' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:linked-services-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['services_tab'] ?? 'Services'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=logs" class="<?php echo $currentPage === 'logs' ? 'active' : ''; ?>">
                    <iconify-icon icon="carbon:flow-logs-vpc" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['logs_tab'] ?? 'Logs'; ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=tools" class="<?php echo $currentPage === 'tools' ? 'active' : ''; ?>">
                    <iconify-icon icon="clarity:tools-line" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['tools_tab'] ?? 'Tools'; ?></span>
                </a>
            </li>
        </ul>
    </div>
</aside>

