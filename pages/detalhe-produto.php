<?php
    include_once('../config/bd.class.php'); 
     $nome_produto = '';
     $id_produto = null;
    if(!empty($_GET['id_produto'])) {   
        $id_produto = $_GET['id_produto'];   
    }
    if(!empty($_GET['nome_produto'])) {   
        $nome_produto = $_GET['nome_produto'];   
    }  
    class ProdutoDAO{          
            public function buscarProduto($id_produto){      

                $id= null;                                        
                $tag1 = null; 
                $tag2= null; 
                $tag3= null; 
                $tag4= null; 
                $tag5= null;
                $descricao= null; 
                $subtitulo= null; 
                $titulo= null; 
                $localFoto= null; 
                $data_publicacao= null; 
                $nome_autor= null; 

                try {					
                    $pdo = Banco::conectar();
                    $sql = "SELECT  id,  tag1, tag2, tag3, tag4, tag5, descricao, subtitulo, titulo, localFoto "
                    ." FROM produtos where id = ?;";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($id_produto));
                    $stmt->bindColumn('id', $id );	
                    $stmt->bindColumn('tag1', $tag1 );	
                    $stmt->bindColumn('tag2', $tag2 );							
                    $stmt->bindColumn('tag3', $tag3);
                    $stmt->bindColumn('tag4', $tag4 );							
                    $stmt->bindColumn('tag5', $tag5);
                    $stmt->bindColumn('descricao', $descricao );	
                    $stmt->bindColumn('subtitulo', $subtitulo );							
                    $stmt->bindColumn('titulo', $titulo);
                    $stmt->bindColumn('localFoto', $localFoto);
                        while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                            $array = array(  
                                "id" => $id,                                            
                                "tag1" => $tag1,
                                "tag2" =>  $tag2,
                                "tag3" => $tag3,
                                "tag4" =>  $tag4,
                                "tag5" => $tag5,
                                "descricao" => $descricao,
                                "subtitulo" =>  $subtitulo,
                                "titulo" => $titulo, 
                                "localFoto" => $localFoto
                            );
                        
                            echo '    <div style="text-align:center" >';
                            echo '            <h1  class="cor-laranja center">'.$titulo.'</h1>';
                            echo '            <img loading="lazy" class="img-responsive" height="400px"  src="/fotos/'.$localFoto.'">';
                            echo '   </div>';
                            echo '    <p> '.$descricao.'</p>';
                            echo '    <div>Detalhes</div>';
                            echo '<ul>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag1.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag2.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag3.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag4.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag5.' </li>';
                            echo '</ul>';  
                            echo     '    <hr>';                  
                        }			
                    }catch (PDOException $e) {
                        print $e->getMessage();
                    }
                    Banco::desconectar();  
            }          
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $nome_produto  ?></title>
    <!-- Bootstrap core CSS -->
    <link href="../assets/bootstrap-4.5.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/fontawesome-free-5.15.1-web/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet" />
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
                </ul>
            </div>
        </div>
    </nav>
    <header  class="masthead" style="height: 0; min-height: 0;" > </header>

    <section>
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col">
                <?php 
               $produto = new ProdutoDAO();
               $produto->buscarProduto($id_produto);
            ?>
            </div>
            <div class="col-2">
            </div>
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
</body>

</html>