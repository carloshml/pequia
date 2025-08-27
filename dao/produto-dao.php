<?php
$usuarioLogado = isset($_SESSION['id_usuario']);
require_once __DIR__ . '/../config/bd.class.php';
require_once __DIR__ . '/../modal/produtos.php';

class ProdutoDao
{





    /**
     * @return Produto[]  // array of Venda objects
     */
    /**
     * @return Produto[]
     */
    public function buscarProdutos(): array
    {
        $produtos = [];

        try {
            $pdo = Banco::conectar();
            $sql = "SELECT produtos.id AS id_produto, tag1, tag2, tag3, tag4, tag5,
                       descricao, subtitulo, titulo, localFoto,
                       data_publicacao, usuarios.nome AS nome_autor, fileFoto
                FROM produtos
                INNER JOIN usuarios ON produtos.id_usuario_publicacao = usuarios.id
                ORDER BY produtos.id DESC LIMIT 6;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $produto = new Produto();
                $produto->id = $row['id_produto'];
                $produto->titulo = $row['titulo'];
                $produto->subtitulo = $row['subtitulo'];
                $produto->descricao = $row['descricao'];
                $produto->tag1 = $row['tag1'];
                $produto->tag2 = $row['tag2'];
                $produto->tag3 = $row['tag3'];
                $produto->tag4 = $row['tag4'];
                $produto->tag5 = $row['tag5'];
                $produto->data_publicacao = $row['data_publicacao'];
                $produto->localFoto = $row['localFoto'];
                $produto->fileFoto = $row['fileFoto'];

                // Extra field not in Produto class — you can add it if needed
                $produto->nome_autor = $row['nome_autor'];

                $produtos[] = $produto;
            }

        } catch (PDOException $e) {
            print $e->getMessage();
        }

        Banco::desconectar();
        return $produtos;
    }

    /**
     * Busca um produto específico pelo ID.
     *
     * @param int $id
     * @return Produto|null
     */
    public function buscarProdutoPorId(int $id): ?Produto
    {
        try {
            $pdo = Banco::conectar();
            $sql = "SELECT produtos.id AS id_produto, tag1, tag2, tag3, tag4, tag5,
                       descricao, subtitulo, titulo, localFoto,
                       data_publicacao, usuarios.nome AS nome_autor, fileFoto
                FROM produtos
                INNER JOIN usuarios ON produtos.id_usuario_publicacao = usuarios.id
                WHERE produtos.id = :id
                LIMIT 1;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            $produto = new Produto();
            $produto->id = $row['id_produto'];
            $produto->titulo = $row['titulo'];
            $produto->subtitulo = $row['subtitulo'];
            $produto->descricao = $row['descricao'];
            $produto->tag1 = $row['tag1'];
            $produto->tag2 = $row['tag2'];
            $produto->tag3 = $row['tag3'];
            $produto->tag4 = $row['tag4'];
            $produto->tag5 = $row['tag5'];
            $produto->data_publicacao = $row['data_publicacao'];
            $produto->localFoto = $row['localFoto'];
            $produto->fileFoto = $row['fileFoto'];

            // Campo extra
            $produto->nome_autor = $row['nome_autor'];

            return $produto;

        } catch (PDOException $e) {
            print $e->getMessage();
            return null;
        } finally {
            Banco::desconectar();
        }
    }

    public function buscarProdutoPeloId($id)
    {
        $produto = new Produto();
        try {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT produtos.id AS id_produto, tag1, tag2, tag3, tag4, tag5,
                       descricao, subtitulo, titulo, localFoto, preco_venda,
                       data_publicacao, usuarios.nome AS nome_autor, fileFoto, produtos.id_usuario_publicacao as  id_usuario_publicacao
                FROM produtos
                INNER JOIN usuarios ON produtos.id_usuario_publicacao = usuarios.id
                WHERE produtos.id = ?
                LIMIT 1;";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $produto->id = $data['id_produto'];
            $produto->titulo = $data['titulo'];
            $produto->subtitulo = $data['subtitulo'];
            $produto->localFoto = $data['localFoto'];
            $produto->descricao = $data['descricao'];
            $produto->preco_venda = $data['preco_venda'];
            $produto->tag1 = $data['tag1'];
            $produto->tag2 = $data['tag2'];
            $produto->tag3 = $data['tag3'];
            $produto->tag4 = $data['tag4'];
            $produto->tag5 = $data['tag5'];
            $foto_content = $data['fileFoto'];
            if (is_resource($foto_content)) {
                $foto_content = stream_get_contents($foto_content);
            }
            $base64 = $foto_content ? base64_encode($foto_content) : '';
            $produto->id_usuario_publicacao = $data['id_usuario_publicacao'];
            $produto->base64 = $base64;
            Banco::desconectar();
            return json_encode($produto);
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }

}
?>