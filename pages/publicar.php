<?php
session_start();
if (!isset($_SESSION['usuario'])){
  header('Location: ../index.php?erro=1');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home</title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.css" rel="stylesheet">
    <!--load all styles -->
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/creative.min.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Pequia</a>
            <div class="form-inline">
                <a href="index.php">Dash boasrd </a>
                <a href="publicar.php">publicar Prod </a>
                <a href="sair.php"> Logout </a>
            </div>
        </nav>


        <h1 class="page-header">Publicar Produto</h1>
        <div class="container">
            <div class="row">
                <div class="col-1">
                </div>
                <div class="col">
                    <form method="post" action="../controllers/registra_produto.php" id="formCadastrarse"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Escreva o Nome do Produto</label>
                            <input name="produto" class="form-control" required>
                            <p class="help-block">Pode ser o nome do produto</p> 
                        </div>
                        <div class="form-group">
                            <label>Escreva um Subtítulo</label>
                            <input name="subtitulo" class="form-control">
                            <p class="help-block">Será a frase abaixo do título</p>
                        </div>
                        <div class="form-group">
                            <label>Selecione Uma Foto</label>
                            <input name="imagem" type="file" required>
                        </div>
                        <div class="form-group">
                            <label>Fale sobre o Produto</label>
                            <textarea name="descricao" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tag 1</label>
                            <input name="tag1" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 2</label>
                            <input name="tag2" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 3</label>
                            <input name="tag3" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 4</label>
                            <input name="tag4" class="form-control" placeholder="classifique uma tag">
                        </div>
                        <div class="form-group">
                            <label>Tag 5</label>
                            <input name="tag5" class="form-control" placeholder="classifique uma tag">
                        </div>

                        <button type="submit" class="btn btn-primary">Publicar</button>
                        <button type="reset" class="btn btn-primary">Limpar Campos</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->
        <!-- Bootstrap core JavaScript -->
        <script src="../assets/js/jquery-3.5.1.min.js"></script>
        <script src="../assets/bootstrap-4.5.3-dist/js/bootstrap.min.js"></script>
        <script src="../assets/fontawesome-free-5.15.1-web/js/all.js"> </script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>

</body>

</html>