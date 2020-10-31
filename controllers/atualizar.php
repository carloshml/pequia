<?php
     include_once('../config/bd.class.php'); 
     $pdo = Banco::conectar();
     $sql = 'SELECT * FROM usuarios ORDER BY id DESC';
     foreach($pdo->query($sql)as $row)
     {
         echo '<tr>';
             echo '<th scope="row">'. $row['id'] . '</th>';
         echo '<td>'. $row['nome'] . '</td>';
         echo '<td>'. $row['login'] . '</td>';
         echo '<td>'. $row['endereco'] . '</td>';
         echo '<td>'. $row['telefone'] . '</td>';
         echo '<td>'. $row['email'] . '</td>';
         echo '<td  width=20 >'. $row['sexo'] . '</td>';
         echo '<td width=170>';
         echo '<a class="btn btn-primary  btn_ler_contato" id="btnrd_'.$row['id'].'" data-toggle="modal" data-target="#modal_read"  >Info</a>';
         echo ' ';
         echo '<a class="btn btn-warning  btn_update_contato"  id="btnupdt_'.$row['id'].'"   data-toggle="modal" data-target="#modal_update">Up</a>';
         echo ' ';
         echo '<a class="btn btn-danger btn_apaga_contato" id="btndlt_'.$row['id'].'" data-toggle="modal" data-target="#modal_delete" href="delete.php?id='.$row['id'].'">  <span aria-hidden="true">&times;</span></a>';
         echo '</td>';
         echo '</tr>';
     }
     Banco::desconectar();
 ?>