<?php
    session_start();  
    include_once('../modal/venda_item.php'); 
    //Declara variáveis com dados do formulário
    $id_produto = $_GET['id_produto']; 
    $preco_venda = $_GET['preco_venda'];     
    $nome_produto = $_GET['nome_produto'];  
    $quantidade= $_POST['quantidade'];
    $retorno =   $_SESSION['vendas'];  
    if($retorno){
       $vendas =  unserialize($retorno);
    } else {
       $vendas = array();
    }
    $adicionaNovoProduto = true;
    foreach ($vendas as $vendaItem  ) {
        if($vendaItem->id_produto  ==   $id_produto ){
            $vendaItem->quantidade =  $vendaItem->quantidade + $quantidade;           
            $vendaItem->vl_total = $preco_venda *  $vendaItem->quantidade;   
            $adicionaNovoProduto = false;
        }      
    }
    if($adicionaNovoProduto){
        $vendas_item = new VendaItem();
        $vendas_item->id_produto = $id_produto;    
        $vendas_item->quantidade =  $quantidade;  
        $vendas_item->titulo =  $nome_produto;    
        $vendas_item->preco_venda =  $preco_venda;      
        $vendas_item->vl_total = ($preco_venda * $quantidade);      
        array_push($vendas, $vendas_item);
    }
    $_SESSION['vendas']  = serialize($vendas);
    // print("<pre>".print_r($vendas,true)."</pre>");
   header('Location: ../pages/detalhe-produto.php?id_produto='.$id_produto.'&nome_produto='.$nome_produto);  
?>
  

 