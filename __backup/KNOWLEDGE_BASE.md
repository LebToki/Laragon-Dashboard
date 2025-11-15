# Laragon Dashboard - Knowledge Base

## Project Information

- **Project Name**: Laragon Dashboard
- **Version**: 3.0.0 (in development)
- **Author**: Tarek Tarabichi
- **Company**: 2TInteractive (2tinteractive.com)
- **Project Start**: Early 2024
- **GitHub**: https://github.com/LebToki/Laragon-Dashboard
- **License**: MIT
- **Goal**: MAMP competitor for Windows OS (with potential future cross-platform support)

## Platform Support

### Current Status (as of November 2025)
- **Windows**: ✅ Fully supported (primary platform)
- **macOS**: ❌ Not supported by Laragon (Windows-only)
- **Linux**: ❌ Not supported by Laragon (Windows-only)

### Cross-Platform Research
Laragon is currently Windows-only. For future cross-platform support, the dashboard architecture should be designed to:
- Abstract platform-specific operations (service management, file paths, etc.)
- Support multiple backend environments (Laragon on Windows, MAMP/XAMPP on macOS/Linux)
- Detect and adapt to the host platform
- Provide platform-specific features when available

**Potential Future Platforms**:
- **macOS**: Could integrate with MAMP, Laravel Valet, or Docker
- **Linux**: Could integrate with LAMP stack, Docker, or platform-specific tools

## Overview
This is a web-based dashboard for managing Laragon development environment. Version 3.0.0 aims to be a comprehensive MAMP competitor on Windows, replicating Laragon control panel functionality in a modern, themed web interface.

## Template Structure

### Base Template
- **Source**: Based on wowdash template (but no mentions should remain)
- **Location**: `/template/` directory
- **Structure**: Fully bootstrapped template with:
  - `partials/layouts/layoutTop.php` - Header, sidebar, navbar
  - `partials/layouts/layoutBottom.php` - Footer, scripts
  - `partials/head.php` - Meta tags, CSS includes
  - `partials/sidebar.php` - Navigation sidebar
  - `partials/navbar.php` - Top navigation bar
  - `partials/footer.php` - Footer content
  - `partials/scripts.php` - JavaScript includes

### Template Features
- Modern dashboard UI with cards, charts, tables
- Responsive design
- Iconify icons
- ApexCharts for visualizations
- Theme support (light/dark)
- No inline JavaScript in PHP files (all JS in separate files)

### Page Structure Pattern
```php
<?php include './partials/layouts/layoutTop.php' ?>
<div class="dashboard-main-body">
    <!-- Page content -->
</div>
<?php include './partials/layouts/layoutBottom.php' ?>
```

## Laragon Control Panel Features to Replicate

### 1. Service Management
**Status**: Partially implemented
- Start/Stop/Restart services (Apache, MySQL, Nginx, Redis, Memcached, MongoDB, PostgreSQL, Mailpit)
- Service status monitoring
- Port monitoring
- Service version detection
- Windows service control via `sc` commands
- Process-based service control (for non-Windows services)

**API**: `services_manager.php`
- Actions: `status`, `start`, `stop`, `restart`, `get_ports`
- Returns JSON with service status, versions, ports

### 2. Project Management
**Status**: Partially implemented
- List projects from `www` directory
- Framework detection (WordPress, Laravel, Drupal, CodeIgniter, Symfony, CakePHP, Joomla)
- Project search/filter
- Quick access links to project admin panels
- Framework-specific icons and links

**API**: `project_search.php`
- Search projects by name
- Returns filtered project list

### 3. Database Management
**Status**: Implemented
- Browse all databases
- View database sizes
- List tables with row counts and sizes
- View table structure (columns, types, keys, constraints)
- Execute SELECT queries (read-only)
- Database optimization

**API**: `database_manager.php`
- Actions: `list_databases`, `get_tables`, `get_table_structure`, `execute_query`, `get_database_size`

### 4. Email Management (Mailpit)
**Status**: Implemented
- View emails from Laragon's sendmail output
- Email statistics (total, daily, weekly, unique senders)
- Search and filter emails
- Read email content
- Delete emails (individual and bulk)
- Export email data

**Location**: `assets/inbox/`
- `inbox.php` - Email list interface
- `open_email.php` - Email viewer

### 5. Server Monitoring
**Status**: Implemented
- Real-time system vitals (CPU, memory, disk)
- PHP memory usage tracking
- Multi-drive disk usage monitoring
- Visual charts (Chart.js)
- Windows-compatible system info

**API**: `server_vitals.php`
- Returns JSON with uptime, CPU usage, memory usage, disk usage, PHP memory info

### 6. Log Viewer
**Status**: Implemented
- View Apache logs
- View PHP logs
- View MySQL logs
- View Dashboard logs
- Configurable line count (10-1000)
- Clear log files
- Terminal-style display

