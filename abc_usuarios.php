<?php require_once "controlador/conexion.php"; 
require_once "controlador/registrar_usuario.php";
session_start();

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}
?>



<?php
    $r_rol=array();
    $sql = "SELECT * from rol";
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
        <title>ABC Usuarios</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
         <!-- Iconos -->
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <style type="text/css">
            body{ font: 14px sans-serif; }
            .wrapper{ width: 350px; padding: 20px; }
        </style>
    </head>

    <script type="text/javascript">
        function confirmDelete(){
            var respuesta=confirm("Se eliminará la información, ¿Estás seguro?");
        
            if(respuesta == true){
                return true;
            }else{
                return false;
            }
        }

        function confirmRegistrar(){
            var respuesta = confirm("¿Estás seguro de registrar el usuario?");

            if(respuesta == true){
                return true;
            }else{
                return false;
            }
        }
    </script>

    <body><br><br><br><br>

        <div id="centrar">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="wrapper">
                        <h2>ABC Usuarios</h2>
                    
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?php echo (!empty($usuario_err)) ? 'has-error' : ''; ?>">
                                    <label>Usuario</label>
                                    <input type="text" name="usuario" class="form-control" value="<?php echo $usuario; ?>">
                                    <span class="help-block"><?php echo $usuario_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>Contrase&ntildea</label>
                                    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                            </div>
                            <div class="form-group <?php echo (!empty($rol_err)) ? 'has-error' : ''; ?>">
                                    <label>Rol</label><br>
                                    <select class="con_estilos" id="rol" name="rol">
                                        <option value="">Seleccione</option>
                                        <?php
                                        foreach ($r_rol as $id => $rol)
                                        echo '<option value="'.$rol["id_rol"].'">'.$rol["rol"].'</option>';
                                        ?>
                                    </select>
                                    <span class="help-block"><?php echo $rol_err; ?></span>
                            </div>    
                            <div id=btn_si>
                                    <input onclick="return  confirmRegistrar()" type="submit" class="btn btn-primary" value="Registrar">
                            </div>
                            <div id=btn_no>
                                    <input onclick="location.href='admin.php'" type="button" class="btn btn-danger" value="Volver">
                            </div>
                        </form>
                    </div>   
                </div>
            </div>
        </div>
        <br><br>
        
        <!-- <div class="card"> -->
        <section id="ausoporte2">

                            <?php
                                $sql = "SELECT u.id_usuario,u.usuario,r.rol
                                from usuarios u
                                inner join rol r
                                on u.id_rol=r.id_rol";
                                $result = mysqli_query($link, $sql);
                            ?>
                            <table class="table mt-3" id="mitabla">
                                <thead class="table-secondary" >
                                <tr>
                                
                                    <th>id_usuario</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Actualizar</th>
                                    <th>Eliminar</th>
                        
                                </tr>
                                </thead>

                                <tbody>
                                        <?php
                                            while($row=mysqli_fetch_array($result)){
                                        ?>
                                            <tr>
                                                <th style="font-weight: normal;"><?php  echo $row["id_usuario"]?></th>
                                                <th style="font-weight: normal;"><?php  echo $row["usuario"]?></th>
                                                <th style="font-weight: normal;"><?php  echo $row["rol"]?></th>   
                                                <th><a href="update_usuario.php?id=<?php echo $row['id_usuario'] ?>"><i style="place-items: center; justify-content: center; display:grid;" class="bi bi-pencil-fill"></i></a></th>
                                                <th><a onclick="return confirmDelete()" href="controlador/eliminar_usuario.php?id=<?php echo $row['id_usuario'] ?>"><i style="place-items: center; justify-content: center; display:grid;" class="bi bi-trash3-fill"></i></a></th>                                        
                                            </tr>
                                        <?php 
                                            }mysqli_close($link);
                                        ?>
                                </tbody>
                            </table>
                            <br><br>
<!-- mysqli_close($link); -->
        </section>
        <!-- </div> -->
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