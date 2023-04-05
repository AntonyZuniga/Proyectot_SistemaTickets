<?php
    // Include config file
    require_once "conexion.php";

    $id = $_POST['id'];
    $estatus = $_POST['estatus'];


    $actualizar = "UPDATE estatus SET estatus='$estatus' WHERE id_estatus='$id'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se actualizo el estatus');window.location='../abc_estatus.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='../abc_estatus.php'</script>";
    }mysqli_close($link);
?>
