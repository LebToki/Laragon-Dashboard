<?php
/**
 * Laragon Dashboard - Overview Page
 * Version: 3.0.0
 * Description: Landing page that summarizes server health and critical config values.
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

$laragonConfig = getLaragonConfig();
$apacheVersion = getApacheVersion();
$phpVersion = getCurrentPHPVersion();
$mysqlVersion = getMySQLVersion();
$opensslVersion = getOpenSSLVersion();
$laragonVersion = getLaragonVersion();

$cardData = [
    [
        'meta' => 'Web server',
        'value' => $apacheVersion,
        'description' => 'Apache is responding inside Laragon.',
        'icon' => 'devicon-plain:apache',
        'tone' => 'bg-gradient-start-1',
        'circle' => 'bg-cyan'
    ],
    [
        'meta' => 'Server runtime',
        'value' => $phpVersion,
        'description' => 'PHP reports the configured version.',
        'icon' => 'file-icons:php',
        'tone' => 'bg-gradient-start-2',
        'circle' => 'bg-purple'
    ],
    [
        'meta' => 'Database engine',
        'value' => $mysqlVersion,
        'description' => 'MySQL connection established.',
        'icon' => 'tabler:brand-mysql',
        'tone' => 'bg-gradient-start-3',
        'circle' => 'bg-pink'
    ],
    [
        'meta' => 'Security layer',
        'value' => $opensslVersion,
        'description' => 'OpenSSL is available for encryption.',
        'icon' => 'fa7-brands:expeditedssl',
        'tone' => 'bg-gradient-start-4',
        'circle' => 'bg-success-main'
    ],
    [
        'meta' => 'Laragon build',
        'value' => $laragonVersion,
        'description' => 'Core stack managed by Laragon.',
        'icon' => 'mdi:elephant',
        'tone' => 'bg-gradient-start-5',
        'circle' => 'bg-info-main'
    ],
];

$systemRows = [
    [
        'label' => 'Document root',
        'value' => getDocumentRoot(),
        'icon' => 'iconoir:internet',
        'color' => 'bg-primary-600'
    ],
    [
        'label' => 'PHP SAPI',
        'value' => getPHPSAPI(),
        'icon' => 'solar:device-radar',
        'color' => 'bg-info-main'
    ],
    [
        'label' => 'MySQL host & user',
        'value' => (MYSQL_HOST ?? 'localhost') . ' / ' . (MYSQL_USER ?? 'root'),
        'icon' => 'solar:database',
        'color' => 'bg-success-main'
    ],
    [
        'label' => 'Laragon data dir',
        'value' => $laragonConfig['DataDirectory'] ?? (LARAGON_ROOT . '/data'),
        'icon' => 'solar:database',
        'color' => 'bg-warning-main'
    ],
    [
        'label' => 'App environment',
        'value' => strtoupper(APP_ENV ?? 'development'),
        'icon' => 'solar:small-circle-fill',
        'color' => 'bg-primary-600'
    ],
];

$quickLinks = [
    [
        'label' => 'Servers',
        'description' => 'View Apache, PHP, MySQL and Laragon stats.',
        'url' => 'index.php?page=servers',
        'icon' => 'solar:server-monitor-bold'
    ],
    [
        'label' => 'Services',
        'description' => 'Start/stop daemon-level helpers.',
        'url' => 'index.php?page=services',
        'icon' => 'solar:settings-broad'
    ],
    [
        'label' => 'Logs',
        'description' => 'Review the dashboard access logs.',
        'url' => 'index.php?page=logs',
        'icon' => 'solar:notification',
    ],
];

include __DIR__ . '/../includes/layouts/layoutTop.php';
?>

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <p class="text-lg fw-semibold mb-0">Laragon Overview</p>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php?page=dashboard" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Server Overview</li>
                </ul>
            </div>

            <div class="row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
                <?php foreach ($cardData as $card) : ?>
                    <div class="col">
                        <div class="card shadow-none border <?php echo $card['tone']; ?> h-100">
                            <div class="card-body p-20">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div>
                                        <p class="fw-medium text-primary-light mb-1 text-sm"><?php echo htmlspecialchars($card['meta']); ?></p>
                                        <p class="mb-0 text-lg fw-semibold"><?php echo htmlspecialchars($card['value']); ?></p>
                                    </div>
                                    <div class="w-50-px h-50-px <?php echo $card['circle']; ?> rounded-circle d-flex justify-content-center align-items-center">
                                        <iconify-icon icon="<?php echo $card['icon']; ?>" class="text-white text-2xl"></iconify-icon>
                                    </div>
                                </div>
                                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                                    <?php echo htmlspecialchars($card['description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row gy-4 mt-1">
                <div class="col-xxl-7 col-xl-8">
                    <div class="card h-100 radius-8 border">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-16">
                                <p class="text-lg fw-semibold mb-0">System Snapshot</p>
                                <span class="text-sm fw-semibold text-primary-600"><?php echo date('j M Y'); ?></span>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2 g-3">
                                <?php foreach ($systemRows as $row) : ?>
                                    <div class="col">
                                        <div class="d-flex align-items-center gap-3 p-3 border radius-10">
                                            <span class="w-12-px h-12-px radius-2 <?php echo $row['color']; ?>"></span>
                                            <div class="flex-grow-1">
                                                <p class="text-sm fw-semibold mb-1"><?php echo htmlspecialchars($row['label']); ?></p>
                                                <p class="text-xs mb-0 text-secondary-light"><?php echo htmlspecialchars($row['value']); ?></p>
                                            </div>
                                            <iconify-icon icon="<?php echo $row['icon']; ?>" class="text-xl text-primary-600"></iconify-icon>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-5 col-xl-4">
                    <div class="card h-100 radius-8 border">
                        <div class="card-body">
                            <p class="text-lg fw-semibold mb-12">Quick actions</p>
                            <div class="d-flex flex-column gap-3">
                                <?php foreach ($quickLinks as $link) : ?>
                                    <a href="<?php echo htmlspecialchars($link['url']); ?>" class="d-flex align-items-center gap-3 p-16 border radius-10 text-decoration-none hover-bg-neutral-50">
                                        <div class="w-44-px h-44-px bg-neutral-100 rounded-circle d-flex justify-content-center align-items-center">
                                            <iconify-icon icon="<?php echo $link['icon']; ?>" class="text-2xl text-primary-600"></iconify-icon>
                                        </div>
                                        <div>
                                            <p class="mb-1 fw-semibold text-sm text-black"><?php echo htmlspecialchars($link['label']); ?></p>
                                            <p class="text-xs mb-0 text-secondary-light"><?php echo htmlspecialchars($link['description']); ?></p>
                                        </div>
                                        <iconify-icon icon="solar:alt-arrow-right-bold" class="text-sm text-primary-600 ms-auto"></iconify-icon>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include __DIR__ . '/../includes/layouts/layoutBottom.php'; ?>

