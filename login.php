<?php
/**
 * Laragon Dashboard - Login Page
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/i18n.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if already authenticated OR if authentication is disabled
if ((isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) || (defined('AUTH_ENABLED') && !AUTH_ENABLED)) {
    header('Location: index.php');
    exit;
}

$error = '';

$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST') {
    $password = $_POST['password'] ?? '';
    
    // Skip if AUTH_ENABLED is false
    if (defined('AUTH_ENABLED') && !AUTH_ENABLED) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    }
    
    $adminPassword = defined('ADMIN_PASSWORD') ? ADMIN_PASSWORD : 'admin'; // Default fallback
    
    if ($password === $adminPassword) {
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Invalid password';
    }
}

include __DIR__ . '/partials/layouts/layoutTop.php';
?>

<div class="dashboard-main-body">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-4">
                <div class="card shadow-none border radius-12 p-32">
                    <div class="card-body">
                        <div class="text-center mb-32">
                            <img src="assets/images/logo.png" alt="Logo" class="mb-16" style="max-height: 60px;">
                            <h4 class="fw-semibold mb-8">Welcome Back</h4>
                            <p class="text-secondary-light">Please enter your password to continue</p>
                        </div>
                        
                        <?php if ($error): ?>
                            <div class="alert alert-danger mb-24"><?php echo htmlspecialchars($error); ?></div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-24">
                                <label class="form-label fw-medium mb-8">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-primary-600 w-100 radius-8 py-12">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Suppress navigation for login page
$GLOBALS['is_login_page'] = true;

include __DIR__ . '/partials/layouts/layoutBottom.php'; 
?>
