# Laragon SSL Setup Script
# This script sets up trusted SSL certificates using mkcert to avoid browser warnings
# Run this script as Administrator

Write-Host "=== Laragon SSL Setup ===" -ForegroundColor Cyan
Write-Host ""

# Check if running as Administrator
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)

if (-not $isAdmin) {
    Write-Host "Error: This script must be run as Administrator" -ForegroundColor Red
    Write-Host "Right-click PowerShell and select 'Run as Administrator'" -ForegroundColor Yellow
    exit 1
}

$laragonRoot = "C:\laragon"
$mkcertPath = Join-Path $laragonRoot "bin\mkcert\mkcert.exe"
$sslDir = Join-Path $laragonRoot "etc\ssl"

# Check if mkcert exists
if (-not (Test-Path $mkcertPath)) {
    Write-Host "Error: mkcert.exe not found at $mkcertPath" -ForegroundColor Red
    exit 1
}

# Create SSL directory if it doesn't exist
if (-not (Test-Path $sslDir)) {
    New-Item -ItemType Directory -Path $sslDir -Force | Out-Null
    Write-Host "Created SSL directory: $sslDir" -ForegroundColor Green
}

# Install mkcert root CA (if not already installed)
# Note: mkcert installs to CurrentUser by default, but Brave may need LocalMachine
Write-Host "Installing mkcert root CA..." -ForegroundColor Yellow
& $mkcertPath -install 2>&1 | Out-Null
if ($LASTEXITCODE -eq 0) {
    Write-Host "Root CA installed successfully (CurrentUser store)" -ForegroundColor Green
    
    # Also install to LocalMachine store for Brave browser compatibility
    Write-Host "Installing root CA to LocalMachine store for Brave browser..." -ForegroundColor Yellow
    $rootCertPath = Join-Path (Get-Item $env:LOCALAPPDATA\mkcert).FullName "rootCA.pem"
    if (Test-Path $rootCertPath) {
        $cert = New-Object System.Security.Cryptography.X509Certificates.X509Certificate2($rootCertPath)
        $store = New-Object System.Security.Cryptography.X509Certificates.X509Store([System.Security.Cryptography.X509Certificates.StoreName]::Root, [System.Security.Cryptography.X509Certificates.StoreLocation]::LocalMachine)
        $store.Open([System.Security.Cryptography.X509Certificates.OpenFlags]::ReadWrite)
        try {
            $store.Add($cert)
            Write-Host "Root CA installed to LocalMachine store successfully" -ForegroundColor Green
        } catch {
            Write-Host "Note: Could not install to LocalMachine (may already exist)" -ForegroundColor Yellow
        } finally {
            $store.Close()
        }
    }
} else {
    Write-Host "Root CA may already be installed (this is OK)" -ForegroundColor Yellow
}

# Generate certificates for localhost
Write-Host "Generating SSL certificates for localhost..." -ForegroundColor Yellow
$certPath = Join-Path $sslDir "localhost+2.pem"
$keyPath = Join-Path $sslDir "localhost+2-key.pem"

