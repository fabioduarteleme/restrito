<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Mensagens";
$pagebtn ="Mensagem";
$tabelabd ="contatos";
$controller = "../controller/contatosController.php";

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
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-eye"></i> Enviada em <?php echo invert($row_up['data_cadastro'],"/"); ?> às <?php echo $row_up['hora_cadastro']; ?></h4>
                                        <hr>

                                        <div class="form-group">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Manter essa mensagem em aberto?</label>
                                            <select class="form-control" name="ativo">
                                                <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> Sim</option>
                                                <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não</option>
                                            </select>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                        <label>Nome</label>
                                        <input placeholder="Titulo" name="nome" type="text" class="form-control" value="<?php echo htmlentities($row_up['nome'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>E-mail</label>
                                            <input name="email" type="text" class="form-control" value="<?php echo htmlentities($row_up['email'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                            </div>  
                                            <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <label>Telefone</label>
                                            <input name="telefone" type="text" class="form-control" value="<?php echo htmlentities($row_up['telefone'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Cidade</label>
                                            <input name="cidade" type="text" class="form-control" value="<?php echo htmlentities($row_up['cidade'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                            </div>  
                                            <div class="form-group col-md-6">
                                            <label>Estado</label>
                                            <input name="estado" type="text" class="form-control" value="<?php echo htmlentities($row_up['estado'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                        <label>Assunto</label>
                                        <input name="assunto" type="text" class="form-control" value="<?php echo htmlentities($row_up['assunto'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                        </div>

                                        <div class="form-group">
                                        <label>Mensagem </label>
                                        <textarea disabled placeholder="Escreva mais detalhes" name="texto" type="text" class="form-control"/><?php echo htmlentities($row_up['texto'], ENT_COMPAT, 'utf-8'); ?></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button></a>
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
                                                <th class="tab-status text-center">NOVA?</th>
                                                <th class="tab-nome">NOME</th>
                                                <th class="tab-acoes text-center">AÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX">
                                                <td class="text-center text-tab"><?php echo $row_r['id']; ?></td>
                                                <td>
                                                  <div class="btn-ativo">
                                                    <input type="hidden" value="<?php echo $row_r['id']; ?>" />
                                                    <input type="checkbox" <?php if($row_r['ativo']=="S") { echo "checked"; } ?> id="<?php echo $row_r['id']; ?>" /><label for="<?php echo $row_r['id']; ?>"><span class="ui"></span></label>
                                                  </div>
                                                </td>
                                                <td class="text-tab"><?php echo limitar($row_r['nome'],50); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                      <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-cog"></i> Ações
                                                        <span class="caret"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="?edit=<?php echo base64_encode($row_r['id']); ?>"><i class="fa fa-eye"></i> Visualizar</a></li>
                                                        <li><a onClick="return confirm('Deseja realmente excluir?')" href="<?php echo $controller; ?>?del=<?php echo base64_encode($row_r['id']); ?>"><i class="fa fa-trash-o"></i> Deletar</a></li>
                                                      </ul>
                                                    </div>
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
                
                <!-- UPDATE ATIVO STATUS START -->  
                  <script type="text/javascript">
                        $(document).ready(function(){
                            $('.btn-ativo').click(function(){
                                var hiddenValueID = $(this).children(':hidden').val();
                                if ($(this).children(':checked').length == 0)
                                { var valueData = 'N'; } else { var valueData = 'S';}

                                $.ajax({
                                    type: "POST",
                                    url: "../controller/contatosController.php",
                                    data: {valueAtivo: valueData, id: hiddenValueID} ,
                                });
                            });
                        });
                    </script>
                <!-- UPDATE ATIVO STATUS END -->

            <?php } ?>
            </div>

<?php include("../include/_footer.php"); ?>  