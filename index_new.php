<?php
/**
 * Application: Laragon | Server Index Page
 * Description: This is the main index page for the Laragon server, displaying server info, server vitals, sendmail
 * mailbox, and applications.
 * Author: Tarek Tarabichi <tarek@2tinteractive.com>
 * Improved CakePHP and Joomla detection
 *
 * Contributors:
 * - @LrkDev in v.2.1.2
 * - @luisAntonioLAGS in v.2.2.1 Spanish
 * - @martic in 2.3.5 Dynamic Hostname Detection
 *
 * Version: 2.6.0
 */

// Load the main application from LaragonDash folder
if (file_exists(__DIR__ . '/LaragonDash/index.php')) {
    require_once __DIR__ . '/LaragonDash/index.php';
} else {
    die('LaragonDash application not found. Please ensure the LaragonDash folder exists.');
}

