<?php
/**
 * Test routing - temporary file for debugging
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Routing Test</h1>";
echo "<p>GET parameters: ";
print_r($_GET);
echo "</p>";

$page = $_GET['page'] ?? '';
echo "<p>Page parameter: " . htmlspecialchars($page) . "</p>";

$pageFile = __DIR__ . '/pages/projects.php';
echo "<p>Page file path: " . htmlspecialchars($pageFile) . "</p>";
echo "<p>File exists: " . (file_exists($pageFile) ? 'YES' : 'NO') . "</p>";
echo "<p>File readable: " . (is_readable($pageFile) ? 'YES' : 'NO') . "</p>";

if (file_exists($pageFile)) {
    echo "<h2>First 20 lines of projects.php:</h2>";
    $lines = file($pageFile);
    echo "<pre>";
    foreach (array_slice($lines, 0, 20) as $i => $line) {
        echo ($i + 1) . ": " . htmlspecialchars($line);
    }
    echo "</pre>";
}

echo "<h2>Server Info:</h2>";
echo "<p>SCRIPT_NAME: " . htmlspecialchars($_SERVER['SCRIPT_NAME'] ?? 'not set') . "</p>";
echo "<p>REQUEST_URI: " . htmlspecialchars($_SERVER['REQUEST_URI'] ?? 'not set') . "</p>";
echo "<p>QUERY_STRING: " . htmlspecialchars($_SERVER['QUERY_STRING'] ?? 'not set') . "</p>";
?>

