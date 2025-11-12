<?php
/**
 * Application: Laragon | Server Index Page
 * Description: This is the main index page for the Laragon server, displaying server info, server vitals, sendmail
 * mailbox, and applications.
 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
 * Improved CakePHP and Joomla detection
 *
 * Contributors:
 * - @LrkDev in v.2.1.2
 * - @luisAntonioLAGS in v.2.2.1 Spanish
 * - @martic in 2.3.5 Dynamic Hostname Detection
 *
 * Version: 2.5.0
 */

// Load configuration first
require_once __DIR__ . '/Laragon-Dashboard/config.php';

// Include required helpers
require_once __DIR__ . '/Laragon-Dashboard/includes/logger.php';
require_once __DIR__ . '/Laragon-Dashboard/includes/security.php';
require_once __DIR__ . '/Laragon-Dashboard/includes/database.php';
require_once __DIR__ . '/Laragon-Dashboard/includes/cache.php';

// Performance monitoring
$startTime = microtime(true);
$startMemory = memory_get_usage(true);

// Log dashboard access
DashboardLogger::info("Dashboard page accessed", [
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
]);

// Load language files
function loadLanguage($lang)
{
    $allowedLangs = ['en', 'de', 'es', 'fr', 'id', 'pt', 'tl'];
    if (!in_array($lang, $allowedLangs, true)) {
        $lang = 'en';
    }

    $langFile = __DIR__ . "/Laragon-Dashboard/assets/languages/{$lang}.json";
    if (file_exists($langFile)) {
        return json_decode(file_get_contents($langFile), true);
    }

    return [];
}

// Detect language preference (default to English) and sanitize input
$lang = isset($_GET['lang']) ? strtolower($_GET['lang']) : 'en';
$translations = loadLanguage($lang);

const SERVER_TYPES = [
    'php' => 'php',
    'apache' => 'apache',
];

// Display server status
function showServerStatus(): void
{
    echo '<div class="server-status-container">';
    echo '<strong><p class="status-title">Server Status</p></strong>';
    
    // Display server uptime
    $uptime = shell_exec('wmic os get lastbootuptime /value');
    echo '<strong><p>Uptime</p></strong><p>' . htmlspecialchars($uptime) . '</p>';

    // Display memory usage
    $memoryInfo = shell_exec('wmic computersystem get TotalPhysicalMemory /value');
    echo '<strong><p>Memory Usage</p></strong><pre>' . htmlspecialchars($memoryInfo) . '</pre>';

    // Display disk usage
    $diskInfo = shell_exec('wmic logicaldisk get size,freespace,caption /value');
    echo '<strong><p>Disk Usage</p></strong><pre>' . htmlspecialchars($diskInfo) . '</pre>';
    echo '</div>';
}

// Handle incoming query parameters
// SECURITY: These endpoints expose sensitive information and should only be available in debug mode
function handleQueryParameter(string $param): void
{
    // Only allow debug endpoints if APP_DEBUG is enabled
    if (!defined('APP_DEBUG') || !APP_DEBUG) {
        http_response_code(403);
        die('Access denied. Debug endpoints are disabled.');
    }
    
    switch ($param) {
        case 'info':
            phpinfo();
            exit;
        case 'status':
            showServerStatus();
            exit;
        default:
            throw new InvalidArgumentException("Unsupported parameter: " . htmlspecialchars($param));
    }
}

// SECURITY: Disable debug query parameters in production
if (isset($_GET['q']) && (defined('APP_DEBUG') && APP_DEBUG)) {
    $queryParam = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
    try {
        handleQueryParameter($queryParam);
    } catch (InvalidArgumentException $e) {
        http_response_code(400);
        echo 'Error: ' . htmlspecialchars($e->getMessage());
        exit;
    }
}

// Constants for clarity
const SERVER_PHP = 'php';
const SERVER_APACHE = 'apache';
const SERVER_NGINX = 'nginx';

// Retrieve server extensions
function getServerExtensions(string $server, int $columns = 2): array
{
    switch ($server) {
        case SERVER_PHP:
            $extensions = get_loaded_extensions();
            break;
        case SERVER_APACHE:
            if (function_exists('apache_get_modules')) {
                $extensions = apache_get_modules();
            } else {
                throw new Exception('Apache modules are not available on this server.');
            }
            break;
        default:
            throw new InvalidArgumentException('Invalid server name: ' . htmlspecialchars($server));
    }

    sort($extensions, SORT_STRING);
    return array_chunk($extensions, $columns);
}

// Fetch PHP version
function getPhpVersion(): array
{
    $url = 'https://www.php.net/releases/index.php?json&version=7';
    $options = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ];
    $json = file_get_contents($url, false, stream_context_create($options));
    if ($json === false) {
        throw new Exception("Unable to retrieve PHP version info from the official PHP site.");
    }

    $data = json_decode($json, true);
    if ($data === null || !isset($data['version'])) {
        throw new Exception("Invalid JSON or 'version' missing in the data.");
    }

    $lastVersion = $data['version'];
    $currentVersion = phpversion();

    return [
        'lastVersion' => htmlspecialchars($lastVersion),
        'currentVersion' => htmlspecialchars($currentVersion),
        'isUpToDate' => version_compare($currentVersion, $lastVersion, '>='),
    ];
}

// Gather server information
function serverInfo(): array
{
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown Server Software';
    $serverParts = explode(' ', $serverSoftware);

    $httpdVer = $serverParts[0] ?? 'Unknown';
    $openSslVer = isset($serverParts[2]) && strpos($serverParts[2], 'OpenSSL/') === 0 ? substr($serverParts[2], 8) : 'Not available';

    $phpInfo = getPhpVersion();
    $xdebugVersion = extension_loaded('xdebug') ? phpversion('xdebug') : 'Not installed';

    // Determine web server
    $webServer = 'Unknown';
    if (stripos($serverSoftware, 'apache') !== false) {
        $webServer = 'Apache';
    } elseif (stripos($serverSoftware, 'nginx') !== false) {
        $webServer = 'Nginx';
    } elseif (stripos($serverSoftware, 'litespeed') !== false) {
        $webServer = 'LiteSpeed';
    }

    // Determine PHP SAPI
    $phpSapi = php_sapi_name();
    $isFpm = (strpos($phpSapi, 'fpm') !== false);

    // SECURITY: Only expose full document root path in debug mode
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '/var/www/html';
    $docRootDisplay = (defined('APP_DEBUG') && APP_DEBUG) 
        ? $docRoot 
        : basename($docRoot);
    
    return [
        'httpdVer' => htmlspecialchars($httpdVer),
        'openSsl' => htmlspecialchars($openSslVer),
        'phpVer' => htmlspecialchars($phpInfo['currentVersion']),
        'xDebug' => htmlspecialchars($xdebugVersion),
        'docRoot' => htmlspecialchars($docRootDisplay),
        'serverName' => htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'localhost'),
        'webServer' => htmlspecialchars($webServer),
        'phpSapi' => htmlspecialchars($phpSapi),
        'isFpm' => $isFpm,
    ];
}

// Retrieve MySQL version
function getSQLVersion(): string
{
    $output = shell_exec('mysql -V');
    if ($output === null) {
        return "Unknown";
    }

    if (preg_match('@[0-9]+\.[0-9]+\.[0-9-\w]+@', $output, $version)) {
        return htmlspecialchars($version[0]);
    }

    return "Unknown";
}

