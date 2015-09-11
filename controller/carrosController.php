<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/carros.php";
$tabelabd = "carro";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (data_cadastro, idusuario, destaque, ativo, idmarca, idmodelo, titulo, opcional, observacao, km, porta, ano, cor, preco, combustivel, motor) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['data_cadastro'], "date"),
GetSQLValueString($_POST['idusuario'], "text"),
GetSQLValueString($_POST['destaque'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['idmarca'], "text"),
GetSQLValueString($_POST['idmodelo'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['opcional'], "text"),
GetSQLValueString($_POST['observacao'], "text"),
GetSQLValueString($_POST['km'], "text"),
GetSQLValueString($_POST['porta'], "text"),
GetSQLValueString($_POST['ano'], "text"),
GetSQLValueString($_POST['cor'], "text"),
GetSQLValueString($_POST['preco'], "text"),
GetSQLValueString($_POST['combustivel'], "text"),
GetSQLValueString($_POST['motor'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1&idpost='.mysql_insert_id());}


//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET ativo=%s, destaque=%s, idmarca=%s, idmodelo=%s, titulo=%s, opcional=%s, observacao=%s, km=%s, porta=%s, ano=%s, cor=%s, preco=%s, combustivel=%s, motor=%s WHERE id=%s",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['destaque'], "text"),
GetSQLValueString($_POST['idmarca'], "text"),
GetSQLValueString($_POST['idmodelo'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['opcional'], "text"),
GetSQLValueString($_POST['observacao'], "text"),
GetSQLValueString($_POST['km'], "text"),
GetSQLValueString($_POST['porta'], "text"),
GetSQLValueString($_POST['ano'], "text"),
GetSQLValueString($_POST['cor'], "text"),
GetSQLValueString($_POST['preco'], "text"),
GetSQLValueString($_POST['combustivel'], "text"),
GetSQLValueString($_POST['motor'], "text"),
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