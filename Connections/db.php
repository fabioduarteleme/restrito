<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$nomeempresa = "Nome da Empresa";
$emaildosuporte = "contato@dominio.com.br";
$hostname_db = "localhost";
$database_db = "nomedobanco";
$username_db = "root";
$password_db = "";
$db = mysql_pconnect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(),E_USER_ERROR)
?>