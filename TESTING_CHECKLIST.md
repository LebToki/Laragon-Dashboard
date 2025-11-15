# Laragon Dashboard - Testing Checklist

**Version:** 3.0.0  
**Date:** December 2024  
**Purpose:** Comprehensive testing of all routes, views, and functionality

---

## Testing Overview

This document provides a systematic testing checklist for all features, routes, and functionality in Laragon Dashboard 3.0.0.

---

## 1. Router Testing

### Route Accessibility

- [ ] **Dashboard (index.php)**
  - [ ] Loads without errors
  - [ ] Shows server cards (Apache, PHP, MySQL, Laragon)
  - [ ] Shows projects grid
  - [ ] "Create New Project" button works
  - [ ] Dynamic greeting displays correctly

- [ ] **Projects Page (`index.php?page=projects`)**
  - [ ] Loads without errors
  - [ ] Shows only projects (no server cards)
  - [ ] Projects display correctly with icons/favicons
  - [ ] "Create New Project" button works
  - [ ] Empty state displays when no projects

- [ ] **Databases Page (`index.php?page=databases`)**
  - [ ] Loads without errors
  - [ ] Shows database information
  - [ ] PHPMyAdmin link works

- [ ] **Services Page (`index.php?page=services`)**
  - [ ] Loads without errors
  - [ ] Lists all installed services
  - [ ] Service status displays correctly
  - [ ] Start/Stop buttons work
  - [ ] Reload Apache button works
  - [ ] Port configuration displays
  - [ ] Enabled checkboxes sync correctly

- [ ] **Server Vitals (`index.php?page=vitals`)**
  - [ ] Loads without errors
  - [ ] Charts render correctly
  - [ ] Data updates (if auto-refresh enabled)
  - [ ] KPI cards display correctly

- [ ] **Mailbox (`index.php?page=mailbox`)**
  - [ ] Loads without errors
  - [ ] Shows Mailpit connection status
  - [ ] Lists emails (if Mailpit running)
  - [ ] Email detail view works
  - [ ] Error message shows if Mailpit not running

- [ ] **Logs (`index.php?page=logs`)**
  - [ ] Loads without errors
  - [ ] Lists available log files
  - [ ] Log viewer displays content
  - [ ] Refresh button works
  - [ ] Clear button works
  - [ ] Download button works
  - [ ] CodeMirror editor displays correctly (Monokai theme)

- [ ] **Tools (`index.php?page=tools`)**
  - [ ] Loads without errors
  - [ ] All tools accessible

- [ ] **Backup (`index.php?page=backup`)**
  - [ ] Loads without errors
  - [ ] Backup functionality works

- [ ] **Sites Enabled (`index.php?page=sites`)**
  - [ ] Loads without errors
  - [ ] Lists virtual host files
  - [ ] File selection works (`?page=sites&file=example.conf`)
  - [ ] CodeMirror editor displays correctly
  - [ ] Save button works
  - [ ] Refresh button works
  - [ ] Create new site button works

- [ ] **httpd.conf (`index.php?page=httpd`)**
  - [ ] Loads without errors
  - [ ] Loads Apache configuration
  - [ ] CodeMirror editor displays correctly
  - [ ] Save button works
  - [ ] Reload Apache button works

- [ ] **Preferences (`index.php?page=preferences`)**
  - [ ] Loads without errors
  - [ ] Shows current preferences
  - [ ] Save button works
  - [ ] Reset button works

### Route Security

- [ ] **Invalid Routes**
  - [ ] `index.php?page=../../../etc/passwd` - Should show 404
  - [ ] `index.php?page=<script>alert('xss')</script>` - Should show 404
  - [ ] `index.php?page=non_existent_page` - Should show 404
  - [ ] 404 page displays correctly with i18n

- [ ] **Parameter Validation**
  - [ ] `index.php?page=sites&file=../../../etc/passwd` - Should sanitize
  - [ ] `index.php?page=logs&log=../../../etc/passwd` - Should sanitize
  - [ ] `index.php?page=mailbox&view=detail&id=123` - Should work correctly

