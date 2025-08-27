<?php

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
                $_SESSION['id_usuario'] = $data['id'];
                $_SESSION['nome_usuario'] = $data['nome'];
                $_SESSION['usuario_nome'] = $data['nome'];
                $_SESSION['email_usuario'] = $data['email'];
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
?>