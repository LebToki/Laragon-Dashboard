# 🚀 Laragon Dashboard

A modern, feature-rich dashboard for Laragon development environment with advanced email management, server monitoring, and security features.

[![Version](https://img.shields.io/badge/version-2.5.1-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

## ✨ Features

### 🎨 Modern Email Client

- **Bootstrap 5 Interface** - Professional, responsive design
- **Interactive Statistics** - Real-time email metrics and analytics
- **Advanced Search** - Filter emails by sender, subject, or content
- **Email Cards** - Beautiful hover effects and smooth animations
- **Modal Viewer** - Enhanced email reading experience
- **Bulk Operations** - Mass email management capabilities
- **Keyboard Shortcuts** - Improved accessibility and productivity

### 📊 Server Monitoring

- **Real-time Vitals** - CPU, memory, and disk usage monitoring
- **Visual Charts** - Interactive charts using Chart.js
- **Windows Compatible** - Optimized for Windows/Laragon environment
- **PHP Memory Tracking** - Monitor PHP memory usage and limits
- **Multi-drive Support** - Track disk usage across all drives

### 🔒 Security Features

- **CSRF Protection** - Secure token-based protection
- **Security Headers** - Comprehensive HTTP security headers
- **Rate Limiting** - Prevent abuse and brute force attacks
- **Input Sanitization** - XSS and injection protection
- **Secure Sessions** - HTTPOnly and secure cookie settings
- **Content Security Policy** - Advanced CSP implementation

### ⚡ Performance & Monitoring

- **Caching System** - File-based caching with TTL support
- **Performance Monitoring** - Execution time and memory tracking
- **Comprehensive Logging** - Multi-level logging system
- **Error Handling** - Graceful error management
- **Database Integration** - PDO-based database helpers

### 🗄️ Database Management

- **Database Browser** - Browse all databases and view sizes
- **Table Explorer** - List tables with row counts and sizes
- **Table Structure** - View column details, types, keys, and constraints
- **Query Runner** - Execute SELECT queries safely
- **Real-time Information** - Live database statistics

### 🔧 Services Management

- **Service Control** - Start, stop, and restart services (Apache, MySQL, Nginx, Redis, Memcached)
- **Status Monitoring** - Real-time service status display
- **Port Monitor** - View all listening ports on your system
- **Service Health** - Quick overview of all Laragon services

### 📋 Log Viewer

- **Multi-Log Support** - View Apache, PHP, MySQL, and Dashboard logs
- **Configurable Display** - Adjust number of lines to display
- **Log Management** - Clear log files with one click
- **Auto-Detection** - Automatically finds available log files
- **Terminal-Style Display** - Easy-to-read log format

### 🛠️ Quick Tools

- **Cache Management** - Clear application and framework caches
- **Database Optimization** - Optimize all tables in a database
- **Project Actions**:
  - Git status check
  - Composer install/update commands
  - NPM install/update commands
- **PHP Info** - Quick access to PHP configuration
- **Project Selector** - Choose projects for quick actions

### 🌍 Multi-language Support

- English, German, Spanish, French, Indonesian, Portuguese, Tagalog
- Easy language switching
- Consistent translation system

## 🛠️ Installation

### Prerequisites

- **Laragon** development environment
- **PHP 7.4+** with required extensions:
  - `json`
  - `mbstring`
  - `openssl`
  - `pdo_mysql`
- **MySQL/MariaDB** server
- **Web server** (Apache/Nginx)

### Quick Setup

1. **Clone or Download**

   ```bash
   git clone https://github.com/LebToki/Laragon-Dashboard.git
   # or download and extract to your Laragon www directory
   ```

2. **Configure Environment**

   ```bash
   # Copy and modify configuration
   cp config.php config.local.php
   # Edit config.local.php with your settings
   ```

3. **Set Permissions**

   ```bash
   # Create required directories
   mkdir -p logs cache
   chmod 755 logs cache
   ```

4. **Access Dashboard**

   ```
   http://localhost/Laragon-Dashboard/
   ```

### Configuration

Edit `config.php` to customize your setup:

```php
// Database Configuration
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');

// Application Settings
define('APP_NAME', 'Laragon Dashboard');
define('APP_VERSION', '2.5.1');
define('APP_DEBUG', false);

// Security Settings
define('SESSION_TIMEOUT', 3600);
define('MAX_LOGIN_ATTEMPTS', 5);

// Email Configuration
define('SENDMAIL_OUTPUT_DIR', 'C:/laragon/bin/sendmail/output/');
define('DOMAIN_SUFFIX', '.local');
```

## 📁 Project Structure

```
Laragon-Dashboard/
├── assets/
│   ├── languages/          # Translation files
│   ├── inbox/             # Email client interface
│   ├── favicon/           # Favicon files
│   └── style.css          # Main stylesheet
├── includes/              # Helper classes
│   ├── logger.php         # Logging system
│   ├── security.php       # Security helpers
│   ├── database.php       # Database utilities
│   └── cache.php          # Caching system
├── logs/                  # Application logs
├── cache/                 # Cache files
├── config.php             # Main configuration
├── index.php              # Main dashboard
├── server_vitals.php      # Server monitoring API
├── project_search.php     # Project search API
├── database_manager.php   # Database management API
├── services_manager.php   # Services control API
├── log_viewer.php         # Log viewing API
├── quick_tools.php        # Quick tools API
├── CHANGELOG.md           # Version history
├── .gitignore             # Git ignore rules
└── README.md              # This file
```

## 🎯 Usage

### Dashboard Overview

The main dashboard provides:

- **Server Information** - PHP version, MySQL status, web server details
- **Project Management** - List and manage your development projects
- **Framework Detection** - Automatic detection of WordPress, Laravel, Drupal, etc.
- **Quick Access** - Direct links to project admin panels

### Email Management

Access the email client via the "Mailbox" tab:

- **View Statistics** - Total emails, daily/weekly counts, unique senders
- **Search & Filter** - Find emails quickly with advanced search
- **Read Emails** - Click any email to view full content
- **Manage Emails** - Delete individual or bulk emails
- **Export Options** - Download email data

### Server Monitoring

Monitor your server via the "Server Vitals" tab:

- **Real-time Charts** - Visual representation of system metrics
- **Memory Usage** - Track PHP and system memory consumption
- **Disk Space** - Monitor disk usage across all drives
- **Performance Metrics** - Page load times and execution statistics

### Database Management

Access database tools via the "Databases" tab:

- **Browse Databases** - View all available databases and their sizes
- **Explore Tables** - See table structures, row counts, and sizes
- **Run Queries** - Execute SELECT queries safely (read-only)
- **View Structure** - Inspect table columns, types, keys, and constraints

### Services Management

Control Laragon services via the "Services" tab:

- **Service Control** - Start, stop, or restart Apache, MySQL, Nginx, Redis, Memcached
- **Status Monitoring** - See real-time status of all services
- **Port Monitor** - View all listening ports on your system
- **Quick Actions** - One-click service management

### Log Viewer

View logs via the "Logs" tab:

- **Multiple Log Types** - Access Apache, PHP, MySQL, and Dashboard logs
- **Configurable Display** - Choose how many lines to show (10-1000)
- **Log Management** - Clear log files when needed
- **Easy Navigation** - Terminal-style display for better readability

### Quick Tools

Access developer tools via the "Tools" tab:

- **Cache Management** - Clear application and framework caches
- **Database Optimization** - Optimize database tables for better performance
- **Git Integration** - Check Git status for your projects
- **Package Management** - Run Composer and NPM commands
- **System Info** - Quick access to PHP configuration

## 🔧 API Endpoints

### Server Vitals API

```
GET /server_vitals.php
```

Returns JSON with server statistics:

```json
{
  "uptime": "2 days, 5 hours, 30 minutes",
  "memoryUsage": "45.2%",
  "diskUsage": [...],
  "phpMemory": {
    "current": 2097152,
    "peak": 4194304,
    "limit": "512M"
  }
}
```

### Project Search API

```
GET /project_search.php?q=search_term
```

Returns filtered project list based on search query.

### Database Manager API

```
GET /database_manager.php?action=list_databases
GET /database_manager.php?action=get_tables&database=dbname
GET /database_manager.php?action=get_table_structure&database=dbname&table=tablename
GET /database_manager.php?action=get_database_size&database=dbname
POST /database_manager.php?action=execute_query
```

Returns database information and query results (read-only queries only).

### Services Manager API

```
GET /services_manager.php?action=status
GET /services_manager.php?action=start&service=Apache
GET /services_manager.php?action=stop&service=MySQL
GET /services_manager.php?action=restart&service=Nginx
GET /services_manager.php?action=get_ports
```

Returns service status and port information.

### Log Viewer API

```
GET /log_viewer.php?action=list_logs
GET /log_viewer.php?action=read_log&path=logpath&lines=100
GET /log_viewer.php?action=clear_log&path=logpath
```

Returns log file information and content.

### Quick Tools API

```
POST /quick_tools.php (action: clear_cache)
POST /quick_tools.php (action: optimize_database, database: dbname)
POST /quick_tools.php (action: composer_command, project_path: path, command: install)
POST /quick_tools.php (action: npm_command, project_path: path, command: install)
POST /quick_tools.php (action: git_status, project_path: path)
GET /quick_tools.php?action=php_info
```

Executes various developer tools and returns results.

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

Add new languages by creating JSON files in `assets/languages/`:

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

### Common Issues

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

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laragon Team** - For the excellent development environment
- **Bootstrap Team** - For the amazing CSS framework
- **Chart.js Team** - For the beautiful charting library
- **Contributors** - All the amazing people who contributed to this project

## 📞 Support

- **Documentation** - Check this README and inline comments
- **Issues** - Report bugs via GitHub Issues
- **Discussions** - Join our GitHub Discussions
- **Email** - Contact the maintainer

## 🔄 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed version history.

---

**Made with ❤️ for the Laragon community**
