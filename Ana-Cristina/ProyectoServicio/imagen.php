<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$serverName = "LAPTOP-ML68ABC3";
$connectionOptions = [
    "Database" => "Uni",
    "Uid" => "sa",
    "PWD" => "Santiago00",
    "CharacterSet" => "UTF-8"
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

$sql = "SELECT Imagen FROM Proyectos WHERE ProyectoID = ?";
$params = [$id];
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt && $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    if ($row['Imagen']) {
        header("Content-Type: image/jpg"); // Cambia si usas PNG o GIF
        echo $row['Imagen'];
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
}
