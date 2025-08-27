<?php
session_start();
require_once('../controllers/produto_dao.php');
require_once('../dao/venda-dao.php');
require_once('componentes.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pequia</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js" crossorigin="anonymous"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script src="../assets/js/script-local.js"></script>
    <style>
        .background-animado {
            background: linear-gradient(-45deg, #88bbbb, #23d5ab, #004de6);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .fa-5x {
            color: white;
        }
    </style>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            console.log(' local host ', localStorage.getItem('usuario_nome'));
            if (!localStorage.getItem('usuario_nome')) {
                window.location.href = '../index.php?erro=1';
            }
            var myInit = {
                method: 'GET',
                headers: {},
                cache: 'default'
            };
            fetch(`../controllers/usuarios-controller.php?contar-usuarios=true`, myInit)
                .then(response => {
                    return response.text()
                        .then(function (totUsuarios) {
                            document.getElementById('id-usuario').innerHTML = totUsuarios;
                        });
                })
                .catch(err => {
                    console.log('err', err)
                });

        });
    </script>
</head>

<body id="page-top" class="background-animado">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Pequiá</a>
            <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu <i class="fas fa-bars ms-2"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">

                    <?php
                    if (isset($_SESSION['usuario_nome'])) {
                        echo ' <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="home.php">
                            <i class="fas fa-home"></i> home
                        </a>
                        </li> 
                        <li class="nav-item mx-0 mx-lg-1">
                                <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../controllers/sair.php">
                                    <i class="fas fa-home"></i> sair
                                </a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="padding-top: 10em;">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header branco ">Painel de Controle</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <hr>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6 item-destaque">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                    </div>
                    <div>
                        <a class="branco" href="produtos-modulo.php">
                            <?php
                            $produto_dao = new ProdutoDAO();
                            echo $produto_dao->numeroTotal();
                            ?>
                            Produtos!
                        </a>
                        <div>
                            <a href="produto-detalhe.php" class="panel-footer branco"> Cadastrar </a>
                        </div>
                        <div>
                            <a href="produtos-modulo.php">
                                <div class="panel-footer branco">
                                    <span class="pull-left">Editar Produtos</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 item-destaque">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">

                            <i class="fas fa-users fa-5x"></i>

                        </div>
                    </div>
                    <div class="branco">
                        <span id="id-usuario"> </span> Usuário!
                    </div>
                    <a href="usuarios-modulo.php">
                        <div class="panel-footer branco">
                            <span class="pull-left">Editar Usuários</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 item-destaque">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                    </div>
                    <a class="branco" href="venda-listar.php">
                        <?php
                        $venda_dao = new VendaDAO();
                        echo $venda_dao->numeroTotal();
                        ?> Vendas!
                    </a>
                    <a href="venda-listar.php">
                        <div class="panel-footer branco">
                            <span class="pull-left">Ver Vendas</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8">
            </div>
            <!-- /.col-lg-8 -->
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-bell fa-fw"></i> Notifications Panel
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <i class="fa fa-comment fa-fw"></i> New Comment
                                <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-envelope fa-fw"></i> Message Sent
                                <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-tasks fa-fw"></i> New Task
                                <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small"><em>11:32 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                <span class="pull-right text-muted small"><em>11:13 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                <span class="pull-right text-muted small"><em>10:57 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                <span class="pull-right text-muted small"><em>9:49 AM</em>
                                </span>
                            </a>
                            <a href="#" class="list-group-item">
                                <i class="fa fa-money fa-fw"></i> Payment Received
                                <span class="pull-right text-muted small"><em>Yesterday</em>
                                </span>
                            </a>
                        </div>
                        <!-- /.list-group -->
                        <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->



                <!-- /.panel .chat-panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
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