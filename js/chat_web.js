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
    if(document.querySelector("#text_msg").value.length != 0) {
        sendText();
    }
    if(document.getElementById("inputFiles").length > 0) {
        upFile();
    }
}
function sendText() {
    const $msgText = document.querySelector("#text_msg"),
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
            showConveresation()
        });
    $msgText.value = "";
}

function openWindowFile() {
    var el = document.getElementById("inputFiles");
    if (el) {
        el.click();
    }
    document.getElementById('sendMsg-btn').style.display = "none";
    document.getElementById('text_msg').style.display = "none";
    document.getElementById('btnUpFile').style.display = "block";
    el.style.display = "block";
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
    console.log("Enviando archivos...");
    const respuestaRaw = await fetch("./app/web/upload_file.php", {
    method: "POST",
    body: formData,
    });
    const respuesta = respuestaRaw.json();
    // Puedes manejar la respuesta como tú quieras
    console.log({ respuesta });
    // Finalmente limpiamos el campo
    $inputArchivos.value = null;
    $inputArchivos.style.display = "none";
    document.getElementById('btnUpFile').style.display = "none";
    document.getElementById('text_msg').style.display = "block";
    document.getElementById('sendMsg-btn').style.display = "block";

    console.log("Archivos enviados");
    });
}