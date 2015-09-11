<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/imoveis.php";
$tabelabd = "imovel";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (dataCadastro, horaCadastro, idusuario, ativo, destaque, categoria, tipo, nome, endereco, complemento, valor, suites, quartos, estado, cidade, detalhes) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['dataCadastro'], "text"),
GetSQLValueString($_POST['horaCadastro'], "text"),
GetSQLValueString($_POST['idusuario'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['destaque'], "text"),
GetSQLValueString($_POST['categoria'], "text"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['endereco'], "text"),
GetSQLValueString($_POST['complemento'], "text"),
GetSQLValueString($_POST['valor'], "text"),
GetSQLValueString($_POST['suites'], "text"),
GetSQLValueString($_POST['quartos'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['detalhes'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1&idpost='.mysql_insert_id());}


//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET ativo=%s, destaque=%s, categoria=%s, tipo=%s, nome=%s, endereco=%s, complemento=%s, valor=%s, suites=%s, quartos=%s, estado=%s, cidade=%s, detalhes=%s WHERE id=%s",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['destaque'], "text"),
GetSQLValueString($_POST['categoria'], "text"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['endereco'], "text"),
GetSQLValueString($_POST['complemento'], "text"),
GetSQLValueString($_POST['valor'], "text"),
GetSQLValueString($_POST['suites'], "text"),
GetSQLValueString($_POST['quartos'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['detalhes'], "text"),
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