<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');

$pagereturn = "../view/contatos.php";
$tabelabd = "contatos";

//INSERT DATA
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "addForm")) {
$insertSQL = sprintf("INSERT INTO $tabelabd (data_cadastro, hora_cadastro, idusuario, ativo, nome, email, estado, cidade, telefone, assunto, texto) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
GetSQLValueString($_POST['data_cadastro'], "date"),
GetSQLValueString($_POST['hora_cadastro'], "date"),
GetSQLValueString($_POST['idusuario'], "text"),
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['nome'], "text"),
GetSQLValueString($_POST['email'], "text"),
GetSQLValueString($_POST['estado'], "text"),
GetSQLValueString($_POST['cidade'], "text"),
GetSQLValueString($_POST['telefone'], "text"),
GetSQLValueString($_POST['assunto'], "text"),
GetSQLValueString($_POST['texto'], "text"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($insertSQL, $db) or die(mysql_error());

$headers = "Content-type: text/html; charset=UTF-8";
require_once('../phpmailer/class.phpmailer.php');
$mail             = new PHPMailer();
$mail->SetFrom('contato@midiano.com.br', 'Corretagem');
$mail->AddReplyTo($_POST['email'],$_POST['nome']);
$address = $_POST['emailusuario'];
//$mail->AddAddress($address, $_POST['nome']);
$mail->Subject    = "Contato de seu site";
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
      <td height='40' bgcolor='#303742' align='center'><span style='color:#ffffff'><strong><span style='font-size:12px;font-family:verdana,geneva'>CONTATO ENVIADO PELO SEU SITE EM ".$_POST['data_cadastro']." </span></strong></span></td>
    </tr>
    <tr>
      <td><table border='0' cellspacing='1' width='100%' bgcolor='#cccccc'>
          <tbody>
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Nome:</strong> ".$_POST['nome']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>E-mail:</strong> ".$_POST['email']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Telefone:</strong> ".$_POST['telefone']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Estado:</strong> ".$_POST['estado']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Cidade:</strong> ".$_POST['cidade']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Assunto:</strong> ".$_POST['assunto']."</span></td>
            </tr>
            
            <tr>
              <td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Mensagem:</strong> ".$_POST['texto']."</span></td>
            </tr>
            <tr>
              <td height='25' bgcolor='#ffffff'>&nbsp;</td>
            </tr>
            <tr>
              <td height='25' bgcolor='#ffffff'><em><span style='font-family: verdana, geneva; font-size: 11px'>Esse e-mail é apenas uma cópia da mensagem que esta armazenada em seu painel de controle</span></em></td>
            </tr>
          </tbody>
        </table></td>
      <td></td>
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
}

//UPDATE DATA
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "editForm")) {
$updateSQL = sprintf("UPDATE $tabelabd SET ativo=%s WHERE id=%s",
GetSQLValueString($_POST['ativo'], "text"),
GetSQLValueString($_POST['id'], "int"));
mysql_select_db($database_db, $db);
$Result1 = mysql_query($updateSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');}

// DEPLOY DATA        
if ((isset($_GET['del'])) && ($_GET['del'] != "")) {
$registerdel = base64_decode($_GET['del']);
$deleteSQL = sprintf("DELETE FROM $tabelabd WHERE id='$registerdel'",
GetSQLValueString($registerdel, "int"));
mysql_select_db($database_db, $db);
$Result3 = mysql_query($deleteSQL, $db) or die(mysql_error());
header('location:'.$pagereturn.'?s=1');
}

// UPDATE AJAX IMOVEL ATIVO
if(isset($_POST['valueAtivo'])){
    $valueAtivo=$_POST['valueAtivo'];
    $id=$_POST['id'];
    mysql_query("update $tabelabd set ativo='$valueAtivo' where id=$id");}

?>