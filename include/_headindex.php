<?php
if (!isset($_SESSION)) {
session_start();
}

require_once('Connections/db.php');

$url = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];

if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


if (isset($_POST['email'])) {
  $loginUsername=$_POST['email'];
  $password=$_POST['senha'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "view/painelprincipal.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_db, $db);
  
  $LoginRS__query=sprintf("SELECT email, senha FROM usuario WHERE email=%s AND senha=%s AND ativo = 'S'",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $db) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";

    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;       

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];  
    }
   print "<script>window.location='view/painelprincipal.php';</script>";
  }
  else {
   print "<script>window.location='index.php?s=1';</script>";
  }
}

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_admin = "SELECT * FROM config ORDER BY id DESC";
$admin = mysql_query($query_admin, $db) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);
$totalRows_admin = mysql_num_rows($admin);

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row_admin["titulo"]; ?></title>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <link rel="author" href="http://midiano.com.br" />
    <meta name="robots" content="noindex">
    <link href="img/config/favicon/<?php echo $row_admin["favicon"]; ?>" rel="icon" type="image/x-icon" />

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <link href="css/mint-admin.css" rel="stylesheet" />
    <link href="css/plugins/animate.css" rel="stylesheet" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

    <body class="login animated fadeIn" style="background-image:url('img/config/<?php if (@$row_admin['background'] == "") { ?>bg-default.jpg<?php } else { ?><?php echo $row_admin["background"]; ?><?php } ?>');">

        <div id="wrapper">