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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home-Loja Pequia</title>

  <!-- Bootstrap Core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- MetisMenu CSS -->
  <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Morris Charts CSS -->
  <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


  <!-- Carlos Casca CSS -->
  <link href="../css/dashboard.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Seja Bem Vindo</a>
      </div>
      <!-- /.navbar-header -->

      <ul class="nav navbar-top-links navbar-right">

        <!-- /.dropdown -->
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu dropdown-user">
            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
            </li>
            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
            </li>
            <li class="divider"></li>
            <li><a href="sair.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
            </li>
          </ul>
          <!-- /.dropdown-user -->
        </li>

        <!-- /.dropdown -->

        <!-- /.dropdown -->

        <!-- /.dropdown -->
      </ul>
      <!-- /.navbar-top-links -->

      <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <ul class="nav" id="side-menu">
            <li class="sidebar-search">
              <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
              <!-- /input-group -->
            </li>
            <li>
              <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
              <a href="publicar.php"><i class="fa fa-dashboard fa-fw"></i> Publicar Produto</a>
            </li>
          </ul>
        </div>
        <!-- /.sidebar-collapse -->
      </div>
      <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
      <div class="row">
        <div class="col-lg-12">
          <h1 class="page-header">Publicar Produto</h1>
        </div>
        <!-- /.col-lg-12 -->
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                  <form method="post" action="../controllers/registra_produto.php" id="formCadastrarse" enctype="multipart/form-data">
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
                        <label  >Selecione Uma Foto</label>
                        <input name="imagem"  type="file" required>
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
                        <input name="tag5"class="form-control" placeholder="classifique uma tag">
                      </div>

                      <button type="submit" class="btn btn-default">Publicar</button>
                      <button type="reset" class="btn btn-default">Limpar Campos</button>
                    </form>
                  </div>

                </div>
                <!-- /.row (nested) da
              </div>
              <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-lg-12 -->
        </div>


        <!-- /#page-wrapper -->

      </div>
    </div>
  </div>
  <!-- /#wrapper -->

  <!-- jQuery -->
  <script src="../vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="../vendor/metisMenu/metisMenu.min.js"></script>

  <!-- Morris Charts JavaScript -->
  <script src="../vendor/raphael/raphael.min.js"></script>
  <script src="../vendor/morrisjs/morris.min.js"></script>
  <script src="../data/morris-data.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
