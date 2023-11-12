<?php

require_once 'database/query_db.php';
require_once 'database/connect.php';

function json_conversation($conexion_datebase_user, $consulta) {
  $miArray = array();
  $result = get_result_db($conexion_datebase_user, $consulta);
if($result != false) {
  while($row = $result->fetch_assoc()) {
    $arr = array(
        $row['id_msg'],
        $row['type_msg'],
        $row['msg_preview'],
        $row['msg_content'],
        $row['id_person_sent'],
        $row['name_person_sent'],
        $row['msg_datetime'],
        $row['msgs_not_reader'],
      );

    $conversation[] = $arr;
  }
  return json_encode($conversation);
} else {
  return false;
}
}

?>