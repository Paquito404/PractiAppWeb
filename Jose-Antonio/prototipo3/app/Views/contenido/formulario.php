<h1>Formulario</h1>
<p>Aqui tendras un formulario para subir proyectos</p>
<br></br>

<form action="<?php echo base_url('escuela')?>" method="post" autocomplete="off" enctype="multipart/form-data">

    <h2>Titulo</h2>
    <input type="text" name="Titulo" id="Titulo" required>
    <br>

    <h2>Carrera</h2>
    <input type="text" name="Carrera" id="Carrera" required>
    <br>

    <h2>Estatus</h2>
    <select name="Estatus" id="Estatus" required>
        <option value="">Seleccione una opción</option>
        <option value="Activo">Activo</option>
        <option value="Inactivo">Inactivo</option>
    </select>
    <br>

    <h2>Integrantes</h2>
    <input type="text" name="Integrantes" id="Integrantes" required>
    <br>

    <h2>Imagen (JPG)</h2>
    <input type="file" name="imagen" accept="image/jpeg" required>

    <br>
    <input type="submit" name="Subir" id="Subir">
    <br>

</form>