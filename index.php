<?php
/**
 * Application: Laragon | Server Index Page
 * Description: This is the main index page for the Laragon server, displaying server info and applications.
 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
 * Contributors: LrkDev in v.2.1.2
 * Version: 2.2
 */

const SERVER_TYPES = [
    'php' => 'php',
    'apache' => 'apache',
];

/**
 * Displays server status including uptime, memory usage, and disk usage.
 *
 * @return void
 */
function showServerStatus(): void
{
    echo '<h1>Server Status</h1>';

    // Display server uptime
    $uptime = shell_exec('uptime');
    echo '<h2>Uptime</h2>';
    echo '<p>' . $uptime . '</p>';

    // Display memory usage
    $free = shell_exec('free -m'); // memory in MB
    echo '<h2>Memory Usage (in MB)</h2>';
    echo '<pre>' . $free . '</pre>';

    // Display disk usage
    $df = shell_exec('df -h'); // disk usage in human-readable format
    echo '<h2>Disk Usage</h2>';
    echo '<pre>' . $df . '</pre>';
}

// Improved error handling and security (input validation, escaping outputs)
/**
 * Handles incoming query parameters and executes corresponding functionality.
 *
 * @param string $param The query parameter to handle.
 * @return void
 * @throws InvalidArgumentException If the parameter value is not handled.
 */
function handleQueryParameter(string $param): void
{
    switch ($param) {
        case 'info':
            phpinfo();
            break;
        case 'status':
            // Assume there's a function to show status
            showServerStatus();
            break;
        default:
            throw new InvalidArgumentException("Unsupported parameter: $param");
    }
}

// Check if 'q' parameter is set and sanitize it
if (isset($_GET['q'])) {
    $queryParam = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
    try {
        handleQueryParameter($queryParam);
    } catch (InvalidArgumentException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

/**
 * Retrieves a list of PHP extensions or Apache modules based on the specified server type.
 * The results are sorted alphabetically and returned in a multidimensional array formatted into columns.
 *
 * @param string $server The server type ('php' or 'apache').
 * @param int $columns Number of columns to divide the list into for the return array.
 * @return array A multidimensional array of extensions or modules.
 * @throws InvalidArgumentException If an invalid server type is provided.
 * @throws Exception If required functions are unavailable.
 */
const SERVER_PHP = 'php';
const SERVER_APACHE = 'apache';

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
            throw new InvalidArgumentException('Invalid server name: ' . $server);
    }

    sort($extensions, SORT_STRING);
    $extensions = array_chunk($extensions, $columns);

    return $extensions;
}
/**
 * Fetches the latest PHP version from the official PHP website and compares it with the current PHP version running on the server.
 *
 * @return array Information about the latest and current PHP versions.
 * @throws Exception If unable to retrieve or decode the version information.
 */
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
        'lastVersion' => $lastVersion,
        'currentVersion' => $currentVersion,
        'isUpToDate' => version_compare($currentVersion, $lastVersion, '>='),
    ];
}

// Ensure $serverInfo is defined and initialized with serverInfo() function call
$serverInfo = serverInfo(); // Make sure this line is placed before you try to access $serverInfo

// Example usage
//echo $serverInfo['httpdVer']; // Example of accessing an element

// Before accessing an array offset, check if the variable is an array and not null
if (is_array($serverInfo) && isset($serverInfo['httpdVer'])) {
    //echo $serverInfo['httpdVer']; // Safely access the 'httpdVer' index
} else {
    // Handle the case where $serverInfo is not an array or the index 'httpdVer' is not set
    echo "Server information is not available.";
}

/**
 * Gathers information about the server environment including versions of HTTP server, OpenSSL, PHP, and Xdebug, as well as document root and server name.
 *
 * @return array Array containing various server-related information.
 */
