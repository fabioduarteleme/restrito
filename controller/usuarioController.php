<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/usuarios.php";
$tabelabd = "usuario";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (ativo, nome, email, nivel, senha) VALUES (%s, %s, %s, %s, %s)",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['email'], "text"),
GetSQLValueString($_POST['nivel'], "text"),
GetSQLValueString($_POST['senha'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}


//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET ativo=%s, nome=%s, email=%s, senha=%s WHERE idusuario=%s",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['email'], "text"),
GetSQLValueString($_POST['senha'], "text"),
GetSQLValueString($_POST['idusuario'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($updateSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}

// DEPLOY DATA
if ((isset($_GET['del'])) && ($_GET['del'] != "")) {
$deleteSQL = sprintf("DELETE FROM $tabelabd WHERE idusuario=%s",
GetSQLValueString(base64_decode($_GET['del']), "int"));
mysql_select_db($database_db, $db);
$Result3 = mysql_query($deleteSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');
}

// UPDATE ATIVO
if(isset($_POST['valueAtivo'])){
    $valueAtivo=$_POST['valueAtivo'];
    $id=$_POST['id'];
    mysql_query("update $tabelabd set ativo='$valueAtivo' where idusuario=$id");}

?>