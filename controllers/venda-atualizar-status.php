<?php
include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../modal/venda.php');
include_once('../modal/venda_item.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $venda_id = $_POST['venda_id'];
   $novo_status = $_POST['status'];

   try {
      $pdo = Banco::conectar();
      $sql = "UPDATE vendas SET status = :status WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':status', $novo_status);
      $stmt->bindParam(':id', $venda_id);
      $stmt->execute();

      header("Location: ../pages/venda-detalhe.php?venda_id=" . $venda_id);
      exit;
   } catch (PDOException $e) {
      echo "Erro ao atualizar status: " . $e->getMessage();
   }

   Banco::desconectar();
}
?>