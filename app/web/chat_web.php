<?php
session_start();

require_once '../main/json_conversation.php';
$name_conversation = $_SESSION['name_conversation'];

$consulta="SELECT
            id_msg,
            type_msg, 
            msg_preview, 
            msg_content, 
            id_person_sent, 
            name_person_sent, 
            msg_datetime, 
            msgs_not_reader 
            FROM {$name_conversation} ORDER BY msg_datetime ASC";

$json_result = json_conversation($conexion_datebase_user, $consulta);
if($json_result != false) {
    $conversation = json_decode($json_result, false);
    $msg_quantity = count($conversation);
        for($i=0; $i < $msg_quantity; $i++) {
            if($_SESSION['id_user'] == $conversation[$i][4]){
                $class = "me";
            } else {
                $class = "friend";
            }
            echo "<div class=\"msg-container\"><div class=\"chat-msg " . $class . "\"><p>"  . $conversation[$i][3] . "</p><div class=\"send-person\">" . $conversation[$i][5] . "</div><div class=\"time\">" . $conversation[$i][6] . "</div></div></div>";
        }
} else {
    echo " ";
}

?>