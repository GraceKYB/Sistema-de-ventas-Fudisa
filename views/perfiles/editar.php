<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
     <link rel="stylesheet" href="css/editarPerfil.css"> 
</head>
<body>

<div class="container">
    <h2>✏️ Editar Perfil</h2>

    <?php if (!empty($error)) echo "<div class='alert error'>$error</div>"; ?>
    <?php if (!empty($mensaje)) echo "<div class='alert success'>$mensaje</div>"; ?>

    <form method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($perfilData['nombre']) ?>" required>

        <label>Permisos (coma separados):</label>
        <input type="text" name="permisos" value="<?= htmlspecialchars($perfilData['permisos']) ?>">

        <label class="checkbox-label">
            <input type="checkbox" name="estado" <?= $perfilData['estado'] ? 'checked' : '' ?>> Activo
        </label>

        <button type="submit">💾 Guardar Cambios</button>
        <a href="index.php?a=listar">← Cancelar y volver</a>
    </form>
</div>

</body>
</html>
