<?php

session_start();
if(isset($_SESSION['email'])){ 
	header("Location: chat.php");
  } else {

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar Sesión - Casa Julita</title>
  <link rel="icon" type="image/x-icon" href="images/cj.ico">
  <link href="styles/style-login.css" rel="stylesheet" />

</head>
<body>

  <form class="registro-form" method="POST" action="app/web/login_web.php">
        <img class="cj_portada" src="images/icono.png" alt="Icono">
        
        <div id="msg">
        <?php
            $user_exist = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Usuario existente, Inicia sesión!</a>\";
                        </script>";
            $pass_incorect = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Contraseña Incorrecta, Intenta de nuevo!</a>\";
                        </script>";
            $user_create = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Usuario creado con Exito. ¡Inicia Sesión!</a>\";
                        </script>";
            $error_email = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Email invalido, Chequeálo!</a>\";
                        </script>";
            if(isset($_GET["v"]) && $_GET["v"] == "user_exist") {
              echo $user_exist;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "incorrect") {
              echo $pass_incorect;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "error_email") {
              echo $error_email;
            }
            else if (isset($_GET["v"]) && $_GET["v"] == "user_create") {
              echo $user_create;
            }
        ?>
        </div>
        
        <input type="text" id="email" name="email" class="email" placeholder="Email">
        
        <input type="password" id="password" name="password" class="password" placeholder="Contraseña">

        <input type="submit" id="login" class="login" value="Iniciar Sesión">
	<!--
        <p>O utiliza tu cuenta de:</p>

        <div class="container-auths">
            <button id="google_auth" class="google-btn">Google</button>
            <button id="fb_auth" class="fb-btn">Facebook</button>
        </div>
	-->
	<p>¿Aún no tenés una cuenta? <a href="register.php">Registrate</a></p>
    </form>
</body>
</html>