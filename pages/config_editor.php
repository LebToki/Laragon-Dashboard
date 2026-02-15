<?php
/**
 * Laragon Dashboard - Config Editor Page
 * Version: 1.0.0
 * Description: Interface for editing service configuration files
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/helpers.php';

if (function_exists('check_auth')) {
    check_auth();
}

include __DIR__ . '/../partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0">Config Editor</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium">Config Editor</li>
            </ul>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="card h-100 radius-12 border">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Select File</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush bg-transparent" id="config-file-list">
                            <div class="p-24 text-center">
                                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card h-100 radius-12 border">
                    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="text-lg fw-semibold mb-0" id="current-file-name">Editor</h6>
                            <p class="text-sm text-secondary-light mb-0" id="current-file-path">Select a file from the left to start editing</p>
                        </div>
                        <button type="button" class="btn btn-primary d-flex align-items-center gap-2" id="save-config-btn" disabled>
                            <iconify-icon icon="solar:diskette-bold" class="text-xl"></iconify-icon>
                            Save Changes
                        </button>
                    </div>
                    <div class="card-body p-0 position-relative">
                        <textarea id="config-editor" class="form-control bg-base border-0 font-monospace p-24" style="height: 600px; resize: none; font-size: 14px; display: none;" spellcheck="false"></textarea>
                        <div id="editor-placeholder" class="p-48 text-center text-secondary-light">
                            <iconify-icon icon="solar:pen-new-square-linear" class="text-5xl mb-16"></iconify-icon>
                            <h5>No File Selected</h5>
                            <p>Select a configuration file from the sidebar to view and edit its content.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const CONFIG_API = 'api/config.php';
    let currentFileKey = null;

    document.addEventListener('DOMContentLoaded', function() {
        loadConfigFileList();
    });

    function loadConfigFileList() {
        fetch(CONFIG_API + '?action=list')
            .then(response => response.json())
            .then(data => {
                const list = document.getElementById('config-file-list');
                list.innerHTML = '';
                
                if (data.success) {
                    Object.entries(data.data).forEach(([key, file]) => {
                        const item = document.createElement('a');
                        item.href = '#';
                        item.className = 'list-group-item list-group-item-action bg-transparent p-16 d-flex align-items-center gap-3';
                        item.innerHTML = `
                            <div class="icon-box bg-primary-100 text-primary-600 rounded-circle p-2 d-flex align-items-center justify-content-center">
                                <iconify-icon icon="solar:file-text-bold" class="text-xl"></iconify-icon>
                            </div>
                            <div>
                                <h6 class="mb-0 text-md">${file.name}</h6>
                                <span class="text-xs text-secondary-light">${file.service}</span>
                            </div>
                        `;
                        item.onclick = (e) => {
                            e.preventDefault();
                            document.querySelectorAll('#config-file-list .active').forEach(el => el.classList.remove('active'));
                            item.classList.add('active');
                            loadFile(key, file);
                        };
                        list.appendChild(item);
                    });
                } else {
                    list.innerHTML = `<div class="p-24 text-danger text-center">Error loading files</div>`;
                }
            });
    }

    function loadFile(key, file) {
        currentFileKey = key;
        document.getElementById('editor-placeholder').style.display = 'none';
        const editor = document.getElementById('config-editor');
        editor.style.display = 'block';
        editor.value = 'Loading...';
        editor.disabled = true;
        
        document.getElementById('current-file-name').textContent = file.name;
        document.getElementById('current-file-path').textContent = file.path;
        document.getElementById('save-config-btn').disabled = true;

        fetch(CONFIG_API + '?action=read&file=' + key)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    editor.value = data.content;
                    editor.disabled = false;
                    document.getElementById('save-config-btn').disabled = false;
                } else {
                    editor.value = 'Error: ' + data.error;
                }
            });
    }

    document.getElementById('save-config-btn').onclick = function() {
        if (!currentFileKey) return;
        
        const btn = this;
        const content = document.getElementById('config-editor').value;
        
        toggleLoading(btn, true, 'Saving...');
        
        const formData = new FormData();
        formData.append('file', currentFileKey);
        formData.append('content', content);
        formData.append('csrf_token', window.csrfToken);
        
        fetch(CONFIG_API + '?action=save', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            toggleLoading(btn, false);
            if (data.success) {
                showNotification(data.message, 'success');
            } else {
                showNotification(data.error || 'Failed to save', 'error');
            }
        })
        .catch(error => {
            toggleLoading(btn, false);
            showNotification('Error: ' + error.message, 'error');
        });
    };
</script>

<style>
    .font-monospace {
        font-family: 'Fira Code', 'Cascadia Code', 'Source Code Pro', monospace !important;
    }
    .icon-box {
        width: 40px;
        height: 40px;
    }
    .list-group-item {
        background-color: transparent !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    .list-group-item:hover {
        background-color: rgba(255, 255, 255, 0.05) !important;
    }
    .list-group-item.active {
        background-color: var(--primary-600) !important;
        border-color: var(--primary-600) !important;
        color: #fff !important;
    }
    [data-theme='light'] .list-group-item.active {
        background-color: var(--primary-50) !important;
        border-color: var(--primary-200) !important;
        color: var(--primary-600) !important;
    }
    #config-editor:focus {
        box-shadow: none;
        background: rgba(0, 0, 0, 0.02);
    }
</style>

<?php include __DIR__ . '/../partials/layouts/layoutBottom.php'; ?>
