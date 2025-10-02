<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/logi.css">
</head>
<body>
<div class="login-container">
    <h2>🔐 Iniciar Sesión</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Usuario:</label>
        <input type="text" name="username" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>

    <div class="register-link">
        ¿No tienes cuenta?
        <a href="index.php?a=registrar">Registrar</a>
    </div>
</div>
</body>
</html>
