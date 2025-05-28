<h1>Editar Práctica <?= $practica['ID'] ?></h1>
<p>Aqui se editará la practica especificada</p>
<br>

<form method="POST" id="formEditar" onsubmit="actualizarPractica(event, <?= $practica['ID'] ?>)" autocomplete="off" enctype="multipart/form-data">
    <h2>Titulo</h2>
    <input type="text" name="Titulo" id="Titulo" value="<?= $practica['Titulo'] ?>" required>
    <br>

    <h2>Carrera</h2>
    <input type="text" name="Carrera" id="Carrera" value="<?= $practica['Carrera'] ?>" required>
    <br>

    <h2>Estatus</h2>
    <select name="Estatus" id="Estatus" required>
        <option value="">Seleccione una opción</option>
        <option value="Activo" <?= $practica['Estatus'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
        <option value="Inactivo" <?= $practica['Estatus'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
    </select>
    <br>

    <h2>Integrantes</h2>
    <input type="number" name="Integrantes" id="Integrantes" value="<?= $practica['Integrantes'] ?>" required>
    <br>

    <h2>Actualizar Imagen (opcional)</h2>
    <input type="file" name="imagen" id="imagen" accept="image/jpeg">
    <br>

    <br>
    <input type="submit" value="Actualizar">
    <br>

</form>

