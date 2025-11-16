<?php
/**
 * Clear PHP Opcache - Temporary utility
 * Access this file once to clear opcache, then delete it
 */

if (function_exists('opcache_reset')) {
    opcache_reset();
    echo "<h1>PHP Opcache Cleared</h1>";
    echo "<p>Opcache has been reset. You can now delete this file.</p>";
    echo "<p><a href='index.php?page=projects'>Test Projects Page</a></p>";
} else {
    echo "<h1>Opcache Not Available</h1>";
    echo "<p>Opcache is not enabled or not available. Try restarting Apache/Laragon instead.</p>";
}

// Also clear any other caches
if (function_exists('apc_clear_cache')) {
    apc_clear_cache();
    echo "<p>APC cache cleared.</p>";
}

echo "<hr>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>Restart Apache/Laragon to ensure all caches are cleared</li>";
echo "<li>Try accessing: <a href='index.php?page=projects'>index.php?page=projects</a></li>";
echo "<li>Delete this file (clear_cache.php) after use</li>";
echo "</ol>";
?>

