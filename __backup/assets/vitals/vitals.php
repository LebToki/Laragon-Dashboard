<?php
/**
 * Application: Laragon | Vitals Tab Partial
 * Description: Server Vitals tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'vitals' ? 'active' : ''; ?>" id="vitals">
    <header class="header">
        <div class="header__search"><?php echo $translations['breadcrumb_server_vitals'] ?? 'My Development Server Vitals'; ?></div>
        <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
    </header>
    <div class="container-fluid px-3 py-4">
        <div class="row">
            <div class="col-12">
                <strong><p style="text-align: center;color: #fff; font-size: 24px;">Server's Vitals</p></strong>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <strong><p><?php echo $translations['uptime'] ?? 'Uptime'; ?></p></strong>
                <p id="uptime">Loading...</p>
                <canvas id="uptimeChart"></canvas>
            </div>
            <div class="col-md-6">
                <strong><p><?php echo $translations['memory_usage'] ?? 'Memory Usage'; ?></p></strong>
                <p id="memory-usage">Loading...</p>
                <canvas id="memoryUsageChart"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <strong><p><?php echo $translations['disk_usage'] ?? 'Disk Usage'; ?></p></strong>
                <p id="disk-usage">Loading...</p>
                <canvas id="diskUsageChart"></canvas>
            </div>
            <div class="col-md-6">
                <strong><p>PHP Memory Usage</p></strong>
                <p id="php-memory">Loading...</p>
                <canvas id="phpMemoryChart"></canvas>
            </div>
        </div>
    </div>
</div>

