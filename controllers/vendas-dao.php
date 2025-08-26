<?php
include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../modal/venda.php');
include_once('../modal/venda_item.php');


class VendaDAO
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
            return $total;
            Banco::desconectar();
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }


    public function buscarVenda($id)
    {


        $venda = new Venda();
        $nome_cliente = '';
        $cliente_telefone = '';

        try {
            $pdo = Banco::conectar();
            $sql = "  SELECT vendas.id as id,  usuarios.nome as nome_cliente, "
                . "  usuarios.telefone as  cliente_telefone, "
                . "  descricao, data_criacao, vl_total, fechada "
                . "  FROM  vendas "
                . "  inner join usuarios  on   vendas.id_cliente =  usuarios.id   "
                . "  where vendas.id = ?   "
                . "  ORDER BY vendas.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($id));
            $stmt->bindColumn('nome_cliente', $nome_cliente);
            $stmt->bindColumn('cliente_telefone', $cliente_telefone);
            $stmt->bindColumn('id', $venda->id);
            $stmt->bindColumn('descricao', $venda->descricao);
            $stmt->bindColumn('data_criacao', $venda->data_criacao);
            $stmt->bindColumn('vl_total', $venda->vl_total);
            $stmt->bindColumn('fechada', $venda->fechada);

            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {

                echo '<div class="container my-4">';
                echo '  <div class="card shadow-sm">';
                echo '    <div class="card-body">';
                echo '      <h4 class="card-title text-primary">Detalhes da Venda</h4>';
                echo '      <p><strong>Cliente:</strong> ' . htmlspecialchars($nome_cliente) . '</p>';
                echo '      <p><strong>Telefone:</strong> ' . htmlspecialchars($cliente_telefone) . '</p>';
                echo '      <p><strong>Data da Compra:</strong> ' . date('d/m/Y', strtotime($venda->data_criacao)) . '</p>';
                echo '      <p><strong>Valor Total:</strong> R$ ' . number_format($venda->vl_total, 2, ',', '.') . '</p>';
                echo '      <div class="form-group">';
                echo '        <label for="descricao">Observação do cliente:</label>';
                echo '        <textarea class="form-control" id="descricao" rows="3" readonly>' . htmlspecialchars($venda->descricao) . '</textarea>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';

            }

            $venda_item = new VendaItem();
            $produto_nome = '';
            $sql = "  SELECT produtos.titulo as  produto_nome, vl_total, quantidade "
                . "  FROM  vendas_itens  "
                . "  inner join produtos  on   vendas_itens.id_produto =  produtos.id   "
                . "  where vendas_itens.id_venda = ?   "
                . "  ORDER BY vendas_itens.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($id));
            $stmt->bindColumn('produto_nome', $produto_nome);
            $stmt->bindColumn('vl_total', $venda_item->vl_total);
            $stmt->bindColumn('quantidade', $venda_item->quantidade);
           
            echo '<div class="card mt-4">';
            echo '  <div class="card-body">';
            echo '    <h5 class="card-title">Itens da Venda</h5>';
            echo '    <table class="table table-bordered table-hover">';
            echo '      <thead class="thead-light">';
            echo '        <tr>';
            echo '          <th>Produto</th>';
            echo '          <th>Quantidade</th>';
            echo '          <th>Total</th>';
            echo '        </tr>';
            echo '      </thead>';
            echo '      <tbody>';
            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($produto_nome) . '</td>';
                echo '<td>' . $venda_item->quantidade . '</td>';
                echo '<td>R$ ' . number_format($venda_item->vl_total, 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '      </tbody>';
            echo '      <tfoot>';
            echo '        <tr>';
            echo '          <th colspan="2" class="text-right">Total Geral:</th>';
            echo '          <th>R$ ' . number_format($venda->vl_total, 2, ',', '.') . '</th>';
            echo '        </tr>';
            echo '      </tfoot>';
            echo '    </table>';
            echo '  </div>';
            echo '</div>';
            echo '</div>'; // container





            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                $array = array(
                    "produto_nome" => $produto_nome,
                    "vl_total" => $venda_item->vl_total,
                    "quantidade" => $venda_item->quantidade
                );
                echo '<div class="row itens">';
                echo '<div class="col-sm-2 ml-auto">' . $produto_nome . '</div>';
                echo '<div class="col-sm-2 ml-auto">' . $produto_nome . '</div>';
                echo '<div class="col-sm-2 ml-auto">' . $venda_item->quantidade . '</div>';
                echo '<div class="col-sm-2 ml-auto">' . $venda_item->vl_total . '</div>';
                echo '</div>';
            }

           
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        Banco::desconectar();
    }



    public function buscarVendas()
    {

        $venda = new Venda();
        $nome_cliente = '';


        try {
            $pdo = Banco::conectar();
            $sql = "  SELECT vendas.id as id,  usuarios.nome as nome_cliente,  descricao, data_criacao, vl_total, fechada "
                . "  FROM  vendas vendas "
                . "  inner join usuarios  on   vendas.id_cliente =  usuarios.id   "
                . "  ORDER BY vendas.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('nome_cliente', $nome_cliente);
            $stmt->bindColumn('id', $venda->id);
            $stmt->bindColumn('descricao', $venda->descricao);
            $stmt->bindColumn('data_criacao', $venda->data_criacao);
            $stmt->bindColumn('vl_total', $venda->vl_total);
            $stmt->bindColumn('fechada', $venda->fechada);

            echo '<div class="container mt-4">';
            echo '  <div class="row font-weight-bold border-bottom pb-2 mb-2">';
            echo '    <div class="col-sm-3">Cliente</div>';
            echo '    <div class="col-sm-3">Data da Compra</div>';
            echo '    <div class="col-sm-3">Total</div>';
            echo '    <div class="col-sm-3 text-right">Detalhes</div>';
            echo '  </div>';

            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                echo '<div class="row py-2 border-bottom align-items-center">';
                echo '  <div class="col-sm-3">' . htmlspecialchars($nome_cliente) . '</div>';
                echo '  <div class="col-sm-3">' . date('d/m/Y', strtotime($venda->data_criacao)) . '</div>';
                echo '  <div class="col-sm-3">R$ ' . number_format($venda->vl_total, 2, ',', '.') . '</div>';
                echo '  <div class="col-sm-3 text-right">';
                echo '    <a href="venda-detalhe.php?venda_id=' . $venda->id . '" class="btn btn-sm btn-outline-primary">';
                echo '      <i class="far fa-eye"></i> Ver';
                echo '    </a>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';

        } catch (PDOException $e) {
            print $e->getMessage();
        }
        Banco::desconectar();
    }
}
