<?php
require_once('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');

// INFO PAGE
$pagetitle ="Automóveis";
$pagebtn ="Auto";
$tabelabd ="carro";
$controller = "../controller/carrosController.php";

// INFO IMAGE RESIZE
$largura ="800";
$altura ="600";

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE idusuario='".$row_user["idusuario"]."' ORDER BY id DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);


// RECEIVE DATA FABRICANTE
mysql_select_db($database_db, $db);
$query_marca = "SELECT * FROM carro_fabricante WHERE tipo = 'carro' ORDER BY nome ASC";
$marca = mysql_query($query_marca, $db) or die(mysql_error());
$row_marca = mysql_fetch_assoc($marca);
$totalRows_marca = mysql_num_rows($marca);


if (isset($_GET['edit'])){
// RECEIVE DATA MODELOS
mysql_select_db($database_db, $db);
$query_modelo = "SELECT * FROM carro_modelo WHERE tipo = 'carro' ORDER BY nome ASC";
$modelo = mysql_query($query_modelo, $db) or die(mysql_error());
$row_modelo = mysql_fetch_assoc($modelo);
$totalRows_modelo = mysql_num_rows($modelo);}


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
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Quer este Carro aparecendo no site?</label>
                                            <select class="form-control" name="ativo">
                                                <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>> Sim</option>
                                                <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['ativo'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <div class="coluna">
                                            <label><i class="fa fa-star"></i> Em Destaque?</label>
                                            <select class="form-control" name="destaque">
                                                <option value="N" <?php if (!(strcmp("N", htmlentities($row_up['destaque'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Não</option>
                                                <option value="S" <?php if (!(strcmp("S", htmlentities($row_up['destaque'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Sim</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">
                                        <div class="form-group col-md-4 col-sm-4 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Marca</label>
                                            <select class="form-control" name="idmarca" required>
                                                <option value="<?php echo $row_up['idmarca']; ?>" selected><?php echo $row_up['idmarca']; ?></option>
                                                <?php do { ?>
                                                <option value="<?php echo $row_marca['id']; ?>"><?php echo $row_marca['nome']; ?></option>
                                                <?php } while ($row_marca = mysql_fetch_assoc($marca)); ?>
                                            </select>
                                            </div>
                                        </div>
                                         
                                         <div class="form-group col-md-4 col-sm-4 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-home"></i> Modelo</label>
                                            <select class="form-control" name="idmodelo" required>
                                                <option value="<?php echo $row_up['idmodelo']; ?>" selected><?php echo $row_up['idmodelo']; ?></option>
                                                <?php do { ?>
                                                <option value="<?php echo $row_modelo['id']; ?>"><?php echo $row_modelo['nome']; ?></option>
                                                <?php } while ($row_modelo = mysql_fetch_assoc($modelo)); ?>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                            <div class="coluna">
                                            <label><i class="fa fa-star"></i> Ano de Fabricação</label>
                                            <select class="form-control" name="ano">
                                                <option value="<?php echo $row_up['ano']; ?>" selected><?php echo $row_up['ano']; ?></option>
                                                <option value="2015">2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                                <option value="2012">2012</option>
                                                <option value="2011">2011</option>
                                                <option value="2010">2010</option>
                                                <option value="2009">2009</option>
                                                <option value="2008">2008</option>
                                                <option value="2007">2007</option>
                                                <option value="2006">2006</option>
                                                <option value="2005">2005</option>
                                                <option value="2004">2004</option>
                                                <option value="2003">2003</option>
                                                <option value="2002">2002</option>
                                                <option value="2001">2001</option>
                                                <option value="2000">2001</option>
                                                <option value="1999">1999</option>
                                                <option value="1998">1998</option>
                                                <option value="1997">1997</option>
                                                <option value="1996">1996</option>
                                                <option value="1995">1995</option>
                                                <option value="1994">1994</option>
                                                <option value="1993">1993</option>
                                                <option value="1992">1992</option>
                                                <option value="1991">1991</option>
                                                <option value="1990">1990</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>


                                       
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <input placeholder="Titulo" name="titulo" type="text" class="form-control" value="<?php echo htmlentities($row_up['titulo'], ENT_COMPAT, 'utf-8'); ?>" required/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Combustivel</label>
                                            <select class="form-control" name="combustivel">
                                                <option value="">Nenhum</option>
                                                <option value="flex" <?php if (!(strcmp("flex", htmlentities($row_up['combustivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Flex</option>
                                                <option value="gasolina" <?php if (!(strcmp("gasolina", htmlentities($row_up['combustivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Gasolina</option>
                                                <option value="alcool" <?php if (!(strcmp("flex", htmlentities($row_up['combustivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Alcool</option>
                                                <option value="diesel" <?php if (!(strcmp("diesel", htmlentities($row_up['combustivel'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Diesel</option>
                                            </select>
                                            </div> 

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Cor</label>
                                            <select class="form-control" name="cor">
                                                <option value="">Nenhum</option>
                                                <option value="prata" <?php if (!(strcmp("prata", htmlentities($row_up['cor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Prata</option>
                                                <option value="preto" <?php if (!(strcmp("preto", htmlentities($row_up['cor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Preto</option>
                                                <option value="braco" <?php if (!(strcmp("braco", htmlentities($row_up['cor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Braco</option>
                                                <option value="vermelho" <?php if (!(strcmp("vermelho", htmlentities($row_up['cor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Vermelho</option>
                                                <option value="outra" <?php if (!(strcmp("outra", htmlentities($row_up['cor'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>Outra</option>
                                            </select>
                                            </div> 

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Portas</label>
                                            <select class="form-control" name="porta">
                                                <option value="">Nenhum</option>
                                                <option value="2" <?php if (!(strcmp("2", htmlentities($row_up['porta'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>2</option>
                                                <option value="2" <?php if (!(strcmp("4", htmlentities($row_up['porta'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>4</option>
                                                <option value="2" <?php if (!(strcmp("5", htmlentities($row_up['porta'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>>5</option>
                                            </select>
                                            </div> 
                                        </div> 
                                        
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Motor</label>
                                            <input placeholder="Ex: 1.6" name="motor" type="text" class="form-control" value="<?php echo htmlentities($row_up['motor'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>  
                                            
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Km</label>
                                            <input placeholder="Ex: 35.000" name="km" type="text" class="form-control" value="<?php echo htmlentities($row_up['km'], ENT_COMPAT, 'utf-8'); ?>"/>
                                            </div>

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Preço</label>
                                            <input placeholder="R$ Valor (Se houver)" name="preco" value="<?php echo htmlentities($row_up['preco'], ENT_COMPAT, 'utf-8'); ?>" class="form-control maskreal">
                                            </div>

                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Opcionais</label>
                                            <textarea placeholder="Descreva os opcionais" name="opcional" type="text" class="form-control"/><?php echo htmlentities($row_up['opcional'], ENT_COMPAT, 'utf-8'); ?></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                            <label>Observações</label>
                                            <textarea placeholder="Escreva uma observação se houver" name="observacao" type="text" class="form-control"/><?php echo htmlentities($row_up['observacao'], ENT_COMPAT, 'utf-8'); ?></textarea>
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
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-tag"></i> Marca</label>
                                            <select class="form-control" id="idmarca" name="idmarca" required>
                                                <option value="" selected>Selecione</option>
                                                <?php do { ?>
                                                <option value="<?php echo $row_marca['id']; ?>"><?php echo $row_marca['nome']; ?></option>
                                                <?php } while ($row_marca = mysql_fetch_assoc($marca)); ?>
                                            </select>
                                            <hr>
                                            <a href="carroMarcas.php"><div class="btn btn-default btn-block"><i class="fa fa-plus"></i> Adicionar Novo Fabricante</div></a>
                                            </div>
                                        </div>
                                         
                                         <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-home"></i> Modelo</label>
                                            <span class="carregando">Carregando...</span>
                                            <select class="form-control" name="idmodelo" id="idmodelo">
                                                <option value="">Selecione</option>
                                            </select>
                                            <hr>
                                            <a href="carroModelos.php"><div class="btn btn-default btn-block"><i class="fa fa-plus"></i> Adicionar Novo Modelo</div></a>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">
                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-star"></i> Ano de Fabricação</label>
                                            <select class="form-control" name="ano">
                                                <option value="2015" selected>2015</option>
                                                <option value="2014">2014</option>
                                                <option value="2013">2013</option>
                                                <option value="2012">2012</option>
                                                <option value="2011">2011</option>
                                                <option value="2010">2010</option>
                                                <option value="2009">2009</option>
                                                <option value="2008">2008</option>
                                                <option value="2007">2007</option>
                                                <option value="2006">2006</option>
                                                <option value="2005">2005</option>
                                                <option value="2004">2004</option>
                                                <option value="2003">2003</option>
                                                <option value="2002">2002</option>
                                                <option value="2001">2001</option>
                                                <option value="2000">2001</option>
                                                <option value="1999">1999</option>
                                                <option value="1998">1998</option>
                                                <option value="1997">1997</option>
                                                <option value="1996">1996</option>
                                                <option value="1995">1995</option>
                                                <option value="1994">1994</option>
                                                <option value="1993">1993</option>
                                                <option value="1992">1992</option>
                                                <option value="1991">1991</option>
                                                <option value="1990">1990</option>
                                            </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                            <div class="coluna">
                                            <label><i class="fa fa-star"></i> Em Destaque?</label>
                                            <select class="form-control" name="destaque">
                                                <option value="N" selected>Não</option>
                                                <option value="S">Sim</option>
                                            </select>
                                            </div>
                                        </div>
                                        </div>

                                       
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <input placeholder="Titulo" name="titulo" type="text" class="form-control" value="" required/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Combustivel</label>
                                            <select class="form-control" name="combustivel">
                                                <option value="" selected>Selecione</option>
                                                <option value="flex">Flex</option>
                                                <option value="gasolina">Gasolina</option>
                                                <option value="alcool">Alcool</option>
                                                <option value="diesel">Diesel</option>
                                            </select>
                                            </div> 

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Cor</label>
                                            <select class="form-control" name="cor">
                                                <option value="" selected>Selecione</option>
                                                <option value="prata">Prata</option>
                                                <option value="preto">Preto</option>
                                                <option value="branco">Branco</option>
                                                <option value="vermelho">Vermelho</option>
                                                <option value="outra">Outra</option>
                                            </select>
                                            </div> 

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Portas</label>
                                            <select class="form-control" name="porta">
                                                <option value="" selected>Selecione</option>
                                                <option value="2">2</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            </div> 
                                        </div> 
                                        
                                        <div class="row">
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Motor</label>
                                            <input placeholder="Ex: 1.6" name="motor" type="text" class="form-control" value=""/>
                                            </div>  
                                            
                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Km</label>
                                            <input placeholder="Ex: 35.000" name="km" type="text" class="form-control" value=""/>
                                            </div>

                                            <div class="form-group col-md-4 col-sm-4 col-xs-4">
                                            <label>Preço</label>
                                            <input placeholder="R$ Valor (Se houver)" name="preco" value="" class="form-control maskreal">
                                            </div>

                                        </div>
                                        
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                            <label>Opcionais</label>
                                            <textarea placeholder="Descreva os opcionais" name="opcional" type="text" class="form-control"/></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                            <label>Observações</label>
                                            <textarea placeholder="Escreva uma observação se houver" name="observacao" type="text" class="form-control"/></textarea>
                                            </div>
                                        </div>

    									<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <input type="submit" class="btn btn-primary"  value="Inserir" />
                                            <input type="hidden" name="ativo" value="N" />
                                            <input type="hidden" name="idusuario" value="<?php echo $row_user["idusuario"] ?>" />
                                            <input type="hidden" name="data_cadastro" value="<?php echo date("Y-m-d"); ?>" />
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
                                                <th class="tab-status text-center">ATIVO</th>
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
                                                <td class="text-tab"><?php echo limitar($row_r['titulo'],50); ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                      <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-cog"></i> Ações
                                                        <span class="caret"></span>
                                                      </button>
                                                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="?upload=<?php echo base64_encode($row_r['id']); ?>&iduser=<?php echo base64_encode($row_user["idusuario"]); ?>"><i class="fa fa-picture-o"></i> Enviar Foto</a></li>
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
                                    url: "../controller/carrosController.php",
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