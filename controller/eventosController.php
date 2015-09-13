<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/eventos.php";
$tabelabd = "eventos";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (dataCadastro, tipo, ativo, data, horario, diadasemana, titulo, descricao, valor1, valor2, url1, url2, local, cidade, estado, informacao, mapa, idgaleria) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['dataCadastro'], "date"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['data'], "date"),
GetSQLValueString($_POST['horario'], "text"),
GetSQLValueString($_POST['diadasemana'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['descricao'], "text"),
GetSQLValueString($_POST['valor1'], "text"),
GetSQLValueString($_POST['valor2'], "text"),
GetSQLValueString($_POST['url1'], "text"),
GetSQLValueString($_POST['url2'], "text"),
GetSQLValueString($_POST['local'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['informacao'], "text"),
GetSQLValueString($_POST['mapa'], "text"),
GetSQLValueString($_POST['idgaleria'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1&idpost='.mysql_insert_id());}


//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET dataCadastro=%s, tipo=%s, ativo=%s, data=%s, horario=%s, diadasemana=%s, titulo=%s, descricao=%s, valor1=%s, valor2=%s, url1=%s, url2=%s, local=%s, cidade=%s, estado=%s, informacao=%s, mapa=%s, idgaleria=%s WHERE id=%s",
GetSQLValueString($_POST['dataCadastro'], "date"),
GetSQLValueString($_POST['tipo'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['data'], "date"),
GetSQLValueString($_POST['horario'], "text"),
GetSQLValueString($_POST['diadasemana'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['descricao'], "text"),
GetSQLValueString($_POST['valor1'], "text"),
GetSQLValueString($_POST['valor2'], "text"),
GetSQLValueString($_POST['url1'], "text"),
GetSQLValueString($_POST['url2'], "text"),
GetSQLValueString($_POST['local'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['informacao'], "text"),
GetSQLValueString($_POST['mapa'], "text"),
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