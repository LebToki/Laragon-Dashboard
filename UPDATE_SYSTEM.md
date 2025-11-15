# Laragon Dashboard - Self-Update System

**Version:** 1.0  
**Date:** 2024  
**Author:** 2TInteractive

---

## Overview

The Laragon Dashboard self-update system allows automatic updates from GitHub while preserving user configuration, preferences, and environment settings.

---

## Architecture

### Update Flow

```
┌─────────────────────────────────────────┐
│  1. Check for Updates                  │
│     - Query GitHub API                  │
│     - Compare versions                  │
│     - Download update info              │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│  2. Backup Current State                │
│     - Backup config.php                 │
│     - Backup data/preferences.json      │
│     - Backup custom files               │
│     - Create restore point              │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│  3. Download Update                     │
│     - Download ZIP from GitHub          │
│     - Extract to temp directory         │
│     - Verify integrity                  │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│  4. Migrate Configuration               │
│     - Parse old config                  │
│     - Map to new structure              │
│     - Merge user settings               │
│     - Preserve custom values            │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│  5. Apply Update                        │
│     - Replace files                     │
│     - Update database (if needed)       │
│     - Run migration scripts             │
└─────────────────────────────────────────┘
                    │
                    ▼
┌─────────────────────────────────────────┐
│  6. Verify & Rollback                  │
│     - Test critical functions           │
│     - Verify config loaded              │
│     - Rollback if failed                │
└─────────────────────────────────────────┘
```

---

## Configuration Safeguarding

### Files to Preserve

#### Critical Configuration
- `config.php` - Main configuration (user customizations)
- `data/preferences.json` - Dashboard preferences
- `data/license.json` - License keys (if exists)
- `.env` - Environment variables (if exists)

#### User Data
- `data/backups/` - User-created backups
- `data/projects/` - Custom project configurations
- `logs/` - Application logs (optional)

#### Custom Files
- Custom themes
- Custom translations
- Custom plugins/extensions

### Configuration Structure

```php
// config.php structure
<?php
// Auto-generated header - DO NOT MODIFY
// User customizations below

// User-defined constants
define('CUSTOM_LARAGON_ROOT', 'C:/custom/path');
define('CUSTOM_MYSQL_HOST', 'localhost');

// ... rest of config
```

---

## Update Mechanism

### Version Checking

**GitHub API Endpoint:**
```
GET https://api.github.com/repos/LebToki/Laragon-Dashboard/releases/latest
```

**Response:**
```json
{
  "tag_name": "v3.0.1",
  "name": "Version 3.0.1",
  "body": "Release notes...",
  "assets": [
    {
      "browser_download_url": "https://github.com/.../Laragon-Dashboard-v3.0.1.zip",
      "name": "Laragon-Dashboard-v3.0.1.zip",
      "size": 1234567
    }
  ]
}
```

### Update Process

1. **Pre-Update Checks**
   - Verify write permissions
   - Check disk space
   - Verify internet connection
   - Check PHP version compatibility

2. **Backup Creation**
   - Create timestamped backup directory
   - Copy all critical files
   - Generate backup manifest

3. **Download & Extract**
   - Download ZIP from GitHub
   - Verify checksum (if available)
   - Extract to temporary directory

4. **Configuration Migration**
   - Parse old config structure
   - Map to new structure
   - Preserve user customizations
   - Handle deprecated settings

5. **File Replacement**
   - Replace application files
   - Preserve user data directories
   - Update version number

6. **Post-Update**
   - Run migration scripts
   - Clear cache
   - Verify installation
   - Show release notes

---

## Implementation

### ✅ Implemented Files

#### Update API Endpoint
**File:** `api/update.php` ✅ **IMPLEMENTED**

**Actions:**
- `check` - Check for available updates
- `backup` - Create backup of current installation
- `download` - Download update package
- `install` - Install downloaded update
- `rollback` - Rollback to previous version
- `verify` - Verify installation after update

**Usage:**
```javascript
// Check for updates
fetch('api/update.php?action=check')
  .then(r => r.json())
  .then(data => console.log(data));

// Full update flow
// 1. Check
// 2. Backup
// 3. Download
// 4. Install
// 5. Verify
```

#### Update Manager Class
**File:** `includes/UpdateManager.php` ✅ **IMPLEMENTED**

**Methods:**
- `checkForUpdates()` - Check GitHub for updates
- `backupCurrentInstallation()` - Create backup with manifest
- `downloadUpdate($downloadUrl)` - Download update ZIP
- `installUpdate($zipPath, $backupPath)` - Install update with config migration
- `rollback($backupPath)` - Rollback to backup
- `verifyInstallation()` - Verify update success

