<?php
/**
 * Laragon Dashboard - Projects Page
 * Version: 3.0.0
 * Description: Project management
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
$projectsTranslations = [];
if (function_exists('load_translations')) {
    $projectsTranslations = load_translations('projects');
}

function t_projects($key, $fallback = '') {
    global $projectsTranslations;
    if (function_exists('t')) {
        $translated = t('projects.' . $key);
        if ($translated !== 'projects.' . $key) {
            return $translated;
        }
    }
    return $projectsTranslations[$key] ?? ($fallback ?: $key);
}

// Load projects
$allProjects = [];
if (function_exists('getAllProjects')) {
    $allProjects = getAllProjects();
}

// Filter projects by search query if provided
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$filteredProjects = $allProjects;
if (!empty($searchQuery)) {
    $searchLower = strtolower($searchQuery);
    $filteredProjects = array_filter($allProjects, function($project) use ($searchLower) {
        return strpos(strtolower($project['name']), $searchLower) !== false ||
               strpos(strtolower($project['platform']), $searchLower) !== false;
    });
    // Re-index array after filtering
    $filteredProjects = array_values($filteredProjects);
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_projects('projects', 'Projects'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_projects('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_projects('projects', 'Projects'); ?></li>
            </ul>
        </div>

        <!-- Projects Section -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-16">
            <div>
                <strong><p class="fw-semibold mb-0"><?php echo t_projects('projects', 'Projects'); ?></p></strong>
                <?php if (!empty($searchQuery)): ?>
                    <p class="text-secondary-light text-sm mb-0 mt-1">
                        <?php echo t_projects('search_results', 'Search results for'); ?>: "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>" 
                        (<?php echo count($filteredProjects); ?> <?php echo count($filteredProjects) === 1 ? t_projects('result', 'result') : t_projects('results', 'results'); ?>)
                        <a href="index.php?page=projects" class="text-primary-600 hover-text-primary ms-2"><?php echo t_projects('clear_search', 'Clear'); ?></a>
                    </p>
                <?php endif; ?>
            </div>
            <button type="button" class="btn btn-primary-600" data-bs-toggle="modal" data-bs-target="#projectWizardModal">
                <iconify-icon icon="solar:add-circle-bold" class="icon"></iconify-icon>
                <?php echo t_projects('create_new_project', 'Create New Project'); ?>
            </button>
        </div>
        
        <?php if (empty($filteredProjects)): ?>
            <div class="card shadow-none border radius-12">
                <div class="card-body p-24 text-center">
                    <iconify-icon icon="solar:folder-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                    <p class="text-secondary-light mb-0">
                        <?php if (!empty($searchQuery)): ?>
                            <?php echo t_projects('no_search_results', 'No projects found matching your search.'); ?>
                        <?php else: ?>
                            <?php echo t_projects('no_projects', 'No projects found. Create your first project to get started!'); ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php else: ?>
            <div class="row g-3" id="projects-grid">
                <?php foreach ($filteredProjects as $index => $project): 
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
                                        <?php echo t_projects('open', 'Open'); ?>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <?php if ($project['is_wordpress'] ?? false): ?>
                                        <a href="<?php echo htmlspecialchars($project['url']); ?>/wp-admin" target="_blank" class="text-white text-sm fw-medium hover-opacity-80 d-flex align-items-center gap-1">
                                            <iconify-icon icon="solar:settings-bold" class="icon text-sm"></iconify-icon>
                                            <?php echo t_projects('wp_admin', 'WP Admin'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

