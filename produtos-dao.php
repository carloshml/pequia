<?php
    include 'config/bd.class.php';
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
                      echo '<div class="row">';
                      echo '     <div class="col-lg-7 ml-auto">';
                      echo '         <a href="#">';
                      echo '            <img class="img-responsive" height="300px" width="550px" src="/fotos/'.$localFoto.'">';
                      echo '           </a>';
                      echo '      </div>';
                      echo '  <div class="col-lg-5 ml-auto">';
                      echo '            <a href="detalhe-produto.php?id_produto='.$id.'&nome_produto='.$titulo.'& class="cor-laranja ">'.$titulo.'</a>';
                      echo '            <h4>'.$subtitulo.'</h4>';
                      echo '            <p> '.$descricao.'</p>';
                      echo '            <ul>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag1.' </li>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag2.' </li>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag3.' </li>';
                      echo '            </ul>';                
                      echo '</div>';  
                      echo '</div>';                   
                      echo '<hr class="divider my-4" />';                  
                  }			
              }catch (PDOException $e) {
                  print $e->getMessage();
              }
              Banco::desconectar();  
     } 

     public function buscarProdutosParaEdicao(){         
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
                      echo '<div class="row">';
                      echo '     <div class="col-md-7">';
                      echo '         <a href="#">';
                      echo '            <img class="img-responsive" height="300px" width="550px" src="/fotos/'.$localFoto.'">';
                      echo '           </a>';
                      echo '      </div>';
                      echo '  <div class="col-md-5">';
                      echo '            <a href="publicar.php?id_produto='.$id.'%& class="cor-laranja ">'.$titulo.'</a>';
                      echo '            <h4>'.$subtitulo.'</h4>';
                      echo '            <p> '.$descricao.'</p>';
                      echo '            <ul>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag1.' </li>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag2.' </li>';
                      echo '                <li  class="glyphicon glyphicon-chevron-right">'.$tag3.' </li>';
                      echo '            </ul>';                
                      echo '</div>';  
                      echo '</div>';                   
                      echo '<hr class="divider my-4" />';                  
                  }			
              }catch (PDOException $e) {
                  print $e->getMessage();
              }
              Banco::desconectar();  
     } 

     public function buscarProdutosTelaInicial(){         
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
               echo '<div class="row">';
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
                   
                      echo '   <div class="col-md-3"'
                            .'style="background:#ffd6cb; color:white !important; padding: 5px 10px; margin: 19px 2px; height:120px " >';
                      echo '        <a href="detalhe-produto.php?id_produto='.$id.'%& class="cor-laranja">'.$titulo.'</a>';   
                      echo '   </div>';                      
                                   
                  }	
                  echo '</div>';                                  
              		
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