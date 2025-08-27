<?php
session_start();
include_once('../controllers/vendas-dao.php');
include_once('componentes.php');

$venda_id = 0;
if ($_GET['venda_id']) {
    $venda_id = $_GET['venda_id'];
}
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
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            if (!localStorage.getItem('usuario_nome')) {
                window.location.href = '../index.php?erro=1';
            }
        });
    </script>
</head>


<body id="page-top">
    <!-- Navigation-->
    <script>
        const a = document.getElementById('page-top').innerHTML;
        document.getElementById('page-top').innerHTML = nav() + a;
    </script>
    <div class="container mt-4">
        <div class="row align-items-center mb-4">
            <!-- Título da página -->
            <div class="col-md-6 col-sm-12">
                <h1 class="mb-0">Venda</h1>
            </div>

            <!-- Formulário de alteração de status -->
            <div class="col-md-6 col-sm-12 text-md-right mt-2 mt-md-0">
                <form id="alterar-status" action="../controllers/venda-atualizar-status.php" method="POST"
                    class="form-inline justify-content-md-end">
                    <input type="hidden" name="venda_id" value="<?php echo htmlspecialchars($venda_id); ?>">

                    <label for="status" class="mr-2">Alterar Status:</label>
                    <select name="status" id="status" class="form-control mr-2">
                        <option value="ABERTA">ABERTA</option>
                        <option value="FECHADA">FECHADA</option>
                        <option value="CANCELADA">CANCELADA</option>
                    </select>

                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </form>
            </div>
        </div>

        <!-- Conteúdo da venda -->
        <div>
            <?php
            $vendaDAO = new VendaDAO();
            $vendaDAO->buscarVenda($venda_id);
            ?>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Bootstrap core JS -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
</body>

</html>