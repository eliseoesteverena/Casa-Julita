<?php

session_start();

if(isset($_SESSION['email'])){ 

  } else {
	header("Location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style-chat.css">
    <link rel="shortcut icon" href="images/cj.ico" />
    <title>Chat - Casa Julita</title>
	
	
</head>

<body onload="inicial(), altura()"><main>
        <aside class="right-side">
        </aside>
        <section class="content">
            <div class="container active" id="chatBox">
                <div class="content-header">
                    <div class="image">
                        <img src="images/icono.png" alt="">
                    </div>
                    <div class="icons">
                        <a class="click-file" onclick="altura()" aria-hidden="true">Archivos</a>
                        <a class="click-logout" href="app/web/session_control.php?v=cerrar_sesion" aria-hidden="true">Cerrar Sesión</a>
                    </div>
                </div>
                <div id= "chat-container" class="chat-container">
					
                </div>
				<div class="form-files">
					<div class="form-group">
                        <input multiple type="file" class="form-control" id="inputFiles">
                    	<br><br>
                    	<button id="btnUpFile" class="btn btn-success">Enviar</button>
						<br>
						<div class="alert alert-info" id="fileState"></div>
                    </div>
				</div>
                <div class="message-box">
                    <div class="message-content">
						<a class="click-clip" aria-hidden="true"></a>
						<input id="text_msg" name="nombre" class="form-control" type="text">
    					<button id="sendMsg-btn" type="button" onclick="sendMsg()" class="sent"></button>
                    </div>
                </div>
				
            </div>
        </section>
    </main>
	<script src="js/chat_web.js"></script>

</body>

</html>