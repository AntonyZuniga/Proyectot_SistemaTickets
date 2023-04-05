<?php
    // Include config file
    require_once "conexion.php";

    $dato1 = $_GET['id'];
    echo $dato1;


    $eliminar = "DELETE FROM estatus WHERE id_estatus=$dato1";

    $resultado=mysqli_query($link, $eliminar);

    if ($resultado) {
        echo "<script>alert('Se eliminó el estátus');window.location='../abc_estatus.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_estatus.php'</script>";
    }mysqli_close($link);
?>