**Features:**
- Automatic backup creation
- Configuration preservation
- User data preservation
- Rollback capability
- Installation verification

#### Configuration Migrator
**File:** `includes/ConfigMigrator.php` ✅ **IMPLEMENTED**

**Methods:**
- `migrateConfiguration($backupPath, $newVersionPath)` - Main migration method
- `migrateConfigFile()` - Migrate config.php
- `migratePreferencesFile()` - Migrate preferences.json
- `migrateLicenseFile()` - Migrate license.json
- `extractUserConstants()` - Extract user-defined constants
- `evaluateConstantValue()` - Safely evaluate constant values

**Features:**
- Preserves user customizations
- Merges old and new configs
- Handles renamed constants
- Preserves function calls (e.g., getLaragonRoot())

---

## Safety Features

### Rollback Mechanism

**Backup Structure:**
```
backups/
├── 2024-12-15_14-30-00_v3.0.0/
│   ├── config.php.backup
│   ├── preferences.json.backup
│   ├── manifest.json
│   └── files/
│       └── [all backed up files]
```

**Manifest Format:**
```json
{
  "version": "3.0.0",
  "timestamp": "2024-12-15T14:30:00Z",
  "files": [
    {
      "path": "config.php",
      "checksum": "abc123...",
      "backup_path": "config.php.backup"
    }
  ],
  "config_keys": [
    "LARAGON_ROOT",
    "MYSQL_HOST",
    "MYSQL_USER"
  ]
}
```

### Verification Steps

1. **Pre-Installation**
   - Verify backup created successfully
   - Check disk space
   - Verify file permissions

2. **Post-Installation**
   - Verify `config.php` loads without errors
   - Test critical functions
   - Verify database connection (if applicable)
   - Check service detection

3. **Auto-Rollback Triggers**
   - Config file parse errors
   - Critical function failures
   - Database connection failures
   - Service detection failures

---

## Configuration Migration Strategy

### Version-Specific Migrations

**Example: v3.0.0 → v3.0.1**

```php
// Migration script: migrations/v3.0.0_to_v3.0.1.php

function migrate_3_0_0_to_3_0_1($oldConfig) {
    $newConfig = $oldConfig;
    
    // Handle renamed constants
    if (defined('OLD_CONSTANT_NAME')) {
        $newConfig['NEW_CONSTANT_NAME'] = OLD_CONSTANT_NAME;
    }
    
    // Handle deprecated settings
    if (isset($oldConfig['deprecated_setting'])) {
        // Convert to new format
        $newConfig['new_setting'] = convertDeprecated($oldConfig['deprecated_setting']);
    }
    
    // Preserve user customizations
    $newConfig['user_customizations'] = extractUserCustomizations($oldConfig);
    
    return $newConfig;
}
```

### Config Key Mapping

**Mapping File:** `migrations/config_mapping.json`

```json
{
  "v3.0.0_to_v3.0.1": {
    "renamed": {
      "OLD_LARAGON_PATH": "LARAGON_ROOT",
      "OLD_MYSQL_HOST": "MYSQL_HOST"
    },
    "deprecated": [
      "LEGACY_SETTING_1",
      "LEGACY_SETTING_2"
    ],
    "new_defaults": {
      "NEW_FEATURE_ENABLED": true,
      "NEW_SETTING": "default_value"
    }
  }
}
```

---

## User Interface

### Update Notification

**Location:** Dashboard header or settings page

**Display:**
- Current version
- Available version
- Update button
- "Check for updates" button
- Update history

### Update Settings

**Location:** `pages/preferences.php`

**Options:**
- Auto-check for updates (daily/weekly/monthly)
- Auto-install minor updates
- Require confirmation for major updates
- Backup retention (number of backups to keep)

---

## Security Considerations

### Update Verification

1. **Checksum Verification**
   - Verify downloaded ZIP checksum
   - Compare with GitHub release checksum

2. **Source Verification**
   - Only accept updates from official GitHub repo
   - Verify release signatures (if implemented)

3. **Permission Checks**
   - Verify write permissions before update
   - Check PHP execution permissions

4. **Rollback Security**
   - Encrypt sensitive backup data
   - Secure backup directory permissions

---

## Error Handling

### Common Scenarios

1. **Network Failure**
   - Retry with exponential backoff
   - Show user-friendly error message
   - Allow manual update download

