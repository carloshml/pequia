<?php
     include 'model/bd.class.php';
     $id_produto = null;
    if(!empty($_GET['id_produto'])) {   
        $id_produto = $_GET['id_produto'];   
    }    
    class ProdutoDAO{  
            public function buscarProdutos($id_produto){         

                try {					
                    $pdo = Banco::conectar();
                    $sql = "SELECT  id,  tag1, tag2, tag3, descricao, subtitulo, titulo, localFoto "
                    ." FROM produtos where id = ?;";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(array($id_produto));
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
                            echo '            <h1  class="cor-laranja center">'.$titulo.'</h1>';
                            echo    '           <a href="#">';
                            echo     '            <img class="img-responsive" height="300px" width="550px" src="/fotos/'.$localFoto.'">';
                            echo     '           </a>';

                            echo '            <p> '.$descricao.'</p>';
                            echo ' <div>Detalhes</div>';
                            echo '<ul>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag1.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag2.' </li>';
                            echo                '<li  class="glyphicon glyphicon-chevron-right">'.$tag3.' </li>';
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

    <div class="row">
        <div class="col-1">
        </div>
        <div class="col">
            <?php 
               $produto = new ProdutoDAO();
               $produto->buscarProdutos($id_produto);
            ?>
        </div>
    </div>

</body>

</html>