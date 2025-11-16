<?php
/**
 * Laragon Dashboard - Fix SMTP Configuration
 * Configures PHP to use Mailpit SMTP instead of sendmail.exe
 * Version: 3.1.0
 */

header('Content-Type: application/json');

// Load configuration
require_once __DIR__ . '/../config.php';

$action = $_GET['action'] ?? 'check';

/**
 * Find PHP php.ini file
 */
function findPhpIni() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return null;
    }
    
    // Get active PHP version from Laragon config
    $laraconfig = getLaragonConfig();
    $phpVersion = $laraconfig['PHPVersion'] ?? 'php-8.3.16-Win32-vs16-x64';
    
    // Try to find php.ini in Laragon's PHP directory
    $phpDir = $laragonRoot . '/bin/php/' . $phpVersion;
    if (is_dir($phpDir)) {
        $iniPath = $phpDir . '/php.ini';
        if (file_exists($iniPath)) {
            return $iniPath;
        }
    }
    
    // Fallback: try to find any php.ini in PHP directories
    $phpDirs = glob($laragonRoot . '/bin/php/php-*');
    if (!empty($phpDirs)) {
        // Sort to get the latest version
        rsort($phpDirs);
        $iniPath = $phpDirs[0] . '/php.ini';
        if (file_exists($iniPath)) {
            return $iniPath;
        }
    }
    
    // Last resort: use php.ini from PHP's configuration
    $iniPath = php_ini_loaded_file();
    if ($iniPath && file_exists($iniPath)) {
        return $iniPath;
    }
    
    return null;
}

/**
 * Get current SMTP configuration from php.ini
 */
function getCurrentSmtpConfig($iniPath) {
    if (!file_exists($iniPath)) {
        return null;
    }
    
    $content = file_get_contents($iniPath);
    $config = [
        'smtp' => null,
        'smtp_port' => null,
        'sendmail_from' => null,
        'sendmail_path' => null
    ];
    
    // Parse SMTP settings
    if (preg_match('/^smtp\s*=\s*(.+)$/mi', $content, $matches)) {
        $config['smtp'] = trim($matches[1]);
    }
    if (preg_match('/^smtp_port\s*=\s*(.+)$/mi', $content, $matches)) {
        $config['smtp_port'] = trim($matches[1]);
    }
    if (preg_match('/^sendmail_from\s*=\s*(.+)$/mi', $content, $matches)) {
        $config['sendmail_from'] = trim($matches[1]);
    }
    if (preg_match('/^sendmail_path\s*=\s*(.+)$/mi', $content, $matches)) {
        $config['sendmail_path'] = trim($matches[1]);
    }
    
    return $config;
}

/**
 * Configure PHP to use Mailpit SMTP
 */
function configureMailpitSmtp($iniPath, $smtpPort = 1025, $fromEmail = 'noreply@localhost') {
    if (!file_exists($iniPath)) {
        return ['success' => false, 'error' => 'php.ini file not found'];
    }
    
    // Check if file is writable
    if (!is_writable($iniPath)) {
        return ['success' => false, 'error' => 'php.ini file is not writable. Please run as administrator or check file permissions.'];
    }
    
    $content = file_get_contents($iniPath);
    $originalContent = $content;
    
    // Backup original file
    $backupPath = $iniPath . '.backup.' . date('Y-m-d_His');
    if (!copy($iniPath, $backupPath)) {
        return ['success' => false, 'error' => 'Failed to create backup of php.ini'];
    }
    
    // Configure SMTP settings
    $replacements = [
        // SMTP server
        '/^;\s*smtp\s*=.*$/mi' => 'smtp = localhost',
        '/^smtp\s*=.*$/mi' => 'smtp = localhost',
        
        // SMTP port
        '/^;\s*smtp_port\s*=.*$/mi' => 'smtp_port = ' . $smtpPort,
        '/^smtp_port\s*=.*$/mi' => 'smtp_port = ' . $smtpPort,
        
        // Sendmail from
        '/^;\s*sendmail_from\s*=.*$/mi' => 'sendmail_from = ' . $fromEmail,
        '/^sendmail_from\s*=.*$/mi' => 'sendmail_from = ' . $fromEmail,
        
        // Disable sendmail_path (use SMTP instead)
        '/^;\s*sendmail_path\s*=.*$/mi' => ';sendmail_path = ',
        '/^sendmail_path\s*=.*$/mi' => ';sendmail_path = ',
    ];
    
    foreach ($replacements as $pattern => $replacement) {
        $content = preg_replace($pattern, $replacement, $content);
    }
    
    // If settings don't exist, add them
    if (!preg_match('/^smtp\s*=/mi', $content)) {
        // Find [mail function] section or add at end
        if (preg_match('/\[mail function\]/i', $content, $matches, PREG_OFFSET_CAPTURE)) {
            $pos = $matches[0][1] + strlen($matches[0][0]);
            $content = substr_replace($content, "\nsmtp = localhost\nsmtp_port = " . $smtpPort . "\nsendmail_from = " . $fromEmail . "\n", $pos, 0);
        } else {
            // Add at end of file
            $content .= "\n\n[mail function]\nsmtp = localhost\nsmtp_port = " . $smtpPort . "\nsendmail_from = " . $fromEmail . "\n";
        }
    }
    
    // Write updated content
    if (file_put_contents($iniPath, $content) === false) {
        // Restore backup on failure
        copy($backupPath, $iniPath);
        return ['success' => false, 'error' => 'Failed to write php.ini file'];
    }
    
    return [
        'success' => true,
        'message' => 'SMTP configuration updated successfully',
        'backup' => $backupPath,
        'config' => [
            'smtp' => 'localhost',
            'smtp_port' => $smtpPort,
            'sendmail_from' => $fromEmail,
            'sendmail_path' => 'disabled'
        ]
    ];
}

