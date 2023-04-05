
<?php 
    $sql = "SELECT id_estatus FROM estatus WHERE estatus = 'Reportado'";
     $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
         $dato1 = $row["id_estatus"];            
         }
                        
    }
?>

<?php 
    $sql = "SELECT id_categoria FROM categorias WHERE categoria = 'Soporte web'";
     $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
         $dato2 = $row["id_categoria"];            
         }
                        
    }
?>

<?php 
    $sql = "SELECT id_usuario FROM usuarios WHERE id_rol = 4";
     $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
         $dato3 = $row["id_usuario"];            
         }
                        
    }
?>

<?php

    // Include config file
    require_once "conexion.php";

    // Define variables and initialize with empty values

    $archivo = $usuario = $telefono = $area = $problema = "";
    $archivo_err = $usuario_err = $telefono_err = $area_err = $problema_err = "";
    
    // Processing form data when form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate usuario
    if(empty(trim($_POST["usuario"]))){
        $usuario_err = "Por favor ingresa un usuario.";     
    }else{
        $usuario = trim($_POST["usuario"]);
    }

        // Validate rol
        if(empty(trim($_POST["telefono"]))){
            $telefono_err = "Por favor ingresa un telefono.";     
        }else{
            $telefono = trim($_POST["telefono"]);
        }

        // Validate area
        if(empty(trim($_POST["area"]))){
            $area_err = "Por favor ingresa una area.";     
        }else{
            $area = trim($_POST["area"]);
        }

        if(empty(trim($_POST["problema"]))){
            $problema_err = "Por favor ingresa el problema.";     
        }else{
            $problema = trim($_POST["problema"]);
        }


        // Check input errors before inserting in database
        if(empty($usuario_err)  && empty($telefono_err)  && empty($area_err) && empty($problema_err)){
            
            // Prepare an insert statement
            $sql = "INSERT INTO reportes ( usuario_reporte,
                                            id_estatus, 
                                            tel_extension, 
                                                id_area, 
                                            problema,
                                                id_categoria,
                                                id_asignado_a, 
                                                fecha_creacion
                                            ) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, now())";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "siiisii",
                                            $param_usuario, 
                                            $param_estatus,
                                            $param_telefono,
                                            $param_area,
                                            $param_problema,
                                            $param_categoria,
                                            $param_asignado
                                            );
                
                // Set parameters
                $param_usuario = $usuario;
                $param_estatus = $dato1;
                $param_telefono = $telefono;
                $param_area = $area;
                $param_problema = $problema;
                $param_categoria = $dato2; //aqui tenia 30 que es la categoria de Soporte Web en las practicas y en micompu es 7
                $param_asignado = $dato3; //checar lque los numeros coincidan con Recepcion en usuarios practicas 26, mi compu 13
                //$param_creacion = $fecha; // 
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                    header("location: usuario.php");
                } else{
                    echo "Algo salio mal";
                }
            }

            
            
            // Close statement
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        
    
    }

   
?>