**API**: `log_viewer.php`
- Actions: `list_logs`, `read_log`, `clear_log`

### 7. Quick Tools
**Status**: Implemented
- Cache management (clear application and framework caches)
- Database optimization
- Git status check
- Composer commands (install, update, dump-autoload, clear-cache)
- NPM commands (install, update, run build/dev/prod)
- PHP info viewer

**API**: `quick_tools.php`
- Actions: `clear_cache`, `optimize_database`, `composer_command`, `npm_command`, `git_status`, `php_info`

### 8. Virtual Hosts Management
**Status**: NOT IMPLEMENTED
- Create virtual hosts
- Edit virtual hosts
- Delete virtual hosts
- SSL certificate management
- Domain suffix configuration (.local, .test, etc.)
- Apache/Nginx configuration management

**Needs Implementation**:
- Read/write Apache config files (`etc/apache2/sites-enabled/*.conf`)
- Read/write Nginx config files
- SSL certificate generation/management
- Hosts file management (Windows hosts file)

### 9. Laragon Preferences
**Status**: Partially implemented
- Read Laragon preferences from `usr/laragon.ini`
- Auto-detect Laragon installation path
- Document root configuration
- Domain suffix detection
- Auto-start services configuration

**Needs Implementation**:
- Edit Laragon preferences
- Save preferences to `laragon.ini`
- Preference UI interface

### 10. Backup & Export
**Status**: Implemented
- Full project backup with database
- Configurable backup options (include vendor, include cache)
- Recent backups list
- Download backups
- ZIP compression

**API**: `backup_manager.php`
- Actions: `list`, `create`, `delete`

### 11. Update Management
**Status**: Implemented
- Automatic update checking
- Download with progress bar
- One-click update installation
- Backup before update

**API**: `update_manager.php`

## Configuration

### Config File: `config.php`
```php
// Auto-detected values
$LARAGON_ROOT = getLaragonRoot(); // Auto-detect from common paths
SENDMAIL_OUTPUT_DIR = getLaragonSendmailDir(); // C:/laragon/bin/sendmail/output/
DOMAIN_SUFFIX = getLaragonDomainSuffix(); // .local
APP_VERSION = getAppVersion(); // From Git or VERSION file

// MySQL defaults
MYSQL_HOST = 'localhost'
MYSQL_USER = 'root'
MYSQL_PASSWORD = ''

// Application settings
APP_NAME = 'Laragon Dashboard'
APP_DEBUG = true/false
SESSION_TIMEOUT = 3600
MAX_LOGIN_ATTEMPTS = 5
```

### Laragon INI File: `usr/laragon.ini`
- Contains Laragon preferences
- Read via `parse_ini_file()`
- Keys: `StartAll`, `DocumentRoot`, `DataDirectory`, `HostnameFormat`, `DomainSuffix`, `Port`, `SSLEnabled`, etc.

## File Structure

```
Laragon-Dashboard/
├── template/              # Template files (wowdash-based)
│   ├── partials/         # Layout partials
│   ├── assets/           # CSS, JS, images
│   └── *.php             # Page templates
├── assets/               # Application assets
│   ├── languages/        # Translation files
│   ├── inbox/           # Email client
│   └── style.css        # Custom styles
├── includes/             # Helper classes
│   ├── logger.php       # Logging system
│   ├── security.php     # Security helpers
│   ├── database.php     # Database utilities
│   └── cache.php        # Caching system
├── config.php           # Configuration
├── services_manager.php  # Services API
├── database_manager.php # Database API
├── server_vitals.php    # Server monitoring API
├── log_viewer.php      # Log viewer API
├── quick_tools.php     # Quick tools API
├── backup_manager.php  # Backup API
└── update_manager.php  # Update API
```

## Laragon Path Detection

### Auto-Detection Order:
1. `LARAGON_ROOT` environment variable
2. Common paths: `C:/laragon`, `D:/laragon`, `E:/laragon`
3. Detect from `DOCUMENT_ROOT` (if contains 'laragon')
4. Default fallback: `C:/laragon`

### Verification:
- Check for `laragon.exe` in root directory
- Check for `usr/laragon.ini` file

## Service Detection

### Windows Services:
- Apache: `Apache2.4` service
- MySQL: `MySQL` service
- PostgreSQL: `postgresql` service
- Redis: `Redis` service
- Memcached: `memcached` service
- MongoDB: `MongoDB` service

### Process-Based Services:
- Nginx: `nginx.exe` process
- Mailpit: `mailpit.exe` process

### Status Check:
- Windows services: `sc query "ServiceName"`
- Processes: `tasklist /FI "IMAGENAME eq process.exe"`

## Framework Detection

### Detection Methods:
1. **WordPress**: Check for `wp-config.php`
2. **Laravel**: Check for `artisan` file
3. **Drupal**: Check for `sites/default/settings.php`
4. **CodeIgniter**: Check for `application/config/config.php`
5. **Symfony**: Check for `app/AppKernel.php` or `symfony.lock`
6. **CakePHP**: Check for `config/app.php`
7. **Joomla**: Check for `configuration.php`

