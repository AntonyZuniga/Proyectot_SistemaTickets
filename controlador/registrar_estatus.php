<?php
    // Include config file
    require_once "conexion.php";
    
    // Define variables and initialize with empty values
    $estatus = "";
    $estatus_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Validate username
        if(empty(trim($_POST["estatus"]))){
            $estatus_err = "Por favor ingrese un estatus.";
        } else{
            
        }

        
        // Check input errors before inserting in database
        if(empty($estatus_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO estatus (estatus) VALUES (?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_estatus);
                
                // Set parameters
                $param_estatus = $_POST["estatus"];
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: abc_estatus.php");
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