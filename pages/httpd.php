<?php
/**
 * Laragon Dashboard - Apache Configuration Page
 * Version: 3.0.0
 * Description: Edit httpd.conf with code editor
 */

// Load configuration and helpers
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

if (file_exists(__DIR__ . '/../includes/helpers.php')) {
    require_once __DIR__ . '/../includes/helpers.php';
}

// Load i18n helper
if (file_exists(__DIR__ . '/../includes/i18n.php')) {
    require_once __DIR__ . '/../includes/i18n.php';
}

// Get Laragon root
$laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';

// Find Apache httpd.conf dynamically
$apacheConfs = glob($laragonRoot . '/bin/apache/httpd-*/conf/httpd.conf');
$httpdConf = !empty($apacheConfs) ? $apacheConfs[0] : null;

// Get PHP and MySQL ini paths
$phpIniPath = getPHPIniPath();
$mysqlIniPath = getMySQLIniPath();

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0">Server Configuration</p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
            </ul>
        </div>

        <!-- Tabs -->
        <div class="card shadow-none border radius-12">
            <div class="card-body p-24 pt-10">
                <ul class="nav button-tab nav-pills mb-16" id="server-config-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10 active" id="apache-tab" data-bs-toggle="pill" data-bs-target="#apache" type="button" role="tab" aria-controls="apache" aria-selected="true">
                            <iconify-icon icon="solar:server-path-bold" class="text-xl"></iconify-icon>
                            <span class="line-height-1">Apache</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" id="php-tab" data-bs-toggle="pill" data-bs-target="#php" type="button" role="tab" aria-controls="php" aria-selected="false" tabindex="-1">
                            <iconify-icon icon="solar:code-bold" class="text-xl"></iconify-icon>
                            <span class="line-height-1">PHP</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center gap-2 fw-semibold text-primary-light radius-4 px-16 py-10" id="mysql-tab" data-bs-toggle="pill" data-bs-target="#mysql" type="button" role="tab" aria-controls="mysql" aria-selected="false" tabindex="-1">
                            <iconify-icon icon="solar:database-bold" class="text-xl"></iconify-icon>
                            <span class="line-height-1">MySQL</span>
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="server-config-tabsContent">
                    <!-- Apache Tab -->
                    <div class="tab-pane fade show active" id="apache" role="tabpanel">
                        <div class="card shadow-none border radius-12">
                    <div class="card-body p-0">
                        <div class="p-16 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <strong><p class="fw-semibold mb-0">httpd.conf</p></strong>
                                <p class="mb-0 text-secondary-light text-sm" id="httpd-path"><?php echo $httpdConf ? htmlspecialchars($httpdConf) : 'File not found'; ?></p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="saveConfig('httpd')" <?php echo $httpdConf ? '' : 'disabled'; ?>>
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    Save
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="reloadApache()">
                                    <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                    Reload Apache
                                </button>
                            </div>
                        </div>
                        <div id="httpd-editor-container" class="position-relative" style="min-height: 500px;">
                            <?php if ($httpdConf && file_exists($httpdConf)): ?>
                                <textarea id="httpd-editor">Loading...</textarea>
                            <?php else: ?>
                                <div class="p-24 text-center">
                                    <iconify-icon icon="solar:file-text-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                                    <p class="text-secondary-light mb-0">Apache httpd.conf file not found</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- PHP Tab -->
                    <div class="tab-pane fade" id="php" role="tabpanel">
                        <div class="card shadow-none border radius-12">
                    <div class="card-body p-0">
                        <div class="p-16 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <strong><p class="fw-semibold mb-0">php.ini</p></strong>
                                <p class="mb-0 text-secondary-light text-sm" id="php-ini-path"><?php echo $phpIniPath ? htmlspecialchars($phpIniPath) : 'File not found'; ?></p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="saveConfig('php')" <?php echo $phpIniPath ? '' : 'disabled'; ?>>
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    Save
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="reloadPHP()">
                                    <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                    Reload PHP
                                </button>
                            </div>
                        </div>
                        <div id="php-editor-container" class="position-relative" style="min-height: 500px;">
                            <?php if ($phpIniPath && file_exists($phpIniPath)): ?>
                                <textarea id="php-editor">Loading...</textarea>
                            <?php else: ?>
                                <div class="p-24 text-center">
                                    <iconify-icon icon="solar:file-text-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                                    <p class="text-secondary-light mb-0">PHP php.ini file not found</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- MySQL Tab -->
                    <div class="tab-pane fade" id="mysql" role="tabpanel">
                        <div class="card shadow-none border radius-12">
                    <div class="card-body p-0">
                        <div class="p-16 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <strong><p class="fw-semibold mb-0">my.ini</p></strong>
                                <p class="mb-0 text-secondary-light text-sm" id="mysql-ini-path"><?php echo $mysqlIniPath ? htmlspecialchars($mysqlIniPath) : 'File not found'; ?></p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="saveConfig('mysql')" <?php echo $mysqlIniPath ? '' : 'disabled'; ?>>
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    Save
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="reloadMySQL()">
                                    <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                    Reload MySQL
                                </button>
                            </div>
                        </div>
                        <div id="mysql-editor-container" class="position-relative" style="min-height: 500px;">
                            <?php if ($mysqlIniPath && file_exists($mysqlIniPath)): ?>
                                <textarea id="mysql-editor">Loading...</textarea>
                            <?php else: ?>
                                <div class="p-24 text-center">
                                    <iconify-icon icon="solar:file-text-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                                    <p class="text-secondary-light mb-0">MySQL my.ini file not found</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['httpdScript'] = true;
$GLOBALS['httpdConf'] = $httpdConf;
$GLOBALS['phpIniPath'] = $phpIniPath;
$GLOBALS['mysqlIniPath'] = $mysqlIniPath;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

