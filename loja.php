<?php
    include 'model/bd.class.php';
    class ProdutoDAO{  
     public function buscarProdutos(){         
        try {					
            $pdo = Banco::conectar();
            $sql = "SELECT  id,  tag1, tag2, tag3, descricao, subtitulo, titulo, localFoto "
            ." FROM produtos   ORDER BY produtos.id DESC limit  5;";
            $stmt = $pdo->prepare($sql);
               $stmt->execute();
               $stmt->bindColumn('id', $id );	
               $stmt->bindColumn('tag1', $tag1 );	
               $stmt->bindColumn('tag2', $tag2 );							
               $stmt->bindColumn('tag3', $tag3);
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
                        "descricao" => $descricao,
                        "subtitulo" =>  $subtitulo,
                        "titulo" => $titulo, 
                        "localFoto" => $localFoto
                      );
                      echo    '  <div class="row">';
                      echo    '       <div class="col-md-7">';
                      echo    '           <a href="#">';
                      echo     '            <img class="img-responsive" height="300px" width="550px" src="/fotos/'.$localFoto.'">';
                      echo     '           </a>';
                      echo    '       </div>';
                      echo '          <div class="col-md-5">';
                      echo '            <a href="detalhe-produto.php?id_produto='.$id.'¨%& class="cor-laranja">'.$titulo.'</a>';
                      echo '            <h4>'.$subtitulo.'</h4>';
                      echo '            <p> '.$descricao.'</p>';
                      echo '<ul>';
                      echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag1.' </li>';
                      echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag2.' </li>';
                      echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag3.' </li>';
                      echo '</ul>';                
                      echo     '    </div>';  
                      echo     '    </div>';  
                      echo     '    <hr>';                  
                  }			
              }catch (PDOException $e) {
                  print $e->getMessage();
              }
              Banco::desconectar();  
     } 
     
     public function abrirProduto($id_produto){  
        header('Location: detalhe-produto.php?id_produto='.$id_produto);
     }
  }
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
</head>

<body id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Pequia</a>
        <div class="form-inline">
            <a class="btn   my-2 my-sm-0">Search</a>
            <a class="btn   my-2 my-sm-0">Search</a>
        </div>
    </nav>
    <!--Produtos da Loja-->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header  cor-laranja">Produtos</h1>
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
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading cor-laranja">Nossos Contatos</h2>
                    <hr class="primary">
                    <p>Pronto pra comprar biojoias conosco, nos ligue ou envie um e-mail. </p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
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