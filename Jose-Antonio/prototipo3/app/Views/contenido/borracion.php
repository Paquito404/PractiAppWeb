<h1 class="texto-practica">Detalles de la Práctica</h1>

<div class="tabla-contenedor">
    <?php if (isset($practica)): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Carrera</th>
                <th>Estatus</th>
                <th>Integrantes</th>
            </tr>
            <tr>
                <td><?= htmlspecialchars($practica['ID']) ?></td>
                <td><?= htmlspecialchars($practica['Titulo']) ?></td>
                <td><?= htmlspecialchars($practica['Carrera']) ?></td>
                <td><?= htmlspecialchars($practica['Estatus']) ?></td>
                <td><?= htmlspecialchars($practica['Integrantes']) ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p>No se encontraron datos para esta práctica.</p>
    <?php endif; ?>
</div>

<?php
    // Ruta a la imagen
    $imagenPath = base_url('imagenes/' . $practica['ID'] . '-' . $practica['Carrera'] . '.jpg');
    $imagenArchivo = FCPATH . 'imagenes/' . $practica['ID'] . '-' . $practica['Carrera'] . '.jpg';
?>

<?php if (file_exists($imagenArchivo)): ?>
    <div style="text-align: center; margin-top: 20px;">
        <h3>Imagen de la Práctica</h3>
        <img src="<?= $imagenPath . '?v=' . time() ?>" alt="Imagen de la práctica" width="200" height="200" style="object-fit: cover; border: 1px solid #ccc;">
    </div>
<?php else: ?>
    <div style="text-align: center; margin-top: 20px;">
        <p><em>No hay imagen asociada a esta práctica.</em></p>
    </div>
<?php endif; ?>

<div class="botones-tabla">
    <button onclick="fase(<?= $practica['ID'] ?>)">Restaurar</button>
    <button onclick="eliminarPractica(<?= $practica['ID'] ?>)">Eliminar definitivamente</button>
</div>