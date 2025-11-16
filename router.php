<?php
/**
 * Router for PHP Built-in Development Server
 * This ensures static files (CSS, JS, images) are served correctly
 */

$requestUri = $_SERVER['REQUEST_URI'] ?? '';
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Handle favicon.ico requests - browsers automatically request /favicon.ico
if ($requestPath === '/favicon.ico' || $requestPath === 'favicon.ico') {
    $faviconPath = __DIR__ . '/assets/images/favicon/favicon.ico';
    if (file_exists($faviconPath)) {
        header('Content-Type: image/x-icon');
        readfile($faviconPath);
        return true;
    }
    // Fallback to root favicon if exists
    $faviconPath = __DIR__ . '/assets/images/favicon.ico';
    if (file_exists($faviconPath)) {
        header('Content-Type: image/x-icon');
        readfile($faviconPath);
        return true;
    }
    // Return 204 No Content if favicon doesn't exist (prevents 404 spam)
    http_response_code(204);
    return true;
}

// Remove leading slash
$filePath = ltrim($requestPath, '/');

// If the file exists, serve it directly
if ($filePath && file_exists(__DIR__ . '/' . $filePath) && is_file(__DIR__ . '/' . $filePath)) {
    // Serve static files
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'eot' => 'application/vnd.ms-fontobject',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'html' => 'text/html',
        'txt' => 'text/plain',
    ];
    
    $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $mimeType = $mimeTypes[$ext] ?? 'application/octet-stream';
    
    header('Content-Type: ' . $mimeType);
    readfile(__DIR__ . '/' . $filePath);
    return true;
}

// For PHP files and routing, let index.php handle it
if (preg_match('/\.php$/', $filePath) || empty($filePath) || $filePath === 'index.php') {
    // Route to index.php
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    $_SERVER['PHP_SELF'] = '/index.php';
    include __DIR__ . '/index.php';
    return true;
}

// If it's a directory request, try index.php in that directory
if (is_dir(__DIR__ . '/' . $filePath)) {
    if (file_exists(__DIR__ . '/' . $filePath . '/index.php')) {
        include __DIR__ . '/' . $filePath . '/index.php';
        return true;
    }
}

// 404 - file not found
http_response_code(404);
echo "File not found: " . htmlspecialchars($requestPath);
return false;

