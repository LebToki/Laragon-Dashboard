# Changelog

All notable changes to this project will be documented in this file.

## [3.1.5] - Current
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
