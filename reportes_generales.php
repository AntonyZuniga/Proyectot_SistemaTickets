<?php require_once "controlador/conexion.php"; 
session_start();

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/tabla.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <title>Reportes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
    </head>


    <body><br><br><br><br>

        <div id="centrar">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="wrapper">
                        <h2 style="text-align: center">Reportes</h2>
                            <div id=btn_salir>
                                    <input onclick="location.href='soporte.php'" type="button" class="btn btn-danger" value="Volver">
                            </div>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
        

        <section id="ausoporte2">

        <?php
                                $sql = "SELECT  r.id_reporte,
                                r.usuario_reporte,
                                r.tel_extension,
                                e.estatus,
                                a.area,
                                u.usuario,
                                r.problema,
                                r.solucion,
                                DATE_FORMAT(r.fecha_creacion, '%d-%m-%Y') as fechacrea,
                                r.patrimonio,
                                r.tipo_equipo,
                                r.serie,
                                r.observaciones_del_equipo
                        FROM reportes r
                        INNER JOIN usuarios u
                        ON r.id_asignado_a = u.id_usuario
                        INNER JOIN estatus e
                        ON r.id_estatus = e.id_estatus
                        INNER JOIN categorias c
                        ON r.id_categoria = c.id_categoria
                        INNER JOIN areas a
                        ON r.id_area = a.id_area order by fechacrea desc";
                                $result = mysqli_query($link, $sql);
                            ?>
                            <table style="margin: 10px;" class="table mt-3" id="mitabla">
                                <thead class="table-secondary " >
                                <tr>
                                
                                    <th style="width: 40px;">Id</th>
                                    <th style="width: 50px;">Usuario</th>
                                    <th>Tel</th>
                                    <th>Estatus</th>
                                    <th>Area</th>
                                    <th>Asignado</th>
                                    
                                    <th style="width: 150px;">Fecha</th>
                                    <th>Ver</th>
                                   
                        
                                </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($result)){
                                        ?>
                                            <tr>
                                                <th style="width: 40px; font-weight: normal;"><?php echo $row["id_reporte"]?></th>
                                                <th style="width: 100px; font-weight: normal;"><?php echo $row["usuario_reporte"]?></th>   
                                                <th style="font-weight: normal;"><?php echo $row["tel_extension"]?></th>
                                                <th style="font-weight: normal;"><?php echo $row["estatus"]?></th>
                                                <th style="font-weight: normal;"><?php echo $row["area"]?></th>  
                                                <th style="font-weight: normal;"><?php echo $row["usuario"]?></th>
                                               
                                                <th style="width: 100px; font-weight: normal; -webkit-line-clamp: 4;"><?php echo $row["fechacrea"]?></th>
                                                <th style="font-weight: normal;"><a href="info_ver_generales.php?id=<?php echo $row['id_reporte'] ?>"><i style="place-items: center; justify-content: center; display:grid;" class="bi bi-eye-fill"></i></a></th>
                                               
                                                
                                            </tr>
                                        <?php 
                                            }mysqli_close($link);
                                        ?>
                                </tbody>
                            </table>
                            <br><br>
<!-- mysqli_close($link); -->
</section>


<!-- mysqli_close($link); -->
</section>
        <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
 
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#mitabla').DataTable( {
                    "aaSorting": [],
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
                    }
                } );
            } );
        </script>
    </body>
</html>