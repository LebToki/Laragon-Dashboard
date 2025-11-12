<?php
/**
 * Laragon Dashboard - Root Entry Point
 * Version: 2.6.0
 * 
 * This file serves as the entry point when installed in /www/
 * It loads the main application from the Laragon-Dashboard folder
 */

if (file_exists(__DIR__ . '/Laragon-Dashboard/index.php')) {
    require_once __DIR__ . '/Laragon-Dashboard/index.php';
} else {
    die('Laragon-Dashboard application not found. Please ensure the Laragon-Dashboard folder exists.');
}
