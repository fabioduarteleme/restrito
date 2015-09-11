<?php
require_once('../Connections/db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$tabelabd = $_GET['area'];

$con = @mysqli_connect($hostname_db, $username_db, $password_db, $database_db);

if (!$con) {
 trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}
$var = array();
$sql = "SELECT * FROM $tabelabd WHERE idusuario='".$_GET["user"]."' AND ativo='".$_GET["ativo"]."' ORDER BY id DESC";
$result = mysqli_query($con, $sql);

while($obj = mysqli_fetch_object($result)) {
$var[] = $obj;
}
echo '{"'.$tabelabd.'":'.json_encode($var).'}';
?>
