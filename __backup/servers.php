<?php
/**
 * Application: Laragon | Servers Page Router
 * Description: Routes to the servers page in pages/
 * Version: 2.6.1
 */

// Load servers page from pages/
$serversPage = __DIR__ . '/pages/servers.php';

if (file_exists($serversPage)) {
    require_once $serversPage;
} else {
    // Fallback error page
    http_response_code(500);
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Laragon Dashboard - Error</title></head><body>';
    echo '<div style="padding:20px;color:red;">';
    echo '<strong>Error:</strong> Could not load servers page<br>';
    echo 'Expected path: ' . htmlspecialchars($serversPage) . '<br>';
    echo 'File exists: ' . (file_exists($serversPage) ? 'YES' : 'NO') . '<br>';
    echo '</div>';
    echo '</body></html>';
}

