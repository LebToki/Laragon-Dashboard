<?php
/**
 * Laragon Dashboard - Root Entry Point
 * Version: 2.6.0
 * 
 * This file serves as the entry point when installed in /www/
 * It loads the main application from the LaragonDash folder
 */

if (file_exists(__DIR__ . '/LaragonDash/index.php')) {
    require_once __DIR__ . '/LaragonDash/index.php';
} else {
    die('LaragonDash application not found. Please ensure the LaragonDash folder exists.');
}
