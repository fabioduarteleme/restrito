<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Usuários";
$pagebtn ="Usuário";
$tabelabd ="usuario";
$controller = "../controller/usuarioController.php";

if (@$row_user['nivel'] == "1") {
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE nivel='0' ORDER BY idusuario DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
} else{
// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE email='$emailglobal' AND ativo='S' ORDER BY idusuario DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
};

// RECEIVE FOR UPDATE
$upregister = "-1"; if (isset($_GET['edit'])) { $upregister = $_GET['edit'];}
$userdecode = base64_decode($upregister);
mysql_select_db($database_db, $db);
$query_up = sprintf("SELECT * FROM $tabelabd WHERE idusuario = %s", GetSQLValueString($userdecode, "int"));
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
   
                        <!-- UPLOAD START -->
                        <?php if (@$_GET['upload'] != "") { ?>
                        <hr>
                        <form id="upload" method="post" action="usuarioFotosUpload.php?upload=<?php echo $_GET['edit']; ?>&iduser=<?php echo $row_r['idusuario']; ?>" enctype="multipart/form-data">
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
                                            <?php if (@$row_up['imagem'] != "") { ?>
                                            <div class="col-md-4 bg_blur" style="background-image:url('../img/profile/<?php echo $row_r['imagem']; ?>');"> <a href="usuarios.php?edit=<?php echo $_GET['edit']; ?>&upload=S" class="follow_btn"><i class="fa fa-photo"></i> Alterar Foto</a></div>
                                            <?php } else { ?>                   
                                            <div class="col-md-4 bg_blur" style="background-image:url('../img/profile/default.jpg')"> <a href="usuarios.php?edit=<?php echo $_GET['edit']; ?>&upload=S" class="follow_btn hidden-xs"><i class="fa fa-photo"></i> Envie sua Foto</a></div>
                                            <?php } ?>
                                            <div class="col-md-8  col-xs-12">
                                               
                                               <div class="header">
                                                    <h1><?php echo $row_up['nome']; ?></h1>
                                                    <h4>Usuário do sistema desde <?php echo invert($row_up['data_cadastro'],"/"); ?></h4>
                                                    <span><?php echo $row_up['email']; ?> </span>
                                                    
                                               </div>
                                            </div>
                                        </div> 

                                        <a href="javascript:history.back()"><button type="button" class="close">&times;</button></a>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edite este registro</h4>
                                        <hr>
                                        <div class="form-group hidden">
                                        <div class="status-ativo">
                                        <label>Este usuário está ativo?</label>
                                        <select class="form-control largura" name="ativo" disabled>
                                            <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>SIM</option>
                                            <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>NAO</option>
                                        </select>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                        <input name="nome" type="text" class="form-control" value="<?php echo htmlentities($row_up['nome'], ENT_COMPAT, 'utf-8'); ?>"/>
                                        </div>
                                        <div class="form-group">
                                        <input name="email" type="text" class="form-control" value="<?php echo htmlentities($row_up['email'], ENT_COMPAT, 'utf-8'); ?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <input name="senha" type="password" class="form-control" value="<?php echo htmlentities($row_up['senha'], ENT_COMPAT, 'utf-8'); ?>"/>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="ativo" value="<?php echo htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8'); ?>" />
                                            <input type="hidden" name="email" value="<?php echo htmlentities($row_up['email'], ENT_COMPAT, 'utf-8'); ?>" />
                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
                                            <input type="submit" class="btn btn-primary" value="Atualizar" />
                                            <input type="hidden" name="idusuario" value="<?php echo $row_up['idusuario']; ?>" />
                                            <input type="hidden" name="MM_update" value="editForm" />
                                        </div>
                                        </div>          
                                    </div>
                                </form>
                                <!-- FORM EDIT END -->
                            </div>
                        </div>
                        <?php } else { ?>

                        <?php if (@$row_user['nivel'] == "1") { ?>
						<hr>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formModal">
                            <i class="fa fa-edit"></i> Adicionar novo <?php echo $pagebtn; ?>
                        </button>
						<br /><br />
                        <?php } ?>
                        

						<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
                            

                            <form role="form" action="<?php echo $controller; ?>" method="post" data-toggle="validator" name="addForm" class="form-group" id="addForm">
                        		<div class="modal-content">
	                        		<div class="modal-header">
	                        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Insira um novo registro</h4>
									<hr>
                                    <div class="form-group">
                                    <input placeholder="Seu nome" name="nome" type="text" class="form-control" value="" required/>
                                    </div>
                                    <div class="form-group">
                                    <input placeholder="Insira seu email" name="email" type="email" class="form-control" value="" required/>
                                    </div>
                                    <div class="form-group">
                                    <input placeholder="Crie uma senha" name="senha" type="password" class="form-control" value="" required/>
                                    </div>		
									<div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <input type="submit" class="btn btn-primary"  value="Inserir" />
                                        <input type="hidden" name="ativo" value="S" />
                                        <input type="hidden" name="nivel" value="0" />
                                        <input type="hidden" name="MM_insert" value="addForm" />
                                    </div>
                                    </div>			
                                </div>
                            </form>                    
						  </div>
						</div>
                        
                    </div>
                </div>

               <!-- LIST ALL START -->
               <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php if (@$row_r['idusuario'] > 0) { ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="tab-id text-center">ID</th>
                                                <th class="tab-status text-center">ATIVO</th>
                                                <th class="tab-nome">NOME</th>
                                                <th class="tab-acoes text-center">AÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX">
                                                <td class="text-center text-tab"><?php echo $row_r['idusuario']; ?></td>
                                                <td>
                                                  <div class="btn-ativo">
                                                    <input type="hidden" value="<?php echo $row_r['idusuario']; ?>" />
                                                    <input type="checkbox" <?php if($row_r['ativo']=="S") { echo "checked"; } ?> id="<?php echo $row_r['idusuario']; ?>" /><label for="<?php echo $row_r['idusuario']; ?>"><span class="ui"></span></label>
                                                  </div>
                                                </td>
                                                <td class="text-tab"><?php echo limitar($row_r['nome'],50); ?></td>
                                                <td>
                                                    <?php if (@$row_user['nivel'] == "1") { ?>
                                                    <div class="dropdown">
                                                      <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-cog"></i> Ações
                                                        <span class="caret"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="?edit=<?php echo base64_encode($row_r['idusuario']); ?>"><i class="fa fa-edit"></i> Editar</a></li>
                                                        <li><a onClick="return confirm('Deseja realmente excluir?')" href="<?php echo $controller; ?>?del=<?php echo base64_encode($row_r['idusuario']); ?>"><i class="fa fa-trash-o"></i> Deletar</a></li>
                                                      </ul>
                                                    </div>
                                                    <?php } else { ?>
                                                    <a href="?edit=<?php echo base64_encode($row_r['idusuario']); ?>"><button type="button" class="btn btn-primary btn-sm minibtn btn-block"><i class="fa fa-pencil"></i> <span class="textobtn">Editar</span></button></a>
                                                    <?php } ?>
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

            <!-- UPDATE ATIVO STATUS START -->  
                  <script type="text/javascript">
                        $(document).ready(function(){
                            $('.btn-ativo').click(function(){
                                var hiddenValueID = $(this).children(':hidden').val();
                                if ($(this).children(':checked').length == 0)
                                { var valueData = 'N'; } else { var valueData = 'S';}

                                $.ajax({
                                    type: "POST",
                                    url: "../controller/usuarioController.php",
                                    data: {valueAtivo: valueData, id: hiddenValueID} ,
                                });
                            });
                        });
                    </script>
                <!-- UPDATE ATIVO STATUS END -->

<?php include("../include/_footer.php"); ?>  