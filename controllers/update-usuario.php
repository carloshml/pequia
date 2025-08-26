<?php
require_once('../config/bd.class.php');
header('Content-Type: application/json');

if (!empty($_POST)) {
    $id = $_POST['id'] ?? null;
    $nome = $_POST['nome'] ?? '';
    $endereco = $_POST['endereco'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $email = $_POST['email'] ?? '';
    $sexo = $_POST['sexo'] ?? '';
    $login = $_POST['login'] ?? '';

    // Inicialização dos erros
    $erros = [
        'nome' => '',
        'endereco' => '',
        'telefone' => '',
        'email' => '',
        'sexo' => '',
        'login' => ''
    ];

    $valido = true;

    // Validações

     if (empty($id)) {
        $erros['nome'] = 'Impossivel atualizar sem o ID';
        $valido = false;
    }

    if (empty($nome)) {
        $erros['nome'] = 'Por favor digite o nome!';
        $valido = false;
    }

    if (empty($email)) {
        $erros['email'] = 'Por favor digite o email!';
        $valido = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'Por favor digite um email válido!';
        $valido = false;
    }

    if (empty($endereco)) {
        $erros['endereco'] = 'Por favor digite o endereço!';
        $valido = false;
    }

    if (empty($telefone)) {
        $erros['telefone'] = 'Por favor digite o telefone!';
        $valido = false;
    }

    if (empty($sexo)) {
        $erros['sexo'] = 'Por favor selecione o sexo!';
        $valido = false;
    }

    if (empty($login)) {
        $erros['login'] = 'Por favor preencha o login!';
        $valido = false;
    }

    // Atualização no banco
    if ($valido) {
        try {
            $pdo = Banco::conectar();
            $sql = "UPDATE usuarios SET nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ?, login = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $endereco, $telefone, $email, $sexo, $login, $id]);
            Banco::desconectar();

            echo json_encode([
                'valido' => true,
                'msg' => 'Dados atualizados com sucesso!'
            ]);
        } catch (PDOException $e) {
            echo json_encode([
                'valido' => false,
                'msg' => 'Erro ao atualizar: ' . $e->getMessage()
            ]);
        }
    } else {
        // Retorno com erros
        $response = ['valido' => false];
        foreach ($erros as $campo => $mensagem) {
            $response[] = [
                'campo' => $campo,
                'temErro' => !empty($mensagem),
                'motivo' => $mensagem
            ];
        }
        echo json_encode($response);
    }
}
?>