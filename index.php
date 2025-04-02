<?php
session_start();
define('BASE_PATH', dirname(__FILE__));
define('VIEWS_PATH', BASE_PATH . '/views');
define('CONFIG_PATH', BASE_PATH . '/config');

require_once CONFIG_PATH . '/env.php';

if (getenv('APP_ENV') === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

require_once CONFIG_PATH . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    session_start();

    $conn = get_db_connection();

    error_log("Datos del formulario recibidos: " . print_r($_POST, true));

    try {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Error en prepare: " . $conn->error);
        }

        $phone = !empty($_POST['phone']) ? $_POST['phone'] : null;
        $stmt->bind_param(
            "ssss",
            $_POST['name'],
            $_POST['email'],
            $phone,
            $_POST['message']
        );

        if ($stmt->execute()) {
            $_SESSION['form_success'] = "¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.";
            error_log("Contacto insertado correctamente con ID: " . $conn->insert_id);
        } else {
            throw new Exception("Error en execute: " . $stmt->error);
        }
    } catch (Exception $e) {
        error_log("Error al insertar contacto: " . $e->getMessage());
        $_SESSION['form_error'] = "Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.";
    } finally {
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }

    $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/#contact';
    header("Location: $redirect_url");
    exit;
}

$request_uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$request_uri = rtrim($request_uri, '/');
$request_uri = str_replace('/index.php', '', $request_uri);

$routes = explode('/', ltrim($request_uri, '/'));
$request_url = $routes[0] ?: 'home';

$valid_routes = [
    '' => 'home.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'not-found' => 'not_found.php',
    'login' => 'admin/login.php',
    'dashboard' => 'admin/dashboard.php',
    'logout' => 'admin/logout.php'
];

try {
    if (array_key_exists($request_url, $valid_routes)) {
        $view_file = $valid_routes[$request_url];
        $view_path = VIEWS_PATH . '/' . $view_file;

        if (file_exists($view_path)) {
            if (in_array($request_url, ['login', 'dashboard', 'logout'])) {
                require $view_path;
                exit;
            }
        } else {
            throw new Exception("Vista no encontrada: $view_file");
        }
    } else {
        throw new Exception("Ruta no encontrada: $request_url");
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    header("HTTP/1.0 404 Not Found");
    $view_file = 'not_found.php';
    $view_path = VIEWS_PATH . '/not_found.php';
}

require_once VIEWS_PATH . '/layout.php';
