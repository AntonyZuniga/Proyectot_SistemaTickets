<?php

$contenido = $_POST['contenido']; 
$fecha = $_POST['fecha'];

If (unlink("$fecha.txt")) {
    // file was successfully deleted 
  } else {
    // there was a problem deleting the file 
  }

$archivo = fopen("$fecha.txt",'a');  

fputs($archivo,$contenido); 

fclose($archivo);  

echo "<script>alert('Se creó archivo txt');window.location='$fecha.txt';</script>"
?>