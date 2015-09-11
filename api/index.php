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
	
	$sql_galeria = "SELECT id, idrelacionamento, destaque, titulo FROM fotos WHERE idrelacionamento='". $obj->idgaleria."'";
    $result_galeria = mysqli_query($con, $sql_galeria);
    
    while ($galeria = mysqli_fetch_object($result_galeria)) {
        $obj->galeria[] = $galeria;
    };

$var[] = $obj;
}
echo json_encode($var);
?>