<?php require_once "conexion.php"; ?>

<!-- imagenes -->
<?php
    // Include config file

      




    //solucion
    //patrimonio
    //equipo
    //serie
    //observaciones

    $repor = trim($_POST['id']);
    $estatus = trim($_POST['estatus']);
    $solucion = trim($_POST['solucion']);
    $auxiliar = trim($_POST['auxiliar']);
    $equipo = trim($_POST['equipo']);
    $serie = trim($_POST['serie']);
    $observaciones = trim($_POST['observaciones']);

    $actualizar = "UPDATE reportes 
                   SET id_estatus='$estatus',
                       solucion='$solucion', 
                       auxiliar='$auxiliar', 
                       tipo_equipo='$equipo',
                       serie='$serie',
                       observaciones_del_equipo='$observaciones' WHERE id_reporte='$repor'";

    $resultado=mysqli_query($link, $actualizar);

    if ($resultado) {
        echo "<script>window.location='../soporte.php';</script>";
    } else {
        echo"<script>alert('Hubo un error');window.location='../info_reporte.php?id=$repor'</script>";
    }mysqli_close($link);

    
    $ruta = "../evidencias/$repor/";
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0]) {
        for($i=0; $i < count($_FILES["archivo"]["name"]); $i++) {
            
                
                if(file_exists($ruta) || @mkdir($ruta)){
                    $origen_archivo = $_FILES["archivo"]["tmp_name"][$i];
                    $destino_archivo = $ruta.$_FILES["archivo"]["name"][$i];

                    if(@move_uploaded_file($origen_archivo, $destino_archivo)){
                        //mensaje de exito de la carpeta
                    }else{
                        //mensaje de error de mover archivo
                    }
                }else{
                    //echo para nose creo la carpeta
                }
            
        }
    }else{
        //para decir si no se a cargado ninguna imagen
    }
?>





