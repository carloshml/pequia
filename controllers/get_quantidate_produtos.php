<?php
require_once('../config/bd.class.php');

$objDB =  new bd();

$link = $objDB->conecta_mysql();

$sql = " SELECT COUNT(*) as total FROM `produtos` ORDER BY id DESC  ";

$resultado_id = mysqli_query($link,$sql);


if ($resultado_id){
  while($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){
    echo $registro['total'];     
  }
}else{
  echo 'erro na consulta';
}


?>
