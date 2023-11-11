<!--DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transferencia de archivos por AJAX</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@4.1.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Transferir archivos</h1>
                <a href="//parzibyte.me/blog"></a>
                <div class="form-group">
                <input multiple type="file" class="form-control" id="inputFiles">
                    	<br><br>
                    	<button id="btnUpFile" class="btn btn-success">Enviar</button>
						<br>
						<div class="alert alert-info" id="fileState"></div>
            </div>
            </div>
        </div>
    </div>
    <script>
        
const $inputArchivos = document.querySelector("#inputFiles"),
          $btnEnviar = document.querySelector("#btnUpFile"),
          $estado = document.querySelector("#fileState");
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
    const respuestaRaw = await fetch("upload_file.php", {
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

    </script>
</body>
</html-->
<?php
 //$var = getenv('INFO_ALL');
 $var = phpinfo(INFO_ALL);
 echo $var;
?>