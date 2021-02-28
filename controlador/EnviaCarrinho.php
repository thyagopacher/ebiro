<?php
    session_start();
    
    if(isset($_REQUEST["codproduto"]) && $_REQUEST["codproduto"] !== NULL && $_REQUEST["codproduto"] !== ""){
        $codproduto = $_REQUEST["codproduto"];
        $produto    = mysql_fetch_array($modelo->procurarObjeto($codproduto));
        if(!isset($_SESSION["pedido"])){
            $codpedido  = rand(1, 999999999999999);
            $carrinho   = array();
        }else{
            
        }
        $item               = array();
        $item["codpedido"]  = $codpedido;
        $item["codproduto"] = $codproduto;
        $carrinho           = $item;
    }else{
        echo("<script>alert('Não pode gravar sem código do produto');</script>");
    }
?>