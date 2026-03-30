# Changelog

All notable changes to this project will be documented in this file.

## [4.0.5] - 2026-03-17 

## What's Changed
* refactor: utilize Security::checkAuth and update Router authentication by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/47
* performance: consolidate shell executions for service and system vitals by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/48
* 🧹 chore: remove unused getDiskInfo and formatBytes methods by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/49
* 🧹 [Code Health] Remove unused getDiskInfo and formatBytes methods from System class by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/50
* 🧹 Remove unused scanForLaragonInstallations from config.php by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/54
* 🧪 [Testing Improvement] Add tests for Services::stop() method by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/55
* Fix false-positive TODO in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/56
* 🧪 Test System::getDiskInfo() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/57
* Remove architectural TODO from vendored full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/73
* ⚡ Optimize disk space WMI query in vitals API by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/76
* 🧪 Add tests for UpdateManager::checkForUpdates by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/75
* 🧪 Add tests for findFile() depth constraint by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/74
* ⚡ Optimize git branch and status checks in project scanner by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/77
* Fix: trigger dayRender in AgendaView buildDayTable by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/78
* ⚡ Consolidate service status query execution and fix boundary matching by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/80
* 🧪 Add PHPUnit test suite for getServicesStatus by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/79
* 🧹 [Code Health] Refactor `getServerVitals` in `api/vitals.php` by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/82
* 🧪 Add test for Cache::set() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/83
* Fix: Address TODO in full-calendar.css using opacity by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/81
* 🧪 Add tests for Security::verifyCSRFToken() error paths by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/72
* Remove TODOs from vendored full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/53
* Remove TODO in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/68
* Clarify isAuthenticated method in Router by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/71
* chore: clear TODO in vendored full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/60
* 🧪 Add tests for formatLogToHtml error handling by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/84
* 🧪 Add tests for AdminerModule::isInstalled() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/51
* Fix missing start date handling in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/69
* 🧪 Test Databases::drop() method by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/70
* 🧪 [testing improvement] Add test coverage for Logs::read() method by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/67
* 🧪 Add unit tests for Databases::list() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/61
* 🧪 Implement tests for getLaragonRoot() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/85
* Fix: prevent parseDate from returning invalid Date objects in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/63
* 🧪 Add tests for createProject in helpers.php by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/66
* 🧪 Add unit tests for load_translations in i18n.php by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/64
* 🧪 [Testing] Add test suite for Router::resolve method by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/58
* chore: Remove memory leak TODO from vendored full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/52
* 🧪 Add comprehensive tests for Services management and system commands by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/59
* 🧪 test: implement comprehensive tests for ConfigMigrator by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/62
* 🧪 Add tests for Security::generateCSRFToken() by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/65
* Fix: add .fc-today to <th> to highlight current day by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/86
* 🧹 [Code Health] Disable authentication check in Router for stack dashboard experience by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/88
* Refactor full-calendar.js to remove modifiedEventID early binding hack by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/87
* chore: remove invalid TODO comment from full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/89
* Fix duplicated code for event classNames in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/90
* feat: support git pull in update manager by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/91
* Unify clearEvents in full-calendar.js by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/93
* Refactor: Consolidate renderDayOverlay in FullCalendar by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/92
* 🎨 Palette: Add ARIA labels to navigation buttons by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/94
* ⚡ Bolt: Optimize getDiskUsage using native PHP functions by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/95
* 🛡️ Sentinel: [CRITICAL] Fix Path Traversal in Backup API by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/96
* style: Override fc-event-bg with a better selector by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/98
* Fix order-dependent class replacement in full-calendar setDayID by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/97
* Fix missing authentication in Update API by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/99
* Fix file encodings and migrate custom tests to PHPUnit by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/100
* Fix "ignore project" and save ignored state to main configuration by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/101
* 🧪 Test Security::verifyCSRFToken() error path by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/102
* Support CodePilot installation and update tests by @LebToki in https://github.com/LebToki/Laragon-Dashboard/pull/103


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
