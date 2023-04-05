<?php 
    require_once "conexion.php";
    $sql = "SELECT id_estatus FROM estatus WHERE estatus = 'En proceso'";
     $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
         $dato2 = $row["id_estatus"];            
         }
                        
    }
?>

<?php 
    require_once "conexion.php";
    $dato1 = $_GET['id'];
    $sql = "SELECT id_estatus FROM reportes WHERE id_reporte='$dato1'";
     $result = mysqli_query($link, $sql);
        if($result->num_rows>0){
        while ($row = $result->fetch_assoc()){
         $estatus = $row["id_estatus"];            
         }
                        
    }
?>


<?php
    // Include config file
    require_once "conexion.php";
    $dato1 = $_GET['id'];

    $actualizar = "UPDATE reportes SET id_estatus=$dato2 WHERE id_reporte='$dato1'";
    if($estatus == 2){
    $resultado=mysqli_query($link, $actualizar);
    if ($resultado) {
        echo "<script>alert(`Se cambio estatus a: En Proceso del reporte con el id ${dato1}`);window.location='../info_reporte.php?id=".$dato1."';</script>";
    } else {
        echo"<script>alert('Algo salio mal');window.location='soporte.php'</script>";
    }
}else if($estatus >=3){
    echo "<script>window.location='../info_reporte.php?id=".$dato1."';</script>";   
}mysqli_close($link);
?>
