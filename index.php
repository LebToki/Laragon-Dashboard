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
 * Version: 2.4.0
 */

// Load language files
function loadLanguage($lang)
{
    $allowedLangs = ['en', 'de', 'es', 'fr', 'id', 'pt', 'tl'];
    if (!in_array($lang, $allowedLangs, true)) {
        $lang = 'en';
    }

    $langFile = __DIR__ . "/assets/languages/{$lang}.json";
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
    echo '<h1>Server Status</h1>';
    // Display server uptime
    $uptime = shell_exec('uptime');
    echo '<h2>Uptime</h2><p>' . htmlspecialchars($uptime) . '</p>';

    // Display memory usage
    $free = shell_exec('free -m');
    echo '<h2>Memory Usage (in MB)</h2><pre>' . htmlspecialchars($free) . '</pre>';

    // Display disk usage
    $df = shell_exec('df -h');
    echo '<h2>Disk Usage</h2><pre>' . htmlspecialchars($df) . '</pre>';
}

// Handle incoming query parameters
function handleQueryParameter(string $param): void
{
    switch ($param) {
        case 'info':
            phpinfo();
            break;
        case 'status':
            showServerStatus();
            break;
        default:
            throw new InvalidArgumentException("Unsupported parameter: " . htmlspecialchars($param));
    }
}

