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
                
                <div class="row g-3 mb-24">
                    <!-- Adminer and PHPMyAdmin cards remain... -->
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
                                <?php else: ?>
                                    <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2" onclick="location.reload();">
                                        <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon> 
                                        <?php echo t_databases('check_adminer', 'Check Adminer'); ?>
                                    </button>
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
                                <?php else: ?>
                                    <a href="https://www.phpmyadmin.net/downloads/" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-2">
                                        <iconify-icon icon="solar:download-bold" class="icon"></iconify-icon>
                                        <?php echo t_databases('download_phpmyadmin', 'Download phpMyAdmin'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Live Database Listing -->
                <div class="card shadow-none border radius-12 p-0 overflow-hidden">
                    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                        <h6 class="text-lg fw-semibold mb-0"><?php echo t_databases('database_list', 'User Databases'); ?></h6>
                        <button type="button" class="btn btn-sm btn-primary-600 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#createDbModal">
                            <iconify-icon icon="solar:add-circle-bold" class="text-xl"></iconify-icon>
                            <?php echo t_databases('create_new', 'Create New'); ?>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table basic-table mb-0">
                                <thead>
                                    <tr>
                                        <th><?php echo t_databases('name', 'Database Name'); ?></th>
                                        <th><?php echo t_databases('size', 'Size (MB)'); ?></th>
                                        <th class="text-center"><?php echo t_databases('actions', 'Actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="db-list-body">
                                    <tr>
                                        <td colspan="3" class="text-center py-24">
                                            <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                                            <span class="ms-8"><?php echo t_databases('loading', 'Loading databases...'); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
 </div>

<!-- Create Database Modal -->
<div class="modal fade" id="createDbModal" tabindex="-1" aria-labelledby="createDbModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass border-0">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-semibold" id="createDbModalLabel"><?php echo t_databases('create_new_db', 'Create New Database'); ?></h5>
                <button type="button" class="btn-close" data-bs-toggle="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-24">
                <form id="create-db-form">
                    <div class="mb-3">
                        <label for="db-name" class="form-label fw-medium"><?php echo t_databases('db_name_label', 'Database Name'); ?></label>
                        <input type="text" class="form-control" id="db-name" name="name" placeholder="my_new_database" required pattern="[a-zA-Z0-9_]+">
                        <div class="form-text text-secondary-light">
                            <?php echo t_databases('db_name_hint', 'Only alphanumeric characters and underscores are allowed.'); ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo t_databases('cancel', 'Cancel'); ?></button>
                <button type="submit" form="create-db-form" class="btn btn-primary" id="create-db-btn">
                    <?php echo t_databases('create', 'Create Database'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const DATABASES_API = 'api/databases.php';

    // Load database list on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadDatabases();
    });

    // Handle database creation
    document.getElementById('create-db-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('create-db-btn');
        const name = document.getElementById('db-name').value;
        
        toggleLoading(btn, true, 'Creating...');
        
        const formData = new FormData();
        formData.append('name', name);
        formData.append('csrf_token', window.csrfToken);
        
        fetch(DATABASES_API + '?action=create', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            toggleLoading(btn, false);
            if (data.success) {
                showNotification(data.message, 'success');
                const modal = bootstrap.Modal.getInstance(document.getElementById('createDbModal'));
                if (modal) modal.hide();
                document.getElementById('create-db-form').reset();
                loadDatabases();
            } else {
                showNotification(data.error || 'Failed to create database', 'error');
            }
        })
        .catch(error => {
            toggleLoading(btn, false);
            showNotification('Error: ' + error.message, 'error');
        });
    });

    // Function to load databases
    function loadDatabases() {
        const body = document.getElementById('db-list-body');
        
        fetch(DATABASES_API + '?action=list')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderDatabases(data.data);
            } else {
                body.innerHTML = `<tr><td colspan="3" class="text-center text-danger py-24">${data.error || 'Failed to load databases'}</td></tr>`;
            }
        })
        .catch(error => {
            body.innerHTML = `<tr><td colspan="3" class="text-center text-danger py-24">Error: ${error.message}</td></tr>`;
        });
    }

    // Function to render database rows
    function renderDatabases(databases) {
        const body = document.getElementById('db-list-body');
        if (databases.length === 0) {
            body.innerHTML = '<tr><td colspan="3" class="text-center py-24 text-secondary-light">No user databases found.</td></tr>';
            return;
        }

        body.innerHTML = '';
        databases.forEach(db => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <iconify-icon icon="solar:database-bold" class="text-primary-600"></iconify-icon>
                        <span class="fw-medium">${db.name}</span>
                    </div>
                </td>
                <td><span class="text-secondary-light">${db.size} MB</span></td>
                <td class="text-center">
                    <div class="d-flex align-items-center justify-content-center gap-2">
                        <button type="button" class="btn btn-sm btn-outline-info d-inline-flex align-items-center gap-1" onclick="backupDatabase('${db.name}', this)">
                            <iconify-icon icon="solar:download-square-bold" class="text-sm"></iconify-icon>
                            <?php echo t_databases('backup', 'Backup'); ?>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" onclick="deleteDatabase('${db.name}')">
                            <iconify-icon icon="solar:trash-bin-minimalistic-bold" class="text-sm"></iconify-icon>
                            <?php echo t_databases('delete', 'Delete'); ?>
                        </button>
                    </div>
                </td>
            `;
            body.appendChild(row);
        });
    }

    // Function to backup database
    function backupDatabase(name, btn) {
        toggleLoading(btn, true, 'Backing up...');
        
        const formData = new FormData();
        formData.append('name', name);
        formData.append('csrf_token', window.csrfToken);

        fetch(DATABASES_API + '?action=backup', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            toggleLoading(btn, false);
            if (data.success) {
                showNotification(data.message, 'success');
            } else {
                showNotification(data.error || 'Failed to create backup', 'error');
            }
        })
        .catch(error => {
            toggleLoading(btn, false);
            showNotification('Error: ' + error.message, 'error');
        });
    }

    // Function to delete database
    function deleteDatabase(name) {
        if (!confirm(`Are you sure you want to delete database "${name}"?\nThis action cannot be undone and all data will be lost.`)) {
            return;
        }

        const formData = new FormData();
        formData.append('name', name);
        formData.append('csrf_token', window.csrfToken);

        fetch(DATABASES_API + '?action=delete', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                loadDatabases();
            } else {
                showNotification(data.error || 'Failed to delete database', 'error');
            }
        })
        .catch(error => {
            showNotification('Error: ' + error.message, 'error');
        });
    }
</script>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

