<?php
// Configuración de conexión a SQL Server
$serverName = "LAPTOP-ML68ABC3"; // o IP del servidor
$connectionOptions = array(
    "Database" => "Uni",
    "Uid" => "sa",
    "PWD" => "Santiago00",
    "CharacterSet" => "UTF-8"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT * FROM Proyectos";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>

body{
        color: rgb(0, 0, 0); 
        font-family: Arial, sans-serif; 
        margin: 0;
        height: 10;
}
.btn {
  margin: 10px;
  font-size: 16px;
  cursor: pointer;
  border: none;
  border-radius: 0%;
  gap: 3px;
  display: inline-block;
  
}

.btn-Proyecto {
  margin:0%;
  background-color:rgb(23, 26, 181);
  color: white;

}
.btn-subirProyecto {
  background-color:rgb(23, 26, 181);
  color: white;
}
.btn-Papelera {
  background-color:rgb(23, 26, 181);
  color: white;
}

.btn:hover {
  opacity: 0.8;
}
table{
  border-collapse: collapse;
  width: 80%;
color:rgb(0, 0, 0);
}
td,th{
  border: 1px solid #333; /* Color del borde */
        padding: 10px;
        text-align: left;
}
#Logo{
  margin: 0;
    display: inline-block;}

#cabecera    #texto{
  display: inline-block;
  vertical-align: top;
}
.icon-container {
  border-radius: 0%;
  padding: 5px;
  box-shadow: 0  0px 10px rgba(162, 15, 15, 0);
  display: inline;
}

.contenedor {
    float: right;
       background-color: rgb(3, 3, 248); 
        width: 100%; 
        margin: 0px ;
    }
   
.ImagenProyecto{
  height: 100;
  width: 50;
}   
.color{
  background-color: #3848d6;
}
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tus proyectos</title>

</head>
<body>



<div id="cabecera">
<div id= "Logo" >
<img src="https://buhos.uson.mx/web/resources/images/logo-unison.png" alt="Universidad" width="34" height="30">Practicas profesionales unison</div>
</div>

  <div class="contenedor">  
   
    <button class="btn btn-Proyecto", onclick="window.location.href='http://localhost/app_ci4/public/ProyectoServicio/Pagina1.php'"> <i class="fas fa-proyecto-circle"></i> Tus proyectos</button>
    <button class="btn btn-subirProyecto", onclick="window.location.href='http://localhost/app_ci4/public/ProyectoServicio/Pagina2.php'"> <i class="fas fa-check-circle"></i> Subir proyecto</button>
    <button class="btn btn-Papelera", onclick="window.location.href='http://localhost/app_ci4/public/ProyectoServicio/Pagina3.php'"> <i class="fas fa-exclamation-circle"></i> Papelera</button> 
    
  </div>

<br><br><br><br><br>
<center>
  <form><input type="file" id="imagen" accept="image/*"></form>
    <div class="contImage">
    <img id="vistaPrevia" src="" alt="Vista previa" style="max-width: 150px; display: none; position: fixed;"></div>
    <div>
   <form>
        <br>
        <input type="text" id="Titulo" name="Titulo" placeholder="Ingresa el ttulo">
        <input type="text" id="Descripcion" name="Descripcion" placeholder="Ingresa descripción">
        <input type="text" id="Requisitos" name="Requisitos" placeholder="Ingresa requisitos"><br>
        <input type="text" id="Vacantes" name="Vacantes " placeholder="Vacantes">
        <form>
            <select id="Carreras" name="carreras">
                <option value="Isi">Selecciona la carrera </option>
                <option value="Isi">Ingenieria en sisitemas</option>
                <option value="Lic">Licenciatura en educación</option>
                <option value="Gast">Gastronomia</option>
            </select>
        </form>
        <input type="text" id="Apoyo" name="Apoyo" placeholder="Ingresa Cantidad">
        <input type="text" id="Horario" name="Horario" placeholder="Ingresa Horario"><br>
        <input type="text" id="Periodo" name="Periodo " placeholder="Vacantes">
        <input type="text" id="Ubicacion" name="Periodo " placeholder="Vacantes">
        
        <!-- Botón para enviar el formulario -->
         <br><br><br>
        <button type="submit">Subir Proyecto</button>
        <button type="submit">Cancelar</button>

    </center>
    </form>

    <script class="contenedor2">
        // Obtener el elemento del input y la imagen de vista previa
        const inputFile = document.getElementById('imagen');
        const vistaPrevia = document.getElementById('vistaPrevia');

        // Cuando el usuario selecciona una imagen
        inputFile.addEventListener('change', function (event) {
            const archivo = event.target.files[0];
            if (archivo) {
                const lector = new FileReader();

                // Cuando el archivo se carga, se establece como fuente de la imagen
                lector.onload = function(e) {
                vistaPrevia.src = e.target.result;
                vistaPrevia.style.display = 'block'; // Muestra la imagen
                };

                // Leer el archivo como una URL
                
                lector.readAsDataURL(archivo);
            }
        });
    
    </script>


    </center>
</body>
</html>