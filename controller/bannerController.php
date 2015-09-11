<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/banner.php";
$tabelabd = "banner";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (dataCadastro, idusuario, ativo, categoria, titulo, descricao, link) VALUES (%s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['dataCadastro'], "date"),
GetSQLValueString($_POST['idusuario'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['categoria'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['descricao'], "text"),
GetSQLValueString($_POST['link'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1&idpost='.mysql_insert_id());}

//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET ativo=%s, categoria=%s, titulo=%s, descricao=%s, link=%s WHERE id=%s",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['categoria'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['descricao'], "text"),
GetSQLValueString($_POST['link'], "text"),
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