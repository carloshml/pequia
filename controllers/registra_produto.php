<?php
    session_start(); 
    include_once('../config/bd.class.php');
include_once('../config/api-config.php');

    try {
 
    //Declara variáveis com dados do formulário
    $produto = $_POST['produto'];
    $preco_venda = $_POST['precovenda'];
    $subtitulo = $_POST['subtitulo'];
    $descricao = $_POST['descricao'];
    $tag1 = $_POST['tag1'];
    $tag2 = $_POST['tag2'];
    $tag3 = $_POST['tag3'];
    $tag4= $_POST['tag4'];
    $tag5 = $_POST['tag5'];
    $id_usuario = $_SESSION['id_usuario'];  
    $id_produto = $_GET['id_produto']; 
    $temEdicao = $_GET['temEdicao'];   

    if($temEdicao ==  1 ){
      echo "<script type=\"text/javascript\">" 
               ."console.log('tem edicao temEdicaoP ');" 
           ."</script>" ; 

               //Insere dados de novo usuário na tabela.        
          if($_FILES['imagem']['error']!=0){
            echo 'erro no upload da imagem';
            echo "<script type=\"text/javascript\">; 
                  console.log('erro no upload da imagem'); 
                  </script>" ; 
            die();
          }else{
            $arquivo = $_FILES['imagem']['name'];
            //pasta para salvar arquivo;
            $_UP['pasta'] = '../fotos/';
          } 

          $data = getdate();
          $nome_final = $data['hours'].$data['seconds'].$data['minutes'].$_FILES['imagem']['name'];
          //verificar se é possível mover o arquivo para a pasta escolhida
          $query = false ;
          if(move_uploaded_file($_FILES['imagem']['tmp_name'],$_UP['pasta'].$nome_final)){
            //upload afetuado com sucesso
            $pdo = Banco::conectar();  
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE produtos  set "
            ." titulo=?, subtitulo=?, localFoto =?, descricao =?, tag1 =?, tag2 =?, tag3 =?,"
            ." tag4 =?, tag5 =?, id_usuario_publicacao =?, preco_venda =?"
            ." WHERE id = ?";
            $q = $pdo->prepare($sql);
            $result =   $q->execute(array(
              $produto,$subtitulo,$nome_final,$descricao,$tag1,$tag2,$tag3,$tag4,$tag5,
              $id_usuario, $preco_venda,
              $id_produto
            ));
            Banco::desconectar();          
            // execultar a query ;
            if ($result){
              echo "<script type=\"text/javascript\">;
                      console.log('Produto cadastrado com sucesso');
                      </script>" ;
              header('Location: ../pages/produto-detalhe.php');
            }else{
              echo "<script type=\"text/javascript\">;
                      console.log('Produto Não Foi cadastrado');
                      </script>" ;
                    echo  'produto não cadastrado';
                    echo $result;
            }
          }else{
            echo "<script type=\"text/javascript\">; 
            console.log('Não moveu a imagem'); 
            </script>" ; 
            
          }

    } else {
          //Insere dados de novo usuário na tabela.        
          if($_FILES['imagem']['error']!=0){
            echo 'erro no upload da imagem';
            echo "<script type=\"text/javascript\">; 
                  console.log('erro no upload da imagem'); 
                  </script>" ; 
            die();
          }else{
            $arquivo = $_FILES['imagem']['name'];
            //pasta para salvar arquivo;
            $_UP['pasta'] = '../fotos/';
          } 

          $data = getdate();
          $nome_final = $data['hours'].$data['seconds'].$data['minutes'].$_FILES['imagem']['name'];
          //verificar se é possível mover o arquivo para a pasta escolhida
          $query = false ;
          if(move_uploaded_file($_FILES['imagem']['tmp_name'],$_UP['pasta'].$nome_final)){
            //upload afetuado com sucesso
            $sql =  "INSERT INTO produtos( titulo, subtitulo, localFoto, descricao, tag1, tag2, tag3, tag4, tag5,"
            ." id_usuario_publicacao, data_publicacao, preco_venda)
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"; 
            $pdo = Banco::conectar();  
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare($sql);
            $result =  $q->execute(array($produto,$subtitulo,$nome_final,$descricao,
            $tag1,$tag2,$tag3,$tag4,$tag5,
            $id_usuario,  date('Y-m-d H:i:s'), $preco_venda));         
            echo  print_r( $result);
            Banco::desconectar();
            // execultar a query ;
            if ($result){
              echo "<script type=\"text/javascript\">;
                      console.log('Produto cadastrado com sucesso');
                      </script>" ;
              header('Location: ../pages/produto-detalhe.php');
            }else{
              echo "<script type=\"text/javascript\">;
                      console.log('Produto Não Foi cadastrado');
                      </script>" ;
                      echo  'produto não cadastrado';
                    echo $result;
            }
          }else{
            echo "<script type=\"text/javascript\">; 
            console.log('Não moveu a imagem'); 
            </script>" ; 
            
          }
     }


     
       //code...
     } catch (\Throwable $th) {   
      echo 'Exceção capturada: '.  $th->getMessage(). "\n";  
      echo $th;
      echo "<script type=\"text/javascript\">; 
      console.log('Não moveu a imagem'); 
      </script>" ; 
       //throw $th;
     }   
  ?>