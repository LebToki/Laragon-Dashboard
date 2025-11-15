<?php
/**
 * Application: Laragon | Sidebar Navigation
 * Description: Sidebar navigation menu - WowDash Template Structure
 * Version: 2.6.1
 */
?>
<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="index.php" class="sidebar-logo">
            <img src="assets/logo.png" alt="Laragon" class="light-logo">
            <img src="assets/logo-light.png" alt="Laragon" class="dark-logo">
            <img src="assets/logo-icon.png" alt="Laragon" class="logo-icon">
            <span class="sidebar-title">Laragon</span>
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="javascript:void(0)" data-page="servers" class="<?php echo ($currentPage ?? '') === 'servers' ? 'active' : ''; ?>">
                    <iconify-icon icon="carbon:ibm-cloud-bare-metal-servers-vpc" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['servers_tab'] ?? 'Servers'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="mailbox" class="<?php echo ($currentPage ?? '') === 'mailbox' ? 'active' : ''; ?>">
                    <iconify-icon icon="hugeicons:ai-mail-02" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['inbox_tab'] ?? 'Mailbox'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="vitals" class="<?php echo ($currentPage ?? '') === 'vitals' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:vitals" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['vitals_tab'] ?? 'Server Vitals'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="databases" class="<?php echo ($currentPage ?? '') === 'databases' ? 'active' : ''; ?>">
                    <iconify-icon icon="streamline-plump:database-remix" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['databases_tab'] ?? 'Databases'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="services" class="<?php echo ($currentPage ?? '') === 'services' ? 'active' : ''; ?>">
                    <iconify-icon icon="material-symbols:linked-services-outline" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['services_tab'] ?? 'Services'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="logs" class="<?php echo ($currentPage ?? '') === 'logs' ? 'active' : ''; ?>">
                    <iconify-icon icon="carbon:flow-logs-vpc" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['logs_tab'] ?? 'Logs'; ?></span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" data-page="tools" class="<?php echo ($currentPage ?? '') === 'tools' ? 'active' : ''; ?>">
                    <iconify-icon icon="clarity:tools-line" class="menu-icon"></iconify-icon>
                    <span><?php echo $translations['tools_tab'] ?? 'Tools'; ?></span>
                </a>
            </li>
        </ul>
    </div>
</aside>
