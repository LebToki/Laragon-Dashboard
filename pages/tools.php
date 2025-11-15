<?php
/**
 * Laragon Dashboard - Tools Page
 * Version: 3.0.0
 * Description: Development tools and utilities
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
$toolsTranslations = [];
if (function_exists('load_translations')) {
    $toolsTranslations = load_translations('tools');
}

function t_tools($key, $fallback = '') {
    global $toolsTranslations;
    if (function_exists('t')) {
        $translated = t('tools.' . $key);
        if ($translated !== 'tools.' . $key) {
            return $translated;
        }
    }
    return $toolsTranslations[$key] ?? ($fallback ?: $key);
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_tools('tools', 'Tools'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_tools('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_tools('tools', 'Tools'); ?></li>
            </ul>
        </div>

        <!-- Project Selector -->
        <div class="card shadow-none border radius-12 mb-24">
            <div class="card-body p-24">
                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-8"><?php echo t_tools('select_project', 'Select Project'); ?></label>
                        <select class="form-select" id="project-select">
                            <option value=""><?php echo t_tools('select_project', 'Select a project...'); ?></option>
                            <?php
                            $allProjects = [];
                            if (function_exists('getAllProjects')) {
                                $allProjects = getAllProjects();
                            }
                            foreach ($allProjects as $project): ?>
                                <option value="<?php echo htmlspecialchars($project['name']); ?>">
                                    <?php echo htmlspecialchars($project['name']); ?> (<?php echo htmlspecialchars($project['platform']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary-600" onclick="showPhpInfo()">
                            <iconify-icon icon="solar:code-bold" class="icon"></iconify-icon>
                            <?php echo t_tools('view_php_info', 'View PHP Info'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <!-- Composer Tools -->
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="devicon-plain:composer" class="text-xl text-primary-600"></iconify-icon>
                            <strong><p class="fw-semibold mb-0"><?php echo t_tools('composer', 'Composer'); ?></p></strong>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <div class="d-flex flex-wrap gap-2 mb-16">
                            <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="runComposer('install')">
                                <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                Install
                            </button>
                            <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="runComposer('update')">
                                <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                Update
                            </button>
                            <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="runComposer('dump-autoload')">
                                <iconify-icon icon="solar:file-text-bold" class="icon"></iconify-icon>
                                Dump Autoload
                            </button>
                            <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="runComposer('clear-cache')">
                                <iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon>
                                Clear Cache
                            </button>
                        </div>
                        <div id="composer-output" class="bg-neutral-50 p-16 radius-8" style="min-height: 100px; max-height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px; display: none;">
                            <pre class="mb-0 text-sm" id="composer-output-text"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NPM Tools -->
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="devicon-plain:npm" class="text-xl text-danger-600"></iconify-icon>
                            <strong><p class="fw-semibold mb-0"><?php echo t_tools('npm', 'NPM'); ?></p></strong>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <div class="d-flex flex-wrap gap-2 mb-16">
                            <button type="button" class="btn btn-sm btn-danger-100 text-danger-600" onclick="runNPM('install')">
                                <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                Install
                            </button>
                            <button type="button" class="btn btn-sm btn-danger-100 text-danger-600" onclick="runNPM('update')">
                                <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                Update
                            </button>
                            <button type="button" class="btn btn-sm btn-danger-100 text-danger-600" onclick="runNPM('run', 'build')">
                                <iconify-icon icon="solar:settings-bold" class="icon"></iconify-icon>
                                Build
                            </button>
                            <button type="button" class="btn btn-sm btn-danger-100 text-danger-600" onclick="runNPM('run', 'dev')">
                                <iconify-icon icon="solar:code-bold" class="icon"></iconify-icon>
                                Dev
                            </button>
                        </div>
                        <div id="npm-output" class="bg-neutral-50 p-16 radius-8" style="min-height: 100px; max-height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px; display: none;">
                            <pre class="mb-0 text-sm" id="npm-output-text"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Git Tools -->
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="devicon-plain:git" class="text-xl text-warning-600"></iconify-icon>
                            <strong><p class="fw-semibold mb-0"><?php echo t_tools('git', 'Git'); ?></p></strong>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <div class="d-flex flex-wrap gap-2 mb-16">
                            <button type="button" class="btn btn-sm btn-warning-100 text-warning-600" onclick="runGit('status')">
                                <iconify-icon icon="solar:info-circle-bold" class="icon"></iconify-icon>
                                Status
                            </button>
                            <button type="button" class="btn btn-sm btn-warning-100 text-warning-600" onclick="runGit('branch')">
                                <iconify-icon icon="solar:branching-bold" class="icon"></iconify-icon>
                                Branch
                            </button>
                            <button type="button" class="btn btn-sm btn-warning-100 text-warning-600" onclick="runGit('log')">
                                <iconify-icon icon="solar:history-bold" class="icon"></iconify-icon>
                                Log
                            </button>
                            <button type="button" class="btn btn-sm btn-warning-100 text-warning-600" onclick="runGit('pull')">
                                <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                Pull
                            </button>
                        </div>
                        <div id="git-output" class="bg-neutral-50 p-16 radius-8" style="min-height: 100px; max-height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px; display: none;">
                            <pre class="mb-0 text-sm" id="git-output-text"></pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cache Clearing -->
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:trash-bin-trash-bold" class="text-xl text-success-600"></iconify-icon>
                            <strong><p class="fw-semibold mb-0"><?php echo t_tools('cache_clearing', 'Cache Clearing'); ?></p></strong>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <div class="d-flex flex-wrap gap-2 mb-16">
                            <button type="button" class="btn btn-sm btn-success-100 text-success-600" onclick="clearCache('laravel')">
                                <iconify-icon icon="devicon-plain:laravel" class="icon"></iconify-icon>
                                Laravel Cache
                            </button>
                            <button type="button" class="btn btn-sm btn-success-100 text-success-600" onclick="clearCache('wordpress')">
                                <iconify-icon icon="devicon-plain:wordpress" class="icon"></iconify-icon>
                                WordPress Cache
                            </button>
                            <button type="button" class="btn btn-sm btn-success-100 text-success-600" onclick="clearCache('all')">
                                <iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon>
                                All Caches
                            </button>
                        </div>
                        <div id="cache-output" class="bg-neutral-50 p-16 radius-8" style="min-height: 100px; max-height: 300px; overflow-y: auto; font-family: monospace; font-size: 12px; display: none;">
                            <pre class="mb-0 text-sm" id="cache-output-text"></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['toolsScript'] = true;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

