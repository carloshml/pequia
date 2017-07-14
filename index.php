<?php
$erro = isset($_GET['erro']) ? $_GET['erro'] : 0 ;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pequiá</title>

  <!-- Bootstrap Core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

  <!-- Plugin CSS -->
  <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

  <!-- Theme CSS -->
  <link href="css/creative.min.css" rel="stylesheet">
  <!-- Theme CSS -->
  <link href="css/dashboard.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body id="page-top">

  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
        </button>
        <a class="navbar-brand page-scroll" href="#page-top">Pequiá-Artesanatos Brasileiros</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class="page-scroll" href="#about">Sobre</a>
          </li>
          <li>
            <a class="page-scroll" href="#portfolio">Comunidades</a>
          </li>
          <li>
            <a class="page-scroll" href="#contact">Contato</a>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
  </nav>

  <header>
    <div class="header-content">
      <div class="header-content-inner">
        <h1 id="homeHeading">PEQUIÁ-Artesanatos brasileiros  </h1>
        <hr>
        <p>O artesanato é parte do patrimônio cultural de povos e comunidades brasileiras, representando suas tradições, costumes e as diversidades naturais.

          Aqui você encontra um Brasil de respeito e valorização da produção local.

          Sua decisão de compra ajuda a fomentar a economia local e a manutenção dos povos em seu ambiente de origem.
        </p>
        <a href="loja.php" class="btn btn-primary btn-xl page-scroll">Catálogo</a>
      </div>
    </div>
  </header>

  <section class="bg-primary" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center">
          <h2 class="section-heading">Artesanato pra você </h2>
          <hr class="light">
          <p class="text-faded">
            O  artesanato   é   parte  do  patrimônio   cultural de  povos   e   comunidades, pois
            representa as suas tradições, costumes e preservam conhecimentos e técnicas
            populares. Além   de   ter   papel   relevante  na   preservação   da  riqueza   da   arte
            tradicional   e   de   saberes   populares,   o   artesanato   é   um   recurso   para   o
            desenvolvimento   econômico   de   muitas   famílias   brasileiras.   O   artesanato
            brasileiro   é   muito   diversificado,   principalmente   devido   à   pluralidade   cultural
            existente   no   país,   influenciada   por   diferentes   povos:   indígenas,   africanos,
            europeus e asiáticos. Seus materiais exploram também a diversidade natural,
            utilizando diferentes recursos.

          </p>
        </div>
      </div>
    </div>
  </section>



  <section class="no-padding" id="portfolio">
    <div class="container-fluid">
      <div class="row no-gutter popup-gallery">
        <div class="col-lg-4 col-sm-6">
          <a href="img/portfolio/fullsize/1.jpg" class="portfolio-box">
            <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="">
            <div class="portfolio-box-caption">
              <div class="portfolio-box-caption-content">
                <div class="project-category text-faded">
                  Categoria
                </div>
                <div class="project-name">
                  Nome do Projeto
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-6">
          <a href="img/portfolio/fullsize/2.jpg" class="portfolio-box">
            <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
            <div class="portfolio-box-caption">
              <div class="portfolio-box-caption-content">
                <div class="project-category text-faded">
                  Categoria
                </div>
                <div class="project-name">
                  Nome do Projeto
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-4 col-sm-6">
          <a href="img/portfolio/fullsize/3.jpg" class="portfolio-box">
            <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
            <div class="portfolio-box-caption">
              <div class="portfolio-box-caption-content">
                <div class="project-category text-faded">
                  Categoria
                </div>
                <div class="project-name">
                  Nome do Projeto
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 text-center">
          <h2 class="section-heading">Nossos Contatos</h2>
          <hr class="primary">
          <p>Pronto pra comprar biojoias conosco, nos ligue ou envie um e-mail. </p>
        </div>
        <div class="col-lg-4 col-lg-offset-2 text-center">
          <i class="fa fa-phone fa-3x sr-contact"></i>
          <p>(63) 3554-8989</p>
        </div>
        <div class="col-lg-4 text-center">
          <i class="fa fa-envelope-o fa-3x sr-contact"></i>
          <p><a href="mailto:your-email@your-domain.com">pequia@yahoo.com</a></p>
        </div>
      </div>
    </div>
  </section>
  <footer >
    <nav class="nav text-right">
      <a href="#"  role="button" data-toggle="modal" data-target="#login-modal">login</a>
    </nav>
  </footer>
  <!-- BEGIN # MODAL LOGIN -->
  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" align="center">
          <img class="" id="img_logo" src="img/logo.png">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </button>
        </div>

        <!-- Begin # DIV Form -->
        <div id="div-forms">

          <!-- Begin # Login Form -->
          <form method="post" action="validar_acesso.php" id="formLogin">
            <div class="modal-body">
              <div id="div-login-msg">
                <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                <span id="text-login-msg">Escreva seu usuário e senha.</span>
              </div>
              <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
              <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
              </div>

            </div>
          </form>
          <!-- End # Login Form -->

          <!-- Begin | Lost Password Form -->
          <form id="lost-form" style="display:none;">
            <div class="modal-body">
              <div id="div-lost-msg">
                <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
                <span id="text-lost-msg">Type your e-mail.</span>
              </div>
              <input id="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
            </div>
            <div class="modal-footer">
              <div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
              </div>
              <div>
                <button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
                <button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
              </div>
            </div>
          </form>
          <!-- End | Lost Password Form -->

          <!-- Begin | Register Form -->
          <form id="register-form" style="display:none;">
            <div class="modal-body">
              <div id="div-register-msg">
                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                <span id="text-register-msg">Register an account.</span>
              </div>
              <input id="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
              <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
              <input id="register_password" class="form-control" type="password" placeholder="Password" required>
            </div>
            <div class="modal-footer">
              <div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
              </div>
              <div>
                <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
              </div>
            </div>
          </form>
          <!-- End | Register Form -->

        </div>
        <!-- End # DIV Form -->

      </div>
    </div>
  </div>
  <!-- END # MODAL LOGIN -->

  <!-- jQuery -->
  <script src="vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
  <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

  <!-- Theme JavaScript -->
  <script src="js/creative.min.js"></script>

</body>

</html>
