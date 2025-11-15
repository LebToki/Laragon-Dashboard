<?php
/**
 * Application: Laragon | Tools Tab Partial
 * Description: Tools tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'tools' ? 'active' : ''; ?>" id="tools">
    <header class="header">
        <div class="header__search"><?php echo $translations['breadcrumb_server_tools'] ?? 'My Development Server Tools'; ?></div>
        <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
    </header>
    <div class="container-fluid px-3 py-4">
        <div class="row">
            <div class="col-12">
                <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['quick_tools'] ?? 'Quick Tools'; ?></p></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <strong><p style="color: #fff;"><?php echo $translations['cache_management'] ?? 'Cache Management'; ?></p></strong>
                    <button class="btn btn-warning" onclick="clearCache()"><?php echo $translations['clear_cache'] ?? 'Clear Cache'; ?></button>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <strong><p style="color: #fff;"><?php echo $translations['database_optimization'] ?? 'Database Optimization'; ?></p></strong>
                    <select id="optimize-db-select" class="form-select mb-2">
                        <option value=""><?php echo $translations['select_database'] ?? 'Select Database'; ?></option>
                    </select>
                    <button class="btn btn-success" onclick="optimizeDatabase()"><?php echo $translations['optimize'] ?? 'Optimize'; ?></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <strong><p style="color: #fff;"><?php echo $translations['project_actions'] ?? 'Project Actions'; ?></p></strong>
                    <select id="project-select" class="form-select mb-2">
                        <option value=""><?php echo $translations['select_project'] ?? 'Select Project'; ?></option>
                    </select>
                    <div class="btn-group-vertical w-100">
                        <button class="btn btn-info mb-2" onclick="gitStatus()"><?php echo $translations['git_status'] ?? 'Git Status'; ?></button>
                        <button class="btn btn-primary mb-2" onclick="composerInstall()"><?php echo $translations['composer_install'] ?? 'Composer Install'; ?></button>
                        <button class="btn btn-secondary mb-2" onclick="npmInstall()"><?php echo $translations['npm_install'] ?? 'NPM Install'; ?></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card p-3">
                    <strong><p style="color: #fff;"><?php echo $translations['system_info'] ?? 'System Information'; ?></p></strong>
                    <button class="btn btn-info" onclick="showPhpInfo()"><?php echo $translations['php_info'] ?? 'PHP Info'; ?></button>
                </div>
            </div>
        </div>
        <!-- Self-Update Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card p-3">
                    <strong><p style="color: #fff;">🔄 Self-Update (Git)</p></strong>
                    <p class="small" style="color: #fff;">Current Version: <strong><?php echo APP_VERSION; ?></strong></p>
                    <button class="btn btn-primary" onclick="checkForUpdates()">Check for Updates (Git)</button>
                    <div id="update-status" class="mt-2"></div>
                    <div id="update-progress" class="mt-2" style="display: none;">
                        <div class="progress">
                            <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%">0%</div>
                        </div>
                        <p class="small mt-2" id="progress-text">Preparing download...</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="tools-output" class="mt-3"></div>
    </div>
</div>
