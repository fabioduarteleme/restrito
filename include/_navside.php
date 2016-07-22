<nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="side-menu" >
                        <li>
                            <div class="user-info-wrapper">	
                                <div class="user-info-profile-image">
                                    <?php if (@$row_user['imagem'] != "") { ?>
                                    <a href="usuarios.php?edit=<?php echo base64_encode($row_user['idusuario']); ?>"><img src="../img/profile/<?php echo $row_user['imagem']; ?>" alt="" width="65" /></a>
                                    <?php } else { ?>                   
                                    <a href="usuarios.php?edit=<?php echo base64_encode($row_user['idusuario']); ?>"><img src="../img/profile/default.jpg" alt="" width="65" /></a>
                                    <?php } ?>
                                </div>
                                <div class="user-info">
                                    <div class="user-welcome">Bem-vindo</div>
                                    <div class="username">
                                        Olá
                                        <?php
                                        $Nome = $row_user['nome'];
                                        $primeiroNome = explode(" ", $Nome);
                                        echo $primeiroNome[0];
                                        ?>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </li>  
                        
                        <?php if (@$row_user['nivel'] == "1") { ?>
                        <li><a <?php if ($currentpage == "configuracoes.php") { ?> class="active" <?php }  ?> href="configuracoes.php" ><i class="fa fa-cog fa-fw fa-3x"></i> Configurações</a></li>
                        <li><a <?php if ($currentpage == "usuarios.php") { ?> class="active" <?php }  ?> href="usuarios.php" ><i class="fa fa-user fa-fw fa-3x"></i> Usuários</a></li>
                        <?php } else{ ?>
                        

                        <li data-step="3" data-intro="Estes são os menus laterais" data-position='right'>
                            <a <?php if ($currentpage == "painelprincipal.php") { ?> class="active" <?php }  ?> href="painelprincipal.php" ><i class="fa fa-dashboard fa-fw fa-3x"></i> Painel Principal</a>
                        </li>
                        <li data-step="4" data-intro="Clicando neles é possível alterar as informações de seu site" data-position='right'>
                            <a <?php if ($currentpage == "empresa.php") { ?> class="active" <?php }  ?> href="empresa.php"><i class="fa fa-building fa-fw fa-3x"></i> Empresa</a>
                        </li>
                        
                        <li>
                            <a <?php if ($currentpage == "galerias.php") { ?> class="active" <?php }  ?> href="galerias.php"><i class="fa fa-camera fa-fw fa-3x"></i> Galerias</a>
                        </li>
                        <li>
                            <a <?php if ($currentpage == "paginas.php") { ?> class="active" <?php }  ?> href="paginas.php"><i class="fa fa-file-text fa-fw fa-3x"></i> Páginas</a>
                        </li>
                        <li>
                            <a <?php if ($currentpage == "banner.php") { ?> class="active" <?php }  ?> href="banner.php"><i class="fa fa-photo fa-fw fa-3x"></i> Banners</a>
                        </li>
                   
                        <li>
                            <a <?php if ($currentpage == "eleicao.php") { ?> class="active" <?php }  ?> href="eleicao.php"><i class="fa fa-users fa-fw fa-3x"></i> Representantes</a>
                        </li>
                        <!--
                        <li>
                            <a <?php if ($currentpage == "eventos.php") { ?> class="active" <?php }  ?> href="eventos.php"><i class="fa fa-calendar fa-fw fa-3x"></i> Shows e Eventos</a>
                        </li>
                        -->
                        <!--
                        <li>
                            <a <?php if ($currentpage == "imoveis.php") { ?> class="active" <?php }  ?> href="imoveis.php"><i class="fa fa-home fa-fw fa-3x"></i> Imóveis</a>
                        </li>
                        
                        <li>
                            <a <?php if ($currentpage == "carros.php") { ?> class="active" <?php }  ?> href="carros.php"><i class="fa fa-car fa-fw fa-3x"></i> Automóveis</a>
                        </li>
                        <li>
                            <a <?php if ($currentpage == "carroMarcas.php") { ?> class="active" <?php }  ?> href="carroMarcas.php"><i class="fa fa-car fa-fw fa-3x"></i> Fabricantes</a>
                        </li>
                        <li>
                            <a <?php if ($currentpage == "carroModelos.php") { ?> class="active" <?php }  ?> href="carroModelos.php"><i class="fa fa-car fa-fw fa-3x"></i> Modelos</a>
                        </li>
                        -->

                        <li>
                            <a <?php if ($currentpage == "setup.php") { ?> class="active" <?php }  ?> href="setup.php"><i class="fa fa-sitemap fa-fw fa-3x"></i> Configurações do Site</a>
                        </li>
                        <li data-step="5" data-intro="Aqui você visualizará as mensagens enviadas pelo seu site" data-position='right'>
                            <a <?php if ($currentpage == "contatos.php") { ?> class="active" <?php }  ?> href="contatos.php"><i class="fa fa-envelope fa-fw fa-3x"></i> Mensagens</a>
                        </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>