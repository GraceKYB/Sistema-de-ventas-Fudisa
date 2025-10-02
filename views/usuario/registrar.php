<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Usuario</title>
  <link rel="stylesheet" href="css/logi.css"> <!-- mismo CSS del login -->
</head>
<body>

  <div class="login-container">
    <h2>👤 Crear Cuenta</h2>

    <?php if (!empty($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if (!empty($mensaje)): ?>
      <div class="success">
        <?= $mensaje ?><br>
        ✅ Ahora puedes iniciar sesión con tus credenciales.<br><br>
        <script>
  setTimeout(() => {
    window.location.href = "index.php?a=login";
  }, 5000);
</script>

        <a href="index.php?a=login" class="btn-login-link">Ir al login</a>
      </div>
    <?php endif; ?>

    <?php if (empty($mensaje)): ?>
      <form method="POST">
        <label>Nombre de usuario:</label>
        <input type="text" name="username" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <label>Nombre completo:</label>
        <input type="text" name="nombre_completo" required>

        <label>Correo electrónico:</label>
        <input type="email" name="email" required>

        <label>Seleccionar perfil:</label>
        <select name="id_perfil" required>
          <option value="">-- Selecciona un perfil --</option>
          <?php foreach ($perfiles as $perfil): ?>
            <option value="<?= $perfil['id_perfil'] ?>">
              <?= htmlspecialchars($perfil['nombre']) ?>
            </option>
          <?php endforeach; ?>
        </select>

        <label class="checkbox-label">
          <input type="checkbox" name="estado" checked> Activo
        </label>

        <button type="submit" class="btn-submit">Registrar Usuario</button>
      </form>

      <p class="register-link">
        ¿Ya tienes cuenta? <a href="index.php?a=login">Inicia sesión aquí</a>
      </p>
    <?php endif; ?>
  </div>

</body>
</html>
