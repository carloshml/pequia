<?php
session_start();
include_once('../config/bd.class.php');
include_once('../config/api-config.php');
// modais dos Objetos que serão salvos 
include_once('../modal/venda_item.php');
include_once('../modal/venda.php');

$retorno = $_SESSION['vendas'];
$id_usuario_logado = $_SESSION['id_usuario'];
$observacao_venda = $_POST['observacao_venda'];

if (!$observacao_venda) {
   $observacao_venda = '';
}

if ($retorno) {
   $vendas = unserialize($retorno);
} else {
   $vendas = array();
}


foreach ($vendas as $vendaItem) {
   $vl_total_venda = $vl_total_venda + $vendaItem->vl_total;
}
$pdo = Banco::conectar();
try {

   // salvando a venda 
   $sql = "INSERT INTO vendas( id_cliente,  descricao ,  data_criacao , vl_total , fechada, status )
                  VALUES (?, ?, ? , ? , false, 'ABERTA')  ";

   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   $stmt = $pdo->prepare($sql);
   $result = $stmt->execute(array($id_usuario_logado, $observacao_venda, date('Y-m-d H:i:s'), $vl_total_venda));
   $id_venda = $pdo->lastInsertId();
   echo ' Ultimo id  ' . $id_venda;
   foreach ($vendas as $vendaItem) {
      $vendaItem->id_venda = $id_venda;
      echo ' venda item ' . print_r($vendaItem);
      echo ' <div> <hr> </div>  ';
      // salvando o venda item 
      $sql = "INSERT INTO vendas_itens( id_venda,  quantidade ,  id_produto , vl_total  )
                            VALUES (?, ?, ? , ? )  ";
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $pdo->prepare($sql);
      $result = $stmt->execute(
         array(
            $vendaItem->id_venda,
            $vendaItem->quantidade,
            $vendaItem->id_produto,
            $vendaItem->vl_total
         )
      );
   }
   unset($_SESSION['vendas']);
   header('Location: ../pages/loja.php?mesangem="sucessoCompra"');
} catch (PDOException $e) {
   echo '<hr class="divider my-4" />';
   echo $e->getMessage();
}
Banco::desconectar();

?>