// Generate PHP download and changelog links
function phpDlLink(string $version, string $branch = '7', string $architecture = 'x64'): array
{
    $versionEscaped = htmlspecialchars($version, ENT_QUOTES, 'UTF-8');
    $branchEscaped = htmlspecialchars($branch, ENT_QUOTES, 'UTF-8');
    $architectureEscaped = htmlspecialchars($architecture, ENT_QUOTES, 'UTF-8');

    return [
        'changeLog' => "https://www.php.net/ChangeLog-$branchEscaped.php#$versionEscaped",
        'downLink' => "https://windows.php.net/downloads/releases/php-$versionEscaped-Win32-VC15-$architectureEscaped.zip",
    ];
}

// Determine site directory
function getSiteDir(): string
{
    $drive = strtoupper(substr(PHP_OS, 0, 1));
    $rootDir = $drive . ':/laragon/etc/apache2/sites-enabled';

    if (strpos(strtolower($rootDir), 'c:') !== false) {
        $laragonDir = str_replace('D:', 'C:', $rootDir);
    } else {
        $laragonDir = $rootDir;
    }

    if ($laragonDir === false) {
        throw new RuntimeException("Unable to determine the Laragon directory.");
    }

    if (!isset($_SERVER['SERVER_SOFTWARE']) || trim($_SERVER['SERVER_SOFTWARE']) === '') {
        throw new InvalidArgumentException("Server software is not defined in the server environment.");
    }

    $serverSoftware = strtolower($_SERVER['SERVER_SOFTWARE']);

    if (strpos($serverSoftware, 'apache') !== false) {
        return $laragonDir;
    } elseif (strpos($serverSoftware, 'nginx') !== false) {
        return $laragonDir;
    }

    throw new InvalidArgumentException("Unsupported server type: " . htmlspecialchars($serverSoftware));
}

// Check for WordPress updates
function checkWordPressUpdates($wpPath)
{
    $command = "cd $wpPath && wp core check-update --format=json";
    $output = shell_exec($command);

    if ($output) {
        $updates = json_decode($output, true);
        if (!empty($updates)) {
            return true;
        }
    }
    return false;
}

// Fetch local sites configuration
function getLocalSites($server = 'apache', $ignoredFiles = ['.', '..', '00-default.conf']): array
{
    try {
        $sitesDir = getSiteDir();
        $files = scandir($sitesDir);
        if ($files === false) {
            throw new Exception("Failed to scan directory: " . htmlspecialchars($sitesDir));
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }

    $scanDir = array_diff($files, $ignoredFiles);
    $sites = [];

    foreach ($scanDir as $filename) {
        $path = realpath("$sitesDir/$filename");
        if ($path === false || !is_file($path)) {
            continue;
        }

        $config = file_get_contents($path);
        if ($config === false) {
            continue;
        }

        if (
            preg_match('/^\s*ServerName\s+(.+)$/m', $config, $domainMatches) &&
            preg_match('/^\s*DocumentRoot\s+(.+)$/m', $config, $documentRootMatches)
        ) {
            $site = [
                'filename' => htmlspecialchars($filename),
                'path' => htmlspecialchars($path),
                'domain' => htmlspecialchars(str_replace(['auto.', '.conf'], '', $domainMatches[1])),
                'documentRoot' => htmlspecialchars($documentRootMatches[1]),
            ];

            if (file_exists($documentRootMatches[1] . '/wp-admin')) {
                $site['framework'] = 'WordPress';
                $site['hasUpdates'] = checkWordPressUpdates($documentRootMatches[1]);
            } elseif (file_exists($documentRootMatches[1] . '/app.py')) {
                $site['framework'] = 'Flask';
            } elseif (file_exists($documentRootMatches[1] . '/package.json')) {
                $site['framework'] = 'Node.js';
            } else {
                $site['framework'] = 'Unknown';
            }

            $sites[] = $site;
        }
    }

    return $sites;
}

// Render HTML links for local sites
function renderLinks(): string
{
    ob_start();
    $sites = getLocalSites();

    foreach ($sites as $site) {
        $httpLink = "http://" . htmlspecialchars($site['domain'], ENT_QUOTES, 'UTF-8');
        $httpsLink = "https://" . htmlspecialchars($site['domain'], ENT_QUOTES, 'UTF-8');

        echo "<div class='row w800 my-2'>";
        echo "<div class='col-md-5 text-truncate tr'><a href='" . $httpLink . "'>" . $httpLink . "</a></div>";
        echo "<div class='col-2 arrows'>&xlArr; &sext; &xrArr;</div>";
        echo "<div class='col-md-5 text-truncate tl'><a href='" . $httpsLink . "'>" . $httpsLink . "</a></div>";

        if ($site['framework'] !== 'Unknown') {
            echo "<div class='col-12'>";
            if ($site['framework'] === 'WordPress' && $site['hasUpdates']) {
                echo "<span class='badge bg-danger'>Update Available</span>";
            }
            echo "<a href='?controlApp&appPath=" . urlencode($site['documentRoot']) . "&framework=" . urlencode($site['framework']) . "&action=start' class='btn btn-success'>Start " . htmlspecialchars($site['framework']) . "</a>";
            echo "<a href='?controlApp&appPath=" . urlencode($site['documentRoot']) . "&framework=" . urlencode($site['framework']) . "&action=stop' class='btn btn-danger'>Stop " . htmlspecialchars($site['framework']) . "</a>";
            echo "</div>";
        }

        echo "</div><hr>";
    }

    return ob_get_clean();
}

$rootPath = realpath(dirname(__DIR__));
$folders = array_filter(glob($rootPath . '/*'), 'is_dir');
$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];

foreach ($folders as $folderPath) {
    $host = basename($folderPath);
    if (in_array($host, $ignore_dirs)) {
        continue;
    }
}

