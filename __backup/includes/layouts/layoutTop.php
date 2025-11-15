<?php
/**
 * Laragon Dashboard Layout Top
 * Version: 3.0.0
 * Includes: Head, Sidebar, Navbar
 */

// Ensure config is loaded
if (!defined('APP_ROOT')) {
    require_once dirname(__DIR__) . '/config.php';
}

// Determine current page
$currentPage = $_GET['page'] ?? '';
if (empty($currentPage)) {
    $scriptName = $_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? '';
    $currentPage = basename($scriptName, '.php');
    if ($currentPage === 'index' || $currentPage === '') {
        $currentPage = 'servers';
    }
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
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $translations['title'] ?? 'Laragon Dashboard'; ?> - <?php echo APP_NAME; ?></title>
    <link rel="icon" type="image/png" href="<?php echo ASSETS_URL; ?>/favicon.ico" sizes="16x16">
    
    <!-- Template CSS Files -->
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/remixicon.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/apexcharts.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/dataTables.min.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/flatpickr.min.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/jquery-jvectormap-2.0.5.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/slick.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/prism.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/lib/file-upload.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>/assets/css/style.css">
    
    <!-- Laragon Dashboard Custom Styles -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/style.css">
</head>
<body>
    <?php 
    // Set current page for sidebar
    $currentPage = $_GET['page'] ?? '';
    if (empty($currentPage)) {
        $scriptName = $_SERVER['PHP_SELF'] ?? $_SERVER['SCRIPT_NAME'] ?? '';
        $currentPage = basename($scriptName, '.php');
        if ($currentPage === 'index' || $currentPage === '') {
            $currentPage = 'servers';
        }
    }
    include PARTIALS_ROOT . '/sidebar-laragon.php'; 
    ?>
    
    <main class="dashboard-main">
        <?php include PARTIALS_ROOT . '/navbar.php'; ?>

