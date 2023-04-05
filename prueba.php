porsi

if(isset($_POST['submit'])!=""){
        $countfiles = count($_FILES['file']['name']);
        for($i=0;$i<$countfiles;$i++){
        $name=$_FILES['file']['name'][$i];
        $size=$_FILES['file']['size'];
        $type=$_FILES['file']['type'];
        $temp=$_FILES['file']['tmp_name'];
        $fname=date("YmdHis").'_'.$name;
        $move = move_uploaded_file($temp,"../evidencias/".$fname);
        if($move){
            $query=$link->query("INSERT INTO evidencias(name, fname) VALUES ('$name','$fname')");
            if($query){
                
            }else{
                die(mysql_error());
            }
        }
    }
}