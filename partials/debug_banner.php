<?php
/**
 * Debug Banner - Shows path and asset loading information
 * Can be enabled/disabled via Preferences page
 */

// Check if debug banner is enabled (via preferences or APP_DEBUG constant)
$showDebugBanner = false;

// First check user preferences
if (function_exists('getDashboardPreferences')) {
    $prefs = getDashboardPreferences();
    $showDebugBanner = isset($prefs['debug_banner']) ? (bool)$prefs['debug_banner'] : false;
}

// Fall back to APP_DEBUG constant if preferences not set
if (!$showDebugBanner && defined('APP_DEBUG')) {
    $showDebugBanner = APP_DEBUG;
}

// Don't show if disabled
if (!$showDebugBanner) {
    return;
}

// Get current paths
$baseUrl = defined('BASE_URL') ? BASE_URL : 'NOT SET';
$assetsUrl = defined('ASSETS_URL') ? ASSETS_URL : 'NOT SET';
$documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? 'NOT SET';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? 'NOT SET';
$requestUri = $_SERVER['REQUEST_URI'] ?? 'NOT SET';
$scriptFile = $_SERVER['SCRIPT_FILENAME'] ?? 'NOT SET';

// Detect server type
$appRootNormalized = str_replace('\\', '/', rtrim(defined('APP_ROOT') ? APP_ROOT : __DIR__ . '/..', '/\\'));
$docRootNormalized = str_replace('\\', '/', rtrim($documentRoot, '/\\'));
$isBuiltInServer = ($docRootNormalized === $appRootNormalized);
$serverType = $isBuiltInServer ? 'PHP Built-in Server' : 'Apache/Nginx';

// Check if CSS files exist
$cssFiles = [
    'style.css' => defined('ASSETS_URL') ? ASSETS_URL . '/css/style.css' : '/assets/css/style.css',
    'bootstrap.min.css' => defined('ASSETS_URL') ? ASSETS_URL . '/css/lib/bootstrap.min.css' : '/assets/css/lib/bootstrap.min.css',
    'remixicon.css' => defined('ASSETS_URL') ? ASSETS_URL . '/css/remixicon.css' : '/assets/css/remixicon.css',
];

$cssStatus = [];
foreach ($cssFiles as $name => $url) {
    $fullPath = $_SERVER['DOCUMENT_ROOT'] . $url;
    $cssStatus[$name] = [
        'url' => $url,
        'fullPath' => $fullPath,
        'exists' => file_exists($fullPath),
        'readable' => file_exists($fullPath) ? is_readable($fullPath) : false
    ];
}

// Check service worker status
$swRegistered = false;
$swScope = '';
?>
<div id="debug-banner" style="position: fixed; top: 0; left: 0; right: 0; background: #ff6b6b; color: white; padding: 10px; z-index: 99999; font-family: monospace; font-size: 11px; max-height: 200px; overflow-y: auto; box-shadow: 0 2px 10px rgba(0,0,0,0.3);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
        <strong style="font-size: 12px;">🐛 DEBUG MODE - CSS Loading Diagnostics</strong>
        <button onclick="document.getElementById('debug-banner').style.display='none'" style="background: rgba(255,255,255,0.2); border: 1px solid white; color: white; padding: 4px 8px; cursor: pointer; border-radius: 3px;">Hide</button>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 10px; font-size: 10px;">
        <div>
            <strong>Server Type:</strong> <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px; color: <?php echo $isBuiltInServer ? '#ffd43b' : '#51cf66'; ?>;"><?php echo htmlspecialchars($serverType); ?></span><br>
            <strong>Paths:</strong><br>
            BASE_URL: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px; <?php echo $baseUrl === '' ? 'color: #ffd43b;' : ''; ?>"><?php echo $baseUrl === '' ? '(empty - OK for built-in server)' : htmlspecialchars($baseUrl); ?></span><br>
            ASSETS_URL: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars($assetsUrl); ?></span><br>
            DOCUMENT_ROOT: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars($documentRoot); ?></span><br>
            APP_ROOT: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars(defined('APP_ROOT') ? APP_ROOT : 'NOT SET'); ?></span>
        </div>
        
        <div>
            <strong>Request Info:</strong><br>
            SCRIPT_NAME: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars($scriptName); ?></span><br>
            SCRIPT_FILENAME: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars($scriptFile); ?></span><br>
            REQUEST_URI: <span style="background: rgba(0,0,0,0.2); padding: 2px 4px; border-radius: 2px;"><?php echo htmlspecialchars($requestUri); ?></span>
        </div>
        
        <div>
            <strong>CSS Files Status:</strong><br>
            <?php foreach ($cssStatus as $name => $status): ?>
                <span style="color: <?php echo $status['exists'] && $status['readable'] ? '#51cf66' : '#ff6b6b'; ?>;">
                    <?php echo $status['exists'] && $status['readable'] ? '✓' : '✗'; ?>
                </span>
                <?php echo htmlspecialchars($name); ?> 
                <span style="font-size: 9px; opacity: 0.8;">(<?php echo $status['exists'] ? 'EXISTS' : 'MISSING'; ?>)</span><br>
            <?php endforeach; ?>
        </div>
        
        <div>
            <strong>CSS URLs (test in browser):</strong><br>
            <?php foreach ($cssStatus as $name => $status): ?>
                <a href="<?php echo htmlspecialchars($status['url']); ?>" target="_blank" style="color: #ffd43b; text-decoration: underline; font-size: 9px;">
                    <?php echo htmlspecialchars($name); ?>
                </a><br>
            <?php endforeach; ?>
        </div>
    </div>
    
    <div style="margin-top: 8px; padding-top: 8px; border-top: 1px solid rgba(255,255,255,0.3); font-size: 9px;">
        <strong>Service Worker:</strong> <span id="sw-status">Checking...</span> | 
        <strong>Cache:</strong> <span id="cache-status">Checking...</span> |
        <button onclick="clearServiceWorkerCache()" style="background: rgba(255,255,255,0.2); border: 1px solid white; color: white; padding: 2px 6px; cursor: pointer; border-radius: 2px; font-size: 9px;">Clear SW Cache</button>
    </div>
