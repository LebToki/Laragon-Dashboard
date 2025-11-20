# Laragon Dashboard - Release Notes v3.1.5

**Release Date:** December 2024  
**Version:** 3.1.5  
**Author:** Tarek Tarabichi (2TInteractive)

---

## 🎉 What's New

### Enhanced Auto-Update System
This release includes comprehensive improvements to the auto-update mechanism, making it more reliable, robust, and easier to debug.

---

## 🔧 Technical Improvements

### UpdateManager Enhancements (v1.1.0)

#### Better Version Detection
- **Smart Version Detection**: Now uses `getAppVersion()` function instead of hardcoded constant
- **Git Integration**: Automatically detects version from Git tags or commit hashes
- **Dev Version Handling**: Skips update checks for development versions (dev-*)
- **Version Normalization**: Improved version comparison logic handles various version formats

#### Enhanced Error Handling & Logging
- **Comprehensive Logging**: Added detailed error logging throughout the update process
- **Better Error Messages**: More descriptive error messages with context
- **Validation**: Improved validation of paths, files, and operations before execution
- **Exception Handling**: Enhanced exception handling in all update methods

#### Improved Backup & Restore
- **Fixed Backup Path Flow**: Backup path now correctly passed through all update steps
- **Backup Validation**: Ensures backup exists before proceeding with installation
- **Rollback Improvements**: Better rollback mechanism with detailed file restoration tracking
- **Manifest Validation**: Improved backup manifest validation and error reporting

#### Download & Installation
- **Download Validation**: Validates download URL and file size after download
- **Better cURL Handling**: Improved cURL error handling with connection timeouts
- **File Replacement Tracking**: Tracks replaced, skipped, and error files during installation
- **Directory Detection**: Better detection of dashboard directory in extracted ZIP files

#### Verification & Safety
- **Critical File Checks**: Verifies critical files exist before completing update
- **Function Validation**: Checks that critical functions are available after update
- **Better Verification**: Enhanced installation verification with detailed error reporting

---

## 🐛 Bug Fixes

### Critical Fixes
- **Fixed**: Backup path not being passed correctly between update steps (JavaScript flow issue)
- **Fixed**: Version detection now properly uses Git-based version when available
- **Fixed**: Dev versions no longer trigger false update notifications

### Improvements
- **Improved**: Error messages now provide more context for debugging
- **Improved**: File operations now have better error handling and recovery
- **Improved**: Update process now validates all prerequisites before proceeding

---

## 📝 Technical Details

### Files Changed
- `config.php` - Version bump to 3.1.5
- `includes/UpdateManager.php` - Enhanced to v1.1.0 with comprehensive improvements
- `api/update.php` - Better error handling and validation
- `partials/scripts.php` - Fixed backup path flow, improved error UI

### UpdateManager v1.1.0 Changes
- Uses `getAppVersion()` for version detection
- Enhanced logging throughout all methods
- Better error handling and validation
- Improved file operations with error tracking
- Enhanced rollback mechanism
- Better GitHub API error handling

---

## 🚀 Upgrade Instructions

1. **Backup your current installation** (recommended, though auto-update creates backups)
2. **Pull the latest changes** from the repository
3. **Clear browser cache** to ensure new JavaScript loads
4. **Test update mechanism** - The improvements are backward compatible

### For Users Updating via Auto-Update
The enhanced update mechanism will:
- Create a backup automatically before updating
- Provide better error messages if something goes wrong
- Log detailed information for troubleshooting
- Verify installation after update completes

---

## 🔍 Testing Recommendations

If you want to test the update mechanism:
1. **Version Detection**: Verify it detects the correct version from Git/VERSION file
2. **Update Check**: Test with a newer release available
3. **Backup Creation**: Verify backup is created with manifest
4. **Download**: Test download with progress tracking
5. **Installation**: Test full install flow with file replacement
6. **Verification**: Ensure verification catches issues
7. **Rollback**: Test rollback if installation fails

---

## 📦 What's Improved

### Before (v3.1.4)
- Basic error handling
- Simple version detection
- Backup path flow issues
- Limited logging
- Basic verification

### After (v3.1.5)
- ✅ Comprehensive error handling with detailed logging
- ✅ Smart version detection (Git/VERSION file support)
- ✅ Fixed backup path flow
- ✅ Extensive logging for debugging
- ✅ Enhanced verification with critical file/function checks
- ✅ Better error messages and user feedback
- ✅ Improved rollback mechanism

---

## 🙏 Acknowledgments

Special thanks to the community for feedback on the update mechanism. These improvements make the auto-update system more reliable and easier to troubleshoot.

---

## 📞 Support

- **GitHub Issues**: [Report Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Documentation**: See `README.md`
- **Company**: [2TInteractive](https://2tinteractive.com)

---

**Made with ❤️ by [2TInteractive](https://2tinteractive.com)**

