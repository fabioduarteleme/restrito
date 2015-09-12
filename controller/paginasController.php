<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/paginas.php";
$tabelabd = "paginas";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (data_cadastro, idusuario, tipo, ativo, titulo, texto01, texto02, texto03, texto04, idgaleria) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['data_cadastro'], "date"),
GetSQLValueString($_POST['idusuario'], "text"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['texto01'], "text"),
GetSQLValueString($_POST['texto02'], "text"),
GetSQLValueString($_POST['texto03'], "text"),
GetSQLValueString($_POST['texto04'], "text"),
GetSQLValueString($_POST['idgaleria'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1&idpost='.mysql_insert_id());}


//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET data_cadastro=%s, tipo=%s, ativo=%s, titulo=%s, texto01=%s, texto02=%s, texto03=%s, texto04=%s, idgaleria=%s WHERE id=%s",
GetSQLValueString($_POST['data_cadastro'], "date"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['texto01'], "text"),
GetSQLValueString($_POST['texto02'], "text"),
GetSQLValueString($_POST['texto03'], "text"),
GetSQLValueString($_POST['texto04'], "text"),
GetSQLValueString($_POST['idgaleria'], "text"),
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


// UPDATE ATIVO
if(isset($_POST['valueAtivo'])){
    $valueAtivo=$_POST['valueAtivo'];
    $id=$_POST['id'];
    mysql_query("update $tabelabd set ativo='$valueAtivo' where id=$id");}

?>