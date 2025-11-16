# 🚀 Laragon Dashboard

A modern, feature-rich web-based dashboard for managing Laragon development environment. Version 3.0.9 aims to be a comprehensive MAMP competitor on Windows, replicating Laragon control panel functionality in a modern, themed web interface.

[![Version](https://img.shields.io/badge/version-3.0.9-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

---

## ✨ Screenshots

<img width="1897" height="870" alt="image" src="https://github.com/user-attachments/assets/15a4ea21-8fd6-4d2b-a8f0-960f7d74ef68" />
<img width="1881" height="884" alt="image" src="https://github.com/user-attachments/assets/3b365184-b31a-4949-aa0b-830a1fd5b7f5" />
<img width="1662" height="910" alt="image" src="https://github.com/user-attachments/assets/9ef3dba4-de0b-483a-8ad2-d0771e7f9f51" />
<img width="1650" height="912" alt="image" src="https://github.com/user-attachments/assets/49eca78e-5bfe-4322-8302-b65c929e7d9a" />
<img width="1663" height="916" alt="image" src="https://github.com/user-attachments/assets/19d0fb09-1b4d-4702-a89e-85916f11bfd3" />
<img width="1660" height="914" alt="image" src="https://github.com/user-attachments/assets/44045854-c75f-40fb-87e2-1dbcbc1cf617" />
<img width="1898" height="910" alt="image" src="https://github.com/user-attachments/assets/43dfe841-8e53-4208-9bea-ad38364ebf4e" />
<img width="1896" height="909" alt="image" src="https://github.com/user-attachments/assets/aac174e3-6b30-4a03-b8be-f594aabb3786" />

---

## 📋 Project Information

- **Project Name**: Laragon Dashboard
- **Version**: 3.0.9
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
APP_DEBUG = false
SESSION_TIMEOUT = 3600
MAX_LOGIN_ATTEMPTS = 5
```

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

### Debug Mode

Enable debug mode in `config.php`:

```php
define('APP_DEBUG', true);
```

This will show:
- Detailed error messages
- Performance metrics
- Debug information in footer

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

### Version 3.0.9 (Current)
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
