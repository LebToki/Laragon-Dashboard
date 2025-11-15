<?php
/**
 * Adminer Module - Standalone Database Administration Tool
 * Version: 1.0.0
 * Description: Reusable Adminer integration module for database management
 * 
 * This module can be integrated into any PHP application by:
 * 1. Including this file
 * 2. Configuring database credentials
 * 3. Calling AdminerModule::getUrl() or AdminerModule::render()
 * 
 * Usage:
 *   $adminer = new AdminerModule([
 *       'mysql_host' => 'localhost',
 *       'mysql_user' => 'root',
 *       'mysql_password' => '',
 *       'base_path' => '/assets/adminer',
 *       'theme_css' => '/assets/adminer/adminer-theme.css'
 *   ]);
 *   echo $adminer->render();
 */

class AdminerModule {
    private $config;
    private $defaultConfig = [
        'mysql_host' => 'localhost',
        'mysql_user' => 'root',
        'mysql_password' => '',
        'base_path' => 'assets/adminer',
        'adminer_file' => 'adminer.php',
        'theme_css' => 'adminer-theme.css',
        'auto_login' => false,
        'embed_mode' => false,
        'download_url' => 'https://www.adminer.org/latest-mysql.php',
        'version' => '5.4.1',
        'plugins' => [], // Array of plugin names to enable
        'plugins_dir' => 'adminer-plugins',
        'enable_default_plugins' => true // Auto-enable useful plugins
    ];
    
    /**
     * Constructor
     * @param array $config Configuration options
     */
    public function __construct(array $config = []) {
        $this->config = array_merge($this->defaultConfig, $config);
        
        // Auto-detect MySQL credentials from constants if available
        if (defined('MYSQL_HOST')) {
            $this->config['mysql_host'] = MYSQL_HOST;
        }
        if (defined('MYSQL_USER')) {
            $this->config['mysql_user'] = MYSQL_USER;
        }
        if (defined('MYSQL_PASSWORD')) {
            $this->config['mysql_password'] = MYSQL_PASSWORD;
        }
        
        // Auto-detect base path if not provided
        if (empty($this->config['base_path']) || $this->config['base_path'] === 'assets/adminer') {
            $this->config['base_path'] = $this->detectBasePath();
        }
    }
    
    /**
     * Detect base path for Adminer installation
     */
    private function detectBasePath() {
        // Use ASSETS_URL if available (from config.php)
        if (defined('ASSETS_URL')) {
            return rtrim(ASSETS_URL, '/') . '/adminer';
        }
        
        // Try common locations
        $possiblePaths = [
            __DIR__ . '/../assets/adminer',
            __DIR__ . '/../../assets/adminer',
            dirname($_SERVER['SCRIPT_FILENAME'] ?? __DIR__) . '/assets/adminer'
        ];
        
        foreach ($possiblePaths as $path) {
            $normalized = str_replace('\\', '/', $path);
            if (is_dir($normalized)) {
                // Return relative path from document root
                $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
                if (stripos($normalized, $docRoot) === 0) {
                    $relativePath = substr($normalized, strlen($docRoot));
                    // Ensure it starts with / and doesn't have double slashes
                    return '/' . ltrim($relativePath, '/');
                }
                return $normalized;
            }
        }
        
        return 'assets/adminer';
    }
    
    /**
     * Check if Adminer is installed
     */
    public function isInstalled() {
        $adminerPath = $this->getAdminerPath();
        return file_exists($adminerPath);
    }
    
    /**
     * Get full path to Adminer file
     */
    public function getAdminerPath() {
        $basePath = $this->config['base_path'];
        
        // If base_path is relative, make it absolute
        if (!file_exists($basePath)) {
            $docRoot = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT'] ?? '');
            $basePath = rtrim($docRoot, '/') . '/' . ltrim($basePath, '/');
        }
        
        return rtrim(str_replace('\\', '/', $basePath), '/') . '/' . $this->config['adminer_file'];
    }
    
    /**
     * Get URL to Adminer
     */
    public function getUrl($database = null) {
        $basePath = $this->config['base_path'];
        
        // If it's already a full URL, return it
        if (strpos($basePath, 'http') === 0) {
            $url = rtrim($basePath, '/') . '/' . $this->config['adminer_file'];
        } elseif (strpos($basePath, '/') === 0) {
            // If base_path already starts with /, use it directly
            $url = rtrim($basePath, '/') . '/' . $this->config['adminer_file'];
        } else {
            // Otherwise, prepend / to make it relative to web root
            $url = '/' . rtrim($basePath, '/') . '/' . $this->config['adminer_file'];
        }
        
        // Add auto-login parameters
        $params = [];
        if (defined('MYSQL_HOST')) {
            $params['server'] = MYSQL_HOST;
        }
        if (defined('MYSQL_USER')) {
            $params['username'] = MYSQL_USER;
        }
        if ($database) {
            $params['db'] = $database;
        }
        
        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        
        return $url;
    }
    