/**
 * Check Mailpit status and port
 */
function checkMailpitConfig() {
    $laragonRoot = defined('LARAGON_ROOT') ? LARAGON_ROOT : '';
    if (empty($laragonRoot)) {
        return ['running' => false, 'port' => null];
    }
    
    $laraconfig = getLaragonConfig();
    $mailpitPort = $laraconfig['MailpitPort'] ?? 1025;
    $mailpitEnabled = isset($laraconfig['MailpitEnabled']) ? ($laraconfig['MailpitEnabled'] == '1') : false;
    
    // Check if Mailpit is actually running
    $ch = curl_init('http://localhost:' . $mailpitPort);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'running' => $httpCode === 200 || $httpCode === 0, // 0 might mean connection refused but port exists
        'enabled' => $mailpitEnabled,
        'port' => $mailpitPort
    ];
}

try {
    switch ($action) {
        case 'check':
            $iniPath = findPhpIni();
            $mailpit = checkMailpitConfig();
            
            if (!$iniPath) {
                echo json_encode([
                    'success' => false,
                    'error' => 'php.ini file not found',
                    'mailpit' => $mailpit
                ]);
                exit;
            }
            
            $currentConfig = getCurrentSmtpConfig($iniPath);
            $isConfigured = false;
            
            if ($currentConfig) {
                // Check if already configured for Mailpit
                $isConfigured = (
                    ($currentConfig['smtp'] === 'localhost' || $currentConfig['smtp'] === '127.0.0.1') &&
                    ($currentConfig['smtp_port'] == $mailpit['port'] || $currentConfig['smtp_port'] == '1025')
                );
            }
            
            echo json_encode([
                'success' => true,
                'php_ini_path' => $iniPath,
                'php_ini_writable' => is_writable($iniPath),
                'current_config' => $currentConfig,
                'is_configured' => $isConfigured,
                'mailpit' => $mailpit,
                'recommendation' => $mailpit['enabled'] && !$isConfigured ? 'configure' : ($isConfigured ? 'ok' : 'check_mailpit')
            ]);
            break;
            
        case 'configure':
            $iniPath = findPhpIni();
            if (!$iniPath) {
                throw new Exception('php.ini file not found');
            }
            
            $mailpit = checkMailpitConfig();
            if (!$mailpit['enabled']) {
                throw new Exception('Mailpit is not enabled in Laragon. Please enable it first.');
            }
            
            $smtpPort = $_POST['smtp_port'] ?? $mailpit['port'] ?? 1025;
            $fromEmail = $_POST['from_email'] ?? 'noreply@localhost';
            
            $result = configureMailpitSmtp($iniPath, $smtpPort, $fromEmail);
            echo json_encode($result);
            break;
            
        case 'restore':
            $iniPath = findPhpIni();
            if (!$iniPath) {
                throw new Exception('php.ini file not found');
            }
            
            $backupPath = $_POST['backup'] ?? '';
            if (empty($backupPath) || !file_exists($backupPath)) {
                throw new Exception('Backup file not found');
            }
            
            if (!is_writable($iniPath)) {
                throw new Exception('php.ini file is not writable');
            }
            
            if (copy($backupPath, $iniPath)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'php.ini restored from backup'
                ]);
            } else {
                throw new Exception('Failed to restore backup');
            }
            break;
            
        default:
            throw new Exception('Invalid action');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

