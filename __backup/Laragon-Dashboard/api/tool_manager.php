<?php
/**
 * Application: Laragon | Tool Management API
 * Description: phpMyAdmin, Composer, Node.js management
 * Version: 2.6.0
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../includes/security.php';

header('Content-Type: application/json');

if (!SecurityHelper::validateRequest()) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        echo json_encode(getToolsInfo());
        break;
    case 'install':
        $tool = $_POST['tool'] ?? '';
        echo json_encode(installTool($tool));
        break;
    default:
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function getToolsInfo() {
    return [
        'success' => true,
        'tools' => [
            'phpmyadmin' => [
                'installed' => isPhpMyAdminInstalled(),
                'version' => getPhpMyAdminVersion(),
                'path' => getPhpMyAdminPath()
            ],
            'composer' => [
                'installed' => isComposerInstalled(),
                'version' => getComposerVersion(),
                'path' => getComposerPath()
            ],
            'node' => [
                'installed' => isNodeInstalled(),
                'version' => getNodeVersion(),
                'path' => getNodePath()
            ],
            'git' => [
                'installed' => isGitInstalled(),
                'version' => getGitVersion(),
                'path' => getGitPath()
            ]
        ]
    ];
}

function isPhpMyAdminInstalled() {
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    return is_dir($docRoot . '/phpmyadmin') || is_dir($docRoot . '/phpMyAdmin');
}

function getPhpMyAdminVersion() {
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    $versionFile = $docRoot . '/phpmyadmin/VERSION';
    if (file_exists($versionFile)) {
        return trim(file_get_contents($versionFile));
    }
    return 'Unknown';
}

function getPhpMyAdminPath() {
    $docRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
    if (is_dir($docRoot . '/phpmyadmin')) {
        return $docRoot . '/phpmyadmin';
    }
    if (is_dir($docRoot . '/phpMyAdmin')) {
        return $docRoot . '/phpMyAdmin';
    }
    return null;
}

function isComposerInstalled() {
    $laragonRoot = getLaragonRoot();
    return file_exists($laragonRoot . '/bin/composer/composer.bat') || 
           file_exists($laragonRoot . '/bin/composer/composer.phar');
}

function getComposerVersion() {
    $laragonRoot = getLaragonRoot();
    $composerPath = $laragonRoot . '/bin/composer/composer.bat';
    if (file_exists($composerPath)) {
        $output = shell_exec(escapeshellarg($composerPath) . ' --version 2>&1');
        if (preg_match('/([0-9]+\.[0-9]+\.[0-9]+)/', $output, $matches)) {
            return $matches[1];
        }
    }
    return 'Unknown';
}

function getComposerPath() {
    $laragonRoot = getLaragonRoot();
    if (file_exists($laragonRoot . '/bin/composer/composer.bat')) {
        return $laragonRoot . '/bin/composer/composer.bat';
    }
    return null;
}

function isNodeInstalled() {
    $laragonRoot = getLaragonRoot();
    return file_exists($laragonRoot . '/bin/nodejs/node.exe');
}

function getNodeVersion() {
    $laragonRoot = getLaragonRoot();
    $nodePath = $laragonRoot . '/bin/nodejs/node.exe';
    if (file_exists($nodePath)) {
        $output = shell_exec(escapeshellarg($nodePath) . ' --version 2>&1');
        return trim($output);
    }
    return 'Unknown';
}

function getNodePath() {
    $laragonRoot = getLaragonRoot();
    if (file_exists($laragonRoot . '/bin/nodejs/node.exe')) {
        return $laragonRoot . '/bin/nodejs/node.exe';
    }
    return null;
}

function isGitInstalled() {
    $laragonRoot = getLaragonRoot();
    return file_exists($laragonRoot . '/bin/git/git.exe');
}

function getGitVersion() {
    $laragonRoot = getLaragonRoot();
    $gitPath = $laragonRoot . '/bin/git/git.exe';
    if (file_exists($gitPath)) {
        $output = shell_exec(escapeshellarg($gitPath) . ' --version 2>&1');
        if (preg_match('/([0-9]+\.[0-9]+\.[0-9]+)/', $output, $matches)) {
            return $matches[1];
        }
    }
    return 'Unknown';
}

function getGitPath() {
    $laragonRoot = getLaragonRoot();
    if (file_exists($laragonRoot . '/bin/git/git.exe')) {
        return $laragonRoot . '/bin/git/git.exe';
    }
    return null;
}

function installTool($tool) {
    // Tool installation would require download and setup
    // For now, return a message
    return [
        'success' => false,
        'message' => 'Tool installation requires manual setup or Laragon.exe integration'
    ];
}

