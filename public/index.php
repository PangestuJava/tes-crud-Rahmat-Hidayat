<?php
/**
 * Front controller (Laravel-style).
 * Semua request masuk sini via .htaccess rewrite.
 */
require_once __DIR__ . '/../koneksi.php';

// Base URL helper
// $scriptDir: folder front controller (…/public or project root)
// $base     : project folder (…/public tanpa /public)
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
if ($scriptDir === '/' || $scriptDir === '.') $scriptDir = '';
$base = $scriptDir;
if (substr($base, -7) === '/public') $base = substr($base, 0, -7);
define('BASE_URL', $base . '/public');

function url($path = '') {
    return BASE_URL . '/' . ltrim($path, '/');
}

// Parse request URI → route path
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = '/' . trim($uri, '/');

// Strip project base (if any) then optional /public prefix
// $base is set earlier, may be '/project' or '' for root deploy
if ($base !== '' && strpos($path, $base) === 0) {
    $path = substr($path, strlen($base));
}
if (strpos($path, '/public') === 0) {
    $path = substr($path, 7);
}
$path = trim($path, '/');
if ($path === '' || $path === false) $path = '/';

// Load route map
$routes = require __DIR__ . '/../routes/web.php';

// Match route (routes ignore HTTP method — controller handles POST internally)
if (!isset($routes[$path])) {
    http_response_code(404);
    echo '<h1>404 Not Found</h1>';
    exit;
}

list($controllerClass, $action) = $routes[$path];

require_once __DIR__ . '/../app/controllers/' . $controllerClass . '.php';
$controller = new $controllerClass();
$controller->$action();
