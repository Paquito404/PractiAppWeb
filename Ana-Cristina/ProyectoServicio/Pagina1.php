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
  background-color: rgb(3, 3, 248);
  color: white;

}
.btn-subirProyecto {
  background-color: rgb(3, 3, 248);
  color: white;
}
.btn-Papelera {
  background-color: rgb(3, 3, 248);
  color: white;
}

.btn:hover {
  opacity: 0.8;
}
table{
  border-collapse: collapse;
  width: 97%;
color:rgb(0, 0, 0);
background-color:rgb(152, 161, 239);
}
td,th{
  border: 1px solid #333; /* Color del borde */
        padding: 10px;
        text-align: left;
}
#Logo{
  margin: 0;
    display: inline-block;
  }

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
  <table id="miTabla">
        <thead>
            <tr>
               
            </tr>
        </thead>
        <tbody>
          
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                  
                    <td><?php echo "<b>Titulo: </b>".$row['Titulo']; echo "<br> <b>Carrera: </b> ".$row['Carrera']; echo "<br> <b>Integrantes: </b> ".$row['NumVac']; ?></td>
                    <td><img src="imagen.php?id=<?= $row['ProyectoID'] ?>"  width="100" height="100" alt="ImagenProyecto"></td>
                 </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </center>

    
<script>
  // Seleccionamos la tabla
  const tabla = document.getElementById("miTabla");

  // Agregamos un evento a cada fila del tbody
  for (let fila of tabla.tBodies[0].rows) {
    fila.addEventListener("click", function() {
      let datos = [];
      for (let celda of this.cells) {
        datos.push(celda.textContent);
        
      //datos.push(tabla.tBodies[0].$row['Horario']);

      }
      alert("Datsssos seleccionados:\n" + datos.join("/ ") );
    });
  }
</script>

    
</body>


</html>