---

## 2. API Endpoints Testing

### API: `api/vitals.php`

- [ ] **Action: `status` (default)**
  - [ ] Returns JSON with server vitals
  - [ ] Contains CPU, memory, disk data
  - [ ] Contains historical data for charts
  - [ ] No PHP errors in response

### API: `api/services.php`

- [ ] **Action: `status`**
  - [ ] Returns service statuses
  - [ ] Shows running ports
  - [ ] Shows enabled status

- [ ] **Action: `start`**
  - [ ] Starts service successfully
  - [ ] Returns success response
  - [ ] Service actually starts

- [ ] **Action: `stop`**
  - [ ] Stops service successfully
  - [ ] Returns success response
  - [ ] Service actually stops

- [ ] **Action: `reload`**
  - [ ] Reloads Apache successfully
  - [ ] Returns success response

- [ ] **Action: `save`**
  - [ ] Saves service configuration
  - [ ] Updates laragon.ini correctly
  - [ ] Returns success response

### API: `api/logs.php`

- [ ] **Action: `read`**
  - [ ] Returns log file content
  - [ ] Handles large files
  - [ ] Returns error if file doesn't exist

- [ ] **Action: `clear`**
  - [ ] Clears log file
  - [ ] Creates backup before clearing
  - [ ] Returns success response

- [ ] **Action: `download`**
  - [ ] Downloads log file
  - [ ] Sets correct headers
  - [ ] File downloads correctly

### API: `api/files.php`

- [ ] **Action: `read`**
  - [ ] Returns file content
  - [ ] Handles virtual host files
  - [ ] Returns error for invalid paths

- [ ] **Action: `write`**
  - [ ] Saves file content
  - [ ] Creates backup before saving
  - [ ] Validates path security
  - [ ] Returns success response

- [ ] **Action: `list`**
  - [ ] Lists files in directory
  - [ ] Returns file metadata
  - [ ] Handles empty directories

### API: `api/mailpit.php`

- [ ] **Action: `messages` (default)**
  - [ ] Returns emails from Mailpit
  - [ ] Handles Mailpit not running
  - [ ] Returns proper error messages
  - [ ] CORS headers set correctly

- [ ] **Action: `message`**
  - [ ] Returns single email details
  - [ ] Handles invalid ID
  - [ ] Returns HTML content correctly

### API: `api/preferences.php`

- [ ] **Action: `save`**
  - [ ] Saves preferences correctly
  - [ ] Updates preferences.json
  - [ ] Returns success response

- [ ] **Action: `reset`**
  - [ ] Deletes preferences file
  - [ ] Returns success response

- [ ] **Action: `get`**
  - [ ] Returns current preferences
  - [ ] Returns defaults if no preferences

### API: `api/create_project.php`

- [ ] **Project Creation**
  - [ ] Creates project directory
  - [ ] Initializes framework (WordPress, Laravel, etc.)
  - [ ] Creates database if requested
  - [ ] Initializes Git if requested
  - [ ] Creates virtual host
  - [ ] Returns success response

### API: `api/update.php`

- [ ] **Action: `check`**
  - [ ] Checks GitHub for updates
  - [ ] Returns update information
  - [ ] Handles network errors

- [ ] **Action: `backup`**
  - [ ] Creates backup successfully
  - [ ] Generates manifest
  - [ ] Backs up config files

- [ ] **Action: `download`**
  - [ ] Downloads update ZIP
  - [ ] Handles download errors
  - [ ] Verifies download

- [ ] **Action: `install`**
  - [ ] Installs update correctly
  - [ ] Migrates configuration
  - [ ] Preserves user data
  - [ ] Verifies installation

- [ ] **Action: `rollback`**
  - [ ] Rolls back to backup
  - [ ] Restores config files
  - [ ] Returns success response

- [ ] **Action: `verify`**
  - [ ] Verifies installation
  - [ ] Checks critical functions
  - [ ] Returns verification status

