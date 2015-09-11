<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/configuracoes.php";
$tabelabd = "config";

//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET  termos=%s, titulo=%s WHERE id=%s",
GetSQLValueString($_POST['termos'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['id'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($updateSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}

?>