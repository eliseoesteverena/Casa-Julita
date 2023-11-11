
<?php
$hostname_cj_prueba = "localhost";
$database_user_cj_prueba = "cj-prueba";
$username_cj_prueba = "register_new_user";
$password_cj_prueba = "elnuevo2023";

// Create connection
$conexion_datebase_user = new mysqli($hostname_cj_prueba,$username_cj_prueba,$password_cj_prueba,$database_user_cj_prueba);

// Check connection
if ($conexion_datebase_user->connect_error) {
  die("Connection failed: " . $conexion_datebase_user->connect_error);
} 

?>