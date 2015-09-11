<?php
require_once('../Connections/db.php');
$connection = mysql_connect($hostname_db, $username_db, $password_db) or die( "Unable to connect");
$database = mysql_select_db($database_db) or die( "Unable to select database");
?>