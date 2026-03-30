<?php
/**
 * Laragon Dashboard - Login Page
 * Simple session-based authentication (no password required for local use)
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/i18n.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if already authenticated
if (is_authenticated()) {
    header('Location: index.php');
    exit;
}

// Simple login - just create session, no password required
$_SESSION['authenticated'] = true;
$_SESSION['login_time'] = time();
$_SESSION['auth_method'] = 'simple';

header('Location: index.php');
exit;
