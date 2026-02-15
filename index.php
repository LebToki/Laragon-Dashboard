<?php
// Load configuration and helpers first
// Note: helpers.php now includes i18n.php internally
// Load autoloader first to ensure classes are available
if (file_exists(__DIR__ . '/includes/autoload.php')) {
    require_once __DIR__ . '/includes/autoload.php';
}

// Load configuration and helpers
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

if (file_exists(__DIR__ . '/includes/helpers.php')) {
    require_once __DIR__ . '/includes/helpers.php';
}

// Enforce authentication
if (function_exists('check_auth')) {
    check_auth();
}

// i18n is now included via helpers.php - no need to include separately
// This prevents double-inclusion issues

// Rate limiting check
if (defined('RATE_LIMIT_REQUESTS_PER_MINUTE') && RATE_LIMIT_REQUESTS_PER_MINUTE > 0) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $cacheDir = __DIR__ . '/cache/rate_limit';
    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0755, true);
    }
    $cacheFile = $cacheDir . '/' . md5($ip) . '.json';
    
    $currentTime = time();
    $windowSize = 60; // 1 minute window
    
    if (file_exists($cacheFile)) {
        $data = json_decode(file_get_contents($cacheFile), true);
        if ($data && isset($data['time']) && $data['time'] > $currentTime - $windowSize) {
            if (isset($data['count']) && $data['count'] >= RATE_LIMIT_REQUESTS_PER_MINUTE) {
                http_response_code(429);
                die('Too many requests. Please try again later.');
            }
            $data['count']++;
        } else {
            $data = ['time' => $currentTime, 'count' => 1];
        }
    } else {
        $data = ['time' => $currentTime, 'count' => 1];
    }
    
    file_put_contents($cacheFile, json_encode($data));
}

// Simple page routing
$page = $_GET['page'] ?? '';

// If page is specified, load it
if (!empty($page)) {
    // Sanitize page name (prevent directory traversal)
    $page = basename($page);
    $page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);
    
    // List of valid pages
    $validPages = [
        'dashboard', 'projects', 'databases', 'services', 'vitals',
        'mailbox', 'logs', 'tools', 'backup', 'sites', 'httpd', 'preferences',
        'config_editor'
    ];
    
    // Validate page exists
    if (in_array(strtolower($page), $validPages)) {
        $pageFile = __DIR__ . '/pages/' . strtolower($page) . '.php';
        
        // Verify file exists
        if (file_exists($pageFile)) {
            // Enable error reporting temporarily for debugging (only if APP_DEBUG is true)
            if (defined('APP_DEBUG') && APP_DEBUG) {
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
            }
            
            try {
                include $pageFile;
                exit;
            } catch (Exception $e) {
                // If there's an error, show it in debug mode, otherwise show 404
                if (defined('APP_DEBUG') && APP_DEBUG) {
                    \LaragonDashboard\Core\Logger::error("Page load error ($page): " . $e->getMessage());
                    http_response_code(500);
                    echo '<h1>Error Loading Page</h1>';
                    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
                    echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
                } else {
                    http_response_code(404);
                    if (file_exists(__DIR__ . '/pages/404.php')) {
                        include __DIR__ . '/pages/404.php';
                    } else {
                        include __DIR__ . '/partials/layouts/layoutTop.php';
                        echo '<div class="dashboard-main-body"><div class="container-fluid"><div class="card shadow-none border radius-12"><div class="card-body p-24 text-center"><h6 class="fw-semibold mb-16">404 - Page Not Found</h6><p class="text-secondary-light mb-16">The requested page could not be found.</p><a href="index.php" class="btn btn-primary-600">Go to Dashboard</a></div></div></div></div>';
                        include __DIR__ . '/partials/layouts/layoutBottom.php';
                    }
                }
                exit;
            }
        } else {
            // File doesn't exist - show 404
            http_response_code(404);
            if (file_exists(__DIR__ . '/pages/404.php')) {
                include __DIR__ . '/pages/404.php';
            } else {
                include __DIR__ . '/partials/layouts/layoutTop.php';
                echo '<div class="dashboard-main-body"><div class="container-fluid"><div class="card shadow-none border radius-12"><div class="card-body p-24 text-center"><h6 class="fw-semibold mb-16">404 - Page Not Found</h6><p class="text-secondary-light mb-16">The requested page file does not exist: ' . htmlspecialchars($pageFile) . '</p><a href="index.php" class="btn btn-primary-600">Go to Dashboard</a></div></div></div></div>';
                include __DIR__ . '/partials/layouts/layoutBottom.php';
            }
            exit;
        }
    }
    
    // Page not found - show 404
    http_response_code(404);
    if (file_exists(__DIR__ . '/pages/404.php')) {
        include __DIR__ . '/pages/404.php';
    } else {
        // Simple 404 fallback
        include __DIR__ . '/partials/layouts/layoutTop.php';
        echo '<div class="dashboard-main-body"><div class="container-fluid"><div class="card shadow-none border radius-12"><div class="card-body p-24 text-center"><h6 class="fw-semibold mb-16">404 - Page Not Found</h6><p class="text-secondary-light mb-16">The requested page "' . htmlspecialchars($page) . '" is not valid.</p><a href="index.php" class="btn btn-primary-600">Go to Dashboard</a></div></div></div></div>';
        include __DIR__ . '/partials/layouts/layoutBottom.php';
    }
    exit;
}

