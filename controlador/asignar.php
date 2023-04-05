<?php
    // Include config file
    require_once "conexion.php";

    // Define variables and initialize with empty values
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate rol
        if(empty(trim($_POST["asignar"]))){
            $asignar_err = "Por favor asigna a alguien de soporte.";     
        }else{
            $asignar = trim($_POST["asignar"]);
        }
    }

    $asignar = trim($_POST["asignar"]);
    $id = trim($_POST['id']);
    $estatus = trim($_POST['estatus']);

    $actualizar = "UPDATE reportes SET id_asignado_a=$asignar, id_estatus=$estatus WHERE id_reporte=$id";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se asignó correctamente');window.location='../recepcion.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='../recepcion.php'</script>";
    }mysqli_close($link);
?>