2. **Disk Space**
   - Check available space before download
   - Clean old backups if needed
   - Warn user if insufficient space

3. **Permission Errors**
   - Check permissions before update
   - Provide clear error messages
   - Suggest running as administrator

4. **Config Migration Failure**
   - Log migration errors
   - Preserve old config
   - Allow manual config merge

5. **Update Failure**
   - Automatic rollback
   - Log error details
   - Notify user
   - Provide support contact

---

## Implementation Roadmap

### Phase 1: Core Update System (Week 1-2)
- [ ] Create UpdateManager class
- [ ] Implement GitHub API integration
- [ ] Create backup system
- [ ] Basic update download/install

### Phase 2: Configuration Migration (Week 3-4)
- [ ] Create ConfigMigrator class
- [ ] Implement config key mapping
- [ ] Create migration scripts
- [ ] Test config preservation

### Phase 3: Safety Features (Week 5-6)
- [ ] Implement rollback mechanism
- [ ] Add verification steps
- [ ] Error handling
- [ ] Logging system

### Phase 4: User Interface (Week 7-8)
- [ ] Update notification UI
- [ ] Update settings page
- [ ] Progress indicators
- [ ] Release notes display

### Phase 5: Testing & Documentation (Week 9-10)
- [ ] End-to-end testing
- [ ] Edge case testing
- [ ] User documentation
- [ ] Developer documentation

---

## Usage Examples

### Check for Updates

```php
$updateManager = new UpdateManager();
$updateInfo = $updateManager->checkForUpdates();

if ($updateInfo['available']) {
    echo "Update available: {$updateInfo['version']}";
    echo "Current version: {$updateInfo['current']}";
}
```

### Install Update

```php
$updateManager = new UpdateManager();

try {
    // Check for updates
    $updateInfo = $updateManager->checkForUpdates();
    
    if ($updateInfo['available']) {
        // Create backup
        $backup = $updateManager->backupCurrentInstallation();
        
        // Download update
        $updatePath = $updateManager->downloadUpdate($updateInfo['version']);
        
        // Install update
        $updateManager->installUpdate($updatePath);
        
        // Verify installation
        if ($updateManager->verifyInstallation()) {
            echo "Update installed successfully!";
        } else {
            // Rollback
            $updateManager->rollback($backup);
            echo "Update failed, rolled back to previous version.";
        }
    }
} catch (UpdateException $e) {
    echo "Update error: " . $e->getMessage();
    // Rollback if backup exists
    if (isset($backup)) {
        $updateManager->rollback($backup);
    }
}
```

---

## Configuration Preservation Examples

### Example 1: Simple Value Preservation

**Old Config:**
```php
define('LARAGON_ROOT', 'C:/laragon');
define('MYSQL_HOST', 'localhost');
```

**New Config (after update):**
```php
// Auto-generated
define('LARAGON_ROOT', 'C:/laragon'); // Preserved from user config
define('MYSQL_HOST', 'localhost'); // Preserved from user config
```

### Example 2: Renamed Constant

**Old Config:**
```php
define('OLD_LARAGON_PATH', 'C:/laragon');
```

**Migration:**
```php
// Detect old constant
if (defined('OLD_LARAGON_PATH')) {
    $newConfig['LARAGON_ROOT'] = OLD_LARAGON_PATH;
}
```

### Example 3: Complex Structure

**Old Config:**
```php
$config = [
    'laragon' => [
        'path' => 'C:/laragon',
        'mysql' => [
            'host' => 'localhost',
            'user' => 'root'
        ]
    ]
];
```

**New Config (flattened):**
```php
define('LARAGON_ROOT', 'C:/laragon'); // Migrated from $config['laragon']['path']
define('MYSQL_HOST', 'localhost'); // Migrated from $config['laragon']['mysql']['host']
define('MYSQL_USER', 'root'); // Migrated from $config['laragon']['mysql']['user']
```

---

## Best Practices

1. **Always Backup First**
   - Never update without backup
   - Verify backup before proceeding

2. **Test Migration**
   - Test config migration on sample data
   - Verify all keys are preserved

3. **Incremental Updates**
   - Support updating from any version
   - Chain migrations if needed

4. **User Communication**
   - Clear update notifications
   - Show what's changing
   - Provide release notes

5. **Rollback Ready**
   - Always have rollback plan
   - Test rollback procedure
   - Keep multiple backups

---

**Document Version:** 1.0  
**Last Updated:** 2024  
**Status:** Planning Phase