    /**
     * Get theme CSS URL
     */
    public function getThemeUrl() {
        $basePath = $this->config['base_path'];
        
        // If it's already a full URL, return it
        if (strpos($basePath, 'http') === 0) {
            return rtrim($basePath, '/') . '/' . $this->config['theme_css'];
        }
        
        // Use BASE_URL if available (from config.php)
        if (defined('BASE_URL')) {
            $baseUrl = BASE_URL;
        } else {
            // Fallback: use relative path from web root
            $baseUrl = '';
        }
        
        // Ensure base_path is relative (remove leading slash if present)
        $basePath = ltrim($basePath, '/');
        
        // Build URL
        if ($baseUrl) {
            return rtrim($baseUrl, '/') . '/' . $basePath . '/' . $this->config['theme_css'];
        } else {
            return '/' . $basePath . '/' . $this->config['theme_css'];
        }
    }
    
    /**
     * Download Adminer if not installed
     */
    public function download() {
        if ($this->isInstalled()) {
            return ['success' => true, 'message' => 'Adminer already installed'];
        }
        
        $adminerPath = $this->getAdminerPath();
        $adminerDir = dirname($adminerPath);
        
        // Create directory if it doesn't exist
        if (!is_dir($adminerDir)) {
            @mkdir($adminerDir, 0755, true);
        }
        
        // Download Adminer
        $url = $this->config['download_url'];
        $content = @file_get_contents($url);
        
        if ($content === false) {
            // Try with cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            $content = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode !== 200 || empty($content)) {
                return ['success' => false, 'error' => 'Failed to download Adminer'];
            }
        }
        
        // Save file
        if (@file_put_contents($adminerPath, $content) === false) {
            return ['success' => false, 'error' => 'Failed to save Adminer file'];
        }
        
        // Setup default plugins if enabled
        if ($this->config['enable_default_plugins']) {
            $this->setupDefaultPlugins();
        }
        
