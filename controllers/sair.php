<?php
  session_start();
  unset( $_SESSION['usuario_login']);
  unset( $_SESSION['usuario_nome']);
  header('Location: ../index.php');
 ?>