function serverInfo(): array
{
    $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown Server Software';
    $serverParts = explode(' ', $serverSoftware);

    $httpdVer = $serverParts[0] ?? 'Unknown';
    $openSslVer = isset($serverParts[2]) && strpos($serverParts[2], 'OpenSSL/') === 0 ? substr($serverParts[2], 8) : 'Not available';

    $phpInfo = getPhpVersion();
    $xdebugVersion = extension_loaded('xdebug') ? phpversion('xdebug') : 'Not installed';

    return [
        'httpdVer' => htmlspecialchars($httpdVer),
        'openSsl' => htmlspecialchars($openSslVer),
        'phpVer' => htmlspecialchars($phpInfo['currentVersion']),
        'xDebug' => htmlspecialchars($xdebugVersion),
        'docRoot' => htmlspecialchars($_SERVER['DOCUMENT_ROOT'] ?? '/var/www/html'),
        'serverName' => htmlspecialchars($_SERVER['HTTP_HOST'] ?? 'localhost'),
    ];
}

/**
 * Retrieves the MySQL version by executing a shell command.
 *
 * @return string The MySQL version number, or 'Unknown' if it cannot be determined.
 */
function getSQLVersion(): string
{
    $output = shell_exec('mysql -V');
    if ($output === null) {
        return "Unknown"; // Command failed to execute, possibly not installed or not in PATH
    }

    if (preg_match('@[0-9]+\.[0-9]+\.[0-9-\w]+@', $output, $version)) {
        return htmlspecialchars($version[0]);
    }

    return "Unknown";
}

/**
 * Generates download and changelog links for a specific PHP version.
 *
 * @param string $version The PHP version number.
 * @param string $branch The major version branch of PHP, defaults to '7'.
 * @param string $architecture The architecture of the server, defaults to 'x64'.
 * @return array An array containing URLs for the changelog and download link.
 */
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

/**
 * Determines the directory path for server-specific site configuration based on the server software.
 *
 * @return string The directory path of the server's site configuration.
 * @throws InvalidArgumentException If the server software is unsupported or undefined.
 */
function getSiteDir(): string
{
    $rootDir = dirname(__DIR__) . '/';
    if ($rootDir === false) {
        throw new RuntimeException("Unable to determine the root directory.");
    }

    // Ensures that SERVER_SOFTWARE is set and not empty
    if (!isset($_SERVER['SERVER_SOFTWARE']) || trim($_SERVER['SERVER_SOFTWARE']) === '') {
        throw new InvalidArgumentException("Server software is not defined in the server environment.");
    }

    $serverSoftware = strtolower($_SERVER['SERVER_SOFTWARE']);

    if (strpos($serverSoftware, 'apache') !== false) {
        return $rootDir . '/laragon/etc/apache2/sites-enabled';
    } elseif (strpos($serverSoftware, 'nginx') !== false) {
        return $rootDir . '/laragon/etc/nginx/sites-enabled';
    }

    throw new InvalidArgumentException("Unsupported server type: $serverSoftware");
}

/**
 * Fetches configuration details for local sites based on server configuration files.
 *
 * @param string $server The type of server, defaults to 'apache'.
 * @param array $ignoredFiles Files and directories to ignore during the scan.
 * @return array An array of sites with their configuration details.
 */



function getLocalSites($server = 'apache', $ignoredFiles = ['.', '..', '00-default.conf']): array
{
    try {
        $sitesDir = getSiteDir(); // Assume getSiteDir() throws an exception if unable to determine the directory
        $files = scandir($sitesDir);
        if ($files === false) {
            throw new Exception("Failed to scan directory: $sitesDir");
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log the error to PHP's error log
        return []; // Return an empty array to indicate failure gracefully
    }

    $scanDir = array_diff($files, $ignoredFiles);
    $sites = [];

// Define $ignore_dirs as an array with directories to ignore
	$ignore_dirs = array('.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets');

// Now you can safely use $ignore_dirs in your script
	$folders = array_filter(glob('*'), 'is_dir');
	
	foreach ($folders as $host) {
		if (in_array($host, $ignore_dirs) || !is_dir($host)) {
			continue; // Skip ignored directories or files
		}
		// Process each directory that is not in the ignore list
		// Your code for processing directories here
	}

    foreach ($scanDir as $filename) {
        $path = realpath("$sitesDir/$filename");
        if ($path === false || !is_file($path)) {
            continue; // Skip invalid paths or directories
        }

        $config = file_get_contents($path);
        if ($config === false) {
            continue; // Skip files that can't be read
        }

        if (preg_match('/^\s*ServerName\s+(.+)$/m', $config, $domainMatches) &&
            preg_match('/^\s*DocumentRoot\s+(.+)$/m', $config, $documentRootMatches)) {
            $sites[] = [
                'filename' => htmlspecialchars($filename),
                'path' => htmlspecialchars($path),
                'domain' => htmlspecialchars($domainMatches[1]),
                'documentRoot' => htmlspecialchars($documentRootMatches[1]),
            ];
        }
    }

    return $sites;
}

/**
 * Renders HTML links for local sites with XSS prevention.
 *
 * @return string HTML content containing links to local sites.
 */
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
        echo "</div><hr>";
    }

    return ob_get_clean();
}

