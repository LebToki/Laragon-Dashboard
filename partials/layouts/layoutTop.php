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

<?php include __DIR__ . '/../head.php' ?>

<body>

    <?php include __DIR__ . '/../sidebar.php' ?>

    <main class="dashboard-main">
        <?php include __DIR__ . '/../navbar.php' ?>
