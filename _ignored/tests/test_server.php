<?php
/**
 * Quick test to verify server is running
 */
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server Test - Port 8080</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .success { background: #51cf66; color: white; padding: 20px; border-radius: 5px; margin: 10px 0; }
        .info { background: #4dabf7; color: white; padding: 15px; border-radius: 5px; margin: 10px 0; }
        code { background: rgba(0,0,0,0.1); padding: 2px 6px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="success">
        <h1>✅ PHP Server is Running on Port 8080!</h1>
        <p>Server is active and responding.</p>
    </div>
    
    <div class="info">
        <h2>Access Dashboard:</h2>
        <ul>
            <li><a href="index.php" style="color: white; text-decoration: underline;">Dashboard Home</a></li>
            <li><a href="index.php?page=projects" style="color: white; text-decoration: underline;">Projects Page</a></li>
            <li><a href="diagnostic.php" style="color: white; text-decoration: underline;">Diagnostic Tool</a></li>
        </ul>
    </div>
    
    <div class="info">
        <h2>Server Information:</h2>
        <p><strong>PHP Version:</strong> <?php echo PHP_VERSION; ?></p>
        <p><strong>Server:</strong> PHP Built-in Development Server</p>
        <p><strong>Port:</strong> 8080</p>
        <p><strong>Document Root:</strong> <code><?php echo __DIR__; ?></code></p>
        <p><strong>Current Script:</strong> <code><?php echo $_SERVER['SCRIPT_NAME']; ?></code></p>
    </div>
    
    <div class="info">
        <h2>Debug Banner:</h2>
        <p>The debug banner should appear when you access the dashboard (if APP_DEBUG is true).</p>
        <p>It will show CSS loading status, paths, and Service Worker information.</p>
    </div>
</body>
</html>

