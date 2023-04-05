<?php
    // Include config file
    require_once "conexion.php";

    $dato1 = $_GET['id'];
    echo $dato1;


    $eliminar = "DELETE FROM usuarios WHERE id_usuario=$dato1";

    $resultado=mysqli_query($link, $eliminar);

    if ($resultado) {
        echo "<script>alert('Se elimino el usuario');window.location='../abc_usuarios.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_usuarios.php'</script>";
    }mysqli_close($link);
?>



