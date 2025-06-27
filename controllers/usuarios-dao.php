<?php
include_once('../config/bd.class.php');
include_once('../config/api-config.php');
include_once('../modal/usuario.php');
class UsuariosDAO
{
    public function verificarLoginEmUso($login)
    {
        try {
            $total = null;
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(id) as total FROM usuarios where login =  ?  ;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array($login));
            $stmt->bindColumn('total', $total);
            $stmt->fetch(PDO::FETCH_BOUND);
            if ($total > 0) {
                echo 'Login já está sendo utilizado!';
            }
            Banco::desconectar();
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function numeroTotal()
    {
        try {
            $total = null;
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(id) as total FROM usuarios;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $stmt->bindColumn('total', $total);
            $stmt->fetch(PDO::FETCH_BOUND);
            echo $total;
            Banco::desconectar();
        } catch (Exception $e) {
            echo 'Exceção capturada: ' . $e->getMessage() . "\n";
        }
    }

    public function buscarUsuarioPeloId($id)
    {

        try {
            $usuario = new Usuario();
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM usuarios where id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $usuario->id = $data['id'];
            $usuario->nome = $data['nome'];
            $usuario->endereco = $data['endereco'];
            $usuario->telefone = $data['telefone'];
            $usuario->email = $data['email'];
            $usuario->login = $data['login'];
            $usuario->sexo = $data['sexo'];
            $usuario->tipo = $data['tipo'];
            echo json_encode($usuario);
            Banco::desconectar();
        } catch (\Throwable $th) {
            echo 'Exceção capturada: ' . $th->getMessage() . "\n";
            echo $th;
            echo "<script type=\"text/javascript\">; 
            console.log('Não moveu a imagem'); 
            </script>";
            //throw $th;
        }
    }

    public function atualizar()
    {

        try {
            $pdo = Banco::conectar();
            $sql = 'SELECT * FROM usuarios ORDER BY id DESC';
            $usuarios = array();
            foreach ($pdo->query($sql) as $data) {
                $usuario = new Usuario();
                $usuario->id = $data['id'];
                $usuario->nome = $data['nome'];
                $usuario->endereco = $data['endereco'];
                $usuario->telefone = $data['telefone'];
                $usuario->email = $data['email'];
                $usuario->login = $data['login'];
                $usuario->sexo = $data['sexo'];
                $usuario->tipo = $data['tipo'];
                array_push($usuarios, $usuario);
            }
            echo json_encode($usuarios);
            Banco::desconectar();
        } catch (\Throwable $th) {
            echo 'Exceção capturada: ' . $th->getMessage() . "\n";
            echo $th;
            echo "<script type=\"text/javascript\">; 
            console.log('Não moveu a imagem'); 
            </script>";
            //throw $th;
        }
    }

    public function fazerLogin($usuarioL, $senha)
    {

        try {
            $usuario = new Usuario();
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM usuarios WHERE login =  ? AND senha = ?  ";
            $q = $pdo->prepare($sql);
            $q->execute(array($usuarioL, $senha));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                $usuario->id = $data['id'];
                $usuario->nome = $data['nome'];
                $usuario->endereco = $data['endereco'];
                $usuario->telefone = $data['telefone'];
                $usuario->email = $data['email'];
                $usuario->login = $data['login'];
                $usuario->sexo = $data['sexo'];
                $usuario->tipo = $data['tipo'];
            } else {
                // Optional: custom response for failed login
                $usuario->id = null;
                $usuario->mensagem = 'Usuário ou senha inválidos';
            }
            echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
            Banco::desconectar();

        } catch (\Throwable $th) {
            echo 'Exceção capturada: ' . $th->getMessage() . "\n";
            echo $th;
            echo "<script type=\"text/javascript\">; 
            console.log( " . $th->getMessage() . "); 
            </script>";
            //throw $th;
        }
    }
}

// ===================== ROTAS USUARIO ==================================

if (!empty($_GET)) {
    header("Content-Type: application/json; charset=UTF-8");
    $verificaLogin = $_GET['verificar-login'] ?? '';
    $atualizarUsuarios = $_GET['atulizar-usuarios'] ?? '';
    $senha = $_GET['senha'] ?? '';
    $contarUsuarios = $_GET['contar-usuarios'] ?? '';
    if ($verificaLogin) {
        $produto_dao = new UsuariosDAO();
        $produto_dao->verificarLoginEmUso($_GET['login']);
    } else if (!empty($_GET['id'])) {
        $produto_dao = new UsuariosDAO();
        $produto_dao->buscarUsuarioPeloId($_GET['id']);
    } else if ($atualizarUsuarios) {
        $produto_dao = new UsuariosDAO();
        $produto_dao->atualizar();
    } else if ($senha) {
        $usuarioL = $_GET['usuario'];
        $senha = md5($_GET['senha']);
        $produto_dao = new UsuariosDAO();
        $produto_dao->fazerLogin($usuarioL, $senha);
    } else if ($contarUsuarios) {
        $produto_dao = new UsuariosDAO();
        $produto_dao->numeroTotal();
    }
}

