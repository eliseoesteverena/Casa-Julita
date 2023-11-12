
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Crear Cuenta - Casa Julita</title>
  <link rel="icon" type="image/x-icon" href="images/cj.ico">
  <link href="styles/style-register.css" rel="stylesheet" />
</head>
<body>
  
  <form method="POST" action="app/web/register_web.php" class="registro-form">
        <img class="cj_portada" src="images/icono.png" alt="Icono">
        <div id="msg">
        <?php
            $user_inexist = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Usuario inexistente, Registrate!</a>\";
                        </script>";
            $empty_fields = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Uno o más campos están vacios!</a>\";
                        </script>";
            $error_email = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Email invalido, Chequeálo!</a>\";
                        </script>";
            $error_name = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Que nombre más largo! Prueba uno más corto!</a>\";
                        </script>";
            $error_phone = "<script language=\"javascript\">
            document.getElementById(\"msg\").innerHTML = \"<a>Célular Invalido!</a>\";
                        </script>";
            if(isset($_GET["v"]) && $_GET["v"] == "user_inexist") {
              echo $user_inexist;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "empty_fields") {
              echo $empty_fields;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "error_email") {
              echo $error_email;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "error_phone") {
              echo $error_phone;
            }
            if(isset($_GET["v"]) && $_GET["v"] == "error_name") {
              echo $error_name;
            }
        ?>
      </div>
       <div class="container_names">
            <input type="text" id="name" class="names" name="name" placeholder="Nombre y Apellido">
            <input type="text" id="email" class="email" name="email" placeholder="Email">
        </div>

        <input type="text" id="phone" class="phone" name="phone" placeholder="Celular">
        <input type="password" id="password" class="password" name="password" placeholder="Contraseña">

        <input type="submit" id="register" class="register" name="register-btn" value="Crear Cuenta">
        
        <p></p>
       
        <br>
	<!--
        <span>O utiliza tu cuenta de:</span>
        <div class="container-auths">
            <button id="google_auth" class="google-btn">Google</button>
            <button id="fb_auth" class="fb-btn">Facebook</button>
	    <button id="apple_auth" class="apple-btn">Apple</button>
        </div>
	-->
	<span>¿Ya tenés una cuenta? <a href="login.php">Inicia Sesión</a></span>
    </form>
</body>
</html>