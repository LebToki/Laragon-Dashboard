<?php
// Define potential paths
$emailFilePaths = [
    'C:/laragon/bin/sendmail/output/',
    'D:/laragon/bin/sendmail/output/',
];

function findEmailFile($filename, $paths)
{
    foreach ($paths as $path) {
        $filePath = rtrim($path, '/') . '/' . basename($filename);
        if (file_exists($filePath)) {
            return $filePath;
        }
    }
    return false;
}

if (isset($_GET['email'])) {
    $emailFile = findEmailFile($_GET['email'], $emailFilePaths);
    if ($emailFile) {
        $content = file_get_contents($emailFile);
        if ($content === false) {
            echo "Error reading email file.";
        } else {
            // Decode and display content as HTML
            $decodedContent = htmlspecialchars_decode($content, ENT_QUOTES);
            echo nl2br($decodedContent);
        }
    } else {
        echo "Email not found.";
    }
} else {
    echo "No email specified.";
}
