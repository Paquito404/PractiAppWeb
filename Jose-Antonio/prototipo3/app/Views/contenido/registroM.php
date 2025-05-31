<h1>Registro para Maestros</h1>
<p>Este apartado se enfoca en registrar maestros</p>
<br></br>

<form action="<?php echo base_url('registroM')?>" method="post" autocomplete="off" enctype="multipart/form-data">

    <h2>Nombre</h2>
    <input type="text" name="nombre" id="nombre" required>
    <br>

    <h2>Departamento</h2>
    <input type="text" name="departamento" id="departamento" required>
    <br>

    <h2>Correo</h2>
    <input type="text" name="correo" id="correo" required>
    <br>

    <h2>Password</h2>
    <input type="text" name="password" id="password" required>
    <br>

    <h2>Imagen (JPG)</h2>
    <input type="file" name="imagen" accept="image/jpeg" required>

    <br>
    <input type="submit" name="Subir" id="Subir">
    <br>

</form>