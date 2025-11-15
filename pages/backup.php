<?php
/**
 * Laragon Dashboard - Backup Page
 * Version: 3.0.0
 * Description: Backup management with project + database dumps
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
$backupTranslations = [];
if (function_exists('load_translations')) {
    $backupTranslations = load_translations('backup');
}

function t_backup($key, $fallback = '') {
    global $backupTranslations;
    if (function_exists('t')) {
        $translated = t('backup.' . $key);
        if ($translated !== 'backup.' . $key) {
            return $translated;
        }
    }
    return $backupTranslations[$key] ?? ($fallback ?: $key);
}

// Get projects list
$allProjects = [];
if (function_exists('getAllProjects')) {
    $allProjects = getAllProjects();
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <strong><p class="fw-semibold mb-0"><?php echo t_backup('backup', 'Backup'); ?></p></strong>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        <?php echo t_backup('dashboard', 'Dashboard'); ?>
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium"><?php echo t_backup('backup', 'Backup'); ?></li>
            </ul>
        </div>

        <!-- Create Backup Section -->
        <div class="card shadow-none border radius-12 mb-24">
            <div class="card-body p-24">
                <div class="d-flex align-items-center justify-content-between mb-16">
                    <strong><p class="fw-semibold mb-0"><?php echo t_backup('create_backup', 'Create Backup'); ?></p></strong>
                    <button type="button" class="btn btn-sm btn-primary-600" onclick="loadBackups()">
                        <iconify-icon icon="solar:refresh-bold" class="icon"></iconify-icon>
                        <?php echo t_backup('refresh_list', 'Refresh'); ?>
                    </button>
                </div>
                
                <form id="createBackupForm" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label fw-medium mb-8"><?php echo t_backup('select_project', 'Select Project'); ?></label>
                        <select class="form-select" id="backup-project" name="project" required>
                            <option value=""><?php echo t_backup('choose_project', 'Choose a project...'); ?></option>
                            <?php foreach ($allProjects as $project): ?>
                                <option value="<?php echo htmlspecialchars($project['name']); ?>">
                                    <?php echo htmlspecialchars($project['name']); ?> (<?php echo htmlspecialchars($project['platform']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="col-md-5">
                        <label class="form-label fw-medium mb-8"><?php echo t_backup('select_database', 'Select Database'); ?> <span class="text-secondary-light text-xs">(<?php echo t_backup('optional', 'Optional'); ?>)</span></label>
                        <select class="form-select" id="backup-database" name="database">
                            <option value=""><?php echo t_backup('no_database', 'No database backup'); ?></option>
                        </select>
                    </div>
                    
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary-600 w-100">
                            <iconify-icon icon="solar:cloud-storage-bold" class="icon"></iconify-icon>
                            <?php echo t_backup('create', 'Create'); ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Backups List -->
        <div class="card shadow-none border radius-12">
            <div class="card-body p-24">
                <div class="d-flex align-items-center justify-content-between mb-16">
                    <strong><p class="fw-semibold mb-0"><?php echo t_backup('backup_history', 'Backup History'); ?></p></strong>
                    <span class="text-secondary-light text-sm" id="backup-count"><?php echo t_backup('loading', 'Loading...'); ?></span>
                </div>
                
                <div id="backups-list">
                    <div class="text-center p-24">
                        <div class="spinner-border text-primary-600" role="status">
                            <span class="visually-hidden"><?php echo t_backup('loading', 'Loading...'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>

<script>
// Format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

// Format date
function formatDate(timestamp) {
    const date = new Date(timestamp * 1000);
    return date.toLocaleString();
}

// Load databases for selected project
document.getElementById('backup-project').addEventListener('change', function() {
    const projectName = this.value;
    const databaseSelect = document.getElementById('backup-database');
    
    if (!projectName) {
        databaseSelect.innerHTML = '<option value=""><?php echo t_backup('no_database', 'No database backup'); ?></option>';
        return;
    }
    
    // Load databases
    fetch('api/backup.php?action=databases')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.databases) {
                databaseSelect.innerHTML = '<option value=""><?php echo t_backup('no_database', 'No database backup'); ?></option>';
                data.databases.forEach(db => {
                    const option = document.createElement('option');
                    option.value = db;
                    option.textContent = db;
                    databaseSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Error loading databases:', error);
        });
});

// Create backup
document.getElementById('createBackupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const project = document.getElementById('backup-project').value;
    const database = document.getElementById('backup-database').value;
    
    if (!project) {
        alert('<?php echo htmlspecialchars(t_backup('select_project_required', 'Please select a project'), ENT_QUOTES); ?>');
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'create');
    formData.append('project', project);
    if (database) {
        formData.append('database', database);
    }
    
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span><?php echo htmlspecialchars(t_backup('creating', 'Creating...'), ENT_QUOTES); ?>';
    
    fetch('api/backup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('<?php echo htmlspecialchars(t_backup('backup_created', 'Backup created successfully'), ENT_QUOTES); ?>');
            loadBackups();
            document.getElementById('createBackupForm').reset();
            document.getElementById('backup-database').innerHTML = '<option value=""><?php echo htmlspecialchars(t_backup('no_database', 'No database backup'), ENT_QUOTES); ?></option>';
        } else {
            alert('<?php echo htmlspecialchars(t_backup('error', 'Error'), ENT_QUOTES); ?>: ' + (data.error || '<?php echo htmlspecialchars(t_backup('unknown_error', 'Unknown error'), ENT_QUOTES); ?>'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('<?php echo htmlspecialchars(t_backup('error_creating_backup', 'Error creating backup'), ENT_QUOTES); ?>');
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
});

// Load backups list
function loadBackups() {
    const backupsList = document.getElementById('backups-list');
    backupsList.innerHTML = '<div class="text-center p-24"><div class="spinner-border text-primary-600" role="status"><span class="visually-hidden"><?php echo htmlspecialchars(t_backup('loading', 'Loading...'), ENT_QUOTES); ?></span></div></div>';
    
    fetch('api/backup.php?action=list')
        .then(response => response.json())
        .then(data => {
            if (data.success && data.backups) {
                const backups = data.backups;
                document.getElementById('backup-count').textContent = backups.length + ' <?php echo htmlspecialchars(t_backup('backups', 'backups'), ENT_QUOTES); ?>';
                
                if (backups.length === 0) {
                    backupsList.innerHTML = '<div class="text-center p-24"><iconify-icon icon="solar:cloud-storage-outline" class="text-secondary-light text-5xl mb-16"></iconify-icon><p class="text-secondary-light mb-0"><?php echo htmlspecialchars(t_backup('no_backups', 'No backups found'), ENT_QUOTES); ?></p></div>';
                    return;
                }
                
                let html = '<div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th><?php echo htmlspecialchars(t_backup('project', 'Project'), ENT_QUOTES); ?></th><th><?php echo htmlspecialchars(t_backup('database', 'Database'), ENT_QUOTES); ?></th><th><?php echo htmlspecialchars(t_backup('created', 'Created'), ENT_QUOTES); ?></th><th><?php echo htmlspecialchars(t_backup('project_size', 'Project Size'), ENT_QUOTES); ?></th><th><?php echo htmlspecialchars(t_backup('database_size', 'DB Size'), ENT_QUOTES); ?></th><th class="text-end"><?php echo htmlspecialchars(t_backup('actions', 'Actions'), ENT_QUOTES); ?></th></tr></thead><tbody>';
                
                backups.forEach(backup => {
                    html += '<tr>';
                    html += '<td><strong>' + escapeHtml(backup.project) + '</strong></td>';
                    html += '<td>' + (backup.database_zip ? '<span class="badge bg-info-600">' + escapeHtml(backup.database || 'N/A') + '</span>' : '<span class="text-secondary-light">-</span>') + '</td>';
                    html += '<td><span class="text-secondary-light text-sm">' + formatDate(backup.created) + '</span></td>';
                    html += '<td><span class="text-secondary-light text-sm">' + formatFileSize(backup.project_size) + '</span></td>';
                    html += '<td>' + (backup.database_size > 0 ? '<span class="text-secondary-light text-sm">' + formatFileSize(backup.database_size) + '</span>' : '<span class="text-secondary-light">-</span>') + '</td>';
                    html += '<td class="text-end">';
                    html += '<div class="d-flex align-items-center justify-content-end gap-2">';
                    html += '<a href="api/backup.php?action=download_project&project=' + encodeURIComponent(backup.project) + '&timestamp=' + encodeURIComponent(backup.timestamp) + '" class="btn btn-sm btn-outline-primary-600" title="<?php echo htmlspecialchars(t_backup('download_project', 'Download Project'), ENT_QUOTES); ?>"><iconify-icon icon="solar:download-bold"></iconify-icon></a>';
                    if (backup.database_zip) {
                        html += '<a href="api/backup.php?action=download_database&project=' + encodeURIComponent(backup.project) + '&timestamp=' + encodeURIComponent(backup.timestamp) + '" class="btn btn-sm btn-outline-info-600" title="<?php echo htmlspecialchars(t_backup('download_database', 'Download Database'), ENT_QUOTES); ?>"><iconify-icon icon="solar:database-bold"></iconify-icon></a>';
                    }
                    html += '<button type="button" class="btn btn-sm btn-outline-warning-600" onclick="refreshBackup(\'' + escapeHtml(backup.project) + '\', \'' + escapeHtml(backup.timestamp) + '\', ' + (backup.database_zip ? '\'' + escapeHtml(backup.database || '') + '\'' : 'null') + ')" title="<?php echo htmlspecialchars(t_backup('refresh_backup', 'Refresh Backup'), ENT_QUOTES); ?>"><iconify-icon icon="solar:refresh-bold"></iconify-icon></button>';
                    html += '<button type="button" class="btn btn-sm btn-outline-danger-600" onclick="deleteBackup(\'' + escapeHtml(backup.project) + '\', \'' + escapeHtml(backup.timestamp) + '\')" title="<?php echo htmlspecialchars(t_backup('delete_backup', 'Delete Backup'), ENT_QUOTES); ?>"><iconify-icon icon="solar:trash-bin-bold"></iconify-icon></button>';
                    html += '</div>';
                    html += '</td>';
                    html += '</tr>';
                });
                
                html += '</tbody></table></div>';
                backupsList.innerHTML = html;
            } else {
                backupsList.innerHTML = '<div class="text-center p-24"><iconify-icon icon="solar:cloud-storage-outline" class="text-secondary-light text-5xl mb-16"></iconify-icon><p class="text-secondary-light mb-0"><?php echo htmlspecialchars(t_backup('no_backups', 'No backups found'), ENT_QUOTES); ?></p></div>';
                document.getElementById('backup-count').textContent = '0 <?php echo htmlspecialchars(t_backup('backups', 'backups'), ENT_QUOTES); ?>';
            }
        })
        .catch(error => {
            console.error('Error loading backups:', error);
            backupsList.innerHTML = '<div class="alert alert-danger"><iconify-icon icon="solar:danger-triangle-bold"></iconify-icon> <?php echo htmlspecialchars(t_backup('error_loading_backups', 'Error loading backups'), ENT_QUOTES); ?></div>';
        });
}

// Delete backup
function deleteBackup(project, timestamp) {
    if (!confirm('<?php echo htmlspecialchars(t_backup('confirm_delete', 'Are you sure you want to delete this backup?'), ENT_QUOTES); ?>')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'delete');
    formData.append('project', project);
    formData.append('timestamp', timestamp);
    
    fetch('api/backup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('<?php echo htmlspecialchars(t_backup('backup_deleted', 'Backup deleted successfully'), ENT_QUOTES); ?>');
            loadBackups();
        } else {
            alert('<?php echo htmlspecialchars(t_backup('error', 'Error'), ENT_QUOTES); ?>: ' + (data.error || '<?php echo htmlspecialchars(t_backup('unknown_error', 'Unknown error'), ENT_QUOTES); ?>'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('<?php echo htmlspecialchars(t_backup('error_deleting_backup', 'Error deleting backup'), ENT_QUOTES); ?>');
    });
}

// Refresh backup
function refreshBackup(project, timestamp, database) {
    if (!confirm('<?php echo htmlspecialchars(t_backup('confirm_refresh', 'Are you sure you want to refresh this backup? The old backup will be deleted and a new one created.'), ENT_QUOTES); ?>')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('action', 'refresh');
    formData.append('project', project);
    formData.append('timestamp', timestamp);
    if (database) {
        formData.append('database', database);
    }
    
    fetch('api/backup.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('<?php echo htmlspecialchars(t_backup('backup_refreshed', 'Backup refreshed successfully'), ENT_QUOTES); ?>');
            loadBackups();
        } else {
            alert('<?php echo htmlspecialchars(t_backup('error', 'Error'), ENT_QUOTES); ?>: ' + (data.error || '<?php echo htmlspecialchars(t_backup('unknown_error', 'Unknown error'), ENT_QUOTES); ?>'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('<?php echo htmlspecialchars(t_backup('error_refreshing_backup', 'Error refreshing backup'), ENT_QUOTES); ?>');
    });
}

// Escape HTML
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Load backups on page load
document.addEventListener('DOMContentLoaded', function() {
    loadBackups();
});
</script>
