<?php include("include/_headindex.php"); ?>

            <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading text-center">
                            <br>
                            <div class="logosistema">
                                <?php if (@$row_admin['logo'] != "") { ?>
                                <img src="img/config/logo/<?php echo $row_admin['logo'] ?>" alt="<?php echo $row_admin['titulo'] ?>" />
                                <?php } else { ?>
                                Logo
                                <?php } ?>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form id="login" name="login" method="POST" action="index.php">
                                <fieldset>
                                    <div class="form-group">
                                        <label><i class="fa fa-envelope"></i> Seu e-mail</label>
                                        <input type="email" class="form-control" placeholder="E-mail" name="email"  autofocus="" required />
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa fa-user"></i> Sua Senha</label>
                                        <input class="form-control" placeholder="Senha" name="senha" type="password" value="" required />
                                    </div>
                                    <?php if (@$_GET['s'] > 0) { ?>
                                    <div class="alert alert-danger alert-dismissable animated tada">
                                        <a href="index.php"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></a>
                                        <i class="fa fa-warning"></i> Email ou senha incorretos
                                    </div>
                                    <?php } ?>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <td><input type="submit" class="btn btn-primary btn-lg btn-block" name="button" id="button" value="Acesse" /></td>
                                    <?php if (@$_GET['ativado'] == "s") { ?>
                                    <?php } else { ?>
                                    <!--
                                    <td><div class="text-center"><div class="panel-title"><br>ou<br><br></div></div></td>
                                    -->
                                    <?php } ?>
                                </fieldset>
                            </form>
                            <?php if (@$_GET['ativado'] == "s") { ?>
                            <?php } else { ?>
                            <!--
                            <a href="cadastre-se.php"><button class="btn btn-default btn-lg btn-block signup-btn"><i class="fa fa-user-plus"></i> Cadastre-se</button></a>
                            -->
                            <?php } ?>
                            <!--
                            <a href="facebook/fbconfig.php" class="btn btn-fb btn-lg btn-block signup-btn"><i class="fa fa-facebook"></i> Cadastre-se com Facebook</a>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("include/_footerindex.php"); ?>
            