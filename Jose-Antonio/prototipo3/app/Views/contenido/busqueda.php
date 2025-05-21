<h1>Información Detallada</h1>

<?php if (isset($fila)): ?>
    <table border="1" cellpadding="10">
        <tr><th>Campo</th><th>Valor</th></tr>
        <tr><td>ID</td><td><?= htmlspecialchars($fila['ID']) ?></td></tr>
        <tr><td>Nombre</td><td><?= htmlspecialchars($fila['nombre']) ?></td></tr>
        <tr><td>Propiedad</td><td><?= htmlspecialchars($fila['propiedad']) ?></td></tr>
        <tr><td>Origen</td><td><?= htmlspecialchars($origen) ?></td></tr>
    </table>
<?php else: ?>
    <p>No se encontró información para mostrar.</p>
<?php endif; ?>

<br>
<button onclick="loadContent('buscar')">← Volver</button>