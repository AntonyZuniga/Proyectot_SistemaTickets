<?php

require "conexion.php";

$soporte =  $_POST['variable'];

if($soporte != "todos"){

    $sql = "SELECT r.id_reporte, r.usuario_reporte,
    r.tel_extension,
    e.estatus,
    c.categoria,
    a.area,
    r.problema,
    r.solucion,
    DATE_FORMAT(r.fecha_creacion, '%d-%m-%Y %H:%i:%s') as fechacrea,
    r.patrimonio,
    r.tipo_equipo,
    r.serie,
    r.observaciones_del_equipo,
    e.id_estatus
FROM reportes r
INNER JOIN estatus e
ON r.id_estatus = e.id_estatus
INNER JOIN categorias c
ON r.id_categoria = c.id_categoria
INNER JOIN areas a
ON r.id_area = a.id_area WHERE id_asignado_a = $soporte order by r.id_reporte desc";

$result = mysqli_query($link, $sql);

while($row=mysqli_fetch_array($result)){
    $resultado = '
    
     <tr>
         
         <th style=" font-weight: normal;">'.$row["area"].'</th>   
         <th style="font-weight: normal;">'.$row["problema"].'</th>
         <th style="font-weight: normal;">'.$row["observaciones_del_equipo"].'</th>
         <th style="font-weight: normal;">'.$row["solucion"].'</th>
        <th style="font-weight: normal;">'.$row["fechacrea"].'</th>
         <th style="font-weight: normal;"><a target="_blank" href="info_ver.php?id='.$row["id_reporte"].'"><i style="place-items: center; justify-content: center; display:grid;" class="bi bi-eye-fill"></i></a></th>
         
     </tr>
   
                             
    ';
    echo $resultado;
}


}else{


    $sql = "SELECT r.id_reporte, r.usuario_reporte,
    r.tel_extension,
    e.estatus,
    c.categoria,
    a.area,
    r.problema,
    r.solucion,
    DATE_FORMAT(r.fecha_creacion, '%d-%m-%Y %H:%i:%s') as fechacrea,
    r.patrimonio,
    r.tipo_equipo,
    r.serie,
    r.observaciones_del_equipo,
    e.id_estatus
FROM reportes r
INNER JOIN estatus e
ON r.id_estatus = e.id_estatus
INNER JOIN categorias c
ON r.id_categoria = c.id_categoria
INNER JOIN areas a
ON r.id_area = a.id_area order by r.id_reporte desc";

$result = mysqli_query($link, $sql);

while($row=mysqli_fetch_array($result)){
    $resultado = '
    
    <tr>
        <th style=" font-weight: normal;">'.$row["area"].'</th>   
        <th style="font-weight: normal;">'.$row["problema"].'</th>
        <th style="font-weight: normal;">'.$row["observaciones_del_equipo"].'</th>
        <th style="font-weight: normal;">'.$row["solucion"].'</th>
        <th style="font-weight: normal;">'.$row["fechacrea"].'</th>
        <th style="font-weight: normal;"><a target="_blank" href="info_ver.php?id='.$row["id_reporte"].'"><i style="place-items: center; justify-content: center; display:grid;" class="bi bi-eye-fill"></i></a></th>
    </tr>
  
                            
   ';
   echo $resultado;
}
    
    
}   

?>
