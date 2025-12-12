# Regenerate SSL Certificate with Wildcard Support for .local domains
# This will create a certificate that works for all *.local domains

Write-Host "=== Regenerating SSL Certificate with Wildcard Support ===" -ForegroundColor Cyan
Write-Host ""

$laragonRoot = "C:\laragon"
$mkcertPath = Join-Path $laragonRoot "bin\mkcert\mkcert.exe"
$sslDir = Join-Path $laragonRoot "etc\ssl"

# Check if mkcert exists
if (-not (Test-Path $mkcertPath)) {
    Write-Host "Error: mkcert.exe not found at $mkcertPath" -ForegroundColor Red
    exit 1
}

# Backup existing certificates
$certPath = Join-Path $sslDir "localhost+2.pem"
$keyPath = Join-Path $sslDir "localhost+2-key.pem"

if ((Test-Path $certPath) -or (Test-Path $keyPath)) {
    Write-Host "Backing up existing certificates..." -ForegroundColor Yellow
    $backupDir = Join-Path $sslDir "backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
    New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
    if (Test-Path $certPath) { Copy-Item $certPath -Destination $backupDir -Force }
    if (Test-Path $keyPath) { Copy-Item $keyPath -Destination $backupDir -Force }
    Write-Host "Backup created: $backupDir" -ForegroundColor Green
}

# Remove old certificates
Write-Host "Removing old certificates..." -ForegroundColor Yellow
Remove-Item $certPath -Force -ErrorAction SilentlyContinue
Remove-Item $keyPath -Force -ErrorAction SilentlyContinue

# Generate new certificate with wildcard support
Write-Host "Generating new SSL certificate with wildcard support..." -ForegroundColor Yellow
Write-Host "This will cover: localhost, 127.0.0.1, ::1, *.local, and all .local domains" -ForegroundColor Gray
Write-Host ""

Set-Location $sslDir

# Generate certificate with wildcard for .local domains
& $mkcertPath -cert-file "localhost+2.pem" -key-file "localhost+2-key.pem" localhost 127.0.0.1 ::1 "*.local" 2>&1 | Out-Null

if ($LASTEXITCODE -eq 0 -and (Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "SSL certificate regenerated successfully!" -ForegroundColor Green
    Write-Host "Certificate: $certPath" -ForegroundColor Gray
    Write-Host "Private Key: $keyPath" -ForegroundColor Gray
    Write-Host ""
    Write-Host "Certificate now covers:" -ForegroundColor Cyan
    Write-Host "  - localhost" -ForegroundColor White
    Write-Host "  - 127.0.0.1" -ForegroundColor White
    Write-Host "  - ::1 (IPv6)" -ForegroundColor White
    Write-Host "  - *.local (all .local domains)" -ForegroundColor White
    Write-Host ""
} else {
    Write-Host "Error: Failed to generate SSL certificate" -ForegroundColor Red
    exit 1
}

# Check if Apache is running
$apacheService = Get-Service -Name "Apache2.4" -ErrorAction SilentlyContinue
if ($apacheService -and $apacheService.Status -eq 'Running') {
    Write-Host "Apache is running. You need to restart it for the new certificate to take effect." -ForegroundColor Yellow
    Write-Host ""
    Write-Host "To restart Apache:" -ForegroundColor Cyan
    Write-Host "  sc stop Apache2.4" -ForegroundColor Gray
    Write-Host "  sc start Apache2.4" -ForegroundColor Gray
    Write-Host ""
    Write-Host "Or run as Administrator:" -ForegroundColor Cyan
    Write-Host "  C:\laragon\bin\apache\httpd-2.4.62-240904-win64-VS17\bin\httpd.exe -k restart" -ForegroundColor Gray
} else {
    Write-Host "Apache service not found or not running." -ForegroundColor Yellow
}

Write-Host ""
Write-Host "=== Certificate Regeneration Complete ===" -ForegroundColor Green
Write-Host ""
Write-Host "After restarting Apache, try accessing:" -ForegroundColor Cyan
Write-Host "  - https://localhost/" -ForegroundColor White
Write-Host "  - https://2tinteractive.local/" -ForegroundColor White
Write-Host "  - https://[any-project].local/" -ForegroundColor White
Write-Host ""