</div>

<script>
(function() {
    // Check service worker status
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.getRegistrations().then(function(registrations) {
            const swStatus = document.getElementById('sw-status');
            if (registrations.length > 0) {
                swStatus.textContent = 'REGISTERED (' + registrations.length + ')';
                swStatus.style.color = '#ff6b6b';
            } else {
                swStatus.textContent = 'NOT REGISTERED';
                swStatus.style.color = '#51cf66';
            }
        });
    } else {
        document.getElementById('sw-status').textContent = 'NOT SUPPORTED';
    }
    
    // Check cache status
    if ('caches' in window) {
        caches.keys().then(function(cacheNames) {
            const cacheStatus = document.getElementById('cache-status');
            if (cacheNames.length > 0) {
                cacheStatus.textContent = cacheNames.length + ' cache(s): ' + cacheNames.join(', ');
                cacheStatus.style.color = '#ff6b6b';
            } else {
                cacheStatus.textContent = 'NO CACHES';
                cacheStatus.style.color = '#51cf66';
            }
        });
    }
    
    // Function to clear service worker cache
    window.clearServiceWorkerCache = function() {
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.getRegistrations().then(function(registrations) {
                registrations.forEach(function(registration) {
                    registration.unregister();
                });
            });
        }
        
        if ('caches' in window) {
            caches.keys().then(function(cacheNames) {
                return Promise.all(cacheNames.map(function(cacheName) {
                    return caches.delete(cacheName);
                }));
            }).then(function() {
                alert('Service Worker and caches cleared! Reloading...');
                window.location.reload();
            });
        } else {
            alert('Cache API not supported');
        }
    };
    
    // Check CSS loading
    window.addEventListener('load', function() {
        const styleSheets = Array.from(document.styleSheets);
        const loadedCSS = [];
        const failedCSS = [];
        
        styleSheets.forEach(function(sheet) {
            try {
                if (sheet.href) {
                    loadedCSS.push(sheet.href);
                }
            } catch (e) {
                // Cross-origin stylesheet
            }
        });
        
        // Check for missing CSS by looking at computed styles
        const testElement = document.createElement('div');
        testElement.className = 'btn btn-primary-600';
        document.body.appendChild(testElement);
        const computedStyle = window.getComputedStyle(testElement);
        const hasBootstrap = computedStyle.display !== '' && computedStyle.padding !== '';
        document.body.removeChild(testElement);
        
        if (!hasBootstrap) {
            const banner = document.getElementById('debug-banner');
            banner.style.background = '#ff6b6b';
            const warning = document.createElement('div');
            warning.style.marginTop = '8px';
            warning.style.padding = '8px';
            warning.style.background = 'rgba(0,0,0,0.3)';
            warning.style.borderRadius = '4px';
            warning.innerHTML = '<strong>⚠️ CSS NOT LOADING!</strong> Bootstrap styles not detected. Check Network tab for 404 errors.';
            banner.appendChild(warning);
        }
    });
})();
</script>

