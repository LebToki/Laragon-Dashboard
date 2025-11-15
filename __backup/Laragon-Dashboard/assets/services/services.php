<?php
/**
 * Application: Laragon | Services Tab Partial
 * Description: Services tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'services' ? 'active' : ''; ?>" id="services" style="display: <?php echo $activeTab === 'services' ? 'block' : 'none'; ?>;">
    <div class="container-fluid px-3 py-4">
        <!-- Tab Content Container -->
        <div class="tab-content-container" style="background-color: #023e8a; border-radius: 5px; padding: 15px;">
        <div class="row">
            <div class="col-12">
                <strong><p style="text-align: center;color: #fff; font-size: 24px;"><?php echo $translations['services_management'] ?? 'Services Management'; ?></p></strong>
            </div>
        </div>
        <div id="services-list" class="row g-2">
            <!-- Services will be loaded here -->
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <strong><p style="color: #fff; margin: 0;"><?php echo $translations['port_monitor'] ?? 'Port Monitor'; ?></p></strong>
                    <button class="btn btn-outline-primary" onclick="refreshPorts()" style="border-color: #00adef; color: #00adef; background: transparent;">
                        <i class="bi bi-arrow-clockwise"></i> <?php echo $translations['refresh_ports'] ?? 'Refresh Ports'; ?>
                    </button>
                </div>
                <div id="ports-list" class="mt-3"></div>
            </div>
        </div>
        </div>
    </div>
</div>

