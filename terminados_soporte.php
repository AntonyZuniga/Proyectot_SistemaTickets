<?php require_once "controlador/conexion.php";
session_start(); 

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}

$dato8 = $_SESSION["id"];
/*llamar variables <h1><?php echo  $_SESSION["id_usuario"]?></h1>
hacer diferencia de fechas (TIMESTAMPDIFF(DAY, DATE_FORMAT(r.fecha_creacion, '%Y-%M-%d'), '2022-12-16')) as dias*/
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <link href="css/tabla.css" rel="stylesheet" type="text/css">
            <meta charset="UTF-8">
            <title>Soporte</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
            <!-- Data table -->
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
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
                            <h2>Reportes Asignados a <?php echo $_SESSION["usuario"]?></h2>
                        
                            
                                
                                <div id=btn_salir>
                                    <input style=" vertical-align: bottom;" onclick="location.href='controlador/logout.php'" type="button" class="btn btn-danger" value="Cerrar Sesión">
                                </div>
                        </div>   
                    </div>
                </div>
            </div>
            <br><br>

            <?php 
                    $sql = "SELECT id_estatus FROM estatus WHERE estatus = 'Cerrado'";

                    $result = mysqli_query($link, $sql);
                    if($result->num_rows>0){
                        while ($row = $result->fetch_assoc()){
                           $dato9 = $row["id_estatus"];
                        }
                        
                    }
            ?>

             <?php 

                    $sql = "SELECT id_estatus FROM estatus WHERE estatus = 'Asignado'";

                    $result = mysqli_query($link, $sql);
                    if($result->num_rows>0){
                        while ($row = $result->fetch_assoc()){
                        $estatus = $row["id_estatus"];
                        }
                    }
                    
            ?>


            <div class="container">
            
            <ul class="nav nav-tabs">
                <li><a href="soporte.php">Asignados</a></li>
                <li class="active"><a href="#">Terminados</a></li>
                <li><a href="reportes_generales.php">Reportes Generales</a></li>
                <li><a href="reporte_gensoporte.php">Generar Reporte</a></li>
            </ul><br><br>
            <div class="conttabla">



            <?php
                $usuario = $_SESSION["usuario"];

                $sql = "SELECT r.id_reporte, 
                        r.usuario_reporte,
                        a.area,
                        r.problema,
                        r.auxiliar,
                        r.fecha_creacion, 
                        e.estatus,
                        r.id_estatus,
                        DATE_FORMAT(r.fecha_creacion, '%d-%m-%Y') as fechacrea
                                    FROM reportes r
                                    INNER JOIN areas a
                                    ON r.id_area = a.id_area
                                    INNER JOIN estatus e
                                    ON r.id_estatus = e.id_estatus
                        WHERE id_asignado_a = $dato8";

                $result = mysqli_query($link, $sql);
            ?>
            <table class="table mt-3" id="mitabla">
                <thead class="thead-green" >
                <tr>
                    <th style="width: 40px;">Id</th>
                    <th style="width: 40px;">Usuario</th>
                    <th style="width: 40px;">Auxiliar</th>
                    <th>Area</th>
                    <th style="width: 200px;">Estatus</th>
                    <th >Problema</th>
                    <th style="visibility: hidden; display: none;">id_estatus</th>
                    

                </tr>
                </thead>

                <tbody>
                        <?php
                        
                            while($row=mysqli_fetch_array($result)){
                                if($row["id_estatus"] == $dato9){
                        ?>
                            <tr>
                                <th style="font-weight: normal;"><?php  echo $row["id_reporte"]?></th>
                                <th style=" font-weight: normal;"><?php  echo $row["usuario_reporte"]?></th>  
                                <th style="font-weight: normal;"><?php  echo $row["auxiliar"]?></th> 
                                <th style="font-weight: normal;"><?php  echo $row["area"]?></th>
                                <th style="width: 100px; font-weight: normal;"> <?php echo $row["estatus"]?><a href="info_soporte.php?id=<?php  echo $row["id_reporte"]?>"><i style="place-items: right; justify-content: right; padding-left: 10px;" class="bi bi-eye-fill"></i></a></th>
                                <th style=" font-weight: normal;"> <?php echo $row["problema"]?></th>  
                                <th style=" font-weight: normal; visibility: hidden; display: none;"> <?php echo $row["id_estatus"]?></th>
                                
                                            
                            </tr>
                        <?php 
                            }}mysqli_close($link);
                        ?>
                </tbody>
            </table>
            <br><br>

            <!-- mysqli_close($link); -->
           
                <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

                <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#mitabla').DataTable( {
                            language: {
                                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
                            }
                        } );
                    } );
            </script>
</body>
</html>


