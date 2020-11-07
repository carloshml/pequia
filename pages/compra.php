<?php
    session_start();  
    include_once('../config/bd.class.php');   
    include_once('../controllers/produto_dao.php');   
     $nome_produto = '';
     $id_produto = null;
    if(!empty($_GET['id_produto'])) {   
        $id_produto = $_GET['id_produto'];   
    }
    if(!empty($_GET['nome_produto'])) {   
        $nome_produto = $_GET['nome_produto'];   
    }  
    $retorno =   $_SESSION['vendas'];  
    if($retorno){
       $vendas =  unserialize($retorno);
    } else {
       $vendas = array();
    }
    $vendasJson =  json_encode($vendas);     
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$nome_produto?></title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <link href="../assets/css/estilo.css" rel="stylesheet" />
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const produtos = <?=$vendasJson?>;
        console.log('produtos', produtos);
        produtosEscrito = '';
        produtos.forEach(element => {
            produtosEscrito +=

                '<form method="post"  action="../controllers/adicionar_venda_item.php?' +
                'id_produto=' + element.id_produto +
                '&preco_venda=' + element.preco_venda +
                '&titulo=' + element.titulo + '">' +
                '<div> Produto: <strong>  ' + element.titulo + ' </strong></div>' +
                '<div> quantade:' +
                '<input  style="display:table-cell; width:25%;" id="quantidade" value="' +
                element.quantidade + '" name="quantidade" class="form-control" required>' +
                '<button class="btn btn-primary"> - </button>' +
                '<button class="btn btn-primary"> + </button>' +
                '</div>' +
                '<div> total:R$' + element.vl_total + '</div>' +
                '</form>' +
                '<hr>';
        });
        document.getElementById('descricao_compra').innerHTML = produtosEscrito;


    });
    </script>
</head>


<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="loja.php">Pequiá</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
                    <li class="nav-item">
                        <a href="../controllers/sair.php"> sair </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <header class="masthead" style="height: 0; min-height: 0;"> </header>

    <div class="container">
        <h4> Compra: </h4>
        <div id="descricao_compra">

        </div>
        <div class="pra-direita">
            <a  style="border:1px solid white" class="btn btn-success branco"> Finalizar </a>
        </div>
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
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="../assets/js/scripts.js"></script>
</body>

</html>