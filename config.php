<?php
// Configuration for Laragon Dashboard
// Define the directory where sendmail stores outbound emails.
// This can be overridden using the SENDMAIL_OUTPUT_DIR environment variable.

define('SENDMAIL_OUTPUT_DIR', rtrim(getenv('SENDMAIL_OUTPUT_DIR') ?: 'D:/laragon/bin/sendmail/output/', '/\\') . '/');
