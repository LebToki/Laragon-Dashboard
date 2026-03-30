# Changelog

All notable changes to this project will be documented in this file.

## [4.1.0] - 2026-03-31

### 🔒 Security Hardening
- **CRITICAL**: Added authentication enforcement to Mailpit API — previously accessible without login
- **CRITICAL**: Added CSRF token validation to Mailpit message deletion endpoint
- **CRITICAL**: Update download URLs now restricted to official `LebToki/Laragon-Dashboard` GitHub repository only — prevents arbitrary file download attacks
- **CRITICAL**: Composer package names in tools API now validated against strict regex — prevents command injection via malicious package names
- **HIGH**: Unified service start/stop methods across `Services.php` and `api/services.php` — both now use `sc` with status polling for reliable results
- **HIGH**: Fixed `mysqldump` command in `Databases::backup()` — password handled correctly without shell-quoting issues
- **HIGH**: Backup ZIP now excludes `vendor/`, `node_modules/`, `.git/`, and other bloat directories — smaller backups, no secrets leaked

### 🐛 Bug Fixes
- **HIGH**: Fixed `ASSETS_URL` resolution for subdirectory access (`localhost/Laragon-Dashboard/`) — all CSS/JS/images now load correctly
- **HIGH**: Fixed `.htaccess` favicon rewrite rule — uses relative path for subdirectory compatibility
- **HIGH**: Fixed sidebar and navbar asset fallback paths — no more relative `assets/` paths that break on subdirectory access
- **HIGH**: phpMyAdmin link now dynamically resolves from Laragon config instead of hardcoded `http://localhost/phpmyadmin`
- **HIGH**: Project card Share/Delete buttons now functional — Share copies URL to clipboard, Delete calls `delete_project.php` API
- **MEDIUM**: Fixed `getResourceUsage()` CSV parsing in `Services.php` — now correctly parses multi-line `tasklist` output
- **MEDIUM**: Removed fabricated CPU data (`rand(5,15)`) and network data (`rand()`) from vitals API — no more fake metrics
- **MEDIUM**: Removed dead PowerShell command in vitals API that was never executed

### ✨ New Features
- **NEW**: `execute_query` API endpoint for databases — read-only SELECT/SHOW/DESCRIBE/EXPLAIN queries with CSRF protection
- **NEW**: `get_tables` and `get_table_structure` API endpoints for database schema browsing
- **NEW**: `getPhpMyAdminUrl()` helper function — dynamically resolves phpMyAdmin URL from Laragon configuration
- **NEW**: `shareProject()` and `confirmDeleteProject()` JavaScript functions on dashboard homepage

### 🏗️ Architecture
- **IMPROVED**: Service start/stop unified to `sc` + status polling pattern across `Services.php` core class
- **IMPROVED**: Backup system now intelligently excludes heavy directories (vendor, node_modules, .git)
- **IMPROVED**: All asset path fallbacks now derive from `BASE_URL` instead of hardcoded relative paths

## [4.0.4] - 2026-03-01

