


<!-- <?php require_once "controlador/conexion.php";
session_start(); 

$dato1 = $_GET['id'];

$r_estatus=array();
$sql = "SELECT * from estatus";
$result = mysqli_query($link, $sql);
if($result->num_rows>0){
    while ($row = $result->fetch_assoc()){
        $r_estatus[] = $row;
    }
}



    $sql = "SELECT r.usuario_reporte,
                   r.tel_extension,
                   e.estatus,
                   c.categoria,
                   a.area,
                   r.problema,
                   r.solucion,
                   DATE_FORMAT(r.fecha_creacion, '%d-%M-%Y') as fechacrea,
                   r.patrimonio,
                   r.tipo_equipo,
                   r.serie,
                   r.observaciones_del_equipo,
                   e.id_estatus
            FROM reportes r
            INNER JOIN estatus e
            ON r.id_estatus = e.id_estatus
            INNER JOIN categorias c
            ON r.id_categoria = c.id_categoria
            INNER JOIN areas a
            ON r.id_area = a.id_area WHERE id_reporte = $dato1";

    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $dato2 = trim($row["usuario_reporte"]);
            $dato3 = trim($row["tel_extension"]);
            $dato4 = trim($row["estatus"]); 
            $dato5 = trim($row["categoria"]); 
            $dato6 = trim($row["area"]); 
            $dato7 = trim($row["problema"]); 
            $dato8 = trim($row["solucion"]);
            $dato9 = trim($row["fechacrea"]);
            $dato10 = trim($row["patrimonio"]);
            $dato11 = trim($row["tipo_equipo"]);
            $dato12 = trim($row["serie"]);
            $dato13 = trim($row["observaciones_del_equipo"]);
            $dato14 = trim($row["id_estatus"]);
        }
    }
    mysqli_close($link);
?>



<!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
                <link href="css/tabla.css" rel="stylesheet" type="text/css">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Detalles del Reporte</title>
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
            </head>

            <script type="text/javascript">

                    function confirmUpdate(){
                        var respuesta = confirm("Se actualizaran el reporte, ¿Estas seguro?");

                        if(respuesta == true){
                            return true;
                        }else{
                            return false;
                        }
                    }

            </script>

            <body>
                <br><br><br>
                
                <div id="centrar">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <div class="wrapper">
                                <h2>Detalles del Reporte</h2>
                                    <form action="controlador/update_reporte.php" method="POST" >
                                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?> ">
                                            <div id="inputsrep" class="form-group">
                                                    <label>Estatus</label><br>
                                                    <select class="con_estilos" id="estatus" name="estatus">
                                                        <option value="<?php echo $dato14 ?>">Actual - <?php echo $dato4 ?></option>
                                                        <?php
                                                        foreach ($r_estatus as $key => $estatus) {
                                                            echo '<option value="'.$estatus['id_estatus'].'">'.$estatus['estatus'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>    
                                                <div id="inputsrep" class="form-group">
                                                    <label>Usuario</label><br>
                                                    <input readonly type="text" id="usuario" name="usuario" value="<?php echo $dato2?>"><br>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Tel&eacutefono</label><br>
                                                    <input readonly type="text" id="telefono" name="telefono" value="<?php echo $dato3?>">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Categoria</label><br>
                                                    <input readonly type="text" id="categoria" name="categoria" value="<?php echo $dato5?>">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Area</label><br>
                                                    <input readonly type="text" id="area" name="area" value="<?php echo $dato6?>">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Problema</label><br>
                                                    <textarea readonly type="text" name="problema" ><?php echo $dato7?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Solucion</label><br>
                                                    <textarea  type="text" id="solucion" name="solucion" value="" required><?php echo $dato8?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Fecha de Creacion</label><br>
                                                    <input readonly type="text" id="fechacrea" name="fechacrea" value="<?php echo $dato9?>">
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Patrimonio</label><br>
                                                    <textarea type="text" id="patrimonio" name="patrimonio" value="" required><?php echo $dato10?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Tipo de Equipo</label><br>
                                                    <textarea type="text" id="equipo" name="equipo" value="" required><?php echo $dato11?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Serie</label><br>
                                                    <textarea  type="text" id="serie" name="serie" value="" required><?php echo $dato12?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div id="inputsrep" class="form-group">
                                                    <label>Observaciones del Equipo</label><br>
                                                    <textarea  type="text" id="observaciones" name="observaciones" value="" required><?php echo $dato13?></textarea>
                                                    <span class="help-block"></span>
                                                </div>
                                                    
                                                <div id=btn_si>
                                                    <input onclick= "return confirmUpdate()" type="submit" class="btn btn-primary" value="Actualizar">
                                                </div>
                                                <div id=btn_no>
                                                    <input onclick="location.href='soporte.php'" type="button" class="btn btn-danger" value="Volver">
                                                </div>
                                            <br>
                                    </form>
                            </div>   
                        </div>
                    </div>
                
                <br>


                <div class="contain">

  <div class="wrapper">
   

    <div class="form">
      <h3>Send us a message</h3>
      <form action="">
        <p>
        <label>Usuario</label><br>
            <input readonly type="text" id="usuario" name="usuario" value="<?php echo $dato2?>"><br>
            <span class="help-block"></span>
        </p>
        <p>
        <label>Tel&eacutefono</label><br>
                                                    <input readonly type="text" id="telefono" name="telefono" value="<?php echo $dato3?>">
                                                    <span class="help-block"></span>
        </p>
        <p>
        <label>Categoria</label><br>
                                                    <input readonly type="text" id="categoria" name="categoria" value="<?php echo $dato5?>">
                                                    <span class="help-block"></span>
        </p>
        <p>
        <label>Area</label><br>
                                                    <input readonly type="text" id="area" name="area" value="<?php echo $dato6?>">
                                                    <span class="help-block"></span>
        </p>
        <p class="full-width">
        <label>Problema</label><br>
                                                    <textarea readonly type="text" name="problema" ><?php echo $dato7?></textarea>
                                                    <span class="help-block"></span>
        </p>
        <p class="full-width">
          <button>Send</button>
        </p>
      </form>
    </div>
  </div>
</div>
            </body>
        </html>

        https://webdesign.tutsplus.com/es/tutorials/how-to-build-web-form-layouts-with-css-grid--cms-28776


        <script>
            /* label de option de estatus para info_reporte
             <p>
                                        <label>Estatus *</label><br>
                                            <select class="con_estilos_reporte" id="estatus" name="estatus">
                                                <option value="<?php echo $dato14 ?>">Actual - <?php echo $dato4 ?></option>
                                                <?php
                                                        foreach ($r_estatus as $key => $estatus) {
                                                        echo '<option value="'.$estatus['id_estatus'].'">'.$estatus['estatus'].'</option>';
                                                        }
                                                    ?>
                                            </select>
                                    </p>
            */


            linkdelmoney https://www.php.net/manual/es/function.money-format.php
        </script> -->