### Framework Icons:
- Located in `assets/` directory
- PNG format
- Framework-specific branding

## Security Features

### Implemented:
- CSRF protection (tokens)
- Security headers (X-Frame-Options, CSP, etc.)
- Input sanitization
- SQL injection protection (prepared statements)
- Rate limiting
- Secure sessions

### Security Helper: `includes/security.php`
- `SecurityHelper::validateRequest()` - Request validation
- `SecurityHelper::validateCSRF()` - CSRF token validation
- Security headers setup

## API Pattern

### Standard API Structure:
```php
<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

try {
    switch ($action) {
        case 'action1':
            // Handle action
            break;
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    DashboardLogger::error("Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
```

## Missing Features (To Implement)

### High Priority:
1. **Virtual Hosts Management**
   - Create/edit/delete virtual hosts
   - SSL certificate management
   - Apache/Nginx config editing
   - Hosts file management

2. **Laragon Preferences UI**
   - Edit preferences interface
   - Save preferences to `laragon.ini`
   - Visual preference management

3. **Project Creation Wizard**
   - Create new projects
   - Framework-specific setup
   - Database creation
   - Virtual host auto-creation

### Medium Priority:
1. **SSL Certificate Generator**
   - Generate self-signed certificates
   - Certificate management UI

2. **Database Creation/Management**
   - Create databases
   - Import/export databases
   - User management

3. **File Manager**
   - Browse project files
   - Edit files
   - Upload/download files

### Low Priority:
1. **Terminal Integration**
   - Web-based terminal
   - Command execution

2. **Package Management**
   - Composer package browser
   - NPM package browser

## Development Guidelines

### Code Standards:
- No inline JavaScript in PHP files
- All JavaScript in separate `.js` files
- Use template partials for layout
- Follow PSR-12 coding standards
- Comprehensive error handling
- Security-first approach

### Template Usage:
- Use `blank-page.php` as template for new pages
- Include layout partials, don't duplicate
- Use template CSS classes and components
- No Bootstrap classes (use template's custom classes)

### API Design:
- JSON responses
- Consistent error handling
- Security validation on all endpoints
- Logging for all operations

## Wowdash References to Remove

### Files with Wowdash Mentions:
1. **template/partials/head.php** (line 4)
   - Title: "Wowdash - Bootstrap 5 Admin Dashboard HTML Template"
   - Should be: "Laragon Dashboard"

2. **template/partials/footer.php** (lines 4, 7)
   - "© 2024 WowDash. All Rights Reserved."
   - "Made by WowDash"
   - Should be: "Laragon Dashboard" branding

3. **template/wallet.php** (line 434)
   - "WowDash" text

4. **template/voice-generator.php** (multiple lines)
   - "WowDash" branding in chat interface
   - Placeholder: "Message wowdash..."

5. **template/video-generator.php** (multiple lines)
   - "WowDash" branding in chat interface
   - Placeholder: "Message wowdash..."

6. **template/text-generator.php** (multiple lines)
   - "WowDash" branding in chat interface
   - Placeholder: "Message wowdash..."

7. **template/text-generator-new.php** (line 102)
   - Placeholder: "Message wowdash..."

8. **template/code-generator.php** (multiple lines)
   - "WowDash" branding in chat interface
   - Placeholder: "Message wowdash..."

9. **template/code-generator-new.php** (line 100)
   - Placeholder: "Message wowdash..."

10. **template/image-generator.php** (multiple lines)
    - "WowDash" branding in chat interface
    - Placeholder: "Message wowdash..."

11. **template/typography.php** (multiple lines)
    - "- WowDash" text in examples

12. **template/notification.php** (lines 43, 49, 55)
    - Firebase config examples: "wowdash.firebaseapp.com", "wowdash.com", "wowdash.appsport.com"

13. **template/maintenance.php** (line 26)
    - Placeholder: "wowdash@gmail.com"

14. **template/coming-soon.php** (line 46)
    - Placeholder: "wowdash@gmail.com"

15. **template/faq.php** (line 40)
    - Question: "How to can i use WowDash?"

16. **template/assets/images/wow-dash-favicon.png**
    - Image file that should be replaced with Laragon branding

### Action Items:
- Replace all "WowDash"/"wowdash" text with "Laragon Dashboard" or appropriate Laragon branding
- Update placeholders and examples
- Replace favicon image
- Update footer copyright
- Update page titles

## Notes

- Template is fully bootstrapped - no need for separate bootstrap.php
- All JavaScript should be external files, referenced via `$script` variable in `partials/scripts.php`
- Remove all mentions of "wowdash" from codebase
- Theme compliance: no h1-h6 tags, no text-muted, no bg-white classes
- Always check database schema directly before creating queries
- Avoid double work - check existing implementations first

