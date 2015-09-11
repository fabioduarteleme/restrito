<?php 
require_once('../Connections/db.php');

$con = mysql_connect( $hostname_db, $username_db, $password_db ) ;
mysql_select_db( $database_db, $con );
$idmarca = mysql_real_escape_string( $_GET['idmarca'] );
$modelo = array();

$sql = "SELECT * FROM carro_modelo WHERE fabricante=$idmarca ORDER BY nome";
//$sql = "SELECT * FROM nome WHERE estados_cod_estados=$idmarca ORDER BY nome";
$res = mysql_query($sql);
while ($row = mysql_fetch_assoc($res)){
  $modelo[] = array(
    'idmodelo'  => $row['id'],
    'nome'      => (utf8_encode($row['nome'])),
  );
}

echo( json_encode($modelo));

 ?>