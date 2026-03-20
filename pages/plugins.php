<?php
// plugins.php in /pages directory
require_once dirname(__DIR__) . '/includes/autoload.php';
require_once dirname(__DIR__) . '/includes/helpers.php';
require_once dirname(__DIR__) . '/includes/i18n.php';

if (!isAuthenticated()) {
    header('Location: index.php');
    exit;
}

$pageTitle = 'Plugin Hub';
$pageDescription = 'Manage and install plugins';

use LaragonDashboard\Core\PluginManager;

$availablePlugins = PluginManager::getAvailablePlugins();
$installedPlugins = PluginManager::getInstalledPlugins();

include dirname(__DIR__) . '/partials/header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header mb-32">
                <h1 class="page-title"><?php echo $pageTitle; ?></h1>
                <p class="page-description text-secondary-light"><?php echo $pageDescription; ?></p>
            </div>

            <!-- Installed Plugins -->
            <div class="card glass mb-32">
                <div class="card-header">
                    <h2 class="card-title">Installed Plugins</h2>
                </div>
                <div class="card-body">
                    <?php if (empty($installedPlugins)): ?>
                    <div class="text-center p-24">
                        <iconify-icon icon="iconoir:puzzle" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                        <p class="text-secondary-light mb-16">No plugins installed yet. Enhance your dashboard by installing one!</p>
                        <a href="#available-plugins" class="btn btn-primary-600 radius-8 px-20 py-11 d-inline-flex align-items-center gap-2">
                            <iconify-icon icon="solar:download-square-bold" class="text-xl"></iconify-icon>
                            Browse Available Plugins
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="row">
                        <?php foreach ($installedPlugins as $pluginId => $plugin): ?>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5><?php echo htmlspecialchars($availablePlugins[$pluginId]['name'] ?? $pluginId); ?></h5>
                                    <p>Version: <?php echo htmlspecialchars($plugin['version'] ?? '1.0.0'); ?></p>
                                    <button class="btn btn-sm btn-outline-danger" onclick="uninstallPlugin('<?php echo $pluginId; ?>')">
                                        Uninstall
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Available Plugins -->
            <div class="card glass" id="available-plugins">
                <div class="card-header">
                    <h2 class="card-title">Available Plugins</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($availablePlugins as $pluginId => $plugin): ?>
                        <?php $isInstalled = PluginManager::isInstalled($pluginId); ?>
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5><?php echo htmlspecialchars($plugin['name']); ?></h5>
                                    <p><?php echo htmlspecialchars($plugin['description']); ?></p>
                                    <?php if ($isInstalled): ?>
                                    <button class="btn btn-sm btn-success" disabled>Installed</button>
                                    <?php else: ?>
                                    <button class="btn btn-sm btn-primary" onclick="installPlugin('<?php echo $pluginId; ?>', '<?php echo htmlspecialchars($plugin['repo']); ?>')">
                                        Install
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function installPlugin(pluginId, repo) {
    if (!confirm('Install ' + pluginId + '?')) return;
    
    fetch('/api/plugins.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            action: 'install',
            plugin_id: pluginId,
            repo: repo
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.error || data.message);
        }
    });
}

function uninstallPlugin(pluginId) {
    if (!confirm('Uninstall ' + pluginId + '?')) return;
    
    fetch('/api/plugins.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        body: JSON.stringify({
            action: 'uninstall',
            plugin_id: pluginId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert(data.error || data.message);
        }
    });
}
</script>

<?php
include dirname(__DIR__) . '/partials/footer.php';
?>