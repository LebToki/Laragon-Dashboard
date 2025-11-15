<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <?php
    // Web-relative paths (from /Laragon-Dashboard/ base)
    $templateAssets = 'template/assets';
    $dashboardAssets = 'assets';
    ?>
    <link rel="icon" type="image/x-icon" href="<?php echo $dashboardAssets; ?>/favicon.ico">
    <title><?php echo $translations['title'] ?? 'Welcome to the Laragon Dashboard'; ?></title>

    <!-- WowDash Template CSS Files -->
    <!-- Remix Icon Font -->
    <link rel="stylesheet" href="<?php echo $templateAssets; ?>/css/remixicon.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $templateAssets; ?>/css/lib/bootstrap.min.css">
    <!-- Apex Chart CSS -->
    <link rel="stylesheet" href="<?php echo $templateAssets; ?>/css/lib/apexcharts.css">
    <!-- Main WowDash Style -->
    <link rel="stylesheet" href="<?php echo $templateAssets; ?>/css/style.css">
    
    <!-- Nunito Font Fallback from Google Fonts CDN -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tajawal Font for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- jQuery, Bootstrap, Chart.js, and Iconify will be loaded in the body before scripts.php -->

    <link rel="icon" href="<?php echo $dashboardAssets; ?>/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="<?php echo $dashboardAssets; ?>/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo $dashboardAssets; ?>/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo $dashboardAssets; ?>/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="<?php echo $dashboardAssets; ?>/favicon/android-chrome-512x512.png" sizes="512x512">
    <link rel="icon" type="apple-touch-icon" href="<?php echo $dashboardAssets; ?>/favicon/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo $dashboardAssets; ?>/favicon/site.webmanifest">
    
    <?php 
    // Include inline styles from index.php
    // Styles are extracted from lines 460-1925 of the original index.php
    // This keeps the head.php file manageable while maintaining all styles
    $stylesFile = __DIR__ . '/../styles-inline.php';
    if (file_exists($stylesFile)) {
        include $stylesFile;
    } else {
        // Fallback: include styles directly if file doesn't exist
        // For now, we'll include them in scripts.php or keep them in index.php
        // This is a placeholder for future optimization
    }
    ?>
</head>

