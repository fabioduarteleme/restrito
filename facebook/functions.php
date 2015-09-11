<?php
include 'dbconfig.php';
function checkuser($fuid,$ffname,$femail){
    $check = mysql_query("select * from usuario where email='$femail'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record		
	$query = "INSERT INTO usuario (ativo, nome, email, data_cadastro, nivel, imagem) VALUES ('N','$ffname','$femail', '".date('Y-m-d')."', '0', '$fuid' )";
	mysql_query($query);	
	} else {   // If Returned user . update the user record		
	$query = "UPDATE usuario SET nome='$ffname', email='$femail' where email='$femail'";
	mysql_query($query);
	}
}?>
