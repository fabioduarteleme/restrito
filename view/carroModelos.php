<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Modelos";
$pagebtn ="Modelos";
$tabelabd ="carro_modelo";
$controller = "../controller/carrosModeloController.php";

// INFO IMAGE RESIZE
$largura ="800";
$altura ="600";

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd ORDER BY nome ASC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);


// RECEIVE DATA FABRICANTE
mysql_select_db($database_db, $db);
$query_marca = "SELECT * FROM carro_fabricante WHERE tipo = 'carro' AND ativo='S' ORDER BY nome ASC";
$marca = mysql_query($query_marca, $db) or die(mysql_error());
$row_marca = mysql_fetch_assoc($marca);
$totalRows_marca = mysql_num_rows($marca);


// RECEIVE DATA MODELOS
mysql_select_db($database_db, $db);
$query_modelo = "SELECT * FROM carro_modelo WHERE tipo = 'carro' ORDER BY nome ASC";
$modelo = mysql_query($query_modelo, $db) or die(mysql_error());
$row_modelo = mysql_fetch_assoc($modelo);
$totalRows_modelo = mysql_num_rows($modelo);


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
                        <form id="upload" method="post" action="../controller/uploadController.php?upload=<?php echo $_GET['upload']; ?>&iduser=<?php echo $_GET['iduser']; ?>&tipo=<?php echo $tabelabd; ?>&w=<?php echo $largura; ?>&h=<?php echo $altura; ?>" enctype="multipart/form-data">
                            <div id="drop">
                            Arraste para cá as fotos<br>
                            <a class="btn"><i class="fa fa-photo"></i> Procurar fotos</a>
                            <input type="file" name="upl" multiple />
                            </div>
                            <ul class="listagem">
                            </ul>
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function() {
                            jQuery.ajax({method:"GET",
                            cache: false,
                            url:"ajaxFotos.php?iduser=<?php echo $_GET['iduser']; ?>&upload=<?php echo $_GET['upload']; ?>",
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
                                            <div class="form-group col-md-12">
                                            <input placeholder="Nome" name="nome" type="text" class="form-control" value="<?php echo htmlentities($row_up['nome'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>
                                        </div>
                                
                                        <div class="modal-footer">
                                            <a href="javascript:history.back()"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button></a>
                                            <input type="submit" class="btn btn-primary"  value="Atualizar" />
                                            <input type="hidden" class="btn btn-primary" name="id"  value="<?php echo htmlentities($row_up['id'], ENT_COMPAT, 'utf-8'); ?>" />
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
                                    
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <input placeholder="Nome" name="nome" type="text" class="form-control" value="" required/>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="coluna">
                                                <label><i class="fa fa-home"></i> Modelo</label>
                                                <select class="form-control" name="fabricante" required>
                                                    <option value="" selected>Selecione um Modelo</option>
                                                    <?php do { ?>
                                                    <option value="<?php echo $row_marca['id']; ?>"><?php echo $row_marca['nome']; ?></option>
                                                    <?php } while ($row_marca = mysql_fetch_assoc($marca)); ?>
                                                </select>
                                                </div>
                                            </div>
                                        </div>

    									<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <input type="submit" class="btn btn-primary"  value="Inserir" />
                                            <?php $ultimoadd = $totalRows_modelo + 1;?>
                                            <input type="hidden" name="id" value="99<?php echo $ultimoadd; ?>" />
                                            <input type="hidden" name="ativo" value="S" />
                                            <input type="hidden" name="tipo" value="carro" />
                                            <input type="hidden" name="MM_insert" value="addForm" />
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
                                            <tr class="odd gradeX <?php if (@$_GET['idpost'] == $row_r['id']) { ?> div-atencao <?php } ?>">
                                                <td class="text-center text-tab"><?php echo limitar($row_r['id'],4); ?></td>
                                                <td class="text-tab"><?php echo limitar($row_r['nome'],50); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                      <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-cog"></i> Ações
                                                        <span class="caret"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
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
                                    url: "../controller/carrosMarcaController.php",
                                    data: {valueAtivo: valueData, id: hiddenValueID} ,
                                });
                            });
                        });
                    </script>
                <!-- UPDATE ATIVO STATUS END -->

                    
                <!-- LISTA MODELOS DE CARRO START -->   
                    <script type="text/javascript">
                      $(function(){
                      $('#idmarca').change(function(){
                        $.ajaxSetup({timeout: 9000});
                        if( $(this).val() ) {
                          $('#idmodelo').hide();
                          $('.carregando').show();
                          $.getJSON('ajaxCarroModelos.php?search=',{idmarca: $(this).val(), ajax: 'true'}, function(j){
                            var options = '<option value="">Selecione</option>'; 
                            for (var i = 0; i < j.length; i++) {
                              options += '<option value="' + j[i].idmodelo + '">' + j[i].nome + '</option>';
                            } 
                            $('#idmodelo').html(options).show();
                            $('.carregando').hide();
                          });
                        } else {
                          $('#idmodelo').html('<option value="">Selecione</option>');
                        }
                      });
                    });
                    </script>
                    <!-- LISTA MODELOS DE CARRO END -->

            <?php } ?>
            <?php } ?>
            </div>

<?php include("../include/_footer.php"); ?>  