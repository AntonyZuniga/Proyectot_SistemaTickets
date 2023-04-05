<?php require_once "controlador/conexion.php"; 
require_once "controlador/validar_login.php";
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/tabla.css" rel="stylesheet" type="text/css">
            <meta charset="UTF-8">
            <title>Bienvenido</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <style type="text/css">
                body{ font: 14px sans-serif; }
                .wrapper{ width: 350px; padding: 20px; }
            </style>
    </head>
    <body>
        <br><br><br><br>
        <div id="centrar">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <div class="wrapper">
                        <h2>Inicio de Sesi&oacuten</h2>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <label>Usuario</label>
                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                                    <span class="help-block"><?php echo $username_err; ?></span>
                                </div>    
                                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>Contrase&ntildea</label>
                                    <input type="password" name="password" class="form-control">
                                    <span class="help-block"><?php echo $password_err; ?></span>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Ingresar">
                                </div>
                                <p><a href="">Olvid&eacute mi contrase&ntildea</a>.</p>
                            </form>
                    </div>  
                </div>  
            </div>  
        </div>  
    </body>
</html>