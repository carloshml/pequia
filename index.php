<?php
session_start();
require_once('controllers/produto_dao.php');
$usuario_nome = null;
if (isset($_SESSION['usuario_nome'])) {
    $usuario_nome = $_SESSION['usuario_nome'];
}
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pequiá</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js" crossorigin="anonymous"></script>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilo.css" rel="stylesheet" />
    <script src="assets/js/script-local.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            $('#btn_login').click(function () {
                const usuarioNovo = $('#form-login').serialize();
                console.log('  usuarioNovo :::: ', usuarioNovo);
                $.ajax({
                    url: 'controllers/usuarios-dao.php',
                    method: 'get',
                    data: usuarioNovo + '&tipo=CLIENTE',
                    success: function (data) {
                        localStorage.setItem('id_usuario', data['id']);
                        localStorage.setItem('usuario_login', data['login']);
                        localStorage.setItem('email', data['email']);
                        localStorage.setItem('usuario_nome', data['nome']);
                        localStorage.setItem('tipo', data['tipo']);
                        console.log('data', data.nome);
                        console.log(' local host ', localStorage.getItem('usuario_nome'));
                        if (!data.id) {
                            $('#mensagem-login').html('Usuário ou senha incorretos');
                        } else {
                            if (data['tipo'] === 'CLIENTE') {
                                window.location.href = 'pages/loja.php';
                            } else {
                                window.location.href = 'pages/home.php';
                            }
                        }
                    }
                })
            })
        }) 
    </script>
</head>

<body id="page-top">
 
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="index.php">Pequiá</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu <i class="fas fa-bars ms-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">

                    <?php
                    if (!isset($_SESSION['usuario_nome'])) {
                        echo '  <li class="nav-item mx-0 mx-lg-1">
                                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" aria-current="page" href="#"
                                    role="button" data-toggle="modal" data-target="#login-modal">
                                    Entrar
                                </a>
                            </li>';
                    }
                    ?>

                    <?php
                    if (isset($_SESSION['usuario_nome'])) {
                        echo ' <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="pages/home.php">
                            <i class="fas fa-home"></i> home
                        </a>
                        </li> 
                        <li class="nav-item mx-0 mx-lg-1">
                                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="controllers/sair.php">
                                    <i class="fas fa-home"></i> sair
                                </a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>



    <!-- Masthead-->
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end">
                    <h1 class="text-uppercase text-white font-weight-bold">PEQUIÁ-Artesanatos brasileiros</h1>
                    <hr class="divider my-4" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 font-weight-light mb-5">
                        O artesanato é parte do patrimônio cultural de povos e comunidades brasileiras, representando
                        suas tradições, costumes e as diversidades naturais.
                        Aqui você encontra um Brasil de respeito e valorização da produção local.
                        Sua decisão de compra ajuda a fomentar a economia local e a manutenção dos povos em seu ambiente
                        de origem.
                    </p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="/pages/loja.php">Catálogo</a>
                </div>
            </div>
        </div>
    </header>
    <section class="page-section  bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading">Artesanato pra você </h2>
                    <hr class="divider my-4" />
                    <p class="text-faded">
                        O artesanato é parte do patrimônio cultural de povos e comunidades, pois
                        representa as suas tradições, costumes e preservam conhecimentos e técnicas
                        populares. Além de ter papel relevante na preservação da riqueza da arte
                        tradicional e de saberes populares, o artesanato é um recurso para o
                        desenvolvimento econômico de muitas famílias brasileiras. O artesanato
                        brasileiro é muito diversificado, principalmente devido à pluralidade cultural
                        existente no país, influenciada por diferentes povos: indígenas, africanos,
                        europeus e asiáticos. Seus materiais exploram também a diversidade natural,
                        utilizando diferentes recursos.
                    </p>
                    <!--      <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">Get Started!</a>-->
                </div>
            </div>
        </div>
    </section>

    <!-- Services-->
    <section class="page-section" id="services">
        <div class="container">
            <h2 class="text-center mt-0">At Your Service</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Sturdy Themes</h3>
                        <p class="text-muted mb-0">Our themes are updated regularly to keep them bug free!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Up to Date</h3>
                        <p class="text-muted mb-0">All dependencies are kept current to keep things fresh.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-globe text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Ready to Publish</h3>
                        <p class="text-muted mb-0">You can use this design as is, or you can make changes!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <i class="fas fa-4x fa-heart text-primary mb-4"></i>
                        <h3 class="h4 mb-2">Made with Love</h3>
                        <p class="text-muted mb-0">Is it really open source if it s not made with love?</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section bg-primary" id="novidades">
        <div class="container">
            <h2 class="section-heading text-center branco"> <strong> Últimos produtos </strong> </h2>
            <?php
            $produto_dao = new ProdutoDAO();
            $produto_dao->buscarProdutosTelaInicial();
            ?>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <hr class="divider my-4" />
            <h2 class="text-center mt-0">Nossos Contatos</h2>
            <hr class="divider my-4" />
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <p class="mb-5">Pronto pra comprar biojoias conosco, nos ligue ou envie um e-mail.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center">
                    <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
                    <p>(63) 3554-8989</p>
                </div>
                <div class="col-lg-4 ml-auto text-center">
                    <i class="fab fa-whatsapp fa-3x mb-3 sr-contact"></i>
                    <p>(63) 3554-8989</p>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fa fa-envelope fa-3x mb-3 sr-contact"></i>
                    <p>
                        <a href="mailto:your-email@your-domain.com">pequia@yahoo.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer style="text-align:right ">

    </footer>




    <!-- Bootstrap core JavaScript -->
    <!-- Bootstrap core JS -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="assets/js/jquery-3.5.1.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="assets/js/scripts.js"></script>
</body>

</html>


<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <img class="" height="40px" id="img_logo" src="assets/img/logo.png">
                <button id="btn-fechar-modal" type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times </span>
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
<!-- END # MODAL LOGIN -->