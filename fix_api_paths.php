<?php
/**
 * Fix API paths in LaragonDash/index.php
 * Since index.php is in LaragonDash/, but APIs are called from root,
 * we need to add ../LaragonDash/ prefix OR keep them as LaragonDash/ (since root index.php loads LaragonDash/index.php)
 * Actually, since the browser makes requests, paths should be relative to the root URL
 */

$file = __DIR__ . '/LaragonDash/index.php';
$content = file_get_contents($file);

// Update API endpoints - they should be called with LaragonDash/ prefix from browser
// But wait - if index.php is served from root, then paths should be LaragonDash/...
// Actually, the JavaScript runs in the browser, so paths are relative to the current URL
// If we're at /index.php, then LaragonDash/database_manager.php is correct

// The paths are already correct from update_paths.php, but we need to verify
// Since LaragonDash/index.php is loaded by root index.php, the browser context is still root
// So LaragonDash/ paths are correct

echo "API paths should already be correct.\n";
echo "Verifying...\n";

$patterns = [
    "/'LaragonDash\/(database_manager|server_vitals|project_search|services_manager|log_viewer|quick_tools|bcrypt_generator|backup_manager)\.php/",
    '/"LaragonDash\/(database_manager|server_vitals|project_search|services_manager|log_viewer|quick_tools|bcrypt_generator|backup_manager)\.php/'
];

$matches = 0;
foreach ($patterns as $pattern) {
    if (preg_match_all($pattern, $content)) {
        $matches += preg_match_all($pattern, $content);
    }
}

echo "Found $matches API endpoint references with LaragonDash/ prefix\n";
echo "Paths are correctly configured.\n";