// Default: show dashboard (no page parameter)

include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <div class="d-flex align-items-center gap-3">
            <h6 class="fw-semibold mb-0">Dashboard</h6>
            <button type="button" class="btn btn-primary-600 btn-sm radius-8 px-16 py-8 d-flex align-items-center gap-2" onclick="checkForUpdates(true);">
                <iconify-icon icon="solar:refresh-bold" class="text-lg"></iconify-icon>
                Check for Updates
            </button>
        </div>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium" id="time-greeting">Good Evening</li>
        </ul>

        <div class="row g-3">
        
    <!-- Apache -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-1 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">Apache</p>
                        <div class="w-50-px h-50-px bg-primary-600 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:web" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;"><?php echo htmlspecialchars(getApacheVersion()); ?></h6>
                </div>
            </div>
        </div>

<!-- PHP -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-2 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">PHP</p>
                        <div class="w-50-px h-50-px bg-primary-600 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:language-php" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;"><?php echo getCurrentPHPVersion(); ?></h6>
                </div>
            </div>
        </div>

        <!-- MySQL -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-3 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">MySQL</p>
                        <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:database" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 16px;"><?php echo htmlspecialchars(getMySQLVersion()); ?></h6>
                </div>
            </div>
        </div>

        <!-- OpenSSL -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-4 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">OpenSSL</p>
                        <div class="w-50-px h-50-px bg-warning-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:lock" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;"><?php echo htmlspecialchars(getOpenSSLVersion()); ?></h6>
                </div>
            </div>
        </div>

        <!-- PHP SAPI -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-5 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">PHP SAPI</p>
                        <div class="w-50-px h-50-px bg-danger-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:code-tags" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;"><?php echo htmlspecialchars(getPHPSAPI()); ?></h6>
                </div>
            </div>
        </div>

        <!-- Document Root -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-6 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">Document Root</p>
                        <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:folder-network" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;"><?php echo htmlspecialchars(getDocumentRoot()); ?></h6>
                </div>
            </div>
        </div>

         <!-- PHPMYADMIN -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-7 h-100">
                <div class="card-body p-16">
                    <!-- Top row: Label and Icon -->
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">PHPMyAdmin</p>
                        <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="mdi:database-search" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                        </div>
                    </div>
                    <!-- Value on full row -->
                    <h6 class="mb-0 text-truncate" style="font-size: 18px;">
                        <a href="http://localhost/phpmyadmin" target="_blank" class="text-base text-decoration-none hover-opacity-80 d-inline-flex align-items-center gap-1">
                            Manage MySQL
                            <iconify-icon icon="solar:link-bold" class="text-sm"></iconify-icon>
                        </a>
                    </h6>
                </div>
            </div>
        </div>

        <!-- Disk Usage -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-7 h-100">
                <div class="card-body p-16">
                    <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                        <p class="fw-medium text-secondary-light mb-0 text-sm">Disk Usage (Laragon)</p>
                        <div class="w-50-px h-50-px bg-neutral-600 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                            <iconify-icon icon="solar:diskette-bold" class="text-base text-2xl" id="disk-icon"></iconify-icon>
                        </div>
                    </div>
                    <h6 class="mb-4 text-truncate" style="font-size: 16px;" id="disk-text">Loading...</h6>
                    <div class="progress h-4-px" style="background: rgba(var(--white-rgb), 0.2);">
                        <div id="disk-progress" class="progress-bar bg-base" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        </div> <!--/ row g-3 -->
        
        <!-- Projects Section -->
        <div class="mt-24">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-16">
                <h6 class="fw-semibold mb-0">Projects</h6>
                <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#projectWizardModal">
                    <iconify-icon icon="solar:add-circle-bold" class="text-xl"></iconify-icon>
                    Create New Project
                </button>
            </div>
            
            <?php
            // Load projects
            $allProjects = [];
            if (function_exists('getAllProjects')) {
                $allProjects = getAllProjects();
            }
            
            // Group projects by platform for display
            $projectsByPlatform = [];
            foreach ($allProjects as $project) {
                $platform = $project['platform'];
                if (!isset($projectsByPlatform[$platform])) {
                    $projectsByPlatform[$platform] = [];
                }
                $projectsByPlatform[$platform][] = $project;
            }
            ?>
            
            <?php if (empty($allProjects)): ?>
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24 text-center">
                        <iconify-icon icon="solar:folder-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                        <p class="text-secondary-light mb-0">No projects found. Create your first project to get started!</p>
                    </div>
                </div>
            <?php else: ?>
                <div class="row g-3" id="projects-grid">
                    <?php foreach ($allProjects as $index => $project): 
                        // Favicon URLs are already relative to www root (e.g., "CareLoop/assets/images/favicon.ico")
                        // Prepend "/" to make them absolute from web root
                        $faviconUrl = $project['favicon'] ? '/' . ltrim($project['favicon'], '/') : null;
                        $gradientVariant = $project['gradient'] ?? (($index % 10) + 1);
                        $iconifyIcon = $project['iconify'] ?? $project['icon'] ?? 'solar:folder-bold';
                    ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 project-card" 
                         data-project-name="<?php echo htmlspecialchars($project['name']); ?>" 
                         data-platform="<?php echo htmlspecialchars(strtolower($project['platform'])); ?>"
                         oncontextmenu="if(typeof showProjectContextMenu === 'function') { showProjectContextMenu(event, '<?php echo addslashes(htmlspecialchars($project['name'], ENT_QUOTES)); ?>'); return false; }">
                        <div class="card shadow-none border radius-12 bg-gradient-start-<?php echo $gradientVariant; ?> h-100 position-relative glass-card">
                            <div class="card-body p-16">
                                <!-- 3-Dot Dropdown Menu (Top Left) -->
                                <div class="dropdown position-absolute top-0 start-0 ms-16 mt-16">
                                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-base bg-opacity-20 w-32-px h-32-px radius-8 border border-white border-opacity-30 d-flex justify-content-center align-items-center text-base hover-opacity-80" style="backdrop-filter: blur(4px);">
                                        <iconify-icon icon="entypo:dots-three-vertical" class="icon text-lg"></iconify-icon>
                                    </button>
                                    <ul class="dropdown-menu p-12 border bg-base shadow">
                                        <li>
                                            <button type="button" class="ignore-project-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-project-name="<?php echo htmlspecialchars($project['name']); ?>">
                                                <iconify-icon icon="solar:eye-closed-bold" class="icon"></iconify-icon>
                                                Ignore Project
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="env-editor-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-project-name="<?php echo htmlspecialchars($project['name']); ?>" data-bs-toggle="modal" data-bs-target="#envEditorModal">
                                                <iconify-icon icon="solar:pen-new-square-bold" class="icon"></iconify-icon>
                                                .env Editor
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                
                                <!-- Top row: 3-dots, icon, and platform -->
                                <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                                    <div class="d-flex align-items-center gap-8 ps-32">
                                        <!-- Platform label -->
                                        <p class="fw-medium text-secondary-light mb-0 text-sm"><?php echo htmlspecialchars($project['platform']); ?></p>
                                    </div>
                                    <!-- Icon on the right -->
                                    <div class="w-50-px h-50-px bg-primary-600 rounded-circle d-flex justify-content-center align-items-center flex-shrink-0">
                                        <?php if ($faviconUrl): ?>
                                            <img src="<?php echo htmlspecialchars($faviconUrl); ?>" alt="<?php echo htmlspecialchars($project['name']); ?>" class="w-40-px h-40-px object-fit-cover rounded-circle" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" style="max-width: 40px; max-height: 40px;">
                                            <iconify-icon icon="<?php echo htmlspecialchars($iconifyIcon); ?>" class="text-base text-2xl" style="font-size: 24px; display: none;"></iconify-icon>
                                        <?php else: ?>
                                            <iconify-icon icon="<?php echo htmlspecialchars($iconifyIcon); ?>" class="text-base text-2xl" style="font-size: 24px;"></iconify-icon>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!-- Project name on full row -->
                                <h6 class="mb-0 text-truncate" style="font-size: 18px;" title="<?php echo htmlspecialchars($project['name']); ?>"><?php echo htmlspecialchars($project['name']); ?></h6>
                                <div class="row g-2 mt-12">
                                    <div class="<?php echo ($project['is_wordpress'] ?? false) ? 'col-6' : 'col-12'; ?>">
                                        <a href="<?php echo htmlspecialchars($project['url']); ?>" target="_blank" class="btn btn-sm btn-info w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2">
                                            <iconify-icon icon="solar:link-bold" class="text-lg"></iconify-icon>
                                            Open
                                        </a>
                                    </div>
                                    <?php if ($project['is_wordpress'] ?? false): ?>
                                    <div class="col-6">
                                        <a href="<?php echo htmlspecialchars($project['url']); ?>/wp-admin" target="_blank" class="btn btn-sm btn-primary-600 w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2">
                                            <iconify-icon icon="solar:settings-bold" class="text-lg"></iconify-icon>
                                            WP Admin
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-8 pt-8 border-top border-white border-opacity-20">
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <a href="index.php?page=projects" class="btn btn-sm btn-success w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2">
                                                <iconify-icon icon="solar:share-bold" class="text-lg"></iconify-icon>
                                                Share
                                            </a>
                                        </div>
                                        <div class="col-6">
                                            <a href="index.php?page=projects" class="btn btn-sm btn-danger w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2">
                                                <iconify-icon icon="solar:trash-bin-trash-bold" class="text-lg"></iconify-icon>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div> <!--/ container-fluid -->

    <!-- Dynamic Changelog Accordion -->
    <div class="container-fluid mt-24">
        <div class="card shadow-none border radius-12 glass">
            <div class="card-body p-24">
                <div class="d-flex align-items-center justify-content-between mb-16">
                    <strong><p class="fw-semibold mb-0">Version History & Changelog</p></strong>
                    <span class="badge bg-primary-600">v<?php echo getAppVersion(); ?></span>
                </div>
                
                <div class="accordion accordion-flush" id="changelogAccordion">
                    <?php 
                    $changelog = getChangelog();
                    $first = true;
                    foreach ($changelog as $version => $data): 
                        $collapseId = 'collapse' . str_replace('.', '', $version);
                    ?>
                    <div class="accordion-item bg-transparent border-bottom border-white border-opacity-10">
                        <h2 class="accordion-header" id="heading<?php echo $collapseId; ?>">
                            <button class="accordion-button <?php echo $first ? '' : 'collapsed'; ?> bg-transparent text-primary-light fw-medium py-12 px-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $collapseId; ?>" aria-expanded="<?php echo $first ? 'true' : 'false'; ?>" aria-controls="<?php echo $collapseId; ?>">
                                Version <?php echo htmlspecialchars($version); ?> 
                                <span class="text-secondary-light ms-8 text-sm fw-normal"><?php echo htmlspecialchars($data['date']); ?></span>
                            </button>
                        </h2>
                        <div id="<?php echo $collapseId; ?>" class="accordion-collapse collapse <?php echo $first ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $collapseId; ?>" data-bs-parent="#changelogAccordion">
                            <div class="accordion-body px-0 py-12">
                                <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                                    <?php foreach ($data['changes'] as $change): ?>
                                    <li class="d-flex align-items-start gap-2 text-secondary-light text-sm">
                                        <iconify-icon icon="solar:check-circle-bold" class="text-success-main mt-1 flex-shrink-0"></iconify-icon>
                                        <span><?php echo htmlspecialchars($change); ?></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $first = false;
                        if (count($changelog) > 5 && !$first) break; // Limit to last 5 for dashboard
                    endforeach; 
                    ?>
                </div>
                <div class="text-center mt-16">
                    <a href="CHANGELOG.md" target="_blank" class="text-primary-600 fw-medium text-sm">View Full Changelog</a>
                </div>
            </div>
        </div>
    </div>
