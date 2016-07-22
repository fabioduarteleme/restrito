<?php
include('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');
include("../include/_head.php"); 

// INFO PAGE
$pagetitle ="Upload de Arquivos";
$pagebtn ="Upload";
$tabelabd ="arquivos";
$controller = "../controller/paginasController.php";

if (@$row_user['nivel'] == "1") {
mysql_select_db($database_db, $db);
$query_r = "SELECT arquivos.*, usuario.empresa as cliente, usuario.idusuario FROM $tabelabd INNER JOIN usuario ON arquivos.idusuario = usuario.idusuario WHERE arquivos.idusuario='".base64_decode($_GET["idusuario"])."' ORDER BY arquivos.id DESC";
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
                        <h3 class="page-header">Enviando arquivos para <b><?php echo $row_r['cliente']; ?></b></h3>      
                <!--
                <?php if (@$row_user['nivel'] == "1") { ?>
                <br /><br />
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#formModal">
                    <i class="fa fa-edit"></i> Adicionar novo <?php echo $pagebtn; ?>
                </button>
                <hr>
                
                <?php } ?>
            --><br><br>


<?php

$pagereturn = "../view/upload-arquivo.php?idusuario=".$_GET['idusuario']."";

if(isset($_FILES['files'])){
    $errors= array();
    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
        $file_name = $key.$_FILES['files']['name'][$key];
        $file_size =$_FILES['files']['size'][$key];
        $file_tmp =$_FILES['files']['tmp_name'][$key];
        $file_type=$_FILES['files']['type'][$key];
        $usuarioid = base64_decode($_GET['idusuario']);
        $data = date('d-m-Y');
        if($file_size > 10097152){
            $errors[]='File size must be less than 10 MB';
        }
        $query="INSERT INTO arquivos (idusuario, data_cadastro, titulo, nomepath) VALUES ('$usuarioid', '$data','$file_name', ' $file_name')";
        $desired_dir="../download";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);        // Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"../download/".$file_name);
            }else{                                  //rename the file if another one exist
                $new_dir="../download/".$file_name.time();
                 rename($file_tmp,$new_dir) ;               
            }
            mysql_query($query);
        }else{
                print_r($errors);
        }
    }
    if(empty($error)){
        print "<script>window.location='".$pagereturn."&s=1';</script>";
    }
}
?>

    <div class="text-center">
        <form action="bosta.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="files[]" multiple=""/>
            <input type="hidden" name="idusuario" value="<?php echo $_GET['idusuario'] ?>" />
            <input type="submit" class="btn btn-primary" value="Enviar Arquivos"/>
        </form>
    </div>







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
                                                <th class="tab-acoes text-center"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php do { ?>
                                            <tr class="odd gradeX <?php if (@$_GET['idpost'] == $row_r['id']) { ?> div-atencao <?php } ?>">
                                                <td class="text-center text-tab"><?php echo $row_r['id']; ?></td>
                                                <td class="text-center text-tab"><?php echo $row_r['data_cadastro']; ?></td>
                                                <td class="text-tab"><?php echo limitar($row_r['titulo'],50); ?></td>
                                                <td>
                                                  <a target="_blank" href="download/<?php echo $row_r['id']; ?>/<?php echo $row_r['nomepath']; ?>">
                                                  <button class="btn btn-default btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fa fa-cog"></i> Fazer Download
                                                  </button>
                                                  </a>
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
            