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
            <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#projectWizardModal">
                <iconify-icon icon="solar:add-circle-bold" class="text-xl"></iconify-icon>
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
                <div class="col-lg-3 col-md-4 col-sm-6 project-card" 
                     data-project-name="<?php echo htmlspecialchars($project['name']); ?>" 
                     data-platform="<?php echo htmlspecialchars(strtolower($project['platform'])); ?>"
                     oncontextmenu="showProjectContextMenu(event, '<?php echo htmlspecialchars($project['name']); ?>'); return false;">
                    <div class="card shadow-none border radius-12 bg-gradient-start-<?php echo $gradientVariant; ?> h-100 position-relative">
                        <div class="card-body p-16">
                            <!-- 3-Dot Dropdown Menu (Top Left) -->
                            <div class="dropdown position-absolute top-0 start-0 ms-16 mt-16">
                                <button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="bg-white bg-opacity-20 w-32-px h-32-px radius-8 border border-white border-opacity-30 d-flex justify-content-center align-items-center text-base hover-opacity-80" style="backdrop-filter: blur(4px);">
                                    <iconify-icon icon="entypo:dots-three-vertical" class="icon text-lg"></iconify-icon>
                                </button>
                                <ul class="dropdown-menu p-12 border bg-base shadow">
                                    <li>
                                        <button type="button" class="ignore-project-btn dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900 d-flex align-items-center gap-10" data-project-name="<?php echo htmlspecialchars($project['name']); ?>">
                                            <iconify-icon icon="solar:eye-closed-bold" class="icon"></iconify-icon>
                                            <?php echo t_projects('ignore_project', 'Ignore Project'); ?>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Top row: 3-dots, icon, and platform -->
                            <div class="d-flex align-items-center justify-content-between gap-8 mb-8">
                                <div class="d-flex align-items-center gap-8">
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
                                        <?php echo t_projects('open', 'Open'); ?>
                                    </a>
                                </div>
                                <?php if ($project['is_wordpress'] ?? false): ?>
                                <div class="col-6">
                                    <a href="<?php echo htmlspecialchars($project['url']); ?>/wp-admin" target="_blank" class="btn btn-sm btn-primary-600 w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:settings-bold" class="text-lg"></iconify-icon>
                                        <?php echo t_projects('wp_admin', 'WP Admin'); ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="mt-8 pt-8 border-top border-white border-opacity-20">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-success w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2 share-project-btn" 
                                                data-project-name="<?php echo htmlspecialchars($project['name']); ?>"
                                                data-project-url="<?php echo htmlspecialchars($project['url']); ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#shareProjectModal">
                                            <iconify-icon icon="solar:share-bold" class="text-lg"></iconify-icon>
                                            <?php echo t_projects('share_online', 'Share'); ?>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-sm btn-danger w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2 delete-project-btn" 
                                                data-project-name="<?php echo htmlspecialchars($project['name']); ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteProjectModal">
                                            <iconify-icon icon="solar:trash-bin-trash-bold" class="text-lg"></iconify-icon>
                                            <?php echo t_projects('delete', 'Delete'); ?>
                                        </button>
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
</div>

<!-- Project Context Menu -->
<div class="context-menu" id="projectContextMenu" style="display: none; position: fixed; z-index: 9999;">
    <div class="card shadow-lg border radius-12" style="min-width: 200px;">
        <div class="card-body p-0">
            <button type="button" class="btn btn-sm w-100 text-start radius-0 border-bottom d-flex align-items-center gap-2 px-16 py-12" id="contextMenuIgnore">
                <iconify-icon icon="solar:eye-closed-bold" class="text-lg"></iconify-icon>
                <span><?php echo t_projects('ignore_project', 'Ignore Project'); ?></span>
            </button>
        </div>
    </div>
</div>

