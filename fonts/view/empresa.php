<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Empresa";
$pagebtn ="Empresa";
$tabelabd ="empresa";
$controller = "../controller/empresaController.php";

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE idusuario='".$row_user["idusuario"]."' ORDER BY id DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);

// RECEIVE FOR UPDATE
$upregister = "-1"; if (isset($_GET['edit'])) { $upregister = $_GET['edit'];}
$editdecode = base64_decode($upregister);
mysql_select_db($database_db, $db);
$query_up = sprintf("SELECT * FROM $tabelabd WHERE id = %s", GetSQLValueString($editdecode, "int"));
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
                        <h3 class="page-header">Administrar <?php echo $pagetitle; ?></h3>

						<?php if (@$_GET['edit'] != "") { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">

                                <!-- FORM EDIT START -->
                                <form role="form" action="<?php echo $controller; ?>" method="post" data-toggle="validator" class="form-group" name="editForm" id="editForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <a href="javascript:history.back()"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></a>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edite as informações de seu site</h4>
                                        <hr>

                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                            <label>Nome</label>
                                            <input name="nome" type="text" class="form-control" value="<?php echo htmlentities($row_up['nome'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>

                                            <div class="form-group col-md-4 col-sm-6 col-xs-6">
                                            <label>CNPJ</label>
                                            <input name="cnpj" type="text" class="form-control" value="<?php echo htmlentities($row_up['cnpj'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>

                                            <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                            <label>Email</label>
                                            <input name="email" type="text" class="form-control" value="<?php echo htmlentities($row_up['email'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Telefone</label>
                                            <input name="telefone" type="text" class="form-control" value="<?php echo htmlentities($row_up['telefone'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>  
                                            <div class="form-group col-md-6">
                                            <label>Celular</label>
                                            <input name="celular" type="text" class="form-control" value="<?php echo htmlentities($row_up['celular'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <label>Endereço</label>
                                            <input name="endereco" type="text" class="form-control" value="<?php echo htmlentities($row_up['endereco'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>  
                                        </div>
                                        
                                        <div class="row">
                                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <div class="">
                                                <label>Cidade</label>
                                                <input name="cidade" type="text" class="form-control" value="<?php echo htmlentities($row_up['cidade'], ENT_COMPAT, 'utf-8'); ?>"/>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                <div class="">
                                                <label>Estado</label>
                                                <input name="estado" type="text" class="form-control" value="<?php echo htmlentities($row_up['estado'], ENT_COMPAT, 'utf-8'); ?>"/>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Site</label>
                                            <input name="site" type="text" class="form-control" value="<?php echo htmlentities($row_up['site'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>  
                                            <div class="form-group col-md-6">
                                            <label>Fanpage</label>
                                            <input name="fanpage" type="text" class="form-control" value="<?php echo htmlentities($row_up['fanpage'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <label>Mapa</label>
                                            <input name="mapa" type="text" class="form-control" value="<?php echo htmlentities($row_up['mapa'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>  
                                        </div>
                                        
                                        <div class="form-group">
                                        <label>Escreva uma pequena apreseentação de sua empresa</label>
                                        <textarea name="apresentacao" type="text" class="form-control"/><?php echo htmlentities($row_up['apresentacao'], ENT_COMPAT, 'utf-8'); ?></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
                                            <input type="submit" class="btn btn-primary"  value="Atualizar" />
                                            <input type="hidden" class="btn btn-primary" name="id"  value="<?php echo $row_up['id']; ?>" />
                                            <input type="hidden" name="MM_update" value="editForm" />
                                        </div>
                                        </div>          
                                    </div>
                                </form>

                                <!-- FORM EDIT END -->
                            </div>
                        </div>
                        <?php } else { ?>

						


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
                                                <td class="text-tab"><?php echo limitar($row_r['nome'],50); ?></td>
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
                <!-- LIST ALL END -->

            <?php } ?>
            </div>

<?php include("../include/_footer.php"); ?>  