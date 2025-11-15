<?php
/**
 * Application: Laragon | Tools Tab Partial
 * Description: Tools tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'tools' ? 'active' : ''; ?>" id="tools" style="display: <?php echo $activeTab === 'tools' ? 'block' : 'none'; ?>;">
    <div class="container-fluid px-3 py-4">
        <!-- Tab Content Container -->
        <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px;">
        <div class="row">
            <div class="col-12">
                <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['quick_tools'] ?? 'Quick Tools'; ?></p></strong>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="overviewcard" style="flex-direction: column; align-items: flex-start; height: auto; padding: 20px;">
                    <div class="overviewcard_icon" style="margin-bottom: 10px;"><?php echo $translations['cache_management'] ?? 'Cache Management'; ?></div>
                    <button class="btn btn-warning" onclick="clearCache()"><?php echo $translations['clear_cache'] ?? 'Clear Cache'; ?></button>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="overviewcard" style="flex-direction: column; align-items: flex-start; height: auto; padding: 20px;">
                    <div class="overviewcard_icon" style="margin-bottom: 10px;"><?php echo $translations['database_optimization'] ?? 'Database Optimization'; ?></div>
                    <select id="optimize-db-select" class="form-select mb-2" style="background-color: #023e8a; color: #fff; border: 1px solid rgba(255,255,255,0.3);">
                        <option value=""><?php echo $translations['select_database'] ?? 'Select Database'; ?></option>
                    </select>
                    <button class="btn btn-success" onclick="optimizeDatabase()"><?php echo $translations['optimize'] ?? 'Optimize'; ?></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="overviewcard" style="flex-direction: column; align-items: flex-start; height: auto; padding: 20px;">
                    <div class="overviewcard_icon" style="margin-bottom: 10px;"><?php echo $translations['project_actions'] ?? 'Project Actions'; ?></div>
                    <select id="project-select" class="form-select mb-2" style="background-color: #023e8a; color: #fff; border: 1px solid rgba(255,255,255,0.3);">
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
                <div class="overviewcard" style="flex-direction: column; align-items: flex-start; height: auto; padding: 20px;">
                    <div class="overviewcard_icon" style="margin-bottom: 10px;"><?php echo $translations['system_info'] ?? 'System Information'; ?></div>
                    <button class="btn btn-info" onclick="showPhpInfo()"><?php echo $translations['php_info'] ?? 'PHP Info'; ?></button>
                </div>
            </div>
        </div>
        <!-- Self-Update Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="overviewcard" style="flex-direction: column; align-items: flex-start; height: auto; padding: 20px;">
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
</div>