$activeTab = $_GET['tab'] ?? 'servers';

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="Laragon-Dashboard/assets/favicon.ico">
    <title><?php echo $translations['title'] ?? 'Welcome to the Laragon Dashboard'; ?></title>

    <!-- Local Google Fonts -->
    <link rel="stylesheet" href="Laragon-Dashboard/assets/libs/fonts/google-fonts.css">
    <link rel="stylesheet" href="Laragon-Dashboard/assets/style.css">

    <!-- Local Bootstrap -->
    <link rel="stylesheet" href="Laragon-Dashboard/assets/libs/bootstrap/bootstrap.min.css">

    <!-- Local Font Awesome -->
    <link rel="stylesheet" href="Laragon-Dashboard/assets/libs/fontawesome/all.min.css" />
    <link rel="stylesheet" href="Laragon-Dashboard/assets/libs/fontawesome/brands.min.css" />

    <!-- Local jQuery -->
    <script src="Laragon-Dashboard/assets/libs/jquery/jquery-3.7.1.min.js"></script>
    <!-- Local Bootstrap JS -->
    <script src="Laragon-Dashboard/assets/libs/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- Local Chart.js -->
    <script src="Laragon-Dashboard/assets/libs/chartjs/chart.umd.min.js"></script>
    <!-- Local Iconify -->
    <script src="Laragon-Dashboard/assets/libs/iconify/iconify.min.js"></script>

    <link rel="icon" href="Laragon-Dashboard/assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="Laragon-Dashboard/assets/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="Laragon-Dashboard/assets/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="Laragon-Dashboard/assets/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="Laragon-Dashboard/assets/favicon/android-chrome-512x512.png" sizes="512x512">
    <link rel="icon" type="apple-touch-icon" href="Laragon-Dashboard/assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="Laragon-Dashboard/assets/favicon/site.webmanifest">

    <script>
    $(document).ready(function() {
        $('.tab').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('.tab').removeClass('active');
            $('.tab-content').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
            
            // Hide servers container when other tabs are active
            if (tab_id !== 'servers') {
                $('#servers .container-fluid').hide();
            } else {
                $('#servers .container-fluid').show();
            }
        });

        $('#language-selector').change(function() {
            var lang = $(this).val();
            window.location.href = "?lang=" + lang;
        });

        $('#project-search').on('input', function() {
            var q = $(this).val();
            $.get('Laragon-Dashboard/project_search.php', {q: q}, function(data) {
                $('#project-list').html(data);
            });
        });
    });

    function fetchServerVitals() {
        $.ajax({
            url: 'Laragon-Dashboard/server_vitals.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    console.error('Error fetching server vitals:', data.error);
                    return;
                }
                
                $('#uptime').text(data.uptime);
                $('#memory-usage').text(data.memoryUsage);
                $('#php-memory').text('Current: ' + formatBytes(data.phpMemory.current) + ' | Peak: ' + formatBytes(data.phpMemory.peak) + ' | Limit: ' + data.phpMemory.limit);
                
                // Format disk usage
                let diskInfo = '';
                if (data.diskUsage && data.diskUsage.length > 0) {
                    data.diskUsage.forEach(function(disk) {
                        if (disk.caption && disk.size && disk.freespace) {
                            const used = disk.size - disk.freespace;
                            const percent = Math.round((used / disk.size) * 100);
                            diskInfo += disk.caption + ': ' + percent + '% used (' + formatBytes(used) + ' / ' + formatBytes(disk.size) + ')\n';
                        }
                    });
                }
                $('#disk-usage').text(diskInfo || 'No disk information available');

                // Update charts
                if (uptimeChart && data.uptimeLabels && data.uptimeData) {
                    uptimeChart.data.labels = data.uptimeLabels;
                    uptimeChart.data.datasets[0].data = data.uptimeData;
                    uptimeChart.update();
                }

                if (memoryUsageChart && data.memoryUsageLabels && data.memoryUsageData) {
                    memoryUsageChart.data.labels = data.memoryUsageLabels;
                    memoryUsageChart.data.datasets[0].data = data.memoryUsageData;
                    memoryUsageChart.update();
                }

                if (diskUsageChart && data.diskUsageLabels && data.diskUsageData) {
                    diskUsageChart.data.labels = data.diskUsageLabels;
                    diskUsageChart.data.datasets[0].data = data.diskUsageData;
                    diskUsageChart.update();
                }
                
                if (phpMemoryChart && data.phpMemory) {
                    const currentMB = Math.round(data.phpMemory.current / (1024 * 1024));
                    const peakMB = Math.round(data.phpMemory.peak / (1024 * 1024));
                    phpMemoryChart.data.datasets[0].data = [currentMB, peakMB];
                    phpMemoryChart.update();
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                $('#uptime').text('Error loading uptime');
                $('#memory-usage').text('Error loading memory usage');
                $('#disk-usage').text('Error loading disk usage');
                $('#php-memory').text('Error loading PHP memory');
            }
        });
    }
    
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Fetch server vitals every 5 seconds
    setInterval(fetchServerVitals, 5000);
    fetchServerVitals();
    </script>
    <style>
    /* Scrollbar CSS */
    /* Custom Scrollbar - Magenta/Pink Theme */
    *::-webkit-scrollbar {
        width: 12px;
        height: 12px;
    }

    *::-webkit-scrollbar-track {
        background: rgba(11, 22, 44, 0.8);
        border-radius: 10px;
    }

    *::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #e91e63 0%, #f06292 50%, #ec407a 100%);
        border-radius: 10px;
        border: 2px solid rgba(11, 22, 44, 0.8);
        transition: background 0.3s ease;
    }

    *::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #c2185b 0%, #e91e63 50%, #d81b60 100%);
    }

    *::-webkit-scrollbar-corner {
        background: rgba(11, 22, 44, 0.8);
    }

    /* Firefox Scrollbar */
    * {
        scrollbar-width: thin;
        scrollbar-color: #e91e63 rgba(11, 22, 44, 0.8);
    }

    /* Smooth scrolling */
    html {
        scroll-behavior: smooth;
    }

    .grid-container {
        grid-area: main;
        background: url(Laragon-Dashboard/assets/background2.jpg) no-repeat center center fixed;
        background-size: cover;
        display: flex;
        flex-direction: column;
        min-height: calc(100vh - 120px);
    }

    nav {
        grid-area: nav;
        align-items: start;
        justify-content: space-between;
        padding: 0 20px;
        background-color: #0B162C !important;
        color: #ffffff !important;
        font-family: "Poppins", Sans-serif, serif !important;
    }

    .tab {
        align-items: center;
        background-color: #0A66C2;
        border: 0;
        border-radius: 100px;
        box-sizing: border-box;
        color: #ffffff;
        cursor: pointer;
        display: inline-flex;
        font-family: "Poppins", Sans-serif, serif !important;
        font-size: 16px;
        font-weight: 600;
        justify-content: center;
        line-height: 20px;
        max-width: 480px;
        min-height: 40px;
        min-width: 0;
        overflow: hidden;
        padding: 0 20px;
        text-align: center;
        touch-action: manipulation;
        transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
        user-select: none;
        -webkit-user-select: none;
        vertical-align: middle;
    }

    .tab:hover,
    .tab:focus {
        background-color: #16437E;
        color: #ffffff;
    }

    .tab:disabled {
        cursor: not-allowed;
        background: rgba(0, 0, 0, .08);
        color: rgba(0, 0, 0, .3);
    }

    .tab.active {
        background: #09223b;
        color: rgb(255, 255, 255, .7);
    }

    .tab-content {
        display: none;
        flex: 1;
        flex-direction: column;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .tab-content.active {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    /* Hide servers container when other tabs are active */
    #servers .container-fluid:not(:first-of-type) {
        display: none;
    }

    .tab-content:not(#servers).active ~ #servers .container-fluid,
    .tab-content.active:not(#servers) ~ #servers {
        display: none !important;
    }

    select#language-selector {
        background-color: #fff;
        padding: 5px;
        border-radius: 25px;
        border: 1px solid #ccc;
    }

    .main-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
        grid-auto-rows: 71px;
        grid-gap: 20px;
        margin: 10px;
    }

    .wrapper {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    /* Bootstrap row gap utility for card layouts */
    .row.g-2 {
        --bs-gutter-x: 0.5rem;
        --bs-gutter-y: 0.5rem;
    }

    .overviewcard {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background-color: #00adef;
        font-family: "Rubik", Sans-serif, serif;
        border-radius: 5px 5px;
        font-size: 16px;
        color: #FFFFFF !important;
        line-height: 1;
        height: 31px;
    }

    .overviewcard_sites {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background-color: #023e8a;
        font-family: "Rubik", Sans-serif, serif;
        border-radius: 5px 5px;
        font-size: 16px;
        color: #FFFFFF !important;
        line-height: 1;
        height: 31px;
    }

    .overviewcard_info {
        font-family: "Rubik", Sans-serif, serif;
        text-transform: uppercase;
        font-size: 16px !important;
        color: #FFFFFF !important;
    }

    .overviewcard_icon {
        font-family: "Rubik", Sans-serif, serif;
        text-transform: uppercase;
        font-size: 16px !important;
        color: #FFFFFF !important;
    }

    .overviewcard4 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        background-color: #031A24;
        font-family: "Rubik", Sans-serif, serif;
        border-radius: 5px 5px;
        font-size: 16px;
        color: #FFFFFF !important;
        line-height: 1;
        height: 31px;
    }

    .project-search-card {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 15px 20px;
        background-color: #ffffff;
        border-radius: 10px;
        font-family: "Rubik", Sans-serif, serif;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .project-search-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .project-search-card i {
        font-size: 18px;
        color: #666;
        flex-shrink: 0;
    }

    .project-search-card input {
        background: transparent;
        border: none;
        outline: none;
        color: #333 !important;
        font-family: "Rubik", Sans-serif, serif;
        font-size: 16px;
        width: 100%;
        padding: 0;
        margin-left: 10px;
    }

    .project-search-card input::placeholder {
        color: rgba(102, 102, 102, 0.6) !important;
    }

    .main-cards {
        column-count: 0;
        column-gap: 20px;
        margin: 20px;
    }

    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        background-color: #f1faee;
        margin-bottom: 20px;
        -webkit-column-break-inside: avoid;
        padding: 24px;
        box-sizing: border-box;
    }

    .card:first-child {
        height: 300px;
    }

    .card:nth-child(2) {
        height: 200px;
    }

    .card:nth-child(3) {
        height: 265px;
    }

    .saturate {
        filter: saturate(3);
    }

    .grayscale {
        filter: grayscale(100%);
    }

    .contrast {
        filter: contrast(160%);
    }

    .brightness {
        filter: brightness(0.25);
    }

    .blur {
        filter: blur(3px);
    }

    .invert {
        filter: invert(100%);
    }

    .sepia {
        filter: sepia(100%);
    }

    .huerotate {
        filter: hue-rotate(180deg);
    }

    .rss.opacity {
        filter: opacity(50%);
    }

    .sites {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(275px, 1fr));
        grid-gap: 20px;
        margin: 20px;
    }

    .sites li {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        background: #560bad;
        color: #ffffff;
        font-family: 'Rubik', sans-serif;
        font-size: 14px;
        text-align: left;
        text-transform: uppercase;
        margin-bottom: 20px;
        -webkit-column-break-inside: avoid;
        padding: 24px;
        box-sizing: border-box;
    }

    .sites li:hover {
        box-shadow: 0 0 15px 0 #bbb;
    }

    .sites li:hover svg {
        fill: #ffffff;
    }

    .sites li:hover a {
        color: #ffffff;
    }

    .sites li a {
        display: block;
        padding-left: 48px;
        color: #f2f2f2;
        transition: color 250ms ease-in-out;
    }

    .sites img {
        position: absolute;
        margin: 8px 8px 8px -40px;
        fill: #f2f2f2;
        transition: fill 250ms ease-in-out;
    }

    .sites svg {
        position: absolute;
        margin: 16px 16px 16px -40px;
        fill: #f2f2f2;
        transition: fill 250ms ease-in-out;
    }

    .footer {
        grid-area: footer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 16px;
        background-color: #0b162c;
        color: #ffffff;
        margin-top: auto;
        position: sticky;
        bottom: 0;
        z-index: 100;
        width: 100%;
    }

    @media (max-width: 600px) {
        .menu-icon {
            font-size: 30px;
        }

        .sidenav {
            display: none;
        }

        .sidenav.active {
            display: block;
        }
    }

    @media (min-width: 601px) {
        .menu-icon {
            font-size: 40px;
        }

        .sidenav {
            display: block;
        }
    }
    </style>