</div> <!--/ dashboard-main-body -->

<!-- Project Creation Wizard Modal -->
<div class="modal fade" id="projectWizardModal" tabindex="-1" aria-labelledby="projectWizardModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="projectWizardModalLabel">Create New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectWizardForm">
                    <!-- Step 1: Project Details -->
                    <div class="wizard-step active" data-step="1">
                        <div class="mb-16">
                            <label class="form-label fw-medium mb-8">Project Name</label>
                            <input type="text" class="form-control" id="project-name" name="name" placeholder="my-project" required pattern="[a-zA-Z0-9_-]+" title="Only letters, numbers, underscores, and hyphens allowed">
                            <small class="text-secondary-light text-sm mt-4 d-block">Only letters, numbers, underscores, and hyphens allowed</small>
                        </div>
                        
                        <div class="mb-16">
                            <label class="form-label fw-medium mb-8">Framework/Platform</label>
                            <select class="form-select" id="project-framework" name="framework" required>
                                <option value="custom">Custom/Empty Project</option>
                                <option value="wordpress">WordPress</option>
                                <option value="laravel">Laravel</option>
                                <option value="symfony">Symfony</option>
                                <option value="drupal">Drupal</option>
                                <option value="joomla">Joomla</option>
                                <option value="cakephp">CakePHP</option>
                                <option value="nextjs">Next.js</option>
                                <option value="vuejs">Vue.js</option>
                                <option value="react">React</option>
                                <option value="angular">Angular</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Step 2: Database (optional) -->
                    <div class="wizard-step" data-step="2" style="display: none;">
                        <div class="form-check mb-16">
                            <input class="form-check-input" type="checkbox" id="create-database" name="create_database" value="true">
                            <label class="form-check-label" for="create-database">
                                Create Database
                            </label>
                        </div>
                        
                        <div id="database-fields" style="display: none;">
                            <div class="mb-16">
                                <label class="form-label fw-medium mb-8">Database Name</label>
                                <input type="text" class="form-control" id="database-name" name="database_name" placeholder="Auto-generated from project name">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Additional Options -->
                    <div class="wizard-step" data-step="3" style="display: none;">
                        <div class="form-check mb-16">
                            <input class="form-check-input" type="checkbox" id="init-git" name="init_git" value="true">
                            <label class="form-check-label" for="init-git">
                                Initialize Git Repository
                            </label>
                        </div>
                        
                        <div class="form-check mb-16">
                            <input class="form-check-input" type="checkbox" id="create-vhost" name="create_vhost" value="true" checked>
                            <label class="form-check-label" for="create-vhost">
                                Create Virtual Host
                            </label>
                        </div>
                    </div>
                    
                    <div id="wizard-message" class="alert d-none mb-16"></div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary" id="wizard-prev" style="display: none;">Previous</button>
                <button type="button" class="btn btn-primary-600" id="wizard-next">Next</button>
                <button type="button" class="btn btn-primary-600" id="wizard-create" style="display: none;">Create Project</button>
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<script>
// Project Creation Wizard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const PROJECTS_API = 'api/projects.php';
    const CREATE_PROJECT_API = 'api/create_project.php';
    
    // Wizard state
    let currentStep = 1;
    const totalSteps = 3;
    
    // DOM Elements
    const wizardModal = document.getElementById('projectWizardModal');
    const wizardForm = document.getElementById('projectWizardForm');
    const wizardNext = document.getElementById('wizard-next');
    const wizardPrev = document.getElementById('wizard-prev');
    const wizardCreate = document.getElementById('wizard-create');
    const wizardMessage = document.getElementById('wizard-message');
    const createDatabaseCheckbox = document.getElementById('create-database');
    const databaseFields = document.getElementById('database-fields');
    
    // Initialize wizard
    if (wizardModal) {
        wizardModal.addEventListener('shown.bs.modal', function() {
            // Reset wizard state
            currentStep = 1;
            updateWizardSteps();
            wizardForm.reset();
            hideMessage();
            
            // Focus on project name field
            document.getElementById('project-name').focus();
        });
    }
    
    // Handle database checkbox
    if (createDatabaseCheckbox && databaseFields) {
        createDatabaseCheckbox.addEventListener('change', function() {
            databaseFields.style.display = this.checked ? 'block' : 'none';
        });
    }
    
    // Handle Next button
    if (wizardNext) {
        wizardNext.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                currentStep++;
                updateWizardSteps();
            }
        });
    }
    
    // Handle Previous button
    if (wizardPrev) {
        wizardPrev.addEventListener('click', function() {
            currentStep--;
            updateWizardSteps();
        });
    }
    
    // Handle Create Project button
    if (wizardCreate) {
        wizardCreate.addEventListener('click', function() {
            if (validateStep(currentStep)) {
                createProject();
            }
        });
    }
    
    // Update wizard step visibility
    function updateWizardSteps() {
        const steps = wizardForm.querySelectorAll('.wizard-step');
        
        steps.forEach((step, index) => {
            const stepNum = index + 1;
            step.style.display = stepNum === currentStep ? 'block' : 'none';
            
            // Add animation
            if (stepNum === currentStep) {
                step.classList.add('animate-fade-in');
            }
        });
        
        // Update buttons
        wizardPrev.style.display = currentStep > 1 ? 'inline-block' : 'none';
        wizardNext.style.display = currentStep < totalSteps ? 'inline-block' : 'none';
        wizardCreate.style.display = currentStep === totalSteps ? 'inline-block' : 'none';
        
        // Update modal title
        const titles = [
            'Create New Project',
            'Database Settings',
            'Additional Options'
        ];
        document.getElementById('projectWizardModalLabel').textContent = titles[currentStep - 1];
    }
    
    // Validate current step
    function validateStep(step) {
        switch(step) {
            case 1:
                const projectName = document.getElementById('project-name').value.trim();
                if (!projectName) {
                    showMessage('Please enter a project name', 'danger');
                    return false;
                }
                if (!/^[a-zA-Z0-9_-]+$/.test(projectName)) {
                    showMessage('Project name can only contain letters, numbers, underscores, and hyphens', 'danger');
                    return false;
                }
                return true;
            case 2:
                // Database step is optional
                return true;
            case 3:
                // Options step is optional
                return true;
            default:
                return true;
        }
    }
    
    // Show message
    function showMessage(message, type) {
        wizardMessage.textContent = message;
        wizardMessage.className = 'alert alert-' + type + ' mb-16';
        wizardMessage.style.display = 'block';
        
        // Auto-hide after 5 seconds for success messages
        if (type === 'success') {
            setTimeout(hideMessage, 5000);
        }
    }
    
    // Hide message
    function hideMessage() {
        wizardMessage.style.display = 'none';
    }
    
    // Create project
    function createProject() {
        const formData = new FormData(wizardForm);
        formData.append('action', 'create');
        
        toggleLoading(wizardCreate, true, 'Creating...');
        
        // Add CSRF token
        formData.append('csrf_token', window.csrfToken);
        
        fetch(CREATE_PROJECT_API, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            toggleLoading(wizardCreate, false);
            if (data.success) {
                showNotification('Project created successfully!', 'success', 'Success');
                
                // Close modal and reload page
                setTimeout(() => {
                    const modal = bootstrap.Modal.getInstance(wizardModal);
                    modal.hide();
                    window.location.reload();
                }, 1500);
            } else {
                showNotification(data.error || 'Failed to create project', 'error', 'Error');
            }
        })
        .catch(error => {
            toggleLoading(wizardCreate, false);
            console.error('Error creating project:', error);
            showNotification('Error: ' + error.message, 'error', 'System Error');
        });
    }
});

