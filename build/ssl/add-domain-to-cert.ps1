# Add Specific Domain to SSL Certificate
# Use this if you need to add a specific .local domain that's not working with wildcard

param(
    [Parameter(Mandatory=$true)]
    [string]$Domain
)

Write-Host "=== Adding Domain to SSL Certificate ===" -ForegroundColor Cyan
Write-Host "Domain: $Domain" -ForegroundColor Yellow
Write-Host ""

$laragonRoot = "C:\laragon"
$mkcertPath = Join-Path $laragonRoot "bin\mkcert\mkcert.exe"
$sslDir = Join-Path $laragonRoot "etc\ssl"
$certPath = Join-Path $sslDir "localhost+2.pem"
$keyPath = Join-Path $sslDir "localhost+2-key.pem"

# Check if mkcert exists
if (-not (Test-Path $mkcertPath)) {
    Write-Host "Error: mkcert.exe not found" -ForegroundColor Red
    exit 1
}

# Read current certificate to get existing domains
$currentCert = New-Object System.Security.Cryptography.X509Certificates.X509Certificate2($certPath)
$san = $currentCert.Extensions | Where-Object { $_.Oid.FriendlyName -eq 'Subject Alternative Name' }

if ($san) {
    $sanValue = $san.Format($false)
    Write-Host "Current certificate includes:" -ForegroundColor Yellow
    Write-Host $sanValue
    Write-Host ""
}

# Backup existing certificate
Write-Host "Backing up existing certificate..." -ForegroundColor Yellow
$backupDir = Join-Path $sslDir "backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
Copy-Item $certPath -Destination $backupDir -Force
Copy-Item $keyPath -Destination $backupDir -Force
Write-Host "Backup created: $backupDir" -ForegroundColor Green
Write-Host ""

# Generate new certificate with all domains
Write-Host "Generating new certificate with domain: $Domain" -ForegroundColor Yellow
Set-Location $sslDir

# Standard domains + wildcard + new domain
$domains = @("localhost", "127.0.0.1", "::1", "*.local", $Domain)

Remove-Item $certPath, $keyPath -Force -ErrorAction SilentlyContinue

& $mkcertPath -cert-file "localhost+2.pem" -key-file "localhost+2-key.pem" $domains 2>&1 | Out-Null

if ($LASTEXITCODE -eq 0 -and (Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "Certificate regenerated successfully!" -ForegroundColor Green
    Write-Host ""
    
    # Verify new certificate
    $newCert = New-Object System.Security.Cryptography.X509Certificates.X509Certificate2($certPath)
    $newSan = $newCert.Extensions | Where-Object { $_.Oid.FriendlyName -eq 'Subject Alternative Name' }
    if ($newSan) {
        Write-Host "New certificate includes:" -ForegroundColor Green
        Write-Host $newSan.Format($false)
    }
    
    Write-Host ""
    Write-Host "Restart Apache to apply changes:" -ForegroundColor Yellow
    Write-Host "  C:\laragon\bin\apache\httpd-2.4.62-240904-win64-VS17\bin\httpd.exe -k restart" -ForegroundColor Gray
} else {
    Write-Host "Error: Failed to generate certificate" -ForegroundColor Red
    exit 1
}

