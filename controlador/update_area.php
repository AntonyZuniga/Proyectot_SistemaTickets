<?php
    // Include config file
    require_once "conexion.php";

    $id = $_POST['id'];
    $area = $_POST['area'];


    $actualizar = "UPDATE areas SET area='$area' WHERE id_area='$id'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se actualizo el area');window.location='../abc_areas.php';</script>";
    } else {
        echo"<script>alert('algo salio mal');window.location='../abc_areas.php'</script>";
    }mysqli_close($link);
?>
