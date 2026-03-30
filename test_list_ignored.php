<?php
$_SERVER['HTTP_X_REQUESTED_WITH'] = 'xmlhttprequest';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1'; // Mock local dev
$_GET['action'] = 'list_ignored';
require 'api/projects.php';