---

## 3. UI Components Testing

### Navigation

- [ ] **Sidebar**
  - [ ] All links work correctly
  - [ ] Active state highlights correctly
  - [ ] Icons display correctly
  - [ ] Translations work
  - [ ] Responsive on mobile

- [ ] **Navbar**
  - [ ] Theme toggle works (light/dark)
  - [ ] Monochrome toggle works
  - [ ] Language selector works
  - [ ] Project search works
  - [ ] User avatar displays
  - [ ] Notifications display (if any)

### Theme System

- [ ] **Light Theme**
  - [ ] Applies correctly
  - [ ] Persists on page reload
  - [ ] All components visible

- [ ] **Dark Theme**
  - [ ] Applies correctly
  - [ ] Persists on page reload
  - [ ] All components visible
  - [ ] Good contrast

- [ ] **Monochrome Mode**
  - [ ] Applies correctly
  - [ ] Preserves underlying theme
  - [ ] All components visible
  - [ ] Persists on page reload

### Internationalization

- [ ] **Language Switching**
  - [ ] All 8 languages work
  - [ ] Translations load correctly
  - [ ] RTL works for Arabic
  - [ ] Fallback to English works
  - [ ] Language persists in cookie

- [ ] **Translation Coverage**
  - [ ] Dashboard translations complete
  - [ ] Sidebar translations complete
  - [ ] Projects translations complete
  - [ ] Services translations complete
  - [ ] Logs translations complete
  - [ ] All modules translated

---

## 4. Feature Testing

### Project Detection

- [ ] **Favicon Detection**
  - [ ] Detects favicons in root
  - [ ] Detects favicons in images/
  - [ ] Detects favicons in assets/images/
  - [ ] Detects favicons in public/
  - [ ] Detects WordPress theme favicons
  - [ ] Parses HTML for favicon links
  - [ ] Favicon URLs correct (no character trimming)
  - [ ] Platform icon fallback works

- [ ] **Platform Detection**
  - [ ] WordPress detected correctly
  - [ ] Laravel detected correctly
  - [ ] PHP projects detected correctly
  - [ ] Python projects detected correctly
  - [ ] Other platforms detected correctly
  - [ ] Platform icons display correctly

### Service Management

- [ ] **Service Detection**
  - [ ] Detects installed services
  - [ ] Reads ports from laragon.ini
  - [ ] Shows running ports
  - [ ] Displays service status

- [ ] **Service Control**
  - [ ] Start service works
  - [ ] Stop service works
  - [ ] Reload Apache works
  - [ ] Port changes save correctly
  - [ ] Enabled status saves correctly

### File Operations

- [ ] **Virtual Host Files**
  - [ ] Lists .conf files correctly
  - [ ] Loads file content
  - [ ] Saves file content
  - [ ] Creates backup before save
  - [ ] CodeMirror editor works
  - [ ] Syntax highlighting works

- [ ] **Apache Config**
  - [ ] Loads httpd.conf
  - [ ] Saves httpd.conf
  - [ ] Creates backup
  - [ ] Reloads Apache after save

- [ ] **Log Files**
  - [ ] Lists log files correctly
  - [ ] Loads log content
  - [ ] Clears log files
  - [ ] Downloads log files
  - [ ] CodeMirror read-only mode works

### CodeMirror Integration

- [ ] **Editor Functionality**
  - [ ] Monokai theme applies correctly
  - [ ] Syntax highlighting works
  - [ ] Line numbers display
  - [ ] Read-only mode works (logs)
  - [ ] Edit mode works (sites, httpd)
  - [ ] Text is visible (not black on black)

---

## 5. Security Testing

### Input Validation

- [ ] **Path Traversal Prevention**
  - [ ] Cannot access files outside allowed directories
  - [ ] Cannot use `../` in paths
  - [ ] File operations validate paths

- [ ] **XSS Prevention**
  - [ ] All user input escaped
  - [ ] JSON responses clean (no PHP errors)
  - [ ] No script injection possible

