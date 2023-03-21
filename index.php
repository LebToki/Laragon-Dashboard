<?php
/**
 * Application: Laragon | Server Index Page
 * Main Index File
 * Description: This is the main index file for the Laragon server.
 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
 * Version: 1.2
 */
// ---------------------------------------------------------------
/*-
* get page for phpinfo
*
*   The function is renamed to "handleQueryParameter", which better reflects its purpose.
*   The function now uses a "switch" statement for better readability.
*   If the query parameter is not valid, an exception is thrown.
*   The function is called from a conditional statement that checks whether the "q" parameter is set in the URL
*/
// ---------------------------------------------------------------
/* The handleQueryParameter function uses a switch statement to check the value of the
parameter passed as an argument. If the value is 'info', it calls the phpinfo function,
which outputs information about the PHP configuration on the server.
If the value is not 'info', it throws an exception with a message indicating
that the parameter is invalid.
*/

function handleQueryParameter($param)
{
    switch ($param) {
        case 'info':
            phpinfo();
            exit;
        default:
            throw new \InvalidArgumentException('Invalid query parameter: ' . $param);
    }
}

if (isset($_GET['q'])) {
    handleQueryParameter($_GET['q']);
}
// ---------------------------------------------------------------
/*-
* Get PHP extensions
*
*   The code you provided is a function that retrieves a list of PHP extensions or Apache modules
*   based on the value of the "server" parameter. The list is then sorted alphabetically and
*   returned in a two-dimensional array.The function could throw an exception if there's an error retrieving the
*   list of extensions or modules. For example, if the "apache_get_modules" function is not available on the server,
*   the function will generate an error. You could catch this error and throw an exception with a more informative message
*/

const SERVER_PHP = 'php';
const SERVER_APACHE = 'apache';

function getServerExtensions(string $server): array
{
    switch ($server) {
        case SERVER_PHP:
            $extensions = get_loaded_extensions();
            break;
        case SERVER_APACHE:
            $extensions = apache_get_modules();
            break;
        default:
            throw new InvalidArgumentException('Invalid server name: ' . $server);
    }

    sort($extensions, SORT_STRING);
    $extensions = array_chunk($extensions, 2);

    return $extensions;
}

// Example usage
// $extensions = getServerExtensions(SERVER_PHP);
// print_r($extensions);

// ---------------------------------------------------------------
/*
* Check PHP version
* This function fetches the releases page using file_get_contents,
* and then uses a regular expression to extract the latest version number from the page.
* The regular expression matches the version number in the filename of the latest release
* (e.g., php-7.4.33-Latest.tar.gz), and captures the version number using a group (([\d.]+)).
 */

function getPhpVersion()
{
    // get last version from php.net
    $json = @file_get_contents('https://www.php.net/releases/index.php?json&version=7.2.34');
    $data = json_decode($json);
    $lastVersion = $data->version;

    // get current installed version
    $phpVersion = phpversion();

    // Remove dot character from version ex: 1.2.3 to 123 and convert string to integer
    $intLastVersion = (int) str_replace('.', '', $lastVersion);
    $intCurVersion = (int) str_replace('.', '', $phpVersion);

    return [
        'lastVersion' => $lastVersion,
        'currentVersion' => $phpVersion,
        'intLastVer' => $intLastVersion,
        'intCurVer' => $intCurVersion,
    ];
}
// ---------------------------------------------------------------
/*
Retrieves information about the server environment.
Returns an associative array with the following keys:
httpdVer: the version of the HTTP server software.
openSsl: the version of the OpenSSL library, if available.
phpVer: the version of PHP installed on the server.
xDebug: the version of the Xdebug extension, if installed.
docRoot: the path to the server's document root.
serverName: the name of the HTTP-HOST
@return array An associative array containing server information.
*/

function serverInfo()
{
    $server = explode(' ', $_SERVER['SERVER_SOFTWARE']);
    $openSsl = isset($server[2]) ? $server[2] : null;

    return [
        'httpdVer' => $server[0],
        'openSsl' => $openSsl,
        'phpVer' => getPhpVersion()['currentVersion'],
        'xDebug' => phpversion('xdebug'),
        'docRoot' => $_SERVER['DOCUMENT_ROOT'],
        'serverName' => $_SERVER['HTTP_HOST']
    ];
}

// ---------------------------------------------------------------
// ----
// get SQL version
// ----
function getSQLVersion()
{
    $output = shell_exec('mysql -V');
    preg_match('@[0-9]+\.[0-9]+\.[0-9-\w]+@', $output, $version);

    return $version[0];
}

// ---------------------------------------------------------------
// ----
// PHP links
// ----
function phpDlLink($version)
{
    $changelog = 'https://www.php.net/ChangeLog-7.php#'.$version;
    $downLink = 'https://windows.php.net/downloads/releases/php-'.$version.'-Win32-VC15-x64.zip';

    return [
        'changeLog' => $changelog,
        'downLink' => $downLink,
    ];
}

