<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/setup.php";
$tabelabd = "setup";

//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET  indexcontagem=%s, indexcontagemdata=%s, indexvideoativo=%s, indexvideourl=%s, keyword=%s, descricao=%s, eleicaovotacao=%s, eleicaovencedor=%s, titulo=%s, ativo=%s WHERE id=%s",
GetSQLValueString($_POST['indexcontagem'], "text"),
GetSQLValueString($_POST['indexcontagemdata'], "date"),
GetSQLValueString($_POST['indexvideoativo'], "text"),
GetSQLValueString($_POST['indexvideourl'], "text"),
GetSQLValueString($_POST['keyword'], "text"),
GetSQLValueString($_POST['descricao'], "text"),
GetSQLValueString($_POST['eleicaovotacao'], "text"),
GetSQLValueString($_POST['eleicaovencedor'], "text"),
GetSQLValueString($_POST['titulo'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['id'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($updateSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}

?>