</head>

<body>
    <header class="header">
        <h4><?php echo $translations['header'] ?? 'Header'; ?></h4>

        <?php
$currentTime = new DateTime();
$hours = $currentTime->format('H');

if ($hours < 12) {
    $greeting = $translations['good_morning'] ?? 'Good morning';
} elseif ($hours < 18) {
    $greeting = $translations['good_afternoon'] ?? 'Good afternoon';
} else {
    $greeting = $translations['good_evening'] ?? 'Good evening';
}

echo "<h4>" . $greeting . "!</h4>";
?>

        <div>
            <select id="language-selector">
                <?php
$langFiles = glob(__DIR__ . "/Laragon-Dashboard/assets/languages/*.json");
foreach ($langFiles as $file) {
    $langCode = basename($file, ".json");
    $selected = $lang === $langCode ? "selected" : "";
    echo "<option value='$langCode' $selected>$langCode</option>";
}
?>
            </select>
        </div>
    </header>
    <nav>
        <div class="tab <?php echo $activeTab === 'servers' ? 'active' : ''; ?>" data-tab="servers"><?php echo $translations['servers_tab'] ?? 'Servers'; ?></div>
        <div class="tab <?php echo $activeTab === 'mailbox' ? 'active' : ''; ?>" data-tab="mailbox"><?php echo $translations['inbox_tab'] ?? 'Mailbox'; ?></div>
        <div class="tab <?php echo $activeTab === 'vitals' ? 'active' : ''; ?>" data-tab="vitals"><?php echo $translations['vitals_tab'] ?? 'Server Vitals'; ?></div>
        <div class="tab <?php echo $activeTab === 'databases' ? 'active' : ''; ?>" data-tab="databases"><?php echo $translations['databases_tab'] ?? 'Databases'; ?></div>
        <div class="tab <?php echo $activeTab === 'services' ? 'active' : ''; ?>" data-tab="services"><?php echo $translations['services_tab'] ?? 'Services'; ?></div>
        <div class="tab <?php echo $activeTab === 'logs' ? 'active' : ''; ?>" data-tab="logs"><?php echo $translations['logs_tab'] ?? 'Logs'; ?></div>
        <div class="tab <?php echo $activeTab === 'tools' ? 'active' : ''; ?>" data-tab="tools"><?php echo $translations['tools_tab'] ?? 'Tools'; ?></div>
    </nav>

    <div class="grid-container" style="flex: 1; display: flex; flex-direction: column; min-height: calc(100vh - 140px);">

        <div class="tab-content <?php echo $activeTab === 'servers' ? 'active' : ''; ?>" id="servers" style="flex: 1; display: flex; flex-direction: column; overflow-y: auto;">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_servers'] ?? 'My Development Server Servers & Applications'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3">
                <?php 
                $serverInfo = serverInfo();
                // Strip PHP version from SERVER_SOFTWARE
                $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
                $serverSoftware = preg_replace('/\s+PHP\/[0-9.]+/', '', $serverSoftware);
                
                // Get MySQL version
                error_reporting(0);
                $laraconfig = parse_ini_file('../../usr/laragon.ini');
                $mysqlPassword = getenv('MYSQL_PASSWORD') ?: ($laraconfig['MySQLRootPassword'] ?? '');
                $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, $mysqlPassword);
                if (!$link) {
                    $link = mysqli_connect(MYSQL_HOST, MYSQL_USER, '');
                }
                $mysqlVersion = 'MySQL not running!';
                if ($link) {
                    $mysqlVersion = htmlspecialchars(mysqli_get_server_info($link));
                }
                ?>
                <!-- Row 1: Core Server Info -->
                <div class="row g-2 mb-2">
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon"><?php echo $translations['web_server'] ?? 'Web Server'; ?></div>
                            <div class="overviewcard_info"><?php echo $serverInfo['webServer']; ?></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">PHP</div>
                            <div class="overviewcard_info">
                                <?php echo htmlspecialchars(phpversion()); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">MySQL</div>
                            <div class="overviewcard_info">
                                <?php echo $mysqlVersion; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">OpenSSL</div>
                            <div class="overviewcard_info">
                                <?=$serverInfo['openSsl'];?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 2: Server Details -->
                <div class="row g-2 mb-2">
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">PHP <?php echo ($serverInfo['isFpm']) ? 'FPM' : 'SAPI'; ?></div>
                            <div class="overviewcard_info"><?php echo $serverInfo['phpSapi']; ?></div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon"><?php echo $translations['document_root'] ?? 'Document Root'; ?></div>
                            <div class="overviewcard_info">
                                <?php 
                                // SECURITY: Only show full path in debug mode, otherwise show relative path
                                $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
                                if (defined('APP_DEBUG') && APP_DEBUG) {
                                    echo htmlspecialchars($docRoot);
                                } else {
                                    // Show only the last directory name for security
                                    echo htmlspecialchars(basename($docRoot));
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">Host</div>
                            <div class="overviewcard_info">
                                <?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="overviewcard">
                            <div class="overviewcard_icon">PhpMyAdmin</div>
                            <div class="overviewcard_info">
                                <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank">
                                    <?php echo $translations['manage_mysql'] ?? 'Manage MySQL'; ?>
                                </a>
                            </div>
                        </div>
                        <div class="overviewcard mt-2">
                            <div class="overviewcard_icon">Laragon</div>
                            <div class="overviewcard_info">
                                <?php
$laragonVersion = 'Unknown';
// Try to get version from laragon.exe file properties
// Detect Laragon root directory from document root
$docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
$laragonRoot = 'C:/laragon'; // Default fallback

// Try to extract Laragon root from document root (e.g., C:/laragon/www -> C:/laragon)
if (strpos($docRoot, 'laragon') !== false) {
    $parts = explode('laragon', $docRoot);
    if (!empty($parts[0])) {
        $laragonRoot = $parts[0] . 'laragon';
    }
}

$laragonExePath = str_replace('/', DIRECTORY_SEPARATOR, $laragonRoot . '/laragon.exe');

if (file_exists($laragonExePath)) {
    // Use PowerShell to get file version
    $command = 'powershell -Command "(Get-Item \'' . str_replace("'", "''", $laragonExePath) . '\').VersionInfo.FileVersion"';
    $version = shell_exec($command);
    if ($version && trim($version) !== '') {
        // Extract version number (e.g., "8.3.0.1009" -> "8.3.0")
        $versionParts = explode('.', trim($version));
        if (count($versionParts) >= 3) {
            $laragonVersion = $versionParts[0] . '.' . $versionParts[1] . '.' . $versionParts[2];
        } else {
            $laragonVersion = trim($version);
        }
    }
}
// Fallback to ini file if exe method fails
if ($laragonVersion === 'Unknown' && file_exists('../../usr/laragon.ini')) {
    $laraconfig = parse_ini_file('../../usr/laragon.ini');
    $laragonVersion = $laraconfig['Version'] ?? 'Unknown';
}
echo htmlspecialchars($laragonVersion);
?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 3: Search -->
                <div class="row g-2 mb-2">
                    <div class="col-3">
                        <div class="project-search-card">
                            <i class="fas fa-search" style="color: #666; margin-right: 10px;"></i>
                            <input type="text" id="project-search" placeholder="Search projects...">
                        </div>
                    </div>
                    <div class="col-9">
                        <!-- Empty space -->
                    </div>
                </div>
            </div>

            <div class="container-fluid px-3">
                <div id="project-list" class="row g-2">
                <?php
$ignored = ['favicon_io'];
$folders = array_filter(glob('*'), 'is_dir');
sort($folders, SORT_NATURAL | SORT_FLAG_CASE);

if ($laraconfig['SSLEnabled'] == 0 || $laraconfig['Port'] == 80) {
    $url = 'http';
} else {
    $url = 'https';
}
$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets'];
foreach ($folders as $host) {
    if (in_array($host, $ignore_dirs) || !is_dir($host)) {
        continue;
    }

    $admin_link = '';
    $app_name = '';
    $avatar = '';

    switch (true) {
        case (file_exists($host . '/core') || file_exists($host . '/web/core')):
            $app_name = ' Drupal ';
            $avatar = 'Laragon-Dashboard/assets/Drupal.svg';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/user" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'Laragon-Dashboard/assets/Wordpress.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/wp-admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'Laragon-Dashboard/assets/Joomla.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/administrator" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $avatar = 'Laragon-Dashboard/assets/Laravel.png';
            $admin_link = '';
            break;
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'Laragon-Dashboard/assets/Symfony.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $avatar = 'Laragon-Dashboard/assets/Python.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/Public" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Public Folder</a>';

            $command = 'python ' . htmlspecialchars($host) . '/app.py';
            exec($command, $output, $returnStatus);
            break;
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'Laragon-Dashboard/assets/CakePHP.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        default:
            $admin_link = '';
            $avatar = 'Laragon-Dashboard/assets/Unknown.png';
            break;
    }

    echo '<div class="col-3"><div class="overviewcard_sites"><div class="overviewcard_avatar"><img src="' . $avatar . '" style="width:20px; height:20px;"></div><div class="overviewcard_icon"><a href="' . $url . '://' . htmlspecialchars($host) . DOMAIN_SUFFIX . '">' . htmlspecialchars($host) . '</a></div><div class="overviewcard_info">' . $admin_link . '</div></div></div>';
}
?>
            </div>
        </div>

        <div class="tab-content <?php echo $activeTab === 'mailbox' ? 'active' : ''; ?>" id="mailbox">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_mailbox'] ?? 'My Development Server Mailbox'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <?php include 'Laragon-Dashboard/assets/inbox/inbox.php';?>
        </div>

        <div class="tab-content <?php echo $activeTab === 'vitals' ? 'active' : ''; ?>" id="vitals">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_vitals'] ?? 'My Development Server Vitals'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3 py-4">
                <div class="row">
                    <div class="col-12">
                        <strong><p style="text-align: center;color: #fff; font-size: 24px;">Server's Vitals</p></strong>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <strong><p><?php echo $translations['uptime'] ?? 'Uptime'; ?></p></strong>
                        <p id="uptime">Loading...</p>
                        <canvas id="uptimeChart"></canvas>
                    </div>

                    <div class="col-md-6">
                        <strong><p><?php echo $translations['memory_usage'] ?? 'Memory Usage'; ?></p></strong>
                        <p id="memory-usage">Loading...</p>
                        <canvas id="memoryUsageChart"></canvas>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <strong><p><?php echo $translations['disk_usage'] ?? 'Disk Usage'; ?></p></strong>
                        <p id="disk-usage">Loading...</p>
                        <canvas id="diskUsageChart"></canvas>
                    </div>

                    <div class="col-md-6">
                        <strong><p>PHP Memory Usage</p></strong>
                        <p id="php-memory">Loading...</p>
                        <canvas id="phpMemoryChart"></canvas>
                    </div>

                </div>

            </div>
        </div>

        <!-- Databases Tab -->
        <div class="tab-content <?php echo $activeTab === 'databases' ? 'active' : ''; ?>" id="databases">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_databases'] ?? 'My Development Server Databases'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3 py-4">
                <div class="row">
                    <div class="col-12">
                        <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['databases_tab'] ?? 'Databases'; ?></p></strong>
                    </div>
                </div>
                <div id="database-manager">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong><p style="color: #fff;"><?php echo $translations['select_database'] ?? 'Select Database'; ?></p></strong>
                            <select id="database-select" class="form-select">
                                <option value=""><?php echo $translations['loading'] ?? 'Loading...'; ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <strong><p style="color: #fff;"><?php echo $translations['database_size'] ?? 'Database Size'; ?></p></strong>
                            <p id="database-size">-</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <strong><p style="color: #fff;"><?php echo $translations['tables'] ?? 'Tables'; ?></p></strong>
                            <div id="tables-list" class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo $translations['table_name'] ?? 'Table Name'; ?></th>
                                            <th><?php echo $translations['rows'] ?? 'Rows'; ?></th>
                                            <th><?php echo $translations['size'] ?? 'Size'; ?></th>
                                            <th><?php echo $translations['actions'] ?? 'Actions'; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="tables-tbody">
                                        <tr><td colspan="4"><?php echo $translations['select_database_first'] ?? 'Please select a database first'; ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <strong><p style="color: #fff;"><?php echo $translations['run_query'] ?? 'Run Query'; ?></p></strong>
                            <textarea id="query-input" class="form-control" rows="5" placeholder="SELECT * FROM table_name LIMIT 10;"></textarea>
                            <button class="btn btn-primary mt-2" onclick="executeQuery()"><?php echo $translations['execute'] ?? 'Execute'; ?></button>
                            <div id="query-results" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Services Tab -->
        <div class="tab-content <?php echo $activeTab === 'services' ? 'active' : ''; ?>" id="services">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_services'] ?? 'My Development Server Services'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3 py-4">
                <div class="row">
                    <div class="col-12">
                        <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['services_management'] ?? 'Services Management'; ?></p></strong>
                    </div>
                </div>
                <div id="services-list" class="row g-2">
                    <!-- Services will be loaded here -->
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <strong><p style="color: #fff;"><?php echo $translations['port_monitor'] ?? 'Port Monitor'; ?></p></strong>
                        <button class="btn btn-info" onclick="refreshPorts()"><?php echo $translations['refresh_ports'] ?? 'Refresh Ports'; ?></button>
                        <div id="ports-list" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logs Tab -->
        <div class="tab-content <?php echo $activeTab === 'logs' ? 'active' : ''; ?>" id="logs">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_logs'] ?? 'My Development Server Logs'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3 py-4">
                <div class="row">
                    <div class="col-12">
                        <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['log_viewer'] ?? 'Log Viewer'; ?></p></strong>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong><p style="color: #fff;"><?php echo $translations['select_log'] ?? 'Select Log File'; ?></p></strong>
                        <select id="log-select" class="form-select">
                            <option value=""><?php echo $translations['loading'] ?? 'Loading...'; ?></option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <strong><p style="color: #fff;"><?php echo $translations['lines_to_show'] ?? 'Lines to Show'; ?></p></strong>
                        <input type="number" id="log-lines" class="form-control" value="100" min="10" max="1000">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary" onclick="loadLog()"><?php echo $translations['load_log'] ?? 'Load Log'; ?></button>
                        <button class="btn btn-danger" onclick="clearLog()"><?php echo $translations['clear_log'] ?? 'Clear Log'; ?></button>
                        <div id="log-content" class="mt-3" style="background-color: #fff;color: #00ff00;padding: 15px;border-radius: 5px;font-family: monospace;max-height: 600px;overflow-y: auto;">
                            <pre id="log-text"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tools Tab -->
        <div class="tab-content <?php echo $activeTab === 'tools' ? 'active' : ''; ?>" id="tools">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_tools'] ?? 'My Development Server Tools'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container-fluid px-3 py-4">
                <div class="row">
                    <div class="col-12">
                        <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['quick_tools'] ?? 'Quick Tools'; ?></p></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <strong><p style="color: #fff;"><?php echo $translations['cache_management'] ?? 'Cache Management'; ?></p></strong>
                            <button class="btn btn-warning" onclick="clearCache()"><?php echo $translations['clear_cache'] ?? 'Clear Cache'; ?></button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <strong><p style="color: #fff;"><?php echo $translations['database_optimization'] ?? 'Database Optimization'; ?></p></strong>
                            <select id="optimize-db-select" class="form-select mb-2">
                                <option value=""><?php echo $translations['select_database'] ?? 'Select Database'; ?></option>
                            </select>
                            <button class="btn btn-success" onclick="optimizeDatabase()"><?php echo $translations['optimize'] ?? 'Optimize'; ?></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <strong><p style="color: #fff;"><?php echo $translations['project_actions'] ?? 'Project Actions'; ?></p></strong>
                            <select id="project-select" class="form-select mb-2">
                                <option value=""><?php echo $translations['select_project'] ?? 'Select Project'; ?></option>
                            </select>
                            <div class="btn-group-vertical w-100">
                                <button class="btn btn-info mb-2" onclick="gitStatus()"><?php echo $translations['git_status'] ?? 'Git Status'; ?></button>
                                <button class="btn btn-primary mb-2" onclick="composerInstall()"><?php echo $translations['composer_install'] ?? 'Composer Install'; ?></button>
                                <button class="btn btn-secondary mb-2" onclick="npmInstall()"><?php echo $translations['npm_install'] ?? 'NPM Install'; ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <strong><p style="color: #fff;"><?php echo $translations['system_info'] ?? 'System Information'; ?></p></strong>
                            <button class="btn btn-info" onclick="showPhpInfo()"><?php echo $translations['php_info'] ?? 'PHP Info'; ?></button>
                        </div>
                    </div>
                </div>
                <!-- Self-Update Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card p-3">
                            <strong><p style="color: #fff;">🔄 Self-Update (Git)</p></strong>
                            <p class="small" style="color: #fff;">Current Version: <strong><?php echo APP_VERSION; ?></strong></p>
                            <button class="btn btn-primary" onclick="checkForUpdates()">Check for Updates (Git)</button>
                            <div id="update-status" class="mt-2"></div>
                            <div id="update-progress" class="mt-2" style="display: none;">
                                <div class="progress">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                                </div>
                                <p class="small mt-2" id="progress-text">Preparing download...</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tools-output" class="mt-3"></div>
            </div>
        </div>
    </div>

    <script>
    function startServer() {
        alert('Starting server...');
        // Add your server start logic here
    }

    function stopServer() {
        alert('Stopping server...');
        // Add your server stop logic here
    }

    // Database Manager Functions
    $(document).ready(function() {
        loadDatabases();
        loadServices();
        loadLogs();
        loadProjects();
    });

    function loadDatabases() {
        $.get('Laragon-Dashboard/database_manager.php?action=list_databases', function(data) {
            if (data.success) {
                const select = $('#database-select');
                select.empty();
                select.append('<option value="">Select Database</option>');
                data.databases.forEach(function(db) {
                    select.append('<option value="' + db + '">' + db + '</option>');
                });
            }
        });
    }

    $('#database-select').change(function() {
        const db = $(this).val();
        if (db) {
            loadTables(db);
            getDatabaseSize(db);
        }
    });

    function loadTables(database) {
        $.get('Laragon-Dashboard/database_manager.php?action=get_tables&database=' + encodeURIComponent(database), function(data) {
            if (data.success) {
                const tbody = $('#tables-tbody');
                tbody.empty();
                data.tables.forEach(function(table) {
                    const size = formatBytes((table.DATA_LENGTH || 0) + (table.INDEX_LENGTH || 0));
                    tbody.append('<tr><td>' + table.TABLE_NAME + '</td><td>' + (table.TABLE_ROWS || 0) + '</td><td>' + size + '</td><td><button class="btn btn-sm btn-info" onclick="viewTableStructure(\'' + database + '\', \'' + table.TABLE_NAME + '\')">Structure</button></td></tr>');
                });
            }
        });
    }

    function getDatabaseSize(database) {
        $.get('Laragon-Dashboard/database_manager.php?action=get_database_size&database=' + encodeURIComponent(database), function(data) {
            if (data.success) {
                $('#database-size').text(data.size_mb + ' MB');
            }
        });
    }

    function executeQuery() {
        const query = $('#query-input').val();
        if (!query) {
            alert('Please enter a query');
            return;
        }
        $.post('Laragon-Dashboard/database_manager.php?action=execute_query', {query: query}, function(data) {
            if (data.success) {
                let html = '<table class="table table-striped"><thead><tr>';
                if (data.results.length > 0) {
                    Object.keys(data.results[0]).forEach(function(key) {
                        html += '<th>' + key + '</th>';
                    });
                    html += '</tr></thead><tbody>';
                    data.results.forEach(function(row) {
                        html += '<tr>';
                        Object.values(row).forEach(function(val) {
                            html += '<td>' + (val !== null ? val : 'NULL') + '</td>';
                        });
                        html += '</tr>';
                    });
                    html += '</tbody></table>';
                } else {
                    html = '<p>No results</p>';
                }
                $('#query-results').html(html);
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    // Services Manager Functions
    function loadServices() {
        $.get('Laragon-Dashboard/services_manager.php?action=status', function(data) {
            if (data.success) {
                const container = $('#services-list');
                container.empty();
                Object.keys(data.services).forEach(function(service) {
                    const status = data.services[service];
                    const statusClass = status === 'running' ? 'success' : 'danger';
                    const statusText = status === 'running' ? 'Running' : 'Stopped';
                    container.append('<div class="col-3"><div class="card p-3"><strong style="color: #fff;">' + service + '</strong><p style="color: #fff;">Status: <span class="badge bg-' + statusClass + '">' + statusText + '</span></p><div class="btn-group"><button class="btn btn-sm btn-success" onclick="controlService(\'' + service + '\', \'start\')">Start</button><button class="btn btn-sm btn-danger" onclick="controlService(\'' + service + '\', \'stop\')">Stop</button><button class="btn btn-sm btn-warning" onclick="controlService(\'' + service + '\', \'restart\')">Restart</button></div></div></div>');
                });
            }
        });
    }

    function controlService(service, action) {
        if (!confirm('Are you sure you want to ' + action + ' ' + service + '?')) {
            return;
        }
        $.get('Laragon-Dashboard/services_manager.php?action=' + action + '&service=' + encodeURIComponent(service), function(data) {
            if (data.success) {
                alert('Service ' + action + ' command executed');
                loadServices();
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    function refreshPorts() {
        $.get('Laragon-Dashboard/services_manager.php?action=get_ports', function(data) {
            if (data.success) {
                let html = '<table class="table table-striped"><thead><tr><th>Address</th><th>Port</th></tr></thead><tbody>';
                data.ports.forEach(function(port) {
                    html += '<tr><td>' + port.address + '</td><td>' + port.port + '</td></tr>';
                });
                html += '</tbody></table>';
                $('#ports-list').html(html);
            }
        });
    }

    // Log Viewer Functions
    function loadLogs() {
        $.get('Laragon-Dashboard/log_viewer.php?action=list_logs', function(data) {
            if (data.success) {
                const select = $('#log-select');
                select.empty();
                select.append('<option value="">Select Log File</option>');
                data.logs.forEach(function(log) {
                    select.append('<option value="' + log.path + '">' + log.type + ' - ' + log.name + ' (' + formatBytes(log.size) + ')</option>');
                });
            }
        });
    }

    function loadLog() {
        const logPath = $('#log-select').val();
        const lines = $('#log-lines').val();
        if (!logPath) {
            alert('Please select a log file');
            return;
        }
        $.get('Laragon-Dashboard/log_viewer.php?action=read_log&path=' + encodeURIComponent(logPath) + '&lines=' + lines, function(data) {
            if (data.success) {
                $('#log-text').text(data.lines.join('\n'));
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    function clearLog() {
        const logPath = $('#log-select').val();
        if (!logPath) {
            alert('Please select a log file');
            return;
        }
        if (!confirm('Are you sure you want to clear this log file?')) {
            return;
        }
        $.get('Laragon-Dashboard/log_viewer.php?action=clear_log&path=' + encodeURIComponent(logPath), function(data) {
            if (data.success) {
                alert('Log cleared successfully');
                loadLog();
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    // Quick Tools Functions
    function clearCache() {
        $.post('Laragon-Dashboard/quick_tools.php', {action: 'clear_cache'}, function(data) {
            if (data.success) {
                alert('Cache cleared successfully');
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    function optimizeDatabase() {
        const database = $('#optimize-db-select').val();
        if (!database) {
            alert('Please select a database');
            return;
        }
        if (!confirm('This may take a while. Continue?')) {
            return;
        }
        $.post('Laragon-Dashboard/quick_tools.php', {action: 'optimize_database', database: database}, function(data) {
            if (data.success) {
                alert('Database optimized successfully. Tables optimized: ' + data.optimized_tables.length);
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    function loadProjects() {
        // SECURITY: Don't expose full server paths in client-side code
        const wwwPath = '<?php 
            // Only expose full path in debug mode
            if (defined('APP_DEBUG') && APP_DEBUG) {
                echo dirname($_SERVER["DOCUMENT_ROOT"]);
            } else {
                echo '/www'; // Generic path for production
            }
        ?>';
        const folders = <?php 
            $folders = array_filter(glob(dirname(__DIR__) . '/*'), 'is_dir');
            $ignore = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets', 'Laragon-Dashboard'];
            $projects = [];
            foreach ($folders as $folder) {
                $name = basename($folder);
                if (!in_array($name, $ignore)) {
                    $projects[] = ['name' => $name, 'path' => $folder];
                }
            }
            echo json_encode($projects);
        ?>;
        
        const select = $('#project-select');
        const optimizeSelect = $('#optimize-db-select');
        select.empty();
        optimizeSelect.empty();
        select.append('<option value="">Select Project</option>');
        optimizeSelect.append('<option value="">Select Database</option>');
        
        folders.forEach(function(project) {
            select.append('<option value="' + project.path + '">' + project.name + '</option>');
        });
        
        // Load databases for optimize select
        loadDatabases();
        $('#database-select').change(function() {
            optimizeSelect.append('<option value="' + $(this).val() + '">' + $(this).val() + '</option>');
        });
    }

    function gitStatus() {
        const projectPath = $('#project-select').val();
        if (!projectPath) {
            alert('Please select a project');
            return;
        }
        $.post('Laragon-Dashboard/quick_tools.php', {action: 'git_status', project_path: projectPath}, function(data) {
            if (data.success) {
                $('#tools-output').html('<div class="alert alert-info"><strong>Git Status:</strong><pre>' + data.status + '</pre><strong>Branch:</strong> ' + data.branch + '</div>');
            } else {
                alert('Error: ' + data.error);
            }
        });
    }

    function composerInstall() {
        const projectPath = $('#project-select').val();
        if (!projectPath) {
            alert('Please select a project');
            return;
        }
        if (!confirm('Run composer install? This may take a while.')) {
            return;
        }
        $.post('Laragon-Dashboard/quick_tools.php', {action: 'composer_command', project_path: projectPath, command: 'install'}, function(data) {
            $('#tools-output').html('<div class="alert alert-info"><strong>Composer Output:</strong><pre>' + (data.output || '') + '</pre></div>');
        });
    }

    function npmInstall() {
        const projectPath = $('#project-select').val();
        if (!projectPath) {
            alert('Please select a project');
            return;
        }
        if (!confirm('Run npm install? This may take a while.')) {
            return;
        }
        $.post('Laragon-Dashboard/quick_tools.php', {action: 'npm_command', project_path: projectPath, command: 'install'}, function(data) {
            $('#tools-output').html('<div class="alert alert-info"><strong>NPM Output:</strong><pre>' + (data.output || '') + '</pre></div>');
        });
    }

    function showPhpInfo() {
        $.get('Laragon-Dashboard/quick_tools.php?action=php_info', function(data) {
            if (data.success) {
                const win = window.open('', 'phpinfo', 'width=800,height=600');
                win.document.write(data.phpinfo);
            }
        });
    }

    function viewTableStructure(database, table) {
        $.get('Laragon-Dashboard/database_manager.php?action=get_table_structure&database=' + encodeURIComponent(database) + '&table=' + encodeURIComponent(table), function(data) {
            if (data.success) {
                let html = '<table class="table table-striped"><thead><tr><th>Column</th><th>Type</th><th>Nullable</th><th>Key</th><th>Default</th><th>Extra</th></tr></thead><tbody>';
                data.columns.forEach(function(col) {
                    html += '<tr><td>' + col.COLUMN_NAME + '</td><td>' + col.DATA_TYPE + '</td><td>' + col.IS_NULLABLE + '</td><td>' + col.COLUMN_KEY + '</td><td>' + (col.COLUMN_DEFAULT || 'NULL') + '</td><td>' + col.EXTRA + '</td></tr>';
                });
                html += '</tbody></table>';
                $('#query-results').html(html);
            }
        });
    }

    // Self-Update Functions
    function checkForUpdates() {
        $('#update-status').html('<div class="alert alert-info">Checking for updates...</div>');
        $.get('Laragon-Dashboard/update_manager.php?action=check', function(data) {
            if (data.success) {
                if (data.update_available) {
                    let statusHtml = '<div class="alert alert-success">' +
                        '<strong>Update Available!</strong><br>' +
                        'Current: ' + data.current_version;
                    if (data.current_commit) {
                        statusHtml += ' (' + data.current_commit + ')';
                    }
                    statusHtml += '<br>Latest: ' + data.latest_version;
                    if (data.latest_commit) {
                        statusHtml += ' (' + data.latest_commit + ')';
                    }
                    if (data.branch) {
                        statusHtml += '<br>Branch: ' + data.branch;
                    }
                    statusHtml += '<br><button class="btn btn-success btn-sm mt-2" onclick="installUpdate()">Pull & Install Update</button>' +
                        '</div>';
                    $('#update-status').html(statusHtml);
                } else {
                    let statusHtml = '<div class="alert alert-success">You are running the latest version (' + data.current_version + ')';
                    if (data.current_commit) {
                        statusHtml += ' - Commit: ' + data.current_commit;
                    }
                    if (data.branch) {
                        statusHtml += '<br>Branch: ' + data.branch;
                    }
                    statusHtml += '</div>';
                    $('#update-status').html(statusHtml);
                }
            } else {
                $('#update-status').html('<div class="alert alert-warning">Unable to check for updates: ' + (data.error || 'Unknown error') + '</div>');
            }
        }).fail(function() {
            $('#update-status').html('<div class="alert alert-danger">Failed to check for updates. Please try again later.</div>');
        });
    }

    function installUpdate() {
        if (!confirm('This will pull the latest changes from Git. Continue?')) {
            return;
        }

        $('#update-progress').show();
        $('#progress-bar').css('width', '0%').text('0%');
        $('#progress-text').text('Pulling latest changes from Git...');

        const csrfToken = '<?php echo SecurityHelper::getCSRFToken(); ?>';
        
        $.post('Laragon-Dashboard/update_manager.php?action=install', {
            csrf_token: csrfToken
        }, function(data) {
            if (data.success) {
                $('#progress-bar').css('width', '100%').text('100%');
                $('#progress-text').text('Update installed successfully!');
                $('#update-status').html(
                    '<div class="alert alert-success">' +
                    '<strong>Update Installed!</strong><br>' +
                    'The update has been installed successfully via Git pull.' +
                    (data.branch ? '<br>Branch: ' + data.branch : '') +
                    '<br><button class="btn btn-primary btn-sm mt-2" onclick="location.reload()">Refresh Page</button>' +
                    '</div>'
                );
            } else {
                $('#update-progress').hide();
                $('#update-status').html('<div class="alert alert-danger">Installation failed: ' + (data.error || 'Unknown error') + '</div>');
            }
        }).fail(function() {
            $('#update-progress').hide();
            $('#update-status').html('<div class="alert alert-danger">Installation failed. Please try again.</div>');
        });
    }
    </script>

    <footer class="footer">
        <div class="footer__copyright">
            <?php echo $translations['default_footer'] ?? "&copy; 2024 " . htmlspecialchars(date('Y')) . ", Tarek Tarabichi"; ?>
        </div>
        <div class="footer__signature">
            <?php echo $translations['made_with_love'] ?? "Made with <span style=\"color: #e25555;\">&hearts;</span> and powered by Laragon"; ?>
        </div>
        <?php if (APP_DEBUG): ?>
        <div class="footer__debug">
            <?php 
            $endTime = microtime(true);
            $endMemory = memory_get_usage(true);
            $executionTime = round(($endTime - $startTime) * 1000, 2);
            $memoryUsed = round(($endMemory - $startMemory) / 1024, 2);
            echo "Page loaded in {$executionTime}ms | Memory: {$memoryUsed}KB";
            ?>
        </div>
        <?php endif; ?>
    </footer>

    <script>
    const uptimeData = [ /* Add your uptime data here */ ];
    const memoryUsageData = [ /* Add your memory usage data here */ ];
    const diskUsageData = [ /* Add your disk usage data here */ ];

    const ctxUptime = document.getElementById('uptimeChart').getContext('2d');
    const uptimeChart = new Chart(ctxUptime, {
        type: 'line',
        data: {
            labels: ['Time1', 'Time2', 'Time3'],
            datasets: [{
                label: 'Uptime',
                data: uptimeData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxMemory = document.getElementById('memoryUsageChart').getContext('2d');
    const memoryUsageChart = new Chart(ctxMemory, {
        type: 'bar',
        data: {
            labels: ['Total', 'Used', 'Free'],
            datasets: [{
                label: 'Memory Usage (MB)',
                data: memoryUsageData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const ctxDisk = document.getElementById('diskUsageChart').getContext('2d');
    const diskUsageChart = new Chart(ctxDisk, {
        type: 'doughnut',
        data: {
            labels: ['Used', 'Available'],
            datasets: [{
                label: 'Disk Usage',
                data: diskUsageData,
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    const ctxPhpMemory = document.getElementById('phpMemoryChart').getContext('2d');
    const phpMemoryChart = new Chart(ctxPhpMemory, {
        type: 'bar',
        data: {
            labels: ['Current', 'Peak'],
            datasets: [{
                label: 'PHP Memory Usage (MB)',
                data: [0, 0],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

</body>

</html>
