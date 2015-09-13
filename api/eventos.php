<?php

// eventos.php?tipo=show&user=4

require_once('../Connections/db.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$tabelabd = "eventos";

$con = @mysqli_connect($hostname_db, $username_db, $password_db, $database_db);

if (!$con) {
 trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}
$var = array();
$sql = "SELECT * FROM $tabelabd WHERE idusuario='".$_GET["user"]."' AND tipo='".$_GET["tipo"]."' AND ativo='S' ORDER BY id DESC";
$result = mysqli_query($con, $sql);

while($obj = mysqli_fetch_object($result)) {
	
	$sql_galeria = "SELECT * FROM fotos WHERE idrelacionamento='". $obj->idgaleria."' ORDER BY ordem ASC";
    $result_galeria = mysqli_query($con, $sql_galeria);
    
    while ($galeria = mysqli_fetch_object($result_galeria)) {
        $obj->galeria[] = $galeria;
    };

    $sql_capa = "SELECT * FROM fotos WHERE idrelacionamento='". $obj->idgaleria."' AND destaque='S'";
	$result_capa = mysqli_query($con, $sql_capa);
	   
    while ($capa = mysqli_fetch_object($result_capa)) {
        $obj->capa[] = $capa;
    };

$var[] = $obj;
}
echo json_encode($var);
?>