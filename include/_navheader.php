            <nav class="navbar navbar-default navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php if (@$row_admin['logo'] != "") { ?>
                    <a class="navbar-brand logosis" href="painelprincipal.php"><img src="../img/config/logo/<?php echo $row_admin['logo'] ?>" alt="<?php echo $row_admin['titulo'] ?>" /></a>
                    <?php } else { ?>
                    <a class="navbar-brand logosis" href="painelprincipal.php">Logo Sis</a>
                    <?php } ?>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    
                    <li class="dropdown">
                        
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-2x fa-fw"></i><!--<span class="notification-icon label label-danger animated bounce">1</span>-->
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:introJs().start();">
                                    <div>
                                        <i class="fa fa-magic fa-fw"></i> Veja o tutorial do Painel
                                        <span class="pull-right text-muted small"><i class="fa fa-play-circle"></i> Iniciar Tour</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php 
                    // RECEIVE DATA INBOX MESSAGE
                    mysql_select_db($database_db, $db);
                    $query_mensagem = "SELECT * FROM contatos WHERE idusuario='".$row_user["idusuario"]."' AND ativo = 'S' ORDER BY id DESC LIMIT 5";
                    $mensagem = mysql_query($query_mensagem, $db) or die(mysql_error());
                    $row_mensagem = mysql_fetch_assoc($mensagem);
                    $totalRows_mensagem = mysql_num_rows($mensagem);
                    ?>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-2x fa-fw"></i>
                        <?php if (@$row_mensagem['ativo'] == "S") { ?>
                        <span class="notification-icon label label-danger animated bounce">
                            <?php echo $totalRows_mensagem; ?>
                        </span>
                        <?php } ?>
                        </a>

                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <?php if (@$row_mensagem['ativo'] == "S") { ?>
                                
                                <?php do { ?>
                                <a href="contatos.php?edit=<?php echo base64_encode($row_mensagem['id']); ?>">
                                    <div>
                                        <strong> <?php echo $row_mensagem["nome"]; ?> </strong>
                                        <span class="pull-right dropdown-messages-date text-muted">
                                            <em><?php echo invert($row_mensagem["data_cadastro"],"/"); ?></em>
                                        </span>
                                    </div>
                                <div class="dropdown-messages-message"><?php echo limitar($row_mensagem["texto"],"200"); ?></div>
                                </a>
                                <?php } while ($row_mensagem = mysql_fetch_assoc($mensagem)); ?>
                                
                                <?php } else { ?>
                                <div class="dropdown-messages-message text-center notification-text"><i>Nenhuma mensagem em aberto</i></div>
                                <?php } ?>
                            </li>
                            
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="contatos.php">
                                    <strong>Leia todas as mensagens </strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" data-step="6" data-intro="Altere seus dados de perfil aqui! Aproveite! :)" data-position='left'>
                            <i class="fa fa-user  fa-2x fa-fw"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="usuarios.php?edit=<?php echo base64_encode($row_user['idusuario']); ?>"><i class="fa fa-user fa-fw"></i> Meu perfil</a>
                            </li>
                            <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a>-->
                            </li>
                            <li class="divider"></li>
                            <li><a href="<?php echo $logoutAction ?>"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

            </nav>
            <!-- /.navbar-static-top -->