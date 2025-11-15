<?php
/**
 * Application: Laragon | Bootstrap File
 * Description: Common initialization for all pages
 * Version: 2.6.1
 */

// Enable error reporting at the very start for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Define root paths using dirname(__DIR__, n)
// From /www/Laragon-Dashboard/pages/bootstrap.php:
// dirname(__DIR__, 1) = /www/Laragon-Dashboard/
// dirname(__DIR__, 2) = /www/
define('APP_ROOT', dirname(__DIR__, 2)); // /www/
define('DASHBOARD_ROOT', dirname(__DIR__, 1)); // /www/Laragon-Dashboard/
define('TEMPLATE_ROOT', DASHBOARD_ROOT . '/template'); // /www/Laragon-Dashboard/template/
define('PARTIALS_ROOT', DASHBOARD_ROOT . '/Laragon-Dashboard/assets/partials'); // /www/Laragon-Dashboard/Laragon-Dashboard/assets/partials/

// Prevent browser caching
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Load configuration first
require_once DASHBOARD_ROOT . '/config.php';

// Include required helpers
require_once DASHBOARD_ROOT . '/includes/logger.php';
require_once DASHBOARD_ROOT . '/includes/security.php';
require_once DASHBOARD_ROOT . '/includes/database.php';
require_once DASHBOARD_ROOT . '/includes/cache.php';
require_once DASHBOARD_ROOT . '/includes/helpers.php';

// Performance monitoring (make global for footer.php)
global $startTime, $startMemory;
$startTime = microtime(true);
$startMemory = memory_get_usage(true);

// Log dashboard access (only if logger class exists)
if (class_exists('DashboardLogger')) {
    try {
        DashboardLogger::info("Dashboard page accessed", [
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);
    } catch (Exception $e) {
        // Silently fail if logging fails
    }
}

// SECURITY: Disable debug query parameters in production
$isDebugMode = defined('APP_DEBUG') && APP_DEBUG;
if (isset($_GET['q']) && $isDebugMode && function_exists('handleQueryParameter')) {
    $queryParam = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    try {
        handleQueryParameter($queryParam);
    } catch (InvalidArgumentException $e) {
        http_response_code(400);
        echo 'Error: ' . htmlspecialchars($e->getMessage());
        exit;
    }
}

// Detect language preference (default to English) and sanitize input
$lang = strtolower($_GET['lang'] ?? 'en');
$translations = [];
$langConfig = [];
if (function_exists('loadLanguage')) {
    $translations = loadLanguage($lang);
}
if (function_exists('getLanguageConfig')) {
    $langConfig = getLanguageConfig();
}
$currentLang = $langConfig[$lang] ?? $langConfig['en'] ?? ['code' => 'en', 'name' => 'English', 'native' => 'English', 'flag' => 'US', 'font' => 'Nunito'];

$rootPath = realpath(APP_ROOT);
$folders = array_filter(glob($rootPath . '/*'), 'is_dir');
$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];

foreach ($folders as $folderPath) {
    $host = basename($folderPath);
    if (in_array($host, $ignore_dirs)) {
        continue;
    }
}

// Determine current page from script name
$scriptName = $_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? '';
$currentPage = basename($scriptName, '.php');
if ($currentPage === 'index' || $currentPage === '') {
    $currentPage = 'servers'; // index.php is the servers page
}

/**
 * Load layout top (head, sidebar, navbar)
 */
