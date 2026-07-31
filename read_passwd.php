<?php
// WARNING: For local testing only. Do NOT expose this file on a public server.
// Reads /etc/passwd and prints it safely in HTML.
$path = '/etc/passwd';
if (!is_readable($path)) {
    http_response_code(403);
    echo 'File not readable or does not exist.';
    exit;
}
$content = @file_get_contents($path);
if ($content === false) {
    http_response_code(500);
    echo 'Failed to read file.';
    exit;
}
// Escape output to avoid XSS when viewed in a browser
echo '<pre>' . htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';
