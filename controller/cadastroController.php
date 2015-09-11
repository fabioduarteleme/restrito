<?php
include('../Connections/db.php');

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

$pagereturn = "../cadastre-se.php";
$email = $_POST['email'];
 
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM usuario WHERE email='$email' ORDER BY idusuario DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);

if (@$row_r['email'] == $email) {
  print "<script>window.location='".$pagereturn."?ativo=s&s=s&usuario=n';</script>";

} else {

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO usuario (data_cadastro, hora_cadastro, ativo, verificado, nome, email, telefone, cpf, cidade, estado, senha, nivel) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['data_cadastro'], "date"),
GetSQLValueString($_POST['hora_cadastro'], "date"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['verificado'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['email'], "text"),
GetSQLValueString($_POST['telefone'], "text"),
GetSQLValueString($_POST['cpf'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['senha'], "text"),
GetSQLValueString($_POST['nivel'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

$headers = "Content-type: text/html; charset=UTF-8";
require_once('../phpmailer/class.phpmailer.php');
$mail             = new PHPMailer();
$mail->SetFrom('contato@midiano.com.br', 'Painel de Controle');
$mail->AddReplyTo("contato@midiano.com.br","Fábio Duarte");
$address = $_POST['email'];
$mail->AddAddress($address, $_POST['nome']);
$mail->Subject    = "Cadastro efetuado com sucesso!";
$mail->MsgHTML(
"<table border='0' width='100%' align='center' bgcolor='#DDD'>
<tbody>
<tr>
<td>
<table border='0' width='600' align='center'>
<tbody>
<tr>
<td>
<table border='0' width='600' align='center'>
<tbody>
<tr>
<td><span style='font-size:xx-small;font-family:verdana,geneva'><img src='http://www.midiano.com.br/corretagem/img/logo-topo.jpg' alt='Logo Corretagem' width='600' height='130'></span></td>
</tr>
</tbody>
</table>
<table border='0' cellspacing='0' cellpadding='0' width='600' align='center'>
<tbody>
<tr>
<td>
<table border='0' cellspacing='1' width='100%'>
<tbody>
<tr>
<td bgcolor='#ffffff'><span style='font-size:xx-small;font-family:verdana,geneva'></span> 

<span style='font-size:xx-small;font-family:verdana,geneva'><br></span> 
<table border='0' width='100%' align='center'>
<tbody>
<tr>
  <td></td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>


<table border='0' width='98%' align='center'>
<tbody>
<tr>
<td height='40' bgcolor='#303742' align='center'><span style='color:#ffffff'><strong><span style='font-size:12px;font-family:verdana,geneva'><span style='color:#3a2e3a'></span>PARABÉNS, VOCÊ FOI CADASTRADO COM SUCESSO!</span></strong></span></td>
</tr>
<tr>
<td>
<table border='0' cellspacing='1' width='100%' bgcolor='#cccccc'>
<tbody>
<tr>
<td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Seu login:</strong> ".$_POST['email']."</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Sua Senha:</strong> ".$_POST['senha']."</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'><span style='font-size:11px; font-family:verdana, geneva'><em>Guarde esses dados para acessar sua área de administração caso for necessario.</em></span></td>
</tr>
</tbody>
</table>
</td>
<td> 
</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
  <td>
  </td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>

<table border='0' width='98%' align='center'>
<tbody>
<tr>
<td height='40' bgcolor='#303742' align='center'><span style='color:#ffffff'><strong><span style='font-size:12px;font-family:verdana,geneva'><span style='color:#3a2e3a'></span>ATIVAÇÃO DE CONTA</span></strong></span></td>
</tr>
<tr>
<td>
<table border='0' cellspacing='1' width='100%' bgcolor='#cccccc'>
<tbody>
<tr>
<td width='44%' height='25' align='center' bgcolor='#ffffff'><div style='font-size:11px;font-family:verdana,geneva; background:#1abc9c; padding:20px; display:inline-block; margin:15px 10px'><strong><a style='text-decoration:none; color:#FFF;' target='_blank' href='http://www.midiano.com.br/corretagem/painel/ativar.php?token=".base64_encode($_POST['email'])."'> CLIQUE AQUI PARA ATIVAR SUA CONTA </a></strong></div></td>
</tr>


</tr>
</tbody>
</table>

<table border='0' cellspacing='1' width='98%' align='center'>
<tbody>
<tr>
<td height='144' bgcolor='#ffffff'>
<div>
<p><span style='font-size:11px;font-family:verdana,geneva'>Qualquer dúvida estamos disponíveis 24 horas por dia no e-mail de contato abaixo. Caso necessite de alguma informação que não foi contemplada neste email, estaremos a sua disposição. </span> <span style='font-size:11px;font-family:verdana,geneva'> <br> <br> Atenciosamente, </span><br>
  <br>
  <span style='font-size:11px;font-family:verdana,geneva'><strong>Fábio Duarte</strong><br>
   Sistema Corretagem<br>
   Website: www.midiano.com.br/corretagem<br>
   Central de Atendimento: contato@midiano.com.br</span></p>
</div>
</td>
</tr>
</tbody>
</table>
<table border='0' width='100%'>
<tbody>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table border='0' width='600' align='center'>
<tbody>

</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else { 
}
print "<script>window.location='".$pagereturn."?s=1';</script>";
}
}
?>