<!-- Share Project Modal -->
<div class="modal fade" id="shareProjectModal" tabindex="-1" aria-labelledby="shareProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold" id="shareProjectModalLabel">
                    <iconify-icon icon="solar:share-bold" class="text-primary-600"></iconify-icon>
                    <?php echo t_projects('share_online', 'Share Project Online'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-16">
                    <p class="mb-8"><strong><?php echo t_projects('project_name', 'Project'); ?>:</strong> <span id="shareProjectName" class="text-primary-600"></span></p>
                    <p class="mb-0"><strong><?php echo t_projects('local_url', 'Local URL'); ?>:</strong> <span id="shareProjectUrl" class="text-secondary-light"></span></p>
                </div>
                
                <div class="alert alert-info mb-16">
                    <iconify-icon icon="solar:info-circle-bold" class="icon"></iconify-icon>
                    <strong><?php echo t_projects('share_info', 'Share your local project online'); ?>:</strong>
                    <p class="mb-0 mt-8 text-sm"><?php echo t_projects('share_info_desc', 'Use a free tunneling service to expose your local project to the internet. Perfect for client previews!'); ?></p>
                </div>
                
                <div class="mb-16">
                    <label class="form-label fw-medium mb-8"><?php echo t_projects('select_tunnel', 'Select Tunneling Service'); ?></label>
                    <div id="tunnel-services" class="row g-2">
                        <!-- Tunnel services will be loaded here -->
                    </div>
                </div>
                
                <div id="tunnel-status" class="mb-16" style="display: none;">
                    <div class="card shadow-none border radius-12">
                        <div class="card-body p-16">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="fw-medium mb-4"><?php echo t_projects('tunnel_running', 'Tunnel Running'); ?></p>
                                    <a href="#" id="tunnel-public-url" target="_blank" class="text-primary-600 fw-medium">
                                        <iconify-icon icon="solar:link-bold" class="icon"></iconify-icon>
                                        <span id="tunnel-url-text">-</span>
                                    </a>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger radius-8 px-12 py-8 d-flex align-items-center gap-2" id="stop-tunnel-btn">
                                    <iconify-icon icon="solar:stop-bold" class="text-lg"></iconify-icon>
                                    <?php echo t_projects('stop_tunnel', 'Stop'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="tunnel-install-info" class="alert alert-warning mb-0" style="display: none;">
                    <iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon>
                    <strong><?php echo t_projects('installation_required', 'Installation Required'); ?>:</strong>
                    <p class="mb-0 mt-8 text-sm" id="tunnel-install-text"></p>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-dismiss="modal">
                    <?php echo t_projects('close', 'Close'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Project Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="deleteProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold" id="deleteProjectModalLabel">
                    <iconify-icon icon="solar:trash-bin-trash-bold" class="text-danger-main"></iconify-icon>
                    <?php echo t_projects('delete_project', 'Delete Project'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning mb-16">
                    <iconify-icon icon="solar:danger-triangle-bold" class="icon"></iconify-icon>
                    <strong><?php echo t_projects('warning', 'Warning'); ?>:</strong> 
                    <?php echo t_projects('delete_warning', 'This action cannot be undone. The project and its associated database will be permanently deleted.'); ?>
                </div>
                
                <div class="mb-16">
                    <p class="mb-8"><strong><?php echo t_projects('project_name', 'Project'); ?>:</strong> <span id="deleteProjectName" class="text-primary-600"></span></p>
                    <p class="mb-0" id="deleteProjectDatabase" style="display: none;">
                        <strong><?php echo t_projects('database', 'Database'); ?>:</strong> <span id="deleteDatabaseName" class="text-primary-600"></span>
                    </p>
                </div>
                
                <div class="form-check mb-16">
                    <input class="form-check-input" type="checkbox" id="createBackupBeforeDelete" checked>
                    <label class="form-check-label" for="createBackupBeforeDelete">
                        <?php echo t_projects('create_backup', 'Create backup before deletion'); ?>
                        <small class="text-secondary-light d-block mt-1">
                            <?php echo t_projects('backup_note', 'A backup will be created automatically before deletion'); ?>
                        </small>
                    </label>
                </div>
                
                <div class="form-check mb-16">
                    <input class="form-check-input" type="checkbox" id="deleteAssociatedDatabase" checked>
                    <label class="form-check-label" for="deleteAssociatedDatabase">
                        <?php echo t_projects('delete_database', 'Delete associated database'); ?>
                        <small class="text-secondary-light d-block mt-1" id="deleteDatabaseNote">
                            <?php echo t_projects('database_note', 'The database will be detected automatically'); ?>
                        </small>
                    </label>
                </div>
                
                <div class="alert alert-info mb-0" id="deleteProjectInfo" style="display: none;">
                    <iconify-icon icon="solar:info-circle-bold" class="icon"></iconify-icon>
                    <span id="deleteProjectInfoText"></span>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-secondary radius-8 px-20 py-11 d-flex align-items-center gap-2" data-bs-dismiss="modal">
                    <?php echo t_projects('cancel', 'Cancel'); ?>
                </button>
                <button type="button" class="btn btn-danger radius-8 px-20 py-11 d-flex align-items-center gap-2" id="confirmDeleteProject">
                    <iconify-icon icon="solar:trash-bin-trash-bold" class="text-xl"></iconify-icon>
                    <?php echo t_projects('delete_confirm', 'Delete Project'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

<style>
.context-menu {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.context-menu .btn {
    border-radius: 0;
}
.context-menu .btn:first-child {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
.context-menu .btn:last-child {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentProjectName = null;
    let currentDatabaseName = null;
    let currentTunnelUrl = null;
    let contextMenuProject = null;
    
    const TUNNEL_API = 'api/tunnel.php';
    const PROJECTS_API = 'api/projects.php';
    
    // Context menu handling
    window.showProjectContextMenu = function(event, projectName) {
        event.preventDefault();
        contextMenuProject = projectName;
        
        const menu = document.getElementById('projectContextMenu');
        menu.style.display = 'block';
        menu.style.left = event.pageX + 'px';
        menu.style.top = event.pageY + 'px';
        
        // Close menu when clicking outside
        setTimeout(() => {
            document.addEventListener('click', closeContextMenu);
        }, 100);
    };
    
    function closeContextMenu() {
        const menu = document.getElementById('projectContextMenu');
        menu.style.display = 'none';
        document.removeEventListener('click', closeContextMenu);
    }
    
    // Handle ignore project (from context menu)
    document.getElementById('contextMenuIgnore')?.addEventListener('click', function() {
        if (!contextMenuProject) {
            return;
        }
        
        if (!confirm('Ignore "' + contextMenuProject + '"? This project will be hidden from the list.')) {
            closeContextMenu();
            return;
        }
        
        ignoreProject(contextMenuProject);
        closeContextMenu();
    });
    
    // Handle ignore project (from dropdown menu)
    document.querySelectorAll('.ignore-project-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const projectName = this.getAttribute('data-project-name');
            if (!projectName) {
                return;
            }
            
            // Close dropdown
            const dropdown = bootstrap.Dropdown.getInstance(this.closest('.dropdown').querySelector('[data-bs-toggle="dropdown"]'));
            if (dropdown) {
                dropdown.hide();
            }
            
            if (!confirm('Ignore "' + projectName + '"? This project will be hidden from the list.')) {
                return;
            }
            
            ignoreProject(projectName);
        });
    });
    
    // Function to ignore a project
    function ignoreProject(projectName) {
        const formData = new FormData();
        formData.append('action', 'ignore');
        formData.append('project', projectName);
        
        fetch(PROJECTS_API, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the project card
                    const projectCard = document.querySelector(`[data-project-name="${projectName}"]`);
                    if (projectCard) {
                        projectCard.style.transition = 'opacity 0.3s';
                        projectCard.style.opacity = '0';
                        setTimeout(() => {
                            projectCard.remove();
                        }, 300);
                    }
                    
                    // Show success message
                    alert('Project "' + projectName + '" has been ignored and will not appear in the list.');
                } else {
                    alert('Error: ' + (data.error || 'Failed to ignore project'));
                }
            })
            .catch(error => {
                console.error('Error ignoring project:', error);
                alert('Error: ' + error.message);
            });
    }
    
    // Handle share button click
    document.querySelectorAll('.share-project-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentProjectName = this.getAttribute('data-project-name');
            const projectUrl = this.getAttribute('data-project-url');
            
            document.getElementById('shareProjectName').textContent = currentProjectName;
            document.getElementById('shareProjectUrl').textContent = projectUrl;
            
            // Load available tunnel services
            loadTunnelServices();
            
            // Check tunnel status
            checkTunnelStatus(currentProjectName);
        });
    });
    
    // Load available tunnel services
    function loadTunnelServices() {
        const container = document.getElementById('tunnel-services');
        container.innerHTML = '<div class="col-12"><div class="text-center"><div class="spinner-border spinner-border-sm text-primary-600" role="status"></div></div></div>';
        
        fetch(TUNNEL_API + '?action=list')
            .then(response => response.json())
            .then(data => {
                if (data.success && data.tunnels) {
                    container.innerHTML = '';
                    
                    Object.keys(data.tunnels).forEach(key => {
                        const tunnel = data.tunnels[key];
                        const col = document.createElement('div');
                        col.className = 'col-md-6';
                        
                        const badgeClass = tunnel.installed ? 'bg-success-main' : 'bg-warning-main';
                        const badgeText = tunnel.installed ? 'Installed' : 'Not Installed';
                        
                        col.innerHTML = `
                            <div class="card shadow-none border radius-12 ${tunnel.installed ? '' : 'opacity-75'}">
                                <div class="card-body p-16">
                                    <div class="d-flex align-items-center justify-content-between mb-8">
                                        <strong class="fw-semibold">${tunnel.name}</strong>
                                        <span class="badge ${badgeClass}">${badgeText}</span>
                                    </div>
                                    <p class="text-secondary-light text-sm mb-12">${tunnel.description}</p>
                                    ${tunnel.installed ? 
                                        `<button type="button" class="btn btn-sm btn-primary-600 w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2 start-tunnel-btn" data-tunnel-type="${key}">
                                            <iconify-icon icon="solar:play-bold" class="text-lg"></iconify-icon>
                                            Start Tunnel
                                        </button>` :
                                        `<button type="button" class="btn btn-sm btn-secondary w-100 radius-8 px-12 py-8 d-flex align-items-center gap-2" disabled>
                                            <iconify-icon icon="solar:download-bold" class="text-lg"></iconify-icon>
                                            Install Required
                                        </button>`
                                    }
                                </div>
                            </div>
                        `;
                        
                        container.appendChild(col);
                    });
                    
                    // Add event listeners to start buttons
                    container.querySelectorAll('.start-tunnel-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const tunnelType = this.getAttribute('data-tunnel-type');
                            startTunnel(tunnelType);
                        });
                    });
                } else {
                    container.innerHTML = '<div class="col-12"><div class="alert alert-danger mb-0">Failed to load tunnel services</div></div>';
                }
            })
            .catch(error => {
                console.error('Error loading tunnels:', error);
                container.innerHTML = '<div class="col-12"><div class="alert alert-danger mb-0">Error: ' + error.message + '</div></div>';
            });
    }
    
    // Check tunnel status
    function checkTunnelStatus(projectName) {
        fetch(TUNNEL_API + '?action=status&project=' + encodeURIComponent(projectName))
            .then(response => response.json())
            .then(data => {
                if (data.success && data.status && data.status.running) {
                    currentTunnelUrl = data.status.url;
                    document.getElementById('tunnel-status').style.display = 'block';
                    document.getElementById('tunnel-public-url').href = data.status.url;
                    document.getElementById('tunnel-url-text').textContent = data.status.url;
                } else {
                    document.getElementById('tunnel-status').style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error checking tunnel status:', error);
            });
    }
    
    // Start tunnel
    function startTunnel(tunnelType) {
        if (!currentProjectName) {
            return;
        }
        
        const formData = new FormData();
        formData.append('tunnel_type', tunnelType);
        
        const btn = event.target.closest('.start-tunnel-btn');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<iconify-icon icon="solar:loading-bold" class="icon spin"></iconify-icon> Starting...';
        
        fetch(TUNNEL_API + '?action=start&project=' + encodeURIComponent(currentProjectName), {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    currentTunnelUrl = data.url;
                    document.getElementById('tunnel-status').style.display = 'block';
                    document.getElementById('tunnel-public-url').href = data.url;
                    document.getElementById('tunnel-url-text').textContent = data.url;
                    
                    // Show success message
                    alert('Tunnel started! Public URL: ' + data.url + '\n\nNote: You may need to run the tunnel command manually in a terminal to get the actual URL.');
                } else {
                    alert('Error: ' + (data.error || 'Failed to start tunnel'));
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error starting tunnel:', error);
                alert('Error: ' + error.message);
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
    }
    
    // Stop tunnel
    document.getElementById('stop-tunnel-btn')?.addEventListener('click', function() {
        if (!currentProjectName) {
            return;
        }
        
        if (!confirm('Stop the tunnel?')) {
            return;
        }
        
        fetch(TUNNEL_API + '?action=stop&project=' + encodeURIComponent(currentProjectName), {
            method: 'POST'
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('tunnel-status').style.display = 'none';
                    currentTunnelUrl = null;
                } else {
                    alert('Error: ' + (data.error || 'Failed to stop tunnel'));
                }
            })
            .catch(error => {
                console.error('Error stopping tunnel:', error);
                alert('Error: ' + error.message);
            });
    });
    
    // Handle delete button click
    document.querySelectorAll('.delete-project-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentProjectName = this.getAttribute('data-project-name');
            document.getElementById('deleteProjectName').textContent = currentProjectName;
            
            // Check for database
            checkProjectDatabase(currentProjectName);
        });
    });
    
    // Check if project has associated database
    function checkProjectDatabase(projectName) {
        const formData = new FormData();
        formData.append('action', 'check_database');
        formData.append('project', projectName);
        
        fetch('api/delete_project.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.has_database) {
                currentDatabaseName = data.database_name;
                document.getElementById('deleteProjectDatabase').style.display = 'block';
                document.getElementById('deleteDatabaseName').textContent = data.database_name;
                document.getElementById('deleteDatabaseNote').textContent = 
                    '<?php echo t_projects('database_found', 'Database found and will be deleted'); ?>: ' + data.database_name;
            } else {
                currentDatabaseName = null;
                document.getElementById('deleteProjectDatabase').style.display = 'none';
                document.getElementById('deleteDatabaseNote').textContent = 
                    '<?php echo t_projects('no_database', 'No database found for this project'); ?>';
            }
        })
        .catch(error => {
            console.error('Error checking database:', error);
            document.getElementById('deleteProjectDatabase').style.display = 'none';
        });
    }
    
    // Handle confirm delete
    document.getElementById('confirmDeleteProject').addEventListener('click', function() {
        if (!currentProjectName) {
            return;
        }
        
        const createBackup = document.getElementById('createBackupBeforeDelete').checked;
        const deleteDatabase = document.getElementById('deleteAssociatedDatabase').checked;
        
        // Disable button
        this.disabled = true;
        this.innerHTML = '<iconify-icon icon="solar:loading-bold" class="icon spin"></iconify-icon> <?php echo t_projects('deleting', 'Deleting...'); ?>';
        
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('project', currentProjectName);
        formData.append('backup', createBackup ? '1' : '0');
        formData.append('delete_database', deleteDatabase ? '1' : '0');
        
        fetch('api/delete_project.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                const infoDiv = document.getElementById('deleteProjectInfo');
                infoDiv.className = 'alert alert-success mb-0';
                infoDiv.style.display = 'block';
                let message = '<?php echo t_projects('delete_success', 'Project deleted successfully'); ?>';
                if (data.results.backup_created) {
                    message += ' <?php echo t_projects('backup_created', 'Backup created'); ?>.';
                }
                if (data.results.database_deleted) {
                    message += ' <?php echo t_projects('database_deleted', 'Database deleted'); ?>.';
                }
                document.getElementById('deleteProjectInfoText').textContent = message;
                
                // Close modal after 1.5 seconds and reload page
                setTimeout(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('deleteProjectModal'));
                    modal.hide();
                    window.location.reload();
                }, 1500);
            } else {
                // Show error
                const infoDiv = document.getElementById('deleteProjectInfo');
                infoDiv.className = 'alert alert-danger mb-0';
                infoDiv.style.display = 'block';
                document.getElementById('deleteProjectInfoText').textContent = 
                    '<?php echo t_projects('delete_error', 'Error'); ?>: ' + (data.error || '<?php echo t_projects('unknown_error', 'Unknown error'); ?>');
                
                // Re-enable button
                this.disabled = false;
                this.innerHTML = '<iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon> <?php echo t_projects('delete_confirm', 'Delete Project'); ?>';
            }
        })
        .catch(error => {
            console.error('Error deleting project:', error);
            const infoDiv = document.getElementById('deleteProjectInfo');
            infoDiv.className = 'alert alert-danger mb-0';
            infoDiv.style.display = 'block';
            document.getElementById('deleteProjectInfoText').textContent = 
                '<?php echo t_projects('delete_error', 'Error'); ?>: ' + error.message;
            
            // Re-enable button
            this.disabled = false;
            this.innerHTML = '<iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon> <?php echo t_projects('delete_confirm', 'Delete Project'); ?>';
        });
    });
    
    // Reset modal when closed
    document.getElementById('deleteProjectModal').addEventListener('hidden.bs.modal', function() {
        currentProjectName = null;
        currentDatabaseName = null;
        document.getElementById('deleteProjectInfo').style.display = 'none';
        document.getElementById('createBackupBeforeDelete').checked = true;
        document.getElementById('deleteAssociatedDatabase').checked = true;
        const confirmBtn = document.getElementById('confirmDeleteProject');
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = '<iconify-icon icon="solar:trash-bin-trash-bold" class="icon"></iconify-icon> <?php echo t_projects('delete_confirm', 'Delete Project'); ?>';
    });
});
</script>

<style>
.spin {
    animation: spin 1s linear infinite;
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>

