<?php
session_start();
require_once('model/bd.class.php');
$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);

$sql = "SELECT * FROM usuarios WHERE login = '$usuario' AND senha = '$senha'";

$objDb = new bd();
$link = $objDb->conecta_mysql();

$resultado_id = mysqli_query($link,$sql);
if ($resultado_id){
  $dados_usuario = mysqli_fetch_array($resultado_id);
  print_r ($dados_usuario);
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

}else{
  echo 'Erro na exução da consulta, favor entrar em contato com o administrador do sistema';
}

?>
