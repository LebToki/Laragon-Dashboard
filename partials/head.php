<?php
// Ensure constants are defined
if (!defined('ASSETS_URL')) {
    // Fallback calculation if not defined
    $baseUrl = defined('BASE_URL') ? BASE_URL : '';
    $assetsUrl = $baseUrl === '' ? '/assets' : $baseUrl . '/assets';
} else {
    $assetsUrl = ASSETS_URL;
}

$baseUrl = defined('BASE_URL') ? BASE_URL : '';

// Calculate base href for <base> tag
// BASE_URL should be like "/Laragon-Dashboard" or ""
if (empty($baseUrl)) {
    $baseHref = '/';
} else {
    // Ensure it starts with / and ends with /
    $baseHref = rtrim($baseUrl, '/') . '/';
    if (substr($baseHref, 0, 1) !== '/') {
        $baseHref = '/' . $baseHref;
    }
}
?>
<head>
    <base href="<?php echo htmlspecialchars($baseHref); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Primary Meta Tags -->
<title>Laragon Dashboard - Modern Web Interface for Laragon</title>
<meta name="title" content="Laragon Dashboard - Modern Web Interface for Laragon">
<meta name="description" content="Comprehensive web-based dashboard for managing Laragon development environment. Service management, project detection, database tools, and server monitoring for Windows.">
<meta name="keywords" content="laragon, dashboard, development environment, windows, php, apache, mysql, web development, local server, mamp alternative">
<meta name="author" content="Tarek Tarabichi, 2TInteractive">
<meta name="robots" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://github.com/LebToki/Laragon-Dashboard/">
<meta property="og:title" content="Laragon Dashboard - Modern Web Interface for Laragon">
<meta property="og:description" content="Comprehensive web-based dashboard for managing Laragon development environment. Service management, project detection, database tools, and server monitoring for Windows.">
<meta property="og:image" content="https://raw.githubusercontent.com/LebToki/Laragon-Dashboard/main/assets/images/laragon-dashboard-og.png">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://github.com/LebToki/Laragon-Dashboard/">
<meta property="twitter:title" content="Laragon Dashboard - Modern Web Interface for Laragon">
<meta property="twitter:description" content="Comprehensive web-based dashboard for managing Laragon development environment. Service management, project detection, database tools, and server monitoring for Windows.">
<meta property="twitter:image" content="https://raw.githubusercontent.com/LebToki/Laragon-Dashboard/main/assets/images/laragon-dashboard-og.png">

<!-- Additional Meta Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#4f46e5">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">

<!-- Favicons -->
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $assetsUrl; ?>/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $assetsUrl; ?>/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $assetsUrl; ?>/images/favicon/favicon-16x16.png">
<link rel="manifest" href="<?php echo $assetsUrl; ?>/images/favicon/site.webmanifest">
<link rel="shortcut icon" href="<?php echo $assetsUrl; ?>/images/favicon/favicon.ico">
    <!-- remix icon font css  -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/remixicon.css">
    <!-- BootStrap css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/bootstrap.min.css">
    <!-- Apex Chart css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/apexcharts.css">
    <!-- Data Table css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/dataTables.min.css">
    <!-- Text Editor css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/editor-katex.min.css">
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/editor.atom-one-dark.min.css">
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/editor.quill.snow.css">
    <!-- Date picker css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/flatpickr.min.css">
    <!-- Calendar css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/full-calendar.css">
    <!-- Vector Map css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/jquery-jvectormap-2.0.5.css">
    <!-- Popup css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/magnific-popup.css">
    <!-- Slick Slider css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/slick.css">
    <!-- prism css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/prism.css">
    <!-- CodeMirror css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/codemirror.min.css">
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/theme/monokai.min.css">
    <!-- file upload css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/file-upload.css">

    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/audioplayer.css">
    <!-- Monochrome Mode css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/lib/monochrome-mode.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo $assetsUrl; ?>/css/style.css">
</head>