# SSL Setup Guide for Laragon Dashboard

This guide will help you set up trusted SSL certificates using mkcert to eliminate browser security warnings in Chrome/Chromium browsers.

## Quick Setup

1. **Run the SSL setup script as Administrator:**
   ```powershell
   # Right-click PowerShell and select "Run as Administrator"
   cd C:\laragon\www\Laragon-Dashboard
   .\setup-ssl.ps1
   ```

2. **Restart Apache:**
   ```powershell
   sc stop Apache2.4
   sc start Apache2.4
   ```

3. **Access your dashboard:**
   - Open: `https://localhost/`
   - The browser should show a secure connection (no warnings!)

## What the Script Does

1. **Installs mkcert Root CA** - Makes your local certificates trusted by browsers
2. **Generates SSL Certificates** - Creates certificates for:
   - `localhost`
   - `127.0.0.1`
   - `::1` (IPv6)
3. **Configures Apache SSL** - Sets up virtual host for port 443
4. **Enables HTTPS Redirect** - Automatically redirects HTTP to HTTPS
5. **Updates Dashboard Config** - Enables HTTPS in the dashboard

## Files Created/Modified

### Certificates (in `C:\laragon\etc\ssl\`):
- `localhost+2.pem` - SSL certificate
- `localhost+2-key.pem` - Private key

### Apache Configuration (in `C:\laragon\etc\apache2\sites-enabled\`):
- `000-default.conf` - HTTP virtual host with HTTPS redirect
- `000-default-ssl.conf` - HTTPS virtual host (port 443)

### Dashboard Files:
- `.htaccess` - Added HTTPS redirect rules
- `config.php` - Auto-detects SSL and enables HTTPS
- `C:\laragon\www\index.php` - Updated to use HTTPS

## Manual Configuration

If you prefer to configure manually:

### 1. Install mkcert Root CA
```powershell
C:\laragon\bin\mkcert\mkcert.exe -install
```

### 2. Generate Certificates
```powershell
cd C:\laragon\etc\ssl
C:\laragon\bin\mkcert\mkcert.exe -cert-file localhost+2.pem -key-file localhost+2-key.pem localhost 127.0.0.1 ::1
```

### 3. Configure Apache SSL Virtual Host

Create `C:\laragon\etc\apache2\sites-enabled\000-default-ssl.conf`:
```apache
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
```

### 4. Enable HTTPS Redirect

Add to `C:\laragon\etc\apache2\sites-enabled\000-default.conf`:
```apache
<VirtualHost *:80>
    ServerName localhost
    DocumentRoot "C:/laragon/www"
    
    RewriteEngine On
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
    
    <Directory "C:/laragon/www">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Troubleshooting

### Browser Still Shows Warnings
- Make sure mkcert root CA is installed: `mkcert -install`
- Clear browser cache and restart browser
- Check that certificates exist in `C:\laragon\etc\ssl\`

### Apache Won't Start
- Check Apache error logs: `C:\laragon\bin\apache\httpd-2.4.62-240904-win64-VS17\logs\error.log`
- Verify SSL module is loaded: `LoadModule ssl_module modules/mod_ssl.so`
- Check that port 443 is not in use: `netstat -ano | findstr :443`

### HTTPS Redirect Not Working
- Ensure `mod_rewrite` is enabled in `httpd.conf`
- Check that `.htaccess` file exists and is readable
- Verify virtual host configuration is correct

### Certificates Not Found
- Run the setup script again: `.\setup-ssl.ps1`
- Check that `C:\laragon\etc\ssl\` directory exists
- Verify mkcert is working: `C:\laragon\bin\mkcert\mkcert.exe -version`

## Disabling SSL

If you need to disable SSL:

1. **Remove HTTPS redirect from `.htaccess`:**
   Remove the HTTPS redirect rules (lines 7-9)

2. **Update `config.php`:**
   ```php
   define('FORCE_HTTPS', false);
   ```

3. **Update root `index.php`:**
   Change redirect to use `http://` instead of `https://`

4. **Restart Apache**

## Benefits

✅ **No Browser Warnings** - Trusted certificates eliminate security warnings  
✅ **Secure Local Development** - HTTPS for local testing  
✅ **Better Testing** - Test HTTPS-only features locally  
✅ **Professional Setup** - Production-like environment  

## Notes

- Certificates are valid for localhost only
- Root CA is installed in Windows certificate store
- Certificates don't expire (mkcert creates long-lived certs)
- Safe to use - only affects local development

