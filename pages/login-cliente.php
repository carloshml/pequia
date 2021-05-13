<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Loja</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        function verificaLoginExistente(login) {
            $.ajax({
                url: '../controllers/usuarios-dao.php',
                method: 'get',
                data: {
                    'verificar-login': true,
                    login
                },
                success: function(data) {
                    $('#erro_login').html(data);
                    $('#erro_loginup').html(data);
                }
            });
        }
        $("#in_m_c_login").keyup(function() {
            verificaLoginExistente($("#in_m_c_login").val());
        });


        $('#btn_salvar_contato').click(function() {

            const usuarioNovo = $('#form_contato').serialize();
            console.log('usuarioNovo',);
             $.ajax({
                 url: '../controllers/usuarios-dao.php',
                 method: 'post',
                 data:  usuarioNovo+'&tipo=CLIENTE',
                 success: function(data) {
                     console.log('modal criacao', data);
                     const validacao = JSON.parse(data);
                     console.log('modal criacao', validacao);
                     if (validacao[0].valido) {
                        // aqui diz que salvou o usuario  
                        window.location.href = 'loja.php';                 
                     } else {
                         $('#erro_nome').html('');
                         $('#erro_endereco').html('');
                         $('#erro_telefone').html('');
                         $('#erro_email1').html('');
                         $('#erro_email2').html('');
                         $('#erro_sexo').html('');
                         $('#erro_login').html('');
                         $('#erro_senha').html('');
                         $('#erro_senha2').html('');
                         if (validacao[1].temErro) {
                             $('#erro_nome').html(validacao[1].motivo);
                         }
                         if (validacao[2].temErro) {
                             $('#erro_endereco').html(validacao[2].motivo);
                         }
                         if (validacao[3].temErro) {
                             $('#erro_telefone').html(validacao[3].motivo);
                         }
                         if (validacao[4].temErro) {
                             $('#erro_email1').html(validacao[4].motivo);
                         }
                         if (validacao[5].temErro) {
                             $('#erro_email2').html(validacao[5].motivo);
                         }
                         if (validacao[6].temErro) {
                             $('#erro_sexo').html(validacao[6].motivo);
                         }
                         if (validacao[7].temErro) {
                             $('#erro_senha').html(validacao[7].motivo);
                         }
                         if (validacao[8].temErro) {
                             $('#erro_senha2').html(validacao[8].motivo);
                         }
                         if (validacao[9].temErro) {
                             $('#erro_login').html(validacao[9].motivo);
                         }
                     }
                 }
             });
        });
    });
    </script>

</head>

<body id="page-top">
    <div style="position: relative;">
        <div id="corpo_aviso" class="corpo-aviso"></div>
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Pequiá | Loja </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                   <a class="nav-link active" aria-current="page"href="../pages/loja.php">Loja</a> 
                </li>
                <li class="nav-item">
                   <a class="nav-link active" aria-current="page" href="#" role="button" data-toggle="modal" data-target="#login-modal">Entrar</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link" href="../controllers/sair.php"> sair </a>
                </li>              
                 
            </ul>            
            </div>
        </div>
    </nav>


    <header class="masthead" style="height: 0; min-height: 0;"> </header>
    <div class="container">
        <form method="post"    id="form_contato" enctype="multipart/form-data">
            <!-- action="index.php" method="post" -->
            <div class="control-group">
                <label class="control-label">Nome: </label>
                <div class="controls">
                    <input id="in_m_c_nome" size="50" class="form-control" name="nome" type="text" placeholder="Nome"
                        required="" value=" ">
                    <span id="erro_nome" class="help-inline text-warning"></span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Login</label>
                <div class="controls">
                    <input id="in_m_c_login" size="50" autocomplete="off" class="form-control" name="login" type="text"
                        placeholder="login" required="" value=" ">
                    <span id="erro_login" class="help-inline text-warning"></span>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label">Endereço</label>
                <div class="controls">
                    <input id="in_m_c_endereco" size="80" class="form-control" name="endereco" type="text"
                        placeholder="Endereço" required="" value=" ">
                    <span id="erro_endereco" class="help-inline text-warning"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="control-group ">
                        <label class="control-label">Telefone</label>
                        <div class="controls">
                            <input id="in_m_c_telefone" size="35" class="form-control" name="telefone" type="text"
                                placeholder="Telefone" required="" value="">
                            <span id="erro_telefone" class="help-inline text-warning"></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="control-group ">
                        <label class="control-label">Email</label>
                        <div class="controls">
                            <input id="in_m_c_email" size="40" class="form-control" name="email" type="text"
                                placeholder="Email" required="" value="">
                            <span id="erro_email1" class="help-inline text-warning"></span>
                            <span id="erro_email2" class="help-inline text-warning"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <div class="control-group ">
                        <label class="control-label">Senha</label>
                        <div class="controls">
                            <input id="in_m_c_senha" size="80" class="form-control" name="senha" type="password"
                                placeholder="senha" required="true" value="">

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="control-group ">
                        <label class="control-label">Repita a Senha</label>
                        <div class="controls">
                            <input id="in_m_c_senha2" size="80" class="form-control" name="senha2" type="password"
                                placeholder="senha" required="true" value="">
                        </div>
                    </div>
                </div>
            </div>
            <span id="erro_senha" class="help-inline text-warning"></span>
            <span id="erro_senha2" class="help-inline text-warning"></span>
            <div class="control-group ">
                <label class="control-label">Sexo</label>
                <span id="erro_sexo" class="help-inline text-warning"></span>
                <div class="controls">
                    <div class="form-check">
                        <p class="form-check-label">
                            <input class="form-check-input" type="radio" name="sexo" id="sexoM" value="M" /> Masculino
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="sexo" id="sexoF" value="F" /> Feminino
                    </div>
                    </p>

                </div>
            </div>
            <div class="pra-direita">
                <button id="btn_salvar_contato" type="button" class="btn btn-success">Adicionar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Bootstrap core JS -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
</body>

</html>