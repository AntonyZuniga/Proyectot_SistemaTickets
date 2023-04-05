<?php session_start(); 

$auth = $_SESSION['loggedin'];

if(!$auth) {
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
        <link href="css/tabla.css" rel="stylesheet" type="text/css">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
    </head>
    <body>
    <br><br><br><br>
        <div id="">
            <div class="wrapper fadeInDown">
                <div id="formContentAdmin">
                    <div class="ausoporte2">
                        <section><br><br>
                            <h1>Bienvenido <?php echo $_SESSION["usuario"] ?></h1><br>

                                <input  onclick="location.href='abc_usuarios.php'" type="button" class="btn btn-primary" value="Usuarios">
                                <input  onclick="location.href='abc_categoria.php'" type="button" class="btn btn-primary" value="Categorías">
                                <input  onclick="location.href='abc_roles.php'" type="button" class="btn btn-primary" value="Roles">
                                <input  onclick="location.href='abc_estatus.php'" type="button" class="btn btn-primary" value="Estatus">
                                <input  onclick="location.href='abc_areas.php'" type="button" class="btn btn-primary" value="Areas">
                                <input  onclick="location.href='abc_reportes.php'" type="button" class="btn btn-primary" value="Reportes"><br>

                            <br>
                            <div id=btn_salir>
                                <input  onclick="location.href='controlador/logout.php'" type="button" class="btn btn-danger" value="Cerrar Sesión">
                            </div>
                        </section><br><br>
                    </div>
                </div>
            </div>
        </div>
                    
    </body>
</html>