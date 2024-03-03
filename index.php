<?php
/**
 * Application: Laragon | Server Index Page
 * Description: This is the main index page for the Laragon server, displaying server info and applications.
 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
 * Contributors: LrkDev
 * Version: 1.2.5
 */

const SERVER_TYPES = [
    'php' => 'php',
    'apache' => 'apache',
];

// Improved error handling and security (input validation, escaping outputs)
function handleQueryParameter($param)
{
    if (!in_array($param, ['info'], true)) {
        throw new InvalidArgumentException("Invalid query parameter: " . htmlspecialchars($param));
    }
    
    if ($param === 'info') {
        phpinfo();
        exit;
    }
}

if (isset($_GET['q']) && !empty($_GET['q'])) {
    handleQueryParameter($_GET['q']);
}

// Using try-catch for better error handling
function getServerExtensions(string $server): array
{
    if (!array_key_exists($server, SERVER_TYPES)) {
        throw new InvalidArgumentException("Invalid server name: " . htmlspecialchars($server));
    }

    $extensions = $server === SERVER_TYPES['php'] ? get_loaded_extensions() : apache_get_modules();
    sort($extensions, SORT_STRING);
    return array_chunk($extensions, 2);
}

function getPhpVersion(): array
{
    $json = @file_get_contents('https://www.php.net/releases/index.php?json&version=7');
    if ($json === false) {
        throw new Exception("Unable to retrieve PHP version info.");
    }
    $data = json_decode($json, true);
    $lastVersion = $data['version'] ?? 'unknown';

    $phpVersion = phpversion();
    $intLastVersion = (int)str_replace('.', '', $lastVersion);
    $intCurVersion = (int)str_replace('.', '', $phpVersion);

    return [
        'lastVersion' => $lastVersion,
        'currentVersion' => $phpVersion,
        'intLastVer' => $intLastVersion,
        'intCurVer' => $intCurVersion,
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

function serverInfo(): array
{
    $server = explode(' ', $_SERVER['SERVER_SOFTWARE']);
    $openSsl = $server[2] ?? null;

    return [
        'httpdVer' => htmlspecialchars($server[0]),
        'openSsl' => htmlspecialchars($openSsl),
        'phpVer' => htmlspecialchars(getPhpVersion()['currentVersion']),
        'xDebug' => htmlspecialchars(phpversion('xdebug')),
        'docRoot' => htmlspecialchars($_SERVER['DOCUMENT_ROOT']),
        'serverName' => htmlspecialchars($_SERVER['HTTP_HOST']),
    ];
}

// Simplified and improved security by escaping output
function getSQLVersion(): string
{
    $output = shell_exec('mysql -V');
    if (!preg_match('@[0-9]+\.[0-9]+\.[0-9-\w]+@', $output, $version)) {
        return "Unknown";
    }
    return htmlspecialchars($version[0]);
}

// More secure and error-handling enhancements
function phpDlLink($version): array
{
    $versionEscaped = htmlspecialchars($version);
    return [
        'changeLog' => "https://www.php.net/ChangeLog-7.php#$versionEscaped",
        'downLink' => "https://windows.php.net/downloads/releases/php-$versionEscaped-Win32-VC15-x64.zip",
    ];
}

// Handling server selection with improved logic and security
function getSiteDir(): string
{
    $rootDir = realpath(__DIR__ . '/../');
    $serverSoftware = strtolower($_SERVER['SERVER_SOFTWARE']);

    if (strpos($serverSoftware, 'apache') !== false) {
        return $rootDir . '/laragon/etc/apache2/sites-enabled';
    } elseif (strpos($serverSoftware, 'nginx') !== false) {
        return $rootDir . '/laragon/etc/nginx/sites-enabled';
    }
    throw new InvalidArgumentException("Unsupported server type: $serverSoftware");
}

// Improved logic for fetching local sites with security considerations
function getLocalSites($server = 'apache', $ignoredFiles = ['.', '..', '00-default.conf']): array
{
    $sitesDir = getSiteDir();
    $scanDir = array_diff(scandir($sitesDir), $ignoredFiles);

    $sites = [];
    foreach ($scanDir as $filename) {
        $path = "$sitesDir/$filename";
        $config = file_get_contents($path);
        if ($config !== false) {
            if (preg_match('/^\s*ServerName\s+(.+)$/m', $config, $domainMatches) && preg_match('/^\s*DocumentRoot\s+(.+)$/m', $config, $documentRootMatches)) {
                $sites[] = [
                    'filename' => htmlspecialchars($filename),
                    'path' => htmlspecialchars($path),
                    'domain' => htmlspecialchars($domainMatches[1]),
                    'documentRoot' => htmlspecialchars($documentRootMatches[1]),
                ];
            }
        }
    }

    return $sites;
}

// Simplified rendering function with XSS prevention
function renderLinks()
{
    ob_start();
    $sites = getLocalSites();

    foreach ($sites as $site) {
        $httpLink = "http://" . $site['domain'];
        $httpsLink = "https://" . $site['domain'];
        echo "<div class='row w800 my-2'>";
        echo "<div class='col-md-5 text-truncate tr'><a href='$httpLink'>$httpLink</a></div>";
        echo "<div class='col-2 arrows'>&xlArr; &sext; &xrArr;</div>";
        echo "<div class='col-md-5 text-truncate tl'><a href='$httpsLink'>$httpsLink</a></div>";
        echo "</div><hr>";
    }

    return ob_get_clean();
}

// Utilize functions and variables when necessary within the HTML body below
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
    menuIconEl.on('click', function() {
        toggleClassName(sidenavEl, 'active');
    });

    // Close the side nav on click
    sidenavCloseEl.on('click', function() {
        toggleClassName(sidenavEl, 'active');
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
                        <?= $serverInfo['openSsl']; ?>
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
$ignore_dirs = array('.', '..', 'logs', 'access-logs', 'vendor', 'favicon_io', 'ablepro-90','assets');
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
            file_exists($host.'/core')  // legacy drupal 8.7 and earlier
            || file_exists($host.'/web/core') // drupal 8.8 and later
            ):
            $app_name = ' Drupal ';
            $avatar = 'assets/Drupal.svg';
            $admin_link = '
                                <a href="'.$url.'://'.$host.'.local/user" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        '.$app_name.'
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // WORDPRESS
        case file_exists($host.'/wp-admin'):
            $app_name = ' Wordpress ';
            $avatar = 'assets/Wordpress.png';
            $admin_link = '
                                <a href="'.$url.'://'.$host.'.local/wp-admin" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        '.$app_name.'
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

        // JOOMLA
        case file_exists($host.'/administrator'):
            $app_name = ' Joomla ';
            $avatar = 'assets/Joomla.png';
            $admin_link = '
                                <a href="'.$url.'://'.$host.'.local/administrator" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        '.$app_name.'
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;
    
        // LARAVEL
        case file_exists($host.'/public/index.php') && is_dir($host.'/app') && file_exists($host.'/.env'):
            $app_name = ' Laravel ';
            $avatar = 'assets/Laravel.png';
            $admin_link = '
                                <a href="'.$url.'://'.$host.'.local/admin" target="_blank">
                                    <small style="font-size: 8px; color: #cccccc;">
                                        '.$app_name.'
                                    </small>
                                    <br>
                                    Admin
                                </a>';
            break;

            // SYMFONY
        case file_exists($host.'/bin/console'):
            $app_name = ' Symfony ';
            $avatar = 'assets/Symfony.png';
            $admin_link = '
                        <a href="'.$url.'://'.$host.'.local/admin" target="_blank"> 
                            <small style="font-size: 8px; color: #cccccc;">
                                '.$app_name.'
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
        case file_exists($host.'/bin/cake'):
            $app_name = ' CakePHP ';
            $avatar = 'assets/CakePHP.png';
            $admin_link = '
                        <a href="'.$url.'://'.$host.'.local/admin" target="_blank"> 
                            <small style="font-size: 8px; color: #cccccc;">
                                '.$app_name.'
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
                <img src="'.$avatar.'" style="width:20px; height:20px;">
            </div>
            <div class="overviewcard_icon">
                <a href="'.$url.'://'.$host.'.local">'.$host.'</a>
            </div>
            <div class="overviewcard_info">
                '.$admin_link.'
            </div>
        </div>';
}
?>
            </div>
        </main>

        <!-- FOOTER STARTS HERE -->
        <footer class="footer">
            <div class="footer__copyright">
                &copy; 2022 |
                <?php echo date('Y'); ?>, Tarek
                Tarabichi | <small> with contributions from LrkDev </small>
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
