<?php require_once "controlador/conexion.php"; 

session_start();

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}

$r_rol=array();
    $sql = "SELECT * from usuarios where id_rol=3";
    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $r_rol[] = $row;
        }
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
                        <h2 style="text-align: center">Reportes Generales</h2>
                            <div id=btn_salir>
                                    <input onclick="location.href='admin.php'" type="button" class="btn btn-danger" value="Volver"><br>
                                    <?php
                                $sql = "SELECT u.usuario as Soporte, r.id_asignado_a as ID, count(id_estatus) as Total,
                                (SELECT COUNT(id_estatus) from reportes where id_estatus != 9 and id_asignado_a = ID) as Abiertos,
                                (select Count(id_estatus) from reportes where id_estatus = 9 and id_asignado_a = ID) as Cerrados
                                from reportes r 
                             INNER JOIN usuarios u
                        ON r.id_asignado_a = u.id_usuario group by id_asignado_a";

                                $fecha = date('d-m-Y');

                                $result = mysqli_query($link, $sql);
                            ?>
                            <form action="controlador/creartxt.php" method="post">
                                        <textarea style="visibility: hidden;" name="contenido">
                                        <?php while($row=mysqli_fetch_array($result)): ?> 
<?php echo $row["Soporte"] ?>, <?php echo $row["Abiertos"] ?>, <?php echo $row["Cerrados"] ?>, <?php echo $row["Total"] ?>
                                            
                                        <?php endwhile; ?>
                                        
                                        </textarea>
                                        <input type="hidden" value="<?php echo $fecha ?>" name="fecha">
                                        <input style="align-itmes: center;" class="btn btn-primary" type="submit" value="Reporte"> 
                                    </form>
                            </div>
                        </form>

                    </div>   
                </div>
            </div>
        </div>
<br><br><br>


        <section id="ausoporte2">
<h1 style="text-align: center;">Detalles Individuales de Soporte</h1>

<select onchange="filtro(this.value)" style="height: 42px; border-radius: 10px; font-size: 19px;" class="form-control" id="filtro" name="empre" required>
                                                        <option disabled selected value="">Elige una opción...</option>
                                                        <option value="todos">Todos los reportes</option>
                                                        <?php
                                                            foreach ($r_rol as $id => $rol)
                                                            echo '<option value="'.$rol["id_usuario"].'">'.$rol["usuario"].'</option>';
                                                        ?>
                                                    </select><br>
                    
<!-- mysqli_close($link); -->
</section>

<section id="ausoporte2">

<div >
<table style="margin-bottom: 10px;" class="table mt-3" id="mitabla" >
    <thead class="table-secondary " >
                                <tr>
                                    
                                    <th style="width: 10%;">Area</th>
                                    <th style="width: 20%;">Ticket/Reporte</th>
                                    <th style="width: 20%;">Observaciones</th>
                                    <th style="width: 20%;">Solucion</th>
                                    <th style="width: 20%;">Fecha/Hora</th>
                                    <th style="width: 10%;">Ver</th>
                                
                                </tr>
                                </thead>

                                <tbody id="ver">
</div>

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

        <script>
                                    function filtro(val) {
                                        let d = $('#filtro').val(); //id de ochange empresa
                                        $.ajax({
                                        type:'POST', 
                                        data: {variable: d},
                                        url: 'controlador/filtro.php',
                                        success:function (resx){
                                            $('#ver')
                                        .empty()
                                        .append(resx);
                                            //   alert(`Es ${val}`);
                                    },
                                    error:function (){

                                        alert("mal");
                                    }
                                    });
                                                
                                
                                }

        </script>   




                           
    </body>
</html>