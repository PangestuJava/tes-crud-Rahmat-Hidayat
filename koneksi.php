<?php
// Set timezone agar tidak muncul warning
date_default_timezone_set('Asia/Jakarta');

// Sembunyikan notice deprecated dari ekstensi mysql_* (PHP 5.6)
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);

/**
 * Koneksi database memakai mysql_* (PHP 5.6).
 */
require_once __DIR__ . '/config/database.php';

$conn = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$conn) {
    die('Koneksi gagal: ' . mysql_error());
}
if (!mysql_select_db(DB_NAME, $conn)) {
    die('Database tidak ditemukan: ' . mysql_error());
}
mysql_set_charset('utf8', $conn);
