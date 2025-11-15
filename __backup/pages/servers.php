<?php
/**
 * Laragon Dashboard - Servers Page
 * Version: 3.0.0
 * Description: Display server information (Apache, PHP, MySQL, etc.)
 */

// Load required files
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

// Load translations
$translations = [];
$lang = strtolower($_GET['lang'] ?? 'en');
$langFile = ASSETS_ROOT . '/languages/' . $lang . '.json';
if (file_exists($langFile)) {
    $translations = json_decode(file_get_contents($langFile), true) ?? [];
} elseif (file_exists(ASSETS_ROOT . '/languages/en.json')) {
    $translations = json_decode(file_get_contents(ASSETS_ROOT . '/languages/en.json'), true) ?? [];
}

// Include layout top
include __DIR__ . '/../includes/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0"><?php echo $translations['header'] ?? 'My Development Server'; ?></h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php?page=servers" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo $translations['servers_tab'] ?? 'Servers'; ?></li>
            </ul>
        </div>

        <div class="row g-3">
            <!-- Apache -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-1 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">Apache</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getApacheVersion()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="devicon-plain:apache" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PHP -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-2 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">PHP</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getCurrentPHPVersion()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="file-icons:php" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MySQL -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-3 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">MySQL</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getMySQLVersion()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-primary-600 rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="tabler:brand-mysql" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OpenSSL -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-4 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">OpenSSL</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getOpenSSLVersion()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-primary-600 rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="fa7-brands:expeditedssl" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PHP SAPI -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-5 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">PHP SAPI</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getPHPSAPI()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="bxl:php" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Root -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-6 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">Document Root</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getDocumentRoot()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="iconoir:internet" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PHPMyAdmin -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-7 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">PHPMyAdmin</p>
                                <h6 class="mb-0">
                                    <a href="<?php echo PHPMYADMIN_URL; ?>" target="_blank" class="hover-text-primary">Manage MySQL</a>
                                </h6>
                            </div>
                            <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="tabler:database-search" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Laragon -->
            <div class="col-lg-3 col-sm-6">
                <div class="card shadow-none border radius-12 bg-gradient-start-8 h-100">
                    <div class="card-body p-16">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                            <div>
                                <p class="fw-medium text-secondary-light mb-1 text-sm">Laragon</p>
                                <h6 class="mb-0"><?php echo htmlspecialchars(getLaragonVersion()); ?></h6>
                            </div>
                            <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                                <iconify-icon icon="mdi:elephant" class="text-white text-2xl mb-0"></iconify-icon>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Include layout bottom
include __DIR__ . '/../includes/layouts/layoutBottom.php';
?>