// Handle ignore project from dropdown menu (for index.php)
document.addEventListener('DOMContentLoaded', function() {
    const PROJECTS_API = 'api/projects.php';
    
    document.querySelectorAll('.ignore-project-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const projectName = this.getAttribute('data-project-name');
            if (!projectName) {
                return;
            }
            
            // Close dropdown
            const dropdownElement = this.closest('.dropdown').querySelector('[data-bs-toggle="dropdown"]');
            const dropdown = bootstrap.Dropdown.getInstance(dropdownElement);
            if (dropdown) {
                dropdown.hide();
            }
            
            if (!confirm('Ignore "' + projectName + '"? This project will be hidden from the list.')) {
                return;
            }
            
            toggleLoading(this, true);
            
            const formData = new FormData();
            formData.append('action', 'ignore');
            formData.append('project', projectName);
            formData.append('csrf_token', window.csrfToken); // Add CSRF token
            
            fetch(PROJECTS_API, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    toggleLoading(this, false);
                    if (data.success) {
                        // Remove the project card
                        const projectCard = document.querySelector(`.project-card-container[data-project-name="${projectName}"]`);
                        if (projectCard) {
                            projectCard.classList.add('animate__animated', 'animate__fadeOut');
                            setTimeout(() => {
                                projectCard.remove();
                                // Refresh projects count if needed
                                if (document.querySelectorAll('.project-card-container').length === 0) {
                                    window.location.reload();
                                }
                            }, 500);
                        }
                        
                        showNotification('Project "' + projectName + '" has been ignored.', 'success');
                    } else {
                        showNotification(data.error || 'Failed to ignore project', 'error');
                    }
                })
                .catch(error => {
                    toggleLoading(this, false);
                    console.error('Error ignoring project:', error);
                    showNotification('Error: ' + error.message, 'error');
                });
        });
    });
});

