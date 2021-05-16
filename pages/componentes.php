<?php
class Componente
{
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