        return ['success' => true, 'message' => 'Adminer downloaded successfully', 'path' => $adminerPath];
    }
    
    /**
     * Setup default useful plugins
     */
    private function setupDefaultPlugins() {
        $pluginsDir = dirname($this->getAdminerPath()) . '/' . $this->config['plugins_dir'];
        
        if (!is_dir($pluginsDir)) {
            @mkdir($pluginsDir, 0755, true);
        }
        
        // List of useful plugins to download
        $defaultPlugins = [
            'frames' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/frames.php',
            'dark-switcher' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/dark-switcher.php',
            'dump-zip' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/dump-zip.php',
            'dump-json' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/dump-json.php',
            'tables-filter' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/tables-filter.php',
            'edit-textarea' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/edit-textarea.php',
            'dump-date' => 'https://raw.githubusercontent.com/vrana/adminer/master/plugins/dump-date.php',
        ];
        
        foreach ($defaultPlugins as $pluginName => $pluginUrl) {
            $pluginPath = $pluginsDir . '/' . $pluginName . '.php';
            if (!file_exists($pluginPath)) {
                $this->downloadPlugin($pluginUrl, $pluginPath);
            }
        }
        
        // Create adminer-plugins.php configuration file
        $this->createPluginsConfig($pluginsDir);
    }
    
    /**
     * Download a plugin
     */
    private function downloadPlugin($url, $path) {
        $content = @file_get_contents($url);
        
        if ($content === false) {
            // Try with cURL
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
            $content = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode !== 200 || empty($content)) {
                return false;
            }
        }
        
        return @file_put_contents($path, $content) !== false;
    }
    
    /**
     * Create adminer-plugins.php configuration file
     */
    private function createPluginsConfig($pluginsDir) {
        $configFile = dirname($pluginsDir) . '/adminer-plugins.php';
        
        // Don't overwrite existing config
        if (file_exists($configFile)) {
            return;
        }
        
        $plugins = $this->config['plugins'];
        if (empty($plugins) && $this->config['enable_default_plugins']) {
            // Enable default plugins
            $plugins = ['frames', 'dark-switcher', 'dump-zip', 'dump-json', 'tables-filter', 'edit-textarea', 'dump-date'];
        }
        
        $phpCode = "<?php\n";
        $phpCode .= "// Adminer Plugins Configuration\n";
        $phpCode .= "// Auto-generated by AdminerModule\n\n";
        
        // Generate require_once statements
        foreach ($plugins as $plugin) {
            $pluginFile = $pluginsDir . '/' . $plugin . '.php';
            if (file_exists($pluginFile)) {
                $phpCode .= "require_once __DIR__ . '/" . $this->config['plugins_dir'] . '/' . $plugin . ".php';\n";
            }
        }
        
        $phpCode .= "\n// Return array of plugin instances\n";
        $phpCode .= "return array(\n";
        
        // Generate plugin class instances
        foreach ($plugins as $plugin) {
            $pluginFile = $pluginsDir . '/' . $plugin . '.php';
            if (file_exists($pluginFile)) {
                // Convert plugin name to class name (e.g., 'dark-switcher' -> 'AdminerDarkSwitcher')
                $className = 'Adminer' . str_replace(' ', '', ucwords(str_replace('-', ' ', $plugin)));
                $phpCode .= "    new " . $className . "(),\n";
            }
        }
        
        $phpCode .= ");\n";
        
        @file_put_contents($configFile, $phpCode);
    }
    
    /**
     * Get list of available plugins
     */
    public function getAvailablePlugins() {
        $pluginsDir = dirname($this->getAdminerPath()) . '/' . $this->config['plugins_dir'];
        
        if (!is_dir($pluginsDir)) {
            return [];
        }
        
        $plugins = [];
        $files = glob($pluginsDir . '/*.php');
        
        foreach ($files as $file) {
            $pluginName = basename($file, '.php');
            $plugins[] = [
                'name' => $pluginName,
                'file' => basename($file),
                'path' => $file,
                'enabled' => $this->isPluginEnabled($pluginName)
            ];
        }
        
        return $plugins;
    }
    
    /**
     * Check if a plugin is enabled
     */
    private function isPluginEnabled($pluginName) {
        $configFile = dirname($this->getAdminerPath()) . '/adminer-plugins.php';
        
        if (!file_exists($configFile)) {
            return false;
        }
        
        $content = @file_get_contents($configFile);
        return strpos($content, $pluginName . '.php') !== false;
    }
    
    /**
     * Enable/disable plugins
     */
    public function setPlugins(array $pluginNames) {
        $this->config['plugins'] = $pluginNames;
        $pluginsDir = dirname($this->getAdminerPath()) . '/' . $this->config['plugins_dir'];
        $this->createPluginsConfig($pluginsDir);
        return ['success' => true, 'message' => 'Plugins updated'];
    }
    
    /**
     * Render Adminer link/button
     */
    public function render($options = []) {
        $defaultOptions = [
            'button_class' => 'btn btn-sm btn-primary',
            'button_text' => 'Open Database Admin',
            'icon' => 'solar:database-bold',
            'show_status' => true,
            'embed' => false
        ];
        
        $options = array_merge($defaultOptions, $options);
        
        $installed = $this->isInstalled();
        $url = $this->getUrl();
        $themeUrl = $this->getThemeUrl();
        
        if (!$installed) {
            return $this->renderDownloadPrompt($options);
        }
        
        if ($options['embed']) {
            return $this->renderEmbedded($url, $themeUrl);
        }
        
        $html = '<a href="' . htmlspecialchars($url) . '" target="_blank" class="' . htmlspecialchars($options['button_class']) . '">';
        
        if (!empty($options['icon'])) {
            $html .= '<iconify-icon icon="' . htmlspecialchars($options['icon']) . '" class="icon"></iconify-icon> ';
        }
        
        $html .= htmlspecialchars($options['button_text']);
        $html .= '</a>';
        
        if ($options['show_status']) {
            $html .= '<p class="text-xs text-secondary-light mt-8 mb-0">Database administration tool ready</p>';
        }
        
        return $html;
    }
    
    /**
     * Render download prompt
     */
    private function renderDownloadPrompt($options) {
        $html = '<a href="' . htmlspecialchars($this->config['download_url']) . '" target="_blank" class="' . htmlspecialchars($options['button_class']) . '">';
        $html .= '<iconify-icon icon="solar:download-bold" class="icon"></iconify-icon> ';
        $html .= 'Download Adminer';
        $html .= '</a>';
        $html .= '<p class="text-xs text-secondary-light mt-8 mb-0">Download and extract to: ' . htmlspecialchars($this->config['base_path']) . '</p>';
        
        return $html;
    }
    
    /**
     * Render embedded Adminer in iframe
     */
    private function renderEmbedded($url, $themeUrl) {
        $html = '<iframe src="' . htmlspecialchars($url) . '" style="width: 100%; height: 800px; border: none; border-radius: 12px;" class="shadow-none"></iframe>';
        $html .= '<link rel="stylesheet" href="' . htmlspecialchars($themeUrl) . '">';
        
        return $html;
    }
    
    /**
     * Get configuration
     */
    public function getConfig() {
        return $this->config;
    }
    
    /**
     * Static helper: Quick check if Adminer is available
     */
    public static function check($basePath = 'assets/adminer') {
        $instance = new self(['base_path' => $basePath]);
        return $instance->isInstalled();
    }
    
    /**
     * Static helper: Quick URL generation
     */
    public static function url($basePath = 'assets/adminer') {
        $instance = new self(['base_path' => $basePath]);
        return $instance->getUrl();
    }
}

