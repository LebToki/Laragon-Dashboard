# 🚀 Laragon Dashboard 3.0.0

A modern, feature-rich web dashboard for managing Laragon development environment. Version 3.0.0 aims to be a comprehensive MAMP competitor for Windows.

[![Version](https://img.shields.io/badge/version-3.0.0-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

## 📋 Project Information

- **Author**: Tarek Tarabichi
- **Company**: [2TInteractive](https://2tinteractive.com)
- **Project Start**: Early 2024
- **GitHub**: https://github.com/LebToki/Laragon-Dashboard
- **Version**: 3.0.0 (in development)

## ✨ Features

### 🔧 Service Management
- Start, stop, and restart services (Apache, MySQL, Nginx, Redis, Memcached, MongoDB, PostgreSQL, Mailpit)
- Real-time service status monitoring
- Port management and monitoring
- Service version detection

### 🌐 Virtual Hosts Management (New in 3.0.0)
- Create, edit, and delete virtual hosts
- SSL certificate management
- Apache/Nginx configuration editor
- Hosts file management
- Domain suffix configuration

### 📁 Project Management
- List and manage development projects
- Automatic framework detection (WordPress, Laravel, Drupal, etc.)
- Quick access links to project admin panels
- Project search and filtering

### 🗄️ Database Management
- Browse all databases and view sizes
- Explore tables with row counts and sizes
- View table structure (columns, types, keys, constraints)
- Execute SELECT queries safely (read-only)
- Database optimization

### 📧 Email Management (Mailpit)
- View emails from Laragon's sendmail output
- Email statistics (total, daily, weekly, unique senders)
- Search and filter emails
- Read email content
- Delete emails (individual and bulk)

### 📊 Server Monitoring
- Real-time system vitals (CPU, memory, disk)
- PHP memory usage tracking
- Multi-drive disk usage monitoring
- Visual charts and metrics
- Performance monitoring

### 📋 Log Viewer
- View Apache, PHP, MySQL, and Dashboard logs
- Configurable line count (10-1000)
- Clear log files
- Terminal-style display

### 🛠️ Quick Tools
- Cache management (application and framework caches)
- Database optimization
- Git status check
- Composer commands (install, update, dump-autoload, clear-cache)
- NPM commands (install, update, run build/dev/prod)
- PHP info viewer

### ⚙️ Laragon Preferences (New in 3.0.0)
- Visual preference editor
- Real-time preference updates
- Auto-start configuration
- Document root management

### 💾 Backup & Export
- Full project backup with database
- Configurable backup options
- Recent backups list
- Download backups

## 🛠️ Installation

### Prerequisites

- **Laragon** development environment (Windows)
- **PHP 7.4+** with required extensions:
  - `json`
  - `mbstring`
  - `openssl`
  - `pdo_mysql`
- **MySQL/MariaDB** server
- **Web server** (Apache/Nginx)

### Quick Setup

1. **Clone or download** the repository
   ```bash
   git clone https://github.com/LebToki/Laragon-Dashboard.git
   cd Laragon-Dashboard
   ```

2. **Place in Laragon www directory**
   ```
   C:\laragon\www\Laragon-Dashboard\
   ```

3. **Access Dashboard**
   ```
   http://localhost/Laragon-Dashboard/
   ```

### Configuration

Edit `config.php` to customize your setup:

```php
// Application Settings
define('APP_DEBUG', false); // Set to false in production
define('APP_ENV', 'production');

// MySQL Configuration (auto-detected from Laragon)
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASSWORD', '');
```

## 📁 Project Structure

```
Laragon-Dashboard/
├── template/              # Template files (fully bootstrapped)
│   ├── partials/         # Layout partials
│   ├── assets/           # CSS, JS, images
│   └── *.php            # Page templates
├── assets/               # Application assets
│   ├── languages/        # Translation files
│   └── style.css        # Custom styles
├── includes/             # Helper classes
│   ├── logger.php       # Logging system
│   ├── security.php     # Security helpers
│   ├── database.php     # Database utilities
│   └── cache.php        # Caching system
├── config.php           # Main configuration
├── index.php            # Main dashboard entry point
├── services_manager.php  # Services API
├── database_manager.php # Database API
├── server_vitals.php    # Server monitoring API
├── log_viewer.php      # Log viewer API
├── quick_tools.php     # Quick tools API
├── backup_manager.php  # Backup API
└── README.md           # This file
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
- Start, stop, or restart services
- View real-time status
- Monitor ports
- Quick service actions

### Virtual Hosts (3.0.0)

Manage virtual hosts via the "Virtual Hosts" tab:
- Create new virtual hosts
- Edit existing configurations
- Manage SSL certificates
- Configure domain suffixes

## 🔧 API Endpoints

All APIs return JSON responses. See [KNOWLEDGE_BASE.md](KNOWLEDGE_BASE.md) for detailed API documentation.

## 🛡️ Security

- **CSRF Protection** - All forms protected with CSRF tokens
- **XSS Prevention** - All user inputs sanitized
- **SQL Injection Protection** - Prepared statements used throughout
- **Rate Limiting** - Prevents brute force attacks
- **Secure Headers** - Comprehensive HTTP security headers

## 🎨 Customization

The dashboard uses a modern template system with:
- Responsive design
- Theme support (light/dark)
- Customizable components
- Multi-language support

## 🐛 Troubleshooting

### Common Issues

**Services not starting:**
- Ensure Laragon is running
- Check service permissions
- Verify Laragon installation path

**Database connection issues:**
- Verify MySQL credentials in config.php
- Ensure MySQL service is running
- Check firewall settings

**Virtual hosts not working:**
- Check Apache/Nginx configuration
- Verify hosts file permissions
- Check domain suffix configuration

## 📈 Roadmap

See [ROADMAP_3.0.md](ROADMAP_3.0.md) for detailed version 3.0.0 roadmap and future plans.

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](CONTRIBUTING.md) for details.

### Development Setup

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laragon Team** - For the excellent development environment
- **Contributors** - All the amazing people who contributed to this project

## 📞 Support

- **Documentation** - Check this README and [KNOWLEDGE_BASE.md](KNOWLEDGE_BASE.md)
- **Issues** - Report bugs via [GitHub Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Discussions** - Join our [GitHub Discussions](https://github.com/LebToki/Laragon-Dashboard/discussions)

---

**Made with ❤️ by [2TInteractive](https://2tinteractive.com)**

**Version 3.0.0 - Building the future of Laragon management**

