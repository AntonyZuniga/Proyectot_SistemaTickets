<?php 
    require_once "controlador/conexion.php"; 
    require_once "controlador/registrar_reporte_gensoporte.php";
    
    session_start(); 

    $auth = $_SESSION['loggedin'];

    if(!$auth){
        header('Location: index.php');
    }

    $a_areas = array();
    $sql = "SELECT * from areas order by area ASC";
    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $a_areas[] = $row;
        }
    }mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/tabla.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title>Generar Reporte</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
    </head>



    <body><br><br>
        <div id="centrar">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="wrapper">
                        <h2>Reporte Generado por Soporte</h2>
        
                            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
                            <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                                    <label>Usuario que reporta</label>
                                    <input readonly type="text" name="usuario" class="form-control" value="<?php echo  $_SESSION["usuario"]?>">
                                    <span class="help-block"><?php echo $usuario_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($telefono_err)) ? 'has-error' : ''; ?>">
                                    <label>Tel&eacutefono</label>
                                    <input type="text" maxlength="10" name="telefono" class="form-control" value="<?php echo $telefono; ?>">
                                    <span class="help-block"><?php echo $telefono_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($area_err)) ? 'has-error' : ''; ?>">
                                    <label>&Aacuterea</label><br>
                                    <select style="border-radius: 10px;" class="con_estilos_areas" id="area" name="area">
                                        <option value="">Seleccione</option>
                                        <?php
                                        foreach ($a_areas as $key => $area) {
                                            echo '<option value="'.$area['id_area'].'">'.$area['area'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="help-block"><?php echo $area_err; ?></span>
                                </div>
                                <div class="form-group <?php echo (!empty($problema_err)) ? 'has-error' : ''; ?>">
                                    <label>Descripci&oacuten del Ticket/Reporte</label>
                                    <textarea style="height: 200px; " type="text" name="problema" class="form-control" value="<?php echo $problema; ?>"></textarea>
                                    <span class="help-block"><?php echo $problema_err; ?></span>
                                </div>
                                <!-- <div class="form-group <?php echo (!empty($archivo_err)) ? 'has-error' : ''; ?>">
                                    <label>Archivos</label>
                                    <input type="file" name="archivo[]" multiple class="form-control" value="<?php echo $archivo; ?>"></input>
                                    <span class="help-block"><?php echo $archivo_err; ?></span>
                                </div> -->
        
                                <div id=btn_si>
                                    <input type="submit" class="btn btn-primary" value="Registrar" onclick="return  confirmRegistrar()">
                                </div>
                                <div id=btn_no>
                                    <input onclick="location.href='soporte.php'" type="button" class="btn btn-danger" value="Volver">
                                </div>
                            </form>
                    </div>   
                </div>
            </div>
        </div>
        <br>
        
        <script type="text/javascript">

            function confirmRegistrar(){
                var respuesta = confirm("¿Estás seguro de registrar el reporte?");

                if(respuesta == true){
                    return true;
                }else{
                    return false;
                }
            }
        </script>
    </body>
</html>