# Check if certificates already exist
if ((Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "Certificates already exist. Regenerating..." -ForegroundColor Yellow
    Remove-Item $certPath -Force -ErrorAction SilentlyContinue
    Remove-Item $keyPath -Force -ErrorAction SilentlyContinue
}

# Generate certificates for localhost, 127.0.0.1, and ::1
Set-Location $sslDir
& $mkcertPath -cert-file "localhost+2.pem" -key-file "localhost+2-key.pem" localhost 127.0.0.1 ::1 2>&1 | Out-Null

if ($LASTEXITCODE -eq 0 -and (Test-Path $certPath) -and (Test-Path $keyPath)) {
    Write-Host "SSL certificates generated successfully!" -ForegroundColor Green
    Write-Host "Certificate: $certPath" -ForegroundColor Gray
    Write-Host "Private Key: $keyPath" -ForegroundColor Gray
} else {
    Write-Host "Error: Failed to generate SSL certificates" -ForegroundColor Red
    exit 1
}

# Check Apache SSL configuration
$apacheConfDir = Join-Path $laragonRoot "etc\apache2"
$sslConfFile = Join-Path $apacheConfDir "httpd-ssl.conf"

Write-Host ""
Write-Host "Checking Apache SSL configuration..." -ForegroundColor Yellow

# Read or create SSL virtual host configuration
$vhostContent = @"
<VirtualHost *:443>
    ServerName localhost
    DocumentRoot "C:/laragon/www"
    
    SSLEngine on
    SSLCertificateFile "C:/laragon/etc/ssl/localhost+2.pem"
    SSLCertificateKeyFile "C:/laragon/etc/ssl/localhost+2-key.pem"
    
    <Directory "C:/laragon/www">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
"@

# Check if SSL virtual host is already configured
$sslVhostFile = Join-Path $apacheConfDir "sites-enabled\000-default-ssl.conf"
if (-not (Test-Path (Join-Path $apacheConfDir "sites-enabled"))) {
    New-Item -ItemType Directory -Path (Join-Path $apacheConfDir "sites-enabled") -Force | Out-Null
}

if (-not (Test-Path $sslVhostFile)) {
    $vhostContent | Out-File -FilePath $sslVhostFile -Encoding UTF8
    Write-Host "Created SSL virtual host configuration: $sslVhostFile" -ForegroundColor Green
} else {
    Write-Host "SSL virtual host configuration already exists" -ForegroundColor Yellow
}

# Add HTTPS redirect to HTTP virtual host
$httpVhostFile = Join-Path $apacheConfDir "sites-enabled\000-default.conf"
if (-not (Test-Path $httpVhostFile)) {
    $httpVhostContent = @"
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/laragon/www"
    
    # Redirect HTTP to HTTPS
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
    
    <Directory "C:/laragon/www">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
"@
    $httpVhostContent | Out-File -FilePath $httpVhostFile -Encoding UTF8
    Write-Host "Created HTTP virtual host with HTTPS redirect: $httpVhostFile" -ForegroundColor Green
} else {
    # Check if redirect is already in the file
    $httpContent = Get-Content $httpVhostFile -Raw
    if ($httpContent -notmatch "RewriteEngine|Redirect") {
        # Add redirect at the beginning
        $redirectRules = @"

    # Redirect HTTP to HTTPS
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
"@
        $httpContent = $httpContent -replace "(<VirtualHost \*:80>)", "`$1$redirectRules"
        $httpContent | Out-File -FilePath $httpVhostFile -Encoding UTF8
        Write-Host "Added HTTPS redirect to HTTP virtual host" -ForegroundColor Green
    } else {
        Write-Host "HTTPS redirect already configured in HTTP virtual host" -ForegroundColor Yellow
    }
}

# Ensure mod_rewrite is enabled (needed for redirect)
Write-Host ""
Write-Host "Verifying Apache modules..." -ForegroundColor Yellow
$httpdConf = Join-Path $laragonRoot "bin\apache\httpd-2.4.62-240904-win64-VS17\conf\httpd.conf"
if (Test-Path $httpdConf) {
    $confContent = Get-Content $httpdConf -Raw
    if ($confContent -notmatch "LoadModule.*rewrite_module") {
        Write-Host "Warning: mod_rewrite may not be enabled. Please enable it in httpd.conf" -ForegroundColor Yellow
    }
}

Write-Host ""
Write-Host "=== SSL Setup Complete ===" -ForegroundColor Green
Write-Host ""
Write-Host "Next steps:" -ForegroundColor Cyan
Write-Host "1. Restart Apache service:" -ForegroundColor White
Write-Host "   sc stop Apache2.4" -ForegroundColor Gray
Write-Host "   sc start Apache2.4" -ForegroundColor Gray
Write-Host ""
Write-Host "2. Access your dashboard at: https://localhost/" -ForegroundColor White
Write-Host ""
Write-Host "3. Update Laragon Dashboard config.php to enable HTTPS:" -ForegroundColor White
Write-Host "   Set FORCE_HTTPS to true or set environment variable FORCE_HTTPS=true" -ForegroundColor Gray
Write-Host ""

