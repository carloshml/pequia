<?php
   include_once('../config/bd.class.php');  
   include_once('../modal/venda.php'); 
   include_once('../modal/venda_item.php'); 


   class VendaDAO{        
   
    public function numeroTotal(){     
         try {   
                $total = null;   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM vendas;"; 
                $stmt = $pdo->prepare($sql);
                $stmt->execute(); 
                $stmt->bindColumn('total', $total);	
                $stmt->fetch(PDO::FETCH_BOUND);                 
                return $total ;
                Banco::desconectar();   
            } catch (Exception $e) {
                echo 'Exceção capturada: '.  $e->getMessage(). "\n";
            }
    } 
    

    public function buscarVenda($id){   

       
        $venda = new Venda(); 
        $nome_cliente ='';   

        try {					
            $pdo = Banco::conectar();
             $sql = "  SELECT vendas.id as id,  usuarios.nome as nome_cliente,  descricao, data_criacao, vl_total, fechada "   
             ."  FROM  vendas " 
             ."  inner join usuarios  on   vendas.id_cliente =  usuarios.id   " 
             ."  where vendas.id = ?   " 
             ."  ORDER BY vendas.id DESC limit  6;";
             $stmt = $pdo->prepare($sql);
             $stmt->execute(array($id));
             $stmt->bindColumn('nome_cliente', $nome_cliente );	
             $stmt->bindColumn('id', $venda->id );	
             $stmt->bindColumn('descricao', $venda->descricao );	
             $stmt->bindColumn('data_criacao',  $venda->data_criacao );							
             $stmt->bindColumn('vl_total',  $venda->vl_total);
             $stmt->bindColumn('fechada',  $venda->fechada );		
         
             while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {  
             
                 echo '<div > Cliente: '. $nome_cliente.'</div>';
                 echo '<div > Data compra '.date('d/m/Y', strtotime($venda->data_criacao)) .'</div>';  
                 echo '<div  > Valor total: '. $venda->vl_total.' </div>';  
          
                    
                }

                $venda_item = new VendaItem(); 
               $produto_nome ='';
               $sql = "  SELECT produtos.titulo as  produto_nome, vl_total, quantidade "   
               ."  FROM  vendas_itens  " 
               ."  inner join produtos  on   vendas_itens.id_produto =  produtos.id   " 
               ."  where vendas_itens.id_venda = ?   " 
               ."  ORDER BY vendas_itens.id DESC limit  6;";
               $stmt = $pdo->prepare($sql);
               $stmt->execute(array($id));
               $stmt->bindColumn('produto_nome', $produto_nome );	
               $stmt->bindColumn('vl_total', $venda_item ->vl_total );	
               $stmt->bindColumn('quantidade', $venda_item ->quantidade );	
               echo '<div class="row barra-titulo center-align">';   
               echo 'itens da venda';            
               echo '</div>';    
               echo '<div class="row _mat-animation-noopable barra-titulo">';   
               echo '<div class="col-sm-2 ml-auto"> Nome produto </div>'; 
               echo '<div class="col-sm-2 ml-auto"> Total  </div>'; 
               echo '<div class="col-sm-2 ml-auto">  QTD </div>'; 
               echo '<div class="col-sm-2 ml-auto"> Nome produto </div>'; 
               echo '</div>';    
       
                  
               while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {  
                $array = array(  
                    "produto_nome" => $produto_nome,        
                    "vl_total" =>  $venda_item ->vl_total,     
                    "quantidade" => $venda_item ->quantidade                                     
                  
                  );
                   echo '<div class="row itens">';   
                   echo '<div class="col-sm-2 ml-auto">'. $produto_nome.'</div>';     
                   echo '<div class="col-sm-2 ml-auto">'. $venda_item ->vl_total.'</div>';     
                   echo '<div class="col-sm-2 ml-auto">'.$venda_item ->quantidade.'</div>';     
                   echo '<div class="col-sm-2 ml-auto">'. $produto_nome.'</div>';       
                   echo '</div>';                     
               }	
          	
               
        }catch (PDOException $e) {
            print $e->getMessage();
        }
        Banco::desconectar();  
  } 
   


    public function buscarVendas(){

        $venda = new Venda(); 
        $nome_cliente ='';   


        try {					
            $pdo = Banco::conectar();
            $sql = "  SELECT vendas.id as id,  usuarios.nome as nome_cliente,  descricao, data_criacao, vl_total, fechada "   
            ."  FROM  vendas vendas " 
            ."  inner join usuarios  on   vendas.id_cliente =  usuarios.id   " 
            ."  ORDER BY vendas.id DESC limit  6;";
            $stmt = $pdo->prepare($sql);
               $stmt->execute();
               $stmt->bindColumn('nome_cliente', $nome_cliente );	
               $stmt->bindColumn('id', $venda->id );	
               $stmt->bindColumn('descricao', $venda->descricao );	
               $stmt->bindColumn('data_criacao',  $venda->data_criacao );							
               $stmt->bindColumn('vl_total',  $venda->vl_total);
               $stmt->bindColumn('fechada',  $venda->fechada );							
                  
               echo '<div class="row _mat-animation-noopable barra-titulo">';   
               echo '<div class="col-sm-2 ml-auto"> Cliente </div>';
               echo '<div class="col-sm-2 ml-auto"> Compra </div>';  
               echo '<div class="col-sm-2 ml-auto"> TOTAL </div>';  
               echo '<div class="col-sm-1 ml-auto">  </div>';  
               echo '</div>';    
                  
                     
                  while ($row = $stmt->fetch(PDO::FETCH_BOUND)) {  
                    echo '<div class="row itens">';   
                    echo '<div class="col-sm-2 ml-auto">'. $nome_cliente.'</div>';
                    echo '<div class="col-sm-2 ml-auto">'.date('d/m/Y', strtotime($venda->data_criacao)) .'</div>';  
                    echo '<div class="col-sm-2 ml-auto"> '. $venda->vl_total.' </div>';  
                    echo '<div class="col-sm-1 ml-auto"> '; 
                    echo '          <a href="venda-detalhe.php?venda_id='.$venda->id.'" class="btn btn-outline-secondary fundo-branco"> <i class="far fa-eye"></i> ';
                    echo '          </a>';  
                    echo '</div>';  
                    echo '</div>';                     
                   }	
               
              }catch (PDOException $e) {
                  print $e->getMessage();
              }
              Banco::desconectar();  
    }

  
}
?>