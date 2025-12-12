# Helper script to run SSL setup with elevation
# This will prompt for Administrator privileges

$scriptPath = Join-Path $PSScriptRoot "setup-ssl.ps1"

if (-not (Test-Path $scriptPath)) {
    Write-Host "Error: setup-ssl.ps1 not found!" -ForegroundColor Red
    exit 1
}

Write-Host "Requesting Administrator privileges..." -ForegroundColor Yellow
Write-Host "Please click 'Yes' when prompted by Windows UAC" -ForegroundColor Yellow
Write-Host ""

# Start the script with elevation
Start-Process powershell.exe -Verb RunAs -ArgumentList "-ExecutionPolicy Bypass -File `"$scriptPath`"" -Wait

