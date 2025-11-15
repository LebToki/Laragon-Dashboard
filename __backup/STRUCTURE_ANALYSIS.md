# Laragon-Dashboard Structure Analysis

## Template Structure (WowDash)

### Directory Structure
```
/template/
├── assets/          # CSS, JS, images, fonts
├── partials/        # Reusable components
│   ├── layouts/     # layoutTop.php, layoutBottom.php
│   ├── head.php
│   ├── sidebar.php
│   ├── navbar.php
│   ├── footer.php
│   └── scripts.php
└── *.php           # Individual pages
```

### Page Structure Pattern
```php
<?php include './partials/layouts/layoutTop.php' ?>

<div class="dashboard-main-body">
    <!-- Breadcrumb/Header -->
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Page Title</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Page Name</li>
        </ul>
    </div>
    
    <!-- Page Content -->
    <!-- ... -->
</div>

<?php include './partials/layouts/layoutBottom.php' ?>
```

### Key Observations

1. **Layout Files:**
   - `layoutTop.php`: Opens HTML, includes head, sidebar, navbar, opens `<main>` and `<div class="dashboard-main-body">`
   - `layoutBottom.php`: Closes `dashboard-main-body`, includes footer, scripts, closes `</main>`, `</body>`, `</html>`

2. **Asset Paths:**
   - All assets referenced as `assets/...` (relative to template directory)
   - CSS: `assets/css/style.css`
   - JS: `assets/js/app.js`
   - Images: `assets/images/logo.png`

3. **Partial Paths:**
   - All partials use `./partials/...` (relative to template directory)
   - Layouts: `./partials/layouts/layoutTop.php`

4. **Page Structure:**
   - No `container-fluid` wrapper needed (handled by `dashboard-main-body`)
   - Content goes directly inside `dashboard-main-body`
   - Uses Bootstrap grid system (`row`, `col-*`)

## Current Laragon-Dashboard Structure

### Current Issues:
1. Pages are in `/pages/` but partials are in `/Laragon-Dashboard/assets/partials/`
2. Path resolution is complex with nested Laragon-Dashboard directories
3. Assets are mixed between `/assets/` and `/template/assets/`

### Recommended Structure:
```
/Laragon-Dashboard/
├── pages/              # All page files
│   ├── bootstrap.php   # Common initialization
│   ├── servers.php     # Servers page
│   └── services-helpers.php
├── partials/           # Reusable components (should mirror template/partials)
│   ├── layouts/
│   │   ├── layoutTop.php
│   │   └── layoutBottom.php
│   ├── head.php
│   ├── sidebar.php
│   ├── navbar.php
│   ├── footer.php
│   └── scripts.php
├── assets/             # Link to template/assets or copy needed files
├── template/           # Original template (reference)
└── index.php           # Entry point
```

## Path Resolution Strategy

### Option 1: Use Template Assets Directly
- Reference `template/assets/...` from pages
- Requires path calculation: `__DIR__ . '/../template/assets/...'`

### Option 2: Symlink/Copy Assets
- Create symlink or copy template/assets to Laragon-Dashboard/assets
- Use relative paths: `assets/...`

### Option 3: Use Base Path Constant
- Define `TEMPLATE_ROOT` constant
- Use: `TEMPLATE_ROOT . '/assets/...'`

## Next Steps

1. **Set up partials structure** - Mirror template/partials in Laragon-Dashboard
2. **Fix asset paths** - Ensure assets are accessible
3. **Update bootstrap.php** - Use correct paths for partials
4. **Update pages** - Follow template pattern exactly

