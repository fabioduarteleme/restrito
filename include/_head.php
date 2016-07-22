<!DOCTYPE html>
<html>
<head>
    <title><?php echo $row_admin["titulo"]; ?></title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <link rel="author" href="http://midiano.com.br" />
    <meta name="robots" content="noindex">
    <link href="../img/config/favicon/<?php echo $row_admin["favicon"]; ?>" rel="icon" type="image/x-icon" />
    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.css" rel="stylesheet" />
    <!--
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet" />
    -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!-- Page-Level Plugin CSS - Blank -->
    <!-- Mint Admin CSS - Include with every page -->
    <link href="../css/mint-admin.css" rel="stylesheet" />
    <link href="../css/admin.css" rel="stylesheet" />
    <link href="../css/plugins/animate.css" rel="stylesheet" />
    <link href="../css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="../css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../js/plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <link href="../js/plugins/intro/introjs.css" rel="stylesheet" />
    <!-- TEXT EDITOR -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.0.2/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../js/froala/css/froala_editor.css">
    <link rel="stylesheet" href="../js/froala/css/froala_style.css">
    <link rel="stylesheet" href="../js/froala/css/plugins/table.css">


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Core Scripts - Include with every page -->
    <script src="../js/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <!-- FAST CLICK
    <script type="application/javascript" src="../js/fastclick.js"></script> 
    <script type="application/javascript">
        window.addEventListener('load', function() {
            var textInput = document.querySelector('input');

            FastClick.attach(document.body);
            Array.prototype.forEach.call(document.getElementsByClassName('test'), function(testEl) {
                testEl.addEventListener('click', function() {
                    textInput.focus();
                }, false)
            });
        }, false);
    </script> -->

    
</head>

    <body ng-app>
        <div id="wrapper">
        <?php include("../include/_navheader.php"); ?> 
        <?php include("../include/_navside.php"); ?>