if (isset($_GET['q'])) {
    $queryParam = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
    try {
        handleQueryParameter($queryParam);
    } catch (InvalidArgumentException $e) {
        echo 'Error: ' . htmlspecialchars($e->getMessage());
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


// Gather server information
function serverInfo(): array
{
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown Server Software';
    $serverParts = explode(' ', $serverSoftware);

    $httpdVer = $serverParts[0] ?? 'Unknown';
    $openSslVer = isset($serverParts[2]) && strpos($serverParts[2], 'OpenSSL/') === 0 ? substr($serverParts[2], 8) : 'Not available';

    $phpVersion = phpversion();
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

    return [
        'httpdVer' => htmlspecialchars($httpdVer),
        'openSsl' => htmlspecialchars($openSslVer),
        'phpVer' => htmlspecialchars($phpVersion),
        'xDebug' => htmlspecialchars($xdebugVersion),
        'docRoot' => htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? '/var/www/html'),
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

$rootPath = realpath(__DIR__);
$folders = array_filter(glob($rootPath . '/*'), 'is_dir');
$ignore_dirs = ['.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets'];

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
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <title><?php echo $translations['title'] ?? 'Welcome to the Laragon Dashboard'; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Pt+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap">
    <link rel="stylesheet" href="assets/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-grid.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap-reboot.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/fontawesome.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" type="image/png" href="assets/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="assets/favicon/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="assets/favicon/android-chrome-512x512.png" sizes="512x512">
    <link rel="icon" type="apple-touch-icon" href="assets/favicon/apple-touch-icon.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">

    <script>
    $(document).ready(function() {
        $('.tab').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('.tab').removeClass('active');
            $('.tab-content').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
        });

        $('#language-selector').change(function() {
            var lang = $(this).val();
            window.location.href = "?lang=" + lang;
        });

        $('#project-search').on('input', function() {
            var q = $(this).val();
            $.get('project_search.php', {q: q}, function(data) {
                $('#project-list').html(data);
            });
        });
    });

    function fetchServerVitals() {
        $.ajax({
            url: 'server_vitals.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#uptime').text(data.uptime);
                $('#memory-usage').text(data.memoryUsage);
                $('#disk-usage').text(data.diskUsage);

                // Update charts
                uptimeChart.data.labels = data.uptimeLabels;
                uptimeChart.data.datasets[0].data = data.uptimeData;
                uptimeChart.update();

                memoryUsageChart.data.labels = data.memoryUsageLabels;
                memoryUsageChart.data.datasets[0].data = data.memoryUsageData;
                memoryUsageChart.update();

                diskUsageChart.data.labels = data.diskUsageLabels;
                diskUsageChart.data.datasets[0].data = data.diskUsageData;
                diskUsageChart.update();
            }
        });
    }

    // Fetch server vitals every 5 seconds
    setInterval(fetchServerVitals, 5000);
    fetchServerVitals();
    </script>
    <style>
    /* Scrollbar CSS */
    * {
        scrollbar-width: auto;
        scrollbar-color: #ec1c7e #ffffff;
    }

    *::-webkit-scrollbar {
        width: 16px;
    }

    *::-webkit-scrollbar-track {
        background: #ffffff;
    }

    *::-webkit-scrollbar-thumb {
        background-color: #ec1c7e;
        border-radius: 10px;
        border: 3px solid #ffffff;
    }

    .grid-container {
        grid-area: main;
        background: url(assets/background2.jpg) no-repeat center center fixed;
        background-size: cover;
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
    }

    .tab-content.active {
        display: block;
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
$langFiles = glob(__DIR__ . "/assets/languages/*.json");
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
    </nav>

    <div class="grid-container">

        <div class="tab-content <?php echo $activeTab === 'servers' ? 'active' : ''; ?>" id="servers">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_servers'] ?? 'My Development Server Servers & Applications'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="main-overview server-overview">
                <div class="overviewcard4">
                    <div class="overviewcard_icon"></div>
                    <div class="overviewcard_info"><img src="assets/Server.png" style="width:64px;"></div>
                </div>

                <?php $serverInfo = serverInfo();?> <div class="overviewcard">
                    <div class="overviewcard_icon"></div>
                    <div class="overviewcard_info">
                        <?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE']); ?>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon"><?php echo $translations['web_server'] ?? 'Web Server'; ?></div>
                    <div class="overviewcard_info"><?php echo $serverInfo['webServer']; ?></div>
                </div>
                <div class="overviewcard">
                    <div class="overviewcard_icon">PHP <?php echo ($serverInfo['isFpm']) ? 'FPM' : 'SAPI'; ?></div>
                    <div class="overviewcard_info"><?php echo $serverInfo['phpSapi']; ?></div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon"></div>
                    <div class="overviewcard_info">
                        <?=$serverInfo['openSsl'];?>
                    </div>
                </div>
                <div class="overviewcard">
                    <div class="overviewcard_icon">PHP</div>
                    <div class="overviewcard_info">
                        <?php echo htmlspecialchars(phpversion()); ?>
                    </div>
                </div>
            </div>
            <div class="main-overview server-overview">
                <div class="overviewcard">
                    <div class="overviewcard_icon">MySQL</div>
                    <div class="overviewcard_info">
                        <?php
error_reporting(0);
$laraconfig = parse_ini_file('../usr/laragon.ini');

$link = mysqli_connect('localhost', 'root', $laraconfig['MySQLRootPassword']);
if (!$link) {
    $link = mysqli_connect('localhost', 'root', '');
}
if (!$link) {
    echo 'MySQL not running!';
} else {
    printf("server version: %s\n", htmlspecialchars(mysqli_get_server_info($link)));
}
?>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon"><?php echo $translations['document_root'] ?? 'Document Root'; ?></div>
                    <div class="overviewcard_info">
                        <?php echo htmlspecialchars($_SERVER['DOCUMENT_ROOT']); ?><br>
                        <small><span><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?></span></small>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon">PhpMyAdmin</div>
                    <div class="overviewcard_info">
                        <a href="http://localhost/phpmyadmin" target="_blank">
                            <?php echo $translations['manage_mysql'] ?? 'Manage MySQL'; ?>
                        </a>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon">
                        Laragon
                    </div>
                    <div class="overviewcard_info">
                        Full 6.0.220916
                    </div>
                </div>

                <!-- Until one day we can send exec commands
<div class="overviewcard_server_controls">
                    <h3>Server Controls</h3>
                    <button class="btn-custom btn-success" onclick="startServer()">Start Server</button>
                    <button class="btn-custom btn-danger" onclick="stopServer()">Stop Server</button>
                </div> -->
            </div>

            <input type="text" id="project-search" placeholder="Search projects..." style="margin:10px 0;padding:5px;width:100%;max-width:400px;">

            <div id="project-list" class="main-overview wrapper">
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
            $avatar = 'assets/Drupal.svg';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/user" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'assets/Wordpress.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/wp-admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'assets/Joomla.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/administrator" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $avatar = 'assets/Laravel.png';
            $admin_link = '';
            break;
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'assets/Symfony.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $avatar = 'assets/Python.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/Public" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Public Folder</a>';

            $command = 'python ' . htmlspecialchars($host) . '/app.py';
            exec($command, $output, $returnStatus);
            break;
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'assets/CakePHP.png';
            $admin_link = '<a href="' . $url . '://' . htmlspecialchars($host) . '.local/admin" target="_blank"><small style="font-size: 8px; color: #cccccc;">' . $app_name . '</small><br>Admin</a>';
            break;
        default:
            $admin_link = '';
            $avatar = 'assets/Unknown.png';
            break;
    }

    echo '<div class="overviewcard_sites"><div class="overviewcard_avatar"><img src="' . $avatar . '" style="width:20px; height:20px;"></div><div class="overviewcard_icon"><a href="' . $url . '://' . htmlspecialchars($host) . '.local">' . htmlspecialchars($host) . '</a></div><div class="overviewcard_info">' . $admin_link . '</div></div>';
}
?>
            </div>
        </div>

        <div class="tab-content <?php echo $activeTab === 'mailbox' ? 'active' : ''; ?>" id="mailbox">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_mailbox'] ?? 'My Development Server Mailbox'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <?php include 'assets/inbox/inbox.php';?>
        </div>

        <div class="tab-content <?php echo $activeTab === 'vitals' ? 'active' : ''; ?>" id="vitals">
            <header class="header">
                <div class="header__search"><?php echo $translations['breadcrumb_server_vitals'] ?? 'My Development Server Vitals'; ?></div>
                <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
            </header>
            <div class="container mt-5" style="width: 1440px!important;background-color: #f8f9fa;padding: 20px;border-radius: 5px;color: #000000;">
                <h1 style="text-align: center;color: #000000">Server's Vitals</h1>

                <div class="row">

                    <div class="col-md-6">
                        <h2><?php echo $translations['uptime'] ?? 'Uptime'; ?></h2>
                        <p id="uptime"><?php echo htmlspecialchars(shell_exec('uptime')); ?></p>
                        <canvas id="uptimeChart"></canvas>
                    </div>

                    <div class="col-md-6">
                        <h2><?php echo $translations['memory_usage'] ?? 'Memory Usage (in MB)'; ?></h2>
                        <pre id="memory-usage"><?php echo htmlspecialchars(shell_exec('free -m')); ?></pre>
                        <canvas id="memoryUsageChart"></canvas>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <h2><?php echo $translations['disk_usage'] ?? 'Disk Usage'; ?></h2>
                        <pre id="disk-usage"><?php echo htmlspecialchars(shell_exec('df -h')); ?></pre>
                        <!--				<canvas id="diskUsageChart"></canvas>-->
                    </div>

                </div>

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
    </script>

    <footer class="footer">
        <div class="footer__copyright">
            <?php echo $translations['default_footer'] ?? "&copy; 2024 " . htmlspecialchars(date('Y')) . ", Tarek Tarabichi"; ?>
        </div>
        <div class="footer__signature">
            <?php echo $translations['made_with_love'] ?? "Made with <span style=\"color: #e25555;\">&hearts;</span> and powered by Laragon"; ?>
        </div>
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
    </script>

</body>

</html>
