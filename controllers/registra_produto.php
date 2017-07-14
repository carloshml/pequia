<?php
session_start();
//Convoca a classe de Conexão ao Bando de Dados e efetua a conexão.
require_once('../model/bd.class.php');
//Declara variáveis com dados do formulário
$produto = $_POST['produto'];
$subtitulo = $_POST['subtitulo'];
$descricao = $_POST['descricao'];
$tag1 = $_POST['tag1'];
$tag2 = $_POST['tag2'];
$tag3 = $_POST['tag3'];
$tag4= $_POST['tag4'];
$tag5 = $_POST['tag5'];
$id_usuario = $_SESSION['id_usuario'];


//Insere dados de novo usuário na tabela.

$objBd = new bd();
$link = $objBd->conecta_mysql();
    if($_FILES['imagem']['error']!=0){
      echo 'erro no upload da imagem';
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
      $sql =  "INSERT INTO produtos( titulo, subtitulo, localFoto, descricao, tag1, tag2, tag3, tag4, tag5, id_autor_publicacao)
      VALUES ('$produto','$subtitulo','$nome_final','$descricao','$tag1','$tag2','$tag3','$tag4','$tag5',$id_usuario)";
      // execultar a query ;
      if (mysqli_query($link,$sql)){
        echo "<script type=\"text/javascript\">;
                    alert('Produto cadastrado com sucesso');
                </script>" ;
        header('Location: ../pages/publicar.php');
      }else{
        echo "<script type=\"text/javascript\">;
                    alert('Produto Não Foi cadastrado');
                </script>" ;
              echo $descricao;
      }

    }

  ?>
