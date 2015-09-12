<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

//if (@$user['nivel'] != "1") {
//header('location:painelprincipal.php');
//}

// INFO PAGE
$pagetitle ="as configurações de seu Site";
$tabelabd ="setup";
$controller = "../controller/setupController.php";

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE idusuario='".$row_user["idusuario"]."' ORDER BY id DESC";
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
                        <form id="upload" method="post" action="setup<?php echo $_GET['tipo']; ?>Upload.php?upload=<?php echo $_GET['edit']; ?>&iduser=<?php echo $row_r['idusuario']; ?>" enctype="multipart/form-data">
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

                                        

                                        <a href="javascript:history.back()"><button type="button" class="close">&times;</button></a>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edite este registro</h4>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="coluna">
                                                <label><i class="fa fa-tag"></i> Quer seu site ativo?</label>
                                                <select class="form-control" name="ativo">
                                                    <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> Sim</option>
                                                    <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não</option>
                                                </select>
                                                </div>
                                            </div>

                                            
                                            <div class="hr-special">
                                            <h3 class="text-center"><label> <i class="fa fa-wrench"></i> Configurações do navegador</label></h3><hr>
                                            </div>
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Titulo da Barra do Navegador</label>
                                            <input name="titulo" type="text" class="form-control" value="<?php echo htmlentities($row_up['titulo'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>
                                            

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Keywords (Palavras-chave)</label>
                                            <input name="keyword" type="text" class="form-control" value="<?php echo htmlentities($row_up['keyword'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Descrição</label>
                                            <textarea name="descricao" type="text" class="form-control"/><?php echo htmlentities($row_up['descricao'], ENT_COMPAT, 'utf-8'); ?></textarea>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Enviar Favicon</label><br>
                                            <a target="_blank" href="http://www.favicon.cc/"><div class="btn btn-default"> <i class="fa fa-photo"></i> Criar Favicon</div></a>
                                            <a href="setup.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=favicon"><div class="btn btn-default"> <i class="fa fa-photo"></i> Procurar Favicon</div></a> 
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Imagem para compartilhamento</label><br>
                                            <?php if (@$row_up['imagem'] != "") { ?>
                                            <a href="../img/setup/<?php echo htmlentities($row_up['imagem'], ENT_COMPAT, 'utf-8'); ?>" class="fancybox"><img style="width: 50px; margin-left:0px; margin-right:20px;" src="../img/setup/<?php echo htmlentities($row_up['imagem'], ENT_COMPAT, 'utf-8'); ?>"></a>
                                            <a href="setup.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=imagem"><div class="btn btn-default"> <i class="fa fa-photo"></i> Alterar Imagem</div></a> 
                                            </div>

                                            <?php } else { ?>
                                            <label></label>
                                            <a href="setup.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=imagem"><div class="btn btn-default"> <i class="fa fa-photo"></i> Procurar imagem</div></a> 
                                            </div>
                                            <?php } ?>
                                            


                                            <div class="hr-special">
                                            <h3 class="text-center"><label> <i class="fa fa-cog"></i> Configurações na Página Garota Country</label></h3><hr>
                                            
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Votação</label>
                                                <select class="form-control" name="eleicaovotacao">
                                                    <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['eleicaovotacao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Liberada</option>
                                                    <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['eleicaovotacao'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Bloqueada</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Vencedor</label>
                                                <select class="form-control" name="eleicaovencedor">
                                                    <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['eleicaovencedor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não mostrar</option>
                                                    <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['eleicaovencedor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Mostrar</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Imagem de Fundo</label><br>
                                            <?php if (@$row_up['eleicaobackground'] != "") { ?>
                                            <a href="../img/setup/<?php echo htmlentities($row_up['eleicaobackground'], ENT_COMPAT, 'utf-8'); ?>" class="fancybox"><img style="width: 50px; margin-left:0px; margin-right:20px;" src="../img/setup/<?php echo htmlentities($row_up['eleicaobackground'], ENT_COMPAT, 'utf-8'); ?>"></a>
                                            <a href="setup.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=background"><div class="btn btn-default"> <i class="fa fa-photo"></i> Alterar Imagem</div></a> 
                                            </div>

                                            <?php } else { ?>
                                            <label></label>
                                            <a href="setup.php?edit=<?php echo $_GET['edit']; ?>&upload=S&tipo=background"><div class="btn btn-default"> <i class="fa fa-photo"></i> Procurar imagem</div></a> 
                                            </div>
                                            <?php } ?>
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