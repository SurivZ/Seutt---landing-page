<?php
require_once __DIR__ . '/env.php';

define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USERNAME', getenv('DB_USERNAME') ?: '');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'seutt_db');

function get_db_connection()
{
    static $conn = null;

    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            error_log("Error de conexión MySQL: " . $conn->connect_error);
            if (getenv('APP_ENV') === 'development') {
                die("Error de conexión MySQL: " . $conn->connect_error);
            } else {
                die("Error de conexión con la base de datos. Por favor, inténtelo más tarde.");
            }
        }

        $conn->set_charset("utf8mb4");
    }

    return $conn;
}
