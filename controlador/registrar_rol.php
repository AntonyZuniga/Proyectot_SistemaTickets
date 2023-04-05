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


        // Check input errors before inserting in database
        if(empty($rol_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO rol (rol) VALUES (?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_rol);
                
                // Set parameters
                $param_rol = $rol;
                // Creates a password hash
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: abc_roles.php");
                } else{
                    echo "Algo sali&oacute mal, por favor int&eacutentalo de nuevo.";
                }
            }

            
            
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        
        // Close connection
        
    }
?>
