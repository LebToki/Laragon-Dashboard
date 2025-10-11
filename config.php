<?php
// Configuration for Laragon Dashboard
// Define the directory where sendmail stores outbound emails.
// This can be overridden using the SENDMAIL_OUTPUT_DIR environment variable.

define('SENDMAIL_OUTPUT_DIR', rtrim(getenv('SENDMAIL_OUTPUT_DIR') ?: 'C:/laragon/bin/sendmail/output/', '/\\') . '/');

// Domain suffix used for local sites (e.g., ".local").
// Override by setting the DOMAIN_SUFFIX environment variable.
define('DOMAIN_SUFFIX', getenv('DOMAIN_SUFFIX') ?: '.local');

// URL to access PhpMyAdmin. Override with the PHPMYADMIN_URL environment variable.
define('PHPMYADMIN_URL', getenv('PHPMYADMIN_URL') ?: 'http://localhost/phpmyadmin');

// MySQL connection settings. These fall back to Laragon defaults if not set.
define('MYSQL_HOST', getenv('MYSQL_HOST') ?: 'localhost');
define('MYSQL_USER', getenv('MYSQL_USER') ?: 'root');
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD') ?: '');

// Application settings
define('APP_NAME', 'Laragon Dashboard');
define('APP_VERSION', '2.4.0');
define('APP_DEBUG', false);

// Security settings
define('SESSION_TIMEOUT', 3600); // 1 hour
define('MAX_LOGIN_ATTEMPTS', 5);

// File upload settings
define('MAX_UPLOAD_SIZE', 10 * 1024 * 1024); // 10MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx']);

// Error reporting
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
