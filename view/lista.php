<?php
include('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');
include("../include/_head.php"); 

// INFO PAGE
$pagetitle ="Arquivos";
$pagebtn ="Arquivo";
$tabelabd ="arquivos";
$controller = "../controller/arquivosController.php";

if (@$row_user['nivel'] == "1") {
mysql_select_db($database_db, $db);
$query_r = "SELECT arquivos.*, usuario.empresa as cliente, usuario.idusuario FROM $tabelabd INNER JOIN usuario ON arquivos.idusuario = usuario.idusuario ORDER BY arquivos.id DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
} else{
// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_r = "SELECT * FROM $tabelabd WHERE idusuario='".$row_user["idusuario"]."' ORDER BY id DESC";
$r = mysql_query($query_r, $db) or die(mysql_error());
$row_r = mysql_fetch_assoc($r);
$totalRows_r = mysql_num_rows($r);
};

?>


    

            <div id="page-wrapper">

              <!-- LIST ALL START -->
               <div class="row">
                    <div class="col-lg-12">
                <!--
                <?php if (@$row_user['nivel'] == "1") { ?>
                <br /><br />
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formModal">
                    <i class="fa fa-edit"></i> Adicionar novo <?php echo $pagebtn; ?>
                </button>
                <hr>
                
                <?php } ?>
            --><br><br>

                        <div class="panel panel-default">
                                    
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php if (@$row_r['id'] > 0) { ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th class="tab-id text-center">ID</th>
                                                <th class="tab-nome">DATA</th>
                                                <th class="tab-nome">TÍTULO</th>
                                                <?php if (@$row_user['nivel'] == "1") { ?>
                                                <th class="tab-nome">CLIENTE</th>
                                                <?php } ?>
                                                <th class="tab-acoes text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX <?php if (@$_GET['idpost'] == $row_r['id']) { ?> div-atencao <?php } ?>">
                                                <td class="text-center text-tab"><?php echo $row_r['id']; ?></td>
                                                <td class="text-center text-tab"><?php echo $row_r['data_cadastro']; ?></td>
                                                <td class="text-tab"><?php echo $row_r['titulo']; ?></td>
                                                <?php if (@$row_user['nivel'] == "1") { ?>
                                                <td class="text-tab"><?php echo $row_r['cliente']; ?></td>
                                                <?php } ?>
                                                
                                                
                                                <td class="text-right">
                                                  <a  href="../controller/download.php?arquivo=<?php echo $row_r['titulo'];?>">
                                                  <button class="btn btn-default" type="button">
                                                    <i class="fa fa-download"></i> Fazer Download
                                                  </button>
                                                  </a>
                                                  <?php if (@$row_user['nivel'] == "1") { ?>
                                                  <a onClick="return confirm('Deseja realmente excluir?')" href="<?php echo $controller; ?>?del=<?php echo base64_encode($row_r['id']); ?>">
                                                  <button class="btn btn-danger" type="button">
                                                    <i class="fa fa-trash"></i> Deletar
                                                  </button>
                                                  </a>
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
                <!-- LIST ALL END -->  
            </div>

<?php include("../include/_footer.php"); ?>
            