// Real-time Service Status & Resource Monitoring
document.addEventListener('DOMContentLoaded', function() {
    const SERVICES_API = 'api/services.php';
    
    function refreshStatus() {
        fetch(SERVICES_API + '?action=status')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateDiskUI(data.data.disk);
                    updateServiceResourceUI(data.data.services);
                }
            })
            .catch(error => console.error('Status refresh error:', error));
    }

    function updateDiskUI(disk) {
        const text = document.getElementById('disk-text');
        const progress = document.getElementById('disk-progress');
        if (text && progress) {
            text.textContent = `${disk.used}GB / ${disk.total}GB (${disk.percent}%)`;
            progress.style.width = disk.percent + '%';
            progress.setAttribute('aria-valuenow', disk.percent);
            
            if (disk.percent > 90) {
                progress.classList.replace('bg-base', 'bg-danger');
            } else if (disk.percent > 75) {
                progress.classList.replace('bg-base', 'bg-warning');
            } else {
                progress.className = 'progress-bar bg-base';
            }
        }
    }

    function updateServiceResourceUI(services) {
        // We can add logic here to update specific badges if we add IDs to the main cards
        // For now, let's just update the console or prepare for future modular cards
        Object.entries(services).forEach(([name, info]) => {
            const cardTitle = Array.from(document.querySelectorAll('.card-body p')).find(p => p.textContent.trim() === name);
            if (cardTitle && info.status === 'running') {
                let statsCont = cardTitle.parentElement.querySelector('.service-stats');
                if (!statsCont) {
                    statsCont = document.createElement('div');
                    statsCont.className = 'service-stats text-xs mt-2 d-flex gap-2 opacity-75';
                    cardTitle.after(statsCont);
                }
                statsCont.innerHTML = `
                    <span class="d-flex align-items-center gap-1">
                        <iconify-icon icon="solar:cpu-bold"></iconify-icon> ${info.usage.cpu}%
                    </span>
                    <span class="d-flex align-items-center gap-1">
                        <iconify-icon icon="solar:ram-bold"></iconify-icon> ${info.usage.ram}MB
                    </span>
                `;
            } else if (cardTitle) {
                const statsCont = cardTitle.parentElement.querySelector('.service-stats');
                if (statsCont) statsCont.remove();
            }
        });
    }

    // Refresh every 30 seconds
    setInterval(refreshStatus, 30000);
    // Initial refresh
    refreshStatus();
});
</script>

