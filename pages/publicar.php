<?php
    include_once('../controllers/produto_dao.php');
    $temEditar = 0;
    $response = '';
    session_start();
    if (!isset($_SESSION['usuario_login'])){
       header('Location: ../index.php?erro=1');
    }

    if(!empty($_GET['id_produto'])) {   
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Publicar Produto</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const resposta = <?=$response?>;
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

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="home.php">Pequia</a>
            <div class="form-inline">
                <a href="home.php" class="btn btn-outline-secondary">Dashboard </a>
                <a href="publicar.php" class="btn btn-outline-secondary">Publicar </a>
                <a href="../controllers/sair.php" class="btn btn-outline-warning"> <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </nav>
        <h1 class="page-header">Publicar Produto</h1>
        <div class="container">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col">
                    <form method="post"
                        action="../controllers/registra_produto.php?temEdicao=<?=$temEditar?>&id_produto=<?=$id_produto?>"
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
                                <input name="imagem" type="file" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fale sobre o Produto</label>
                            <textarea id="descricao" name="descricao" maxlength="250" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Preço: </label>
                            <input id="preco_venda" name="precovenda" maxlength="7" class="form-control">
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