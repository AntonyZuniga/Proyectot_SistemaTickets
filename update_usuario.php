<?php require_once "controlador/conexion.php";
session_start();
$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}

    $dato1 = $_GET['id'];


    $r_rol=array();
    $sql = "SELECT * from rol";
    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $r_rol[] = $row;
        }
    }

    $sql = "SELECT u.id_rol,
                u.id_usuario,
                u.usuario,
                u.password,
                r.rol
            from usuarios u
            inner join rol r
            on u.id_rol=r.id_rol where id_usuario=$dato1";

    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $dato2 = trim($row["usuario"]);
            $dato3 = trim($row["rol"]);
            //$dato4 = trim($row["password"]);
            $dato5 = trim($row["id_rol"]);
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

                    function confirmUpdate(){
                        var respuesta = confirm("Se actualizaran los datos, ¿Estas seguro?");

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
                                <h2>Modificar Usuario</h2>
                                    <form action="controlador/update_usuario.php" method="POST" >
                                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?> ">
                                                <div class="form-group">
                                                    <label>Usuario</label><br>
                                                    <input type="text" id="usuario" name="usuario" value="<?php echo $dato2?>" required><br>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Contrase&ntildea Nueva</label><br>
                                                    <input type="text" id="password" name="password" value="" required>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rol</label><br>
                                                    <select class="con_estilos" id="rol" name="rol">
                                                        <option value="<?php echo $dato5?>">Eres <?php echo $dato3?></option>
                                                        <?php
                                                        foreach ($r_rol as $key => $rol) {
                                                            echo '<option value="'.$rol['id_rol'].'">'.$rol['rol'].'</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="help-block"></span>
                                                </div>    
                                                <div id=btn_si>
                                                    <input onclick= "return confirmUpdate()" type="submit" class="btn btn-primary" value="Actualizar">
                                                </div>
                                                <div id=btn_no>
                                                    <input onclick="location.href='abc_usuarios.php'" type="button" class="btn btn-danger" value="Volver">
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