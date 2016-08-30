# Painel de administração de website
Este é um projeto pessoal simples aonde é possivel integrar um painel escrito em PHP5 à um website HTML. O painel possui CRUD e uma "mini" API para leitura dos registros via Json.

## Como se conectar:
Insira este trecho de código no head de seu site.
```PHP
<?php
$user= "1";
$urlsite= "http://localhost/site";
$urlcms= "restrito";

include($urlcms."/Connections/db.php");
include($urlcms."/classes/function.php");
$menuativo = basename($_SERVER['SCRIPT_NAME']);

mysql_select_db($database_db, $db);
$query_setup = "SELECT * FROM setup WHERE idusuario='$user' ORDER BY id";
$setup = mysql_query($query_setup, $db) or die(mysql_error());
$row_setup = mysql_fetch_assoc($setup);
$totalRows_setup = mysql_num_rows($setup)
?>
```
## Tags para Head
Tags especiais que recebem dados do painel de controle
```PHP
<title><?php echo $row_setup['titulo']; ?></title>

<!-- FAVICON -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">

<!-- KEYWORDS -->
<meta name="description" content="<?php echo $row_setup['descricao']; ?>" />
<meta name="keywords" content="<?php echo $row_setup['keyword']; ?>" />
<meta name="author" content="ASB COmunicação">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<meta http-equiv="content-language" content="pt">
<meta name="author" CONTENT="Fabio Duarte Leme, Midiano">
<meta name="robots" content="index, follow">

<!-- FACEBOOK META -->
<meta property="og:title" content="<?php echo $row_setup['titulo']; ?>"/>
<meta property="og:image" content="<?php echo $urlsite ?>/restrito/img/setup/<?php echo $row_setup['imagem']; ?>"/>
<meta property="og:site_name" content="Fabio Duarte Leme"/>
<meta property="og:description" content="<?php echo $row_setup['descricao']; ?>"/>
```
## Banner
Recebe dados dos banners cadastrados no painel
```PHP
mysql_select_db($database_db, $db);
$query_banner = "SELECT * FROM banner WHERE idusuario='$user' AND ativo='S' ORDER BY id DESC";
$banner = mysql_query($query_banner, $db) or die(mysql_error());
$row_banner = mysql_fetch_assoc($banner);
$totalRows_banner = mysql_num_rows($banner);

<!-- PUXAR BANNER -->
<?php echo $urlsite ?>/<?php echo $urlcms ?>/img/banner/<?php echo $row_banner['imagem']; ?>

<!-- CROPAR IMAGEM -->
<img src="<?php echo $urlsite ?>/<?php echo $urlcms ?>/classes/resize.php?src=/restrito/img/paginas/<?php echo $row_depoimentoEmpresa['imagem']; ?>&h=90&w=90&zc=1&q=100&s=0">
```
## Menu com classe .active
```PHP
<?php if ($menuativo  == "pagina.php") { ?> class="active" <?php }  ?>
```
## Formulário de contato
```PHP
<form method="post" action="<?php echo $urlcms ?>/controller/contatosController.php" id="contact-form">
<input type="hidden" name="ativo" value="S" />
<input type="hidden" name="idusuario" value="1" />
<input type="hidden" name="estado" value="PR" />
<input type="hidden" name="cidade" value="Cianorte" />
<input type="hidden" name="data_cadastro" value="<?php echo date("Y-m-d") ?>" />
<input type="hidden" name="hora_cadastro" value="<?php echo date("H:i:s") ?>" />
<input type="hidden" name="MM_insert" value="addForm" />
```
## Retorno do formulário de contato
```PHP
<?php if (@$_GET['s'] == "1") { ?>
<div class="notification"> <i class="fa fa-envelope"></i> Seu contato foi enviado com Sucesso!</div>
<?php } ?>
```
## Lista as Notícias
```PHP
mysql_select_db($database_db, $db);
$query_noticias = "SELECT * FROM paginas WHERE idusuario='$user' AND tipo='noticia' ORDER BY id DESC LIMIT 3";
$noticias = mysql_query($query_noticias, $db) or die(mysql_error());
$row_noticias = mysql_fetch_assoc($noticias);
$totalRows_noticias = mysql_num_rows($noticias); ?>
```
## Help das Notícias
```PHP
<?php echo limitar($row_noticias['texto01'],"100"); ?>
<img src="<?php echo $urlsite ?>/<?php echo $urlcms ?>/classes/resize.php?src=/restrito/img/paginas/<?php echo $row_noticias['imagem']; ?>&h=368&w=369&zc=1&q=100&s=0" alt="<?php echo $row_noticias['titulo']; ?>">
```

##Enjoy
Lembre-se de alterar os dados de conexão do arquivo db.php e dados de recebimento de emails do cliente.
