<?php
require_once __DIR__ . '/../config/bd.class.php';
require_once __DIR__ . '/../modal/produtos.php';

class ProdutoDAO
{

    public function buscarProdutosLoja()
    {

        $id_produto = null;
        $tag1 = null;
        $tag2 = null;
        $tag3 = null;
        $tag4 = null;
        $tag5 = null;
        $descricao = null;
        $subtitulo = null;
        $titulo = null;
        $localFoto = null;
        $data_publicacao = '';
        $nome_autor = null;
        $fileFoto = null;
        try {
            $pdo = Banco::conectar();
            $sql = "  SELECT  produtos.id as id_produto,  tag1, tag2, tag3, tag4, tag5,  descricao, subtitulo, titulo, localFoto"
                . " , data_publicacao ,  usuarios.nome as nome_autor , fileFoto "
                . "  FROM produtos inner join usuarios  on   produtos.id_usuario_publicacao =  usuarios.id   "
                . "  ORDER BY produtos.id DESC limit  6;";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('id_produto', $id_produto);
            $stmt->bindColumn('tag1', $tag1);
            $stmt->bindColumn('tag2', $tag2);
            $stmt->bindColumn('tag3', $tag3);
            $stmt->bindColumn('tag4', $tag4);
            $stmt->bindColumn('tag5', $tag5);
            $stmt->bindColumn('descricao', $descricao);
            $stmt->bindColumn('subtitulo', $subtitulo);
            $stmt->bindColumn('titulo', $titulo);
            $stmt->bindColumn('data_publicacao', $data_publicacao);
            $stmt->bindColumn('nome_autor', $nome_autor);
            $stmt->bindColumn('localFoto', $localFoto);
            $stmt->bindColumn('fileFoto', $fileFoto);
            echo '<div class="row">';
            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                $array = array(
                    "id_produto" => $id_produto,
                    "tag1" => $tag1,
                    "tag2" => $tag2,
                    "tag3" => $tag3,
                    "tag4" => $tag4,
                    "tag5" => $tag5,
                    "descricao" => $descricao,
                    "subtitulo" => $subtitulo,
                    "titulo" => $titulo,
                    "localFoto" => $localFoto,
                    "fileFoto" => $fileFoto
                );

                $foto_content = $fileFoto;
                if (is_resource($foto_content)) {
                    $foto_content = stream_get_contents($foto_content);
                }
                $base64 = $foto_content ? base64_encode($foto_content) : '';

                echo '<div>';
                echo '<img width="100px" src="data:image/jpeg;base64,' . $base64 . '" alt="' . htmlspecialchars($titulo) . '">';
                echo '         <a href="detalhe-produto.php?id_produto=' . $id_produto . '&nome_produto=' . $titulo . '" class="cor-laranja  "> <strong> ' . $titulo . ' </strong></a>';
                echo '         <h6>' . $subtitulo . '</h6>';
                echo '         <ul>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag1 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag2 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag3 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag4 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag5 . ' </li>';
                echo '         </ul>';
                echo '<span class="text-right" > publicado: ' . date('d/m/Y', strtotime($data_publicacao)) . '</span>';
                echo '</div>';
            }
            echo '</div>';
        } catch (PDOException $e) {
            echo '<hr class="divider my-4" />';
            return $e->getMessage();
        }
        Banco::desconectar();
    }

    public function buscarProdutosParaEdicao()
    {
        $id_produto = null;
        $tag1 = null;
        $tag2 = null;
        $tag3 = null;
        $tag4 = null;
        $tag5 = null;
        $descricao = null;
        $subtitulo = null;
        $titulo = null;
        $localFoto = null;
        $data_publicacao = '';
        $nome_autor = null;
        $fileFoto = null;
        try {
            $pdo = Banco::conectar();
            $sql = "  SELECT  produtos.id as id_produto,  tag1, tag2, tag3, tag4, tag5, descricao, subtitulo, titulo, localFoto , "
                . "  data_publicacao ,  usuarios.nome as nome_autor, fileFoto"
                . "  FROM produtos inner join usuarios  on   produtos.id_usuario_publicacao =  usuarios.id   "
                . "  ORDER BY produtos.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('id_produto', $id_produto);
            $stmt->bindColumn('tag1', $tag1);
            $stmt->bindColumn('tag2', $tag2);
            $stmt->bindColumn('tag3', $tag3);
            $stmt->bindColumn('tag4', $tag4);
            $stmt->bindColumn('tag5', $tag5);
            $stmt->bindColumn('descricao', $descricao);
            $stmt->bindColumn('subtitulo', $subtitulo);
            $stmt->bindColumn('titulo', $titulo);
            $stmt->bindColumn('localFoto', $localFoto);
            $stmt->bindColumn('fileFoto', $fileFoto);

            echo '<div class="row">';
            while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {
                $array = array(
                    "id_produto" => $id_produto,
                    "tag1" => $tag1,
                    "tag2" => $tag2,
                    "tag3" => $tag3,
                    "tag4" => $tag4,
                    "tag5" => $tag5,
                    "descricao" => $descricao,
                    "subtitulo" => $subtitulo,
                    "titulo" => $titulo,
                    "localFoto" => $localFoto,
                    "fileFoto" => $fileFoto
                );

                $foto_content = $fileFoto;
                if (is_resource($foto_content)) {
                    $foto_content = stream_get_contents($foto_content);
                }
                $base64 = $foto_content ? base64_encode($foto_content) : '';
                echo '<img width="100px" src="data:image/jpeg;base64,' . $base64 . '" alt="' . htmlspecialchars($titulo) . '">';
                echo '<div class="col-sm-3 ml-auto">';
                echo '<div>';

                echo '</div>';

                echo '         <h6>' . $subtitulo . '</h6>';
                echo '         <ul>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag1 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag2 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag3 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag4 . ' </li>';
                echo '             <li  class="glyphicon glyphicon-chevron-right">' . $tag5 . ' </li>';
                echo '         </ul>';
                echo '<span class="text-right" > publicado: ' . date('d/m/Y', strtotime($data_publicacao)) . '</span>';
                echo '</div>';
            }
            echo '</div>';
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        Banco::desconectar();
    }

    public function buscarProdutosTelaInicial()
    {
        $produto = new Produto();
        try {
            $pdo = Banco::conectar();
            $sql = "SELECT  id,  tag1, tag2, tag3, descricao, subtitulo, titulo, localFoto, fileFoto "
                . " FROM produtos   ORDER BY produtos.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('id', $produto->id);
            $stmt->bindColumn('tag1', $produto->tag1);
            $stmt->bindColumn('tag2', $produto->tag2);
            $stmt->bindColumn('tag3', $produto->tag3);
            $stmt->bindColumn('descricao', $produto->descricao);
            $stmt->bindColumn('subtitulo', $produto->subtitulo);
            $stmt->bindColumn('titulo', $produto->titulo);
            $stmt->bindColumn('localFoto', $produto->localFoto);
            $stmt->bindColumn('fileFoto', $fileFoto);
            $foto_content = $fileFoto;

            echo '<div class="row g-4">';
            while ($stmt->fetch(PDO::FETCH_BOUND)) {
                $foto_content = $fileFoto;
                if (is_resource($foto_content)) {
                    $foto_content = stream_get_contents($foto_content);
                }
                $base64 = $foto_content ? base64_encode($foto_content) : '';

                echo '<div class="col-md-4">';
                echo '  <div class="card h-100 shadow-sm border-0">';
                echo '    <img src="data:image/jpeg;base64,' . $base64 . '" class="card-img-top" alt="' . htmlspecialchars($produto->titulo) . '" style="height: 200px; object-fit: cover;">';
                echo '    <div class="card-body d-flex flex-column">';
                echo '      <h5 class="card-title text-primary">' . htmlspecialchars($produto->titulo) . '</h5>';
                echo '      <p class="card-text text-muted" style="flex-grow:1;">' . htmlspecialchars($produto->subtitulo) . '</p>';
                echo '      <a href="pages/detalhe-produto.php?id_produto=' . $produto->id . '" class="btn btn-outline-primary mt-auto w-100">Ver Detalhes</a>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            echo '</div>';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        Banco::desconectar();
    }

    public function buscarProdutoPeloId($id)
    {
        $produto = new Produto();
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM produtos where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $produto->id = $data['id'];
            $produto->titulo = $data['titulo'];
            $produto->subtitulo = $data['subtitulo'];
            $produto->local = $data['local'];
            $produto->descricao = $data['descricao'];
            $produto->preco_venda = $data['preco_venda'];
            $produto->tag1 = $data['tag1'];
            $produto->tag2 = $data['tag2'];
            $produto->tag3 = $data['tag3'];
            $produto->tag4 = $data['tag4'];
            $produto->tag5 = $data['tag5'];
            $produto->id_usuario_publicacao = $data['id_usuario_publicacao'];
            return json_encode($produto);
            Banco::desconectar();
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function abrirProduto($id_produto)
    {
        header('Location: detalhe-produto.php?id_produto=' . $id_produto);
    }

    public function numeroTotalProduto()
    {
        try {
            $total = null;
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(id) as total FROM produtos;";
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

    public function buscarProduto($id_produto)
    {

        $produto = new Produto();
        $produto->id = null;
        $produto->tag1 = null;
        $produto->tag2 = null;
        $produto->tag3 = null;
        $produto->tag4 = null;
        $produto->tag5 = null;
        $produto->descricao = null;
        $produto->subtitulo = null;
        $produto->titulo = null;
        $produto->localFoto = '';
        $produto->data_publicacao = '';
        $nome_autor = null;
        $fileFoto = null;
        $base64 = null;

        try {
            $pdo = Banco::conectar();
            $sql = "SELECT  produtos.id as id,   tag1, tag2, tag3, tag4, tag5, descricao, subtitulo,"
                . "  titulo, localFoto ,  usuarios.nome as nome_autor , preco_venda, produtos.fileFoto"
                . "  FROM produtos inner join usuarios  on   produtos.id_usuario_publicacao =  usuarios.id   "
                . "  where produtos.id = ?;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindColumn('id', $produto->id);
            $stmt->bindColumn('tag1', $produto->tag1);
            $stmt->bindColumn('tag2', $produto->tag2);
            $stmt->bindColumn('tag3', $produto->tag3);
            $stmt->bindColumn('tag4', $produto->tag4);
            $stmt->bindColumn('tag5', $produto->tag5);
            $stmt->bindColumn('descricao', $produto->descricao);
            $stmt->bindColumn('subtitulo', $produto->subtitulo);
            $stmt->bindColumn('titulo', $produto->titulo);
            $stmt->bindColumn('localFoto', $produto->localFoto);
            $stmt->bindColumn('preco_venda', $produto->preco_venda);
            $stmt->bindColumn('nome_autor', $nome_autor);
            $stmt->bindColumn('fileFoto', $fileFoto);
            $stmt->execute(array($id_produto));
            $foto_content = $fileFoto;


            while ($stmt->fetch(PDO::FETCH_BOUND)) {
                // Convert image blob to base64 after binding
                $foto_content = $fileFoto;
                if (is_resource($foto_content)) {
                    $foto_content = stream_get_contents($foto_content);
                }
                $base64 = $foto_content ? base64_encode($foto_content) : '';


                echo '<form method="post"  action="../controllers/adicionar_venda_item.php?id_produto='
                    . $produto->id
                    . '&preco_venda=' . $produto->preco_venda
                    . '&nome_produto=' . $produto->titulo . '" ';
                echo 'id="formCadastrarse" enctype="multipart/form-data">';
                echo '<div style="text-align:center" >';
                echo '  <h1  class="cor-laranja center">' . $produto->titulo . '</h1>';
                echo '<img width="100px" src="data:image/jpeg;base64,' . $base64 . '" alt="' . htmlspecialchars($produto->titulo) . '">';
                echo '</div>';
                echo '<div class="row">';
                echo '      <div class="form-group col-sm-4">';
                echo '      </div>';
                echo '      <div class="form-group col-sm-8">';
                echo '            <div style="display:table; width:100%; " >';
                echo '                 <div style="display:table-row" >';
                echo '                      <label  style="display:table-cell; width:25%;" class="pra-direita" >QUANTIDADE:</label>';
                echo '                      <input  style="display:table-cell; width:25%;" id="quantidade" value="1" name="quantidade" class="form-control" required>';
                echo '                      <button style="display:table-cell; width:25%;" type="submit" class="btn btn-warning" > ';
                echo '                             adicionar';
                echo '                       </button> ';
                echo '                      <button style="display:table-cell; width:25%;" id="btn_ver_compra" type="button" class="btn btn-info btn_ver_compra" >';
                echo '                             compra';
                echo '                       </button> ';
                echo '                 </div>';
                echo '            </div>';
                echo '      </div>';
                echo '</div>';
                echo '<p> ' . $produto->descricao . '</p>';
                echo '<div>Detalhes</div>';
                echo '<ul>';
                echo '<li  class="glyphicon glyphicon-chevron-right">' . $produto->tag1 . ' </li>';
                echo '<li  class="glyphicon glyphicon-chevron-right">' . $produto->tag2 . ' </li>';
                echo '<li  class="glyphicon glyphicon-chevron-right">' . $produto->tag3 . ' </li>';
                echo '<li  class="glyphicon glyphicon-chevron-right">' . $produto->tag4 . ' </li>';
                echo '<li  class="glyphicon glyphicon-chevron-right">' . $produto->tag5 . ' </li>';
                echo '</ul>';
                echo '<div> preço: ' . $produto->preco_venda . ' </div>';
                echo '<span class="text-right" > publicado por ' . $nome_autor . ' | ' . date('d/m/Y', strtotime($produto->data_publicacao)) . '</span>';
                echo '</form>';
                echo '<hr>';
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        Banco::desconectar();
    }
}
