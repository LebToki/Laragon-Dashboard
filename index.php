<?php
// Load configuration and helpers first
if (file_exists(__DIR__ . '/config.php')) {
    require_once __DIR__ . '/config.php';
}

if (file_exists(__DIR__ . '/includes/helpers.php')) {
    require_once __DIR__ . '/includes/helpers.php';
}

// Load i18n helper for language and RTL support
if (file_exists(__DIR__ . '/includes/i18n.php')) {
    require_once __DIR__ . '/includes/i18n.php';
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
        'mailbox', 'logs', 'tools', 'backup', 'sites', 'httpd', 'preferences'
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
            } catch (Throwable $e) {
                // If there's an error, show it in debug mode, otherwise show 404
                if (defined('APP_DEBUG') && APP_DEBUG) {
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
        <h6 class="fw-semibold mb-0">Dashboard</h6>
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
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                        <div>
                            <p class="fw-medium text-secondary-light mb-1 text-sm">Apache</p>
                            <h6 class="mb-0"><?php echo htmlspecialchars(getApacheVersion()); ?></h6>
                        </div>
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:web" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                       
                       
                    </p>
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
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:language-php" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                       
                    </p>
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
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:database" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        
                    </p>
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
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:lock" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        
                    </p>
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
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:code-tags" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        
                    </p>
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
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:folder-network" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        
                    </p>
                </div>
            </div>
        </div>

         <!-- PHPMYADMIN -->
        <div class="col-lg-3 col-sm-6">
            <div class="card shadow-none border radius-12 bg-gradient-start-7 h-100">
                <div class="card-body p-16">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                        <div>
                            <p class="fw-medium text-secondary-light mb-1 text-sm">PHPMyAdmin</p>
                            <h6 class="mb-0">Manage MySQL</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:database-search" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <div class="row g-2 mt-12">
                        <div class="col-6">
                            <a href="http://localhost/phpmyadmin" target="_blank" class="text-white text-sm fw-medium hover-opacity-80 d-inline-flex align-items-center gap-1" style="background-image: url('assets/images/phpmyadmin-cover.png'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 8px 16px; border-radius: 6px; position: relative; overflow: hidden; display: inline-flex;">
                                <span style="position: relative; z-index: 1; text-shadow: 0 1px 2px rgba(0,0,0,0.5);">
                                    <iconify-icon icon="solar:link-bold" class="icon text-sm"></iconify-icon>
                                    Open
                                </span>
                                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.3); z-index: 0;"></div>
                            </a>
                        </div>
                        <div class="col-6"></div>
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
                    <p class="fw-medium text-sm text-secondary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        
                    </p>
                </div>
            </div>
        </div>
        </div> <!--/ row g-3 -->
        
        <!-- Projects Section -->
        <div class="mt-24">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-16">
                <h6 class="fw-semibold mb-0">Projects</h6>
                <button type="button" class="btn btn-primary-600" data-bs-toggle="modal" data-bs-target="#projectWizardModal">
                    <iconify-icon icon="solar:add-circle-bold" class="icon"></iconify-icon>
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
                    <div class="col-lg-3 col-md-4 col-sm-6 project-card" data-project-name="<?php echo htmlspecialchars(strtolower($project['name'])); ?>" data-platform="<?php echo htmlspecialchars(strtolower($project['platform'])); ?>">
                        <div class="card shadow-none border radius-12 bg-gradient-start-<?php echo $gradientVariant; ?> h-100">
                            <div class="card-body p-16">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-8">
                                    <div>
                                        <p class="fw-medium text-secondary-light mb-1 text-sm"><?php echo htmlspecialchars($project['platform']); ?></p>
                                        <h6 class="mb-0 text-truncate" title="<?php echo htmlspecialchars($project['name']); ?>"><?php echo htmlspecialchars($project['name']); ?></h6>
                                    </div>
                                    <div class="w-50-px h-50-px bg-white bg-opacity-20 rounded-circle d-flex justify-content-center align-items-center">
                                        <?php if ($faviconUrl): ?>
                                            <img src="<?php echo htmlspecialchars($faviconUrl); ?>" alt="<?php echo htmlspecialchars($project['name']); ?>" class="w-40-px h-40-px object-fit-cover rounded-circle" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" style="max-width: 40px; max-height: 40px;">
                                            <iconify-icon icon="<?php echo htmlspecialchars($iconifyIcon); ?>" class="text-white text-2xl mb-0" style="display: none;"></iconify-icon>
                                        <?php else: ?>
                                            <iconify-icon icon="<?php echo htmlspecialchars($iconifyIcon); ?>" class="text-white text-2xl mb-0"></iconify-icon>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row g-2 mt-12">
                                    <div class="col-6">
                                        <a href="<?php echo htmlspecialchars($project['url']); ?>" target="_blank" class="text-white text-sm fw-medium hover-opacity-80 d-flex align-items-center gap-1">
                                            <iconify-icon icon="solar:link-bold" class="icon text-sm"></iconify-icon>
                                            Open
                                        </a>
                                    </div>
                                    <?php if ($project['is_wordpress']): ?>
                                        <div class="col-6">
                                            <a href="<?php echo htmlspecialchars($project['url']); ?>/wp-admin" target="_blank" class="text-white text-sm fw-medium hover-opacity-80 d-flex align-items-center gap-1">
                                                <iconify-icon icon="solar:settings-bold" class="icon text-sm"></iconify-icon>
                                                WP Admin
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-6"></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div> <!--/ container-fluid -->
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

<?php include './partials/layouts/layoutBottom.php' ?>