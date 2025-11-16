# 🚀 Laragon Dashboard

A modern, feature-rich web-based dashboard for managing Laragon development environment. Version 3.1.3 aims to be a comprehensive MAMP competitor on Windows, replicating Laragon control panel functionality in a modern, themed web interface.

[![Version](https://img.shields.io/badge/version-3.1.3-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

---

## ✨ Screenshots

<img width="1899" height="913" alt="Dashboard" src="https://github.com/user-attachments/assets/3c26a59d-fd56-4129-ad6b-2b94851622ba" />
<img width="1898" height="915" alt="Projects" src="https://github.com/user-attachments/assets/299063cd-6d35-4441-9daf-12646a94d141" />
<img width="1915" height="915" alt="Databases" src="https://github.com/user-attachments/assets/a9902815-fcb6-4435-875e-05ed61cf132f" />
<img width="1892" height="905" alt="Services" src="https://github.com/user-attachments/assets/7897a08a-e58c-44e1-b350-2d26cd9aae77" />
<img width="1902" height="909" alt="Server Vitals" src="https://github.com/user-attachments/assets/c57dcd21-f318-4f42-861d-2338f7f2e075" />
<img width="1914" height="914" alt="Mailbox" src="https://github.com/user-attachments/assets/c7d6eb7d-3814-4bd4-970e-5ed56ed9bdb7" />
<img width="1893" height="881" alt="Logs" src="https://github.com/user-attachments/assets/95e20f6e-5b13-4ace-a0c1-d297a1580a79" />
<img width="1902" height="906" alt="Tools" src="https://github.com/user-attachments/assets/7e445d07-afde-4b9b-8d02-0a20e22808b6" />
<img width="1914" height="916" alt="Backup" src="https://github.com/user-attachments/assets/58416b1f-e01b-4654-ad62-86a8ba8054bf" />
<img width="1903" height="911" alt="Sites Enabled" src="https://github.com/user-attachments/assets/ad0568d1-af9a-4923-991f-5479f7bd8bed" />
<img width="1895" height="912" alt="Server Configurations" src="https://github.com/user-attachments/assets/a5db0350-4b27-4795-a7ea-6ed0cb67c838" />
<img width="1892" height="914" alt="preferences" src="https://github.com/user-attachments/assets/5e6667c6-5796-4e0d-bc5a-eb8af8ca2150" />
<img width="1898" height="908" alt="Ignore Project From Listing" src="https://github.com/user-attachments/assets/400571a4-8771-4a65-82b8-ceeac31daa98" />
<img width="1914" height="911" alt="Project Creation Wizard" src="https://github.com/user-attachments/assets/6fc31790-2aa0-48f3-8db7-06019d721139" />
<img width="1908" height="911" alt="Share Project Online" src="https://github.com/user-attachments/assets/b2dc7c64-82f2-4b1f-9055-21ed1aedcc58" />

---

## 📋 Project Information

- **Project Name**: Laragon Dashboard
- **Version**: 3.1.3
- **Author**: Tarek Tarabichi
- **Company**: 2TInteractive (2tinteractive.com)
- **Project Start**: Early 2024
- **GitHub**: https://github.com/LebToki/Laragon-Dashboard
- **License**: MIT
- **Goal**: MAMP competitor for Windows OS (with potential future cross-platform support)

## 🌍 Platform Support

### Current Status (as of November 2025)
- **Windows**: ✅ Fully supported (primary platform)
- **macOS**: ❌ Not supported by Laragon (Windows-only)
- **Linux**: ❌ Not supported by Laragon (Windows-only)

### Cross-Platform Research
Laragon is currently Windows-only. For future cross-platform support, the dashboard architecture is designed to:
- Abstract platform-specific operations (service management, file paths, etc.)
- Support multiple backend environments (Laragon on Windows, MAMP/XAMPP on macOS/Linux)
- Detect and adapt to the host platform
- Provide platform-specific features when available

**Potential Future Platforms**:
- **macOS**: Could integrate with MAMP, Laravel Valet, or Docker
- **Linux**: Could integrate with LAMP stack, Docker, or platform-specific tools

## ✨ Features

### 🎛️ Service Management
- **Start/Stop/Restart Services** - Apache, MySQL, Nginx, Redis, Memcached, MongoDB, PostgreSQL, Mailpit
- **Service Status Monitoring** - Real-time status display
- **Port Monitoring** - View all listening ports on your system
- **Service Version Detection** - Automatic version detection
- **Windows Service Control** - Full Windows service management via `sc` commands
- **Process-Based Services** - Support for non-Windows services (Nginx, Mailpit)

### 📁 Project Management
- **Project Discovery** - Automatically list projects from `www` directory
- **Framework Detection** - WordPress, Laravel, Drupal, CodeIgniter, Symfony, CakePHP, Joomla
- **Project Search/Filter** - Quick search and filtering capabilities
- **Quick Access Links** - Direct links to project admin panels
- **Framework-Specific Icons** - Visual identification of project types
- **Project Actions Menu** - 3-dot dropdown menu for quick actions (Ignore Project)
- **Smart WP Admin Button** - Only displays for WordPress projects, hides automatically for others
- **Project Ignoring** - Hide projects from the list via dropdown menu or right-click context menu

### 🗄️ Database Management
- **Database Browser** - Browse all databases and view sizes
- **Table Explorer** - List tables with row counts and sizes
- **Table Structure** - View column details, types, keys, and constraints
- **Query Runner** - Execute SELECT queries safely (read-only)
- **Database Optimization** - Optimize tables for better performance
- **Real-time Information** - Live database statistics

### 📧 Email Management (Mailpit)
- **Email Viewer** - View emails from Laragon's sendmail output
- **Email Statistics** - Total, daily, weekly counts, unique senders
- **Search & Filter** - Advanced email search capabilities
- **Email Reading** - Full email content viewer
- **Email Management** - Delete individual or bulk emails
- **Export Options** - Download email data

### 📊 Server Monitoring
- **Real-time Vitals** - CPU, memory, and disk usage monitoring
- **PHP Memory Tracking** - Monitor PHP memory usage and limits
- **Multi-drive Support** - Track disk usage across all drives
- **Visual Charts** - Interactive charts using Chart.js
- **Windows Compatible** - Optimized for Windows/Laragon environment

### 📋 Log Viewer
- **Multi-Log Support** - View Apache, PHP, MySQL, and Dashboard logs
- **Configurable Display** - Adjust number of lines to display (10-1000)
- **Log Management** - Clear log files with one click
- **Auto-Detection** - Automatically finds available log files
- **Terminal-Style Display** - Easy-to-read log format

### 🛠️ Quick Tools
- **Cache Management** - Clear application and framework caches
- **Database Optimization** - Optimize all tables in a database
- **Git Integration** - Check Git status for projects
- **Composer Commands** - Install, update, dump-autoload, clear-cache
- **NPM Commands** - Install, update, run build/dev/prod
- **PHP Info** - Quick access to PHP configuration
- **SMTP Configuration Fix** - Automatically configure PHP to use Mailpit SMTP instead of sendmail.exe

### 💾 Backup & Export
- **Full Project Backup** - Backup projects with database
- **Configurable Options** - Include/exclude vendor, cache directories
- **Recent Backups List** - View and manage backup history
- **Download Backups** - Easy backup retrieval
- **ZIP Compression** - Efficient backup storage

### 🔄 Update Management
- **Automatic Update Checking** - Check for new versions
- **Download with Progress** - Visual download progress
- **One-Click Installation** - Easy update process
- **Backup Before Update** - Automatic backup before updating

### 🔒 Security Features
- **CSRF Protection** - Secure token-based protection
- **Security Headers** - Comprehensive HTTP security headers
- **Rate Limiting** - Prevent abuse and brute force attacks
- **Input Sanitization** - XSS and injection protection
- **Secure Sessions** - HTTPOnly and secure cookie settings
- **Content Security Policy** - Advanced CSP implementation
- **SQL Injection Protection** - Prepared statements throughout

### 🌍 Multi-language Support
- **8 Languages** - English, German, Spanish, French, Indonesian, Portuguese, Tagalog, Arabic
- **Easy Language Switching** - Quick language selector
- **Consistent Translation System** - Organized translation files
- **Module-Based Translations** - Translations organized by feature

## 🛠️ Installation

### Prerequisites

- **Laragon** development environment installed
- **PHP 7.4+** with required extensions:
  - `json`
  - `mbstring`
  - `openssl`
  - `pdo_mysql`
- **MySQL/MariaDB** server
- **Web server** (Apache/Nginx)

### Quick Setup

#### Option 1: Download ZIP (Recommended)

1. **Download the latest release** from the [Releases page](https://github.com/LebToki/Laragon-Dashboard/releases)

2. **Extract the zip file** to your Laragon `www` directory:
   ```
   C:\laragon\www\Laragon-Dashboard\
   ```

3. **Edit Laragon's root index.php** (located at `C:\laragon\www\index.php`)
   
   Replace the existing content with this redirect:
   ```php
   <?php
   header('Location: /Laragon-Dashboard/');
   exit;
   ?>
   ```

4. **Access Dashboard**
   ```
   http://localhost/
   ```
   or directly:
   ```
   http://localhost/Laragon-Dashboard/
   ```

#### Option 2: Git Clone

1. **Clone the repository**
   ```bash
   git clone https://github.com/LebToki/Laragon-Dashboard.git
   cd Laragon-Dashboard
   ```

2. **Move to Laragon www directory**
   ```bash
   # Move Laragon-Dashboard folder to www
   move Laragon-Dashboard C:\laragon\www\Laragon-Dashboard
   ```

3. **Edit Laragon's root index.php** (located at `C:\laragon\www\index.php`)
   
   Replace the existing content with this redirect:
   ```php
   <?php
   header('Location: /Laragon-Dashboard/');
   exit;
   ?>
   ```

4. **Access Dashboard**
   ```
   http://localhost/
   ```
   or directly:
   ```
   http://localhost/Laragon-Dashboard/
   ```

### Configuration

The dashboard auto-detects Laragon installation paths. Edit `config.php` to customize:

```php
// Auto-detected values (no manual configuration needed)
$LARAGON_ROOT = getLaragonRoot(); // Auto-detect from common paths
SENDMAIL_OUTPUT_DIR = getLaragonSendmailDir(); // C:/laragon/bin/sendmail/output/
DOMAIN_SUFFIX = getLaragonDomainSuffix(); // .local
APP_VERSION = getAppVersion(); // From Git or VERSION file

// MySQL Configuration (defaults)
MYSQL_HOST = 'localhost'
MYSQL_USER = 'root'
MYSQL_PASSWORD = ''

// Application Settings
APP_NAME = 'Laragon Dashboard'
APP_DEBUG = false  // Debug banner is DISABLED by default (line 38)
APP_ENV = 'production'  // development, staging, production (line 41)
SESSION_TIMEOUT = 3600
MAX_LOGIN_ATTEMPTS = 5

// Time and Date Format (optional overrides)
TIME_FORMAT = null  // null = auto-detect, '12' = 12-hour, '24' = 24-hour
DATE_FORMAT = null  // null = auto-detect, or custom format like 'Y-m-d', 'm/d/Y'
```

**Important Notes:**

- **Debug Banner**: The debug banner is **disabled by default** (`APP_DEBUG = false` on line 38). You won't see it unless you enable it for troubleshooting. Only enable it if you're experiencing CSS loading issues, asset path problems, or need to debug routing/URL issues. You can also enable it via the Preferences page.

- **Environment**: The dashboard runs in `production` mode by default (`APP_ENV = 'production'` on line 41). This ensures optimal performance and security. Change to `development` only if you need additional debugging features.

- **Time/Date Format**: Time and date formats are auto-detected from your system locale. You can override them in `config.php` or via the Preferences page.

**Laragon Path Auto-Detection Order:**
1. `LARAGON_ROOT` environment variable
2. Common paths: `C:/laragon`, `D:/laragon`, `E:/laragon`
3. Detect from `DOCUMENT_ROOT` (if contains 'laragon')
4. Default fallback: `C:/laragon`

**Important Setup Note:**
- The root `index.php` file at `C:\laragon\www\index.php` should redirect to the dashboard
- This allows accessing the dashboard via `http://localhost/` instead of `http://localhost/Laragon-Dashboard/`
- If you prefer direct access, you can skip modifying the root `index.php` and access the dashboard directly at `http://localhost/Laragon-Dashboard/`

## 📁 Project Structure

```
Laragon-Dashboard/
├── api/                    # API endpoints
│   ├── services.php        # Services management API
│   ├── databases.php       # Database management API
│   ├── vitals.php         # Server monitoring API
│   ├── logs.php           # Log viewer API
│   ├── tools.php          # Quick tools API
│   ├── backup.php         # Backup API
│   ├── update.php         # Update API
│   └── mailpit.php        # Email management API
├── assets/                 # Application assets
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files
│   ├── images/            # Images and icons
│   └── fonts/             # Web fonts
├── i18n/                  # Internationalization
│   ├── common/            # Common translations
│   ├── dashboard/         # Dashboard translations
│   ├── projects/          # Projects translations
│   └── ...                # Module-specific translations
├── includes/               # Helper classes
│   ├── Router.php         # Routing system
│   ├── UpdateManager.php  # Update management
│   ├── AdminerModule.php  # Database admin integration
│   ├── ConfigMigrator.php # Configuration migration
│   └── helpers.php        # Helper functions
├── pages/                  # Page templates
│   ├── dashboard.php      # Main dashboard
│   ├── projects.php       # Projects page
│   ├── services.php       # Services page
│   ├── databases.php     # Databases page
│   ├── mailbox.php       # Email client
│   ├── vitals.php        # Server monitoring
│   ├── logs.php          # Log viewer
│   └── tools.php         # Quick tools
├── partials/               # Layout partials
│   ├── layouts/          # Layout templates
│   │   ├── layoutTop.php # Top layout (header, sidebar, navbar)
│   │   └── layoutBottom.php # Bottom layout (footer, scripts)
│   ├── head.php          # Meta tags, CSS includes
│   ├── sidebar.php       # Navigation sidebar
│   ├── navbar.php        # Top navigation bar
│   ├── footer.php        # Footer content
│   └── scripts.php       # JavaScript includes
├── devfiles/              # Development files
│   ├── KNOWLEDGE_BASE.md # Knowledge base documentation
│   ├── TESTING_CHECKLIST.md # Testing guidelines
│   └── ...               # Other dev documentation
├── config.php            # Main configuration
├── index.php             # Entry point and router
└── README.md             # This file
```

## 🎯 Usage

### Dashboard Overview

The main dashboard provides:
- **Server Information** - PHP version, MySQL status, web server details
- **Project Management** - List and manage your development projects
- **Framework Detection** - Automatic detection of WordPress, Laravel, Drupal, etc.
- **Quick Access** - Direct links to project admin panels

### Service Management

Control Laragon services via the "Services" tab:
- Start, stop, or restart services (Apache, MySQL, Nginx, Redis, Memcached, MongoDB, PostgreSQL, Mailpit)
- View real-time status of all services
- Monitor listening ports
- Quick service actions

### Project Management

Access projects via the "Projects" tab:
- View all projects in your `www` directory
- Search and filter projects
- See framework detection results
- Quick access to project admin panels

### Database Management

Access database tools via the "Databases" tab:
- Browse all available databases and their sizes
- Explore table structures, row counts, and sizes
- Run SELECT queries safely (read-only)
- Optimize database tables

### Email Management

Access the email client via the "Mailbox" tab:
- View email statistics (total, daily, weekly, unique senders)
- Search and filter emails
- Read full email content
- Delete individual or bulk emails
- Export email data

### Server Monitoring

Monitor your server via the "Server Vitals" tab:
- Real-time charts for CPU, memory, and disk usage
- PHP memory usage tracking
- Multi-drive disk space monitoring
- Performance metrics

### Log Viewer

View logs via the "Logs" tab:
- Multiple log types (Apache, PHP, MySQL, Dashboard)
- Configurable line count (10-1000)
- Clear log files when needed
- Terminal-style display

### Quick Tools

Access developer tools via the "Tools" tab:
- Cache management (clear application and framework caches)
- Database optimization
- Git status check
- Composer and NPM commands
- PHP info viewer

## 🔧 API Endpoints

All APIs return JSON responses and follow a consistent pattern:

### Services API
```
GET /api/services.php?action=status
GET /api/services.php?action=start&service=Apache
GET /api/services.php?action=stop&service=MySQL
GET /api/services.php?action=restart&service=Nginx
GET /api/services.php?action=get_ports
```

### Database API
```
GET /api/databases.php?action=list_databases
GET /api/databases.php?action=get_tables&database=dbname
GET /api/databases.php?action=get_table_structure&database=dbname&table=tablename
GET /api/databases.php?action=get_database_size&database=dbname
POST /api/databases.php?action=execute_query
```

### Server Vitals API
```
GET /api/vitals.php
```
Returns JSON with server statistics (uptime, CPU, memory, disk usage, PHP memory info).

### Log Viewer API
```
GET /api/logs.php?action=list_logs
GET /api/logs.php?action=read_log&path=logpath&lines=100
GET /api/logs.php?action=clear_log&path=logpath
```

### Quick Tools API
```
POST /api/tools.php (action: clear_cache)
POST /api/tools.php (action: optimize_database, database: dbname)
POST /api/tools.php (action: composer_command, project_path: path, command: install)
POST /api/tools.php (action: npm_command, project_path: path, command: install)
POST /api/tools.php (action: git_status, project_path: path)
GET /api/tools.php?action=php_info
```

### Backup API
```
GET /api/backup.php?action=list
POST /api/backup.php?action=create
POST /api/backup.php?action=delete&backup_id=id
```

### Update API
```
GET /api/update.php?action=check
POST /api/update.php?action=download
POST /api/update.php?action=install
```

## 🛡️ Security

### Security Features

- **CSRF Protection** - All forms protected with CSRF tokens
- **XSS Prevention** - All user inputs sanitized
- **SQL Injection Protection** - Prepared statements used throughout
- **Rate Limiting** - Prevents brute force attacks
- **Secure Headers** - Comprehensive HTTP security headers
- **File Upload Security** - Restricted file types and sizes

### Security Headers

- `X-Frame-Options: DENY`
- `X-Content-Type-Options: nosniff`
- `X-XSS-Protection: 1; mode=block`
- `Strict-Transport-Security` (HTTPS only)
- `Content-Security-Policy`
- `Referrer-Policy: strict-origin-when-cross-origin`

## 🎨 Customization

### Themes

The dashboard uses Bootstrap 5 with custom CSS. Key customization points:

```css
/* Main color scheme */
:root {
  --primary-color: #0d6efd;
  --secondary-color: #6c757d;
  --success-color: #198754;
  --danger-color: #dc3545;
  --warning-color: #ffc107;
  --info-color: #0dcaf0;
}
```

### Language Files

Add new languages by creating JSON files in `i18n/[module]/[language].json`:

```json
{
  "title": "Welcome to the Laragon Dashboard",
  "header": "My Development Server",
  "servers_tab": "Servers",
  "inbox_tab": "Mailbox",
  "vitals_tab": "Server's Vitals"
}
```

## 🐛 Troubleshooting

### Diagnostic Tool

If you're experiencing issues with path detection, CSS loading, or 404 errors, use the built-in diagnostic tool:

1. **Access the diagnostic page**:
   ```
   http://localhost/Laragon-Dashboard/diagnostic.php
   ```
   or
   ```
   http://laragon-dashboard.local/diagnostic.php
   ```

2. **Review the output** - The tool will show:
   - Server configuration and paths
   - Laragon detection status
   - File system checks
   - Asset path verification
   - URL access tests

3. **Share results** - If you need help, share the diagnostic output for faster troubleshooting

### Common Issues

**404 Errors:**
- Run the diagnostic tool to identify path issues
- Verify Apache's document root matches your setup
- Check that `.htaccess` file exists and is readable
- Ensure `index.php` is accessible directly

**CSS/JS Not Loading:**
- Check browser console (F12) for 404 errors on assets
- Verify `ASSETS_URL` is correctly calculated (use diagnostic tool)
- Clear browser cache and hard refresh (Ctrl+F5)
- Ensure assets directory exists and is readable

**Laragon Not Detected:**
- Use the diagnostic tool to verify detection
- Manually set Laragon path in Preferences if auto-detection fails
- Check that `laragon.exe` and `usr/laragon.ini` exist in Laragon root
- Verify file permissions allow PHP to read Laragon directory

**Email not loading:**
- Check `SENDMAIL_OUTPUT_DIR` path in config.php
- Ensure directory exists and is readable
- Verify Laragon sendmail configuration

**Server vitals not working:**
- Ensure PHP has necessary permissions
- Check if required PHP extensions are loaded
- Verify disk paths are accessible

**Database connection issues:**
- Verify MySQL credentials in config.php
- Ensure MySQL service is running
- Check firewall settings

**Performance issues:**
- Enable caching in config.php
- Check log files for errors
- Monitor memory usage

### Debug Banner

**The debug banner is disabled by default** and you won't see it unless you enable it. This is intentional - it's only needed when troubleshooting issues.

**To enable the debug banner:**

1. **Via Preferences** (Recommended):
   - Go to **Preferences** page
   - Under **Debug Settings**, check "Show Debug Banner"
   - Save preferences

2. **Via config.php**:
   ```php
   // In config.php (line 38)
   define('APP_DEBUG', true); // Only enable if troubleshooting
   ```

**When to enable it:**
- If you're experiencing CSS loading issues
- If assets (images, JS, CSS) aren't loading correctly
- If you need to troubleshoot path detection problems
- If you're debugging routing or URL issues

**What it shows:**
- Base URL and Assets URL
- Document root path
- Laragon root detection
- Current script path
- Server variables

**Note**: The debug banner is controlled by `APP_DEBUG` in `config.php` (line 38) and can also be toggled via user preferences. It's set to `false` by default for a clean user experience.

## 📈 Performance

### Optimization Features

- **File-based Caching** - Reduces database queries
- **Lazy Loading** - Loads content as needed
- **Minified Assets** - Optimized CSS and JavaScript
- **Compressed Responses** - Reduced bandwidth usage
- **Database Connection Pooling** - Efficient database usage

### Monitoring

- **Execution Time Tracking** - Monitor page load times
- **Memory Usage Monitoring** - Track memory consumption
- **Cache Statistics** - Monitor cache hit rates
- **Error Logging** - Track and analyze errors

## 🔄 Framework Detection

The dashboard automatically detects frameworks in your projects:

1. **WordPress** - Checks for `wp-config.php`
2. **Laravel** - Checks for `artisan` file
3. **Drupal** - Checks for `sites/default/settings.php`
4. **CodeIgniter** - Checks for `application/config/config.php`
5. **Symfony** - Checks for `app/AppKernel.php` or `symfony.lock`
6. **CakePHP** - Checks for `config/app.php`
7. **Joomla** - Checks for `configuration.php`

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

### Development Setup

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

### Code Standards

- Follow PSR-12 coding standards
- Add comprehensive comments
- Include error handling
- Test on multiple PHP versions
- No inline JavaScript in PHP files (all JS in separate files)
- Use template partials for layout consistency

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laragon Team** - For the excellent development environment
- **Bootstrap Team** - For the amazing CSS framework
- **Chart.js Team** - For the beautiful charting library
- **Contributors** - All the amazing people who contributed to this project

## 📞 Support

- **Documentation** - Check this README and the [Knowledge Base](devfiles/KNOWLEDGE_BASE.md)
- **Issues** - Report bugs via [GitHub Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Discussions** - Join our [GitHub Discussions](https://github.com/LebToki/Laragon-Dashboard/discussions)

## 🔄 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed version history.

<<<<<<< HEAD
### Version 3.1.3 (Current)
- **FIXED**: HTTP/HTTPS protocol detection - projects now correctly use HTTPS when Laragon is configured for SSL
- **FIXED**: Enhanced protocol detection with multiple fallback methods (request protocol, Laragon config, port detection)
- **NEW**: `FORCE_HTTPS` configuration option to force HTTPS for all project URLs
- **IMPROVED**: Root directory cleanup - organized test files, diagnostic tools, and release notes into `_ignored/` directory
- **IMPROVED**: Better file organization with dedicated directories for releases, responses, and tests

### Version 3.1.3 (Current)
- **FIXED**: HTTP/HTTPS protocol detection - projects now correctly use HTTPS when Laragon is configured for SSL
- **FIXED**: Enhanced protocol detection with multiple fallback methods (request protocol, Laragon config, port detection)
- **NEW**: `FORCE_HTTPS` configuration option to force HTTPS for all project URLs
- **IMPROVED**: Root directory cleanup - organized test files, diagnostic tools, and release notes into `_ignored/` directory
- **IMPROVED**: Better file organization with dedicated directories for releases, responses, and tests

### Version 3.1.2
- **FIXED**: Server status card icons now fully visible with solid colored backgrounds
- **FIXED**: Project card icons now fully visible in dashboard and projects page
- **FIXED**: Debug banner completely disabled by default (will not show unless explicitly enabled)
- **IMPROVED**: Platform detection now correctly identifies PHP, Python, and HTML5 projects instead of "Other"
- **IMPROVED**: Icon styling consistency across all views with explicit font-size
- **IMPROVED**: Debug banner control logic for better preference handling

### Version 3.1.1
- **NEW**: Time-based greeting and clock display in navbar (Good morning/afternoon/evening)
- **NEW**: Local time and date display with customizable formats
- **NEW**: Time format preferences (12-hour/24-hour) with auto-detection
- **NEW**: Date format preferences (ISO, US, EU formats) with auto-detection
- **NEW**: 3-dot dropdown menu on project cards for quick actions
- **NEW**: "Ignore Project" feature via dropdown menu or right-click context menu
- **IMPROVED**: WP Admin button now only shows for WordPress projects (hides automatically for others)
- **IMPROVED**: PHPMyAdmin card - direct link in "Manage MySQL" text, removed separate button
- **IMPROVED**: Navbar layout - greeting and time display positioned in center
- **IMPROVED**: Project card layout - 3-dot menu in top-left, icon/favicon in top-right
- **IMPROVED**: Button styling consistency across all project cards (WowDash pattern)
- **IMPROVED**: Share and Delete buttons added to dashboard project cards
- **NOTE**: Debug banner is disabled by default in `config.php` (line 38). Only enable if you're troubleshooting issues.

### Version 3.1.0
- **NEW**: Auto-update system with GitHub integration
- **NEW**: User preferences system with JSON storage
- **NEW**: Debug banner for troubleshooting (can be enabled in Preferences)
- **NEW**: Project deletion with database cleanup and backup options
- **NEW**: SMTP configuration fix tool for Mailpit integration
- **NEW**: Tunneling services integration (ngrok, LocalTunnel, Cloudflare Tunnel, Expose.dev)
- **IMPROVED**: Mailpit API integration with better error handling
- **IMPROVED**: Laragon path detection for custom installations
- **IMPROVED**: CSS compilation from SCSS source files
- **FIXED**: CSS loading issues for custom document root setups
- **FIXED**: Mailpit email count display issues

### Version 3.0.9
- **COMPLETE CODEBASE UPDATE**: Full repository sync with latest working installation
- All files updated to match production-ready codebase
- Comprehensive testing and validation
- Improved stability and reliability

### Version 3.0.8
- **CRITICAL FIX**: Complete CSS loading fix - all assets now use absolute paths
- **CRITICAL FIX**: Fixed Laragon detection for D:\Laragon and D:\Dev_Sites setups
- **NEW**: Added diagnostic tool (`diagnostic.php`) for troubleshooting path and configuration issues
- **NEW**: Added `.htaccess` file for improved URL rewriting and routing
- Added specific path checks for D:\Laragon, D:\Dev_Sites configurations
- Case-insensitive Laragon detection (handles both Laragon and laragon)
- Improved BASE_URL detection for custom domains (laragon-dashboard.local)
- Enhanced document root detection for custom setups
- Fixed language selector continuous running issue
- All CSS/JS assets now load correctly via localhost and custom domains

### Version 3.0.6
- Added automatic self-update functionality
- Update notifications in navbar
- User preferences for auto-update settings
- One-click update installation with progress tracking
- Automatic backup before updates
- Update checking on page load and periodic checks

### Version 3.0.5
- Fixed CSS loading issue - removed conflicting base tag
- All asset paths now use absolute paths from web root
- Improved BASE_URL calculation for better routing support
- CSS and JS files now load correctly in all scenarios

### Version 3.0.4
- Fixed CSS loading issue - improved BASE_URL and ASSETS_URL calculation
- Enhanced asset path resolution for routing scenarios
- CSS files now load correctly regardless of access method

### Version 3.0.3
- Final security cleanup - removed all exposed secrets
- Removed backup directories from repository
- Added comprehensive .gitignore file
- Repository verified clean and secure

### Version 3.0.2
- Removed backup directories from repository
- Added comprehensive .gitignore file
- Cleaned up repository structure

### Version 3.0.1
- Fixed asset path resolution issues
- Improved BASE_URL calculation for routing
- Organized development files into `/devfiles` directory
- Removed `/template` directory (no longer needed)
- Enhanced asset loading with proper base tag support

### Version 3.0.0
- Major version release
- Complete UI overhaul with modern dashboard design
- Enhanced service management
- Improved project detection
- Better database management tools
- Advanced email client integration
- Comprehensive logging system

---

**Made with ❤️ for the Laragon community**

**Author**: Tarek Tarabichi | **Company**: 2TInteractive | **Website**: https://2tinteractive.com

---

## 💼 Professional Services & Premium Solutions

### 🚀 2TInteractive - Your Development Partner

Looking for **custom development**, **premium solutions**, or **professional services**?

**2TInteractive** offers:

- **Custom Web Development** - Tailored solutions for your business needs
- **Premium Dashboard Solutions** - Enterprise-grade dashboard and admin panel development
- **Laragon Dashboard Customization** - Custom features, integrations, and modifications
- **Full-Stack Development** - Modern web applications with cutting-edge technologies
- **Consulting Services** - Expert guidance for your development projects
- **Maintenance & Support** - Ongoing support and updates for your applications

**Visit us**: [https://2tinteractive.com](https://2tinteractive.com)

**Contact**: For inquiries about premium solutions, custom development, or professional services, please visit our website or reach out through our contact channels.

---

*This dashboard is open-source and free to use. For enterprise features, custom integrations, or professional support, consider our premium services.*