if (!empty($_POST)) {
    header("Content-Type: application/json; charset=UTF-8");
    if ($_POST['senha']) {
        //Acompanha os erros de validação
        $nomeError = null;
        $enderecoErro = null;
        $telefoneErro = null;
        $emailErro = null;
        $sexoErro = null;
        $loginErro = null;
        $senhaErro = null;
        $senhaErro2 = null;
        $tipo = 'ADMINISTADOR';
        if (isset($_POST['tipo'])) {
            $tipo = $_POST['tipo'];
        }
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];
        $login = $_POST['login'];
        $senha = md5($_POST['senha']);

        //Validaçao dos campos:
        $valido = true;
        if (empty($_POST['senha'])) {
            $senhaErro = 'Por favor digite  a senha!';
            $valido = false;
        }

        if ($_POST['senha'] != $_POST['senha2']) {
            $senhaErro2 = 'Senhas não coincidem!';
            $valido = false;
        }

        if (empty($nome)) {
            $nomeError = 'Por favor digite o seu nome!';
            $valido = false;
        }

        if (empty($endereco)) {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $valido = false;
        }

        if (empty($login)) {
            $loginErro = 'Por favor digite o seu Login!';
            $valido = false;
        }

        if (empty($telefone)) {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $valido = false;
        }

        $emailError = '';

        if (empty($email)) {
            $emailErro = 'Por favor digite o endereço de email';
            $valido = false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Por favor digite um endereço de email válido!';
            $valido = false;
        }

        if (empty($sexo)) {
            $sexoErro = 'Por favor digite esse campo!';
            $valido = false;
        }

        if (empty($tipo)) {
            $sexoErro = 'Por favor digite esse campo!';
            $valido = false;
        }

        if (!empty($login)) {
            try {
                $total = null;
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM usuarios where login =  ?  ;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($login));
                $stmt->bindColumn('total', $total);
                $stmt->fetch(PDO::FETCH_BOUND);
                if ($total > 0) {
                    $valido = false;
                    $loginErro = 'Login já está sendo utilizado!';
                }
                Banco::desconectar();
            } catch (Exception $e) {
                echo 'Exceção capturada: ' . $e->getMessage() . "\n";
            }
        }

        //Inserindo no Banco:
        if ($valido) {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios (nome, endereco, telefone, email, sexo, senha, login, tipo) VALUES(?,?,?,?,?,?,?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome, $endereco, $telefone, $email, $sexo, $senha, $login, $tipo));
            Banco::desconectar();
            // header("Location: index.php");    
            $valido = $valido ? 'true' : 'false';
            echo '[{"valido":' . $valido . '}]';
        } else {
            $valido = $valido ? 'true' : 'false';
            $temErroNome = $nomeError ? 'true' : 'false';
            $temErroEndereco = $enderecoErro ? 'true' : 'false';
            $temErroTelefone = $telefoneErro ? 'true' : 'false';
            $temErroEmailTamanho = $emailErro ? 'true' : 'false';
            $temErroEmailValidade = $emailError ? 'true' : 'false';
            $temErroSexo = $sexoErro ? 'true' : 'false';
            $temErroSenha = $senhaErro ? 'true' : 'false';
            $temErroSenha2 = $senhaErro2 ? 'true' : 'false';
            $temErroLogin = $loginErro ? 'true' : 'false';

            echo '['
                . '{"valido":' . $valido . '},'
                . '{"temErro":' . $temErroNome . ', "motivo":"' . $nomeError, '"},'
                . '{"temErro":' . $temErroEndereco . ',"motivo":"' . $enderecoErro, '"},'
                . '{"temErro":' . $temErroTelefone . ',"motivo":"' . $telefoneErro, '"},'
                . '{"temErro":' . $temErroEmailTamanho . ',"motivo":"' . $emailErro, '"},'
                . '{"temErro":' . $temErroEmailValidade . ',"motivo":"' . $emailError, '"},'
                . '{"temErro":' . $temErroSexo . ',"motivo":"' . $sexoErro, '"},'
                . '{"temErro":' . $temErroSenha . ',"motivo":"' . $senhaErro, '"},'
                . '{"temErro":' . $temErroSenha2 . ',"motivo":"' . $senhaErro2, '"},'
                . '{"temErro":' . $temErroLogin . ',"motivo":"' . $loginErro, '"}'
                . ']';
        }
    }
}
