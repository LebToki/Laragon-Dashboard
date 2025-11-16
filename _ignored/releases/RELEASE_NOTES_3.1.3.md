# Laragon Dashboard - Release Notes v3.1.3

**Release Date:** December 2024  
**Version:** 3.1.3  
**Author:** Tarek Tarabichi (2TInteractive)

---

## 🎉 What's New

### Enhanced HTTPS Detection
- **Smart Protocol Detection**: The dashboard now automatically detects if your Laragon setup uses HTTPS and applies it to all project URLs
- **Multiple Detection Methods**: 
  - Checks if dashboard is accessed via HTTPS
  - Verifies Laragon SSL configuration
  - Detects port 443 usage
  - Supports `FORCE_HTTPS` config override
- **Config Override**: Add `define('FORCE_HTTPS', true);` to `config.php` to force HTTPS for all projects

### Project Cleanup & Organization
- **New `_ignored` Directory**: Organized structure for releases, responses, and test files
- **Root Directory Cleanup**: Moved diagnostic tools, test files, and release notes to `_ignored/`
- **Better File Organization**: Cleaner project root for easier navigation

---

## 🐛 Bug Fixes

### HTTP/HTTPS Protocol Issues
- **Fixed**: Project URLs now correctly use HTTPS when Laragon is configured for SSL
- **Fixed**: Automatic protocol detection based on current request
- **Fixed**: Improved fallback detection when Laragon config is unclear

---

## 🔧 Technical Improvements

### Code Quality
- Enhanced protocol detection logic in `includes/helpers.php`
- Added `FORCE_HTTPS` configuration option
- Improved error handling for SSL detection

### File Organization
- Created `_ignored/` directory structure:
  - `_ignored/releases/` - Release notes and version history
  - `_ignored/responses/` - Community responses and discussions
  - `_ignored/tests/` - Test and diagnostic files
- Moved diagnostic tools and test files out of root directory

---

## 📝 Configuration

### New Config Option

**Force HTTPS for Projects:**
```php
// In config.php, add:
define('FORCE_HTTPS', true);
```

Or set via environment variable:
```bash
FORCE_HTTPS=true
```

---

## 🚀 Upgrade Instructions

1. **Backup your current installation** (recommended)
2. **Pull the latest changes** from the repository
3. **Clear browser cache** to ensure new assets load
4. **Test project links** - they should now use HTTPS if your Laragon is configured for SSL

### For HTTPS Issues:
If projects still open with HTTP instead of HTTPS:
1. Check if you're accessing the dashboard via HTTPS
2. Verify Laragon's SSL configuration in `laragon.ini`
3. Add `define('FORCE_HTTPS', true);` to `config.php` if needed

---

## 🙏 Acknowledgments

Special thanks to **Rick M** from New Zealand for reporting the HTTP/HTTPS protocol detection issue and providing valuable feedback!

---

## 📦 Files Changed

- `config.php` - Added `FORCE_HTTPS` configuration option, version bump
- `includes/helpers.php` - Enhanced HTTPS detection logic
- Root directory cleanup - moved test/diagnostic files to `_ignored/`

---

## 🔮 What's Next

- Terminal integration (PowerShell) - Coming soon
- Additional platform detection improvements
- Enhanced tunneling features

---

## 📞 Support

- **GitHub Issues**: [Report Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Documentation**: See `README.md`
- **Company**: [2TInteractive](https://2tinteractive.com)

---

**Made with ❤️ by [2TInteractive](https://2tinteractive.com)**

