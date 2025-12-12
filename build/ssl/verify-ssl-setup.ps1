# Verify SSL Setup - Check if everything is configured correctly

Write-Host "=== SSL Setup Verification ===" -ForegroundColor Cyan
Write-Host ""

$laragonRoot = "C:\laragon"
$certPath = Join-Path $laragonRoot "etc\ssl\localhost+2.pem"
$keyPath = Join-Path $laragonRoot "etc\ssl\localhost+2-key.pem"

# Check certificate exists
Write-Host "1. Certificate Files:" -ForegroundColor Yellow
if ((Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "   ✓ Certificate files exist" -ForegroundColor Green
    
    # Check certificate details
    try {
        $cert = New-Object System.Security.Cryptography.X509Certificates.X509Certificate2($certPath)
        $san = $cert.Extensions | Where-Object { $_.Oid.FriendlyName -eq 'Subject Alternative Name' }
        if ($san) {
            $domainCount = ([regex]::Matches($san.Format($false), 'DNS Name=')).Count
            Write-Host "   ✓ Certificate contains $domainCount domains" -ForegroundColor Green
        }
    } catch {
        Write-Host "   ✗ Could not read certificate" -ForegroundColor Red
    }
} else {
    Write-Host "   ✗ Certificate files not found" -ForegroundColor Red
}

Write-Host ""

# Check root CA
Write-Host "2. Root CA Installation:" -ForegroundColor Yellow
$userRoot = Get-ChildItem Cert:\CurrentUser\Root -ErrorAction SilentlyContinue | Where-Object { $_.Subject -like "*mkcert*" -or $_.Issuer -like "*mkcert*" }
$localRoot = Get-ChildItem Cert:\LocalMachine\Root -ErrorAction SilentlyContinue | Where-Object { $_.Subject -like "*mkcert*" -or $_.Issuer -like "*mkcert*" }

if ($userRoot) {
    Write-Host "   ✓ Root CA installed in CurrentUser store" -ForegroundColor Green
} else {
    Write-Host "   ✗ Root CA NOT in CurrentUser store" -ForegroundColor Red
}

if ($localRoot) {
    Write-Host "   ✓ Root CA installed in LocalMachine store (Brave compatible)" -ForegroundColor Green
} else {
    Write-Host "   ⚠ Root CA NOT in LocalMachine store (Brave may show warnings)" -ForegroundColor Yellow
    Write-Host "     To fix: Run as Administrator:" -ForegroundColor Gray
    Write-Host "     Import-Certificate -FilePath `"$env:LOCALAPPDATA\mkcert\rootCA.pem`" -CertStoreLocation Cert:\LocalMachine\Root" -ForegroundColor Gray
}

Write-Host ""

# Check Apache ports
Write-Host "3. Apache Service:" -ForegroundColor Yellow
$port80 = Get-NetTCPConnection -LocalPort 80 -State Listen -ErrorAction SilentlyContinue
$port443 = Get-NetTCPConnection -LocalPort 443 -State Listen -ErrorAction SilentlyContinue

if ($port80) {
    Write-Host "   ✓ Port 80 (HTTP) is listening" -ForegroundColor Green
} else {
    Write-Host "   ✗ Port 80 (HTTP) is NOT listening" -ForegroundColor Red
}

if ($port443) {
    Write-Host "   ✓ Port 443 (HTTPS) is listening" -ForegroundColor Green
} else {
    Write-Host "   ✗ Port 443 (HTTPS) is NOT listening" -ForegroundColor Red
}

Write-Host ""

# Check virtual hosts
Write-Host "4. Virtual Host Configuration:" -ForegroundColor Yellow
$sitesEnabled = Join-Path $laragonRoot "etc\apache2\sites-enabled"
$vhostCount = (Get-ChildItem $sitesEnabled -Filter "*.conf" -ErrorAction SilentlyContinue).Count
Write-Host "   Found $vhostCount virtual host configurations" -ForegroundColor $(if($vhostCount -gt 0){'Green'}else{'Yellow'})

$sslVhostCount = 0
Get-ChildItem $sitesEnabled -Filter "*.conf" -ErrorAction SilentlyContinue | ForEach-Object {
    $content = Get-Content $_.FullName -Raw -ErrorAction SilentlyContinue
    if ($content -match "VirtualHost.*443" -and $content -match "localhost\+2\.pem") {
        $sslVhostCount++
    }
}
Write-Host "   $sslVhostCount virtual hosts configured with SSL" -ForegroundColor $(if($sslVhostCount -gt 0){'Green'}else{'Yellow'})

Write-Host ""
Write-Host "=== Summary ===" -ForegroundColor Cyan
Write-Host ""

$allGood = $true
if (-not (Test-Path $certPath)) { $allGood = $false }
if (-not $userRoot) { $allGood = $false }
if (-not $port443) { $allGood = $false }

if ($allGood) {
    Write-Host "✓ SSL setup is complete!" -ForegroundColor Green
    Write-Host ""
    Write-Host "You can now access your sites via HTTPS:" -ForegroundColor Cyan
    Write-Host "  - https://localhost/" -ForegroundColor White
    Write-Host "  - https://2tinteractive.local/" -ForegroundColor White
    Write-Host "  - https://[any-project].local/" -ForegroundColor White
    Write-Host ""
    if (-not $localRoot) {
        Write-Host "Note: For Brave browser, install root CA to LocalMachine store" -ForegroundColor Yellow
        Write-Host "      (see instructions above)" -ForegroundColor Yellow
    }
} else {
    Write-Host "⚠ Some issues detected. Please review the checks above." -ForegroundColor Yellow
}

Write-Host ""

