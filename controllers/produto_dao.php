<?php
    include '../config/bd.class.php';
    class ProdutoDAO{        
      public function numeroTotalProduto(){    
            try {   
                $total = null;   
                $pdo = Banco::conectar();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT COUNT(id) as total FROM produtos;"; 
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

      public function numeroTotalProduto222(){    
          echo 'veio aqui';
        try {               
            $total = null;   
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT COUNT(id) as total FROM produtos;"; 
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
         
  }
?>