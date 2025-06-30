<?php
// Configuration for Laragon Dashboard
// Define the directory where sendmail stores outbound emails.
// This can be overridden using the SENDMAIL_OUTPUT_DIR environment variable.

define('SENDMAIL_OUTPUT_DIR', rtrim(getenv('SENDMAIL_OUTPUT_DIR') ?: 'D:/laragon/bin/sendmail/output/', '/\\') . '/');

// Domain suffix used for local sites (e.g., ".local").
// Override by setting the DOMAIN_SUFFIX environment variable.
define('DOMAIN_SUFFIX', getenv('DOMAIN_SUFFIX') ?: '.local');

// URL to access PhpMyAdmin. Override with the PHPMYADMIN_URL environment variable.
define('PHPMYADMIN_URL', getenv('PHPMYADMIN_URL') ?: 'http://localhost/phpmyadmin');

// MySQL connection settings. These fall back to Laragon defaults if not set.
define('MYSQL_HOST', getenv('MYSQL_HOST') ?: 'localhost');
define('MYSQL_USER', getenv('MYSQL_USER') ?: 'root');
