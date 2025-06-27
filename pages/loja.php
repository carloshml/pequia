<?php
include_once('../controllers/produto_dao.php');
include_once('componentes.php');
session_start();
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
$mesangem = isset($_GET['mesangem']) ? $_GET['mesangem'] : '';
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
        document.addEventListener("DOMContentLoaded", function() {
            const mesangem = <?= $mesangem ? $mesangem : '\'\'' ?>;
            const elementoAviso = document.getElementById('corpo_aviso');
            let corpoAviso = '';
            if (mesangem === 'sucessoCompra') {
                corpoAviso += '<div>Parabéns sua compra foi finalizada!</div>';
                elementoAviso.innerHTML = corpoAviso;
                elementoAviso.style.display = 'block';
                setTimeout(() => {
                    elementoAviso.style.display = 'none';
                }, 2000);
            }
            $('#btn_login').click(function() {
                const usuarioNovo = $('#form-login').serialize();
                $.ajax({
                    url: `${obterAPI()}controllers/validar_acesso.php`,
                    method: 'post',
                    data: usuarioNovo + '&tipo=CLIENTE',
                    success: function(data) {
                        if (data.includes('erro')) {
                            $('#mensagem-login').html('Usuário ou senha incorretos');
                        } else {
                            document.location.reload(true);
                            //   window.location.href = data;
                        }
                    }
                });
            });
        });
    </script>
</head>

<body id="page-top">
    <div style="position: relative;">
        <div id="corpo_aviso" class="corpo-aviso" style="display: none;"> </div>
    </div>
    <!-- Navigation-->
    <script>
        const a = document.getElementById('page-top').innerHTML;
        document.getElementById('page-top').innerHTML = nav() + a;
    </script>
    <!--Produtos da Loja-->
    <section>
        <div class="container " block>
            <div class="col-lg-12  text-center">
                <h2 class="section-heading"> Escolha o Seu Produto de Hoje </h2>
            </div>
            <hr>
            <?php
            $produto_dao = new ProdutoDAO();
            $produto_dao->buscarProdutosLoja();
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
    <?php
    $produto_dao = new Componente();
    $produto_dao->modalLogin();
    ?>
</body>

</html>