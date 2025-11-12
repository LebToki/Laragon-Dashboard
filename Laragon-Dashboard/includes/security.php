<?php
/**
 * Security Helper for Laragon Dashboard
 * Provides security headers, CSRF protection, and input sanitization
 */

require_once __DIR__ . '/../config.php';

class SecurityHelper {
    private static $csrfToken = null;
    
    public static function init() {
        // Set security headers
        self::setSecurityHeaders();
        
        // Initialize CSRF protection
        self::initCSRF();
        
        // Start secure session
        self::startSecureSession();
    }
    
    private static function setSecurityHeaders() {
        // Prevent clickjacking
        header('X-Frame-Options: DENY');
        
        // Prevent MIME type sniffing
        header('X-Content-Type-Options: nosniff');
        
        // Enable XSS protection
        header('X-XSS-Protection: 1; mode=block');
        
        // Strict Transport Security (if HTTPS)
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }
        
        // Content Security Policy
        header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://code.jquery.com https://cdnjs.cloudflare.com; style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com https://cdn.jsdelivr.net; img-src 'self' data:; connect-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com;");
        
        // Referrer Policy
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
    
    private static function initCSRF() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        self::$csrfToken = $_SESSION['csrf_token'];
    }
    
    private static function startSecureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            // Secure session configuration
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 1 : 0);
            ini_set('session.use_strict_mode', 1);
            ini_set('session.cookie_samesite', 'Strict');
            
            session_start();
        }
    }
    
    public static function getCSRFToken() {
        return self::$csrfToken;
    }
    
    public static function validateCSRF($token) {
        return hash_equals(self::$csrfToken, $token);
    }
    
    public static function sanitizeInput($input) {
        if (is_array($input)) {
            return array_map([self::class, 'sanitizeInput'], $input);
        }
        
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function validateUrl($url) {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
    
    public static function rateLimit($key, $maxAttempts = 10, $timeWindow = 300) {
        $rateLimitFile = __DIR__ . '/../logs/rate_limit.json';
        
        if (!file_exists($rateLimitFile)) {
            file_put_contents($rateLimitFile, '{}');
        }
        
        $rateData = json_decode(file_get_contents($rateLimitFile), true);
        $currentTime = time();
        
        // Clean old entries
        foreach ($rateData as $k => $data) {
            if ($currentTime - $data['last_attempt'] > $timeWindow) {
                unset($rateData[$k]);
            }
        }
        
        // Check current key
        if (!isset($rateData[$key])) {
            $rateData[$key] = ['count' => 0, 'last_attempt' => $currentTime];
        }
        
        if ($currentTime - $rateData[$key]['last_attempt'] > $timeWindow) {
            $rateData[$key] = ['count' => 0, 'last_attempt' => $currentTime];
        }
        
        $rateData[$key]['count']++;
        $rateData[$key]['last_attempt'] = $currentTime;
        
        file_put_contents($rateLimitFile, json_encode($rateData));
        
        return $rateData[$key]['count'] <= $maxAttempts;
    }
    
    public static function generateSecurePassword($length = 12) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*';
        return substr(str_shuffle($chars), 0, $length);
    }
    
    public static function validateRequest() {
        // Basic request validation
        // Check if request is from same origin (for API endpoints)
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $host = $_SERVER['HTTP_HOST'] ?? '';
        
        // Allow requests from same host
        if (!empty($referer) && strpos($referer, $host) === false) {
            return false;
        }
        
        // Rate limiting check
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        return self::rateLimit($ip, 100, 60); // 100 requests per minute
    }
}

// Initialize security
SecurityHelper::init();
?>
