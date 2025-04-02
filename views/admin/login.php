<?php
session_start();

if (!empty($_SESSION['logged_in'])) {
    header('Location: /dashboard');
    exit;
}

require_once __DIR__ . '/../../config/database.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = get_db_connection();
    $username = $conn->real_escape_string(trim($_POST['username'] ?? ''));
    $password = trim($_POST['password'] ?? '');

    $sql = "SELECT id, password_hash FROM users WHERE username = '$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;
            header('Location: /dashboard');
            exit;
        }
    }

    $error = 'Usuario o contraseña incorrectos';
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrador</title>
    <link rel="stylesheet" href="/styles/admin/login.css">
</head>

<body class="admin-login">
    <div class="login-container">
        <div class="login-form">
            <div class="login-logo">
                <img src="/images/logo.png" alt="Logo Seutt">
            </div>
            <h1 class="login-title">Panel de Administración</h1>

            <?php if ($error): ?>
                <div class="alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Ingresar</button>
            </form>
        </div>
    </div>
</body>

</html>