<?php
session_start();
include_once('../controllers/produto_dao.php');
include_once('componente-login.php');
$temEditar = 0;
$response = '';
if (!empty($_GET['id_produto'])) {
    $id_produto = $_GET['id_produto'];
    $produto_dao = new ProdutoDAO();
    $response = $produto_dao->buscarProdutoPeloId($id_produto);
    $temEditar = 1;
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
        if (!localStorage.getItem('usuario_nome')) {
            window.location.href = '../index.php?erro=1';
        }
        document.addEventListener("DOMContentLoaded", function () {
            const resposta = <?= $response ?>;
            if (resposta) {
                $('#preco_venda').val(resposta.preco_venda);
                $('#nome_produto').val(resposta.titulo);
                $('#subtitulo').val(resposta.subtitulo);
                $('#descricao').val(resposta.descricao);
                $('#tag1').val(resposta.tag1);
                $('#tag2').val(resposta.tag2);
                $('#tag3').val(resposta.tag3);
                $('#tag4').val(resposta.tag4);
                $('#tag5').val(resposta.tag5);
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
    <div id="wrapper">

        <h1 class="page-header">Publicar Produto</h1>
        <div class="container">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col">
                    <form method="post"
                        action="../controllers/registra_produto.php?temEdicao=<?= $temEditar ?>&id_produto=<?= $id_produto ?>"
                        id="formCadastrarse" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Escreva o Nome do Produto</label>
                            <input id="nome_produto" name="produto" class="form-control" required>
                            <p class="help-block">Pode ser o nome do produto</p>
                        </div>
                        <div class="form-group">
                            <label>Escreva um Subtítulo</label>
                            <input id="subtitulo" name="subtitulo" class="form-control">
                            <p class="help-block">Será a frase abaixo do título</p>
                        </div>
                        <div class="form-group">
                            <label>Selecione Uma Foto</label>
                            <div>
                                <input type="file" id="imagem_file" name="imagem" class="form-control" accept="image/*">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fale sobre o Produto</label>
                            <textarea id="descricao" name="descricao" maxlength="250" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Preço: </label>
                            <input type="number" id="preco_venda" name="precovenda" maxlength="7" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tag 1</label>
                            <input id="tag1" name="tag1" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 2</label>
                            <input id="tag2" name="tag2" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 3</label>
                            <input id="tag3" name="tag3" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 4</label>
                            <input id="tag4" name="tag4" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 5</label>
                            <input id="tag5" name="tag5" class="form-control" placeholder="classifique uma tag">
                        </div>

                        <button type="submit" class="btn btn-primary">Publicar</button>
                        <button type="reset" class="btn btn-primary">Limpar Campos</button>
                    </form>
                </div>
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
        <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <!-- Bootstrap core JS -->
        <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

        <script src="../assets/js/jquery-3.5.1.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js">
        </script>
        <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
        <!-- Core theme JS
     <script src="../assets/js/scripts.js"></script> -->
</body>

</html>