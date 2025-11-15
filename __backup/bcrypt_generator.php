<?php
/**
 * Bcrypt Password Generator API
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/logger.php';

header('Content-Type: application/json');

// Security check
if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

// CSRF protection for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csrfToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (empty($csrfToken) || !SecurityHelper::validateCSRF($csrfToken)) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit;
    }
}

$action = $_GET['action'] ?? 'generate';

try {
    switch ($action) {
        case 'generate':
            $password = $_POST['password'] ?? '';
            
            if (empty($password)) {
                throw new Exception('Password is required');
            }
            
            // Generate bcrypt hash with cost factor 10
            $hash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
            
            if ($hash === false) {
                throw new Exception('Failed to generate hash');
            }
            
            DashboardLogger::info("Bcrypt hash generated");
            
            echo json_encode([
                'success' => true,
                'hash' => $hash
            ]);
            break;
            
        case 'verify':
            $password = $_POST['password'] ?? '';
            $hash = $_POST['hash'] ?? '';
            
            if (empty($password) || empty($hash)) {
                throw new Exception('Password and hash are required');
            }
            
            $verified = password_verify($password, $hash);
            
            echo json_encode([
                'success' => true,
                'verified' => $verified
            ]);
            break;
            
        default:
            throw new Exception('Invalid action');
    }
    
} catch (Exception $e) {
    DashboardLogger::error("Bcrypt Generator Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>

