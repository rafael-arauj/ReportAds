<?php
header('Content-Type: text/html; charset=utf-8');

$html = file_get_contents(__DIR__ . '/index.html');

if ($html === false) {
    http_response_code(500);
    echo 'Erro ao carregar a plataforma.';
    exit;
}

// Remove visible demo credentials from both compact and expanded prototypes.
$html = preg_replace('/\s*<div class="demo">.*?<\/div>\s*/s', "\n", $html);
$html = preg_replace('/\s*<div class="demo-access">.*?<\/div>\s*/s', "\n", $html);

// Keep login fields empty on first load.
$html = preg_replace('/(<input[^>]*id="loginEmail"[^>]*)\svalue="[^"]*"/i', '$1', $html);
$html = preg_replace('/(<input[^>]*id="loginPassword"[^>]*)\svalue="[^"]*"/i', '$1', $html);

// Avoid browser autofilling stale demo credentials too aggressively.
$html = str_replace('autocomplete="username"', 'autocomplete="username"', $html);

echo $html;
