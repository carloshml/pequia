<?php
    include '../config/bd.class.php';
    $id = null;
    if(!empty($_GET['id']))
    {
        $id = $_REQUEST['id'];  
       $pdo = Banco::conectar();
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       $sql = "SELECT * FROM usuarios where id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($id));
       $data = $q->fetch(PDO::FETCH_ASSOC);
       echo '{ "id" : "' .$data['id'] . '",' 
            .'"nome" : "' .$data['nome'] . '",'
            .'"endereco" : "' .$data['endereco']. '",'
            .'"telefone" : "' .$data['telefone']. '",'
            .'"email" : "' .$data['email']. '",'
            .'"login" : "' .$data['login']. '",'
            .'"sexo" : "'.$data['sexo'].
            '"}';
       Banco::desconectar();
    }
?>

