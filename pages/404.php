<?php
/**
 * Laragon Dashboard - 404 Page Not Found
 * Version: 3.0.0
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
$commonTranslations = [];
if (function_exists('load_translations')) {
    $commonTranslations = load_translations('common');
}

function t_common($key, $fallback = '') {
    global $commonTranslations;
    if (function_exists('t')) {
        $translated = t('common.' . $key);
        if ($translated !== 'common.' . $key) {
            return $translated;
        }
    }
    return $commonTranslations[$key] ?? ($fallback ?: $key);
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_common('page_not_found', 'Page Not Found'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_common('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">404</li>
            </ul>
        </div>

        <div class="card shadow-none border radius-12">
            <div class="card-body p-24">
                <div class="text-center">
                    <iconify-icon icon="solar:file-remove-outline" class="text-secondary-light text-6xl mb-24"></iconify-icon>
                    <strong><p class="fw-semibold mb-8"><?php echo t_common('page_not_found', '404 - Page Not Found'); ?></p></strong>
                    <p class="text-secondary-light mb-24"><?php echo t_common('page_not_found_desc', 'The requested page could not be found.'); ?></p>
                    <a href="index.php" class="btn btn-primary-600">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon"></iconify-icon>
                        <?php echo t_common('go_to_dashboard', 'Go to Dashboard'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

