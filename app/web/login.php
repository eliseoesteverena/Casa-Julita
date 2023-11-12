<?php

require_once '../main/database/connect.php';
require_once '../main/database/query_db.php';


$GLOBALS['email_user']= htmlspecialchars(strval($_POST['email']));
$GLOBALS['password_user'] = htmlspecialchars(strval($_POST['password']));

// Si los campos no están vacios continua con el proceso de registro
if(isset($GLOBALS['email_user']) && isset($GLOBALS['password_user'])) {
  $check_email = verify_email($conexion_datebase_user, $email_user);
  if ($check_email != false) { // si no existe
    login_user($conexion_datebase_user, $email_user, $password_user);
  } else {
    $conexion_datebase_user->close();
    return header("Location: ../register.php?v=user_inexist");
  }

}

function login_user($conexion_datebase_user, $email_user, $password_user) {
    $consulta = "SELECT password FROM users WHERE email_user LIKE '$email_user'"; 
    $result = get_result_db($conexion_datebase_user, $consulta);

    while($row = $result->fetch_assoc()) {
      $result_pass = $row["password"];
    }

    if (password_verify($password_user, $result_pass)) {
        session_start();
        $_SESSION['email'] = $GLOBALS['email_user'];
        $result = get_data_user($conexion_datebase_user, $email_user);

        while($row = $result->fetch_assoc()) {
          $_SESSION['id_user'] = $row["id"];
          $_SESSION['name_user'] = $row["name_user"];
          $_SESSION['phone_user'] = $row["phone"];
          $_SESSION['name_conversation'] = $row["name_conversation"];
          $_SESSION['id_table_files'] = $row["id_table_files"];
        }
        return header("Location: ../../chat.php");
    }
    else {
        return header("Location: ../../login.php?v=incorrect");
    }

}

?>