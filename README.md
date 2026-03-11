# 🚀 Laragon Dashboard

We're thrilled to announce the release of Laragon Dashboard 4.0.4, a complete reimagining of local development environment management for Windows. This isn't just an update, it's a quantum leap forward in how you interact with your Laragon setup.

Laragon Dashboard is a modern, feature-rich web-based dashboard for managing Laragon development environment. 
Version 4.0.4 aims to be a comprehensive MAMP competitor on Windows, replicating Laragon control panel functionality in a modern, themed web interface.

"The best Windows development environment just got better. Welcome to the future of local development."


[![Version](https://img.shields.io/badge/version-4.0.4-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple.svg)](https://getbootstrap.com)
[![Platform](https://img.shields.io/badge/platform-windows-lightgrey.svg)]()
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)
[![GitHub](https://img.shields.io/github/stars/LebToki/Laragon-Dashboard?style=social)](https://github.com/LebToki/Laragon-Dashboard)

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-Donate-yellow?style=for-the-badge&logo=buy-me-a-coffee)](https://buymeacoffee.com/LebToki)
[![Donate via Paypal](https://img.shields.io/badge/Donate%20with%20Paypal-Donate-blue?style=for-the-badge&logo=paypal)](https://www.paypal.com/donate/?hosted_button_id=TEEJNYQJA9B6U)

<p align="center">
  <img src="https://img.shields.io/github/stars/LebToki/Laragon-Dashboard?style=for-the-badge" alt="Stars" />
  <img src="https://img.shields.io/github/forks/LebToki/Laragon-Dashboard?style=for-the-badge" alt="Forks" />
  <img src="https://img.shields.io/badge/PRs-welcome-brightgreen?style=for-the-badge" alt="PRs Welcome" />
</p>

![Laragon Dashboard](assets/images/og_banner.png)
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
- **Version**: 4.0.4
- **Author**: Tarek Tarabichi
- **Company**: 2TInteractive (2tinteractive.com)
- **Project Start**: Early 2024
- **GitHub**: https://github.com/LebToki/Laragon-Dashboard
- **License**: MIT
- **Goal**: MAMP competitor for Windows OS (with potential future cross-platform support)

---

## 💡 Why This Matters
Laragon has always been the fastest, most lightweight development environment for Windows. With version 4.0.4 of the dashboard, we're bringing that same philosophy to the web interface:

- No Electron bloat – Pure web technology, zero memory overhead
- **Instant Startup** – Access your dashboard immediately via localhost.
- **Seamless Auth** – Local Auto-Authorization pre-authorizes sessions from `127.0.0.1`.
- **Integrated Environment** – Direct bridge between web UI and Laragon services.
- Native feel – WebSocket updates make it feel like a desktop app
- Extensible – Plugin system for custom tools and integrations

## 🎉 Join the Revolution
This release transforms Laragon from a simple WAMP alternative into a comprehensive development ecosystem that rivals (and surpasses) MAMP on macOS. Whether you're a Laravel artisan, WordPress developer, or Symfony specialist, this dashboard will change how you work.

-> Download now from the official repository or update through Laragon's built-in tools.

---

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
- **Universal Database Browser** - Browse all databases with real-time size calculations.
- **Table Explorer & Schema Viewer** - Deep-dive into table structures, row counts, indices, and constraints.
- **Safe SQL Query Runner** - Execute SELECT queries with a result grid (Safe Read-Only mode).
- **Engine & Collation Tracking** - Monitor storage engines and character sets at a glance.
- **Modular Backend** - Powered by a high-performance `Databases.php` core class.

### 📧 Email Management (Mailpit)
- **Smart Email Viewer** - Integrated viewer for Laragon's sendmail output.
- **Logs as HTML Rendering** - **NEW**: Automagically transforms raw log emails into searchable, color-coded HTML tables.
- **Mailpit Sync** - Seamless integration with Mailpit for real-time local email monitoring.
- **Email Statistics** - Comprehensive breakdown of email volume and unique senders.
- **Bulk Operations** - Advanced search, filter, and management of local mail.

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
- **GitHub-Integrated Updates** - Automatic checks against the latest releases.
- **Visual Progress** - Real-time download and installation feedback.
- **Safety First** - Automated backup of the current installation before any update.

### 🤖 AI Integration (Beta)
- **BYOK AI Agent** - **NEW**: Integrated glassmorphic chat widget for project scaffolding, troubleshooting, and code assistance.
- **System Context Bridge** - Secure backend API providing real-time environment data to the agent.

## 🔌 Plugin System (New in 4.0.4+)

Laragon Dashboard now features a powerful plugin system that allows you to extend functionality with third-party tools and integrations.

### 🎯 Available Plugins

#### 🤖 **CodePilot** - AI-Powered Code Editor
- **Multi-provider AI support**: Ollama, DeepSeek, Gemini, HuggingFace, OpenAI, Anthropic, Qwen, MiniMax
- **Project manager** with 7 starter templates
- **AI Studio** for image generation
- **Monaco Editor** (VS Code engine)
- **Full file browser** and editor
- **One-click installation** from GitHub

### 🚀 Installing Plugins

1. Click the **puzzle icon** in the navbar
2. Click **"Open Plugin Hub"**
3. Browse available plugins
4. Click **"Install"** on any plugin

### 🔧 Plugin Management

- **Auto-updates**: Plugins check for updates automatically
- **One-click updates**: Update plugins with a single click
- **Easy uninstallation**: Remove plugins completely
- **Enable/disable**: Toggle plugins without uninstalling

### 🛠️ For Developers: Creating Plugins

Plugins are distributed as GitHub releases with `.zip` archives. To create a plugin:

1. Create a GitHub repository with your plugin
2. Add a `plugin.json` manifest file
3. Create releases with `.zip` archives
4. Add your plugin to the available plugins list

### 📁 Plugin Structure
```
plugins/
├── codepilot/          # Plugin directory
│   ├── public/         # Web-accessible files
│   ├── src/            # Source code
│   └── plugin.json     # Plugin manifest
└── ...

data/plugins/
└── registry.json      # Installed plugins registry
```

### 🔄 Automatic Updates

Plugins automatically check for updates from GitHub and notify you when new versions are available.

---

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

---

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

## 🚀 Production Deployment

### Prerequisites
- PHP 7.4 or higher
- Laravel (or any PHP web server like Apache/Nginx)
- HTTPS enabled (recommended for production)

### Security Configuration

Before deploying to production, please configure the following security settings in `config.php`:

#### 1. Enable Authentication

The dashboard now requires authentication by default. Make sure to set a strong password:

```php
// In config.php
define('AUTH_ENABLED', true);

// Set a strong password (recommended: use environment variable)
define('ADMIN_PASSWORD', getenv('LARAGON_DASHBOARD_PASSWORD') ?: 'YourStrongPassword123!');
```

**Best Practice:** Use environment variables instead of hardcoding passwords:
```bash
# Set environment variable
set LARAGON_DASHBOARD_PASSWORD=YourStrongPassword123!
```

#### 2. Configure HTTPS (Recommended)

Uncomment the HTTPS redirect in `.htaccess`:
```apache
# .htaccess
RewriteCond %{HTTPS} off
RewriteCond %{HTTP:X-Forwarded-Proto} !https
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
```

#### 3. Production Settings

The following settings are recommended for production:

```php
// config.php
define('APP_DEBUG', false);        // Disable debug mode
define('APP_ENV', 'production');   // Set environment
define('SECURITY_HEADERS_ENABLED', true);  // Enable security headers
```

### Quick Production Setup

1. **Clone the repository:**
```bash
git clone https://github.com/LebToki/Laragon-Dashboard.git
cd Laragon-Dashboard
```

2. **Checkout production branch:**
```bash
git checkout production
```

3. **Configure security:**
   - Edit `config.php` and set a strong admin password
   - Or set `LARAGON_DASHBOARD_PASSWORD` environment variable

4. **Configure HTTPS:**
   - Uncomment HTTPS redirect in `.htaccess`
   - Or configure SSL in your web server

5. **Access the dashboard:**
   - Navigate to your deployed URL
   - Login with your configured password

### Environment Variables

| Variable                     | Description               | Default              |
|------------------------------|---------------------------|----------------------|
| `LARAGON_DASHBOARD_PASSWORD` | Admin password            | (none - must be set) |
| `LARAGON_ROOT`               | Laragon installation path | Auto-detected        |

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

### 🎨 Theme System
The dashboard leverages Bootstrap 5's theming capabilities with a custom CSS layer. 
You can easily customize the look and feel by modifying these CSS variables:

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

## [4.0.4] - 2026-03-01

### 🚀 NEW: Plugin System
- **COMPLETE PLUGIN ARCHITECTURE**: Full plugin management system with GitHub integration
- **PLUGIN MANAGER CLASS**: `LaragonDashboard\Core\PluginManager` for plugin lifecycle management
- **REST API**: `/api/plugins.php` for plugin operations (install, uninstall, update, list)
- **PLUGIN HUB UI**: New page at `/index.php?page=plugins` for plugin management
- **NAVBAR INTEGRATION**: Puzzle icon replaces notifications for plugin hub access
- **AUTO-UPDATES**: Plugins automatically check for updates from GitHub releases
- **CODE PILOT PLUGIN**: First-party AI code editor plugin available for installation

### 🔌 Plugin Features
- **One-click installation** from GitHub repositories
- **Automatic update detection** and notifications
- **Plugin registry** in `data/plugins/registry.json`
- **Enable/disable** plugins without uninstallation
- **Clean uninstallation** with complete file removal
- **Multi-provider AI support** in CodePilot (Ollama, DeepSeek, Gemini, OpenAI, Anthropic, Qwen, MiniMax)

### 🛠️ Technical Improvements
- **Extensible architecture** for future plugins
- **Secure authentication** required for all plugin operations
- **CSRF protection** on all plugin API endpoints
- **Automatic directory creation** for plugin storage
- **GitHub API integration** for release downloads

- **FIXED**: Restored missing `diagnostic.php` file (Issue #45)
- **FIXED**: Content Security Policy for Iconify icons (BOT icon now loads)
- **FIXED**: Ignore project cache invalidation (projects now properly hide when ignored)
- **UPDATED**: `.htaccess` CSP to allow external resources (fonts, icons)
- **IMPROVED**: Diagnostic tool now loads files in correct order for version 4.0.3+
- **SPECIAL THANKS**: To @jyllstuart for reporting and spotting the missing diagnostic.php file
- **UPDATED**: Version number to 4.0.4
```

**Made with ❤️ for the Laragon community**

**Author**: Tarek Tarabichi | **Company**: 2TInteractive | **Website**: https://2tinteractive.com

---

## ☕ Support the Project

If you find Laragon Dashboard helpful and want to support its ongoing development, consider buying me a coffee or donating via PayPal! Your support helps keep the project active and enables the creation of more advanced features.

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20A%20Coffee-Donate-yellow?style=for-the-badge&logo=buy-me-a-coffee)](https://buymeacoffee.com/LebToki)
[![Donate via Paypal](https://img.shields.io/badge/Donate%20with%20Paypal-Donate-blue?style=for-the-badge&logo=paypal)](https://www.paypal.com/donate/?hosted_button_id=TEEJNYQJA9B6U)

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
