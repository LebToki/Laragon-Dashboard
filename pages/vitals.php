<?php
/**
 * Laragon Dashboard - Server Vitals Page
 * Version: 3.0.0
 * Description: Server monitoring with charts
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

// Load translations
$vitalsTranslations = [];
if (function_exists('load_translations')) {
    $vitalsTranslations = load_translations('vitals');
}

function t_vitals($key, $fallback = '') {
    global $vitalsTranslations;
    if (function_exists('t')) {
        $translated = t('vitals.' . $key);
        if ($translated !== 'vitals.' . $key) {
            return $translated;
        }
    }
    return $vitalsTranslations[$key] ?? ($fallback ?: $key);
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('server_vitals', 'Server Vitals'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_vitals('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_vitals('server_vitals', 'Server Vitals'); ?></li>
            </ul>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-24">
            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div class="d-flex align-items-center gap-2">
                                <span class="mb-0 w-48-px h-48-px bg-primary-100 text-primary-600 flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="solar:cpu-bold" class="text-xl"></iconify-icon>
                                </span>
                                <div>
                                    <p class="fw-semibold mb-2" id="cpu-usage">0%</p>
                                    <span class="fw-medium text-secondary-light text-sm"><?php echo t_vitals('cpu_usage', 'CPU Usage'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div id="cpu-chart-mini" style="height: 50px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div class="d-flex align-items-center gap-2">
                                <span class="mb-0 w-48-px h-48-px bg-success-100 text-success-600 flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="solar:database-bold" class="text-xl"></iconify-icon>
                                </span>
                                <div>
                                    <p class="fw-semibold mb-2" id="memory-usage">0%</p>
                                    <span class="fw-medium text-secondary-light text-sm"><?php echo t_vitals('memory_usage', 'Memory Usage'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div id="memory-chart-mini" style="height: 50px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div class="d-flex align-items-center gap-2">
                                <span class="mb-0 w-48-px h-48-px bg-warning-100 text-warning-600 flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="solar:hard-drive-bold" class="text-xl"></iconify-icon>
                                </span>
                                <div>
                                    <p class="fw-semibold mb-2" id="disk-usage">0%</p>
                                    <span class="fw-medium text-secondary-light text-sm"><?php echo t_vitals('disk_usage', 'Disk Usage'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div id="disk-chart-mini" style="height: 50px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-sm-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-body p-20">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                            <div class="d-flex align-items-center gap-2">
                                <span class="mb-0 w-48-px h-48-px bg-info-100 text-info-600 flex-shrink-0 d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="solar:network-bold" class="text-xl"></iconify-icon>
                                </span>
                                <div>
                                    <p class="fw-semibold mb-2" id="network-status"><?php echo t_vitals('active', 'Active'); ?></p>
                                    <span class="fw-medium text-secondary-light text-sm"><?php echo t_vitals('network', 'Network'); ?></span>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm mb-0">
                            <span class="text-info-600" id="network-speed">0</span> <?php echo t_vitals('mbps', 'Mbps'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1: CPU & Memory -->
        <div class="row g-3 mb-24">
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center justify-content-between mb-16">
                            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('cpu_usage', 'CPU Usage'); ?></p></strong>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-secondary-light text-sm"><?php echo t_vitals('last_24_hours', 'Last 24 Hours'); ?></span>
                            </div>
                        </div>
                        <div id="cpu-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center justify-content-between mb-16">
                            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('memory_usage', 'Memory Usage'); ?></p></strong>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-secondary-light text-sm"><?php echo t_vitals('last_24_hours', 'Last 24 Hours'); ?></span>
                            </div>
                        </div>
                        <div id="memory-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2: Disk Usage & Service Status -->
        <div class="row g-3 mb-24">
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center justify-content-between mb-16">
                            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('disk_usage', 'Disk Usage'); ?></p></strong>
                        </div>
                        <div id="disk-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center justify-content-between mb-16">
                            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('service_status', 'Service Status'); ?></p></strong>
                        </div>
                        <div id="services-chart" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 3: Network Traffic -->
        <div class="row g-3">
            <div class="col-12">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <div class="d-flex align-items-center justify-content-between mb-16">
                            <strong><p class="fw-semibold mb-0"><?php echo t_vitals('network_traffic', 'Network Traffic'); ?></p></strong>
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-secondary-light text-sm"><?php echo t_vitals('last_24_hours', 'Last 24 Hours'); ?></span>
                            </div>
                        </div>
                        <div id="network-chart" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['vitalsScript'] = true;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

