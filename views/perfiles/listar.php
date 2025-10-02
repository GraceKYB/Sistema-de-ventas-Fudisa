<h2>Listado de Perfiles</h2>
<a href="index.php?a=crear" style="text-decoration:none; padding:8px 12px; background:green; color:#fff; border-radius:5px;">+ Nuevo Perfil</a>

<br><br>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <tr style="background:#f2f2f2;">
        <th>ID</th>
        <th>Nombre</th>
        <th>Permisos</th>
        <th>Estado</th>
        <th>Fecha de creación</th>
        <th>Acciones</th>
    </tr>

    <?php while ($row = $perfiles->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?= $row["id_perfil"] ?></td>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td><?= htmlspecialchars($row['permisos']) ?></td>
            <td style="color: <?= $row['estado'] ? 'green' : 'red' ?>">
                <?= $row['estado'] ? 'Activo' : 'Inactivo' ?>
            </td>
            <td><?= date("d/m/Y H:i", strtotime($row['fecha_creacion'])) ?></td>
            <td>
                <a href="index.php?a=editar&id=<?= $row['id_perfil'] ?>" 
                   style="text-decoration:none; padding:5px 10px; background:blue; color:white; border-radius:4px;">
                    ✏️ Editar
                </a>
            </td>
        </tr>
    <?php } ?>
</table>
