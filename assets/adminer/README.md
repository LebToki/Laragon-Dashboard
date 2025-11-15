# Adminer Module - Standalone Database Administration Tool

A reusable, standalone module for integrating Adminer into any PHP application.

## Features

- ✅ Single-file installation (~400KB)
- ✅ Automatic download and installation
- ✅ Themed CSS matching your application design
- ✅ Configurable database credentials
- ✅ Easy integration into any PHP app
- ✅ No external dependencies

## Quick Start

### 1. Include the Module

```php
require_once 'includes/AdminerModule.php';

// Create instance with default config (auto-detects MySQL credentials from constants)
$adminer = new AdminerModule();

// Or customize configuration
$adminer = new AdminerModule([
    'mysql_host' => 'localhost',
    'mysql_user' => 'root',
    'mysql_password' => '',
    'base_path' => 'assets/adminer',
    'theme_css' => 'adminer.css'
]);
```

### 2. Check Installation

```php
if ($adminer->isInstalled()) {
    $url = $adminer->getUrl();
    echo '<a href="' . htmlspecialchars($url) . '">Open Database Admin</a>';
} else {
    // Auto-download
    $result = $adminer->download();
    if ($result['success']) {
        echo 'Adminer installed!';
    }
}
```

### 3. Render Button/Link

```php
// Simple render
echo $adminer->render();

// Custom render
echo $adminer->render([
    'button_class' => 'btn btn-primary',
    'button_text' => 'Manage Database',
    'icon' => 'solar:database-bold',
    'show_status' => true
]);
```

## Static Helpers

For quick integration without creating an instance:

```php
// Check if installed
if (AdminerModule::check('assets/adminer')) {
    // Get URL
    $url = AdminerModule::url('assets/adminer');
    echo '<a href="' . htmlspecialchars($url) . '">Open Adminer</a>';
}
```

## Configuration Options

| Option           | Default                                      | Description                                  |
|------------------|----------------------------------------------|----------------------------------------------|
| `mysql_host`     | `'localhost'`                                | MySQL server hostname                        |
| `mysql_user`     | `'root'`                                     | MySQL username                               |
| `mysql_password` | `''`                                         | MySQL password                               |
| `base_path`      | `'assets/adminer'`                           | Directory path for Adminer files             |
| `adminer_file`   | `'adminer.php'`                              | Adminer PHP filename                         |
| `theme_css`      | `'adminer.css'`                              | Theme CSS filename                           |
| `download_url`   | `'https://www.adminer.org/latest-mysql.php'` | Download URL                                 |
| `auto_login`     | `false`                                      | Auto-login with credentials (future feature) |
| `embed_mode`     | `false`                                      | Embed in iframe (future feature)             |

## Auto-Detection

The module automatically detects MySQL credentials from:
1. Constants: `MYSQL_HOST`, `MYSQL_USER`, `MYSQL_PASSWORD`
2. Configuration array passed to constructor
3. Default values (localhost/root/empty)

## Theming

The module includes a themed CSS file (`adminer.css`) that matches common dashboard designs. The theme:

- Uses CSS custom properties for easy customization
- Supports dark mode via `prefers-color-scheme`
- Matches modern UI patterns (rounded corners, shadows, gradients)
- Responsive design

To customize the theme, edit `assets/adminer/adminer.css` or create your own theme file.

## Integration Examples

### Laravel

```php
// In routes/web.php or a controller
use AdminerModule;

Route::get('/admin/database', function () {
    $adminer = new AdminerModule([
        'mysql_host' => config('database.connections.mysql.host'),
        'mysql_user' => config('database.connections.mysql.username'),
        'mysql_password' => config('database.connections.mysql.password'),
    ]);
    
    if (!$adminer->isInstalled()) {
        $adminer->download();
    }
    
    return redirect($adminer->getUrl());
});
```

### WordPress Plugin

```php
add_action('admin_menu', function() {
    add_menu_page(
        'Database Admin',
        'Database',
        'manage_options',
        'database-admin',
        function() {
            require_once plugin_dir_path(__FILE__) . 'includes/AdminerModule.php';
            $adminer = new AdminerModule([
                'mysql_host' => DB_HOST,
                'mysql_user' => DB_USER,
                'mysql_password' => DB_PASSWORD,
            ]);
            
            if (!$adminer->isInstalled()) {
                $adminer->download();
            }
            
            echo '<iframe src="' . esc_url($adminer->getUrl()) . '" style="width:100%;height:800px;border:none;"></iframe>';
        }
    );
});
```

### Standalone PHP App

```php
<?php
require_once 'includes/AdminerModule.php';

$adminer = new AdminerModule();

if (!$adminer->isInstalled()) {
    $result = $adminer->download();
    if (!$result['success']) {
        die('Failed to install Adminer: ' . $result['error']);
    }
}

header('Location: ' . $adminer->getUrl());
exit;
```

## File Structure

```
assets/adminer/
├── adminer.php          # Adminer application (downloaded)
├── adminer.css          # Theme CSS (auto-loaded by Adminer)
├── adminer-theme.css    # Source theme file
└── README.md           # This file
```

## Security Notes

- Adminer is designed for local/development use
- Consider IP whitelisting for production
- Use password protection at web server level
- Keep Adminer updated (check version notifications)

## License

- Adminer: Apache License 2.0 or GPL 2
- This module: Same as your application

## Support

- Adminer: https://www.adminer.org/
- Module Issues: Report to your application repository

