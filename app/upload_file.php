<?php
session_start();
include_once 'query_db.php';

$conteo = count($_FILES["archivos"]["name"]);
//$upload_dir = './archivos/';
for ($i = 0; $i < $conteo; $i++) {
    $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
    $nombreArchivo = $_FILES["archivos"]["name"][$i];
    $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    // Renombrar archivo
    $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
    // Mover del temporal al directorio actual
    move_uploaded_file($ubicacionTemporal, $nuevoNombre);
}
// Responder al cliente
echo json_encode(true);

?>