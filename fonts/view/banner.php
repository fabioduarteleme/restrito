<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Banners";
$pagebtn ="Banner";
$tabelabd ="banner";
$controller = "../controller/bannerController.php";

// INFO IMAGE RESIZE
$largura ="1300";
$altura ="600";

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

                        <?php if (@$_GET['upload'] != "") { ?>
                        <!-- UPLOAD START -->
                        <hr>
                        <form id="upload" method="post" action="bannerFotosUpload.php?upload=<?php echo $_GET['upload']; ?>&iduser=<?php echo $_GET['iduser']; ?>&&w=<?php echo $largura; ?>&h=<?php echo $altura; ?>" enctype="multipart/form-data">
                            <div id="drop">
                            Arraste para cá a imagem ou<br>
                            <a class="btn"><i class="fa fa-photo"></i> Procure</a>
                            <input type="file" name="upl" />
                            </div>
                            <ul class="listagem">
                            </ul>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function() {
                            jQuery.ajax({method:"GET",
                            cache: false,
                            url:"bannerFotos.php?iduser=<?php echo $_GET['iduser']; ?>&upload=<?php echo $_GET['upload']; ?>",
                            beforeSend:function(){
                                $(".carregando").show()
                            },
                            complete:function(){
                                $(".carregando").hide()
                            },
                            success:function(html){
                                $("#listafotos").html(html).show("slow")
                            }
                        })
                            return false
                        }); 
                        </script>

                        <h3 class="page-header"><i class="fa fa-file-image-o"></i> Fotos cadastradas</h3><hr>
                        <a href="javascript:history.back()"><div id="btn-volta" class="btn btn-default"><i class="fa fa-chevron-circle-left"></i> Voltar</div></a>
                        <div id="listafotos">
                        </div>

                        <!-- UPLOAD END -->
                        <?php } else { ?>

						<?php if (@$_GET['edit'] != "") { ?>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">

                                <!-- FORM EDIT START -->
                                <form role="form" action="<?php echo $controller; ?>" method="post" data-toggle="validator" class="form-group" name="editForm" id="editForm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <a href="javascript:history.back()"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></a>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edite este registro</h4>
                                        <hr>

                                        <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Ativo no site?</label>
                                            <select class="form-control" name="ativo">
                                                <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> Sim</option>
                                                <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Categoria</label>
                                            <select class="form-control" name="categoria">
                                                <option value="bannerinferior" <?php if (!(strcmp("bannerinferior", htmlentities($row_up['categoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> Banner Inferior</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="form-group">
                                        <label>Título</label>
                                        <input placeholder="Titulo" name="titulo" type="text" class="form-control" value="<?php echo htmlentities($row_up['titulo'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Descrição</label>
                                            <input name="descricao" type="text" class="form-control" value="<?php echo htmlentities($row_up['descricao'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>  
                                            <div class="form-group col-md-6">
                                            <label>Link</label>
                                            <input name="link" type="text" class="form-control" value="<?php echo htmlentities($row_up['link'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>
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

						<hr>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formModal">
                            <i class="fa fa-edit"></i> Adicionar novo <?php echo $pagebtn; ?>
                        </button>
						<br /><br />

						<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            
                                <form role="form" action="<?php echo $controller; ?>" method="post" data-toggle="validator" name="addForm" class="form-group" id="addForm">
                            		<div class="modal-content">
    	                        		<div class="modal-header">
    	                        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Insira um novo registro</h4>
    									<hr>
                                        
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Categoria</label>
                                            <select class="form-control" name="categoria" required>
                                                <option value="" selected>Selecione</option>
                                                <option value="bannerinferior">Banner Inferior</option>
                                            </select>
                                            </div>
                                        </div>
                                       
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <input placeholder="Titulo" name="titulo" type="text" class="form-control" value="" required/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <input placeholder="Breve Descrição" name="descricao" type="text" class="form-control" value="" required/>
                                            </div> 
                                        
                                            <div class="form-group col-md-6">
                                            <input placeholder="URL Link" name="link" type="text" class="form-control" value="" />
                                            </div>
                                        </div> 
                                        
    									<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <input type="submit" class="btn btn-primary"  value="Inserir" />
                                            <input type="hidden" name="ativo" value="N" />
                                            <input type="hidden" name="idusuario" value="<?php echo $row_user["idusuario"] ?>" />
                                            <input type="hidden" name="dataCadastro" value="<?php echo date("Y-m-d"); ?>" />
                                            <input type="hidden" name="MM_insert" value="addForm" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- BTN AJAX UPDATE STATUS START -->


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
                                                <th class="tab-status text-center">ATIVO</th>
                                                <th class="tab-nome text-center">IMAGEM</th>
                                                <th class="tab-nome">NOME</th>
                                                <th class="tab-acoes text-center">AÇÕES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX <?php if (@$_GET['idpost'] == $row_r['id']) { ?> div-atencao <?php } ?>">
                                                <td class="text-center text-tab"><?php echo $row_r['id']; ?></td>
                                                <td>
                                                  <div class="btn-ativo">
                                                    <input type="hidden" value="<?php echo $row_r['id']; ?>" />
                                                    <input type="checkbox" <?php if($row_r['ativo']=="S") { echo "checked"; } ?> id="<?php echo $row_r['id']; ?>" /><label for="<?php echo $row_r['id']; ?>"><span class="ui"></span></label>
                                                  </div>
                                                </td>
                                                <?php if (@$row_r['imagem'] != "") { ?>
                                                <td class="text-tab text-center"><a class="fancybox" href="../img/banner/<?php echo $row_r['imagem']; ?>"><div class="imagem-tab" style="background-image:url('../img/banner/<?php echo $row_r['imagem']; ?>')"></div></a></td>
                                                <?php } else { ?>
                                                <td class="text-tab text-center"><a href="?upload=<?php echo base64_encode($row_r['id']); ?>&iduser=<?php echo base64_encode($row_user["idusuario"]); ?>"><div class="imagem-tab"><i class="fa fa-ban"></i> Sem imagem</div></a></td>
                                                <?php } ?>
                                                <td class="text-tab"><?php echo limitar($row_r['titulo'],50); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                      <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-cog"></i> Ações
                                                        <span class="caret"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="?upload=<?php echo base64_encode($row_r['id']); ?>&iduser=<?php echo base64_encode($row_user["idusuario"]); ?>"><i class="fa fa-picture-o"></i> Enviar Imagem</a></li>
                                                        <li><a href="?edit=<?php echo base64_encode($row_r['id']); ?>"><i class="fa fa-edit"></i> Editar</a></li>
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
                                    url: "../controller/bannerController.php",
                                    data: {valueAtivo: valueData, id: hiddenValueID} ,
                                });
                            });
                        });
                    </script>
                <!-- UPDATE ATIVO STATUS END -->

            <?php } ?>
            <?php } ?>
            </div>

<?php include("../include/_footer.php"); ?>  