<?php
    // Include config file
    require_once "conexion.php";

    $dato1 = $_GET['id'];
    echo $dato1;


    $eliminar = "DELETE FROM areas WHERE id_area=$dato1";

    $resultado=mysqli_query($link, $eliminar);

    if ($resultado) {
        echo "<script>alert('Se eliminó el area');window.location='../abc_areas.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_areas.php'</script>";
    }mysqli_close($link);
?>