// ---------------------------------------------------------------
function getSiteDir()
{
    $rootDir = realpath(__DIR__ . '/../');
    if (preg_match('/^Apache/', $_SERVER['SERVER_SOFTWARE'])) {
        return $rootDir . '/laragon/etc/apache2/sites-enabled';
    } else {
        return $rootDir . '/laragon/etc/nginx/sites-enabled';
    }
}

// ---------------------------------------------------------------

// This implementation allows the caller to specify the server type as an optional argument,
// and also allows the caller to specify an array of filenames to ignore.
// It also returns more information about each website, including the domain name and document root.
// Note that this implementation assumes that each configuration file contains exactly one ServerName directive
// and one DocumentRoot directive, which may not always be the case.


function getLocalSites($server = 'apache', $ignoredFiles = ['.', '..', '00-default.conf'])
{
    // Determine the appropriate sites-enabled directory based on the server software
    if ($server === 'apache') {
        $sitesDir = '../laragon/etc/apache2/sites-enabled';
    } elseif ($server === 'nginx') {
        $sitesDir = '../laragon/etc/nginx/sites-enabled';
    }

    if (!isset($sitesDir)) {
        throw new InvalidArgumentException("Unsupported server type: $server");
    }

    // Scan the sites-enabled directory
    $scanDir = scandir($sitesDir);

    // Remove ignored files
    foreach ($ignoredFiles as $ignoredFile) {
        $key = array_search($ignoredFile, $scanDir);
        if ($key !== false) {
            unset($scanDir[$key]);
        }
    }

    // Get information about each site
    $sites = [];
    foreach ($scanDir as $filename) {
        $path = "$sitesDir/$filename";
        $config = file_get_contents($path);
        if ($config !== false) {
            $domainRegex = '/^\s*ServerName\s+(.+)$/m';
            $documentRootRegex = '/^\s*DocumentRoot\s+(.+)$/m';
            preg_match($domainRegex, $config, $domainMatches);
            preg_match($documentRootRegex, $config, $documentRootMatches);
            $site = [
                'filename' => $filename,
                'path' => $path,
                'domain' => isset($domainMatches[1]) ? $domainMatches[1] : null,
                'documentRoot' => isset($documentRootMatches[1]) ? $documentRootMatches[1] : null,
            ];
            $sites[] = $site;
        }
    }

    return $sites;
}
// ---------------------------------------------------------------
// This function renderLinks() generates HTML links for each local site in the sites-enabled directory.
// For each site, it generates two links: one with http:// and another with https://.
// It uses the getLocalSites() function to get a list of all the sites in the sites-enabled directory,
// and then generates the links using some string manipulation.
function renderLinks()
{
    ob_start();

    foreach (getLocalSites() as $value) {
        $start = preg_split('/^auto./', $value);
        $end = preg_split('/.conf$/', $start[1]);
        unset($end[1]);

        foreach ($end as $link) {
            $contentHttp = '<a href="http://'.$link.'">';
            $contentHttp .= 'http://'.$link;
            $contentHttp .= '</a>';
            $contentHttps = '<a href="https://'.$link.'">';
            $contentHttps .= 'https://'.$link;
            $contentHttps .= '</a>';

            echo '
            <div class="row w800 my-2">
                <div class="col-md-5 text-truncate tr">'.$contentHttp.' </div>
                <div class="col-2 arrows">&xlArr; &sext; &xrArr;</div>
                <div class="col-md-5 text-truncate tl">'.$contentHttps.'</div>
            </div>
            <hr>
            ';
        }
    }

    return ob_get_clean();
}

// ---------------------------------------------------------------
//  This function checks if the server software running on the current server is Apache or not.
//  It takes one parameter $server which is expected to be a string containing the name of the server,
//  and returns a boolean value.
function checkHttpdServer($server)
{
    if ($server === 'apache') {
        $server = ucfirst($server);
    }

    return preg_match("/^$server/", $_SERVER['SERVER_SOFTWARE']);
}

/*
The $serverInfo variable is assigned the result of the serverInfo() function, which seems to return an array with various pieces of information
about the server, such as the HTTP daemon version, OpenSSL version, PHP version, Xdebug version, and document root.
Overall, it seems like this code is used to check the server and PHP versions and provide information about the server.
The phpinfo() call seems to be used to display more detailed information about the PHP installation, which could be useful
for debugging and troubleshooting purposes.
*/

isset($_GET['q']) ? getQ($_GET['q']) : null;

$phpVer = getPhpVersion();
$serverInfo = serverInfo();

if (!empty($_GET['q'])) {
    switch ($_GET['q']) {
        case 'info':
            phpinfo();
            exit;
            break;
    }
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
                    <div class="overviewcard_info"><img src="favicon_io/2065203.png" style="width:64px;"></div>
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
            $avatar = 'assets/Symphony.png';
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
