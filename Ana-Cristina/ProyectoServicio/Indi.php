<?php
// Configuración de conexión a SQL Server
$serverName = "LAPTOP-ML68ABC3"; // o IP del servidor
$connectionOptions = array(
    "Database" => "Universidad",
    "Uid" => "sa",
    "PWD" => "Santiago00",
    "CharacterSet" => "UTF-8"
);

// Conectar
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Verificar conexión
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta
$sql = "SELECT * FROM empleados";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Empleados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Empleados</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Departamento</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['puesto']; ?></td>
                    <td><?php echo $row['salario']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Cerrar conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
