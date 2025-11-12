# 🚀 Laragon Dashboard

A modern, feature-rich dashboard for Laragon development environment with advanced email management, server monitoring, and security features.

[![Version](https://img.shields.io/badge/version-2.6.0-blue.svg)](https://github.com/LebToki/Laragon-Dashboard)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-green.svg)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.2-purple.svg)](https://getbootstrap.com)
[![License](https://img.shields.io/badge/license-MIT-orange.svg)](LICENSE)

## 📦 Installation

1. **Download the latest release** from the [Releases page](https://github.com/LebToki/Laragon-Dashboard/releases)
2. **Extract the zip file** to your Laragon `www` directory:
   ```
   C:\laragon\www\Laragon-Dashboard\
   ```
3. **Access the dashboard** at:
   ```
   http://localhost/Laragon-Dashboard/
   ```

The installation structure:
```
Laragon-Dashboard/
├── index.php          # Root entry point (loads Laragon-Dashboard application)
└── Laragon-Dashboard/       # Main application folder
    ├── index.php      # Main dashboard application
    ├── config.php     # Configuration file
    ├── assets/        # CSS, images, languages
    ├── includes/      # Helper classes
    └── *.php          # API endpoints
```

## ✨ Features

### 🎨 Modern Email Client
- **Bootstrap 5 Interface** - Professional, responsive design
- **Interactive Statistics** - Real-time email metrics and analytics
- **Advanced Search** - Filter emails by sender, subject, or content
- **Email Cards** - Beautiful hover effects and smooth animations
- **Modal Viewer** - Enhanced email reading experience
- **Bulk Operations** - Mass email management capabilities

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

### ⚡ Performance & Monitoring
- **Caching System** - File-based caching with TTL support
- **Performance Monitoring** - Execution time and memory tracking
- **Comprehensive Logging** - Multi-level logging system

### 🛠️ Developer Tools
- **Database Management** - Browse databases, tables, and execute queries
- **Services Control** - Start, stop, and restart Laragon services
- **Log Viewer** - View and manage application logs
- **Bcrypt Generator** - Generate secure password hashes
- **Backup & Export** - Full project backup with database
- **Self-Update** - Automatic update mechanism with progress tracking

## 🔄 Self-Update Feature

The dashboard includes a built-in self-update mechanism:

1. Go to the **Tools** tab
2. Click **Check for Updates**
3. If an update is available, click **Download & Install Update**
4. The system will automatically:
   - Download the update
   - Create a backup
   - Install the update
   - Clean up temporary files

## 📖 Documentation

For detailed documentation, see the [README in Laragon-Dashboard folder](Laragon-Dashboard/README.md).

## 🛡️ Security

### Security Features
- **CSRF Protection** - All forms protected with CSRF tokens
- **XSS Prevention** - All user inputs sanitized
- **SQL Injection Protection** - Prepared statements used throughout
- **Rate Limiting** - Prevents brute force attacks
- **Secure Headers** - Comprehensive HTTP security headers

## 🎨 Customization

### Configuration
Edit `Laragon-Dashboard/config.php` to customize:
- Database connection settings
- Email directory paths
- Security settings
- Application preferences

### Language Support
The dashboard supports multiple languages. Language files are located in:
```
Laragon-Dashboard/assets/languages/
```

## 🐛 Troubleshooting

### Common Issues

**Dashboard not loading:**
- Ensure PHP 7.4+ is installed
- Check file permissions
- Verify Laragon-Dashboard folder exists

**Database connection issues:**
- Verify MySQL credentials in `Laragon-Dashboard/config.php`
- Ensure MySQL service is running
- Check firewall settings

**Update mechanism not working:**
- Verify internet connection
- Check GitHub API access
- Ensure write permissions on Laragon-Dashboard folder

## 📈 Performance

### Optimization Features
- **File-based Caching** - Reduces database queries
- **Lazy Loading** - Loads content as needed
- **Minified Assets** - Optimized CSS and JavaScript
- **Database Connection Pooling** - Efficient database usage

## 🤝 Contributing

We welcome contributions! Please see our [Contributing Guidelines](.github/CONTRIBUTING.md) for details.

### Development Setup
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- **Laragon Team** - For the excellent development environment
- **Bootstrap Team** - For the amazing CSS framework
- **Chart.js Team** - For the beautiful charting library
- **Contributors** - All the amazing people who contributed to this project

## 📞 Support

- **Documentation** - Check the README files and inline comments
- **Issues** - Report bugs via [GitHub Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Discussions** - Join our [GitHub Discussions](https://github.com/LebToki/Laragon-Dashboard/discussions)

## 🔄 Changelog

See [CHANGELOG.md](Laragon-Dashboard/CHANGELOG.md) for detailed version history.

---

**Made with ❤️ for the Laragon community**

## 📊 Project Structure

```
Laragon-Dashboard/
├── index.php                    # Root entry point
├── README.md                    # This file
├── LICENSE                      # License file
└── Laragon-Dashboard/                 # Main application
    ├── index.php               # Main dashboard
    ├── config.php              # Configuration
    ├── README.md               # Detailed documentation
    ├── CHANGELOG.md            # Version history
    ├── assets/                 # Static assets
    │   ├── css/               # Stylesheets
    │   ├── images/            # Images
    │   └── languages/         # Language files
    ├── includes/              # Helper classes
    │   ├── database.php       # Database helper
    │   ├── security.php       # Security helper
    │   ├── logger.php         # Logging helper
    │   └── cache.php          # Cache helper
    ├── database_manager.php   # Database API
    ├── server_vitals.php      # Server monitoring API
    ├── services_manager.php   # Services control API
    ├── log_viewer.php         # Log viewing API
    ├── quick_tools.php        # Quick tools API
    ├── bcrypt_generator.php   # Bcrypt generator API
    ├── backup_manager.php     # Backup manager API
    └── update_manager.php     # Self-update API
```

## 🚀 Quick Start

1. **Install** - Extract to `C:\laragon\www\Laragon-Dashboard\`
2. **Configure** - Edit `Laragon-Dashboard/config.php` if needed
3. **Access** - Open `http://localhost/Laragon-Dashboard/`
4. **Enjoy** - Start managing your Laragon environment!

---

**Version:** 2.6.0  
**Last Updated:** 2025-01-XX  
**Repository:** [https://github.com/LebToki/Laragon-Dashboard](https://github.com/LebToki/Laragon-Dashboard)

