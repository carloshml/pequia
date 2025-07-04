<?php
session_start();
require_once('../config/bd.class.php');
require_once('../config/api-config.php');
try {
  $produto = $_POST['produto'];
  $preco_venda = $_POST['precovenda'];
  $subtitulo = $_POST['subtitulo'];
  $descricao = $_POST['descricao'];
  $tag1 = $_POST['tag1'];
  $tag2 = $_POST['tag2'];
  $tag3 = $_POST['tag3'];
  $tag4 = $_POST['tag4'];
  $tag5 = $_POST['tag5'];
  $id_usuario = $_SESSION['id_usuario'];
  $id_produto = $_GET['id_produto'];
  $temEdicao = $_GET['temEdicao'];
  if ($temEdicao == 1) {
    echo "<script type=\"text/javascript\">"
      . "console.log('tem edicao temEdicaoP ');"
      . "</script>";

    //Insere dados de novo usuário na tabela.        
    if ($_FILES['imagem']['error'] != 0) {
      echo 'erro no upload da imagem';
      echo "<script type=\"text/javascript\">; 
                  console.log('erro no upload da imagem'); 
                  </script>";
      die();
    } else {
      $arquivo = $_FILES['imagem']['name'];
      //pasta para salvar arquivo;
      $_UP['pasta'] = '../fotos/';
    }

    $data = getdate();
    $nome_final = $data['hours'] . $data['seconds'] . $data['minutes'] . $_FILES['imagem']['name'];
    //verificar se é possível mover o arquivo para a pasta escolhida

    $nome_final = '';
    $imagem = $_FILES['imagem'];
    if ($imagem['type'] != NULL) {
      $fileHandle = fopen($_FILES['imagem']['tmp_name'], "rb") or die("Unable to open file!");
    } else {
      echo ' sem imagem ';
    }

    //upload afetuado com sucesso
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE produtos  set "
      . " titulo=?, subtitulo=?, localFoto =?, descricao =?, tag1 =?, tag2 =?, tag3 =?,"
      . " tag4 =?, tag5 =?, id_usuario_publicacao =?, preco_venda =?, fileFoto = ?"
      . " WHERE id = ?";
    $q = $pdo->prepare($sql);
    $result = $q->execute(array(
      $produto,
      $subtitulo,
      $nome_final,
      $descricao,
      $tag1,
      $tag2,
      $tag3,
      $tag4,
      $tag5,
      $id_usuario,
      $preco_venda,
      $id_produto,
      $fileHandle
    ));
    if ($fileHandle) {
      fclose($fileHandle);
    }
    Banco::desconectar();

    if ($result) {
      echo "<script type=\"text/javascript\">;
                      console.log('Produto cadastrado com sucesso');
                      </script>";
      header('Location: ../pages/produto-detalhe.php');
    } else {
      echo "<script type=\"text/javascript\">;
                      console.log('Produto Não Foi cadastrado');
                      </script>";
      echo 'produto não cadastrado';
      echo $result;
    }
  } else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO produtos (
          titulo, subtitulo, localFoto, descricao, tag1, tag2, tag3, tag4, tag5,
          id_usuario_publicacao, data_publicacao, preco_venda, fileFoto
        ) VALUES (
          :titulo, :subtitulo, :localFoto, :descricao, :tag1, :tag2, :tag3, :tag4, :tag5,
          :id_usuario, :data_publicacao, :preco_venda, :fileFoto
        )";

    $nome_final = "teste";

    $stmt = $pdo->prepare($sql);
    // Bind all non-image values
    $stmt->bindParam(':titulo', $produto);
    $stmt->bindParam(':subtitulo', $subtitulo);
    $stmt->bindParam(':localFoto', $nome_final);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':tag1', $tag1);
    $stmt->bindParam(':tag2', $tag2);
    $stmt->bindParam(':tag3', $tag3);
    $stmt->bindParam(':tag4', $tag4);
    $stmt->bindParam(':tag5', $tag5);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindValue(':data_publicacao', date('Y-m-d H:i:s'));
    $stmt->bindParam(':preco_venda', $preco_venda);

    // Handle image upload
    if (!empty($_FILES['imagem']['tmp_name'])) {
      $fileHandle = fopen($_FILES['imagem']['tmp_name'], 'rb');
      $stmt->bindParam(':fileFoto', $fileHandle, PDO::PARAM_LOB);
    } else {
      $null = null;
      $stmt->bindParam(':fileFoto', $null, PDO::PARAM_NULL);
    }

    // Execute
    $result = $stmt->execute();
    if (isset($fileHandle)) {
      fclose($fileHandle);
    }

    if ($result) {
      echo "<script type=\"text/javascript\">;
                      console.log('Produto cadastrado com sucesso');
                      </script>";
      header('Location: ../pages/produto-detalhe.php');
    } else {
      echo "<script type=\"text/javascript\">;
                      console.log('Produto Não Foi cadastrado');
                      </script>";
      echo 'produto não cadastrado';
      echo $result;
    }
  }

} catch (\Throwable $th) {
  echo 'Exceção capturada: ' . $th->getMessage() . "\n";
  echo $th;
  echo "<script type=\"text/javascript\">; 
      console.log('Não moveu a imagem'); 
      </script>";
  //throw $th;
}
?>