<?php
/**
 * Application: Laragon | Vitals Tab Partial
 * Description: Server Vitals tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'vitals' ? 'active' : ''; ?>" id="vitals" style="display: <?php echo $activeTab === 'vitals' ? 'block' : 'none'; ?>;">
    <div class="container-fluid px-3 py-4">
        <!-- Tab Content Container -->
        <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px;">
            <!-- Row 1: Main Metrics -->
            <div class="row g-3 mb-3">
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-1">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label"><?php echo $translations['uptime'] ?? 'Uptime'; ?></span>
                                <h6 class="vitals-card-value mb-0" id="uptime">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-1">
                                <iconify-icon icon="mdi:clock-outline"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-chart-container">
                            <canvas id="uptimeChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-2">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label"><?php echo $translations['memory_usage'] ?? 'Memory Usage'; ?></span>
                                <h6 class="vitals-card-value mb-0" id="memory-usage">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-2">
                                <iconify-icon icon="mdi:memory"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-chart-container">
                            <canvas id="memoryUsageChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-3">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label"><?php echo $translations['disk_usage'] ?? 'Disk Usage'; ?></span>
                                <h6 class="vitals-card-value mb-0" id="disk-usage">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-3">
                                <iconify-icon icon="mdi:harddisk"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-chart-container">
                            <canvas id="diskUsageChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-4">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label">PHP Memory</span>
                                <h6 class="vitals-card-value mb-0" id="php-memory">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-4">
                                <iconify-icon icon="mdi:language-php"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-chart-container">
                            <canvas id="phpMemoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Additional Metrics -->
            <div class="row g-3 mb-3">
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-5">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label">CPU Usage</span>
                                <h6 class="vitals-card-value mb-0" id="cpu-usage">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-5">
                                <iconify-icon icon="mdi:cpu-64-bit"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-progress-container">
                            <div class="vitals-progress-bar">
                                <div class="vitals-progress-fill" id="cpu-progress" style="width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-6">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label">Memory Details</span>
                                <h6 class="vitals-card-value mb-0" id="memory-details">Loading...</h6>
                            </div>
                            <span class="vitals-card-icon-box color-6">
                                <iconify-icon icon="mdi:chart-pie"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-details-list" id="memory-details-list">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-7">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label">Disk Details</span>
                                <h6 class="vitals-card-value mb-0">Multiple Drives</h6>
                            </div>
                            <span class="vitals-card-icon-box color-7">
                                <iconify-icon icon="mdi:server"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-details-list" id="disk-details-list">
                            <!-- Populated by JavaScript -->
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-sm-6">
                    <div class="vitals-card color-8">
                        <div class="vitals-card-header">
                            <div class="vitals-card-content">
                                <span class="vitals-card-label">System Status</span>
                                <h6 class="vitals-card-value mb-0" id="system-status">Active</h6>
                            </div>
                            <span class="vitals-card-icon-box color-8">
                                <iconify-icon icon="mdi:server-network"></iconify-icon>
                            </span>
                        </div>
                        <div class="vitals-status-indicator">
                            <span class="status-dot active"></span>
                            <span class="status-text">All systems operational</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

