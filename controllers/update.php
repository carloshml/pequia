<?php
    include_once('../config/bd.class.php');
include_once('../config/api-config.php'); 
	$id = null;	

	if ( !empty($_POST)) {
		$nomeError = null;
		$enderecoErro = null;
		$telefoneErro = null;
        $emailErro = null;
        $sexoErro = null;
        $loginError = null;

        $id = $_POST['id'];
		$nome = $_POST['nome'];
		$endereco = $_POST['endereco'];
		$telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $sexo = $_POST['sexo'];
        $login = $_POST['login'];

		//Validação
		$valido = true;
		if (empty($nome)){
                    $nomeError = 'Por favor digite o nome!';
                    $valido = false;
        }

		if (empty($email)) {
                    $emailErro = 'Por favor digite o email!';
                    $valido = false;
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
                    $emailErro = 'Por favor digite um email válido!';
                    $valido = false;
		}

		if (empty($endereco))
                {
                    $endereco = 'Por favor digite o endereço!';
                    $valido = false;
		}

                if (empty($telefone))
                {
                    $telefone = 'Por favor digite o telefone!';
                    $valido = false;
		}

                if (empty($endereco))
                {
                    $endereco = 'Por favor preenche o campo!';
                    $valido = false;
        }
        
        if (empty($login))
        {
            $loginError = 'Por favor preenche o login!';
            $valido = false;
        }

		// update data
		if ($valido)   {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE usuarios  set nome = ?, endereco = ?, telefone = ?, email = ?, sexo = ?, login = ? WHERE id = ?";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($nome,$endereco,$telefone,$email,$sexo,$login,$id));
                    Banco::desconectar();
                    // header("Location: index.php");
                    $valido  =  $valido  ? 'true' : 'false';  
                    echo    '[{"valido":'. $valido .'},{"msg":"'. $nome.$endereco.$telefone.$email.$sexo.$id .'"}]';   

		}else{  
            $valido  =  $valido  ? 'true' : 'false';     
            $temErroNome   =  $nomeError  ? 'true' : 'false';        
            $temErroEndereco   =  $enderecoErro ? 'true' : 'false';
            $temErroTelefone   =  $telefoneErro  ? 'true' : 'false';
            $temErroEmailTamanho   =  $emailErro  ? 'true' : 'false';
            $temErroEmailValidade  =  $emailError ? 'true' : 'false';
            $temErroSexo   =  $sexoErro ? 'true' : 'false'; 
            $temErroLogin   =  $loginError ? 'true' : 'false'; 
            echo    '['
                    .'{"valido":'. $valido .'},'                                   
                    .'{"temErro":' . $temErroNome .', "motivo":"' . $nomeError ,'"},'  
                    .'{"temErro":' . $temErroEndereco .',"motivo":"' . $enderecoErro ,'"},'  
                    .'{"temErro":' . $temErroTelefone .',"motivo":"' . $telefoneErro ,'"},'  
                    .'{"temErro":' . $temErroEmailTamanho .',"motivo":"' . $emailErro ,'"},'  
                    .'{"temErro":' . $temErroEmailValidade .',"motivo":"' . $emailError ,'"},'                
                    .'{"temErro":' . $temErroSexo .',"motivo":"' . $sexoErro ,'"},'  
                    .'{"temErro":' . $temErroLogin .',"motivo":"' . $loginError ,'"}' 
                    . ']';
        }
	}
       
?> 