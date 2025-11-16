# Release Notes - Version 3.1.2

**Release Date:** November, 16 2025  
**Version:** 3.1.2  
**Status:** Stable Release

---

## 🎨 Major UI/UX Improvements

### Icon Visibility Fixes
- **Fixed Server Status Icons**: All server status card icons (Apache, PHP, MySQL, OpenSSL, PHP SAPI, Document Root, PHPMyAdmin) now use solid colored backgrounds instead of semi-transparent white, making them fully visible
- **Fixed Project Card Icons**: Project icons in both the dashboard (`index.php`) and projects page (`pages/projects.php`) now use solid colored backgrounds for better visibility
- **Consistent Icon Styling**: All icons now have explicit `font-size: 24px` for consistent rendering across all browsers

### Platform Detection Enhancements
- **Improved "Other" Platform Detection**: Projects are now better categorized instead of showing as "Other"
  - **PHP Detection**: Automatically detects projects with `.php` files
  - **Python Detection**: Detects Python projects via `.py` files (app.py, main.py, manage.py) or requirements.txt
  - **HTML5 Detection**: Detects static HTML5 sites via `.html` files or `index.html`
- **Detection Priority**: PHP → Python → HTML5 → Other frameworks → Other

---

## 🐛 Bug Fixes

### Debug Banner
- **Debug Banner Disabled by Default**: The debug banner is now completely disabled by default and will not appear unless explicitly enabled via Preferences
- **Improved Debug Banner Logic**: Enhanced the debug banner check in `layoutTop.php` to properly respect user preferences first, then fall back to `APP_DEBUG` constant
- **Documentation Updated**: README.md now clearly states that the debug banner is disabled by default and only shows when troubleshooting

---

## ✨ New Features

### Project Management
- **3-Dot Dropdown Menu**: Added a 3-dot dropdown menu to project cards for quick actions (Ignore Project)
- **Smart WP Admin Button**: WP Admin button now only displays for WordPress projects and automatically hides for non-WordPress projects
- **Project Actions**: Improved project card layout with better button styling and positioning

### Navigation & Display
- **Time-Based Greeting**: Dynamic greeting in navbar (Good morning/afternoon/evening) based on time of day
- **Local Time & Date Display**: Real-time clock and date display in navbar with user-configurable formats (12hr/24hr, various date formats)
- **Auto-Detection**: Time and date formats auto-detect from system locale

---

## 📝 Documentation Updates

- **README.md Enhancements**: 
  - Added comprehensive Configuration section with debug banner notes
  - Added time/date format configuration instructions
  - Added 2TInteractive promotional section for professional services
  - Updated changelog with all new features and improvements
  - Clear documentation that debug banner is disabled by default

---

## 🔧 Technical Improvements

### Code Quality
- **Icon Styling Consistency**: Standardized icon container backgrounds across all views
- **Platform Detection Logic**: Improved platform detection algorithm for better accuracy
- **Debug Banner Control**: Enhanced debug banner visibility control with proper preference checking

### File Changes
- **Modified Files**: 
  - `index.php` - Fixed server and project icon visibility
  - `pages/projects.php` - Fixed project icon visibility
  - `includes/helpers.php` - Improved platform detection (PHP, Python, HTML5)
  - `partials/layouts/layoutTop.php` - Enhanced debug banner control
  - `config.php` - Version bump to 3.1.2
  - `README.md` - Comprehensive documentation updates

---

## 🎯 User Experience Improvements

1. **Better Visual Feedback**: All icons are now clearly visible with proper contrast
2. **Smarter Platform Detection**: Projects are automatically categorized more accurately
3. **Cleaner Interface**: Debug banner no longer appears by default, providing a cleaner user experience
4. **Enhanced Navigation**: Time-based greeting and clock provide better context awareness
5. **Improved Project Management**: Better tools for managing and organizing projects

---

## 📦 Installation & Upgrade

### For New Installations
1. Download the latest release from GitHub
2. Extract to your Laragon `www` directory
3. Access via `http://localhost/Laragon-Dashboard/`

### For Upgrades
1. Backup your current installation (especially `data/preferences.json`)
2. Replace files with the new version
3. Clear browser cache if experiencing any issues
4. The debug banner will remain disabled unless you explicitly enable it in Preferences

---

## 🔒 Security & Stability

- No security vulnerabilities addressed in this release
- All existing security measures remain intact
- Improved code stability with better error handling

---

## 🙏 Acknowledgments

Thank you to all users who reported icon visibility issues and provided feedback. Your contributions help make Laragon Dashboard better for everyone!

**⭐ Star Us on GitHub!**

Lots of love have been poured into this project for the community. If you find Laragon Dashboard useful, please consider leaving a ⭐ star on [GitHub](https://github.com/LebToki/Laragon-Dashboard) - it helps us reach more developers and continue improving the project!

---

## 📞 Support

- **GitHub Issues**: [Report bugs](https://github.com/LebToki/Laragon-Dashboard/issues)
- **GitHub Discussions**: [Get help](https://github.com/LebToki/Laragon-Dashboard/discussions)
- **Professional Services**: [2TInteractive](https://2tinteractive.com) - Custom development and premium solutions

---

## 🔄 What's Next

Future improvements planned:
- Terminal integration (PowerShell)
- Enhanced i18n coverage
- Additional platform detection improvements
- Performance optimizations

---

**Made with ❤️ for the Laragon community**

**Author**: Tarek Tarabichi | **Company**: 2TInteractive | **Website**: https://2tinteractive.com

