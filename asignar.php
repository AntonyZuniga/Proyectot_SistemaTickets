<?php require_once "controlador/conexion.php";

session_start();

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}

$dato1 = $_GET['id'];

    $r_rol=array();
    $sql = "SELECT * from usuarios where id_rol = 3";
    $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
                $r_rol[] = $row;
            }
        }

    
        $sql = "SELECT r.id_asignado_a, u.usuario
                from reportes r
                inner join usuarios u
                on u.id_usuario=r.id_asignado_a WHERE id_reporte = $dato1";

        $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
            while ($row = $result->fetch_assoc()){
            $dato2 = trim($row["id_asignado_a"]);
            $dato3 = trim($row["usuario"]);
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
        <title>Modificar Rol</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    </head>

    <script type="text/javascript">

            function confirmAsign(){
                var respuesta = confirm("Se asignará, ¿Estas seguro?");

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
                    <div class="wrapper"><br>
                        <h2>Asignar Soporte</h2>
                        
                        <form action="controlador/asignar.php" method="POST" >
                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?> ">
                            <input type="hidden" name="estatus" value=2>
                            <div class="form-group">
                                    <label>Soportes</label><br>
                                    <select class="con_estilos_recep" id="asignar" name="asignar">';
                                                            <option value="<?php echo $dato2?>">Esta asignado a <?php echo $dato3?></option>"";
                                                                <?php
                                                                foreach ($r_rol as $id => $rol)
                                                                {
                                                                    echo '<option value="'.$rol['id_usuario'].'">'.$rol['usuario'].'</option>';
                                                                }
                                                                ?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>    
                                <div id=btn_si>
                                    <input onclick= "return confirmAsign()" type="submit" class="btn btn-primary" value="Asignar">
                                </div>
                                <div id=btn_no>
                                    <input onclick="location.href='recepcion.php'" type="button" class="btn btn-danger" value="Volver">
                                </div>
                                <br>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
        <br>
    </body>
</html>