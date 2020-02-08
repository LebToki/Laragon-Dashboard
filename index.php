<?php
// get page for phpinfo
function getQ($getQ)
{
    if (!empty($getQ)) {
        switch ($getQ) {
            case 'info':
                phpinfo();
                exit;
                break;
        }
    }
}

// Get PHP extensions
function getServerExtensions($server)
{
    $ext = [];

    switch ($server) {
        case 'php':
            $ext = get_loaded_extensions();
            break;
        case 'apache':
            $ext = apache_get_modules();
            break;
    }

    sort($ext, SORT_STRING);
    $ext = array_chunk($ext, 2);

    return $ext;
}

// Check PHP version
function getPhpVersion()
{
    // get last version from php.net
    $json = @file_get_contents("https://www.php.net/releases/index.php?json&version=7.4");
    $data = json_decode($json);
    $lastVersion = $data->version;

    // get current installed version
    $phpVersion = phpversion();

    // Remove dot character from version ex: 1.2.3 to 123 and convert string to integer
    $intLastVersion = (int)str_replace('.', '', $lastVersion);
    $intCurVersion = (int)str_replace('.', '', $phpVersion);

    return [
        'lastVersion' => $lastVersion,
        'currentVersion' => $phpVersion,
        'intLastVer' => $intLastVersion,
        'intCurVer' => $intCurVersion
    ];
}

// Httpd Versions
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
    ];
}

// get SQL version
function getSQLVersion()
{
    $output = shell_exec('mysql -V');
    preg_match('@[0-9]+\.[0-9]+\.[0-9-\w]+@', $output, $version);
    return $version[0];
}

// PHP links
function phpDlLink($version)
{
    $changelog = 'https://www.php.net/ChangeLog-7.php#' . $version;
    $downLink = 'https://windows.php.net/downloads/releases/php-' . $version . '-Win32-VC15-x64.zip';

    return [
        'changeLog' => $changelog,
        'downLink' => $downLink
    ];
}

// define sites-enabled directory
function getSiteDir()
{
    if (preg_match("/^Apache/", $_SERVER['SERVER_SOFTWARE'])) {
        return "../laragon/etc/apache2/sites-enabled";
    } else {
        return "../laragon/etc/nginx/sites-enabled";
    }
}

// get local sites list and remove unwanted values
function getLocalSites()
{
    // get sites-enabled directory
    $sitesDir = getSiteDir();
    // scan all files in the directory
    $scanDir = scandir($sitesDir);
    // remove unwanted files ('.', '..', '00-default.conf' by default)
    $rmItems = [
        '.',
        '..',
        '00-default.conf'
    ];

    foreach ($rmItems as $key => $value) {
        $line = array_search($value, $scanDir);
        unset($scanDir[$line]);
    }

    return $scanDir;
}

// Render list of links
function renderLinks()
{
    ob_start();

    foreach (getLocalSites() as $value) {

        $start = preg_split('/^auto./', $value);
        $end = preg_split('/.conf$/', $start[1]);
        unset($end[1]);

        foreach ($end as $link) {
            $contentHttp = '<a href="http://' . $link . '">';
            $contentHttp .= 'http://' . $link;
            $contentHttp .= '</a>';
            $contentHttps = '<a href="https://' . $link . '">';
            $contentHttps .= 'https://' . $link;
            $contentHttps .= '</a>';

            echo '
            <div class="row w800 my-2">
                <div class="col-md-5 text-truncate tr">' . $contentHttp . ' </div>
                <div class="col-2 arrows">&xlArr; &sext; &xrArr;</div>
                <div class="col-md-5 text-truncate tl">' . $contentHttps . '</div>
            </div>
            <hr>
        ';
        }
    }

    return ob_get_clean();
}

// check is server is Apache/nginx
function checkHttpdServer($server)
{
    if ($server === 'apache') {
        $server = ucfirst($server);
    }

    return preg_match("/^$server/", $_SERVER['SERVER_SOFTWARE']);
}

