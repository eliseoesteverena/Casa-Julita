<?PHP

require_once 'database/connect.php';
require_once 'database/query_db.php';

/* --------- FUNCIONES --------- */

function register($conexion_datebase_user, $new_user_data) {
  $check_email = verify_email($conexion_datebase_user, $new_user_data[0]);
  if ($check_email === false) {
      if (insert_new_user($conexion_datebase_user, $new_user_data) == true) {
    
        if(create_conversation($conexion_datebase_user, $new_user_data) == true) { 
            if(register_new_conversation($conexion_datebase_user, $new_user_data) == true) {
              $conexion_datebase_user->close();
              header("Location: ../../login.php?v=user_create");
            } else {
                $conexion_datebase_user->close();
                echo "<h1> Error en register_new_conversation";
              }
        } else {
            $conexion_datebase_user->close();
            echo "<h1>Error en create_conversation</h1>";
        }
      } else {
          $conexion_datebase_user->close();
          echo "<h1>Error en register_new_user</h1>";
      }
    } else {
        $conexion_datebase_user->close();
        return header("Location: ../login.php?v=user_exist");;
    }
  
  }


function insert_new_user($conexion_datebase_user, $new_user_data){
  $consulta="INSERT INTO users(email_user, name_user, password, phone, name_conversation) 
  VALUES (
    '{$GLOBALS['new_user_data'][0]}',
    '{$GLOBALS['new_user_data'][1]}',
    '{$GLOBALS['new_user_data'][2]}', 
    '{$GLOBALS['new_user_data'][3]}',
    '{$GLOBALS['new_user_data'][4]}'
  )";

  if (go_query_db($conexion_datebase_user, $consulta) == true) {
    return true;
  } else {
    echo "<h1> Error en insertnewuser </h1>";
  }
}

function create_conversation($conexion_datebase_user, $new_user_data) {
  $name_conversation = $new_user_data[4];
   $consulta = "CREATE TABLE {$name_conversation} (
    id_msg INT(25) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    type_msg CHAR(6),
    msg_preview VARCHAR(50),
    msg_content LONGTEXT,
    id_person_sent INT(25) ,
    name_person_sent VARCHAR(40),
    msg_datetime TIMESTAMP NOT NULL , 
    msgs_not_reader INT(15) DEFAULT 0
    )";

if (go_query_db($conexion_datebase_user, $consulta) == true) {
  return true;
} else {
  echo "<h1> Error en create_conversation </h1>";
}
}

function register_new_conversation($conexion_datebase_user, $new_user_data) {
  $consulta = "INSERT INTO conversations(name_conversation, id_user, name_user)
               VALUES (
                      '{$new_user_data[0]}', 
                      '{$new_user_data[4]}',
                      '{$new_user_data[1]}'
              )";
  if (go_query_db($conexion_datebase_user, $consulta) == true) {
  return true;
  } else {
  echo "<h1> Error en register_new_conversation </h1>";
  }
}

?>