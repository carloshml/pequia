<?php
session_start();
require_once('../controllers/produto-controller.php');
require_once('../dao/venda-dao.php');
require_once('componente-login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Pequia - Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script src="../assets/js/script-local.js"></script>
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --info: #7209b7;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --gradient-start: #4361ee;
            --gradient-mid: #3a0ca3;
            --gradient-end: #1aad95ff;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg, var(--gradient-start), var(--gradient-mid), var(--gradient-end));
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
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

        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .main-container {
            padding-top: 8em;
            padding-bottom: 3em;
        }

        .page-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .dashboard-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.15);
        }

        .card-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
        }

        .card-footer {
            background: rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1.25rem;
        }

        .card-footer a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .card-footer a:hover {
            color: var(--success);
            transform: translateX(5px);
        }

        .notification-panel {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .notification-header {
            background: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }

        .notification-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.2s ease;
        }

        .notification-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        .btn-modern {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .floating-element {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            z-index: -1;
        }

        .floating-1 {
            top: 15%;
            left: 5%;
            animation: float 6s ease-in-out infinite;
        }

        .floating-2 {
            bottom: 20%;
            right: 5%;
            animation: float 8s ease-in-out infinite;
        }

        .floating-3 {
            top: 40%;
            right: 20%;
            animation: float 7s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(10deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }

        @media (max-width: 768px) {
            .main-container {
                padding-top: 7em;
            }
            
            .page-title {
                font-size: 1.1rem;
            }
            
            .dashboard-card {
                margin-bottom: 1.5rem;
            }
            
            .floating-element {
                display: none;
            }
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

<body id="page-top">
    <!-- Floating elements for visual interest -->
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    <div class="floating-element floating-3"></div>
    
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-seedling me-2"></i>Pequiá
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" 
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isset($_SESSION['usuario_nome'])) {
                        echo ' 
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link" href="home.php">
                                <i class="fas fa-home me-1"></i> Home
                            </a>
                        </li> 
                        <li class="nav-item mx-0 mx-lg-1">
                            <a class="nav-link" href="../controllers/sair.php">
                                <i class="fas fa-sign-out-alt me-1"></i> Sair
                            </a>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container main-container">
        <div class="text-center mb-5">
            <h3 class="page-title">Gerencie seus produtos, usuários e vendas de forma intuitiva <i class="fas fa-rocket ms-2"></i></h3>
           
        </div>
        
        <!-- Stats Cards Row -->
        <div class="row g-4 mb-5">
            <!-- Products Card -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="card-title">Total de Produtos</div>
                    <div class="card-value">
                        <?php
                        $produto_dao = new ProdutoController();
                        echo $produto_dao->numeroTotal();
                        ?>
                    </div>
                    <div class="card-footer">
                        <a href="produtos-modulo.php">
                            <span class="me-2">Gerenciar Produtos</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Users Card -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-title">Total de Usuários</div>
                    <div class="card-value">
                        <span id="id-usuario">0</span>
                    </div>
                    <div class="card-footer">
                        <a href="usuarios-modulo.php">
                            <span class="me-2">Gerenciar Usuários</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Sales Card -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card text-center p-4">
                    <div class="card-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-title">Total de Vendas</div>
                    <div class="card-value">
                        <?php
                        $venda_dao = new VendaDAO();
                        echo $venda_dao->numeroTotal();
                        ?>
                    </div>
                    <div class="card-footer">
                        <a href="venda-listar.php">
                            <span class="me-2">Ver Todas as Vendas</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Action Buttons -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <a href="produto-cadastrar.php" class="btn btn-modern me-3">
                    <i class="fas fa-plus-circle me-2"></i> Cadastrar Novo Produto
                </a>
                <a href="venda-listar.php" class="btn btn-modern me-3">
                    <i class="fas fa-list me-2"></i> Ver Relatório de Vendas
                </a>
                <a href="usuarios-modulo.php" class="btn btn-modern">
                    <i class="fas fa-user-cog me-2"></i> Gerenciar Usuários
                </a>
            </div>
        </div>
        
        <!-- Notifications Panel -->
        <div class="row">
            <div class="col-lg-8">
                <!-- You can add charts or other content here in the future -->
            </div>
            <div class="col-lg-4">
                <div class="notification-panel">
                    <div class="notification-header">
                        <i class="fas fa-bell me-2"></i> Notificações Recentes
                    </div>
                    <div class="notification-body">
                        <div class="notification-item">
                            <i class="fas fa-comment me-2"></i> Novo comentário
                            <span class="d-block small text-muted">Há 4 minutos</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-shopping-cart me-2"></i> Novo pedido realizado
                            <span class="d-block small text-muted">Há 12 minutos</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-user me-2"></i> Novo usuário registrado
                            <span class="d-block small text-muted">Há 27 minutos</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-tasks me-2"></i> Tarefa concluída
                            <span class="d-block small text-muted">Há 43 minutos</span>
                        </div>
                        <div class="notification-item">
                            <i class="fas fa-exclamation-circle me-2"></i> Relatório gerado
                            <span class="d-block small text-muted">Ontem às 11:32</span>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-modern btn-sm">Ver Todas as Notificações</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap core JavaScript -->
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