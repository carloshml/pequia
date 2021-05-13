<?php
session_start();
if (!isset($_SESSION['usuario_login'])) {
    header('Location: ../index.php?erro=1');
}
include_once('../config/bd.class.php');
include_once('../controllers/vendas-dao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $nome_produto ?></title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script src="../assets/js/script-local.js"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {




        });
    </script>
</head>


<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Pequia <span style="font-size: 14px;"> <?= $usuario_nome ?> </span></a>
        <div class="form-inline">
            <a href="loja.php" class="btn btn-outline-secondary">loja </a>
            <a href="produto-detalhe.php" class="btn btn-outline-secondary">Publicar </a>
            <a href="../index.php" class="btn btn-outline-secondary"> <i class="fas fa-home"></i> </a>
            <a href="../controllers/sair.php" class="btn btn-outline-warning"> <i class="fas fa-sign-out-alt"></i> </a>
        </div>
    </nav>

    <div class="container">
        <h1> Vendas</h1>
        <div>
            <?php
            $vendaDAO = new VendaDAO();
            $vendaDAO->buscarVendas();
            ?>
        </div>
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