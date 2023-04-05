<?php
    // Include config file
    require_once "conexion.php";

    $id = $_POST['id'];
    $categoria = $_POST['categoria'];


    $actualizar = "UPDATE categorias SET categoria='$categoria' WHERE id_categoria='$id'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se actualizo la categoría');window.location='../abc_categoria.php';</script>";
    } else {
        echo"<script>alert('El usuario ya existe');window.location='../abc_categoria.php'</script>";
    }mysqli_close($link);
?>
