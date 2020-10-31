<?php
    include 'config/bd.class.php';

    class Produto{
       public $id;
       public $titulo;
       public $subtitulo;
       public $local;
       public $descricao;
       public $tag1;
       public $tag2;
       public $tag3;
       public $tag4;
       public $tag5;
       public $id_autor_publicacao;
       public $data_publicacao;      
    }

    class ProdutoDAO{  
     public function buscarProdutos(){    
         
        $id= null;                                        
        $tag1 = null; 
        $tag2= null; 
        $tag3= null; 
        $descricao= null; 
        $subtitulo= null; 
        $titulo= null; 
        $localFoto= null; 
        $data_publicacao= null; 
        $nome_autor= null; 
        try {					
            $pdo = Banco::conectar();
            $sql = "  SELECT  usuarios.id,  tag1, tag2, tag3, descricao, subtitulo, titulo, localFoto , data_publicacao ,  usuarios.nome as nome_autor"   
                  ."  FROM produtos inner join usuarios  on   produtos.id_autor_publicacao =  usuarios.id   " 
                  ."  ORDER BY produtos.id DESC limit  6;";

            $stmt = $pdo->prepare($sql);
               $stmt->execute();
               $stmt->bindColumn('id', $id );	
               $stmt->bindColumn('tag1', $tag1 );	
               $stmt->bindColumn('tag2', $tag2 );							
               $stmt->bindColumn('tag3', $tag3);
               $stmt->bindColumn('descricao', $descricao );	
               $stmt->bindColumn('subtitulo', $subtitulo );							
               $stmt->bindColumn('titulo', $titulo);
               $stmt->bindColumn('data_publicacao', $data_publicacao);
               $stmt->bindColumn('nome_autor', $nome_autor);
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
                      echo '<div class="text-right" > publicado por <strong>  '. $nome_autor .' </strong> | '. date('d/m/Y', strtotime($data_publicacao)).'</div>';                  
                      echo '<hr class="divider my-4" />';                  
                  }			
              }catch (PDOException $e) {
                      echo '<hr class="divider my-4" />';  
                      return  $e->getMessage();
              }
              Banco::desconectar();  
     } 

     public function buscarProdutosParaEdicao(){   
        $id= null;                                        
        $tag1 = null; 
        $tag2= null; 
        $tag3= null; 
        $descricao= null; 
        $subtitulo= null; 
        $titulo= null; 
        $localFoto= null;       
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
                      echo '            <a href="publicar.php?id_produto='.$id.'& class="cor-laranja ">'.$titulo.'</a>';
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
        $id= null;                                        
        $tag1 = null; 
        $tag2= null; 
        $tag3= null; 
        $descricao= null; 
        $subtitulo= null; 
        $titulo= null; 
        $localFoto= null;      
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

     public function buscarProdutoPeloId($id){    
        $produto = new Produto();
        try {   
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM produtos where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
             $produto->id = $data['id'] ;
             $produto->titulo = $data['titulo'] ;
             $produto->subtitulo = $data['subtitulo'] ;
             $produto->local = $data['local'] ;
             $produto->descricao = $data['descricao'] ;
             $produto->tag1 = $data['tag1'] ;
             $produto->tag2 = $data['tag2'] ;
             $produto->tag3 = $data['tag3'] ;
             $produto->tag4 = $data['tag4'] ;
             $produto->tag5 = $data['tag5'] ;
             $produto->id_autor_publicacao = $data['id_autor_publicacao'] ;
             return  json_encode($produto);         
            Banco::desconectar();  
        } catch (Exception $e) {
            echo 'Exceção capturada: '.  $e->getMessage(). "\n";
        }
    } 
     
     public function abrirProduto($id_produto){  
        header('Location: detalhe-produto.php?id_produto='.$id_produto);
     }
  }
?>