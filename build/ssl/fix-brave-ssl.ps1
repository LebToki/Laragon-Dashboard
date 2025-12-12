# Fix SSL Certificate Trust for Brave Browser
# This script helps configure Brave to trust mkcert certificates

Write-Host "=== Brave Browser SSL Fix ===" -ForegroundColor Cyan
Write-Host ""

$mkcertCARoot = "$env:LOCALAPPDATA\mkcert"
$rootCertPath = Join-Path $mkcertCARoot "rootCA.pem"

# Check if mkcert root CA exists
if (-not (Test-Path $rootCertPath)) {
    Write-Host "Error: mkcert root CA not found at $rootCertPath" -ForegroundColor Red
    Write-Host "Please run setup-ssl.ps1 first to generate certificates" -ForegroundColor Yellow
    exit 1
}

Write-Host "Found mkcert root CA: $rootCertPath" -ForegroundColor Green
Write-Host ""

# Option 1: Install to LocalMachine store (requires Admin)
Write-Host "Option 1: Install Root CA to LocalMachine Store (Recommended)" -ForegroundColor Yellow
Write-Host "This requires Administrator privileges" -ForegroundColor Gray
Write-Host ""
Write-Host "To install manually:" -ForegroundColor Cyan
Write-Host "1. Right-click PowerShell → Run as Administrator" -ForegroundColor White
Write-Host "2. Run: Import-Certificate -FilePath `"$rootCertPath`" -CertStoreLocation Cert:\LocalMachine\Root" -ForegroundColor Gray
Write-Host ""

# Option 2: Enable Brave flag
Write-Host "Option 2: Enable Brave Insecure Localhost Flag" -ForegroundColor Yellow
Write-Host "This allows Brave to accept localhost certificates" -ForegroundColor Gray
Write-Host ""
Write-Host "Steps:" -ForegroundColor Cyan
Write-Host "1. Open Brave browser" -ForegroundColor White
Write-Host "2. Navigate to: brave://flags/#allow-insecure-localhost" -ForegroundColor Gray
Write-Host "3. Set the flag to 'Enabled'" -ForegroundColor White
Write-Host "4. Restart Brave browser" -ForegroundColor White
Write-Host ""

# Option 3: Manual certificate import in Brave
Write-Host "Option 3: Manually Import Certificate in Brave" -ForegroundColor Yellow
Write-Host ""
Write-Host "Steps:" -ForegroundColor Cyan
Write-Host "1. Open Brave browser" -ForegroundColor White
Write-Host "2. Navigate to: brave://settings/security" -ForegroundColor Gray
Write-Host "3. Scroll down to 'Manage certificates'" -ForegroundColor White
Write-Host "4. Click 'Authorities' tab" -ForegroundColor White
Write-Host "5. Click 'Import' and select: $rootCertPath" -ForegroundColor Gray
Write-Host "6. Check 'Trust this certificate for identifying websites'" -ForegroundColor White
Write-Host "7. Click 'OK'" -ForegroundColor White
Write-Host ""

# Try to install to LocalMachine if running as admin
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if ($isAdmin) {
    Write-Host "Attempting to install root CA to LocalMachine store..." -ForegroundColor Yellow
    try {
        Import-Certificate -FilePath $rootCertPath -CertStoreLocation Cert:\LocalMachine\Root -ErrorAction Stop
        Write-Host "Successfully installed root CA to LocalMachine store!" -ForegroundColor Green
        Write-Host "Brave should now trust the certificate after restarting" -ForegroundColor Green
    } catch {
        Write-Host "Could not install to LocalMachine: $($_.Exception.Message)" -ForegroundColor Yellow
        Write-Host "Try Option 2 or 3 above" -ForegroundColor Yellow
    }
} else {
    Write-Host "Not running as Administrator - cannot install to LocalMachine store" -ForegroundColor Yellow
    Write-Host "Use Option 2 (Brave flag) or Option 3 (manual import) above" -ForegroundColor Yellow
}

Write-Host ""
Write-Host "After completing one of the options above:" -ForegroundColor Cyan
Write-Host "1. Restart Brave browser completely" -ForegroundColor White
Write-Host "2. Clear browser cache: Ctrl+Shift+Delete" -ForegroundColor White
Write-Host "3. Navigate to: https://localhost/" -ForegroundColor White
Write-Host "4. You should see a secure connection with no warnings!" -ForegroundColor Green
Write-Host ""

