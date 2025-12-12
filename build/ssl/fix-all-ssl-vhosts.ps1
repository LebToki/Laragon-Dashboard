# Fix SSL Configuration for All Virtual Hosts
# This script ensures all virtual hosts with SSL use the correct wildcard certificate

Write-Host "=== Fixing SSL Configuration for All Virtual Hosts ===" -ForegroundColor Cyan
Write-Host ""

$sitesEnabled = "C:\laragon\etc\apache2\sites-enabled"
$sslCert = "C:/laragon/etc/ssl/localhost+2.pem"
$sslKey = "C:/laragon/etc/ssl/localhost+2-key.pem"

if (-not (Test-Path $sslCert)) {
    Write-Host "Error: SSL certificate not found at $sslCert" -ForegroundColor Red
    Write-Host "Please run regenerate-ssl-wildcard.ps1 first" -ForegroundColor Yellow
    exit 1
}

$vhosts = Get-ChildItem $sitesEnabled -Filter "*.conf"
Write-Host "Found $($vhosts.Count) virtual host configuration files" -ForegroundColor Yellow
Write-Host ""

$fixed = 0
$skipped = 0
$errors = 0

foreach ($vhost in $vhosts) {
    $content = Get-Content $vhost.FullName -Raw
    $originalContent = $content
    
    # Check if this virtual host has SSL (port 443)
    if ($content -match "<VirtualHost.*443") {
        # Check if it needs fixing
        $needsFix = $false
        
        # Check for old laragon.crt/laragon.key
        if ($content -match "laragon\.crt|laragon\.key") {
            $needsFix = $true
            $content = $content -replace "laragon\.crt", "localhost+2.pem"
            $content = $content -replace "laragon\.key", "localhost+2-key.pem"
        }
        
        # Check if SSL is enabled but certificates are missing
        if ($content -match "SSLEngine\s+on" -and $content -notmatch "SSLCertificateFile") {
            $needsFix = $true
            # Add SSL certificate configuration before closing VirtualHost tag
            $sslConfig = @"

    SSLEngine on
    SSLCertificateFile      $sslCert
    SSLCertificateKeyFile   $sslKey

"@
            $content = $content -replace "(</VirtualHost>)", "$sslConfig`$1"
        }
        
        # Check if certificates point to wrong location
        if ($content -match "SSLCertificateFile" -and $content -notmatch "localhost\+2\.pem") {
            $needsFix = $true
            # Replace any certificate paths with the correct ones
            $content = $content -replace "SSLCertificateFile\s+[^\r\n]+", "SSLCertificateFile      $sslCert"
            $content = $content -replace "SSLCertificateKeyFile\s+[^\r\n]+", "SSLCertificateKeyFile   $sslKey"
        }
        
        if ($needsFix) {
            try {
                $content | Set-Content $vhost.FullName -NoNewline -Encoding UTF8
                Write-Host "Fixed: $($vhost.Name)" -ForegroundColor Green
                $fixed++
            } catch {
                Write-Host "Error fixing $($vhost.Name): $($_.Exception.Message)" -ForegroundColor Red
                $errors++
            }
        } else {
            $skipped++
        }
    } else {
        $skipped++
    }
}

Write-Host ""
Write-Host "=== Summary ===" -ForegroundColor Cyan
Write-Host "Fixed: $fixed virtual hosts" -ForegroundColor Green
Write-Host "Already correct: $skipped virtual hosts" -ForegroundColor Yellow
if ($errors -gt 0) {
    Write-Host "Errors: $errors virtual hosts" -ForegroundColor Red
} else {
    Write-Host "Errors: $errors virtual hosts" -ForegroundColor Green
}
Write-Host ""

if ($fixed -gt 0) {
    Write-Host "Virtual hosts have been updated with the wildcard SSL certificate." -ForegroundColor Green
    Write-Host "The certificate covers: localhost, 127.0.0.1, ::1, and *.local" -ForegroundColor Gray
    Write-Host ""
    Write-Host "You need to restart Apache for changes to take effect:" -ForegroundColor Yellow
    Write-Host "  sc stop Apache2.4" -ForegroundColor Gray
    Write-Host "  sc start Apache2.4" -ForegroundColor Gray
    Write-Host ""
    Write-Host "Or if running as Administrator:" -ForegroundColor Yellow
    Write-Host "  C:\laragon\bin\apache\httpd-2.4.62-240904-win64-VS17\bin\httpd.exe -k restart" -ForegroundColor Gray
} else {
    Write-Host "All virtual hosts are already correctly configured!" -ForegroundColor Green
}

Write-Host ""
