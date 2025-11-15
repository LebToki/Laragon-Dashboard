<?php

/**
 * Auto-login plugin for Adminer
 * Allows password-less login from localhost
 * Auto-fills credentials from URL parameters or constants
 */

class AdminerLoginAuto extends Adminer\Plugin {
    
    function login($login, $password) {
        // Allow login without password from localhost
        $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
        $isLocalhost = in_array($remoteAddr, ['127.0.0.1', '::1', 'localhost']) || 
                       strpos($remoteAddr, '127.') === 0 ||
                       strpos($remoteAddr, '192.168.') === 0 ||
                       strpos($remoteAddr, '10.') === 0;
        
        if ($isLocalhost) {
            // Allow password-less login from localhost
            return true;
        }
        
        // Also allow if password is empty (for local development)
        if (empty($password)) {
            return true;
        }
        
        return null; // Use default authentication
    }
    
    function credentials() {
        // Auto-fill credentials from URL parameters or constants
        $server = $_GET['server'] ?? (defined('MYSQL_HOST') ? MYSQL_HOST : 'localhost');
        $username = $_GET['username'] ?? (defined('MYSQL_USER') ? MYSQL_USER : 'root');
        $password = $_GET['password'] ?? (defined('MYSQL_PASSWORD') ? MYSQL_PASSWORD : '');
        
        return array($server, $username, $password);
    }
    
    function database() {
        // Auto-select database from URL parameter
        return $_GET['db'] ?? null;
    }
    
    function loginForm() {
        // Auto-submit login form if credentials are provided via URL
        if (isset($_GET['username']) || defined('MYSQL_USER')) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    var form = document.querySelector("form");
                    if (form) {
                        setTimeout(function() {
                            form.submit();
                        }, 100);
                    }
                });
            </script>';
        }
    }
}

