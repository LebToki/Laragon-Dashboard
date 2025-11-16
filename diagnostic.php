<?php
/**
 * Laragon Dashboard Diagnostic Tool
 * Use this to diagnose path and configuration issues
 */

// Prevent direct access in production (remove this line to use)
// die("Diagnostic tool disabled. Remove this line to enable.");

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laragon Dashboard - Diagnostic Tool</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #f5f5f5; }
        .section { background: white; padding: 20px; margin: 10px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { color: #333; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        .success { color: #10b981; }
        .error { color: #ef4444; }
        .warning { color: #f59e0b; }
        .info { color: #3b82f6; }
        pre { background: #f9fafb; padding: 15px; border-radius: 5px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 8px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f3f4f6; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🔍 Laragon Dashboard Diagnostic Tool</h1>
    
    <?php
    // Load config if available
    $configLoaded = false;
    if (file_exists(__DIR__ . '/config.php')) {
        require_once __DIR__ . '/config.php';
        $configLoaded = true;
    }
    ?>
    
    <div class="section">
        <h2>1. Server Information</h2>
        <table>
            <tr><th>PHP Version</th><td><?php echo PHP_VERSION; ?></td></tr>
            <tr><th>Server Software</th><td><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></td></tr>
            <tr><th>Document Root</th><td><?php echo htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? 'Not set'); ?></td></tr>
            <tr><th>Script Filename</th><td><?php echo htmlspecialchars($_SERVER['SCRIPT_FILENAME'] ?? 'Not set'); ?></td></tr>
            <tr><th>Script Name</th><td><?php echo htmlspecialchars($_SERVER['SCRIPT_NAME'] ?? 'Not set'); ?></td></tr>
            <tr><th>Request URI</th><td><?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'Not set'); ?></td></tr>
            <tr><th>HTTP Host</th><td><?php echo htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'Not set'); ?></td></tr>
        </table>
    </div>
    
    <div class="section">
        <h2>2. Path Detection</h2>
        <?php
        $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
        $scriptFile = __FILE__;
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        
        echo "<h3>Calculated Paths:</h3>";
        echo "<table>";
        echo "<tr><th>Document Root</th><td>" . htmlspecialchars($docRoot) . "</td></tr>";
        echo "<tr><th>Script File</th><td>" . htmlspecialchars($scriptFile) . "</td></tr>";
        echo "<tr><th>Script Name</th><td>" . htmlspecialchars($scriptName) . "</td></tr>";
        
        if (!empty($docRoot) && !empty($scriptFile)) {
            $docRootNorm = str_replace('\\', '/', rtrim($docRoot, '/\\'));
            $scriptFileNorm = str_replace('\\', '/', $scriptFile);
            
            if (strpos($scriptFileNorm, $docRootNorm) === 0) {
                $relativePath = substr($scriptFileNorm, strlen($docRootNorm));
                $relativeDir = dirname($relativePath);
                echo "<tr><th>Relative Path</th><td>" . htmlspecialchars($relativePath) . "</td></tr>";
                echo "<tr><th>Relative Directory</th><td>" . htmlspecialchars($relativeDir) . "</td></tr>";
                echo "<tr><th>Calculated BASE_URL</th><td class='info'>" . htmlspecialchars($relativeDir === '.' ? '' : $relativeDir) . "</td></tr>";
            } else {
                echo "<tr><th>Status</th><td class='error'>Script is NOT inside document root!</td></tr>";
            }
        }
        
        if ($configLoaded && defined('BASE_URL')) {
            echo "<tr><th>Defined BASE_URL</th><td class='success'>" . htmlspecialchars(BASE_URL) . "</td></tr>";
        }
        if ($configLoaded && defined('ASSETS_URL')) {
            echo "<tr><th>Defined ASSETS_URL</th><td class='success'>" . htmlspecialchars(ASSETS_URL) . "</td></tr>";
        }
        echo "</table>";
        ?>
    </div>
    
    <div class="section">
        <h2>3. Laragon Detection</h2>
        <?php
        if ($configLoaded && function_exists('getLaragonRoot')) {
            $laragonRoot = getLaragonRoot();
            echo "<table>";
            echo "<tr><th>Detected Laragon Root</th><td class='success'>" . htmlspecialchars($laragonRoot) . "</td></tr>";
            
            if (defined('LARAGON_ROOT')) {
                echo "<tr><th>LARAGON_ROOT Constant</th><td class='success'>" . htmlspecialchars(LARAGON_ROOT) . "</td></tr>";
            }
            
            // Check if path exists
            if (is_dir($laragonRoot)) {
                echo "<tr><th>Path Exists</th><td class='success'>✓ Yes</td></tr>";
            } else {
                echo "<tr><th>Path Exists</th><td class='error'>✗ No</td></tr>";
            }
            
            // Check for laragon.exe
            $exePath = $laragonRoot . '/laragon.exe';
            if (file_exists($exePath)) {
                echo "<tr><th>laragon.exe Found</th><td class='success'>✓ Yes</td></tr>";
            } else {
                echo "<tr><th>laragon.exe Found</th><td class='error'>✗ No (checked: " . htmlspecialchars($exePath) . ")</td></tr>";
            }
            
            // Check for laragon.ini
            $iniPath = $laragonRoot . '/usr/laragon.ini';
            if (file_exists($iniPath)) {
                echo "<tr><th>laragon.ini Found</th><td class='success'>✓ Yes</td></tr>";
            } else {
                echo "<tr><th>laragon.ini Found</th><td class='error'>✗ No (checked: " . htmlspecialchars($iniPath) . ")</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='error'>Config not loaded or getLaragonRoot() function not available</p>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>4. File System Checks</h2>
        <?php
        $checks = [
            'config.php' => __DIR__ . '/config.php',
            'index.php' => __DIR__ . '/index.php',
            'assets directory' => __DIR__ . '/assets',
            'assets/css/style.css' => __DIR__ . '/assets/css/style.css',
            'partials/head.php' => __DIR__ . '/partials/head.php',
            'pages/dashboard.php' => __DIR__ . '/pages/dashboard.php',
        ];
        
        echo "<table>";
        foreach ($checks as $name => $path) {
            $exists = file_exists($path);
            $readable = $exists ? is_readable($path) : false;
            echo "<tr>";
            echo "<th>" . htmlspecialchars($name) . "</th>";
            echo "<td>" . htmlspecialchars($path) . "</td>";
            echo "<td>" . ($exists ? "<span class='success'>✓ Exists</span>" : "<span class='error'>✗ Missing</span>") . "</td>";
            echo "<td>" . ($readable ? "<span class='success'>✓ Readable</span>" : "<span class='error'>✗ Not Readable</span>") . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
    
    <div class="section">
        <h2>5. Asset Path Test</h2>
        <?php
        if ($configLoaded && defined('ASSETS_URL')) {
            $assetsUrl = ASSETS_URL;
            $testAssets = [
                'CSS' => $assetsUrl . '/css/style.css',
                'JS' => $assetsUrl . '/js/app.js',
                'Images' => $assetsUrl . '/images/logo.png',
            ];
            
            echo "<p><strong>ASSETS_URL:</strong> <code>" . htmlspecialchars($assetsUrl) . "</code></p>";
            echo "<table>";
            foreach ($testAssets as $type => $url) {
                $fullPath = $_SERVER['DOCUMENT_ROOT'] . $url;
                $exists = file_exists($fullPath);
                echo "<tr>";
                echo "<th>" . htmlspecialchars($type) . "</th>";
                echo "<td><code>" . htmlspecialchars($url) . "</code></td>";
                echo "<td><code>" . htmlspecialchars($fullPath) . "</code></td>";
                echo "<td>" . ($exists ? "<span class='success'>✓ Exists</span>" : "<span class='error'>✗ Missing</span>") . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>6. URL Access Test</h2>
        <p>Test these URLs in your browser:</p>
        <ul>
            <li><a href="index.php" target="_blank">index.php</a></li>
            <li><a href="index.php?page=dashboard" target="_blank">index.php?page=dashboard</a></li>
            <?php if ($configLoaded && defined('ASSETS_URL')): ?>
            <li><a href="<?php echo ASSETS_URL; ?>/css/style.css" target="_blank">CSS File</a></li>
            <?php endif; ?>
        </ul>
    </div>
    
    <div class="section">
        <h2>7. Recommendations</h2>
        <?php
        $recommendations = [];
        
        if (!$configLoaded) {
            $recommendations[] = "<span class='error'>✗ config.php not found or not loading</span>";
        }
        
        if (empty($_SERVER['DOCUMENT_ROOT'])) {
            $recommendations[] = "<span class='error'>✗ DOCUMENT_ROOT not set</span>";
        }
        
        if ($configLoaded && defined('LARAGON_ROOT')) {
            if (!is_dir(LARAGON_ROOT)) {
                $recommendations[] = "<span class='error'>✗ Laragon root path doesn't exist: " . htmlspecialchars(LARAGON_ROOT) . "</span>";
            }
        }
        
        if (empty($recommendations)) {
            echo "<p class='success'>✓ All basic checks passed!</p>";
        } else {
            echo "<ul>";
            foreach ($recommendations as $rec) {
                echo "<li>" . $rec . "</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>
    
    <div class="section">
        <h2>8. Raw Server Variables</h2>
        <pre><?php print_r($_SERVER); ?></pre>
    </div>
    
</body>
</html>