- [ ] **CSRF Protection**
  - [ ] POST requests validated (if implemented)
  - [ ] API endpoints secure

### Error Handling

- [ ] **API Error Responses**
  - [ ] Clean JSON (no PHP warnings)
  - [ ] Proper HTTP status codes
  - [ ] Error messages user-friendly

- [ ] **404 Handling**
  - [ ] Custom 404 page displays
  - [ ] i18n support in 404 page
  - [ ] Proper HTTP status code

---

## 6. Performance Testing

- [ ] **Page Load Times**
  - [ ] Dashboard loads quickly
  - [ ] Projects page loads quickly
  - [ ] Services page loads quickly
  - [ ] No excessive API calls

- [ ] **Asset Loading**
  - [ ] All CSS loads correctly
  - [ ] All JS loads correctly
  - [ ] No 404 errors for assets
  - [ ] CodeMirror libraries load locally

- [ ] **API Response Times**
  - [ ] Vitals API responds quickly
  - [ ] Services API responds quickly
  - [ ] Logs API handles large files
  - [ ] File operations complete quickly

---

## 7. Browser Compatibility

- [ ] **Microsoft Edge**
  - [ ] All features work
  - [ ] PWA installable
  - [ ] Theme switching works

- [ ] **Google Chrome**
  - [ ] All features work
  - [ ] PWA installable
  - [ ] Theme switching works

- [ ] **Firefox**
  - [ ] All features work
  - [ ] Theme switching works

- [ ] **Mobile Browsers**
  - [ ] Responsive design works
  - [ ] Touch interactions work
  - [ ] Sidebar collapses correctly

---

## 8. Offline Functionality

- [ ] **Service Worker**
  - [ ] Registers correctly
  - [ ] Caches assets
  - [ ] Works offline (basic pages)

- [ ] **Local Libraries**
  - [ ] CodeMirror works offline
  - [ ] No CDN dependencies
  - [ ] All assets load locally

---

## 9. Configuration Testing

- [ ] **Laragon Detection**
  - [ ] Auto-detects Laragon path
  - [ ] Preferences override works
  - [ ] Environment variable works
  - [ ] Drive scanning works

- [ ] **Preferences**
  - [ ] Saves correctly
  - [ ] Loads correctly
  - [ ] Overrides work
  - [ ] Reset works

---

## 10. Integration Testing

- [ ] **End-to-End Workflows**
  - [ ] Create project → View in projects list
  - [ ] Start service → Check status
  - [ ] Edit virtual host → Save → Reload Apache
  - [ ] View log → Clear log → Verify cleared
  - [ ] Change language → Verify translations
  - [ ] Switch theme → Verify persistence

---

## Test Results Template

```
Date: ___________
Tester: ___________
Version: 3.0.0

### Router Testing
- Total Routes: 12
- Passed: ___
- Failed: ___
- Notes: ___________

### API Testing
- Total Endpoints: 8
- Passed: ___
- Failed: ___
- Notes: ___________

### UI Testing
- Components Tested: ___
- Passed: ___
- Failed: ___
- Notes: ___________

### Issues Found
1. ___________
2. ___________
3. ___________

### Recommendations
1. ___________
2. ___________
3. ___________
```

---

## Quick Test Commands

### Test Router
```bash
# Test all routes
curl http://localhost/laragon-dashboard/index.php?page=projects
curl http://localhost/laragon-dashboard/index.php?page=services
curl http://localhost/laragon-dashboard/index.php?page=logs
curl http://localhost/laragon-dashboard/index.php?page=sites&file=test.conf
```

### Test API Endpoints
```bash
# Test vitals
curl http://localhost/laragon-dashboard/api/vitals.php

# Test services status
curl http://localhost/laragon-dashboard/api/services.php?action=status

# Test logs list
curl http://localhost/laragon-dashboard/api/logs.php?action=list
```

---

**Document Version:** 1.0  
**Last Updated:** December 2024  
**Status:** Ready for Testing

