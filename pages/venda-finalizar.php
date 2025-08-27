<?php
session_start();
include_once('componente-login.php');
include_once('../config/bd.class.php');
include_once('../controllers/produto_dao.php');

$retorno = $_SESSION['vendas'];
if ($retorno) {
    $vendas = unserialize($retorno);
} else {
    $vendas = array();
}

$nome_produto = '';
$id_produto = null;
if (!empty($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
}
if (!empty($_GET['nome_produto'])) {
    $nome_produto = $_GET['nome_produto'];
}

$vendasJson = json_encode($vendas);
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
            const produtos = <?= $vendasJson ?>;
            let produtosEscrito = '<div class="row">';

            produtos.forEach(element => {
                produtosEscrito += `
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">${element.titulo}</h5>
                    <p><strong>Quantidade:</strong></p>
                    <div class="d-flex align-items-center mb-2">
                        <input type="text" class="form-control mr-2" style="width: 80px;" value="${element.quantidade}" readonly>
                        <form method="post" action="../controllers/adicionar_venda_item.php?id_produto=${element.id_produto}&preco_venda=${element.preco_venda}&com_abrir_compra=1&ir_para=2&titulo=${element.titulo}">
                            <input type="hidden" name="quantidade" value="-1">
                            <button class="btn btn-outline-danger mr-1"><i class="fas fa-minus"></i></button>
                        </form>
                        <form method="post" action="../controllers/adicionar_venda_item.php?id_produto=${element.id_produto}&preco_venda=${element.preco_venda}&com_abrir_compra=1&ir_para=2&titulo=${element.titulo}">
                            <input type="hidden" name="quantidade" value="1">
                            <button class="btn btn-outline-success"><i class="fas fa-plus"></i></button>
                        </form>
                    </div>
                    <p><strong>Total:</strong> R$ ${trunc10(element.vl_total, -2)}</p>
                </div>
            </div>
        </div>`;
            });

            produtosEscrito += '</div>';
            produtosEscrito += `
        <div class="form-group mt-4">
            <label for="observacao_venda"><strong>Observação:</strong></label>
            <textarea id="observacao_venda" name="observacao_venda" class="form-control" rows="4"></textarea>
        </div>
    `;

            document.getElementById('descricao_compra').innerHTML = produtosEscrito;
        });
    </script>
</head>


<body id="page-top">
    <!-- Navigation-->
    <script>
        const a = document.getElementById('page-top').innerHTML;
        document.getElementById('page-top').innerHTML = nav() + a;
    </script>
    <div class="container">
        <form method="post" action="../controllers/venda-adicionar.php">
            <h4> Compra: </h4>
            <div id="descricao_compra"> </div>
            <div class="pra-direita">
                <button type="submit" style="border:1px solid white" class="btn btn-success branco">
                    Finalizar
                </button>
            </div>
        </form>
    </div>

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
    <!-- Bootstrap core JavaScript -->
    <!-- Bootstrap core JS -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
    <!-- MODAL-->
    <?php
    $produto_dao = new Componente();
    $produto_dao->modalLogin();
    ?>
</body>

</html>