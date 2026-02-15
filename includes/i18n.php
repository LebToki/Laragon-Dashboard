<?php
/**
 * i18n Translation Helper for Laragon Dashboard
 * Loads translation files per module with fallback chain (lang → en)
 * Provides t() function for UI translations
 * Version: 3.0.0
 */

// Prevent multiple inclusions - guard against the function being declared elsewhere
if (function_exists('t')) {
    // Function already exists, don't redefine - just return early
    return;
}

if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

// Initialize session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current language from session, cookie, GET parameter, or default to 'en'
function get_current_language(): string {
    // Check GET parameter first (for language switcher)
    if (isset($_GET['lang']) && !empty($_GET['lang'])) {
        $lang = strtolower($_GET['lang']);
        set_current_language($lang);
        return $lang;
    }
    
    // Check session
    if (isset($_SESSION['lang']) && !empty($_SESSION['lang'])) {
        return strtolower($_SESSION['lang']);
    }
    
    // Check cookie
    if (isset($_COOKIE['lang']) && !empty($_COOKIE['lang'])) {
        return strtolower($_COOKIE['lang']);
    }
    
    // Default to English
    return 'en';
}

// Set current language in session and cookie
function set_current_language(string $lang): void {
    $lang = strtolower($lang);
    
    // Validate language (check against languages.php)
    $langConfigFile = APP_ROOT . '/i18n/languages.php';
    if (file_exists($langConfigFile)) {
        $langConfig = require $langConfigFile;
        if (!isset($langConfig[$lang])) {
            $lang = 'en'; // Fallback to English if invalid
        }
    }
    
    $_SESSION['lang'] = $lang;
    
    // Only set cookie if headers haven't been sent yet
    if (!headers_sent()) {
        setcookie('lang', $lang, time() + (365 * 24 * 60 * 60), '/'); // 1 year
    }
}

// Translation cache (module => [lang => translations])
$i18n_cache = [];

/**
 * Load translations for a module
 * @param string $module Module name (e.g., 'services', 'databases', 'common')
 * @param string|null $lang Language code (auto-detected if null)
 * @return array Translation key-value pairs
 */
function load_translations(string $module, ?string $lang = null): array {
    global $i18n_cache;
    
    if ($lang === null) {
        $lang = get_current_language();
    }
    
    // Check cache first
    $cacheKey = $module . '_' . $lang;
    if (isset($i18n_cache[$cacheKey])) {
        return $i18n_cache[$cacheKey];
    }
    
    $translations = [];
    
    // Fallback chain: requested lang → en
    $fallbackChain = [$lang, 'en'];
    
    $basePath = APP_ROOT . '/i18n';
    
    // Load common translations first (shared across all modules)
    if ($module !== 'common') {
        $commonTranslations = load_translations('common', $lang);
        $translations = array_merge($translations, $commonTranslations);
    }
    
    // Try each language in fallback chain
    foreach ($fallbackChain as $tryLang) {
        $filePath = $basePath . '/' . $module . '/' . $tryLang . '.json';
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                // Merge with existing (later fallbacks override earlier)
                $translations = array_merge($translations, $decoded);
            }
            // If we found the primary language file, stop here
            if ($tryLang === $lang) {
                break;
            }
        }
    }
    
    // Cache result
    $i18n_cache[$cacheKey] = $translations;
    
    return $translations;
}

/**
 * Get nested value from array using dot notation (e.g., 'dashboard.title')
 * @param array $array The array to search
 * @param string $key Dot-notation key (e.g., 'dashboard.title')
 * @param mixed $default Default value if key not found
 * @return mixed The value or default
 */
function array_get_nested(array $array, string $key, $default = null) {
    if (isset($array[$key])) {
        return $array[$key];
    }
    
    // Handle nested keys with dot notation
    if (strpos($key, '.') !== false) {
        $keys = explode('.', $key);
        $value = $array;
        
        foreach ($keys as $segment) {
            if (is_array($value) && isset($value[$segment])) {
                $value = $value[$segment];
            } else {
                return $default;
            }
        }
        
        return $value;
    }
    
    return $default;
}

/**
 * Translate a key (with optional parameters for sprintf)
 * @param string $key Translation key (can be dot-notation like 'module.key' or 'module.nested.key')
 * @param mixed ...$args Optional arguments for sprintf formatting
 * @return string Translated text or key if not found
 */
if (!function_exists('t')) {
    function t(string $key, ...$args): string {
    // Auto-detect module from key if dot-notation is used
    $module = 'common';
    $translationKey = $key;
    
    if (strpos($key, '.') !== false) {
        // Split on first dot: module.key or module.nested.key
        $parts = explode('.', $key, 2);
        $module = $parts[0];
        $translationKey = $parts[1] ?? $key;
    }
    
    $translations = load_translations($module);
    
    // Support nested keys (e.g., 'dashboard.title' in JSON structure)
    $text = array_get_nested($translations, $translationKey, $key);
    
    // Apply sprintf if arguments provided
    if (!empty($args)) {
        $text = sprintf($text, ...$args);
    }
    
    return $text;
}
}

/**
 * Get direction (RTL for Arabic, LTR for others)
 */
function get_text_direction(): string {
    $lang = get_current_language();
    return ($lang === 'ar') ? 'rtl' : 'ltr';
}

/**
 * Check if current language is RTL
 */
function is_rtl(): bool {
    return get_current_language() === 'ar';
}

// Initialize language from request if set (only if headers haven't been sent)
if (!headers_sent() && isset($_GET['lang']) && !empty($_GET['lang'])) {
    set_current_language($_GET['lang']);
}

