<?php 
require_once('Connections/db.php');

mysql_select_db($database_db, $db);
$query_usuario = "SELECT * FROM usuario WHERE email= '".base64_decode($_GET['token'])."'";
$usuario = mysql_query($query_usuario, $db) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

if (@$row_usuario['verificado'] == "N") {
$query0 = "UPDATE usuario SET verificado ='S' WHERE email = '".base64_decode($_GET['token'])."'";
mysql_query($query0);

$query1 = "UPDATE usuario SET ativo ='S' WHERE email = '".base64_decode($_GET['token'])."'";
mysql_query($query1);

// ADICIONA EMPRESA
$query2 = "INSERT INTO empresa (idusuario, ativo, nome, cidade, estado, telefone, fanpage, documento, imagem, apresentacao, email) VALUES ('".$row_usuario['idusuario']."', 'S', 'Sua Empresa', 'Cascavel', 'PR', '(44) 5555-5555', 'http://www.facebook.com', 'N. Documento', 'semfoto.jpg', 'Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Aenean commodo ligula eget dolor. Donec mollis hendrerit risus. Nunc nec neque. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros.
In ut quam vitae odio lacinia tincidunt. Curabitur suscipit suscipit tellus. Phasellus viverra nulla ut metus varius laoreet. Praesent adipiscing. Praesent venenatis metus at tortor pulvinar varius.
Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nulla porta dolor. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. Curabitur ullamcorper ultricies nisi. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est.
In ut quam vitae odio lacinia tincidunt. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi. Aliquam eu nunc. Morbi vestibulum volutpat enim. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus.
Ut leo. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Nunc interdum lacus sit amet orci.', '".base64_decode($_GET['token'])."')";
mysql_query($query2);

// ADICIONA SETUP
$query3 = "INSERT INTO setup (idusuario, ativo, titulo, hometitulo, homesubtitulo, cor) VALUES ('".$row_usuario['idusuario']."', 'S', 'Insira um Título para a Página', 'Insira um titulo', 'Insira um Subtitulo', 'amarelo')";
mysql_query($query3);

$query4 = "UPDATE usuario SET verificado ='0' WHERE email = '".base64_decode($_GET['token'])."'";
mysql_query($query4);
}
print "<script>window.location='http://www.midiano.com.br/corretagem/painel/cadastre-se.php?s=1&ativo=s';</script>";
?>