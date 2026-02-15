<?php
/**
 * Laragon Dashboard Sidebar Navigation
 * Version: 3.0.0
 * Author: Tarek Tarabichi (2TInteractive)
 */

// Current page detection - works with both routing and direct file access
if (function_exists('getCurrentPage')) {
    $currentPage = getCurrentPage();
} else {
    // Priority 1: Check GET parameter (for index.php?page=... routing)
    $currentPage = $_GET['page'] ?? '';
    
    // Priority 2: If no GET parameter, detect from script path
    if (empty($currentPage)) {
        $scriptName = $_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? '';
        $scriptPath = parse_url($scriptName, PHP_URL_PATH);
        
        // Extract page name from path
        if (strpos($scriptPath, 'pages/') !== false) {
            // Direct file access: pages/projects.php -> projects
            $currentPage = basename($scriptPath, '.php');
        } else {
            // Index or root file
            $currentPage = basename($scriptPath, '.php');
            if ($currentPage === 'index' || $currentPage === '') {
                $currentPage = 'dashboard'; // Default to dashboard
            }
        }
    }
    
    // Sanitize
    $currentPage = strtolower(preg_replace('/[^a-zA-Z0-9_-]/', '', $currentPage));
}

// Load language configuration for translations
$langConfig = [];
$langConfigFile = __DIR__ . '/../i18n/languages.php';
if (file_exists($langConfigFile)) {
    $langConfig = require $langConfigFile;
}

// Get current language
$currentLang = strtolower($_GET['lang'] ?? $_COOKIE['lang'] ?? 'en');

// Set up asset paths
$assetsImageUrl = defined('ASSETS_URL') ? ASSETS_URL . '/images' : 'assets/images';
$assetsUrl = defined('ASSETS_URL') ? ASSETS_URL : 'assets';

// Load i18n helper if available
if (file_exists(__DIR__ . '/../includes/i18n.php')) {
    require_once __DIR__ . '/../includes/i18n.php';
}

// Load sidebar translations
$sidebarTranslations = [];
if (function_exists('load_translations')) {
    $sidebarTranslations = load_translations('sidebar');
}

// Helper function to get translation or fallback
function getSidebarTranslation($key, $fallback = '') {
    global $sidebarTranslations;
    if (function_exists('t')) {
        $translated = t('sidebar.' . $key);
        // If translation returns the key (not found), use fallback
        if ($translated === 'sidebar.' . $key) {
            return $fallback ?: $key;
        }
        return $translated;
    }
    return $sidebarTranslations[$key] ?? ($fallback ?: $key);
}
?>
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.php" class="sidebar-logo">
            <img src="<?php echo $assetsImageUrl; ?>/logo.png" alt="Laragon Dashboard" class="light-logo">
            <img src="<?php echo $assetsImageUrl; ?>/logo-light.png" alt="Laragon Dashboard" class="dark-logo">
            <img src="<?php echo $assetsImageUrl; ?>/logo-icon.png" alt="Laragon Dashboard" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <!-- Dashboard -->
            <li>
                <a href="index.php" class="<?php echo ($currentPage === 'index' || $currentPage === 'dashboard' || $currentPage === '') ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('dashboard', 'Dashboard'); ?></span>
                </a>
            </li>
            
            <!-- Development Section -->
            <li class="sidebar-menu-group-title"><?php echo getSidebarTranslation('development', 'Development'); ?></li>
            
            <li>
                <a href="index.php?page=projects" class="<?php echo $currentPage === 'projects' ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:folder-with-files-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('projects', 'Projects'); ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=databases" class="<?php echo $currentPage === 'databases' ? 'active' : ''; ?>">
                    <iconify-icon icon="streamline-plump:database-remix" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('databases', 'Databases'); ?></span>
                </a>
            </li>
            
            <!-- Services Section -->
            <li class="sidebar-menu-group-title"><?php echo getSidebarTranslation('services', 'Services'); ?></li>
            
            <li>
                <a href="index.php?page=services" class="<?php echo $currentPage === 'services' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:linked-services-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('services', 'Services'); ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=vitals" class="<?php echo $currentPage === 'vitals' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:vitals" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('server_vitals', 'Server Vitals'); ?></span>
                </a>
            </li>
            
            <!-- System Section -->
            <li class="sidebar-menu-group-title"><?php echo getSidebarTranslation('system', 'System'); ?></li>
            
            <li>
                <a href="index.php?page=mailbox" class="<?php echo $currentPage === 'mailbox' ? 'active' : ''; ?>">
                    <iconify-icon icon="hugeicons:ai-mail-02" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('mailbox', 'Mailbox'); ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=logs" class="<?php echo $currentPage === 'logs' ? 'active' : ''; ?>">
                    <iconify-icon icon="carbon:flow-logs-vpc" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('logs', 'Logs'); ?></span>
                </a>
            </li>
            
            <!-- Tools Section -->
            <li class="sidebar-menu-group-title"><?php echo getSidebarTranslation('tools', 'Tools'); ?></li>
            
            <li>
                <a href="index.php?page=tools" class="<?php echo $currentPage === 'tools' ? 'active' : ''; ?>">
                    <iconify-icon icon="clarity:tools-line" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('tools', 'Tools'); ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=backup" class="<?php echo $currentPage === 'backup' ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:cloud-storage-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('backup', 'Backup'); ?></span>
                </a>
            </li>
            
            <!-- Configuration Section -->
            <li class="sidebar-menu-group-title"><?php echo getSidebarTranslation('configuration', 'Configuration'); ?></li>
            
            <li>
                <a href="index.php?page=sites" class="<?php echo $currentPage === 'sites' ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:server-path-bold" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('sites_enabled', 'Sites Enabled'); ?></span>
                </a>
            </li>
            
            <li>
                <a href="index.php?page=httpd" class="<?php echo $currentPage === 'httpd' ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:settings-bold" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('server_configurations', 'Server Configurations'); ?></span>
                </a>
            </li>

            <li>
                <a href="index.php?page=config_editor" class="<?php echo $currentPage === 'config_editor' ? 'active' : ''; ?>">
                    <iconify-icon icon="solar:pen-new-square-bold" class="menu-icon"></iconify-icon>
                    <span>Config Editor</span>
                </a>
            </li>
            
            <!-- Settings -->
            <li>
                <a href="index.php?page=preferences" class="<?php echo $currentPage === 'preferences' ? 'active' : ''; ?>">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span><?php echo getSidebarTranslation('preferences', 'Preferences'); ?></span>
                </a>
            </li>
        </ul>
    </div>
</aside>
