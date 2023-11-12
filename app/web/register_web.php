<?php 

require_once '../main/database/connect.php';
include_once '../main/register.php';

$email_user= htmlspecialchars(strval($_POST['email']));
$name_user= htmlspecialchars(strval($_POST['name']));

$password_user= htmlspecialchars(strval($_POST['password']));
$passCifrada = htmlspecialchars(password_hash($password_user, PASSWORD_DEFAULT));

$phone_user= htmlspecialchars(strval($_POST['phone']));

/*--- Establecer nombre de Conversación a travez del email ingresado ----*/
$char_d = array("@",".","-");
$replace = array("");
$name_conversation = utf8_decode($email_user);
$name_conversation = str_replace($char_d,$replace,$name_conversation); // Reemplaza caracteres especiales y asigna valor
/*---------------------------------------------------------------*/

if(isset($email_user) && isset($name_user) && isset($phone_user) && isset($password_user)) {
    $char_d = "@";
    $char_e = ".";
    if(strpos($email_user, $char_d) != false && strpos($email_user, $char_e) != false ){
        if(is_numeric($phone_user) != false) {
            if(strlen($name_user) > 3 && strlen($name_user) <= 25){

                $new_user_data = array($email_user, $name_user, $passCifrada, $phone_user, $name_conversation);
                register($conexion_datebase_user, $new_user_data);

            } else { return header("Location: ../../register.php?v=error_name"); }
        } else { return header("Location: ../../register.php?v=error_phone");  }
    } else { return header("Location: ../../register.php?v=error_email"); }

} else {
    return header("Location: ../../register.php?v=empty_fields");
}
  
?>