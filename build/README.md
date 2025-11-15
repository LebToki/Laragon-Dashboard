# Build System Documentation

This directory contains build scripts for preparing Laragon Dashboard releases.

## Scripts

### `update_libraries.php`
Updates all JavaScript and CSS libraries to their latest versions.

**Usage:**
```bash
# Dry run (preview changes)
php build/update_libraries.php --dry-run

# Actually update libraries
php build/update_libraries.php

# Update for release
php build/update_libraries.php --release
```

### Future Scripts (To Be Implemented)

- `obfuscate.php` - Obfuscate PHP code for release
- `minify_js.php` - Minify and obfuscate JavaScript
- `package_release.php` - Package release version
- `validate_license.php` - Validate license keys

## Directory Structure

```
build/
├── README.md              # This file
├── update_libraries.php    # Library updater
└── [future scripts]       # To be added
```

## Notes

- Always test updates in development before applying to release
- Keep backups of previous library versions
- Document breaking changes in CHANGELOG.md

