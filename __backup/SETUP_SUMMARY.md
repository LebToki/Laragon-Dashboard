# Laragon-Dashboard Setup Summary

## Structure Prepared

### Constants Defined (in `pages/bootstrap.php`):
- `APP_ROOT`: `/www/` - Laragon root directory
- `DASHBOARD_ROOT`: `/www/Laragon-Dashboard/` - Dashboard application root
- `TEMPLATE_ROOT`: `/www/Laragon-Dashboard/template/` - Template assets
- `PARTIALS_ROOT`: `/www/Laragon-Dashboard/Laragon-Dashboard/assets/partials/` - Layout partials

### File Structure:
```
/www/
├── index.php                    # Redirects to Laragon-Dashboard/index.php
└── Laragon-Dashboard/
    ├── index.php                # Entry point, loads pages/servers.php
    ├── servers.php               # Router, loads pages/servers.php
    ├── pages/
    │   ├── bootstrap.php         # Common initialization, defines constants
    │   ├── servers.php           # Main servers page
    │   ├── servers-old.php       # Legacy backup
    │   └── services-helpers.php  # Helper functions
    ├── Laragon-Dashboard/
    │   └── assets/
    │       └── partials/
    │           ├── layouts/
    │           │   ├── layoutTop.php    # Updated to use PARTIALS_ROOT
    │           │   └── layoutBottom.php # Updated to use PARTIALS_ROOT
    │           ├── head.php             # Updated to use TEMPLATE_ROOT
    │           ├── sidebar.php
    │           ├── navbar.php
    │           ├── footer.php
    │           └── scripts.php
    └── template/
        └── assets/               # Template assets (CSS, JS, images)
```

### Path Resolution:
- **Layout files** use `PARTIALS_ROOT` constant
- **Asset files** use `TEMPLATE_ROOT` constant  
- **Pages** are in `/pages/` directory
- **Entry point** is `/Laragon-Dashboard/index.php`

### Next Steps:
1. ✅ Constants defined
2. ✅ Layout files updated to use constants
3. ✅ Head.php updated to use constants
4. ⏳ Test the setup
5. ⏳ Update other partials if needed (sidebar, navbar, etc.)

## Template Pattern Followed:
- Pages use `loadLayoutTop()` and `loadLayoutBottom()` functions
- Content goes inside `<div class="dashboard-main-body">`
- No `container-fluid` wrapper needed
- Assets reference template directory

