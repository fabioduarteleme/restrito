<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/empresa.php";
$tabelabd = "empresa";

//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET nome=%s, cnpj=%s, documento=%s, endereco=%s, telefone=%s, celular=%s, cidade=%s, estado=%s, email=%s, site=%s, fanpage=%s, mapa=%s, apresentacao=%s WHERE id=%s",
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['cnpj'], "text"),
GetSQLValueString($_POST['documento'], "text"),
GetSQLValueString($_POST['endereco'], "text"),
GetSQLValueString($_POST['telefone'], "text"),
GetSQLValueString($_POST['celular'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['email'], "text"),
GetSQLValueString($_POST['site'], "text"),
GetSQLValueString($_POST['fanpage'], "text"),
GetSQLValueString($_POST['mapa'], "text"),
GetSQLValueString($_POST['apresentacao'], "text"),
GetSQLValueString($_POST['id'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($updateSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}

// DEPLOY DATA        
if ((isset($_GET['del'])) && ($_GET['del'] != "")) {
$registerdel = base64_decode($_GET['del']);
$deleteSQL = sprintf("DELETE FROM $tabelabd WHERE id='$registerdel'",
GetSQLValueString($registerdel, "int"));
mysql_select_db($database_db, $db);
$Result3 = mysql_query($deleteSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');
}


///////////////////##########  FOTOS DOS IMOVEIS  ##########///////////////////////////////////////////////////

// UPDATE FOTO DESTAQUE
if(isset($_POST['valueDestaque'])){
    $valueDestaque=$_POST['valueDestaque'];
    $id=$_POST['id'];
    mysql_query("update fotos set destaque='$valueDestaque' where id=$id");}

// ORDENA FOTOS
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

?>