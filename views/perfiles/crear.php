<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Perfil</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center">
                    <h3>📋 Crear Nuevo Perfil</h3>
                </div>

                <div class="card-body">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <?php if (!empty($mensaje)): ?>
                        <div class="alert alert-success"><?= $mensaje ?></div>
                    <?php endif; ?>

                    <form method="POST" class="needs-validation" novalidate>
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre del perfil <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control" required>
                            <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>

                        <!-- Permisos -->
                        <div class="mb-3">
                            <label class="form-label">Permisos (separados por comas)</label>
                            <input type="text" name="permisos" class="form-control" placeholder="crear,editar,eliminar">
                        </div>

                        <!-- Estado -->
                        <div class="form-check mb-3">
                            <input type="checkbox" name="estado" id="estado" class="form-check-input" checked>
                            <label for="estado" class="form-check-label">Activo</label>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="index.php?a=listar" class="btn btn-secondary">
                                🔙 Volver al listado
                            </a>
                            <button type="submit" class="btn btn-success">
                                💾 Guardar Perfil
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS (opcional para validaciones y componentes) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Validación del formulario con Bootstrap
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();
</script>

</body>
</html>
