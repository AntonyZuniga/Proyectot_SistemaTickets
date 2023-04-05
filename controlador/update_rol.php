<?php
    // Include config file
    require_once "conexion.php";

    $id = $_POST['id'];
    $rol = $_POST['rol'];


    $actualizar = "UPDATE rol SET rol='$rol' WHERE id_rol='$id'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se actualizó el rol');window.location='../abc_roles.php';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='abc_roles.php'</script>";
    }mysqli_close($link);
?>
