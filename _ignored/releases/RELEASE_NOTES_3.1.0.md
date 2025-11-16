# Release Notes - Version 3.1.0

## 🎉 Major Release - CSS Loading & Path Detection Fixes

This release addresses critical CSS loading issues and improves path detection for custom Laragon installations. We're grateful to our community for reporting these issues!

---

## 🙏 Special Thanks

We'd like to extend our heartfelt thanks to the community members who reported these issues:

- **Issue #35**: CSS not loading - Thank you for your detailed report and patience!
- **Discussion #36**: RAMINCNZ - Thank you for reporting the 404 error and providing your `laragon.ini` configuration, which helped us identify and fix path detection issues for custom installations!

Your feedback is invaluable in making Laragon Dashboard better for everyone. 🚀

---

## ✨ What's New

### 🔧 CSS Compilation & Loading
- **Compiled SCSS to CSS**: The `style.css` file (301KB) is now properly compiled from SCSS source
- **Router for PHP Built-in Server**: Added `router.php` to properly serve static files (CSS, JS, images) when using PHP's built-in development server
- **Path Variations Handling**: Router now handles common CSS path variations (e.g., `/assets/styles.css` → `/assets/css/style.css`)
- **Favicon Handling**: Fixed 404 errors for `/favicon.ico` requests

### 🛠️ Path Detection Improvements
- **Enhanced Laragon Detection**: Improved detection for custom Laragon installations
  - Better handling of `D:\Laragon` and `D:\Dev_Sites` setups
  - Case-insensitive path checks
  - Improved document root detection
- **PHP Built-in Server Support**: Fixed `BASE_URL` and `ASSETS_URL` calculation when dashboard is the document root
- **Debug Banner**: Added comprehensive debug banner (when `APP_DEBUG` is enabled) showing:
  - Server type detection
  - Path information (BASE_URL, ASSETS_URL, DOCUMENT_ROOT, APP_ROOT)
  - CSS file status
  - Service Worker status
  - Cache information

### 📁 File Structure
- **Router Script**: New `router.php` for PHP built-in server support
- **Debug Tools**: Enhanced diagnostic tools for troubleshooting

---

## 🐛 Bug Fixes

### CSS Loading Issues
- ✅ Fixed empty `style.css` file (now properly compiled from SCSS)
- ✅ Fixed CSS not loading on port 8080 (PHP built-in server)
- ✅ Fixed CSS path resolution for custom document roots
- ✅ Fixed favicon 404 errors
- ✅ Fixed `assets/styles.css` path variations

### Path Detection
- ✅ Fixed 404 errors for users with custom Laragon paths (`D:\Laragon`, `D:\Dev_Sites`)
- ✅ Improved BASE_URL calculation for different server configurations
- ✅ Fixed ASSETS_URL for PHP built-in server
- ✅ Better handling of case-insensitive paths on Windows

### Service Worker
- ✅ Improved cache handling to prevent caching 404s and redirects
- ✅ Better cache clearing mechanism
- ✅ Prevented caching of problematic responses

---

## 📝 Technical Details

### New Files
- `router.php` - Router script for PHP built-in development server
- `partials/debug_banner.php` - Debug banner for troubleshooting
- `SETUP_PORT_8080.md` - Instructions for setting up on port 8080

### Updated Files
- `config.php` - Enhanced path detection and BASE_URL/ASSETS_URL calculation
- `assets/css/style.css` - Compiled from SCSS (301KB, 14,221 lines)
- `sw.js` - Improved caching logic
- `.htaccess` - Better URL rewriting and asset exclusion

---

## 🚀 Installation & Upgrade

### For New Installations
1. Download the latest release
2. Extract to your Laragon `www` directory
3. Follow the setup instructions in `README.md`

### For Existing Installations
1. Backup your current installation
2. Pull the latest changes or download the new release
3. Clear browser cache and Service Worker cache
4. Refresh the dashboard

### Testing on Port 8080
If you want to test on port 8080, see `SETUP_PORT_8080.md` for detailed instructions.

---

## 🔍 Debugging

If you encounter any issues:

1. **Enable Debug Mode**: Set `APP_DEBUG` to `true` in `config.php`
2. **Check Debug Banner**: The debug banner will show path information and CSS file status
3. **Use Diagnostic Tool**: Access `diagnostic.php` for comprehensive system information
4. **Check Browser Console**: Look for any 404 errors or loading issues

---

## 📚 Documentation

- **README.md** - Updated with version 3.1.0 information
- **SETUP_PORT_8080.md** - Instructions for port 8080 setup
- **Diagnostic Tool** - Available at `/diagnostic.php`

---

## 🎯 Next Steps

We're continuously improving Laragon Dashboard based on community feedback. If you encounter any issues or have suggestions, please:

- Open an issue on GitHub
- Start a discussion
- Contribute via pull requests

---

## 📦 Version Information

- **Version**: 3.1.0
- **Release Date**: November 2025
- **PHP Requirement**: 7.4+
- **Compatibility**: Laragon 8.3.0+

---

Thank you for using Laragon Dashboard! 🎉

