# Routing Simplification Proposal

## Current State

The dashboard currently uses a `Router` class (`includes/Router.php`) that:
- Registers all routes in a central location
- Validates and sanitizes parameters
- Provides 404 handling
- Adds metadata (titles, auth requirements)

## Why Simplify?

This is **not a complex web application** - it's a simple dashboard with:
- ~12 pages
- Simple `?page=` query parameter routing
- No complex URL patterns or REST endpoints
- No authentication system (yet)
- Minimal parameter validation needs

The Router class adds **unnecessary complexity** for what is essentially:
```php
$page = $_GET['page'] ?? 'dashboard';
include "pages/{$page}.php";
```

## Proposed Simplified Approach

### Simple Routing in `index.php`

```php
<?php
// Load configuration
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/i18n.php';

// Simple page routing
$page = $_GET['page'] ?? 'dashboard';

// Sanitize page name (prevent directory traversal)
$page = basename($page);
$page = preg_replace('/[^a-zA-Z0-9_-]/', '', $page);

// List of valid pages
$validPages = [
    'dashboard', 'projects', 'databases', 'services', 'vitals',
    'mailbox', 'logs', 'tools', 'backup', 'sites', 'httpd', 'preferences'
];

// Validate page exists
if (!in_array($page, $validPages)) {
    http_response_code(404);
    include __DIR__ . '/pages/404.php';
    exit;
}

// Load page if not dashboard
if ($page !== 'dashboard') {
    $pageFile = __DIR__ . '/pages/' . $page . '.php';
    if (file_exists($pageFile)) {
        include $pageFile;
        exit;
    }
}

// Default: show dashboard
include __DIR__ . '/partials/layouts/layoutTop.php';
// ... dashboard content ...
```

### Benefits

1. **Simpler**: ~20 lines vs 350+ lines
2. **Easier to understand**: No class, no registration, just simple logic
3. **Faster**: No object instantiation or method calls
4. **Easier to maintain**: All routing logic in one place
5. **Still secure**: Basic sanitization prevents directory traversal

### Parameter Handling

Pages can still access `$_GET` directly with basic sanitization:

```php
// In pages/sites.php
$file = isset($_GET['file']) ? basename($_GET['file']) : '';
$file = preg_replace('/[^a-zA-Z0-9._-]/', '', $file);
```

Or create a simple helper function:

```php
// In includes/helpers.php
function getParam($key, $default = '') {
    if (!isset($_GET[$key])) {
        return $default;
    }
    $value = $_GET[$key];
    // Basic sanitization
    $value = strip_tags($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    return $value;
}
```

## Migration Steps

1. **Update `index.php`**:
   - Remove Router class instantiation
   - Add simple routing logic
   - Keep backward compatibility

2. **Update pages**:
   - Replace `$router->getParam()` with `getParam()` helper or direct `$_GET`
   - Remove Router dependencies

3. **Remove Router files**:
   - Delete `includes/Router.php`
   - Delete `ROUTER_DOCUMENTATION.md` (or archive it)

4. **Update sidebar**:
   - Simplify active page detection
   - Use simple `$_GET['page']` check

## Recommendation

**Yes, simplify the routing.** The current Router is over-engineered for this use case. A simple `?page=` approach with basic sanitization is:
- More maintainable
- Easier to understand
- Sufficient for the dashboard's needs
- Still secure with proper sanitization

Keep it simple - this is a dashboard, not a framework.

