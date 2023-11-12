function inicial() {
    showConveresation();
    upFile();
}

function altura() {
    $('body, html').animate({
        scrollTop: '9999999px'
    }, 0);
}
function showConveresation() {
    const xhttp = new XMLHttpRequest();
      xhttp.onload = function() {
           document.getElementById("chat-container").innerHTML = this.responseText;
    }
    xhttp.open("GET", "./app/web/chat_web.php");
    xhttp.send();
    
}
function reloadConversation() {
      identificadorIntervaloDeTiempo = setInterval(showConveresation, 5000);
}
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
    fetch("./app/main/send_text.php", {
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
function upFile() {
    const $inputArchivos = document.getElementById("inputFiles"),
    $btnEnviar = document.getElementById("btnUpFile"),
    $estado = document.getElementById("fileState");
    $btnEnviar.addEventListener("click", async () => {
    const archivosParaSubir = $inputArchivos.files;
    if (archivosParaSubir.length <= 0) {
    // Si no hay archivos, no continuamos
    return;
    }
    // Preparamos el formdata
    const formData = new FormData();
    // Agregamos cada archivo a "archivos[]". Los corchetes son importantes
    for (const archivo of archivosParaSubir) {
    formData.append("archivos[]", archivo);
    }
    // Los enviamos
    $estado.textContent = "Enviando archivos...";
    const respuestaRaw = await fetch("./app/upload_file.php", {
    method: "POST",
    body: formData,
    });
    const respuesta = respuestaRaw.json();
    // Puedes manejar la respuesta como tú quieras
    console.log({ respuesta });
    // Finalmente limpiamos el campo
    $inputArchivos.value = null;
    $estado.textContent = "Archivos enviados";
    });
}