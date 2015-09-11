<?php
include('../Connections/db.php');
include('../include/_restrito.php');
include('../classes/function.php');
include("../include/_head.php"); 

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_imovel = "SELECT * FROM imovel WHERE idusuario='".$row_user["idusuario"]."' ORDER BY id DESC";
$imovel = mysql_query($query_imovel, $db) or die(mysql_error());
$row_imovel = mysql_fetch_assoc($imovel);
$totalRows_imovel = mysql_num_rows($imovel);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_totalcontatos = "SELECT * FROM contatos WHERE idusuario='".$row_user["idusuario"]."'";
$totalcontatos = mysql_query($query_totalcontatos, $db) or die(mysql_error());
$row_totalcontatos = mysql_fetch_assoc($totalcontatos);
$totalRows_totalcontatos = mysql_num_rows($totalcontatos);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_totalimoveis = "SELECT * FROM imovel WHERE idusuario='".$row_user["idusuario"]."'";
$totalimoveis = mysql_query($query_totalimoveis, $db) or die(mysql_error());
$row_totalimoveis = mysql_fetch_assoc($totalimoveis);
$totalRows_totalimoveis = mysql_num_rows($totalimoveis);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_totalcarro = "SELECT * FROM carro WHERE idusuario='".$row_user["idusuario"]."'";
$totalcarro = mysql_query($query_totalcarro, $db) or die(mysql_error());
$row_totalcarro = mysql_fetch_assoc($totalcarro);
$totalRows_totalcarro = mysql_num_rows($totalcarro);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_totalgaleria = "SELECT * FROM galerias WHERE idusuario='".$row_user["idusuario"]."'";
$totalgaleria = mysql_query($query_totalgaleria, $db) or die(mysql_error());
$row_totalgaleria = mysql_fetch_assoc($totalgaleria);
$totalRows_totalgaleria = mysql_num_rows($totalgaleria);

// RECEIVE DATA
mysql_select_db($database_db, $db);
$query_totalbanner = "SELECT * FROM banner WHERE idusuario='".$row_user["idusuario"]."'";
$totalbanner = mysql_query($query_totalbanner, $db) or die(mysql_error());
$row_totalbanner = mysql_fetch_assoc($totalbanner);
$totalRows_totalibanner = mysql_num_rows($totalbanner);
?>


            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="col-lg-12">
                            <div class="jumbotron">
                                <h2><i class="fa fa-bookmark"></i> Seja Bem-vindo</h2><br>
                                <p>Seja bem vindo, este é o painel de controle aonde é possível acompanhar os contatos de seu site, assim como também cadastrar novos ítens e alterar informações presentes nas páginas de seu site.  Fique atento aos contatos que você receberá do site por meio do formulário de contato, responda-os sempre que puder.</p>
                                <br>
                                <a data-step="1" data-intro="Seja bem-vindo! Você pode acessar seu website clicando aqui." href="../../home/?u=<?php echo base64_encode($row_user['idusuario']); ?>" target="_blank" class="btn btn-primary btn-lg" role="button"><i class="fa fa-sitemap"></i> Acesse seu site</a>
                                <a href="<?php echo $logoutAction ?>" target="_blank" class="btn btn-default btn-lg" role="button"><i class="fa fa-user"></i> Sair</a>
                                </p>
                            </div>
                        </div>

                        <!-- PAINEL INFO START -->
                        <div class="row">
                            
                            <div class="col-xs-4 col-md-4">
                                <div class="panel panel-primary text-center panel-eyecandy" data-position='top' data-step="2" data-intro="Este é um resumo dos dados registrados até agora em seu site">
                                    <div class="panel-body theme-color">
                                        <i class="fa fa-home fa-3x"></i>
                                        <h3><?php echo $totalRows_imovel; ?></h3>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="panel-eyecandy-title">
                                            Total de Imóveis
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- /.col-xs-6 col-md-3 -->
                            
                            <!--
                            <div class="col-xs-3 col-md-3">
                                <div class="panel panel-primary text-center panel-eyecandy">
                                    <div class="panel-body asbestos">
                                        <i class="fa fa-car fa-3x"></i>
                                        <h3><?php echo $totalRows_totalcarro; ?></h3>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="panel-eyecandy-title">
                                            Total de Carros
                                        </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="col-xs-4 col-md-4">
                                <div class="panel panel-primary text-center panel-eyecandy">
                                    <div class="panel-body theme-color">
                                        <i class="fa fa-photo fa-3x"></i>
                                        <h3><?php echo $totalRows_totalibanner; ?></h3>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="panel-eyecandy-title">
                                            Total de Banners
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="col-xs-3 col-md-3">
                                <div class="panel panel-primary text-center panel-eyecandy">
                                    <div class="panel-body asbestos">
                                        <i class="fa fa-photo fa-3x"></i>
                                        <h3><?php echo $totalRows_totalgaleria; ?></h3>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="panel-eyecandy-title">
                                            Total de Galerias
                                        </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <!-- /.col-xs-6 col-md-3 -->
                            <div class="col-xs-4 col-md-4">
                                <div class="panel panel-primary text-center panel-eyecandy">
                                    <div class="panel-body theme-color">
                                        <i class="fa fa-comments fa-3x"></i>
                                        <h3><?php echo $totalRows_totalcontatos; ?></h3>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="panel-eyecandy-title">
                                            Total de Contatos
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-xs-6 col-md-3 -->
                        </div>
                        <!-- PAINEL INFO END -->

                    </div>
                </div>
            </div>

<?php include("../include/_footer.php"); ?>
            