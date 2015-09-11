<?php include("include/_headindex.php"); ?>

            <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default animated fadeIn">
                        <div class="panel-heading text-center">
                            <br>
                            <div class="logosistema">
                                <?php if (@$row_admin['logo'] != "") { ?>
                                <img src="img/config/logo/<?php echo $row_admin['logo'] ?>" alt="<?php echo $row_admin['titulo'] ?>" />
                                <?php } else { ?>
                                Logo Sis
                                <?php } ?>
                            </div>  
                        </div>
                        <div class="panel-body">
                            <?php if (@$_GET['s'] != "") { ?>
                                
                                <?php if (@$_GET['ativo'] == "s") { ?>
                                    <?php if (@$_GET['usuario'] == "n") { ?>
                                        <div class="saudacao text-center">
                                        <h4><i class="fa fa-exclamation-triangle animated infinite flash"></i> Este email já foi cadastrado :(</h4><br>
                                        <a href="./cadastre-se.php"><div class="btn btn-default animated fadeInUp"><h4>Experimente usar outro email</h4></div></a>
                                        <br><br>
                                        </div>
                                    <?php } else { ?>
                                        <div class="saudacao text-center">
                                        <h4>Sua conta foi ativada com Sucesso!</h4><br>
                                        <a href="./?ativado=s"><div class="btn btn-default animated fadeInUp"><h4>Clique aqui para fazer Login</h4></div></a>
                                        <br><br>
                                        </div>
                                    <?php } ?>
                                    
                                <?php } else { ?> 
                                    <div class="saudacao text-center">
                                    <h4>Parabéns !!! Seus dados foram enviados com Sucesso.</h4>
                                    <div class="envioemail animated fadeInUp"><i class="fa fa-envelope animated flash infinite"></i> Enviamos um email para você! <br> <i>Talvez ele possa estar no lixo eletrônico, ok?</i></div>
                                    <h4>Acesse-o para concluir seu cadastro.</h4>
                                <?php } ?>
                                </div>
                            <?php } else { ?>

                            <form id="login" name="login" method="POST" action="controller/cadastroController.php">
                                <fieldset>
                                    <div class="form-group">
                                        <label><i class="fa fa-user"></i> Seu Nome</label>
                                        <input class="form-control" placeholder="Nome Completo" name="nome"  autofocus="" required />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><i class="fa fa-envelope"></i> Seu e-mail</label>
                                        <input class="form-control" type="email" placeholder="Email" name="email" required />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><i class="fa fa-phone"></i> Seu Telefone ou Celular</label>
                                        <input class="form-control telefone" placeholder="Telefone ou Celular" name="telefone" required />
                                    </div>

                                    <div class="form-group">
                                        <label><i class="fa fa-credit-card"></i> Seu CPF</label>
                                        <input class="form-control cpf" placeholder="CPF" name="cpf"  autofocus="" required />
                                    </div>
                                    
                                    <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><i class="fa fa-map-marker"></i> Estado</label>
                                        <select class="form-control" id="estado" name="estado" value="PR" required></select> 
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><i class="fa fa-map-marker"></i> Cidade</label>
                                        <select class="form-control" id="cidade" name="cidade" value="Maringá" required></select> 
                                    </div>
                                    </div>

                                    <div class="form-group">
                                        <label><i class="fa fa-unlock-alt"></i> Sua Senha</label>
                                        <input class="form-control" placeholder="Senha" name="senha" type="password" value="" required />
                                    </div>

                                    <?php if (@$row_admin['termos'] != "") { ?> 
                                    <div class="checkbox text-center">
                                    <label>
                                        Ao me cadastrar concordo e aceito os <br><a data-toggle="collapse" data-target="#opendiv">termos de uso do site</a>
                                    </label>
                                    <div class="row">
                                        <div id="opendiv" class="termosall collapse"><?php echo nl2br($row_admin['termos']); ?></div>
                                    </div>
                                    </div>
                                    <?php } ?>

                                    <?php if (@$_GET['s'] > 0) { ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <a href="index.php"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></a>
                                        <i class="fa fa-warning"></i> Email ou senha incorretos
                                    </div>
                                    <?php } ?>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <td><input type="submit" class="btn btn-primary btn-lg btn-block" value="Cadastre-me" /></td>
                                    <td><div class="text-center"><div class="panel-title"><br>ou<br><br></div></div></td>
                                </fieldset>
                                    <input type="hidden" name="ativo" value="N" />
                                    <input type="hidden" name="verificado" value="N" />
                                    <input type="hidden" name="nivel" value="0" />
                                    <input type="hidden" name="url" value="<?php echo $url; ?>" />
                                    <input type="hidden" name="data_cadastro" value="<?php echo date("Y-m-d"); ?>" />
                                    <input type="hidden" name="hora_cadastro" value="<?php echo date('H:i'); ?>" />
                                    <input type="hidden" name="MM_insert" value="addForm" />
                            </form>
                            <a href="index.php"><button class="btn btn-default btn-lg btn-block"> Faça Login</button></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("include/_footerindex.php"); ?>

            