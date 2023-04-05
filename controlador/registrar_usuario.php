<?php

    // Include config file
    require_once "conexion.php";

    // Define variables and initialize with empty values
    $usuario = $rol = $password = "";
    $usuario_err = $rol_err = $password_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate usuario
    if(empty(trim($_POST["usuario"]))){
        $usuario_err = "Por favor ingresa un usuario.";     
    }else{
        $usuario = trim($_POST["usuario"]);
    }

        // Validate rol
        if(empty(trim($_POST["rol"]))){
            $rol_err = "Por favor ingresa un rol.";     
        }else{
            $rol = trim($_POST["rol"]);
        }

        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor ingresa una contraseña.";     
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "La contraseña al menos debe tener 6 caracteres.";
        } else{
            $password = trim($_POST["password"]);
        }


        // Check input errors before inserting in database
        if(empty($usuario_err)  && empty($rol_err)  && empty($password_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO usuarios ( usuario, password, id_rol) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "sss", $param_usuario, $param_password, $param_rol);
                
                // Set parameters
                $param_usuario = $usuario;
                $param_rol = $rol;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: abc_usuarios.php");
                } else{
                    echo "El usuario ya existe.";
                }
            }

            
            
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        
        // Close connection
        
    }
?>

