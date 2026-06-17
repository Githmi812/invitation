<?php
// ============================================================
//  config.php  –  Edit these values for your hosting account
// ============================================================

define('DB_HOST', 'localhost');
define('DB_NAME', 'wedding_db');
define('DB_USER', 'root');        // ← change to your DB username
define('DB_PASS', '');            // ← change to your DB password
define('DB_CHARSET', 'utf8mb4');

// Allowed origin for CORS (your invitation domain)
// Use '*' during testing, then restrict to your real domain
define('ALLOWED_ORIGIN', '*');

// ── PDO connection (shared by all PHP files) ──────────────
function getDB(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . DB_HOST
             . ';dbname=' . DB_NAME
             . ';charset=' . DB_CHARSET;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    }
    return $pdo;
}

// ── CORS headers ──────────────────────────────────────────
function setCorsHeaders(): void {
    header('Access-Control-Allow-Origin: ' . ALLOWED_ORIGIN);
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(204);
        exit;
    }
}

// ── JSON response helper ──────────────────────────────────
function jsonResponse(array $data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
