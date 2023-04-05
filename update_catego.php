<?php require_once "controlador/conexion.php";

session_start();

$auth = $_SESSION['loggedin'];

if(!$auth){
    header('Location: index.php');
}


    $dato1 = $_GET['id'];

    $sql = "SELECT * FROM categorias where id_categoria=$dato1";

    $result = mysqli_query($link, $sql);
    if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
            $dato2 = $row["categoria"];
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
            <br><br><br>
            <title>Modificar Categor&iacutea</title>
            <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        </head>

        <script type="text/javascript">
            function confirmUpdate(){
                var respuesta = confirm("Se actualizará la información, ¿Estás seguro?");

                if(respuesta == true){
                    return true;
                }else{
                    return false;
                }
            }
        </script>

        <body>
            <div id="centrar">
                <div class="wrapper fadeInDown">
                    <div id="formContent">
                        <div class="wrapper"><br>
                            <h2>Modificar Categor&iacutea</h2>
                        
                            <form action="controlador/update_catego.php" method="POST" >
                            <input type="hidden" name="id" value="<?php echo $_GET['id'];?> ">
                            <div class="form-group">
                                    <label>Categor&iacutea</label><br>
                                    <input id="up_cate" type="text" id="categoria" name="categoria" value="<?php echo $dato2?>" required><br>
                                    <span class="help-block"></span>
                                </div>
                                <div id=btn_si>
                                    <input onclick= "return confirmUpdate()" type="submit" class="btn btn-primary" value="Actualizar">
                                </div>
                                <div id=btn_no>
                                    <input onclick="location.href='abc_categoria.php'" type="button" class="btn btn-danger" value="Volver">
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