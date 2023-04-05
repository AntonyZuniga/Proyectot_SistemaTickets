<?php
    // Include config file
    require_once "conexion.php";

    // Define variables and initialize with empty values
    $rol = "";
    $rol_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Validate rol
        if(empty(trim($_POST["rol"]))){
            $rol_err = "Por favor ingresa un rol.";     
        }else{
            $rol = trim($_POST["rol"]);
        }
    }

    $id = trim($_POST['id']);
    $usuario = trim($_POST['usuario']);
    $rol = trim($_POST['rol']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $actualizar = "UPDATE usuarios SET usuario='$usuario', password='$password', id_rol='$rol' WHERE id_usuario='$id'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>alert('Se actualizó la información');window.location='../abc_usuarios.php';</script>";
    } else {
        echo"<script>alert('El usuario ya existe');window.location='../abc_usuarios.php'</script>";
    }mysqli_close($link);
?>




