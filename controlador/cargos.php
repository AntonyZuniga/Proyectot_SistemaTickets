<?php
    require_once "conexion.php";


    $fecha = $monto = $concepto = $soporte = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $repor = trim($_POST['id']);

        $fecha = trim($_POST["fecha"]);
       
            $monto = trim($_POST["monto"]);
       
            $concepto = trim($_POST["concepto"]);

            $soporte = trim($_POST["soporte"]);
    
            $sql = "INSERT INTO cargos ( fecha, concepto, monto, id_soporte, id_reporte) VALUES (now(), ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($link, $sql)){
                
                mysqli_stmt_bind_param($stmt, "sdii", $param_concepto, $param_monto, $param_soporte, $param_reporte);
                
                $param_concepto = $concepto;
                $param_monto = $monto; 
                $param_soporte = $soporte;
                $param_reporte = $repor;
                
                if(mysqli_stmt_execute($stmt)){
                    
                    header("location: ../info_reporte.php?id=$repor");
                } else{
                    echo "";
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($link);
    }
?>

