# Laragon Dashboard - Release Notes v3.1.4

**Release Date:** December 2024  
**Version:** 3.1.4  
**Author:** Tarek Tarabichi (2TInteractive)

---

## 🎉 What's New

### Preferences System Improvements
- **Fixed Checkbox Unsetting**: All checkbox preferences can now be properly disabled after being enabled
- **Enhanced Form Handling**: JavaScript now explicitly includes all checkbox fields in form submissions, even when unchecked
- **Better State Management**: Checkbox states (checked/unchecked) are now correctly persisted to preferences

---

## 🐛 Bug Fixes

### Critical Preference Bug Fixed
- **Fixed**: Issue #37 - Checkbox settings in Preferences (like "Show Debug Banner") can now be properly unset
- **Fixed**: All checkbox preferences (`debug_banner`, `auto_update_check`, `auto_update_install`) now correctly save their unchecked state
- **Fixed**: Previously, once a checkbox was checked and saved, it couldn't be unchecked - this is now resolved

### Root Cause
The issue was that unchecked checkboxes don't appear in HTML FormData, so they weren't being sent to the API. The API only processed fields that were present in the request, causing old values to persist when trying to unset them.

---

## 🔧 Technical Improvements

### JavaScript Enhancements
- **Enhanced Form Submission**: Modified `partials/scripts.php` to explicitly include all checkbox fields
- **Unchecked State Handling**: Unchecked checkboxes now send `'0'` value to the API
- **Complete Field Coverage**: All checkbox fields are now guaranteed to be included in form submissions

### API Improvements
- **Better Checkbox Processing**: Updated `api/preferences.php` to handle checkbox unsetting
- **Explicit False Handling**: API now correctly processes `false` and `'0'` values for checkboxes
- **Debug Banner Support**: Added `debug_banner` preference handling (previously blocked from saving)

### Configuration Updates
- **Preference Storage**: Updated `config.php` to allow `false` values for checkboxes in preferences
- **Default Values**: Added `debug_banner` to default preferences with `false` as default
- **Filter Logic**: Improved preference filtering to preserve `false` values for explicit unsetting

### Security Improvements
- **Gitignore Update**: Added `data/preferences.json` to `.gitignore` to protect sensitive user data (passwords, MySQL credentials)

---

## 📝 Technical Details

### Files Changed
- `partials/scripts.php` - Enhanced form submission to include unchecked checkboxes
- `api/preferences.php` - Added `debug_banner` handling and improved checkbox processing
- `config.php` - Updated `saveDashboardPreferences()` to preserve `false` values, added `debug_banner` to defaults
- `.gitignore` - Added `data/preferences.json` to protect sensitive data
- `README.md` - Updated version to 3.1.4, added changelog entry

### How It Works Now
1. **When Checkbox is Checked**: JavaScript sends `'1'`, API converts to `true`, saved to preferences
2. **When Checkbox is Unchecked**: JavaScript sends `'0'`, API converts to `false`, saved to preferences (overwrites previous value)

---

## 🚀 Upgrade Instructions

1. **Backup your current installation** (recommended)
2. **Pull the latest changes** from the repository
3. **Clear browser cache** to ensure new JavaScript loads
4. **Test preferences** - try checking and unchecking any checkbox setting to verify it works

### For Existing Users
- Your existing preferences will be preserved
- The fix is backward compatible - no migration needed
- You can now freely toggle checkbox settings on and off

---

## 🙏 Acknowledgments

Special thanks to **Rick M (RAMINCNZ)** from New Zealand for reporting issue #37 and providing detailed feedback about the checkbox unsetting problem!

---

## 📦 Files Changed

- `partials/scripts.php` - Enhanced checkbox form submission
- `api/preferences.php` - Improved checkbox handling, added debug_banner support
- `config.php` - Version bump to 3.1.4, updated preference storage logic
- `.gitignore` - Added data/preferences.json exclusion
- `README.md` - Updated version and changelog

---

## 🔮 What's Next

- Terminal integration (PowerShell) - Coming soon
- Additional preference improvements
- Enhanced user experience features

---

## 📞 Support

- **GitHub Issues**: [Report Issues](https://github.com/LebToki/Laragon-Dashboard/issues)
- **Documentation**: See `README.md`
- **Company**: [2TInteractive](https://2tinteractive.com)

---

**Made with ❤️ by [2TInteractive](https://2tinteractive.com)**

