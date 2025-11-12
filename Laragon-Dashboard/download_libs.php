<?php
/**
 * Download all external libraries locally for offline use
 */

$baseDir = __DIR__ . '/assets/libs';
$libs = [
    'jquery' => [
        'https://code.jquery.com/jquery-3.7.1.min.js' => 'jquery/jquery-3.7.1.min.js'
    ],
    'bootstrap' => [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' => 'bootstrap/bootstrap.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' => 'bootstrap/bootstrap.bundle.min.js'
    ],
    'chartjs' => [
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js' => 'chartjs/chart.umd.min.js'
    ],
    'fontawesome' => [
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css' => 'fontawesome/all.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/brands.min.css' => 'fontawesome/brands.min.css',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/webfonts/fa-solid-900.woff2' => 'fontawesome/webfonts/fa-solid-900.woff2',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/webfonts/fa-regular-400.woff2' => 'fontawesome/webfonts/fa-regular-400.woff2',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/webfonts/fa-brands-400.woff2' => 'fontawesome/webfonts/fa-brands-400.woff2'
    ],
    'iconify' => [
        'https://cdn.jsdelivr.net/npm/@iconify/iconify@3.1.1/dist/iconify.min.js' => 'iconify/iconify.min.js'
    ],
    'fonts' => [
        'https://fonts.gstatic.com/s/ptsans/v18/jizaRExUiTo99u79P0U.ttf' => 'fonts/jizaRExUiTo99u79P0U.ttf',
        'https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLDz8V1s.ttf' => 'fonts/pxiByp8kv8JHgFVrLDz8V1s.ttf',
        'https://fonts.gstatic.com/s/poppins/v24/pxiEyp8kv8JHgFVrFJA.ttf' => 'fonts/pxiEyp8kv8JHgFVrFJA.ttf',
        'https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLGT9V1s.ttf' => 'fonts/pxiByp8kv8JHgFVrLGT9V1s.ttf',
        'https://fonts.gstatic.com/s/poppins/v24/pxiByp8kv8JHgFVrLCz7V1s.ttf' => 'fonts/pxiByp8kv8JHgFVrLCz7V1s.ttf'
    ]
];

// Create directories
$dirs = ['jquery', 'bootstrap', 'chartjs', 'fontawesome/webfonts', 'iconify', 'fonts'];
foreach ($dirs as $dir) {
    $fullPath = $baseDir . '/' . $dir;
    if (!is_dir($fullPath)) {
        mkdir($fullPath, 0755, true);
        echo "Created directory: $dir\n";
    }
}

// Download files
$total = 0;
$success = 0;
foreach ($libs as $libName => $files) {
    echo "\n=== Downloading $libName ===\n";
    foreach ($files as $url => $localPath) {
        $total++;
        $filePath = $baseDir . '/' . $localPath;
        $dir = dirname($filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        echo "Downloading: $localPath ... ";
        $content = @file_get_contents($url);
        if ($content !== false) {
            file_put_contents($filePath, $content);
            echo "OK\n";
            $success++;
        } else {
            echo "FAILED\n";
        }
    }
}

echo "\n=== Summary ===\n";
echo "Total files: $total\n";
echo "Successfully downloaded: $success\n";
echo "Failed: " . ($total - $success) . "\n";

// Create local Google Fonts CSS
echo "\n=== Creating local Google Fonts CSS ===\n";
$fontsCss = "@font-face {
  font-family: 'PT Sans';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url('jizaRExUiTo99u79P0U.ttf') format('truetype');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 300;
  font-display: swap;
  src: url('pxiByp8kv8JHgFVrLDz8V1s.ttf') format('truetype');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 400;
  font-display: swap;
  src: url('pxiEyp8kv8JHgFVrFJA.ttf') format('truetype');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 500;
  font-display: swap;
  src: url('pxiByp8kv8JHgFVrLGT9V1s.ttf') format('truetype');
}
@font-face {
  font-family: 'Poppins';
  font-style: normal;
  font-weight: 700;
  font-display: swap;
  src: url('pxiByp8kv8JHgFVrLCz7V1s.ttf') format('truetype');
}";

file_put_contents($baseDir . '/fonts/google-fonts.css', $fontsCss);
echo "Created google-fonts.css\n";

echo "\nDone! All libraries downloaded to: $baseDir\n";
?>

