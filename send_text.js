function sendMsg() {
    const $msgText = document.querySelector("#text_msg"),
        $btnEnviar = document.querySelector("#sendMsg-btn"), // El botón que envía el formulario
        $chat = document.querySelector("#chat-container"); // el div que muestra mensajes

    const msgContent = {
        msg_content: $msgText.value,
    };
    // Codificarlo como JSON
    const msgJson = JSON.stringify(msgContent);
    //$chat.textContent = msgJson;
    // Enviarlos
    fetch("app/send_text.php", {
            method: "POST", // Enviar por POST
            body: msgJson, // En el cuerpo van los datos
        })
        .then(respuestaCodificada => respuestaCodificada.json()) // Decodificar JSON que nos responde PHP
        .then(respuestaDecodificada => {
            // Aquí ya tenemos la respuesta lista para ser procesada
            //$chat.textContent = respuestaDecodificada;
            showConveresation()
        });
        $msgText.value = "";
}
function inicial() {
    showConveresation();
}
function altura() {
    $chat = document.querySelector("#chat-container");
    //$chataltura = $chat.width;
    $('body, html').animate({
        scrollTop: '9999999px'
    }, 0);
}
function showConveresation() {
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
           document.getElementById("chat-container").innerHTML = this.responseText;
    }
    xhttp.open("GET", "app/chat_web.php");
    xhttp.send();
    
}
function reloadConversation() {
      identificadorIntervaloDeTiempo = setInterval(showConveresation, 5000);
}
