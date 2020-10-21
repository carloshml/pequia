<?php
    include 'produtos-dao.php';
    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0 ;   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Produtos</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">

    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            console.log('pronto');
        }, 600);
    });
    </script>

    <style type="text/css">
    a:link {
        color: #f24516;
        text-decoration: none;
    }

    a:visited {
        color: #f24516;
        text-decoration: none;
    }

    a:hover {
        color: #f24516;
        text-decoration: underline;
    }

    a {
        font-size: 26px;
    }

    a:active {
        color: #f24516;
        text-decoration: underline;
        background-color: #000000;
    }
    </style>
</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Pequia</a>
        <div class="form-inline">

        </div>
    </nav>
    <!--Produtos da Loja-->
    <section>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12  text-center">
                    <h2 class="section-heading"> Produtos </h2>
                </div>
                <div class="container " block>
                    <div class="row">
                        <div class="col-md-10" id="produtos" name="produtos">
                            <?php
                                        $produto_dao = new ProdutoDAO();
                                        $produto_dao->buscarProdutos();                                         
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <hr class="divider my-4" />
                    <h2 class="section-heading">Nossos Contatos</h2>
                    <hr class="divider my-4" />
                    <p class="mb-5">Pronto pra comprar biojoias conosco, nos ligue ou envie um e-mail.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center">
                    <i class="fa fa-phone fa-3x mb-3 sr-contact"></i>
                    <p>(63) 3554-8989</p>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fa fa-envelope-o fa-3x mb-3 sr-contact"></i>
                    <p>
                        <a href="mailto:your-email@your-domain.com">pequia@yahoo.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap core JavaScript -->
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
    <script src="assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>