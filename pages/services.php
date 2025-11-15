<?php
/**
 * Laragon Dashboard - Services Page
 * Version: 3.0.0
 * Description: Service management with port configuration
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
$servicesTranslations = [];
if (function_exists('load_translations')) {
    $servicesTranslations = load_translations('services');
}

function t_services($key, $fallback = '') {
    global $servicesTranslations;
    if (function_exists('t')) {
        $translated = t('services.' . $key);
        if ($translated !== 'services.' . $key) {
            return $translated;
        }
    }
    return $servicesTranslations[$key] ?? ($fallback ?: $key);
}

// Get Laragon config
$laragonConfig = getLaragonConfig();
$laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';

// Define available services with default ports
$availableServices = [
    'Apache' => [
        'name' => 'Apache',
        'port' => $laragonConfig['ApachePort'] ?? '80',
        'ssl_port' => $laragonConfig['ApacheSSLPort'] ?? '443',
        'enabled' => isset($laragonConfig['ApacheEnabled']) ? ($laragonConfig['ApacheEnabled'] == '1') : true,
        'has_ssl' => true,
        'icon' => 'devicon-plain:apache',
        'color' => 'primary',
        'service_name' => 'Apache2.4',
        'type' => 'windows_service'
    ],
    'MySQL' => [
        'name' => 'MySQL',
        'port' => $laragonConfig['MySQLPort'] ?? '3306',
        'ssl_port' => null,
        'enabled' => isset($laragonConfig['MySQLEnabled']) ? ($laragonConfig['MySQLEnabled'] == '1') : true,
        'has_ssl' => false,
        'icon' => 'tabler:brand-mysql',
        'color' => 'info',
        'service_name' => 'MySQL',
        'type' => 'windows_service'
    ],
    'PostgreSQL' => [
        'name' => 'PostgreSQL',
        'port' => $laragonConfig['PostgreSQLPort'] ?? '5432',
        'ssl_port' => null,
        'enabled' => isset($laragonConfig['PostgreSQLEnabled']) ? ($laragonConfig['PostgreSQLEnabled'] == '1') : false,
        'has_ssl' => false,
        'icon' => 'devicon-plain:postgresql',
        'color' => 'secondary',
        'service_name' => 'postgresql',
        'type' => 'windows_service'
    ],
    'Nginx' => [
        'name' => 'Nginx',
        'port' => $laragonConfig['NginxPort'] ?? '8080',
        'ssl_port' => $laragonConfig['NginxSSLPort'] ?? '8443',
        'enabled' => isset($laragonConfig['NginxEnabled']) ? ($laragonConfig['NginxEnabled'] == '1') : false,
        'has_ssl' => true,
        'icon' => 'devicon-plain:nginx',
        'color' => 'success',
        'service_name' => 'nginx',
        'type' => 'process'
    ],
    'Memcached' => [
        'name' => 'Memcached',
        'port' => $laragonConfig['MemcachedPort'] ?? '11211',
        'ssl_port' => null,
        'enabled' => isset($laragonConfig['MemcachedEnabled']) ? ($laragonConfig['MemcachedEnabled'] == '1') : false,
        'has_ssl' => false,
        'icon' => 'devicon-plain:memcached',
        'color' => 'warning',
        'service_name' => 'memcached',
        'type' => 'process'
    ],
    'Redis' => [
        'name' => 'Redis',
        'port' => $laragonConfig['RedisPort'] ?? '6379',
        'ssl_port' => null,
        'enabled' => isset($laragonConfig['RedisEnabled']) ? ($laragonConfig['RedisEnabled'] == '1') : false,
        'has_ssl' => false,
        'icon' => 'devicon-plain:redis',
        'color' => 'danger',
        'service_name' => 'Redis',
        'type' => 'windows_service'
    ],
    'MongoDB' => [
        'name' => 'MongoDB',
        'port' => $laragonConfig['MongoDBPort'] ?? '27017',
        'ssl_port' => null,
        'enabled' => isset($laragonConfig['MongoDBEnabled']) ? ($laragonConfig['MongoDBEnabled'] == '1') : false,
        'has_ssl' => false,
        'icon' => 'devicon-plain:mongodb',
        'color' => 'success',
        'service_name' => 'MongoDB',
        'type' => 'windows_service'
    ],
    'Mailpit' => [
        'name' => 'Mailpit',
        'port' => $laragonConfig['MailpitPort'] ?? '1025',
        'ssl_port' => $laragonConfig['MailpitHTTPPort'] ?? '8025', // HTTP port for web UI
        'enabled' => isset($laragonConfig['MailpitEnabled']) ? ($laragonConfig['MailpitEnabled'] == '1') : false,
        'has_ssl' => true, // Show HTTP port field
        'icon' => 'solar:letter-bold',
        'color' => 'purple',
        'service_name' => 'Mailpit',
        'type' => 'process'
    ]
];

// Check if services are actually installed
function checkServiceInstalled($service) {
    global $laragonRoot;
    
    if (empty($laragonRoot)) {
        return false;
    }
    
    $servicePaths = [
        'Apache' => $laragonRoot . '/bin/apache',
        'MySQL' => $laragonRoot . '/bin/mysql',
        'PostgreSQL' => $laragonRoot . '/bin/postgresql',
        'Nginx' => $laragonRoot . '/bin/nginx',
        'Memcached' => $laragonRoot . '/bin/memcached',
        'Redis' => $laragonRoot . '/bin/redis',
        'MongoDB' => $laragonRoot . '/bin/mongodb',
        'Mailpit' => $laragonRoot . '/bin/mailpit'
    ];
    
    if (isset($servicePaths[$service])) {
        return is_dir($servicePaths[$service]);
    }
    
    return false;
}

// Filter to only show installed services
$installedServices = [];
foreach ($availableServices as $key => $service) {
    if (checkServiceInstalled($key)) {
        $installedServices[$key] = $service;
    }
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_services('services', 'Services'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_services('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_services('services', 'Services'); ?></li>
            </ul>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-24" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab">
                    <?php echo t_services('services_ports', 'Services & Ports'); ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                    <?php echo t_services('general', 'General'); ?>
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Services & Ports Tab -->
            <div class="tab-pane fade show active" id="services" role="tabpanel">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <form id="services-form">
                            <div class="table-responsive scroll-sm">
                                <table class="table bordered-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bg-transparent rounded-0" style="width: 200px;"><?php echo t_services('service', 'Service'); ?></th>
                                            <th scope="col" class="bg-transparent rounded-0" style="width: 120px;"><?php echo t_services('port', 'Port'); ?></th>
                                            <th scope="col" class="bg-transparent rounded-0" style="width: 120px;"><?php echo t_services('ssl_port', 'SSL Port'); ?></th>
                                            <th scope="col" class="bg-transparent rounded-0" style="width: 100px;"><?php echo t_services('enabled', 'Enabled'); ?></th>
                                            <th scope="col" class="bg-transparent rounded-0" style="width: 100px;"><?php echo t_services('status', 'Status'); ?></th>
                                            <th scope="col" class="bg-transparent rounded-0"><?php echo t_services('actions', 'Actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="services-list">
                                        <?php foreach ($installedServices as $key => $service): 
                                            // Check service status directly
                                            $status = 'unknown';
                                            $runningPorts = [];
                                            
                                            if ($service['type'] === 'windows_service') {
                                                $output = @shell_exec('sc query "' . $service['service_name'] . '" 2>&1');
                                                if ($output) {
                                                    // Check for RUNNING state (case-insensitive)
                                                    if (stripos($output, 'RUNNING') !== false) {
                                                        $status = 'running';
                                                        $runningPorts[] = $service['port'];
                                                        if ($service['ssl_port']) {
                                                            $runningPorts[] = $service['ssl_port'];
                                                        }
                                                    }
                                                    // Check for STOPPED state (case-insensitive)
                                                    elseif (stripos($output, 'STOPPED') !== false) {
                                                        $status = 'stopped';
                                                    }
                                                    // Check STATE line for RUNNING
                                                    elseif (preg_match('/STATE\s*:\s*\d+\s+(\w+)/i', $output, $matches)) {
                                                        if (stripos($matches[1], 'RUNNING') !== false) {
                                                            $status = 'running';
                                                            $runningPorts[] = $service['port'];
                                                            if ($service['ssl_port']) {
                                                                $runningPorts[] = $service['ssl_port'];
                                                            }
                                                        } elseif (stripos($matches[1], 'STOPPED') !== false) {
                                                            $status = 'stopped';
                                                        }
                                                    }
                                                }
                                            } else {
                                                // Process-based services
                                                $processName = strtolower($service['service_name']) . '.exe';
                                                $output = @shell_exec('tasklist /FI "IMAGENAME eq ' . $processName . '" 2>&1');
                                                if ($output && stripos($output, $processName) !== false) {
                                                    $status = 'running';
                                                    $runningPorts[] = $service['port'];
                                                    if ($service['ssl_port']) {
                                                        $runningPorts[] = $service['ssl_port'];
                                                    }
                                                } else {
                                                    $status = 'stopped';
                                                }
                                            }
                                            
                                            // JavaScript will refresh status via API for real-time updates
                                            
                                            $runningPortsStr = !empty($runningPorts) ? implode('/', $runningPorts) : '-';
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="form-check style-check">
                                                        <input class="form-check-input service-enabled-checkbox" type="checkbox" id="service-<?php echo $key; ?>" name="services[<?php echo $key; ?>][enabled]" value="1" data-service="<?php echo $key; ?>" <?php echo $service['enabled'] ? 'checked' : ''; ?>>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="w-32-px h-32-px bg-<?php echo $service['color']; ?>-50 rounded-circle d-flex justify-content-center align-items-center">
                                                            <iconify-icon icon="<?php echo htmlspecialchars($service['icon']); ?>" class="text-<?php echo $service['color']; ?>-main"></iconify-icon>
                                                        </div>
                                                        <span class="fw-medium"><?php echo htmlspecialchars($service['name']); ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm" name="services[<?php echo $key; ?>][port]" value="<?php echo htmlspecialchars($service['port']); ?>" min="1" max="65535">
                                            </td>
                                            <td>
                                                <?php if ($service['has_ssl']): ?>
                                                    <input type="number" class="form-control form-control-sm" name="services[<?php echo $key; ?>][ssl_port]" value="<?php echo htmlspecialchars($service['ssl_port'] ?? ''); ?>" min="1" max="65535" placeholder="<?php echo $key === 'Mailpit' ? 'HTTP Port' : 'SSL Port'; ?>">
                                                <?php else: ?>
                                                    <span class="text-secondary-light">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="form-switch switch-<?php echo $service['color']; ?> d-flex align-items-center">
                                                    <input class="form-check-input service-enabled-switch" type="checkbox" role="switch" name="services[<?php echo $key; ?>][enabled_check]" data-service="<?php echo $key; ?>" <?php echo $service['enabled'] ? 'checked' : ''; ?>>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="bg-<?php echo $status === 'running' ? 'success' : 'secondary'; ?>-focus text-<?php echo $status === 'running' ? 'success' : 'secondary'; ?>-main px-24 py-4 rounded-pill fw-medium text-sm">
                                                    <?php echo $status === 'running' ? t_services('running', 'Running') : t_services('stopped', 'Stopped'); ?>
                                                </span>
                                                <?php if ($status === 'running' && !empty($runningPortsStr)): ?>
                                                    <br><small class="text-secondary-light mt-4 d-block"><?php echo htmlspecialchars($runningPortsStr); ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <?php if ($key === 'Apache'): ?>
                                                        <button type="button" class="btn btn-sm btn-primary-100 text-primary-600" onclick="reloadApache()">
                                                            <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                                                            <?php echo t_services('reload', 'Reload'); ?>
                                                        </button>
                                                    <?php endif; ?>
                                                    <?php if ($status === 'running'): ?>
                                                        <button type="button" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" onclick="stopService('<?php echo $key; ?>')" title="<?php echo t_services('stop', 'Stop'); ?>">
                                                            <iconify-icon icon="solar:stop-bold"></iconify-icon>
                                                        </button>
                                                    <?php else: ?>
                                                        <button type="button" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center" onclick="startService('<?php echo $key; ?>')" title="<?php echo t_services('start', 'Start'); ?>">
                                                            <iconify-icon icon="solar:play-bold"></iconify-icon>
                                                        </button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between mt-24">
                                <a href="#" class="text-primary-600 hover-text-primary"><?php echo t_services('advanced', 'Advanced'); ?></a>
                                <button type="submit" class="btn btn-primary-600">
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    <?php echo t_services('save', 'Save'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- General Tab -->
            <div class="tab-pane fade" id="general" role="tabpanel">
                <div class="card shadow-none border radius-12">
                    <div class="card-body p-24">
                        <form id="general-settings-form">
                            <div class="row g-3">
                                <!-- Document Root -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium mb-8"><?php echo t_services('document_root', 'Document Root'); ?></label>
                                    <input type="text" class="form-control" name="DocumentRoot" id="document-root" value="<?php echo htmlspecialchars($laragonConfig['DocumentRoot'] ?? $laragonRoot . '/www'); ?>" placeholder="<?php echo htmlspecialchars($laragonRoot . '/www'); ?>">
                                    <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('document_root_desc', 'Directory where your projects are stored'); ?></small>
                                </div>
                                
                                <!-- Data Directory -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium mb-8"><?php echo t_services('data_directory', 'Data Directory'); ?></label>
                                    <input type="text" class="form-control" name="DataDirectory" id="data-directory" value="<?php echo htmlspecialchars($laragonConfig['DataDirectory'] ?? $laragonRoot . '/data'); ?>" placeholder="<?php echo htmlspecialchars($laragonRoot . '/data'); ?>">
                                    <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('data_directory_desc', 'Directory for Laragon data files'); ?></small>
                                </div>
                                
                                <!-- Domain Suffix -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium mb-8"><?php echo t_services('domain_suffix', 'Domain Suffix'); ?></label>
                                    <input type="text" class="form-control" name="DomainSuffix" id="domain-suffix" value="<?php echo htmlspecialchars($laragonConfig['DomainSuffix'] ?? '.local'); ?>" placeholder=".local">
                                    <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('domain_suffix_desc', 'Default domain suffix for virtual hosts'); ?></small>
                                </div>
                                
                                <!-- Hostname Format -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium mb-8"><?php echo t_services('hostname_format', 'Hostname Format'); ?></label>
                                    <input type="text" class="form-control" name="HostnameFormat" id="hostname-format" value="<?php echo htmlspecialchars($laragonConfig['HostnameFormat'] ?? '{name}.local'); ?>" placeholder="{name}.local">
                                    <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('hostname_format_desc', 'Format for auto-generated hostnames'); ?></small>
                                </div>
                                
                                <!-- Auto-start Services -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <?php 
                                        $startAll = (isset($laragonConfig['StartAllAutomatically']) && $laragonConfig['StartAllAutomatically'] == '1') || 
                                                   (isset($laragonConfig['StartAll']) && $laragonConfig['StartAll'] == '1');
                                        ?>
                                        <input class="form-check-input" type="checkbox" name="StartAllAutomatically" id="start-all-automatically" value="1" <?php echo $startAll ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="start-all-automatically">
                                            <?php echo t_services('start_all_automatically', 'Start All Services Automatically'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('start_all_automatically_desc', 'Automatically start all enabled services when Laragon starts'); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Auto-create Virtual Hosts -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <input class="form-check-input" type="checkbox" name="AutoCreateVirtualHosts" id="auto-create-vhosts" value="1" <?php echo (isset($laragonConfig['AutoCreateVirtualHosts']) && $laragonConfig['AutoCreateVirtualHosts'] == '1') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="auto-create-vhosts">
                                            <?php echo t_services('auto_create_vhosts', 'Auto-create Virtual Hosts'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('auto_create_vhosts_desc', 'Automatically create virtual hosts for new projects'); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Run on Windows Start -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <input class="form-check-input" type="checkbox" name="RunOnWindowsStart" id="run-on-windows-start" value="1" <?php echo (isset($laragonConfig['RunOnWindowsStart']) && $laragonConfig['RunOnWindowsStart'] == '1') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="run-on-windows-start">
                                            <?php echo t_services('run_on_windows_start', 'Run on Windows Start'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('run_on_windows_start_desc', 'Start Laragon automatically when Windows starts'); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Run Minimized -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <input class="form-check-input" type="checkbox" name="RunMinimized" id="run-minimized" value="1" <?php echo (isset($laragonConfig['RunMinimized']) && $laragonConfig['RunMinimized'] == '1') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="run-minimized">
                                            <?php echo t_services('run_minimized', 'Run Minimized'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('run_minimized_desc', 'Start Laragon minimized to system tray'); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Auto Backup -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <input class="form-check-input" type="checkbox" name="AutoBackup" id="auto-backup" value="1" <?php echo (isset($laragonConfig['AutoBackup']) && $laragonConfig['AutoBackup'] == '1') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="auto-backup">
                                            <?php echo t_services('auto_backup', 'Auto Backup'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('auto_backup_desc', 'Automatically backup projects at scheduled intervals'); ?></small>
                                    </div>
                                </div>
                                
                                <!-- Backup Interval -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium mb-8"><?php echo t_services('backup_interval', 'Backup Interval (hours)'); ?></label>
                                    <input type="number" class="form-control" name="BackupInterval" id="backup-interval" value="<?php echo htmlspecialchars($laragonConfig['BackupInterval'] ?? '8'); ?>" min="1" max="168" step="1">
                                    <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('backup_interval_desc', 'Hours between automatic backups (1-168)'); ?></small>
                                </div>
                                
                                <!-- Auto Update -->
                                <div class="col-12">
                                    <div class="form-check form-switch mb-16">
                                        <input class="form-check-input" type="checkbox" name="AutoUpdate" id="auto-update" value="1" <?php echo (isset($laragonConfig['AutoUpdate']) && $laragonConfig['AutoUpdate'] == '1') ? 'checked' : ''; ?>>
                                        <label class="form-check-label fw-medium" for="auto-update">
                                            <?php echo t_services('auto_update', 'Auto Update'); ?>
                                        </label>
                                        <small class="text-secondary-light text-sm mt-4 d-block"><?php echo t_services('auto_update_desc', 'Automatically check for Laragon updates'); ?></small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-end mt-24">
                                <button type="submit" class="btn btn-primary-600">
                                    <iconify-icon icon="solar:diskette-bold" class="icon"></iconify-icon>
                                    <?php echo t_services('save', 'Save'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Store script variables for later inclusion
$GLOBALS['servicesScript'] = true;
$GLOBALS['installedServices'] = $installedServices;
?>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

