<?php
    // Include config file
    require_once "conexion.php";

    $dato1 = $_GET['id'];
    echo $dato1;


    $eliminar = "DELETE FROM rol WHERE id_rol=$dato1";

    $resultado=mysqli_query($link, $eliminar);

    if ($resultado) {
        echo "<script>alert('Se eliminó el rol');window.location='../abc_roles.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_roles.php'</script>";
    }mysqli_close($link);
?>



