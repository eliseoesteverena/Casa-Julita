<?php
session_start();
include_once 'query_db.php';


    $msg_text = json_decode(file_get_contents("php://input"));
    // Aquí podemos procesar los datos
    $msg = $msg_text->msg_content;
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
?>