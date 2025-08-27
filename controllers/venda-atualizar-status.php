<?php
require_once('../dao/venda-dao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $venda_id = $_POST['venda_id'];
   $novo_status = $_POST['status'];

   $venda_dao = new VendaDAO();
   $venda_dao->fecharVenda($venda_id, $novo_status);

   header("Location: ../pages/venda-detalhe.php?venda_id=" . $venda_id);
   exit;

}
?>