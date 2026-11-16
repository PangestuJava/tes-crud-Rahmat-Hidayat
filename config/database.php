<?php

/**
 * Load .env file ke dalam PHP constants.
 */
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die('.env tidak ditemukan');
}

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos($line, '#') === 0 || strpos($line, '=') === false) continue;
    list($key, $value) = explode('=', $line, 2);
    define(trim($key), trim($value));
}
