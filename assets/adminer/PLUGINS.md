# Adminer Plugins - Enhanced Features

This installation includes several useful Adminer plugins to enhance the database administration experience.

## Installed Plugins

### 1. **Frames** (`frames.php`)
Allows using Adminer inside an iframe, perfect for embedding in your dashboard or application.

**Benefits:**
- Embed Adminer seamlessly in your application
- No need to open in a new tab
- Maintains your application's navigation context

### 2. **Dark Switcher** (`dark-switcher.php`)
Adds a toggle to switch between light and dark themes.

**Benefits:**
- Better eye comfort in low-light environments
- Matches your application's theme preferences
- User preference persistence

### 3. **Dump ZIP** (`dump-zip.php`)
Export databases as compressed ZIP archives.

**Benefits:**
- Smaller file sizes for large databases
- Faster downloads
- Easier to share and backup

### 4. **Dump JSON** (`dump-json.php`)
Export database data in JSON format.

**Benefits:**
- Modern data interchange format
- Easy to parse programmatically
- Great for API integrations

### 5. **Tables Filter** (`tables-filter.php`)
Filter table names in the database list.

**Benefits:**
- Quick navigation in databases with many tables
- Search functionality
- Improved usability

### 6. **Edit Textarea** (`edit-textarea.php`)
Use `<textarea>` for `char` and `varchar` fields instead of single-line inputs.

**Benefits:**
- Better editing experience for longer text
- Multi-line editing support
- Improved data entry workflow

### 7. **Dump Date** (`dump-date.php`)
Include current date and time in export filenames.

**Benefits:**
- Automatic timestamping
- Better backup organization
- No manual filename management

## Adding More Plugins

To add additional plugins:

1. **Download the plugin** from [Adminer Plugins page](https://www.adminer.org/en/plugins/)
2. **Place it** in `assets/adminer/adminer-plugins/` directory
3. **Edit** `assets/adminer/adminer-plugins.php`:
   ```php
   require_once __DIR__ . '/adminer-plugins/your-plugin.php';
   
   return array(
       // ... existing plugins ...
       new YourPluginClass(),
   );
   ```

## Recommended Additional Plugins

Consider adding these plugins for even more functionality:

- **highlight-monaco**: VS Code's Monaco Editor for SQL syntax highlighting
- **dump-xml**: Export to XML format
- **edit-foreign**: Select foreign keys in edit forms
- **enum-option**: Use dropdowns for enum fields
- **file-upload**: Upload files for fields ending with `_path`
- **sql-wizard**: AI-powered SQL query generation
- **login-servers**: Display predefined server list

## Plugin Management via Code

```php
require_once 'includes/AdminerModule.php';

$adminer = new AdminerModule();

// Get available plugins
$plugins = $adminer->getAvailablePlugins();

// Enable specific plugins
$adminer->setPlugins(['frames', 'dark-switcher', 'dump-zip']);

// Disable default plugins
$adminer = new AdminerModule([
    'enable_default_plugins' => false,
    'plugins' => ['frames'] // Only enable frames
]);
```

## Plugin Documentation

For complete plugin documentation and more plugins, visit:
- [Official Adminer Plugins Page](https://www.adminer.org/en/plugins/)
- [Adminer GitHub Repository](https://github.com/vrana/adminer)

