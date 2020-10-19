<?php
session_start(); 
include 'model/bd.class.php';

if(!empty($_POST)){
  // print_r($_POST);
  $usuario = $_POST['usuario'];
  $senha = md5($_POST['senha']); 
  $pdo = Banco::conectar(); 
  $sql = "SELECT * FROM usuarios WHERE login =  ? AND senha = ?  ";
  $q = $pdo->prepare($sql);
  $q->execute(array($usuario, $senha ));
  $dados_usuario = $q->fetch(PDO::FETCH_ASSOC);
  // echo 'resultado'; 
   print_r($dados_usuario);
  if (isset($dados_usuario['login'])){
    // acesso correto do usuario ;
    // criando variáveis globais seesion
    $_SESSION['id_usuario'] = $dados_usuario['id'];
    $_SESSION['usuario'] = $dados_usuario['login'];
    $_SESSION['email'] = $dados_usuario['email'];
    header('Location: home.php');
  }else{
    header('Location: index.php?erro=1');
  }
  Banco::desconectar();   
}
/*
if (isset($dados_usuario['login'])){
      // acesso correto do usuario ;
      // criando variáveis globais seesion
      $_SESSION['id_usuario'] = $dados_usuario['id'];
      $_SESSION['usuario'] = $dados_usuario['login'];
      $_SESSION['email'] = $dados_usuario['email'];
      header('Location: home.php');
    }else{
      header('Location: index.php?erro=1');
    }
*/
?>