// ----

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

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
        menuIconEl.on('click', function () {
            toggleClassName(sidenavEl, 'active');
        });

        // Close the side nav on click
        sidenavCloseEl.on('click', function () {
            toggleClassName(sidenavEl, 'active');
        });
    </script>

    <style>

        body {
            margin: 0;
            padding: 0;
            color: #fff;
            font-family: 'Open Sans', Helvetica, sans-serif;
            box-sizing: border-box;
        }

        /* Assign grid instructions to our parent grid container, mobile-first (hide the sidenav) */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr;
            grid-template-rows: 50px 1fr 50px;
            grid-template-areas: 'header' 'main' 'footer';
            height: 100vh;
        }

        

        /* Give every child element its grid name */
        .header {
            grid-area: header;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            color: aliceblue;
            background-color: #30336b;
        }

        .main {
            grid-area: main;
            background-color: #34495e;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            padding: 20px;
            height: 150px;
            background-color: #e3e4e6;
            color: #c0392b;
        }

        .main-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
            grid-auto-rows: 94px;
            grid-gap: 20px;
            margin: 20px;
        }

        .overviewcard {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #d3d3;
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
            background-color: #2c3e50;
            margin-bottom: 20px;
            -webkit-column-break-inside: avoid;
            padding: 24px;
            box-sizing: border-box;
        }

        /* Force varying heights to simulate dynamic content */
        .card:first-child {
            height: 300px;
        }

        .card:nth-child(2) {
            height: 200px;
        }

        .card:nth-child(3) {
            height: 265px;
        }

        .sites {
            display: grid;
            grid-template-columns: 275px 275px 275px 275px;
            grid-gap: 24px;
        }

        .sites li {
            display: block;
            background: #323845;
            box-shadow: 0 0 10px 0 #ccc;
            height: 48px;
            line-height: 48px;
            width: 275px;
            text-align: left;
            text-transform: uppercase;
            font-family: 'Open Sans', sans-serif;
            font-size: 16px;
            transition: box-shadow 250ms ease-in-out;
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
            margin: 8px;
            margin-left: -40px;
            fill: #f2f2f2;
            transition: fill 250ms ease-in-out;
        }

        .sites svg {
            position: absolute;
            margin: 16px;
            margin-left: -40px;
            fill: #f2f2f2;
            transition: fill 250ms ease-in-out;
        }

        .footer {
            grid-area: footer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 16px;
            background-color: #c0392b;
        }

        /* Non-mobile styles, 750px breakpoint */
        @media only screen and (min-width: 46.875em) {
            /* Show the sidenav */
            /*.grid-container {*/
            /*    grid-template-columns: 240px 1fr;*/
            /*    grid-template-areas: "sidenav header" "sidenav main" "sidenav footer";*/
            /*}*/

        }

        /* Medium screens breakpoint (1050px) */
        @media only screen and (min-width: 65.625em) {
            /* Break out main cards into two columns */
            .main-cards {
                column-count: 1;
            }
        }

    </style>
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


    <main class="main">

        <div class="main-overview">
            <div class="overviewcard">
                <div class="overviewcard__icon"></div>
                <div class="overviewcard__info"><?php print($_SERVER['SERVER_SOFTWARE']); ?></div>
            </div>
            <div class="overviewcard">
                <div class="overviewcard__icon"></div>
                <div class="overviewcard__info"><?= $serverInfo['openSsl']; ?></div>
            </div>
            <div class="overviewcard">
                <div class="overviewcard__icon">PHP</div>
                <div class="overviewcard__info"><?php print phpversion(); ?></div>
            </div>
            <div class="overviewcard">
                <div class="overviewcard__icon">Document Root</div>
                <div class="overviewcard__info"><?php print ($_SERVER['DOCUMENT_ROOT']); ?></div>
            </div>
        </div>
        <div class="main-overview">
            <div class="overviewcard">
                <div class="overviewcard__icon">MySQL</div>
                <div class="overviewcard__info"><?php
                    error_reporting(0);

                    $laraconfig = parse_ini_file('../usr/laragon.ini');

                    $link = mysqli_connect('localhost', 'root', $laraconfig['MySQLRootPassword']);
                    if (!$link) $link = mysqli_connect('localhost', 'root', 'ADD PASSWORD HERE');
                    if (!$link) {
                        echo 'MySQL not running!';
                    } else {
                        printf("server version: %s\n", mysqli_get_server_info($link));
                    }
                    ?>
                </div>
            </div>

            <div class="overviewcard">
                <div class="overviewcard__icon">.</div>
                <div class="overviewcard__info">.</div>
            </div>

            <div class="overviewcard">
                <div class="overviewcard__icon">.</div>
                <div class="overviewcard__info">.</div>
            </div>

            <div class="overviewcard">
                <div class="overviewcard__icon">Laragon</div>
                <div class="overviewcard__info">Full 4.0.11</div>
            </div>
        </div>


        <div class="main-cards">
            <div class="card">
                <div class="opt">
                    <?php
                    $folders = array_filter(glob('*'), 'is_dir');

                    if ($laraconfig['SSLEnabled'] == 0 || $laraconfig['Port'] == 80) $url = 'http';
                    else $url = 'https';

                    echo '<ul class="sites">';
                    foreach ($folders as $host) {
                        if (file_exists($host . '/favicon.png')) $favicon = '<img src="./' . $host . '/favicon.png" width="32" height="32"/>';
                        elseif (file_exists($host . '/favicon.ico')) $favicon = '<img src="./' . $host . '/favicon.ico" width="32" height="32"/>';
                        else $favicon = '<svg width="16px" height="16px" viewBox="0 0 19 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:1.41421;"><path d="M6.073,1.44l-1.206,1.206l6.853,6.854l-6.853,6.852l1.206,1.207l8.06,-8.059l-8.06,-8.06Z" style="fill-rule:nonzero;"/></svg>';
                        echo '<li><a href="' . $url . '://' . $host . '.oo">' . $favicon . ' ' . $host . '</a></li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
            </div>

    </main>

    <footer class="footer">
        <div class="footer__copyright">&copy; 2020 Tarek Tarabichi</div>
        <div class="footer__signature">Made with love and powered by Laragon</div>
    </footer>
</div>
</body>
</html>
