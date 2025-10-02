<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$perfil = strtolower($usuario['perfil_nombre']); // Ej: 'administrador', 'editor', 'usuario'
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Principal</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <nav class="navbar">
        <div class="nav-logo">🚀 Mi Sistema</div>
        <ul class="nav-links">
            <li><a href="#">Inicio</a></li>

            <?php if ($perfil === 'administrador'): ?>
                <li><a href="#">Gestionar Usuarios</a></li>
                <li><a href="#">Perfiles</a></li>
                <li><a href="#">Reportes</a></li>
            <?php endif; ?>

            <?php if ($perfil === 'editor' || $perfil === 'administrador'): ?>
                <li><a href="#">Crear Contenido</a></li>
                <li><a href="#">Publicaciones</a></li>
            <?php endif; ?>

            <?php if ($perfil === 'usuario' || $perfil === 'editor' || $perfil === 'administrador'): ?>
                <li><a href="#">Mi Perfil</a></li>
            <?php endif; ?>

            <li><a href="../logout.php" class="logout">Salir</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>👋 Bienvenido, <?= htmlspecialchars($usuario['nombre_completo']) ?></h1>
        <p>Has iniciado sesión como: <strong><?= ucfirst($perfil) ?></strong></p>

        <div class="content">
            <?php if ($perfil === 'administrador'): ?>
                <p>📊 Aquí puedes gestionar todo el sistema.</p>
            <?php elseif ($perfil === 'editor'): ?>
                <p>📝 Puedes editar y publicar contenido.</p>
            <?php else: ?>
                <p>🙋‍♂️ Aquí puedes ver tu perfil y tus datos.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
