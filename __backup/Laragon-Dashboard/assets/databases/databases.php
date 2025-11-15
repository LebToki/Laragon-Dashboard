<?php
/**
 * Application: Laragon | Databases Tab Partial
 * Description: Databases tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'databases' ? 'active' : ''; ?>" id="databases" style="display: <?php echo $activeTab === 'databases' ? 'block' : 'none'; ?>;">
    <div class="container-fluid px-3 py-4">
        <!-- Tab Content Container -->
        <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px;">
        <div class="row">
            <div class="col-12">
                <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['databases_tab'] ?? 'Databases'; ?></p></strong>
            </div>
        </div>
        <div id="database-manager">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong><p style="color: #fff;"><?php echo $translations['select_database'] ?? 'Select Database'; ?></p></strong>
                    <select id="database-select" class="form-select">
                        <option value=""><?php echo $translations['loading'] ?? 'Loading...'; ?></option>
                    </select>
                </div>
                <div class="col-md-6">
                    <strong><p style="color: #fff;"><?php echo $translations['database_size'] ?? 'Database Size'; ?></p></strong>
                    <p id="database-size">-</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <strong><p style="color: #fff;"><?php echo $translations['tables'] ?? 'Tables'; ?></p></strong>
                    <div id="tables-list" class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo $translations['table_name'] ?? 'Table Name'; ?></th>
                                    <th><?php echo $translations['rows'] ?? 'Rows'; ?></th>
                                    <th><?php echo $translations['size'] ?? 'Size'; ?></th>
                                    <th><?php echo $translations['actions'] ?? 'Actions'; ?></th>
                                </tr>
                            </thead>
                            <tbody id="tables-tbody">
                                <tr><td colspan="4"><?php echo $translations['select_database_first'] ?? 'Please select a database first'; ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <strong><p style="color: #fff;"><?php echo $translations['run_query'] ?? 'Run Query'; ?></p></strong>
                    <textarea id="query-input" class="form-control" rows="5" placeholder="SELECT * FROM table_name LIMIT 10;" style="background-color: #023e8a; color: #FFFFFF; border: 1px solid rgba(255,255,255,0.3);"></textarea>
                    <button class="btn btn-primary mt-2" onclick="executeQuery()"><?php echo $translations['execute'] ?? 'Execute'; ?></button>
                    <div id="query-results" class="mt-3"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

