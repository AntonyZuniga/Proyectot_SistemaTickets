<?php
    session_start();
  
    // Check if the user is already logged in, if yes then redirect him to welcome page
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        if($_SESSION["rol"] == 1){
            header("location: admin.php");
        }elseif($_SESSION["rol"] == 2){
            header("location: usuario.php");
        }elseif($_SESSION["rol"] == 3){
            header("location: soporte.php");
        }elseif($_SESSION["rol"] == 4){
            header("location: recepcion.php");
        }
    exit;
    }


    require_once "conexion.php";
    
    $username = $password = "";
    $username_err = $password_err = "";

    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
        // Check if username is empty
        if(empty(trim($_POST["username"]))){
            $username_err = "Por favor ingrese su usuario.";
        } else{
            $username = trim($_POST["username"]);
        }
        
        // Check if password is empty
        if(empty(trim($_POST["password"]))){
            $password_err = "Por favor ingrese su contraseña.";
        } else{
            $password = trim($_POST["password"]);
        }
        
        // Validate credentials
        if(empty($username_err) && empty($password_err)){
            // Prepare a select statement
            $sql = "SELECT id_usuario, id_rol, usuario, password FROM usuarios WHERE usuario = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameter
                $param_username = $username;
            
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Store result
                    mysqli_stmt_store_result($stmt);
                    
                    // Check if username exists, if yes then verify password $hashed_password
                    if(mysqli_stmt_num_rows($stmt) == 1){                    
                        // Bind result variables
                        mysqli_stmt_bind_result($stmt, $id, $id_rol, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
                            if(password_verify($password, $hashed_password)){ 

                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["rol"] = $id_rol;
                                $_SESSION["id"] = $id;
                                $_SESSION["usuario"] = $username;                            
                                
                                $rol = $_SESSION["rol"];
                            

                                if($rol == 1){
                                    header("location: admin.php");
                                }elseif($rol == 2){
                                    header("location: usuario.php");
                                }elseif($rol == 3){
                                    header("location: soporte.php");
                                }elseif($rol == 4){
                                    header("location: recepcion.php");
                                }
                                
                                
                            }else{
                                // Display an error message if password is not valid
                                $password_err = "La contraseña que has ingresado no es válida.";
                            }
                        }
                    } else{
                        // Display an error message if username doesn't exist
                        $username_err = "No existe usuario registrado con ese nombre.";
                    }
                } else{
                    echo "Algo salió mal, por favor vuelve a intentarlo.";
                }
                
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }

        
    }
?>