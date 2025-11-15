<?php
/**
 * Laragon Dashboard - Tools Page
 * Version: 3.0.0
 * Description: Quick tools and utilities
 */

require_once __DIR__ . '/../config.php';

// Load translations
$translations = [];
$lang = strtolower($_GET['lang'] ?? 'en');
$langFile = ASSETS_ROOT . '/languages/' . $lang . '.json';
if (file_exists($langFile)) {
    $translations = json_decode(file_get_contents($langFile), true) ?? [];
} elseif (file_exists(ASSETS_ROOT . '/languages/en.json')) {
    $translations = json_decode(file_get_contents(ASSETS_ROOT . '/languages/en.json'), true) ?? [];
}

include __DIR__ . '/../includes/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0"><?php echo $translations['tools_tab'] ?? 'Tools'; ?></h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php?page=servers" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo $translations['tools_tab'] ?? 'Tools'; ?></li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body p-24">
                <p class="text-secondary-light">Tools page - Coming soon</p>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/layouts/layoutBottom.php'; ?>

