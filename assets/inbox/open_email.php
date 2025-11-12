<?php
require_once dirname(__DIR__, 2) . '/config.php';

// Set the directory path (modify as needed)
const EML_FILE_PATH = SENDMAIL_OUTPUT_DIR;

if (!isset($_GET['email']) || empty($_GET['email'])) {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>No email specified</div>
          </div>';
    exit;
}

$emailFile = basename($_GET['email']);
$emailPath = EML_FILE_PATH . $emailFile;

if (!file_exists($emailPath)) {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>Email file not found</div>
          </div>';
    exit;
}

$content = file_get_contents($emailPath);
if ($content === false) {
    echo '<div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>Unable to read email file</div>
          </div>';
    exit;
}

// Parse email headers
$headers = [];
$body = '';
$inHeaders = true;

$lines = explode("\n", $content);
foreach ($lines as $line) {
    if ($inHeaders) {
        if (trim($line) === '') {
            $inHeaders = false;
            continue;
        }
        
        if (preg_match('/^([^:]+):\s*(.+)$/', $line, $matches)) {
            $headers[strtolower(trim($matches[1]))] = trim($matches[2]);
        }
    } else {
        $body .= $line . "\n";
    }
}

// Display email content with Bootstrap 5 styling
echo '<div class="email-content">';
echo '<div class="email-header-info">';
echo '<div class="row">';
echo '<div class="col-md-6 mb-2">';
echo '<strong><p class="mb-1 text-primary"><i class="bi bi-person-fill me-2"></i>From:</p></strong>';
echo '<p class="mb-0">' . htmlspecialchars($headers['from'] ?? 'Unknown') . '</p>';
echo '</div>';
echo '<div class="col-md-6 mb-2">';
echo '<strong><p class="mb-1 text-primary"><i class="bi bi-person-check-fill me-2"></i>To:</p></strong>';
echo '<p class="mb-0">' . htmlspecialchars($headers['to'] ?? 'Unknown') . '</p>';
echo '</div>';
echo '</div>';
echo '<div class="row">';
echo '<div class="col-md-6 mb-2">';
echo '<strong><p class="mb-1 text-primary"><i class="bi bi-envelope-fill me-2"></i>Subject:</p></strong>';
echo '<p class="mb-0">' . htmlspecialchars($headers['subject'] ?? 'No Subject') . '</p>';
echo '</div>';
echo '<div class="col-md-6 mb-2">';
echo '<strong><p class="mb-1 text-primary"><i class="bi bi-calendar-event-fill me-2"></i>Date:</p></strong>';
echo '<p class="mb-0">' . htmlspecialchars($headers['date'] ?? 'Unknown') . '</p>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class="email-content-body">';
echo '<strong><p class="mb-3 text-primary"><i class="bi bi-chat-text-fill me-2"></i>Message:</p></strong>';
echo '<div class="email-body-content">';
echo '<pre class="mb-0" style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;">' . htmlspecialchars($body) . '</pre>';
echo '</div>';
echo '</div>';
echo '</div>';
?>