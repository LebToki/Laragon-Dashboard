<?php
/**
 * Laragon Dashboard - Databases Page
 * Version: 3.0.0
 * Description: Database management interface
 */

// Load configuration and helpers
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
}

if (file_exists(__DIR__ . '/../includes/helpers.php')) {
    require_once __DIR__ . '/../includes/helpers.php';
}

// Load Adminer Module
if (file_exists(__DIR__ . '/../includes/AdminerModule.php')) {
    require_once __DIR__ . '/../includes/AdminerModule.php';
}

// Load i18n helper
if (file_exists(__DIR__ . '/../includes/i18n.php')) {
    require_once __DIR__ . '/../includes/i18n.php';
}

// Load translations
$databasesTranslations = [];
if (function_exists('load_translations')) {
    $databasesTranslations = load_translations('databases');
}

function t_databases($key, $fallback = '') {
    global $databasesTranslations;
    if (function_exists('t')) {
        $translated = t('databases.' . $key);
        if ($translated !== 'databases.' . $key) {
            return $translated;
        }
    }
    return $databasesTranslations[$key] ?? ($fallback ?: $key);
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_databases('databases', 'Databases'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_databases('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_databases('databases', 'Databases'); ?></li>
            </ul>
        </div>

        <div class="card shadow-none border radius-12">
            <div class="card-body p-24">
                <div class="text-center mb-24">
                    <iconify-icon icon="streamline-plump:database-remix" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                    <strong><p class="fw-semibold mb-8"><?php echo t_databases('mysql_management', 'MySQL Management'); ?></p></strong>
                    <?php
                    $phpmyadminInstalled = isPhpMyAdminInstalled();
                    $adminerInstalled = class_exists('AdminerModule') && isAdminerInstalled();
                    
                    if ($adminerInstalled || $phpmyadminInstalled) {
                        $tools = [];
                        if ($adminerInstalled) {
                            $tools[] = 'Adminer';
                        }
                        if ($phpmyadminInstalled) {
                            $phpmyadminVersion = getPhpMyAdminVersion();
                            $versionText = $phpmyadminVersion ? ' (v' . htmlspecialchars($phpmyadminVersion) . ')' : '';
                            $tools[] = 'phpMyAdmin' . $versionText;
                        }
                        echo '<p class="text-secondary-light mb-16">' . t_databases('db_tools_available', 'Manage your MySQL databases using ' . implode(' or ', $tools)) . '</p>';
                    } else {
                        echo '<p class="text-secondary-light mb-16">' . t_databases('db_tools_not_installed', 'Database administration tools are not installed. Adminer will be downloaded automatically, or you can install phpMyAdmin manually.') . '</p>';
                    }
                    ?>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card shadow-none border radius-12">
                            <div class="card-body p-16">
                                <div class="d-flex align-items-center gap-2 mb-8">
                                    <iconify-icon icon="tabler:database" class="text-primary-600 text-2xl"></iconify-icon>
                                    <strong><p class="fw-semibold mb-0">Adminer</p></strong>
                                </div>
                                <p class="text-secondary-light text-sm mb-16"><?php echo t_databases('adminer_desc', 'Lightweight database administration tool'); ?></p>
                                <?php
                                $adminerInstalled = class_exists('AdminerModule') && isAdminerInstalled();
                                if ($adminerInstalled):
                                    $adminerUrl = getAdminerUrl();
                                ?>
                                    <a href="<?php echo htmlspecialchars($adminerUrl); ?>" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:link-bold" class="icon"></iconify-icon>
                                        <?php echo t_databases('open_adminer', 'Open Adminer'); ?>
                                    </a>
                                    <p class="text-xs text-secondary-light mt-8 mb-0">
                                        <?php echo t_databases('adminer_ready', 'Database administration tool ready'); ?>
                                    </p>
                                <?php else: ?>
                                    <?php
                                    if (class_exists('AdminerModule')) {
                                        $adminer = new AdminerModule();
                                        $downloadResult = $adminer->download();
                                        if ($downloadResult['success']) {
                                            echo '<div class="alert alert-success mb-16">' . htmlspecialchars($downloadResult['message']) . '</div>';
                                            $adminerUrl = $adminer->getUrl();
                                            echo '<a href="' . htmlspecialchars($adminerUrl) . '" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">';
                                            echo '<iconify-icon icon="solar:link-bold" class="icon"></iconify-icon> ';
                                            echo t_databases('open_adminer', 'Open Adminer');
                                            echo '</a>';
                                        } else {
                                            echo '<a href="https://www.adminer.org/latest-mysql.php" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">';
                                            echo '<iconify-icon icon="solar:download-bold" class="icon"></iconify-icon> ';
                                            echo t_databases('download_adminer', 'Download Adminer');
                                            echo '</a>';
                                            echo '<p class="text-xs text-secondary-light mt-8 mb-0">';
                                            echo t_databases('adminer_install_instructions', 'Download and save to: assets/adminer/adminer.php');
                                            echo '</p>';
                                        }
                                    } else {
                                        echo '<a href="https://www.adminer.org/latest-mysql.php" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">';
                                        echo '<iconify-icon icon="solar:download-bold" class="icon"></iconify-icon> ';
                                        echo t_databases('download_adminer', 'Download Adminer');
                                        echo '</a>';
                                    }
                                    ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow-none border radius-12">
                            <div class="card-body p-16">
                                <div class="d-flex align-items-center gap-2 mb-8">
                                    <iconify-icon icon="tabler:brand-mysql" class="text-primary-600 text-2xl"></iconify-icon>
                                    <strong><p class="fw-semibold mb-0">PHPMyAdmin<?php if ($phpmyadminInstalled): ?> <span class="text-success-main text-sm">(detected)</span><?php endif; ?></p></strong>
                                </div>
                                <p class="text-secondary-light text-sm mb-16"><?php echo t_databases('phpmyadmin_desc', 'Web-based MySQL administration tool'); ?></p>
                                <?php if ($phpmyadminInstalled): ?>
                                    <a href="http://localhost/phpmyadmin" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:link-bold" class="icon"></iconify-icon>
                                        <?php echo t_databases('open_phpmyadmin', 'Open PHPMyAdmin'); ?>
                                    </a>
                                    <p class="text-xs text-secondary-light mt-8 mb-0">
                                        <?php 
                                        $phpmyadminVersion = getPhpMyAdminVersion();
                                        if ($phpmyadminVersion) {
                                            echo t_databases('phpmyadmin_version', 'Version: ') . htmlspecialchars($phpmyadminVersion);
                                        } else {
                                            echo t_databases('phpmyadmin_ready', 'PHPMyAdmin is ready to use');
                                        }
                                        ?>
                                    </p>
                                <?php else: ?>
                                    <a href="https://www.phpmyadmin.net/downloads/" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                        <?php echo t_databases('download_phpmyadmin', 'Download phpMyAdmin'); ?>
                                    </a>
                                    <p class="text-xs text-secondary-light mt-8 mb-0">
                                        <?php echo t_databases('install_instructions', 'Download the latest version and extract it to your Laragon www directory (C:\\laragon\\www\\phpmyadmin)'); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card shadow-none border radius-12">
                            <div class="card-body p-16">
                                <strong><p class="fw-semibold mb-8"><?php echo t_databases('features', 'Upcoming Features'); ?></p></strong>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-8 d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:check-circle-bold" class="text-success-main"></iconify-icon>
                                        <span class="text-secondary-light"><?php echo t_databases('feature_db_list', 'Database listing and management'); ?></span>
                                    </li>
                                    <li class="mb-8 d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:check-circle-bold" class="text-success-main"></iconify-icon>
                                        <span class="text-secondary-light"><?php echo t_databases('feature_backup', 'Database backup and restore'); ?></span>
                                    </li>
                                    <li class="mb-8 d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:check-circle-bold" class="text-success-main"></iconify-icon>
                                        <span class="text-secondary-light"><?php echo t_databases('feature_export', 'Export/Import functionality'); ?></span>
                                    </li>
                                    <li class="mb-0 d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:check-circle-bold" class="text-success-main"></iconify-icon>
                                        <span class="text-secondary-light"><?php echo t_databases('feature_query', 'SQL query execution'); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

