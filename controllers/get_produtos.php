<?php
require_once('../model/bd.class.php');

$objDB =  new bd();

$link = $objDB->conecta_mysql();

$sql = " SELECT * FROM `produtos` ORDER BY id DESC  ";

$resultado_id = mysqli_query($link,$sql);


if ($resultado_id){
  while($registro = mysqli_fetch_array($resultado_id,MYSQLI_ASSOC)){

    echo '<div class="row">
    <div class="col-md-7">
    <a href="#">';
    echo ' <img class="img-responsive"  src="fotos/'.$registro['localFoto'].'" alt="">
     </a>
    </div>
    <div class="col-md-5">';
    echo '<h3  class="cor-laranja">'.$registro['titulo'].'</h3>';
    echo '<h4>'.$registro['subtitulo'].'</h4>   <p>';
    echo   $registro['descricao'];
    echo   '</p>
    <a class="btn btn-default" href="#">';
    echo 'detalhes';
    echo '  <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
    </div>
    <hr>';
  }
}else{
  echo 'erro na consulta';
}


?>
