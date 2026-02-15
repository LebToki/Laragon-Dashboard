<?php

namespace LaragonDashboard\Core;

/**
 * Security Class
 * Version: 1.0.0
 * Handles Authentication and CSRF protection
 */
class Security {
    
    /**
     * Generate a CSRF token and store it in the session
     */
    public static function generateCSRFToken() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    /**
     * Get the current CSRF token
     */
    public static function getCSRFToken() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        return $_SESSION['csrf_token'] ?? self::generateCSRFToken();
    }

    /**
     * Verify a CSRF token
     */
    public static function verifyCSRFToken($token) {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Check if the user is authenticated
     */
    public static function isAuthenticated() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        
        if (defined('AUTH_ENABLED') && !AUTH_ENABLED) {
            return true;
        }
        
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
    }

    /**
     * Enforce authentication
     */
    public static function checkAuth() {
        if (!self::isAuthenticated()) {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                http_response_code(401);
                echo json_encode(['success' => false, 'error' => 'Authentication required']);
                exit;
            } else {
                header('Location: login.php');
                exit;
            }
        }
    }
}
