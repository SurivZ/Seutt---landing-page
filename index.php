<?php
define('BASE_PATH', dirname(__FILE__));
define('VIEWS_PATH', BASE_PATH . '/views');

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = rtrim($request_uri, '/');
$request_uri = str_replace('/index.php', '', $request_uri);

$routes = explode('/', ltrim($request_uri, '/'));
$request_url = $routes[0] ?: 'home';

$valid_routes = [
    '' => 'home.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'not-found' => 'not_found.php',
];

if (array_key_exists($request_url, $valid_routes)) {
    $view_file = $valid_routes[$request_url];
} else {
    header("HTTP/1.0 404 Not Found");
    $view_file = 'not_found.php';
    $request_url = 'not-found';
}

$view_path = VIEWS_PATH . '/' . $view_file;
if (!file_exists($view_path)) {
    header("HTTP/1.0 404 Not Found");
    $view_file = 'not_found.php';
    $request_url = 'not-found';
    $view_path = VIEWS_PATH . '/not_found.php';
}

require_once VIEWS_PATH . '/layout.php';
