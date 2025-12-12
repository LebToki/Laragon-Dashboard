# Laragon Services Startup Script
# Run this script as Administrator to install and start Apache

Write-Host "Starting Laragon Services..." -ForegroundColor Cyan

$httpdPath = "C:\laragon\bin\apache\httpd-2.4.62-240904-win64-VS17\bin\httpd.exe"
$apacheDir = Split-Path $httpdPath -Parent

if (-not (Test-Path $httpdPath)) {
    Write-Host "Error: Apache httpd.exe not found at $httpdPath" -ForegroundColor Red
    exit 1
}

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "Error: This script must be run as Administrator" -ForegroundColor Red
    Write-Host "Right-click PowerShell and select 'Run as Administrator'" -ForegroundColor Yellow
    exit 1
}

# Install Apache service if not installed
Write-Host "Installing Apache service..." -ForegroundColor Yellow
Set-Location $apacheDir
& $httpdPath -k install 2>&1 | Out-Null

# Start Apache service
Write-Host "Starting Apache service..." -ForegroundColor Yellow
& $httpdPath -k start 2>&1 | Out-Null

Start-Sleep -Seconds 2

# Check if Apache service is running
$apacheService = Get-Service -Name "Apache2.4" -ErrorAction SilentlyContinue
$isServiceRunning = $apacheService -and $apacheService.Status -eq 'Running'

# Check if port 80 is listening (not just active connections)
$port80Listening = Get-NetTCPConnection -LocalPort 80 -State Listen -ErrorAction SilentlyContinue

if ($isServiceRunning -and $port80Listening) {
    Write-Host "Success! Apache is running on port 80" -ForegroundColor Green
    Write-Host "You can now access http://localhost/" -ForegroundColor Green
} elseif ($isServiceRunning) {
    Write-Host "Apache service is running, but port 80 may not be listening yet" -ForegroundColor Yellow
    Write-Host "Wait a few seconds and try accessing http://localhost/" -ForegroundColor Yellow
} else {
    Write-Host "Warning: Apache service may not have started correctly" -ForegroundColor Yellow
    Write-Host "Service Status: $($apacheService.Status)" -ForegroundColor Yellow
    Write-Host "Check Laragon GUI or Apache error logs" -ForegroundColor Yellow
}

