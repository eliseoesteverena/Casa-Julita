<?php
session_start();

include_once '../main/database/query_db.php';
require_once '../main/database/connect.php';

if(isset($_FILES["archivos"])) {
    if(upFile($conexion_datebase_user) != true) {
        return json_encode(false);
    } else {
        return json_encode(true);
    }
}
function upFile($conexion_datebase_user) {
    $conteo = count($_FILES["archivos"]["name"]);
    $upload_dir = '../../archivos';
    for ($i = 0; $i < $conteo; $i++) {
        $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
        $nombreArchivo = $_FILES["archivos"]["name"][$i];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        // Mover del temporal al directorio "archivos"
        move_uploaded_file($ubicacionTemporal, $upload_dir . "/" . $nombreArchivo);
        $upload_dir = "http://" . "$_SERVER[HTTP_HOST]" . "$_SERVER[REQUEST_URI]" . "\/archivos\/" . $nombreArchivo;
        insertFiles_db($conexion_datebase_user, $nombreArchivo, $upload_dir);
    }
    
    return true;
}

function insertFiles_db($conexion_datebase_user, $nombreArchivo, $upload_dir) {
    $consulta="INSERT INTO {$_SESSION['name_conversation']}(type_msg, msg_preview, msg_content, id_person_sent, name_person_sent) 
                        VALUES (
                            'file',
                            '$nombreArchivo',
                            '$upload_dir', 
                            '{$_SESSION['id_user']}',
                            '{$_SESSION['name_user']}'
                            )";
    if (go_query_db($conexion_datebase_user, $consulta) == true) {
        return true;
    } else {
        return false;
    }
}

?>