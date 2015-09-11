<?php

require_once('class.phpmailer.php');
$mail             = new PHPMailer();
$mail->SetFrom('contato@midiano.com.br', 'Midiano');
$mail->AddReplyTo("contato@midiano.com.br","Fábio Duarte");
$address = base64_decode($_GET['ma']);
$mail->AddAddress($address, base64_decode($_GET['no']));
$mail->Subject    = "BOLETO E COMUNICADO IMPORTANTE";
$mail->MsgHTML(
			   
"<table border='0' width='100%' align='center' bgcolor='#cbcbcb'>
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
<td><span style='font-size:xx-small;font-family:verdana,geneva'><img src='http://www.midiano.com.br/img/template-mail.png' alt='' width='600' height='130'></span></td>
</tr>
</tbody>
</table>
<table border='0' cellspacing='0' cellpadding='0' width='600' align='center' bgcolor='#999999'>
<tbody>
<tr>
<td>
<table border='0' cellspacing='1' width='100%'>
<tbody>
<tr>
<td bgcolor='#ffffff'><span style='font-size:xx-small;font-family:verdana,geneva'><br></span> 
<table style='border-style:dotted;border:dotted #006699 1px' border='0' width='98%' align='center'  bgcolor='#ffe3e4'>
<tbody>
<tr>
<td height='40' align='center'><span style='font-size:10px;font-family:verdana,geneva'><strong><span style='color:#F00'>ATENÇÃO: Não emitiremos mais 2° via de boleto</span></strong><br> 
  <em style='color:#666;'>(Por favor, não responda esta mensagem, se tiver dúvidas envie email para contato@midiano.com.br)</em></span></td>
</tr>
</tbody>
</table>
<span style='font-size:xx-small;font-family:verdana,geneva'><br></span> 
<table border='0' width='98%' align='center'>
<tbody>
<tr>
<td height='25'><strong><span style='font-size:11px;font-family:verdana,geneva'>Prezado(a) </span></strong><span style='font-size:11px;font-family:verdana,geneva'>".base64_decode($_GET['no'])."</span></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td>
<div><span style='font-size:11px; text-align:justify; font-family:verdana, geneva'>Comunicamos que apartir de hoje não enviaremos mais a 2° via de boleto de serviço da Midiano que o sistema costumava enviar todo dia 12 com vencimento para dia 18. Devido aos encargos bancários e priorizando a manutenção dos valores atuais, <b style='color:#F30;'>a Midiano comunica que este é seu última 2° via de cobrança que você estará recebendo.</b><br />
  <br />
  Os boletos continuarão a serem enviados dia 5 com vencimento até dia 10 de cada mês, a verificação do pagamento se dará do dia 10 ao dia 12, <b>não encontrando a validação do pagamento do boleto seu site sairá do ar automaticamente</b>, cabendo ao usuário entrar em contato por email (contato@midiano.com.br) solicitando novo boleto, após a confimação do pagamento do novo boleto o site entrará no ar automaticamente.<br />
  <br />
  Agradecemos a compreensão e relembramos que essa é uma medida que estamos tomando para que os valores não precisem ser ajustados ainda neste ano.<br />
  <br />
  Acesse o link abaixo para visualizar o boleto</span>.<br />
  <br />
</div>
</td>
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
<td height='40' bgcolor='#204051'><span style='color:#ffffff'><strong><span style='font-size:12px;font-family:verdana,geneva'><span style='color:#204051'>-</span>SEU BOLETO <b style='font-size:10px; font-weight:normal;'>(Pagamentos via boleto podem demorar de 24hs à 36hs para baixar no sistema)</b></span></strong></span></td>
</tr>
<tr>
<td>
<table border='0' cellspacing='1' width='100%' bgcolor='#cccccc'>
<tbody>
<tr>
<td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Valor da Fatura:</strong> R$ ".base64_decode($_GET['dh'])."</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Referencia:</strong> ".base64_decode($_GET['ref'])."</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Forma de Pagamento:</strong> Boleto Bancário</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong>Vencimento:</strong> ".base64_decode($_GET['v'])."</span></td>
</tr>
<tr>
<td height='25' bgcolor='#ffffff'>

<table width='175' height='40' border='0' cellspacing='5' cellpadding='5'>
  <tr>
    <td><div style='background:#C90; width:175px; height:35px; background:#204051; border:2px solid #153241; font-size:15px; text-align:center; font-family:Arial, Helvetica, sans-serif; font-weight:bold;'><a style='text-decoration:none; color:#CCC; line-height:30px;' target='_blank' href='http://www.midiano.com.br/sistema/boleto/boleto.php?c=".$_GET['c']."&dh=".$_GET['dh']."&v=".$_GET['v']."&cl=".$_GET['cl']."&end=".$_GET['end']."&ci=".$_GET['ci']."&u=".$_GET['u']."'> Visualize seu Boleto</a></div></td>
  </tr>
</table>


</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td height='40' bgcolor='#204051'><span style='color:#ffffff'><strong><span style='font-size:12px;font-family:verdana,geneva'><span style='color:#204051'>-</span>DADOS PARA DEPÓSITO BANCÁRIO <b style='font-size:10px; font-weight:normal;'>(Compensação imediata ou em até 24hs)</b></span></strong></span></td>
</tr>

<tr>
<td>
<table border='0' cellspacing='1' width='100%' bgcolor='#cccccc'>
<tbody>
<tr>
<td width='44%' height='25' bgcolor='#ffffff'><span style='font-size:11px;font-family:verdana,geneva'><strong><br>
  BANCO ITAÚ</strong> - CONTA CORRENTE<br>
------------------------------------------------------<br>
 <strong>Agência:</strong> 3713<br>
 <strong>C/C:</strong> 13512-1<br>
 <strong>CPF:</strong> 049.937.359-60<br>
 <strong>Fábio Duarte Leme </strong><br> <br> <br> </span></td>
</tr>
</tbody>
</table>
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
<table border='0' cellspacing='1' width='98%' align='center'>
<tbody>
<tr>
<td height='144' bgcolor='#ffffff'>
<div>
<p><span style='font-size:11px;font-family:verdana,geneva'>Qualquer dúvida estamos disponíveis 24 horas por dia. Caso necessite de alguma informação que não foi contemplada neste email, estaremos a sua disposição. </span> <span style='font-size:11px;font-family:verdana,geneva'> <br> <br> Atenciosamente, </span><br>
  <br>
  <span style='font-size:11px;font-family:verdana,geneva'><strong>Fábio Duarte</strong><br>
   Midiano - Desenvolvendo Soluções<br>
   Website: www.midiano.com.br<br>
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
<tr>
<td><span style='font-size:xx-small;font-family:verdana,geneva'><img src='http://www.midiano.com.br/img/template-mail2.png' alt='' width='600' height='30'> </span></td>
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
</table>"
  );

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  print "<script>window.setTimeout('history.go(-1)', 500);alert('2 via de Boleto enviado com sucesso!');</script>";
}

?>