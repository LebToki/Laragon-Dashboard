# Automatically Add All .local Domains to SSL Certificate
# This script scans all virtual hosts and adds every .local domain to the certificate

Write-Host "=== Auto-Adding All .local Domains to SSL Certificate ===" -ForegroundColor Cyan
Write-Host ""

$laragonRoot = "C:\laragon"
$mkcertPath = Join-Path $laragonRoot "bin\mkcert\mkcert.exe"
$sslDir = Join-Path $laragonRoot "etc\ssl"
$sitesEnabled = Join-Path $laragonRoot "etc\apache2\sites-enabled"
$certPath = Join-Path $sslDir "localhost+2.pem"
$keyPath = Join-Path $sslDir "localhost+2-key.pem"

# Check if mkcert exists
if (-not (Test-Path $mkcertPath)) {
    Write-Host "Error: mkcert.exe not found at $mkcertPath" -ForegroundColor Red
    exit 1
}

# Collect all .local domains from virtual host configs
Write-Host "Scanning virtual host configurations..." -ForegroundColor Yellow
$domains = New-Object System.Collections.Generic.HashSet[string]

# Standard domains that should always be included
$domains.Add("localhost") | Out-Null
$domains.Add("127.0.0.1") | Out-Null
$domains.Add("::1") | Out-Null
$domains.Add("*.local") | Out-Null

# Scan all virtual host config files
$vhostFiles = Get-ChildItem $sitesEnabled -Filter "*.conf" -ErrorAction SilentlyContinue

if ($vhostFiles) {
    foreach ($vhostFile in $vhostFiles) {
        # Extract domain from filename (e.g., auto.2tinteractive.local.conf -> 2tinteractive.local)
        if ($vhostFile.Name -match 'auto\.(.+?)\.local\.conf') {
            $domainFromFile = $matches[1] + '.local'
            $domains.Add($domainFromFile) | Out-Null
        }
        
        # Also check define SITE lines
        $content = Get-Content $vhostFile.FullName -Raw -ErrorAction SilentlyContinue
        
        if ($content) {
            # Extract from "define SITE" lines
            if ($content -match 'define\s+SITE\s+"?([^"\s]+\.local)"?') {
                $domainFromDefine = $matches[1]
                $domains.Add($domainFromDefine) | Out-Null
            }
            
            # Extract ServerName
            if ($content -match 'ServerName\s+([^\s\r\n]+)') {
                $serverName = $matches[1]
                # Remove variable references like ${SITE}
                $serverName = $serverName -replace '\$\{[^}]+\}', ''
                if ($serverName -match '\.local$') {
                    $domains.Add($serverName) | Out-Null
                }
            }
            
            # Extract ServerAlias entries
            if ($content -match 'ServerAlias\s+([^\r\n]+)') {
                $aliases = $matches[1]
                # Split by comma and process each alias
                $aliasList = $aliases -split ','
                foreach ($alias in $aliasList) {
                    $alias = $alias.Trim()
                    # Remove wildcard prefix like *.domain.local
                    $alias = $alias -replace '^\*\.', ''
                    # Remove variable references
                    $alias = $alias -replace '\$\{[^}]+\}', ''
                    if ($alias -match '\.local$') {
                        $domains.Add($alias) | Out-Null
                    }
                }
            }
            
            # Also check for any .local patterns in the file
            $localMatches = [regex]::Matches($content, '([a-zA-Z0-9_-]+\.local)')
            foreach ($match in $localMatches) {
                if ($match.Value -match '\.local$') {
                    $domains.Add($match.Value) | Out-Null
                }
            }
        }
    }
}

# Convert to sorted array
$domainArray = $domains | Sort-Object

Write-Host "Found $($domainArray.Count) unique domains to include:" -ForegroundColor Green
foreach ($domain in $domainArray) {
    Write-Host "  - $domain" -ForegroundColor Gray
}
Write-Host ""

# Backup existing certificate
if ((Test-Path $certPath) -or (Test-Path $keyPath)) {
    Write-Host "Backing up existing certificate..." -ForegroundColor Yellow
    $backupDir = Join-Path $sslDir "backup_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
    New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
    if (Test-Path $certPath) { Copy-Item $certPath -Destination $backupDir -Force }
    if (Test-Path $keyPath) { Copy-Item $keyPath -Destination $backupDir -Force }
    Write-Host "Backup created: $backupDir" -ForegroundColor Green
    Write-Host ""
}

# Remove old certificates
Write-Host "Removing old certificates..." -ForegroundColor Yellow
Remove-Item $certPath -Force -ErrorAction SilentlyContinue
Remove-Item $keyPath -Force -ErrorAction SilentlyContinue

# Generate new certificate with all domains
Write-Host "Generating new SSL certificate with all domains..." -ForegroundColor Yellow
Set-Location $sslDir

# Build mkcert command
$mkcertArgs = @("-cert-file", "localhost+2.pem", "-key-file", "localhost+2-key.pem") + $domainArray

& $mkcertPath $mkcertArgs 2>&1 | Out-Null

if ($LASTEXITCODE -eq 0 -and (Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "Certificate generated successfully!" -ForegroundColor Green
    Write-Host ""
    
    # Verify certificate
    try {
        $cert = New-Object System.Security.Cryptography.X509Certificates.X509Certificate2($certPath)
        $san = $cert.Extensions | Where-Object { $_.Oid.FriendlyName -eq 'Subject Alternative Name' }
        if ($san) {
            Write-Host "Certificate includes:" -ForegroundColor Cyan
            Write-Host $san.Format($false) -ForegroundColor Gray
            Write-Host ""
        }
    } catch {
        Write-Host "Could not verify certificate details" -ForegroundColor Yellow
    }
    
    # Restart Apache
    Write-Host "Restarting Apache..." -ForegroundColor Yellow
    $httpdPath = Join-Path $laragonRoot "bin\apache\httpd-2.4.62-240904-win64-VS17\bin\httpd.exe"
    if (Test-Path $httpdPath) {
        & $httpdPath -k restart 2>&1 | Out-Null
        Start-Sleep -Seconds 3
        Write-Host "Apache restarted successfully" -ForegroundColor Green
    } else {
        Write-Host "Warning: Could not find httpd.exe - restart Apache manually" -ForegroundColor Yellow
    }
    
    Write-Host ""
    Write-Host "=== Certificate Update Complete ===" -ForegroundColor Green
    Write-Host ""
    Write-Host "All $($domainArray.Count) domains are now included in the certificate." -ForegroundColor Green
    Write-Host "You may need to:" -ForegroundColor Yellow
    Write-Host "  1. Clear browser cache (Ctrl+Shift+Delete)" -ForegroundColor White
    Write-Host "  2. Restart your browser" -ForegroundColor White
    Write-Host "  3. For Brave: Install root CA to LocalMachine store" -ForegroundColor White
    Write-Host ""
    
} else {
    Write-Host "Error: Failed to generate certificate" -ForegroundColor Red
    Write-Host "Exit code: $LASTEXITCODE" -ForegroundColor Red
    exit 1
}

