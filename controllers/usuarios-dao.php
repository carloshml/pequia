<?php
   include_once('../config/bd.class.php');  
   class Usuario{
    public $id  ;
    public $nome  ;
    public $endereco ;
    public $telefone ;
    public $email ;
    public $login  ;
    public $sexo ; 
   }


   class UsuariosDAO{        
        public function verificarLoginEmUso($login){    
            try {   
                $total = null;   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM usuarios where login =  ?  ;"; 
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($login)); 
                $stmt->bindColumn('total', $total);	
                $stmt->fetch(PDO::FETCH_BOUND);   
                if($total > 0){
                   echo 'Login já está sendo utilizado!';
                }       
                Banco::desconectar();   
            } catch (Exception $e) {
                echo 'Exceção capturada: '.  $e->getMessage(). "\n";
            }
        }  

        public function numeroTotal(){    
            try {   
                $total = null;   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM usuarios;"; 
                $stmt = $pdo->prepare($sql);
                $stmt->execute(); 
                $stmt->bindColumn('total', $total);	
                $stmt->fetch(PDO::FETCH_BOUND);                 
                return $total ;
                Banco::desconectar();   
            } catch (Exception $e) {
                echo 'Exceção capturada: '.  $e->getMessage(). "\n";
            }
      }  

        public function buscarUsuarioPeloId($id){    
            $usuarios= new Usuario();
            try {   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM usuarios where id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $usuarios->id  = $data['id'] ;
                $usuarios->nome  = $data['nome'] ;
                $usuarios->endereco  = $data['endereco'] ;
                $usuarios->telefone  = $data['telefone'] ;
                $usuarios->email  = $data['email'] ;
                $usuarios->login  = $data['login'] ;
                $usuarios->sexo  = $data['sexo'] ;
                echo json_encode($usuarios);         
                Banco::desconectar();  
            } catch (Exception $e) {
                echo 'Exceção capturada: '.  $e->getMessage(). "\n";
            }
        } 
    }

    if(!empty($_GET)){      
        if($_GET['verificar-login']){        
            $produto_dao = new UsuariosDAO();
            $produto_dao->verificarLoginEmUso($_GET['login']);  
        } else  if(!empty($_GET['id'])) {        
           $produto_dao = new UsuariosDAO();
           $produto_dao->buscarUsuarioPeloId($_GET['id']);  
          
        }
    }

    if(!empty($_POST)){
        //Acompanha os erros de validação
        $nomeError = null;
        $enderecoErro = null;
        $telefoneErro = null;
        $emailErro = null;      
        $sexoErro = null;
        $loginErro = null;
        $senhaErro = null;
        $senhaErro2 = null;

        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];
        $login = $_POST['login'];
        $senha =  md5($_POST['senha']) ;

        //Validaçao dos campos:
        $valido = true;
        if(empty($_POST['senha']))
        {
            $senhaErro = 'Por favor digite  a senha!';
            $valido = false;
        }

        if( $_POST['senha'] !=   $_POST['senha2'] )
        {
            $senhaErro2 = 'Senhas não coincidem!';
            $valido = false;
        }

        if(empty($nome))
        {
            $nomeError = 'Por favor digite o seu nome!';
            $valido = false;
        }

        if(empty($endereco))
        {
            $enderecoErro = 'Por favor digite o seu endereço!';
            $valido = false;
        }

        if(empty($login))
        {
            $loginErro = 'Por favor digite o seu Login!';
            $valido = false;
        }

        if(empty($telefone))
        {
            $telefoneErro = 'Por favor digite o número do telefone!';
            $valido = false;
        }

        if(empty($email))
        {
            $emailErro = 'Por favor digite o endereço de email';
            $valido = false;
        }
        elseif (!filter_var($email,FILTER_VALIDATE_EMAIL))        {   
            $emailError = 'Por favor digite um endereço de email válido!';
            $valido = false;
          
        }

        if(empty($sexo))
        {
            $sexoErro = 'Por favor digite esse campo!';
            $valido = false;
        }

        if(!empty($login)){
            try {   
                $total = null;   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM usuarios where login =  ?  ;"; 
                $stmt = $pdo->prepare($sql);
                $stmt->execute(array($login)); 
                $stmt->bindColumn('total', $total);	
                $stmt->fetch(PDO::FETCH_BOUND);   
                if($total > 0){
                    $valido = false;   
                    $loginErro = 'Login já está sendo utilizado!';
                }       
                Banco::desconectar();   
            } catch (Exception $e) {
                echo 'Exceção capturada: '.  $e->getMessage(). "\n";
            }
        }     

        //Inserindo no Banco:
        if($valido)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios (nome, endereco, telefone, email, sexo, senha, login) VALUES(?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$endereco,$telefone,$email,$sexo,$senha, $login));        
            Banco::desconectar();
            // header("Location: index.php");    
            $valido  =  $valido  ? 'true' : 'false';  
            echo    '[{"valido":'. $valido .'}]';    
           
        }else{  
            $valido  =  $valido  ? 'true' : 'false';     
            $temErroNome   =  $nomeError  ? 'true' : 'false';        
            $temErroEndereco   =  $enderecoErro ? 'true' : 'false';
            $temErroTelefone   =  $telefoneErro  ? 'true' : 'false';
            $temErroEmailTamanho   =  $emailErro  ? 'true' : 'false';
            $temErroEmailValidade  =  $emailError ? 'true' : 'false';
            $temErroSexo   =  $sexoErro ? 'true' : 'false'; 
            $temErroSenha   =  $senhaErro ? 'true' : 'false'; 
            $temErroSenha2   =  $senhaErro2 ? 'true' : 'false';
            $temErroLogin   =  $loginErro ? 'true' : 'false'; 
            
            echo    '['
                    .'{"valido":'. $valido .'},'                                   
                    .'{"temErro":' . $temErroNome .', "motivo":"' . $nomeError ,'"},'  
                    .'{"temErro":' . $temErroEndereco .',"motivo":"' . $enderecoErro ,'"},'  
                    .'{"temErro":' . $temErroTelefone .',"motivo":"' . $telefoneErro ,'"},'  
                    .'{"temErro":' . $temErroEmailTamanho .',"motivo":"' . $emailErro ,'"},'  
                    .'{"temErro":' . $temErroEmailValidade .',"motivo":"' . $emailError ,'"},'
                    .'{"temErro":' . $temErroSexo .',"motivo":"' . $sexoErro ,'"},'  
                    .'{"temErro":' . $temErroSenha .',"motivo":"' . $senhaErro ,'"},' 
                    .'{"temErro":' . $temErroSenha2 .',"motivo":"' . $senhaErro2 ,'"},'  
                    .'{"temErro":' . $temErroLogin .',"motivo":"' . $loginErro ,'"}'  
                    . ']';
        }
    } 
?>