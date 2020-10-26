<?php
  include '../config/bd.class.php';
$id = 0;

if(!empty($_GET['id'])){
    $id = $_REQUEST['id'];
    //Delete do banco:
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM usuarios where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
     Banco::desconectar();
    // header("Location: index.php");      
} 
?>