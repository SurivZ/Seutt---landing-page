<?php
session_start();

if (empty($_SESSION['logged_in'])) {
    header('Location: /login');
    exit;
}

require_once __DIR__ . '/../../config/database.php';
$conn = get_db_connection();

// Procesar cambio de estado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_id'], $_POST['action'])) {
    $status = $_POST['action'] === 'mark_processed' ? 'processed' : 'new';
    $stmt = $conn->prepare("UPDATE contacts SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $_POST['contact_id']);
    $stmt->execute();
    $stmt->close();

    header("Location: /dashboard");
    exit;
}

// Obtener contactos
$new_contacts = $processed_contacts = [];
$result_new = $conn->query("SELECT * FROM contacts WHERE status = 'new' ORDER BY created_at DESC");
$result_processed = $conn->query("SELECT * FROM contacts WHERE status = 'processed' ORDER BY created_at DESC");

while ($row = $result_new->fetch_assoc()) $new_contacts[] = $row;
while ($row = $result_processed->fetch_assoc()) $processed_contacts[] = $row;

$conn->close();

// Determinar la pestaña activa
$active_tab = $_GET['tab'] ?? 'new';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/styles/admin/dashboard.css">
</head>

<body class="admin-dashboard">
    <div class="dashboard-container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Mensajes de Contacto</h1>
            <a href="/logout" class="logout-btn">Cerrar Sesión</a>
        </div>

        <div class="tabs">
            <div class="tab <?= $active_tab === 'new' ? 'active' : '' ?>" onclick="window.location.href='/dashboard?tab=new'">
                Nuevos (<?= count($new_contacts) ?>)
            </div>
            <div class="tab <?= $active_tab === 'processed' ? 'active' : '' ?>" onclick="window.location.href='/dashboard?tab=processed'">
                Procesados (<?= count($processed_contacts) ?>)
            </div>
        </div>

        <div class="tab-content <?= $active_tab === 'new' ? 'active' : '' ?>">
            <div class="contacts-list">
                <?php if (empty($new_contacts)): ?>
                    <div class="no-contacts">No hay mensajes nuevos</div>
                <?php else: ?>
                    <?php foreach ($new_contacts as $contact): ?>
                        <div class="contact-card">
                            <div class="contact-header">
                                <h3 class="contact-name"><?= htmlspecialchars($contact['name']) ?></h3>
                                <div>
                                    <span class="contact-date"><?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?></span>
                                    <span class="contact-status status-new">NUEVO</span>
                                </div>
                            </div>
                            <div class="contact-info">
                                <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']) ?></p>
                                <?php if (!empty($contact['phone'])): ?>
                                    <p><strong>Teléfono:</strong> <?= htmlspecialchars($contact['phone']) ?></p>
                                <?php endif; ?>
                                <p><strong>Mensaje:</strong></p>
                                <p><?= nl2br(htmlspecialchars($contact['message'])) ?></p>
                            </div>
                            <form method="POST" class="contact-actions">
                                <input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
                                <input type="hidden" name="action" value="mark_processed">
                                <button type="submit" class="btn btn-process">Marcar como Procesado</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="tab-content <?= $active_tab === 'processed' ? 'active' : '' ?>">
            <div class="contacts-list">
                <?php if (empty($processed_contacts)): ?>
                    <div class="no-contacts">No hay mensajes procesados</div>
                <?php else: ?>
                    <?php foreach ($processed_contacts as $contact): ?>
                        <div class="contact-card">
                            <div class="contact-header">
                                <h3 class="contact-name"><?= htmlspecialchars($contact['name']) ?></h3>
                                <div>
                                    <span class="contact-date"><?= date('d/m/Y H:i', strtotime($contact['created_at'])) ?></span>
                                    <span class="contact-status status-processed">PROCESADO</span>
                                </div>
                            </div>
                            <div class="contact-info">
                                <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']) ?></p>
                                <?php if (!empty($contact['phone'])): ?>
                                    <p><strong>Teléfono:</strong> <?= htmlspecialchars($contact['phone']) ?></p>
                                <?php endif; ?>
                                <p><strong>Mensaje:</strong></p>
                                <p><?= nl2br(htmlspecialchars($contact['message'])) ?></p>
                            </div>
                            <form method="POST" class="contact-actions">
                                <input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
                                <input type="hidden" name="action" value="mark_new">
                                <button type="submit" class="btn btn-reopen">Reabrir Caso</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>