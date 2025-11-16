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

<body>

    <?php 
    // Use absolute path to ensure it works regardless of where it's included from
    $sidebarPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/sidebar.php' : __DIR__ . '/../sidebar.php';
    include $sidebarPath;
    ?>

    <main class="dashboard-main">
        <?php 
        // Use absolute path to ensure it works regardless of where it's included from
        $navbarPath = defined('PARTIALS_ROOT') ? PARTIALS_ROOT . '/navbar.php' : __DIR__ . '/../navbar.php';
        include $navbarPath;
        ?>
