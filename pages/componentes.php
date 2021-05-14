<?php
class Componente
{

    public function nav()
    {
        echo '  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="../index.php">Pequiá</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto"> ';
                   

        if (isset($_SESSION['tipo']) && $_SESSION['tipo']  != 'CLIENTE') {
            echo '<li class="nav-item mx-0 mx-lg-1">
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="produto-detalhe.php">
                                        Publicar
                        </a>
                  </li>';
        }

        if (isset($_SESSION['tipo']) && $_SESSION['tipo']  == 'CLIENTE') {
            echo '  <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/pages/loja.php">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>';
        } else {
            echo '  <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="/pages/home.php">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>';
        }


        if (isset($_SESSION['usuario_nome'])) {
            echo '   <li class="nav-item mx-0 mx-lg-1">
                          <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../controllers/sair.php">                              
                              <i class="fas fa-sign-out-alt"></i>
                          </a>
                      </li>';
        } else {
            echo ' <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" aria-current="page" href="#" role="button" data-toggle="modal" data-target="#login-modal">
                                Entrar
                             </a>
                     </li>';
        }
        echo  '</ul>
            </div>
        </div>
    </nav>';
        echo '   <div style="padding-top: 10em;"> <div>';
    }

    public function modalLogin()
    {
        echo '   <!-- BEGIN # MODAL LOGIN -->
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <img class="" height="40px" id="img_logo" src="../assets/img/logo.png">
                        <button id="btn-fechar-modal" type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- Begin # Login Form -->
                    <form id="form-login" class="form-horizontal">
                        <div class="modal-body">
                            <div id="div-login-msg" class="text-center">
                                <i class="fas fa-chevron-right"></i>
                                <span id="text-login-msg">Escreva seu usuário e senha:</span>
                                <div class="help-inline text-warning" id="mensagem-login"></div>
                            </div>
                            <label for="">usuário:</label>
                            <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                            <label for="">senha:</label>
                            <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="btn_login" class="btn btn-primary btn-lg btn-block">Login </div>
                            <a class="btn btn-primary btn-lg btn-block" href="pages/login-cliente.php">Criar conta </a>
                        </div>
                    </form>
                    <!-- End # Login Form -->
    
                </div>
            </div>
        </div>
        <!-- END # MODAL LOGIN -->';
    }
}
