<?php
  session_start();
  unset( $_SESSION['usuario_login']);
  unset( $_SESSION['usuario_nome']);
  unset( $_SESSION['vendas']);
  header('Location: ../index.php');
 ?>
