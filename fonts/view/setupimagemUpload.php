<?php
    include('../Connections/db.php');
    include("../classes/thumb.php");
    
    $conn = @mysql_connect($hostname_db, $username_db, $password_db) or die ("Problemas na conexão.");
    $db = @mysql_select_db($database_db, $conn) or die ("Problemas na conexão");

    $idusuario = base64_decode($_GET['iduser']);
    $idregistro = base64_decode($_GET['upload']);


    if(isset($_FILES['upl'])){    
    $errors= array();        
    $file_name = $_FILES['upl']['name'];
    $file_size =$_FILES['upl']['size'];
    $file_tmp =$_FILES['upl']['tmp_name'];
    $file_type=$_FILES['upl']['type'];   
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $extensions = array("jpeg","jpg");        
    if(in_array($file_ext,$extensions )=== false){
         $errors[]="image extension not allowed, please choose a JPEG file.";
    }
    if($file_size > 2097152){
        $errors[]='File size cannot exceed 2 MB';
    }               
    if(empty($errors)==true){ 
        $ext = explode(".", $_FILES['Filedata']['name']);
        $targetFile =  rand().".".$file_ext;
        $sql = mysql_query("UPDATE setup SET imagem = '$targetFile' WHERE id = '$idregistro' ");
        move_uploaded_file($file_tmp,"../img/setup/".$targetFile);
        Thumbnail( "../img/setup/".$targetFile, "../img/setup/".$targetFile , 1024, 1024);
        echo '{"status":"success"}';
        exit;
    }else{
        print_r($errors);
    }
}
else{
    $errors= array();
    $errors[]="No image found";
    print_r($errors);
}
?>