<?php
/**
 * Library Update Script
 * Updates all JavaScript and CSS libraries to latest versions
 * 
 * Usage: php build/update_libraries.php [--dry-run] [--release]
 */

set_time_limit(600); // 10 minutes

$dryRun = in_array('--dry-run', $argv);
$release = in_array('--release', $argv);

$baseDir = __DIR__ . '/../assets';

// Library definitions with current and target versions
$libraries = [
    'jquery' => [
        'current' => '3.7.1',
        'target' => '3.7.2',
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.2/jquery.min.js' => 'js/lib/jquery-3.7.2.min.js'
        ]
    ],
    'bootstrap' => [
        'current' => '5.3.0', // Update based on actual version
        'target' => '5.3.3',
        'css' => [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' => 'css/lib/bootstrap.min.css'
        ],
        'js' => [
            'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' => 'js/lib/bootstrap.bundle.min.js'
        ]
    ],
    'apexcharts' => [
        'current' => '3.44.0', // Update based on actual version
        'target' => '3.50.0',
        'css' => [
            'https://cdn.jsdelivr.net/npm/apexcharts@3.50.0/dist/apexcharts.css' => 'css/lib/apexcharts.css'
        ],
        'js' => [
            'https://cdn.jsdelivr.net/npm/apexcharts@3.50.0/dist/apexcharts.min.js' => 'js/lib/apexcharts.min.js'
        ]
    ],
    'datatables' => [
        'current' => '1.13.0', // Update based on actual version
        'target' => '1.13.8',
        'css' => [
            'https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css' => 'css/lib/dataTables.min.css'
        ],
        'js' => [
            'https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js' => 'js/lib/dataTables.min.js'
        ]
    ],
    'iconify' => [
        'current' => '1.0.0', // Update based on actual version
        'target' => '2.0.0',
        'js' => [
            'https://code.iconify.design/iconify-icon/2.0.0/iconify-icon.min.js' => 'js/lib/iconify-icon.min.js'
        ]
    ],
    'codemirror' => [
        'current' => '5.65.2',
        'target' => '5.65.2', // Keep current, 6.x has breaking changes
        'css' => [
            'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css' => 'css/lib/codemirror.min.css',
            'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css' => 'css/lib/theme/monokai.min.css'
        ],
        'js' => [
            'https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js' => 'js/lib/codemirror.min.js'
        ]
    ],
    'flatpickr' => [
        'current' => '4.6.0', // Update based on actual version
        'target' => '4.6.13',
        'css' => [
            'https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css' => 'css/lib/flatpickr.min.css'
        ],
        'js' => [
            'https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js' => 'js/lib/flatpickr.min.js'
        ]
    ],
];

function downloadFile($url, $destination, $dryRun = false) {
    $dir = dirname($destination);
    if (!is_dir($dir)) {
        if (!$dryRun) {
            mkdir($dir, 0755, true);
        }
    }
    
    echo "  Downloading: {$url}\n";
    echo "    -> {$destination}\n";
    
    if ($dryRun) {
        echo "    [DRY RUN - Skipped]\n";
        return true;
    }
    
    // Use cURL if available
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        $fp = fopen($destination, 'wb');
        curl_setopt($ch, CURLOPT_FILE, $fp);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $success = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);
        
        if ($success && $httpCode === 200) {
            echo "    ✓ Success\n";
            return true;
        } else {
            echo "    ✗ Failed (HTTP {$httpCode})\n";
            @unlink($destination);
            return false;
        }
    } else {
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => ['User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'],
                'timeout' => 60,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);
        
        $content = @file_get_contents($url, false, $context);
        if ($content !== false && strlen($content) > 0) {
            file_put_contents($destination, $content);
            echo "    ✓ Success\n";
            return true;
        } else {
            echo "    ✗ Failed\n";
            return false;
        }
    }
}

echo "========================================\n";
echo "Library Update Script\n";
echo "========================================\n";
if ($dryRun) {
    echo "[DRY RUN MODE - No files will be modified]\n";
}
echo "\n";

$successCount = 0;
$failCount = 0;
$skippedCount = 0;

foreach ($libraries as $libName => $libConfig) {
    echo "Updating {$libName}:\n";
    echo "  Current: {$libConfig['current']}\n";
    echo "  Target:  {$libConfig['target']}\n";
    
    if ($libConfig['current'] === $libConfig['target']) {
        echo "  → Already at target version, skipping\n\n";
        $skippedCount++;
        continue;
    }
    
    // Download CSS files
    if (isset($libConfig['css'])) {
        foreach ($libConfig['css'] as $url => $localPath) {
            $destination = $baseDir . '/' . $localPath;
            if (downloadFile($url, $destination, $dryRun)) {
                $successCount++;
            } else {
                $failCount++;
            }
        }
    }
    
    // Download JS files
    if (isset($libConfig['js'])) {
        foreach ($libConfig['js'] as $url => $localPath) {
            $destination = $baseDir . '/' . $localPath;
            if (downloadFile($url, $destination, $dryRun)) {
                $successCount++;
            } else {
                $failCount++;
            }
        }
    }
    
    echo "\n";
}

echo "========================================\n";
echo "Update Complete!\n";
echo "Success: {$successCount}\n";
echo "Failed:  {$failCount}\n";
echo "Skipped: {$skippedCount}\n";
echo "========================================\n";

if (!$dryRun && $failCount === 0) {
    echo "\n✓ All libraries updated successfully!\n";
    echo "⚠ Remember to update version references in:\n";
    echo "  - partials/head.php\n";
    echo "  - partials/scripts.php\n";
    echo "  - Any other files referencing library versions\n";
}

