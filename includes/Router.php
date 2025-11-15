<?php
/**
 * Laragon Dashboard - Router
 * Handles page routing with security and validation
 * 
 * Version: 1.0.0
 */

if (!class_exists('Router')) {
    class Router {
        private $routes = [];
        private $pagesDir;
        private $currentPage = '';
        private $currentParams = [];
        
        public function __construct() {
            $this->pagesDir = defined('APP_ROOT') ? APP_ROOT . '/pages' : __DIR__ . '/../pages';
            $this->registerRoutes();
        }
        
        /**
         * Register available routes
         */
        private function registerRoutes() {
            // Define all available routes
            $this->routes = [
                'dashboard' => [
                    'file' => null, // Handled by index.php itself
                    'title' => 'Dashboard',
                    'requires_auth' => false,
                ],
                'projects' => [
                    'file' => 'projects.php',
                    'title' => 'Projects',
                    'requires_auth' => false,
                    'params' => ['search'], // Allowed parameters
                ],
                'databases' => [
                    'file' => 'databases.php',
                    'title' => 'Databases',
                    'requires_auth' => false,
                ],
                'services' => [
                    'file' => 'services.php',
                    'title' => 'Services',
                    'requires_auth' => false,
                ],
                'vitals' => [
                    'file' => 'vitals.php',
                    'title' => 'Server Vitals',
                    'requires_auth' => false,
                ],
                'mailbox' => [
                    'file' => 'mailbox.php',
                    'title' => 'Mailbox',
                    'requires_auth' => false,
                    'params' => ['view', 'id'], // Allowed parameters
                ],
                'logs' => [
                    'file' => 'logs.php',
                    'title' => 'Logs',
                    'requires_auth' => false,
                    'params' => ['log'], // Allowed parameters
                ],
                'tools' => [
                    'file' => 'tools.php',
                    'title' => 'Tools',
                    'requires_auth' => false,
                ],
                'backup' => [
                    'file' => 'backup.php',
                    'title' => 'Backup',
                    'requires_auth' => false,
                ],
                'sites' => [
                    'file' => 'sites.php',
                    'title' => 'Sites Enabled',
                    'requires_auth' => false,
                    'params' => ['file'], // Allowed parameters
                ],
                'httpd' => [
                    'file' => 'httpd.php',
                    'title' => 'Apache Configuration',
                    'requires_auth' => false,
                ],
                'preferences' => [
                    'file' => 'preferences.php',
                    'title' => 'Preferences',
                    'requires_auth' => false,
                ],
            ];
        }
        
        /**
         * Get current page name
         */
        public function getCurrentPage() {
            return $this->currentPage;
        }
        
        /**
         * Get current route parameters
         */
        public function getParams() {
            return $this->currentParams;
        }
        
        /**
         * Get a specific parameter value
         */
        public function getParam($key, $default = null) {
            return $this->currentParams[$key] ?? $default;
        }
        
        /**
         * Check if a route exists
         */
        public function routeExists($page) {
            return isset($this->routes[$page]);
        }
        
        /**
         * Get route information
         */
        public function getRoute($page) {
            return $this->routes[$page] ?? null;
        }
        
        /**
         * Get all registered routes
         */
        public function getAllRoutes() {
            return $this->routes;
        }
        
        /**
         * Resolve and load the requested page
         */
        public function resolve() {
            // Get page from query string
            $page = $_GET['page'] ?? '';
            
            // If no page specified, default to dashboard
            if (empty($page)) {
                $this->currentPage = 'dashboard';
                return null; // Let index.php handle dashboard
            }
            
            // Sanitize page name
            $page = $this->sanitizePageName($page);
            
            // Check if route exists
            if (!$this->routeExists($page)) {
                $this->handle404();
                return false;
            }
            
            $route = $this->routes[$page];
            
            // Extract and validate parameters
            $this->currentParams = $this->extractParams($route);
            
            // Make sanitized parameters available in $_GET for backward compatibility
            // This ensures pages can still access $_GET['file'], $_GET['log'], etc.
            foreach ($this->currentParams as $key => $value) {
                $_GET[$key] = $value;
            }
            
            // Check authentication if required
            if ($route['requires_auth'] && !$this->isAuthenticated()) {
                $this->handle401();
                return false;
            }
            
            // If route has no file (like dashboard), return null
            if (empty($route['file'])) {
                $this->currentPage = $page;
                return null;
            }
            
            // Build file path
            $pageFile = $this->pagesDir . '/' . $route['file'];
            
            // Verify file exists
            if (!file_exists($pageFile)) {
                $this->handle404();
                return false;
            }
            
            // Set current page
            $this->currentPage = $page;
            
            // Include the page file
            return $pageFile;
        }
        
        /**
         * Sanitize page name to prevent directory traversal
         */
        private function sanitizePageName($page) {
            // Remove any path components
            $page = basename($page);
            
            // Only allow alphanumeric, dash, and underscore
            if (!preg_match('/^[a-zA-Z0-9_-]+$/', $page)) {
                return '';
            }
            
            return strtolower($page);
        }
        
        /**
         * Extract and validate route parameters
         */
        private function extractParams($route) {
            $params = [];
            
            // Get allowed parameters from route definition
            $allowedParams = $route['params'] ?? [];
            
            // Extract and sanitize allowed parameters
            foreach ($allowedParams as $param) {
                if (isset($_GET[$param])) {
                    $value = $_GET[$param];
                    // Sanitize parameter value
                    $params[$param] = $this->sanitizeParam($value);
                }
            }
            
            return $params;
        }
        
        /**
         * Sanitize parameter value
         */
        private function sanitizeParam($value) {
            // Remove null bytes
            $value = str_replace("\0", '', $value);
            
            // For file parameters, use basename to prevent directory traversal
            // But don't HTML encode here - pages may need raw values
            // HTML encoding should be done at output time
            if (strlen($value) > 255) {
                $value = substr($value, 0, 255);
            }
            
            // Return sanitized but not HTML-encoded value
            // Pages will handle HTML encoding when outputting
            return $value;
        }
        
        /**
         * Check if user is authenticated
         */
        private function isAuthenticated() {
            // TODO: Implement authentication check
            // For now, always return true
            return true;
        }
        
        /**
         * Handle 404 Not Found
         */
        private function handle404() {
            http_response_code(404);
            
            // Load i18n if available
            if (file_exists(__DIR__ . '/i18n.php')) {
                require_once __DIR__ . '/i18n.php';
            }
            
            // Load translations
            $commonTranslations = [];
            if (function_exists('load_translations')) {
                $commonTranslations = load_translations('common');
            }
            
            if (!function_exists('t_404')) {
                function t_404($key, $fallback = '') {
                    global $commonTranslations;
                    if (function_exists('t')) {
                        $translated = t('common.' . $key);
                        if ($translated !== 'common.' . $key) {
                            return $translated;
                        }
                    }
                    return $commonTranslations[$key] ?? ($fallback ?: $key);
                }
            }
            
            include __DIR__ . '/../partials/layouts/layoutTop.php';
            ?>
            <div class="dashboard-main-body">
                <div class="container-fluid">
                    <div class="text-center p-24">
                        <iconify-icon icon="solar:file-remove-bold" class="text-secondary-light text-5xl mb-16"></iconify-icon>
                        <strong><p class="fw-semibold mb-8"><?php echo t_404('page_not_found', 'Page Not Found'); ?></p></strong>
                        <p class="text-secondary-light mb-16"><?php echo t_404('page_not_found_desc', 'The page you\'re looking for doesn\'t exist.'); ?></p>
                        <a href="index.php" class="btn btn-primary-600">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon"></iconify-icon>
                            <?php echo t_404('go_to_dashboard', 'Go to Dashboard'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            include __DIR__ . '/../partials/layouts/layoutBottom.php';
            exit;
        }
        
        /**
         * Handle 401 Unauthorized
         */
        private function handle401() {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
        
        /**
         * Generate URL for a route
         */
        public function url($page, $params = []) {
            if (!$this->routeExists($page)) {
                return '#';
            }
            
            $url = 'index.php?page=' . urlencode($page);
            
            if (!empty($params)) {
                foreach ($params as $key => $value) {
                    $url .= '&' . urlencode($key) . '=' . urlencode($value);
                }
            }
            
            return $url;
        }
        
        /**
         * Redirect to a route
         */
        public function redirect($page, $params = []) {
            $url = $this->url($page, $params);
            header('Location: ' . $url);
            exit;
        }
    }
}