// Improved directory check with safer path handling
$rootPath = realpath(__DIR__);
$folders = array_filter(glob($rootPath . '/*'), 'is_dir');
$ignore_dirs = array('.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets');

foreach ($folders as $folderPath) {
    $host = basename($folderPath);
    // Assume $ignored contains an array of directories to ignore
    if (in_array($host, $ignore_dirs)) {
        continue; // Skip ignored directories
    }

    // Secure way to determine if a directory contains a specific app
//    if (file_exists($folderPath . '/wp-admin')) {
//        // WordPress detected
//        echo '<div>WordPress site detected at ' . htmlspecialchars($host) . '</div>';
//    }
    // Additional checks for other frameworks...
}
?>
<html>

<head>
    <title>My Development Server</title>
    <link href="https://fonts.googleapis.com/css?family=Pt+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/style.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script>
    const menuIconEl = $('.menu-icon');
    const sidenavEl = $('.sidenav');
    const sidenavCloseEl = $('.sidenav__close-icon');

    // Add and remove provided class names
    function toggleClassName(el, className) {
        if (el.hasClass(className)) {
            el.removeClass(className);
        } else {
            el.addClass(className);
        }
    }

    // Open the side nav on click
    $(document).ready(function() {
        $('.menu-icon').on('click', function() {
            $('.sidenav').toggleClass('active');
        });

        $('.sidenav__close-icon').on('click', function() {
            $('.sidenav').removeClass('active');
        });
    });
    </script>
</head>

<body>

    <div class="grid-container">
        <div class="menu-icon">
            <i class="fas fa-bars header__menu"></i>
        </div>

        <header class="header">
            <div class="header__search">My Development Server</div>
            <div class="header__avatar">Welcome Back!</div>
        </header>

        <!--  -->
        <main class="main">
            <!-- 1st row | systems-->
            <div class="main-overview">

                <div class="overviewcard4">
                    <div class="overviewcard_icon">
                        <?php

// Get the current time
$currentTime = new DateTime();
$hours = $currentTime->format('H');

// Get the greeting based on the time of day
if ($hours < 12) {
    $greeting = "Good morning";
} elseif ($hours < 18) {
    $greeting = "Good afternoon";
} else {
    $greeting = "Good evening";
}

// Display the greeting
echo "<h4>" . $greeting . "!</h4>";
?>
                    </div>
                    <div class="overviewcard_info"><img src="assets/apps.png" style="width:64px;"></div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon"></div>
                    <div class="overviewcard_info">
                        <?php echo $_SERVER['SERVER_SOFTWARE']; ?>
                    </div>
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
                        <?php echo phpversion(); ?>
                    </div>
                </div>

            </div>
            <!-- 2nd row | sites loop-->
            <div class="main-overview">
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
    printf("server version: %s\n", mysqli_get_server_info($link));
}
?>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon">Document Root</div>
                    <div class="overviewcard_info">
                        <?php echo $_SERVER['DOCUMENT_ROOT']; ?><br>
                        <small><span><?php echo $_SERVER['HTTP_HOST']; ?></span></small>
                    </div>
                </div>

                <div class="overviewcard">
                    <div class="overviewcard_icon">PhpMyAdmin</div>
                    <div class="overviewcard_info">
                        <a href="http://localhost/phpmyadmin" target="_blank">
                            Manage MySQL
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
            </div>

            <div class="main-overview wrapper">

                <?php
/*
 * Detects the web application framework of the specified host folders and returns its details.
 * @return array An array containing details of the detected framework for each folder
 * @throws Exception If an error occurs during the detection process
 */
$ignored = array('favicon_io'); // Add more directories or files to ignore here
$folders = array_filter(glob('*'), 'is_dir');

