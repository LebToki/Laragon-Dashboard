<?php
// Get theme from cookie/localStorage (will be set by JavaScript)
// Default to light if not set
$currentTheme = $_COOKIE['theme'] ?? 'light';

// Get current language and direction for RTL support
$currentLang = 'en';
$textDirection = 'ltr';

if (function_exists('get_current_language')) {
    $currentLang = get_current_language();
}

if (function_exists('get_text_direction')) {
    $textDirection = get_text_direction();
}
?>
<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($currentLang); ?>" data-theme="<?php echo htmlspecialchars($currentTheme); ?>" dir="<?php echo htmlspecialchars($textDirection); ?>">

<?php 
// Use absolute path to ensure it works regardless of where it's included from
$headPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/head.php' : __DIR__ . '/../head.php';
include $headPath;
?>

<script>
    // Global CSRF token for AJAX requests
    window.csrfToken = "<?php echo getCSRFToken(); ?>";
</script>

<body>

    <?php 
    if (!isset($GLOBALS['is_login_page']) || !$GLOBALS['is_login_page']) {
        // Use absolute path to ensure it works regardless of where it's included from
        $sidebarPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/sidebar.php' : __DIR__ . '/../sidebar.php';
        include $sidebarPath;
    }
    ?>

    <?php 
    // Debug banner (only if explicitly enabled via preferences - disabled by default)
    // Check preferences first, then APP_DEBUG constant as fallback
    $showDebugBanner = false;
    if (function_exists('getDashboardPreferences')) {
        $prefs = getDashboardPreferences();
        $showDebugBanner = isset($prefs['debug_banner']) ? (bool)$prefs['debug_banner'] : false;
    }
    // Only check APP_DEBUG if preferences not explicitly set
    if (!$showDebugBanner && defined('APP_DEBUG')) {
        $showDebugBanner = APP_DEBUG;
    }
    // Only include if explicitly enabled (default is false)
    if ($showDebugBanner && file_exists(__DIR__ . '/../debug_banner.php')) {
        include __DIR__ . '/../debug_banner.php';
    }
    ?>
    
    <main class="dashboard-main <?php echo (isset($GLOBALS['is_login_page']) && $GLOBALS['is_login_page']) ? 'ms-0 w-100' : ''; ?>">
        <?php 
        if (!isset($GLOBALS['is_login_page']) || !$GLOBALS['is_login_page']) {
            // Use absolute path to ensure it works regardless of where it's included from
            $navbarPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/navbar.php' : __DIR__ . '/../navbar.php';
            include $navbarPath;
        }
        ?>
