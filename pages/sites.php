<?php
/**
 * Laragon Dashboard - Sites (Virtual Hosts) Page
 * Version: 3.0.0
 * Description: Manage Apache virtual hosts with code editor
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
$sitesTranslations = [];
if (function_exists('load_translations')) {
    $sitesTranslations = load_translations('sites');
}

function t_sites($key, $fallback = '') {
    global $sitesTranslations;
    if (function_exists('t')) {
        $translated = t('sites.' . $key);
        if ($translated !== 'sites.' . $key) {
            return $translated;
        }
    }
    return $sitesTranslations[$key] ?? ($fallback ?: $key);
}

// Get Laragon root
$laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
$sitesEnabledDir = $laragonRoot . '/etc/apache2/sites-enabled';
$selectedFile = $_GET['file'] ?? '';

// Get list of virtual host files
$siteFiles = [];
if (is_dir($sitesEnabledDir)) {
    $files = glob($sitesEnabledDir . '/*.conf');
    foreach ($files as $file) {
        $siteFiles[] = [
            'name' => basename($file),
            'path' => $file,
            'size' => filesize($file),
            'modified' => filemtime($file)
        ];
    }
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_sites('sites_enabled', 'Sites Enabled'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_sites('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_sites('sites_enabled', 'Sites Enabled'); ?></li>
            </ul>
        </div>

        <div class="row g-3">
            <!-- File List -->
            <div class="col-lg-4">
                <div class="card shadow-none border radius-12">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center justify-content-between">
                            <strong><p class="fw-semibold mb-0"><?php echo t_sites('virtual_hosts', 'Virtual Hosts'); ?></p></strong>
                            <button type="button" class="btn btn-sm btn-primary-600" onclick="createNewSite()">
                                <iconify-icon icon="solar:add-circle-bold" class="icon"></iconify-icon>
                                <?php echo t_sites('new', 'New'); ?>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <?php if (empty($siteFiles)): ?>
                            <div class="text-center p-24 text-secondary-light">
                                <iconify-icon icon="solar:file-text-bold" class="text-4xl mb-8"></iconify-icon>
                                <p class="mb-0"><?php echo t_sites('no_files', 'No virtual host files found'); ?></p>
                            </div>
                        <?php else: ?>
                            <ul class="list-group radius-8" id="sites-list">
                                <?php 
                                $fileCount = count($siteFiles);
                                $index = 0;
                                foreach ($siteFiles as $file): 
                                    $isActive = $selectedFile === $file['name'];
                                    $isLast = (++$index === $fileCount);
                                    $borderClass = $isLast ? '' : 'border-bottom-0';
                                    // Alternate background: even = bg-neutral-50, odd = bg-base (matching template pattern)
                                    $bgClass = ($index % 2 === 0) ? 'bg-neutral-50' : 'bg-base';
                                    // Override with active state if selected
                                    if ($isActive) {
                                        $bgClass = 'bg-primary-50';
                                    }
                                ?>
                                <li class="list-group-item d-flex align-items-center justify-content-between border text-secondary-light p-16 <?php echo $bgClass; ?> <?php echo $borderClass; ?>" style="cursor: pointer;" onclick="window.location.href='index.php?page=sites&file=<?php echo urlencode($file['name']); ?>'">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="w-32-px h-32-px bg-primary-50 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                            <iconify-icon icon="solar:file-text-bold" class="text-primary-main text-sm"></iconify-icon>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-medium"><?php echo htmlspecialchars($file['name']); ?></p>
                                            <small class="text-secondary-light text-sm"><?php echo date('Y-m-d H:i', $file['modified']); ?></small>
                                        </div>
                                    </div>
                                    <?php if ($isActive): ?>
                                        <span class="text-xs bg-primary-100 text-primary-600 radius-4 px-10 py-2 fw-semibold"><?php echo t_sites('active', 'Active'); ?></span>
                                    <?php else: ?>
                                        <span class="text-xs bg-neutral-100 text-neutral-600 radius-4 px-10 py-2 fw-semibold"><?php echo t_sites('view', 'View'); ?></span>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Code Editor -->
            <div class="col-lg-8">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-0">
                        <div class="p-16 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-semibold mb-0" id="editor-title"><?php echo t_sites('select_file', 'Select a file'); ?></h6>
                                <p class="mb-0 text-secondary-light text-sm" id="editor-path"></p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" id="save-file" onclick="saveFile()" style="display: none;">
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    <?php echo t_sites('save', 'Save'); ?>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" id="refresh-file" onclick="refreshFile()" style="display: none;">
                                    <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                    <?php echo t_sites('refresh', 'Refresh'); ?>
                                </button>
                            </div>
                        </div>
                        <div id="code-editor-container" class="position-relative" style="min-height: 500px;">
                            <?php if (empty($selectedFile)): ?>
                                <div class="p-24 text-center">
                                    <iconify-icon icon="solar:file-text-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                                    <p class="text-secondary-light mb-0"><?php echo t_sites('select_file_message', 'Select a virtual host file from the list to edit'); ?></p>
                                </div>
                            <?php else: ?>
                                <textarea id="code-editor"><?php echo t_sites('loading', 'Loading...'); ?></textarea>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['sitesScript'] = true;
$GLOBALS['selectedFile'] = $selectedFile;
$GLOBALS['sitesEnabledDir'] = $sitesEnabledDir;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