<!-- .env Editor Modal -->
<div class="modal fade" id="envEditorModal" tabindex="-1" aria-labelledby="envEditorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content glass border-0 text-white">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold text-white" id="envEditorModalLabel">.env Editor: <span id="envProjectName" class="text-primary-600"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="env-editor-loader" class="p-40 text-center">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-16 text-secondary-light">Loading .env file...</p>
                </div>
                <div id="env-editor-container" style="display: none;">
                    <textarea id="env-editor-textarea" class="form-control border-0 radius-0 bg-dark text-white p-16" style="min-height: 500px; font-family: 'Fira Code', 'Courier New', monospace; font-size: 14px; line-height: 1.5;"></textarea>
                </div>
                <div id="env-editor-empty" class="p-40 text-center" style="display: none;">
                    <iconify-icon icon="solar:file-corrupted-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                    <p class="text-secondary-light">This project does not have a .env file yet.</p>
                    <button type="button" class="btn btn-primary-600 mt-16" id="create-env-btn">Create .env File</button>
                </div>
            </div>
            <div class="modal-footer border-top">
                <div class="flex-grow-1">
                    <small class="text-secondary-light">Backups are created automatically before saving.</small>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary-600" id="save-env-btn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<?php include './partials/layouts/layoutBottom.php' ?>