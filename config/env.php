<?php
function load_environment_variables()
{
    $env_paths = [
        __DIR__ . '/../.env',
        '/home/' . get_current_user() . '/.env'
    ];

    foreach ($env_paths as $path) {
        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) {
                    continue;
                }

                list($name, $value) = explode('=', $line, 2);
                $name = trim($name);
                $value = trim($value);

                if (($value[0] === '"' && $value[-1] === '"') || ($value[0] === "'" && $value[-1] === "'")) {
                    $value = substr($value, 1, -1);
                }

                putenv("$name=$value");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
            return;
        }
    }

    if (getenv('APP_ENV') === 'production') {
        error_log('Archivo .env no encontrado');
        die('Error de configuración. Por favor, contacte al administrador.');
    } else {
        die('Archivo .env no encontrado. Crea un archivo .env basado en .env.example');
    }
}

load_environment_variables();