if ($laraconfig['SSLEnabled'] == 0 || $laraconfig['Port'] == 80) {
    $url = 'http';
} else {
    $url = 'https';
}
//----------------------------
// WEB-APP FRAMEWORK DETECTION FUNCTION
//----------------------------
$ignore_dirs = array('.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90', 'assets');
foreach ($folders as $host) {
    if (in_array($host, $ignore_dirs) || !is_dir($host)) {
        continue;
    } // Skip ignored directories or files

    $admin_link = '';
    $app_name = '';
    $avatar = '';

    switch (true) {
        // DRUPAL
        case (
                file_exists($host . '/core') // legacy drupal 8.7 and earlier
                || file_exists($host . '/web/core') // drupal 8.8 and later
            ):
            $app_name = ' Drupal ';
            $avatar = 'assets/Drupal.svg';
            $admin_link = '
                                <a href="' . $url . '://' . $host . '.local/user" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        ' . $app_name . '
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // WORDPRESS
        case file_exists($host . '/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'assets/Wordpress.png';
            $admin_link = '
                                <a href="' . $url . '://' . $host . '.local/wp-admin" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        ' . $app_name . '
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // JOOMLA
        case file_exists($host . '/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'assets/Joomla.png';
            $admin_link = '
                                <a href="' . $url . '://' . $host . '.local/administrator" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        ' . $app_name . '
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // LARAVEL
        case file_exists($host . '/public/index.php') && is_dir($host . '/app') && file_exists($host . '/.env'):
            $app_name = ' Laravel ';
            $avatar = 'assets/Laravel.png';
            $admin_link = '
                                <a href="' . $url . '://' . $host . '.local/admin" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        ' . $app_name . '
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // SYMFONY
        case file_exists($host . '/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'assets/Symfony.png';
            $admin_link = '
                        <a href="' . $url . '://' . $host . '.local/admin" target="_blank">
                            <small style="font-size: 8px; color: #cccccc;">
                                ' . $app_name . '
                            </small>
                            <br>
                            Admin
                        </a>';
            break;

        // PYTHON Based Projects
        case (file_exists($host . '/') && is_dir($host . '/app.py') && is_dir($host . '/static') && file_exists($host . '/.env')):
            $app_name = ' Python ';
            $avatar = 'assets/Python.png';
            $admin_link = '
                    <a href="' . $url . '://' . $host . '.local/Public" target="_blank">
                        <small style="font-size: 8px; color: #cccccc;">
                            ' . $app_name . '
                        </small>
                        <br>
                        Public Folder
                    </a>';

            // Execute the command to run the Python application
            $command = 'python ' . $host . '/app.py'; // Replace 'app.py' with the actual file name
            exec($command, $output, $returnStatus);

            // Check the return status to ensure the command executed successfully
            if ($returnStatus === 0) {
                // Command executed successfully
                // Process any output or perform further actions if needed
            } else {
                // Command execution failed
                // Handle the error appropriately
            }

            break;

        // CAKEPHP
        case file_exists($host . '/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'assets/CakePHP.png';
            $admin_link = '
                        <a href="' . $url . '://' . $host . '.local/admin" target="_blank">
                            <small style="font-size: 8px; color: #cccccc;">
                                ' . $app_name . '
                            </small>
                            <br>
                            Admin
                        </a>';
            break;

        // No recognized framework found
        default:
            $admin_link = '';
            $avatar = 'assets/Unknown.png';

            break;
    }

    echo '
        <div class="overviewcard_sites">
            <div class="overviewcard_avatar">
                <img src="' . $avatar . '" style="width:20px; height:20px;">
            </div>
            <div class="overviewcard_icon">
                <a href="' . $url . '://' . $host . '.local">' . $host . '</a>
            </div>
            <div class="overviewcard_info">
                ' . $admin_link . '
            </div>
        </div>';
}
?>
            </div>
        </main>

        <!-- FOOTER STARTS HERE -->
        <footer class="footer">
            <div class="footer__copyright">
                &copy; 2024
                <?php echo date('Y'); ?>, Tarek
                Tarabichi
            </div>
            <div class="footer__signature">
                Made with
                <span style="color: #e25555;">&hearts;</span>
                and powered by Laragon
            </div>
        </footer>
        <!--FOOTER END HERE -->

        <!-- MAIN END  -->
    </div>
</body>

</html>
