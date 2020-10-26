<?php
  session_start();
  unset( $_SESSION['id_usuario']);
  unset( $_SESSION['nome_usuario']);
  unset(  $_SESSION['email_usuario']);
  header('Location: ../index.php');
?>