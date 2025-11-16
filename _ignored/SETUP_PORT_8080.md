# Setting Up Laragon Dashboard on Port 8080

## Option 1: Apache Virtual Host (Recommended)

### Step 1: Edit Apache Configuration
1. Open Laragon
2. Go to **Menu → Apache → httpd-vhosts.conf**
3. Add this virtual host configuration:

```apache
<VirtualHost *:8080>
    ServerName laragon-dashboard.local
    DocumentRoot "C:/laragon/www/Laragon-Dashboard"
    
    <Directory "C:/laragon/www/Laragon-Dashboard">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog "C:/laragon/logs/apache/laragon-dashboard-error.log"
    CustomLog "C:/laragon/logs/apache/laragon-dashboard-access.log" common
</VirtualHost>

# Also add for localhost
<VirtualHost *:8080>
    ServerName localhost
    DocumentRoot "C:/laragon/www"
    
    <Directory "C:/laragon/www">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Step 2: Configure Apache to Listen on Port 8080
1. Go to **Menu → Apache → httpd.conf**
2. Find the `Listen` directive
3. Add: `Listen 8080`
4. Or change existing: `Listen 80` to `Listen 80 8080`

### Step 3: Restart Apache
1. In Laragon, click **Stop All**
2. Click **Start All**

### Step 4: Access Dashboard
- `http://localhost:8080/Laragon-Dashboard/`
- `http://laragon-dashboard.local:8080/`

## Option 2: Change Default Apache Port

### Step 1: Change Apache Port
1. In Laragon, go to **Menu → Apache → httpd.conf**
2. Find `Listen 80` and change to `Listen 8080`
3. Find all `<VirtualHost *:80>` and change to `<VirtualHost *:8080>`
4. Save and restart Apache

### Step 2: Access Dashboard
- `http://localhost:8080/Laragon-Dashboard/`

## Option 3: Use Laragon's Port Management

1. In Laragon, go to **Menu → Preferences**
2. Find **Apache Port** setting
3. Change from `80` to `8080`
4. Restart Apache

## Debug Banner

The debug banner will automatically appear when:
- `APP_DEBUG` is set to `true` in `config.php`
- You're accessing the dashboard

The banner shows:
- Current paths (BASE_URL, ASSETS_URL)
- CSS file status (exists/missing)
- Service Worker status
- Cache status
- Links to test CSS files directly

## Removing Debug Banner

Once CSS loading is fixed:
1. Set `APP_DEBUG` to `false` in `config.php`
2. Or delete `partials/debug_banner.php`

