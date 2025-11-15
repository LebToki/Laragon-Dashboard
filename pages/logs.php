<?php
/**
 * Laragon Dashboard - Logs Page
 * Version: 3.0.0
 * Description: Log viewer with code editor
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
$logsTranslations = [];
if (function_exists('load_translations')) {
    $logsTranslations = load_translations('logs');
}

function t_logs($key, $fallback = '') {
    global $logsTranslations;
    if (function_exists('t')) {
        $translated = t('logs.' . $key);
        if ($translated !== 'logs.' . $key) {
            return $translated;
        }
    }
    return $logsTranslations[$key] ?? ($fallback ?: $key);
}

// Get Laragon root
$laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
$selectedLog = $_GET['log'] ?? '';

// Scan for log files dynamically
function scanLogFiles() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    $logFiles = [];
    
    if (empty($laragonRoot) || !is_dir($laragonRoot)) {
        return $logFiles;
    }
    
    // Find Apache installation directory (dynamic version)
    $apacheDirs = glob($laragonRoot . '/bin/apache/httpd-*/logs/error.log');
    $apacheErrorLog = !empty($apacheDirs) ? $apacheDirs[0] : null;
    $apacheAccessLog = null;
    if ($apacheErrorLog) {
        $apacheAccessLog = dirname($apacheErrorLog) . '/access.log';
        if (!file_exists($apacheAccessLog)) {
            $apacheAccessLog = null;
        }
    }
    
    // Find MySQL installation directory (dynamic version)
    $mysqlDirs = glob($laragonRoot . '/data/mysql-*/mysqld.log');
    $mysqlLog = !empty($mysqlDirs) ? $mysqlDirs[0] : null;
    
    // PHP error log
    $phpErrorLog = $laragonRoot . '/tmp/php_errors.log';
    
    // Define log files with actual paths
    $logPatterns = [
        'apache_error' => [
            'name' => t_logs('apache_error_log', 'Apache Error Log'),
            'path' => $apacheErrorLog,
            'icon' => 'devicon-plain:apache',
            'color' => 'danger'
        ],
        'apache_access' => [
            'name' => t_logs('apache_access_log', 'Apache Access Log'),
            'path' => $apacheAccessLog,
            'icon' => 'devicon-plain:apache',
            'color' => 'primary'
        ],
        'php' => [
            'name' => t_logs('php_logs', 'PHP Error Log'),
            'path' => file_exists($phpErrorLog) ? $phpErrorLog : null,
            'icon' => 'file-icons:php',
            'color' => 'purple'
        ],
        'mysql' => [
            'name' => t_logs('mysql_logs', 'MySQL Log'),
            'path' => $mysqlLog,
            'icon' => 'tabler:brand-mysql',
            'color' => 'info'
        ]
    ];
    
    // Only add log files that exist
    foreach ($logPatterns as $key => $pattern) {
        if (!empty($pattern['path']) && file_exists($pattern['path']) && is_readable($pattern['path'])) {
            $logFiles[$key] = [
                'name' => $pattern['name'],
                'path' => $pattern['path'],
                'icon' => $pattern['icon'] ?? 'solar:file-text-bold',
                'color' => $pattern['color'] ?? 'secondary'
            ];
        }
    }
    
    return $logFiles;
}

$logFiles = scanLogFiles();

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0"><?php echo t_logs('logs', 'Logs'); ?></h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_logs('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_logs('logs', 'Logs'); ?></li>
            </ul>
        </div>

        <div class="row g-3">
            <!-- Log List (col-4) -->
            <div class="col-lg-4">
                <div class="card h-100 p-0">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0"><?php echo t_logs('log_files', 'Log Files'); ?></h6>
                    </div>
                    <div class="card-body p-24">
                        <ul class="list-group radius-8" id="log-list">
                            <?php 
                            $logCount = count($logFiles);
                            $index = 0;
                            foreach ($logFiles as $key => $log): 
                                $isActive = $selectedLog === $key;
                                $isLast = (++$index === $logCount);
                                $borderClass = $isLast ? '' : 'border-bottom-0';
                                // Alternate background: even = bg-neutral-50, odd = bg-base (matching template pattern)
                                $bgClass = ($index % 2 === 0) ? 'bg-neutral-50' : 'bg-base';
                                // Override with active state if selected
                                if ($isActive) {
                                    $bgClass = 'bg-primary-50';
                                }
                            ?>
                            <li class="list-group-item d-flex align-items-center justify-content-between border text-secondary-light p-16 <?php echo $bgClass; ?> <?php echo $borderClass; ?>" style="cursor: pointer;" onclick="window.location.href='index.php?page=logs&log=<?php echo htmlspecialchars($key); ?>'">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="w-32-px h-32-px bg-<?php echo $log['color']; ?>-50 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                        <iconify-icon icon="<?php echo htmlspecialchars($log['icon']); ?>" class="text-<?php echo $log['color']; ?>-main text-sm"></iconify-icon>
                                    </div>
                                    <span><?php echo htmlspecialchars($log['name']); ?></span>
                                </div>
                                <?php if ($isActive): ?>
                                    <span class="text-xs bg-primary-100 text-primary-600 radius-4 px-10 py-2 fw-semibold"><?php echo t_logs('active', 'Active'); ?></span>
                                <?php else: ?>
                                    <span class="text-xs bg-neutral-100 text-neutral-600 radius-4 px-10 py-2 fw-semibold"><?php echo t_logs('view', 'View'); ?></span>
                                <?php endif; ?>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Code Viewer (col-8) -->
            <div class="col-lg-8">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-0">
                        <div class="p-16 border-bottom d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-semibold mb-0" id="log-viewer-title"><?php echo t_logs('select_log', 'Select a log file'); ?></h6>
                                <p class="mb-0 text-secondary-light text-sm" id="log-viewer-path"></p>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" id="refresh-log">
                                    <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                    <?php echo t_logs('refresh', 'Refresh'); ?>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" id="clear-log">
                                    <iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon>
                                    <?php echo t_logs('clear', 'Clear'); ?>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" id="download-log">
                                    <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                    <?php echo t_logs('download', 'Download'); ?>
                                </button>
                            </div>
                        </div>
                        <div id="code-viewer-container" class="position-relative" style="min-height: 500px;">
                            <?php if (empty($selectedLog)): ?>
                                <div class="p-24 text-center">
                                    <iconify-icon icon="solar:file-text-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                                    <p class="text-secondary-light mb-0"><?php echo t_logs('select_log_message', 'Select a log file from the list to view its contents'); ?></p>
                                </div>
                            <?php else: ?>
                                <textarea id="code-viewer"><?php echo t_logs('loading', 'Loading...'); ?></textarea>
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
$GLOBALS['logsScript'] = true;
$GLOBALS['selectedLog'] = $selectedLog;
$GLOBALS['logFiles'] = $logFiles;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

