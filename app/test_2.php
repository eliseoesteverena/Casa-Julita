<?php
session_start();
include_once 'query_db.php';

$conteo = count($_FILES["archivos"]["name"]);
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

/*
$msg_text = json_decode(file_get_contents("php://input"));
// Aquí podemos procesar los datos
$msg = $msg_text->msg_content;
//file_put_contents("datos.txt", "Mensaje: $msg\n", FILE_APPEND);
//echo json_encode("Mensaje: {$nombre}");

sendMsg($msg, $conexion_datebase_user);



function sendMsg($msg, $conexion_datebase_user) {
    $type_msg = "text";
    $prevw_msg = substr($msg, 0, 50);
    $msg_content = $msg;
        $consulta="INSERT INTO {$_SESSION['name_conversation']}(type_msg, msg_preview, msg_content, id_person_sent, name_person_sent) 
                        VALUES (
                            '{$type_msg}',
                            '{$prevw_msg}',
                            '{$msg_content}', 
                            '{$_SESSION['id_user']}',
                            '{$_SESSION['name_user']}'
                            )";

        if (go_query_db($conexion_datebase_user, $consulta) == true) {
            echo json_encode("Mensaje");
        } else {
            echo "<h1> Error en insert msg </h1>";
        }
    }
    */
?>