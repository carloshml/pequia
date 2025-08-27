<?php

include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../modal/venda.php');
include_once('../modal/venda_item.php');


class VendaDao
{

    public function numeroTotal()
    {
        try {
            $total = null;
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(id) as total FROM vendas;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('total', $total);
            $stmt->fetch(PDO::FETCH_BOUND);
            Banco::desconectar();
            return $total;
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function fecharVenda($venda_id, $novo_status)
    {


        try {
            $pdo = Banco::conectar();
            $sql = "UPDATE vendas SET status = :status WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':status', $novo_status);
            $stmt->bindParam(':id', $venda_id);
            $stmt->execute();


        } catch (PDOException $e) {
            echo "Erro ao atualizar status: " . $e->getMessage();
        }

        Banco::desconectar();
    }

    public function buscarVendaPorId($id)
    {
        $pdo = Banco::conectar();
        $sql = "SELECT vendas.id, usuarios.nome AS nome_cliente, usuarios.telefone AS cliente_telefone,
                   descricao, data_criacao, vl_total, fechada, status
            FROM vendas
            INNER JOIN usuarios ON vendas.id_cliente = usuarios.id
            WHERE vendas.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $venda = $stmt->fetch(PDO::FETCH_ASSOC);
        Banco::desconectar();
        return $venda;
    }

    public function buscarVendas()
    {
        try {
            $pdo = Banco::conectar();
            $sql = "SELECT vendas.id, usuarios.nome AS nome_cliente, descricao, data_criacao, vl_total, fechada, status
                FROM vendas
                INNER JOIN usuarios ON vendas.id_cliente = usuarios.id
                ORDER BY vendas.id DESC LIMIT 6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $vendas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $vendas;
        } catch (PDOException $e) {
            print $e->getMessage();
        }

        Banco::desconectar();
    }

}
?>