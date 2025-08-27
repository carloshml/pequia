<?php

include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../modal/venda.php');
include_once('../modal/venda_item.php');


class VendaItemDao
{
    public function buscarItensDaVenda($id)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT produtos.titulo AS produto_nome, vl_total, quantidade
            FROM vendas_itens
            INNER JOIN produtos ON vendas_itens.id_produto = produtos.id
            WHERE vendas_itens.id_venda = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $itens;
    }
}
?>