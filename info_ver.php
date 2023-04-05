<?php require_once "controlador/conexion.php";
session_start(); 

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}


$repor = $_GET['id'];

$r_estatus=array();
$sql = "SELECT * from estatus where id_estatus > 3";
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
                   DATE_FORMAT(r.fecha_creacion, '%d-%m-%Y') as fechacrea,
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
            ON r.id_area = a.id_area WHERE id_reporte = $repor";

    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $usuario = trim($row["usuario_reporte"]);
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
    
?>



<!DOCTYPE html>
        <html>
            <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
                <link href="css/cargos.css" rel="stylesheet" type="text/css">
                <link href="css/reporte.css" rel="stylesheet" type="text/css">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
                <title>Detalles del Reporte</title>
                <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
                <!-- Tooltp -->
                
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            </head>

            <script type="text/javascript">

                    function confirmUpdate(){
                        var respuesta = confirm("Se actualizará el reporte, ¿Estas seguro?");

                        if(respuesta == true){
                            return true;
                        }else{
                            return false;
                        }
                    }

            </script>
            <br><br><br>
            <body>
                <div class="contain">
                    <div class="wrapper">
                        <div class="contacts">
                            <h3>Detalles de Reporte</h3>
                            <br>
                                <div class="full-width">
                                    <div>
                                        <p style="text-align: center;">EVIDENCIAS ADJUNTAS</p>
                                        <hr>
                                    </div>
                                    <div>
                                        <p>
                                        <?php //mostrar las imagenes de
                                        $ruta = "evidencias/".$repor;
                                            if(file_exists($ruta) || @mkdir($ruta)){
                                                $ruta = "evidencias/".$repor;// Indicar la ruta
                                            $filehandle = opendir($ruta); // Abrir archivos de la carpeta
                                            
                                            while ($file = readdir($filehandle)) {
                                                    if ($file != "." && $file != "..") {
                                                        $nx = date("Y-m-d H:i:s", filectime($ruta."/".$file));
                                                            echo "
                                                                        <p>
                                                                            <label><i class='bi bi-eye-fill'></i><a href='$ruta/$file'> $file</a> - $nx</label>
                                
                                                                        </p>
                                                                        
                                                            ";
                                                    } 
                                            } 
                                            closedir($filehandle);
                                        } // Fin lectura archivos
                                        ?>
                                        </p>
                                        <br><br>
                                    </div>
                                </div>
                            <table>
                            <p class="full-width">
                                <!-- <?php 
                                
                                    $sql = "SELECT * FROM cargos";

                                    echo '<table border="0" cellspacing="2" cellpadding="2">
                                                    <tr>
                                                
                                                        <td> <font face="Arial">Concepto</font> </td>
                                                        <td> <font face="Arial">Monto</font> </td>
                                                    
                                                    </tr>';

                                    $result = mysqli_query($link, $sql);
                                    $mh = 0;
                                    if($result->num_rows>0){
                                        
                                    while($fila=$result->fetch_assoc()){
                                            $dato1 = $fila["fecha"];
                                            $dato2 = $fila["concepto"];
                                            $monto = $fila["monto"];
                                            $formato = number_format($monto, 2, '.', ',');
                                            // setlocale(LC_MONETARY, 'en_US');
                                            // $monto = money_format('%(#10n', $monto);
                                            $mh += $monto;
                                            echo '<tr>
                                                                <td data-toggle="tooltip" data-placement="top" title='.$dato1.'>'.$dato2.'</td>
                                                                <td>$'.$formato.'</td>
                                                        </tr>';
                                    }
                                    
                                    }mysqli_close($link);
                                ?> -->

                                </p>
                            </table>
                            <br>


                            
                            
                           
                            <!-- <label>Cargos Totales: $<?php $format = number_format($mh, 2, '.', ','); echo $format ?></label> -->
                            

                            
                        </div>
                        <div class="form">
                            <form enctype="multipart/form-data" name="form" action="controlador/update_reporte.php" method="POST" >
                                <input type="hidden" name="id" value="<?php echo $repor;?> ">
                                    
                                    <p>
                                        <label>&Aacuterea: <?php echo $dato6?></label><br>
                                       
                                    </p>
                                    <p>
                                        <label>Usuario: <?php echo $usuario?></label><br>
                                        
                                    </p>
                                    <p>
                                        <label>Tel&eacutefono: <?php echo $dato3?></label><br>
                                        
                                    </p>
                                    <p>
                                        <label>Categor&iacutea: <?php echo $dato5?></label><br>
                                        
                                    </p>
                                    <p>
                                        <label>Fecha de Creaci&oacuten: <?php echo $dato9?></label><br>
                                        
                                    </p>
                                    <p >
                                        <label>Ticket/Reporte: <?php echo $dato7?></label><br>
                                        
                                    </p>
                                    <p>
                                    <label>Est&aacutetus</label><br>
                                            <select class="con_estilos_reporte" id="estatus" name="estatus">
                                                <option value="<?php echo $dato14 ?>">Actual - <?php echo $dato4 ?></option>
                                               
                                            </select>
                                    </p>
                                    <!-- <p>
                                        <label>Patrimonio</label><br>
                                        <input readonly type="text" id="patrimonio" name="patrimonio" value="<?php echo $dato10?>" required></input>
                                    </p> -->
                                    <p>
                                        <label>Tipo de Equipo</label><br>
                                        <input readonly type="text" id="equipo" name="equipo" value="<?php echo $dato11?>" required></input>
                                    </p>
                                    <!-- <p >
                                        <label>Serie</label><br>
                                        <input readonly type="text" id="serie" name="serie" value="<?php echo $dato12?>" required></input>
                                    </p> -->
                                    <p class="full-width">
                                        <label>Observaciones</label><br>
                                        <textarea style="height: 200px;" readonly type="text" id="observaciones" name="observaciones" required><?php echo $dato13?></textarea>
                                    </p>
                                    <p class="full-width">
                                        <label>Soluci&oacuten</label><br>
                                        <textarea style="height: 200px;" readonly type="text" id="solucion" name="solucion" required><?php echo $dato8?></textarea>
                                    </p><br>
                                    <p class="full-width">
                                        <input type="file" name="archivo[]" multiple>
                                    </p>
                                    
                                    <p class="full-width">
                                        
                                            <!-- <input onclick="location.href='abc_reportes.php'" type="button" class="btn btn-danger" value="Volver"> -->
                                        
                                    </p>
                            </form>

                            
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('[data-toggle="tooltip"]').tooltip({
                        });
                    });
                </script>
            </body>
        </html>