- **FIXED**: Restored missing `diagnostic.php` file (Issue #45)
- **FIXED**: Content Security Policy for Iconify icons (BOT icon now loads)
- **FIXED**: Ignore project cache invalidation (projects now properly hide when ignored)
- **UPDATED**: `.htaccess` CSP to allow external resources (fonts, icons)
- **IMPROVED**: Diagnostic tool now loads files in correct order for version 4.0.3+
- **SPECIAL THANKS**: To @jyllstuart for reporting and spotting the missing diagnostic.php file
- **UPDATED**: Version number to 4.0.4

## [4.0.3] - 2026-03-01

- **FIXED**: Critical `Fatal error: Cannot redeclare getLogFiles()` in log viewer.
- **IMPROVED**: Robust log discovery patterns for Apache, PHP, and MySQL.
- **IMPROVED**: Memory-efficient tailing for large log files (prevents "Empty log file" state).
- **IMPROVED**: Standardized log icons using the `solar:` set for consistent theme rendering.
- **IMPROVED**: Server Vitals performance with 5-second intelligent caching.
- **NEW**: Local Auto-Authorization – Dashboard now pre-authorizes requests from `localhost`, `127.0.0.1`, or `::1` for a seamless Developer Experience.
- **FIXED**: JSON response flattening for Logs API to ensure reliable UI probing.
- **UPDATED**: Version number to 4.0.3.

## [4.0.2] - 2026-03-01

## [4.0.0] - 2026-02-15 (Major Release)

- **MAJOR: Modern Re-engineering & AI Integration**: Complete transition to modular Core architecture using PSR-4 autoloader.
- **NEW: AI Agent (Beta)**: Integration of a glassmorphic chat widget and system context bridge for intelligent environment assistance.
- **NEW: Advanced Database Engine**: Re-engineered database page with full schema explorer, result grid, and read-only query runner.
- **NEW: Logs as HTML**: Revolutionary log renderer for Mailbox that parses raw email logs into beautiful, searchable HTML tables.
- **NEW: Config Editor 2.0**: Completely revamped service configuration editor with theme-aware transparency and improved routing.
- **NEW: Updatable Core Paths**: Added support for custom Laragon Root paths with real-time validation and persistence.
- **IMPROVED: Glassmorphism UI**: Applied "Glass-Card" aesthetic to project cards and optimized dark mode gradients.
- **IMPROVED: Performance Engine**: Refined project discovery logic with intelligent directory exclusion and high-speed caching.
- **FIXED**: Resolved 500 error in modular Log API and fixed 404 routing for Config Editor.
- **MODULAR**: New classes in `includes/Core/` (`Security`, `System`, `Services`, `Logs`, `Cache`).
- **SECURITY**: Universal CSRF protection & Mandatory session-based authentication.
- **PERFORMANCE**: Integrated `Core\Cache` for expensive system operations.

## [3.1.5]

- **IMPROVED**: Enhanced auto-update mechanism with better error handling and logging
- **FIXED**: Backup path now correctly passed through all update steps
- **IMPROVED**: UpdateManager now uses getAppVersion() for better version detection (supports Git tags)
- **IMPROVED**: Better version comparison logic (handles dev versions correctly)
- **IMPROVED**: Enhanced error messages and validation throughout update process
- **IMPROVED**: Better file replacement tracking and error reporting
- **IMPROVED**: Enhanced rollback mechanism with detailed file restoration tracking
- **IMPROVED**: Improved GitHub API error handling and timeout settings
- **IMPROVED**: Better verification checks for critical files and functions

## [3.1.4]

- **FIXED**: Checkbox settings in Preferences can now be properly unset - fixed issue where settings like "Show Debug Banner" couldn't be disabled once enabled
- **FIXED**: All checkbox preferences (debug_banner, auto_update_check, auto_update_install) now correctly save their unchecked state
- **IMPROVED**: Enhanced preferences API to handle checkbox unsetting by explicitly processing false/0 values
- **IMPROVED**: JavaScript form submission now includes all checkbox fields even when unchecked
- **IMPROVED**: Added data/preferences.json to .gitignore to protect sensitive user data

## [3.1.3]

- **FIXED**: HTTP/HTTPS protocol detection - projects now correctly use HTTPS when Laragon is configured for SSL
- **FIXED**: Enhanced protocol detection with multiple fallback methods (request protocol, Laragon config, port detection)
- **NEW**: `FORCE_HTTPS` configuration option to force HTTPS for all project URLs
- **IMPROVED**: Root directory cleanup - organized test files, diagnostic tools, and release notes into `_ignored/` directory
- **IMPROVED**: Better file organization with dedicated directories for releases, responses, and tests

## [3.1.2]

- **FIXED**: Server status card icons now fully visible with solid colored backgrounds
- **FIXED**: Project card icons now fully visible in dashboard and projects page
- **FIXED**: Debug banner completely disabled by default (will not show unless explicitly enabled)
- **IMPROVED**: Platform detection now correctly identifies PHP, Python, and HTML5 projects instead of "Other"
- **IMPROVED**: Icon styling consistency across all views with explicit font-size
- **IMPROVED**: Debug banner control logic for better preference handling

## [3.1.1]

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

## [3.1.0]

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

## [3.0.9]

- **COMPLETE CODEBASE UPDATE**: Full repository sync with latest working installation
- All files updated to match production-ready codebase
- Comprehensive testing and validation
- Improved stability and reliability

## [3.0.8]

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

## [3.0.6]

- Added automatic self-update functionality
- Update notifications in navbar
- User preferences for auto-update settings
- One-click update installation with progress tracking
- Automatic backup before updates
- Update checking on page load and periodic checks

## [3.0.5]

- Fixed CSS loading issue - removed conflicting base tag
- All asset paths now use absolute paths from web root
- Improved BASE_URL calculation for better routing support
- CSS and JS files now load correctly in all scenarios

## [3.0.4]

- Fixed CSS loading issue - improved BASE_URL and ASSETS_URL calculation
- Enhanced asset path resolution for routing scenarios
- CSS files now load correctly regardless of access method

## [3.0.3]

- Final security cleanup - removed all exposed secrets
- Removed backup directories from repository
- Added comprehensive .gitignore file
- Repository verified clean and secure

## [3.0.2]

- Removed backup directories from repository
- Added comprehensive .gitignore file
- Cleaned up repository structure

## [3.0.1]

- Fixed asset path resolution issues
- Improved BASE_URL calculation for routing
- Organized development files into `/devfiles` directory
- Removed `/template` directory (no longer needed)
- Enhanced asset loading with proper base tag support

## [3.0.0]

- Major version release
- Complete UI overhaul with modern dashboard design
- Enhanced service management
- Improved project detection
- Better database management tools
- Advanced email client integration
- Comprehensive logging system
