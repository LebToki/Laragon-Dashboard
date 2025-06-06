<?php
        require_once __DIR__ . '/../../config.php';
// Directory containing the email files
        $emailFilePaths = [SENDMAIL_OUTPUT_DIR];
	
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
	
	function parseEmail($content)
	{
		$parts = preg_split("/\r?\n\r?\n/", $content, 2);
		$headers = isset($parts[0]) ? $parts[0] : '';
		$body = isset($parts[1]) ? $parts[1] : '';
		
		$parsed = [
			'headers' => parseHeaders($headers),
			'body' => $body
		];
		
		// Check if the email is multipart
		if (isset($parsed['headers']['Content-Type']) && strpos($parsed['headers']['Content-Type'], 'multipart/') !== false) {
			$parsed['parts'] = parseMultipart($body, $parsed['headers']['Content-Type']);
		}
		
		return $parsed;
	}
	
	function parseHeaders($headers)
	{
		$parsed = [];
		$headers = explode("\n", $headers);
		foreach ($headers as $header) {
			if (preg_match('/^([^:]+):\s*(.+)$/', $header, $matches)) {
				$parsed[$matches[1]] = $matches[2];
			}
		}
		return $parsed;
	}
	
	function parseMultipart($body, $contentType)
	{
		if (preg_match('/boundary="?(.+?)"?$/i', $contentType, $matches)) {
			$boundary = $matches[1];
			$parts = preg_split("/--" . preg_quote($boundary) . "(?=\s|$)/", $body);
			array_pop($parts); // Remove the last part (it's empty)
			array_shift($parts); // Remove the first part (it's empty)
			
			return array_map('parseEmailPart', $parts);
		}
		return [];
	}
	
	function parseEmailPart($part)
	{
		$parsed = parseEmail($part);
		$parsed['content'] = isset($parsed['headers']['Content-Transfer-Encoding']) ?
			decodeContent($parsed['body'], $parsed['headers']['Content-Transfer-Encoding']) :
			$parsed['body'];
		return $parsed;
	}
	
	function decodeContent($content, $encoding)
	{
		switch (strtolower($encoding)) {
			case 'base64':
				return base64_decode($content);
			case 'quoted-printable':
				return quoted_printable_decode($content);
			default:
				return $content;
		}
	}
	
	function renderEmail($parsed)
	{
		$output = '<div class="email-headers">';
		foreach ($parsed['headers'] as $key => $value) {
			$output .= "<strong>" . htmlspecialchars($key) . ":</strong> " . htmlspecialchars($value) . "<br>";
		}
		$output .= '</div><hr>';
		
		if (isset($parsed['parts'])) {
			foreach ($parsed['parts'] as $part) {
				if (isset($part['headers']['Content-Type'])) {
					if (strpos($part['headers']['Content-Type'], 'text/plain') !== false) {
						$output .= '<pre>' . htmlspecialchars($part['content']) . '</pre>';
					} elseif (strpos($part['headers']['Content-Type'], 'text/html') !== false) {
						$output .= $part['content'];
					}
				}
			}
		} else {
			$output .= '<pre>' . htmlspecialchars($parsed['body']) . '</pre>';
		}
		
		return $output;
	}
	
	if (isset($_GET['email'])) {
		$emailFile = findEmailFile($_GET['email'], $emailFilePaths);
		if ($emailFile) {
			$content = file_get_contents($emailFile);
			if ($content === false) {
				echo "Error reading email file.";
			} else {
				$parsed = parseEmail($content);
				echo renderEmail($parsed);
			}
		} else {
			echo "Email not found.";
		}
	} else {
		echo "No email specified.";
	}
