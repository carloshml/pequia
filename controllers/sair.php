<?php
  session_start();
  unset( $_SESSION['id_usuario']); 
  unset( $_SESSION['usuario_login']);
  unset( $_SESSION['email']);
  unset( $_SESSION['usuario_nome']);
  unset( $_SESSION['vendas']);
  unset( $_SESSION['tipo']); 
  header('Location: ../index.php');
 ?>
