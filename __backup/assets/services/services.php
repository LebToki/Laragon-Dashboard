<?php
/**
 * Application: Laragon | Services Tab Partial
 * Description: Services tab content
 * Version: 2.6.0
 */
?>
<div class="tab-content <?php echo $activeTab === 'services' ? 'active' : ''; ?>" id="services">
    <header class="header">
        <div class="header__search"><?php echo $translations['breadcrumb_server_services'] ?? 'My Development Server Services'; ?></div>
        <div class="header__avatar"><?php echo $translations['welcome_back'] ?? 'Welcome Back!'; ?></div>
    </header>
    <div class="container-fluid px-3 py-4">
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
                <strong><p style="color: #fff;"><?php echo $translations['port_monitor'] ?? 'Port Monitor'; ?></p></strong>
                <button class="btn btn-info" onclick="refreshPorts()"><?php echo $translations['refresh_ports'] ?? 'Refresh Ports'; ?></button>
                <div id="ports-list" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

