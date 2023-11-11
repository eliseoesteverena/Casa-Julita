<?PHP

require_once 'connect.php';


function verify_email($conexion_datebase_user, $email_user) {
    $email_in_db = "SELECT email_user FROM users WHERE email_user LIKE '{$GLOBALS['email_user']}'";
  
    $query_verify_email = mysqli_query($conexion_datebase_user, $email_in_db);
    
      if ($query_verify_email->num_rows > 0) {
          return true; // existe
        } else {
          return false;
        }
  }

function go_query_db($conexion_datebase_user, $consulta) {
    if(mysqli_query($conexion_datebase_user, $consulta)) {
        return true;
    } else {
        echo "error $consulta";
    }
}

function get_result_db($conexion_datebase_user, $consulta) {
        $result = mysqli_query($conexion_datebase_user, $consulta);
        if(mysqli_num_rows($result) > 0) {
            return $result;
    
        } else {
            return false;
        }
    $conexion_datebase_user->close();
}

function get_data_user($conexion_datebase_user, $email_user) {
    $consulta = "SELECT id, email_user, name_user, phone, name_conversation, id_table_files FROM users WHERE email_user LIKE '{$GLOBALS['email_user']}'";
    $result = get_result_db($conexion_datebase_user, $consulta);
    if(mysqli_num_rows($result) > 0) {
        return $result;

    } else {
        echo "error";
    }
$conexion_datebase_user->close();

}
?>