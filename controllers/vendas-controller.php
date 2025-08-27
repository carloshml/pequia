<?php
include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../dao/venda-dao.php');
include_once('../dao/venda-item-dao.php');


class VendaController
{

    public function byid($id)
    {
        $vendaDAO = new VendaDAO();
        $venda = $vendaDAO->buscarVendaPorId($id);
        $vendaItemDAO = new VendaItemDAO();
        $itens = $vendaItemDAO->buscarItensDaVenda($id);

        // Badge class based on status
        $status = $venda['status'];
        $badgeClass = match ($status) {
            'ABERTA' => 'badge-warning',
            'FECHADA' => 'badge-primary',
            'CANCELADA' => 'badge-danger',
            default => 'badge-secondary'
        };

        echo '<div class="container my-4">';
        echo '  <div class="card shadow-sm">';
        echo '    <div class="card-body">';
        echo '      <h4 class="card-title text-primary">Detalhes da Venda</h4>';
        echo '      <p><strong>Cliente:</strong> ' . htmlspecialchars($venda['nome_cliente']) . '</p>';
        echo '      <p><strong>Status:</strong> <span class="badge ' . $badgeClass . '">' . htmlspecialchars($status) . '</span></p>';
        echo '      <p><strong>Telefone:</strong> ' . htmlspecialchars($venda['cliente_telefone']) . '</p>';
        echo '      <p><strong>Data da Compra:</strong> ' . date('d/m/Y', strtotime($venda['data_criacao'])) . '</p>';
        echo '      <p><strong>Valor Total:</strong> R$ ' . number_format($venda['vl_total'], 2, ',', '.') . '</p>';
        echo '      <div class="form-group">';
        echo '        <label for="descricao">Observação do cliente:</label>';
        echo '        <textarea class="form-control" id="descricao" rows="3" readonly>' . htmlspecialchars($venda['descricao']) . '</textarea>';
        echo '      </div>';
        echo '    </div>';
        echo '  </div>';

        echo '  <div class="card mt-4">';
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">Itens da Venda</h5>';
        echo '      <table class="table table-bordered table-hover">';
        echo '        <thead class="thead-light">';
        echo '          <tr>';
        echo '            <th>Produto</th>';
        echo '            <th>Quantidade</th>';
        echo '            <th>Total</th>';
        echo '          </tr>';
        echo '        </thead>';
        echo '        <tbody>';

        foreach ($itens as $item) {
            echo '          <tr>';
            echo '            <td>' . htmlspecialchars($item['produto_nome']) . '</td>';
            echo '            <td>' . $item['quantidade'] . '</td>';
            echo '            <td>R$ ' . number_format($item['vl_total'], 2, ',', '.') . '</td>';
            echo '          </tr>';
        }

        echo '        </tbody>';
        echo '        <tfoot>';
        echo '          <tr>';
        echo '            <th colspan="2" class="text-right">Total Geral:</th>';
        echo '            <th>R$ ' . number_format($venda['vl_total'], 2, ',', '.') . '</th>';
        echo '          </tr>';
        echo '        </tfoot>';
        echo '      </table>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }


    public function buscarVendas()
    {
        $vendaDAO = new VendaDAO();
        $vendas = $vendaDAO->buscarVendas();
        echo '<div class="container mt-4">';
        echo '<table class="table table-bordered table-hover">';
        echo '  <thead class="thead-dark">';
        echo '    <tr>';
        echo '      <th>Status</th>';
        echo '      <th>Cliente</th>';
        echo '      <th>Data da Compra</th>';
        echo '      <th>Total</th>';
        echo '      <th class="text-right">Detalhes</th>';
        echo '    </tr>';
        echo '  </thead>';
        echo '  <tbody>';

        foreach ($vendas as $venda) {
            $this->renderResumoVenda($venda);
        }

        echo '  </tbody>';
        echo '</table>';
        echo '</div>';
    }


    private function renderResumoVenda($venda)
    {
        $status = $venda['status'];
        $badgeClass = match ($status) {
            'ABERTA' => 'badge-warning',
            'FECHADA' => 'badge-primary',
            'CANCELADA' => 'badge-danger',
            default => 'badge-secondary'
        };

        echo '<tr>';
        echo '  <td><span class="badge ' . $badgeClass . '">' . htmlspecialchars($status) . '</span></td>';
        echo '  <td>' . htmlspecialchars($venda['nome_cliente']) . '</td>';
        echo '  <td>' . date('d/m/Y', strtotime($venda['data_criacao'])) . '</td>';
        echo '  <td>R$ ' . number_format($venda['vl_total'], 2, ',', '.') . '</td>';
        echo '  <td class="text-right">';
        echo '    <a href="venda-detalhe.php?venda_id=' . $venda['id'] . '" class="btn btn-sm btn-outline-primary">';
        echo '      <i class="far fa-eye"></i> Ver';
        echo '    </a>';
        echo '  </td>';
        echo '</tr>';
    }

}
