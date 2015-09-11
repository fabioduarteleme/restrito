<?php
	include('../Connections/db.php');
    include("../classes/thumb.php");

	$conn = @mysql_connect($hostname_db, $username_db, $password_db) or die ("Problemas na conexão.");
    $db = @mysql_select_db($database_db, $conn) or die ("Problemas na conexão");

    $tabelabd = "fotos";
    $w = $_GET['w'];
    $h = $_GET['h'];

if(isset($_GET['iduser'])){
    $idusuario = base64_decode($_GET['iduser']);
    $idregistro = base64_decode($_GET['upload']);
    $tipo = $_GET['tipo'];
    $datahoje = date('Y-m-d');
    $destaque = "N";

    if(isset($_FILES['upl'])){    
    $errors= array();        
    $file_name = $_FILES['upl']['name'];
    $file_size =$_FILES['upl']['size'];
    $file_tmp =$_FILES['upl']['tmp_name'];
    $file_type=$_FILES['upl']['type'];   
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $extensions = array("jpeg","jpg","JPG", "JPEG");        
    if(in_array($file_ext,$extensions )=== false){
         $errors[]="image extension not allowed, please choose a JPEG file.";
    }
    if($file_size > 2097152){
        $errors[]='File size cannot exceed 2 MB';
    }               
    if(empty($errors)==true){ 
        $ext = explode(".", $_FILES['Filedata']['name']);
        $targetFile =  $idusuario."_".$idregistro."_".rand().".".$file_ext;
        $sql = mysql_query("INSERT INTO fotos (dataCadastro, idusuario, tipo, idrelacionamento, destaque, titulo, nomepath) 
                                       VALUES ('$datahoje', '$idusuario', '$tipo', '$idregistro', '$destaque', '$file_name', '$targetFile')");
        
        move_uploaded_file($file_tmp,"../img/fotos/".$targetFile);
        Thumbnail( "../img/fotos/".$targetFile, "../img/fotos/".$targetFile , $w, $h);
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
}


///////////////////##########  FOTOS DOS CARROS  ##########///////////////////////////////////////////////////

// UPDATE FOTO LEGENDA1
if(isset($_GET['valueLegenda1'])){
    $valueLegenda1=$_GET['valueLegenda1'];
    $id=$_GET['id'];
    mysql_query("update fotos set titulo='$valueLegenda1' where id=$id");}

// UPDATE FOTO DESTAQUE
if(isset($_POST['valueDestaque'])){
    $valueDestaque=$_POST['valueDestaque'];
    $id=$_POST['id'];
    mysql_query("update fotos set destaque='$valueDestaque' where id=$id");}

// ORDENA FOTOS
if(isset($_POST['action'])){
$action = mysql_real_escape_string($_POST['action']); 
$updateRecordsArray   = $_POST['recordsArray'];
if ($action == "updateRecordsListings"){ 
  $listingCounter = 1;
  foreach ($updateRecordsArray as $recordIDValue) {  
    $query = "UPDATE fotos SET ordem = " . $listingCounter . " WHERE id = " . $recordIDValue;
    mysql_query($query) or die('Error, insert query failed');
    $listingCounter = $listingCounter + 1;  
  }
}
}

 ?>