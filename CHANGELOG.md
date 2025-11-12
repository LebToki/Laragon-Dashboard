# Changelog

All notable changes to the Laragon Dashboard project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.6.0] - 2025-01-XX

### Added

- **Self-Update Mechanism**
  - Automatic update checking
  - Download with progress bar
  - One-click update installation
  - Backup before update
  - Update manager API endpoint

- **Bcrypt Password Generator**
  - Generate bcrypt hashes
  - Copy to clipboard functionality
  - Modern UI card design

- **Backup & Export Tool**
  - Full project backup with database
  - Configurable backup options
  - Recent backups list
  - Download backups

- **Enhanced UI**
  - Modern card-based design
  - Improved tool organization
  - Better visual hierarchy
  - Enhanced styling

### Changed

- **Project Structure**
  - All files consolidated into LaragonDash/ folder
  - Root index.php serves as simple loader
  - Cleaner installation structure
  - Better organization for updates

- **API Endpoints**
  - All endpoints now under LaragonDash/ prefix
  - Updated asset paths
  - Consistent path structure

### Fixed

- **CSRF Protection**
  - Added CSRF tokens to all POST requests
  - Improved security for API endpoints

## [2.5.1] - 2025-01-XX

### Added

- **Database Management Tab**
  - Browse all databases and view database sizes
  - List tables with row counts and sizes
  - View table structure (columns, types, keys)
  - Execute SELECT queries safely
  - Real-time database information display

- **Services Management Tab**
  - Start, stop, and restart services (Apache, MySQL, Nginx, Redis, Memcached)
  - Real-time service status monitoring
  - Port monitor to view all listening ports
  - Service control with confirmation dialogs

- **Log Viewer Tab**
  - View Apache, PHP, MySQL, and Dashboard logs
  - Configurable number of lines to display
  - Clear log files functionality
  - Automatic log file detection
  - Terminal-style log display

- **Quick Tools Tab**
  - Cache management (clear application cache)
  - Database optimization (optimize all tables in a database)
  - Project actions:
    - Git status check
    - Composer install/update commands
    - NPM install/update commands
  - PHP info viewer
  - Project selector for quick actions

- **Enhanced API Endpoints**
  - `database_manager.php` - Database operations API
  - `services_manager.php` - Service control API
  - `log_viewer.php` - Log viewing API
  - `quick_tools.php` - Quick actions API

### Changed

- **Navigation**
  - Added 4 new tabs: Databases, Services, Logs, and Tools
  - Improved tab navigation with better organization

- **Language Support**
  - Added translations for all new features
  - Extended English language file with new terms

### Fixed

- **Path Issues**
  - Fixed incorrect config.php paths in includes files
  - Corrected relative path references in helper classes
  - Fixed log directory path in logger

- **Code Quality**
  - Improved error handling in API endpoints
  - Added security checks for all API actions
  - Better input validation and sanitization

### Technical Details

- **New Files**
  - `database_manager.php` - Database management API
  - `services_manager.php` - Services control API
  - `log_viewer.php` - Log viewing API
  - `quick_tools.php` - Quick tools API

- **Security**
  - All API endpoints protected with security validation
  - Query execution limited to SELECT, SHOW, DESCRIBE, EXPLAIN
  - Path validation for file operations
  - Service control requires confirmation

## [2.5.0] - 2024-12-19

### Added

- **Security Enhancements**
  - CSRF protection with secure token generation
  - Security headers (X-Frame-Options, X-Content-Type-Options, X-XSS-Protection)
  - Content Security Policy (CSP) implementation
  - Rate limiting system to prevent abuse
  - Input sanitization and validation helpers
  - Secure session management

- **Performance Improvements**
  - File-based caching system with TTL support
  - Performance monitoring and logging
  - Database connection pooling
  - Memory usage tracking
  - Execution time monitoring

- **Logging & Monitoring**
  - Comprehensive logging system with multiple levels
  - Error handling and exception management
  - Access logging with IP and user agent tracking
  - Debug mode with detailed performance metrics

- **Database Integration**
  - PDO-based database helper with connection management
  - MySQL server status monitoring
  - Database and table information retrieval
  - Secure query execution with prepared statements

- **Modern Email Client Interface**
  - Bootstrap 5 responsive design
  - Interactive email statistics dashboard
  - Advanced search and filtering capabilities
  - Professional email cards with hover effects
  - Modal email viewer with enhanced styling
  - Keyboard shortcuts and accessibility improvements

### Changed

- **UI/UX Improvements**
  - Removed all h1-h6 tags per project requirements
  - Enhanced responsive design for mobile devices
  - Modern card-based layout for better organization
  - Improved color scheme and typography
  - Better accessibility with ARIA labels and keyboard navigation

- **Server Vitals**
  - Windows-compatible system monitoring using PHP functions
  - Real-time server statistics with visual charts
  - PHP memory usage tracking and visualization
  - Disk usage monitoring for multiple drives
  - Enhanced error handling for system commands

- **Configuration Management**
  - Comprehensive configuration system with environment variable support
  - Security settings and file upload configurations
  - Error reporting controls
  - Session timeout and login attempt limits

### Fixed

- **Compatibility Issues**
  - Fixed Windows-specific command execution
  - Resolved language file JSON structure inconsistencies
  - Fixed missing file references and broken includes
  - Corrected path handling for cross-platform compatibility

- **Security Vulnerabilities**
  - Sanitized all user inputs
  - Implemented proper error handling
  - Added protection against common web vulnerabilities
  - Secured file operations and directory access

- **Performance Issues**
  - Optimized database queries
  - Reduced memory usage
  - Improved page load times
  - Enhanced caching mechanisms

### Technical Details

- **File Structure**
  - Added `includes/` directory for helper classes
  - Created `logs/` directory for application logging
  - Added `cache/` directory for performance caching
  - Implemented proper `.gitignore` for version control

- **Code Quality**
  - Object-oriented design patterns
  - Comprehensive error handling
  - Detailed code documentation
  - Consistent coding standards
  - Security best practices implementation

## [2.4.0] - 2024-12-18

### Added

- Basic Bootstrap 5 email client interface
- Email statistics dashboard
- Search and filtering functionality
- Responsive email cards
- Email modal viewer

### Changed

- Updated language file structure
- Improved server vitals display
- Enhanced error handling

### Fixed

- Removed h1-h6 tags per requirements
- Fixed Windows compatibility issues
- Corrected language file JSON format

## [2.3.5] - Previous Version

### Added

- Dynamic hostname detection
- Improved CakePHP and Joomla detection
- Multi-language support

### Contributors

- @LrkDev (v.2.1.2)
- @luisAntonioLAGS (v.2.2.1 Spanish)
- @martic (v.2.3.5 Dynamic Hostname Detection)
