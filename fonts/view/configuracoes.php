<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

//if (@$user['nivel'] != "1") {
//header('location:painelprincipal.php');
//}

// INFO PAGE
$pagetitle ="Painel de Controle";
$tabelabd ="config";
$controller = "../controller/configController.php";

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd ORDER BY id DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);

// RECEIVE FOR UPDATE
$upregister = "-1"; if (isset($_GET['edit'])) { $upregister = $_GET['edit'];}
$userdecode = base64_decode($upregister);
mysql_select_db($database_db, $db);
$query_up = sprintf("SELECT * FROM $tabelabd WHERE id = %s", GetSQLValueString($userdecode, "int"));
$up = mysql_query($query_up, $db) or die(mysql_error());
$row_up = mysql_fetch_assoc($up);
$totalRows_up = mysql_num_rows($up);           

?>

<?php include("../include/_head.php"); ?>

            <div id="page-wrapper">
                <br>
                <?php if (@$_GET['s'] > 0) { ?>
                <div id="msg-sucesso" class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check-square-o"></i> Efetuado com sucesso!
                </div>
                <?php } ?>


                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">
                            Administrar <?php echo $pagetitle; ?>
                        </h3>		
   
                        <!-- UPLOAD START -->
                        <?php if (@$_GET['upload'] != "") { ?>
                        <hr>
                        <form id="upload" method="post" action="config<?php echo $_GET['tipo']; ?>Upload.php?upload=<?php echo $_GET['edit']; ?>&iduser=<?php echo $row_r['idusuario']; ?>" enctype="multipart/form-data">
                            <div id="drop">
                            <a class="btn"><i class="fa fa-photo"></i> Procurar Foto</a>
                            <input type="file" name="upl" />
                            </div>
                            <ul class="listagem">
                            </ul>
                        </form>
                        <?php } ?>
                        <!-- UPLOAD END -->


						<?php if (@$_GET['edit'] != "") { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">


                                <!-- FORM EDIT START -->
                                <form role="form" action="<?php echo $controller; ?>" method="post" name="editForm" id="editForm">
                                    <div class="modal-content">
                                        <div class="modal-header">  

                                        <div class="row profile">
                                            <?php if (@$row_up['background'] != "") { ?>
                                            <div class="col-md-4 bg_blur adminpanel" style="background-image:url('../img/config/<?php echo $row_r['background']; ?>');"> <a href="configuracoes.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=bg" class="follow_btn"><i class="fa fa-photo"></i> Background</a></div>
                                            <?php } else { ?>                   
                                            <div class="col-md-4 bg_blur adminpanel" style="background-image:url('../img/config/bg-default.jpg')"> <a href="configuracoes.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=bg" class="follow_btn hidden-xs"><i class="fa fa-photo"></i> Envie sua Foto</a></div>
                                            <?php } ?>
                                            <div class="col-md-8  col-xs-12">
                                               
                                               <div class="header">
                                                    <?php if (@$row_up['logo'] != "") { ?>
                                                    <a href="configuracoes.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=logo"><div class="logomarca"><img src="../img/config/logo/<?php echo $row_r['logo']; ?>"></div></a>
                                                    <?php } else { ?>
                                                    <a href="configuracoes.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=logo"><div class="logomarca text-center"><img src="../img/config/logo/logo-default.png"></div></a>
                                                    <?php } ?>
                                                    <h1><?php echo $row_up['titulo']; ?></h1>
                                               </div>
                                            </div>
                                        </div> 

                                        <a href="javascript:history.back()"><button type="button" class="close">&times;</button></a>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edite este registro</h4>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Titulo do Painel</label>
                                            <input name="titulo" type="text" class="form-control" value="<?php echo htmlentities($row_up['titulo'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Termos de uso</label>
                                            <textarea name="termos" type="text" class="form-control"/><?php echo htmlentities($row_up['termos'], ENT_COMPAT, 'utf-8'); ?></textarea>
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Enviar Favicon</label><br>
                                            <a target="_blank" href="http://www.favicon.cc/"><div class="btn btn-default"> <i class="fa fa-photo"></i> Criar Favicon</div></a>
                                            <a href="configuracoes.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=favicon"><div class="btn btn-default"> <i class="fa fa-photo"></i> Procurar Favicon</div></a> 
                                            </div>

                                            <!--
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Cor Barra de Menu</label>
                                                <div class="input-group colorpick">
                                                    <input type="text" value="" ng-model="bgcolornav" class="form-control" />
                                                    <span class="input-group-addon"><i></i></span>
                                                </div>
                                            </div>
                                            inserir ng-style="{background: bgcolornav}"
                                            -->
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
                                            <input type="submit" class="btn btn-primary" value="Salvar" />
                                            <input type="hidden" name="id" value="<?php echo $row_up['id']; ?>" />
                                            <input type="hidden" name="MM_update" value="editForm" />
                                        </div>
                                        </div>          
                                    </div>
                                </form>
                                <!-- FORM EDIT END -->
                            </div>
                        </div>
                        <?php } else { ?>

                        
                    </div>
                </div>

               <!-- LIST ALL START -->
               <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php if (@$row_r['id'] > 0) { ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="tab-id text-center">ID</th>
                                                <th class="tab-nome">NOME</th>
                                                <th class="tab-acoes text-center">AÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX">
                                                <td class="text-center text-tab"><?php echo $row_r['id']; ?></td>
                                                <td class="text-tab"><?php echo limitar($row_r['titulo'],50); ?></td>
                                                <td>
                                                    <a href="?edit=<?php echo base64_encode($row_r['id']); ?>"><button type="button" class="btn btn-primary btn-sm minibtn btn-block"><i class="fa fa-pencil"></i> <span class="textobtn">Editar</span></button></a>
                                                </td>
                                            </tr>
                                            <?php } while ($row_r = mysql_fetch_assoc($r)); ?>
                                        </tbody>
                                    </table>
                                    <?php } else { ?>
                                     <div class="vazio"><i class="fa fa-warning"></i> Nenhum registro foi encontrado</div>
                                    <?php } ?>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <!-- LIST ALL END -->
            </div>

<?php include("../include/_footer.php"); ?>  