function loadLayoutTop() {
    global $lang, $translations, $currentPage, $langConfig, $currentLang;
    
    // Ensure constants are defined
    if (!defined('PARTIALS_ROOT')) {
        if (defined('DASHBOARD_ROOT')) {
            define('PARTIALS_ROOT', DASHBOARD_ROOT . '/Laragon-Dashboard/assets/partials');
        } else {
            error_log("ERROR: DASHBOARD_ROOT not defined!");
            echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Error</title></head><body>';
            echo '<div style="padding:20px;color:red;">Configuration Error: DASHBOARD_ROOT not defined</div>';
            echo '</body></html>';
            exit;
        }
    }
    
    $layoutTopPath = PARTIALS_ROOT . '/layouts/layoutTop.php';
    
    // Debug output (only in debug mode)
    if (defined('APP_DEBUG') && APP_DEBUG) {
        error_log("=== LAYOUT TOP DEBUG ===");
        error_log("Path: " . $layoutTopPath);
        error_log("Path exists: " . (file_exists($layoutTopPath) ? 'YES' : 'NO'));
        error_log("PARTIALS_ROOT: " . (defined('PARTIALS_ROOT') ? PARTIALS_ROOT : 'NOT DEFINED'));
        error_log("DASHBOARD_ROOT: " . (defined('DASHBOARD_ROOT') ? DASHBOARD_ROOT : 'NOT DEFINED'));
        error_log("========================");
        
        if (isset($_GET['debug_layouts'])) {
            echo "<!-- DEBUG: Layout Top Path Check -->\n";
            echo "<!-- Path: " . htmlspecialchars($layoutTopPath) . " - " . (file_exists($layoutTopPath) ? 'EXISTS' : 'NOT FOUND') . " -->\n";
        }
    }
    
    // Try to load layout
    if (file_exists($layoutTopPath)) {
        include $layoutTopPath;
    } else {
        error_log("ERROR: Layout top file not found!");
        error_log("  PARTIALS_ROOT: " . (defined('PARTIALS_ROOT') ? PARTIALS_ROOT : 'NOT DEFINED'));
        error_log("  Tried: " . $layoutTopPath);
        
        // Fallback minimal layout
        echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Laragon Dashboard - Layout Error</title></head><body>';
        echo '<div style="padding:20px;color:red;">';
        echo '<strong>Layout Error:</strong> Could not load layoutTop.php<br>';
        echo 'PARTIALS_ROOT: ' . (defined('PARTIALS_ROOT') ? htmlspecialchars(PARTIALS_ROOT) : 'NOT DEFINED') . '<br>';
        echo 'Checked path: ' . htmlspecialchars($layoutTopPath) . '<br>';
        echo 'File exists: ' . (file_exists($layoutTopPath) ? 'YES' : 'NO') . '<br>';
        echo '</div>';
        echo '</body></html>';
    }
    
    // Visual debug panel
    if (defined('APP_DEBUG') && APP_DEBUG && isset($_GET['debug_layouts'])) {
        echo '<div class="debug-layout-panel" style="position:fixed;bottom:10px;right:10px;background:#fff;border:2px solid #f00;padding:15px;max-width:400px;max-height:300px;overflow:auto;z-index:99999;font-size:12px;box-shadow:0 4px 8px rgba(0,0,0,0.3);">';
        echo '<strong style="color:#f00;">DEBUG: Layout Loading</strong><br><br>';
        echo '<strong>Layout Top:</strong><br>';
        echo 'Path: ' . (file_exists($layoutTopPath) ? '✓' : '✗') . ' ' . basename($layoutTopPath) . '<br>';
        echo '<strong>Used:</strong> ' . (file_exists($layoutTopPath) ? basename($layoutTopPath) : 'NONE') . '<br><br>';
        echo '<small>Check error_log for full paths</small>';
        echo '</div>';
    }
}

/**
 * Load layout bottom (footer, scripts)
 */
function loadLayoutBottom() {
    global $lang, $translations, $currentPage, $langConfig, $currentLang, $startTime, $startMemory;
    
    // Ensure constants are defined
    if (!defined('PARTIALS_ROOT')) {
        if (defined('DASHBOARD_ROOT')) {
            define('PARTIALS_ROOT', DASHBOARD_ROOT . '/Laragon-Dashboard/assets/partials');
        } else {
            error_log("ERROR: DASHBOARD_ROOT not defined in loadLayoutBottom!");
            echo '</body></html>';
            return;
        }
    }
    
    $layoutBottomPath = PARTIALS_ROOT . '/layouts/layoutBottom.php';
    
    // Debug output (only in debug mode)
    if (defined('APP_DEBUG') && APP_DEBUG) {
        error_log("=== LAYOUT BOTTOM DEBUG ===");
        error_log("Path: " . $layoutBottomPath);
        error_log("Path exists: " . (file_exists($layoutBottomPath) ? 'YES' : 'NO'));
        error_log("========================");
    }
    
    // Try to load layout
    if (file_exists($layoutBottomPath)) {
        include $layoutBottomPath;
    } else {
        error_log("ERROR: Layout bottom file not found!");
        error_log("  PARTIALS_ROOT: " . (defined('PARTIALS_ROOT') ? PARTIALS_ROOT : 'NOT DEFINED'));
        error_log("  Tried: " . $layoutBottomPath);
        echo '</body></html>';
    }
}

