<?php
/**
 * Laragon Dashboard - Tools Page
 * Version: 4.0.7
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
                        <button type="button" class="btn btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2" onclick="showPhpInfo()">
                            <iconify-icon icon="solar:code-bold" class="text-xl"></iconify-icon>
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
            
            <!-- SMTP Configuration Fix -->
            <div class="col-lg-6">
                <div class="card shadow-none border radius-12 h-100">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <div class="d-flex align-items-center gap-2">
                            <iconify-icon icon="solar:letter-bold" class="text-xl text-primary-600"></iconify-icon>
                            <strong><p class="fw-semibold mb-0"><?php echo t_tools('smtp_fix', 'SMTP Configuration'); ?></p></strong>
                        </div>
                    </div>
                    <div class="card-body p-24">
                        <p class="text-secondary-light text-sm mb-16">
                            <?php echo t_tools('smtp_fix_desc', 'Laragon\'s sendmail.exe often fails. This tool configures PHP to use Mailpit SMTP instead.'); ?>
                        </p>
                        
                        <div id="smtp-status" class="mb-16">
                            <div class="d-flex align-items-center gap-2 mb-8">
                                <div class="spinner-border spinner-border-sm text-primary-600" role="status" id="smtp-status-spinner">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <span class="text-sm"><?php echo t_tools('checking_smtp', 'Checking SMTP configuration...'); ?></span>
                            </div>
                        </div>
                        
                        <div id="smtp-config-form" style="display: none;">
                            <div class="mb-16">
                                <label class="form-label fw-medium mb-8"><?php echo t_tools('smtp_port', 'SMTP Port'); ?></label>
                                <input type="number" class="form-control" id="smtp-port" value="1025" min="1" max="65535">
                                <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_tools('smtp_port_desc', 'Mailpit SMTP port (default: 1025)'); ?></small>
                            </div>
                            
                            <div class="mb-16">
                                <label class="form-label fw-medium mb-8"><?php echo t_tools('from_email', 'From Email'); ?></label>
                                <input type="email" class="form-control" id="from-email" value="noreply@localhost">
                                <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_tools('from_email_desc', 'Default sender email address'); ?></small>
                            </div>
                            
                            <button type="button" class="btn btn-primary-600 w-100 radius-8 px-20 py-11 d-flex align-items-center gap-2" id="fix-smtp-btn">
                                <iconify-icon icon="solar:settings-bold" class="text-xl"></iconify-icon>
                                <?php echo t_tools('fix_smtp', 'Fix SMTP Configuration'); ?>
                            </button>
                        </div>
                        
                        <div id="smtp-output" class="mt-16" style="display: none;">
                            <div class="alert" id="smtp-alert">
                                <span id="smtp-message"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tunnel Integration -->
<div class="col-lg-6">
    <div class="card shadow-none border radius-12 h-100">
        <div class="card-header border-bottom bg-base py-16 px-24">
            <div class="d-flex align-items-center gap-2">
                <iconify-icon icon="solar:cloud-bold" class="text-xl text-success-600"></iconify-icon>
                <strong><p class="fw-semibold mb-0"><?php echo t_tools('tunnel_integration', 'Tunnel Integration'); ?></p></strong>
            </div>
        </div>
        <div class="card-body p-24">
            <p class="text-secondary-light text-sm mb-16">
                <?php echo t_tools('tunnel_desc', 'Expose your local projects to the internet using free tunneling services.'); ?>
            </p>
            
            <div class="mb-16">
                <label class="form-label fw-medium mb-8"><?php echo t_tools('select_tunnel_service', 'Tunnel Service'); ?></label>
                <select class="form-select" id="tunnel-service">
                    <option value="localtunnel"><?php echo t_tools('local_tunnel', 'LocalTunnel'); ?></option>
                    <option value="cloudflare"><?php echo t_tools('cloudflare_tunnel', 'Cloudflare Tunnel'); ?></option>
                    <option value="ngrok"><?php echo t_tools('ngrok', 'ngrok'); ?></option>
                </select>
            </div>
            
            <div class="mb-16">
                <label class="form-label fw-medium mb-8"><?php echo t_tools('select_project_2', 'Select Project'); ?></label>
                <select class="form-select" id="tunnel-project">
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
            
            <div class="mb-16">
                <label class="form-label fw-medium mb-8"><?php echo t_tools('tunnel_port', 'Port'); ?></label>
                <input type="number" class="form-control" id="tunnel-port" value="80" min="1" max="65535">
                <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_tools('tunnel_port_desc', 'Default port for your project (usually 80 or 8080)'); ?></small>
            </div>
            
            <div class="mb-16">
                <label class="form-label fw-medium mb-8"><?php echo t_tools('custom_subdomain', 'Custom Subdomain (optional)'); ?></label>
                <input type="text" class="form-control" id="tunnel-subdomain" placeholder="my-project">
                <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_tools('custom_subdomain_desc', 'Use a custom subdomain for your tunnel URL'); ?></small>
            </div>
            
            <button type="button" class="btn btn-primary-600 w-100 radius-8 px-20 py-11 d-flex align-items-center gap-2" id="start-tunnel-btn">
                <iconify-icon icon="solar:launch-bold" class="text-xl"></iconify-icon>
                <?php echo t_tools('start_tunnel', 'Start Tunnel'); ?>
            </button>
            
            <div id="tunnel-status" class="mt-16 pt-16 border-t" style="display: none;">
                <div class="d-flex align-items-center gap-2 mb-8">
                    <span class="spinner-border spinner-border-sm text-success-600" role="status" id="tunnel-status-spinner">
                        <span class="visually-hidden">Loading...</span>
                    </span>
                    <span class="text-sm" id="tunnel-status-text"></span>
                </div>
                <div class="tunnel-url-box bg-neutral-50 p-16 radius-8" style="display: none;">
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:link-bold" class="text-success-600"></iconify-icon>
                        <a href="#" id="tunnel-url" target="_blank" class="fw-medium text-success-600"></a>
                        <button type="button" class="btn btn-sm btn-outline-success" onclick="copyTunnelURL()">Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tunnel integration JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        const csrfToken = window.csrfToken;
        
        // Start tunnel button
        document.getElementById('start-tunnel-btn').addEventListener('click', function() {
            const service = document.getElementById('tunnel-service').value;
            const project = document.getElementById('tunnel-project').value;
            const port = document.getElementById('tunnel-port').value;
            const subdomain = document.getElementById('tunnel-subdomain').value;
            
            if (!project) {
                showNotification('<?php echo t_tools('select_project', 'Please select a project first.'); ?>', 'error');
                return;
            }
            
            toggleLoading(this, true, 'Starting...');
            
            fetch('api/tunnel.php?action=start', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': csrfToken
                },
                body: JSON.stringify({
                    tunnel_type: service,
                    project_name: project,
                    port: port,
                    custom_subdomain: subdomain
                })
            })
            .then(response => response.json())
            .then(data => {
                toggleLoading(this, false);
                if (data.success) {
                    showNotification(data.message, 'success');
                    document.getElementById('tunnel-status').style.display = 'block';
                    document.getElementById('tunnel-status-spinner').style.display = 'none';
                    document.getElementById('tunnel-status-text').textContent = '<?php echo t_tools('tunnel_started', 'Tunnel started successfully'); ?>';
                    document.getElementById('tunnel-url-box').style.display = 'block';
                    document.getElementById('tunnel-url').textContent = data.url;
                    document.getElementById('tunnel-url').href = data.url;
                } else {
                    showNotification(data.error || '<?php echo t_tools('tunnel_failed', 'Failed to start tunnel'); ?>', 'error');
                }
            })
            .catch(error => {
                toggleLoading(this, false);
                showNotification('<?php echo t_tools('error', 'Error: ' + error.message); ?>', 'error');
            });
        });
        
        // Check tunnel status
        function checkTunnelStatus() {
            const project = document.getElementById('tunnel-project').value;
            if (!project) return;
            
            fetch('api/tunnel.php?action=status&project=' + encodeURIComponent(project))
            .then(response => response.json())
            .then(data => {
                if (data.status.running) {
                    document.getElementById('tunnel-status').style.display = 'block';
                    document.getElementById('tunnel-status-spinner').style.display = 'none';
                    document.getElementById('tunnel-status-text').textContent = '<?php echo t_tools('tunnel_running', 'Tunnel is running'); ?>';
                    document.getElementById('tunnel-url-box').style.display = 'block';
                    document.getElementById('tunnel-url').textContent = data.url;
                    document.getElementById('tunnel-url').href = data.url;
                } else {
                    document.getElementById('tunnel-status').style.display = 'block';
                    document.getElementById('tunnel-status-text').textContent = '<?php echo t_tools('tunnel_not_running', 'Tunnel is not running'); ?>';
                    document.getElementById('tunnel-url-box').style.display = 'none';
                }
            });
        }
        
        // Initial status check
        setInterval(checkTunnelStatus, 5000);
    });
    
    // Copy tunnel URL
    function copyTunnelURL() {
        const url = document.getElementById('tunnel-url').textContent;
        navigator.clipboard.writeText(url).then(() => {
            showNotification('URL copied to clipboard', 'success');
        });
    }
</script>
$GLOBALS['toolsScript'] = true;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

