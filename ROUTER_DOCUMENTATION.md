# Router Documentation

## Overview

The Laragon Dashboard uses a centralized routing system (`includes/Router.php`) to handle page navigation, parameter validation, and security.

## Features

- ✅ **Route Registration**: All routes are registered in a central location
- ✅ **Parameter Validation**: Only allowed parameters are extracted and sanitized
- ✅ **Security**: Prevents directory traversal and XSS attacks
- ✅ **404 Handling**: Custom 404 page with i18n support
- ✅ **Backward Compatible**: Pages can still access `$_GET` directly
- ✅ **Type Safety**: Route definitions include metadata (title, auth requirements, etc.)

## Route Definition

Routes are defined in the `Router` class constructor:

```php
'page_name' => [
    'file' => 'page.php',           // File in /pages directory
    'title' => 'Page Title',        // Page title for breadcrumbs
    'requires_auth' => false,       // Authentication requirement
    'params' => ['param1', 'param2'] // Allowed URL parameters
]
```

## Available Routes

| Route         | File              | Parameters   | Description         |
|---------------|-------------------|--------------|---------------------|
| `dashboard`   | (none)            | -            | Main dashboard      |
| `projects`    | `projects.php`    | -            | Projects list       |
| `databases`   | `databases.php`   | -            | Database management |
| `services`    | `services.php`    | -            | Service management  |
| `vitals`      | `vitals.php`      | -            | Server vitals       |
| `mailbox`     | `mailbox.php`     | `view`, `id` | Email management    |
| `logs`        | `logs.php`        | `log`        | Log viewer          |
| `tools`       | `tools.php`       | -            | Development tools   |
| `backup`      | `backup.php`      | -            | Backup management   |
| `sites`       | `sites.php`       | `file`       | Virtual hosts       |
| `httpd`       | `httpd.php`       | -            | Apache config       |
| `preferences` | `preferences.php` | -            | Preferences         |

## Usage in Pages

### Accessing Router

```php
// Router is available in $GLOBALS['router']
$router = $GLOBALS['router'] ?? null;

if ($router) {
    $currentPage = $router->getCurrentPage();
    $params = $router->getParams();
    $fileParam = $router->getParam('file');
}
```

### Accessing Parameters

**Method 1: Via Router (Recommended)**
```php
$router = $GLOBALS['router'] ?? null;
$file = $router ? $router->getParam('file', '') : ($_GET['file'] ?? '');
```

**Method 2: Direct $_GET (Backward Compatible)**
```php
// Router sanitizes $_GET parameters, so this is safe
$file = $_GET['file'] ?? '';
```

## URL Generation

### Using Router Helper

```php
$router = $GLOBALS['router'] ?? null;
if ($router) {
    // Simple URL
    $url = $router->url('projects');
    // Result: index.php?page=projects
    
    // URL with parameters
    $url = $router->url('sites', ['file' => 'example.conf']);
    // Result: index.php?page=sites&file=example.conf
}
```

### Manual URL Generation

```php
// Simple
$url = 'index.php?page=projects';

// With parameters
$url = 'index.php?page=sites&file=' . urlencode('example.conf');
```

## Security Features

### Parameter Sanitization

- Null bytes removed
- Length limited to 255 characters
- Directory traversal prevented
- XSS prevention (pages should HTML encode on output)

### Route Validation

- Only registered routes are accessible
- Page names validated with regex: `/^[a-zA-Z0-9_-]+$/`
- File existence verified before inclusion

### 404 Handling

- Custom 404 page with i18n support
- Proper HTTP status code (404)
- User-friendly error message

## Adding New Routes

1. **Add route definition** in `Router::registerRoutes()`:

```php
'newpage' => [
    'file' => 'newpage.php',
    'title' => 'New Page',
    'requires_auth' => false,
    'params' => ['id'], // Optional
]
```

2. **Create page file** in `/pages/newpage.php`

3. **Add sidebar link** in `partials/sidebar.php`:

```php
<a href="index.php?page=newpage" class="<?php echo $currentPage === 'newpage' ? 'active' : ''; ?>">
```

## Examples

### Example 1: Simple Page

**Route Definition:**
```php
'tools' => [
    'file' => 'tools.php',
    'title' => 'Tools',
    'requires_auth' => false,
]
```

**Usage:**
```php
// URL: index.php?page=tools
// Router loads: pages/tools.php
```

### Example 2: Page with Parameters

**Route Definition:**
```php
'sites' => [
    'file' => 'sites.php',
    'title' => 'Sites Enabled',
    'requires_auth' => false,
    'params' => ['file'],
]
```

**Usage:**
```php
// URL: index.php?page=sites&file=example.conf
// Router sanitizes 'file' parameter
// Page accesses: $_GET['file'] or $router->getParam('file')
```

### Example 3: Accessing Router in Page

```php
<?php
// pages/example.php

// Get router instance
$router = $GLOBALS['router'] ?? null;

// Get current page
$currentPage = $router ? $router->getCurrentPage() : '';

// Get parameters
$id = $router ? $router->getParam('id', '') : ($_GET['id'] ?? '');

// Generate URL
$projectsUrl = $router ? $router->url('projects') : 'index.php?page=projects';
?>
```

## Migration Notes

### For Existing Pages

Existing pages continue to work without modification. The router:
- Sanitizes `$_GET` parameters automatically
- Makes router available via `$GLOBALS['router']`
- Maintains backward compatibility

### Recommended Updates

1. **Use Router for Parameter Access:**
   ```php
   // Old
   $file = $_GET['file'] ?? '';
   
   // New (recommended)
   $router = $GLOBALS['router'] ?? null;
   $file = $router ? $router->getParam('file', '') : ($_GET['file'] ?? '');
   ```

2. **Use Router for URL Generation:**
   ```php
   // Old
   $url = 'index.php?page=projects';
   
   // New (recommended)
   $router = $GLOBALS['router'] ?? null;
   $url = $router ? $router->url('projects') : 'index.php?page=projects';
   ```

## Testing

### Test Route Existence

```php
$router = new Router();
if ($router->routeExists('projects')) {
    echo "Route exists";
}
```

### Test Parameter Extraction

```php
$_GET['page'] = 'sites';
$_GET['file'] = 'example.conf';
$router = new Router();
$pageFile = $router->resolve();
$file = $router->getParam('file');
// $file should be sanitized 'example.conf'
```

## Future Enhancements

- [ ] Route aliases (e.g., `/dashboard` → `dashboard`)
- [ ] Route middleware/hooks
- [ ] Route caching
- [ ] RESTful API routes
- [ ] Route groups/namespaces

---

**Version:** 1.0.0  
**Last Updated:** 2024

