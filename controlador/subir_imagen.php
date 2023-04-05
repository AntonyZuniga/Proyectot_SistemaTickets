<?php

$dato1 = $_GET['id'];
require_once "conexion.php";
    if(isset($_POST['submit'])!=""){
        $name=$_FILES['file']['name'];
        $size=$_FILES['file']['size'];
        $type=$_FILES['file']['type'];
        $temp=$_FILES['file']['tmp_name'];
        $fname=date("YmdHis").'_'.$name;

        $move = move_uploaded_file($temp,"../evidencias/".$fname);
        if($move){
            $query=$link->query("INSERT INTO evidencias(name, fname) VALUES ('$name','$fname')");
            if($query){
                header("location:../soporte.php");
            }else{
                die(mysql_error());
            }
        }
    }
?>