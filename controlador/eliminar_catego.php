<?php
    // Include config file
    require_once "conexion.php";

    $dato1 = $_GET['id'];
    echo $dato1;


    $eliminar = "DELETE FROM categorias WHERE id_categoria=$dato1";

    $resultado=mysqli_query($link, $eliminar);

    if ($resultado) {
        echo "<script>alert('Se eliminó la categoría');window.location='../abc_categoria.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_categoria.php'</script>";
    }mysqli_close($link);
?>






