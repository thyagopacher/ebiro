<?php
    function calculaDesconto($produto){
        if(isset($produto["desconto"]) && $produto["desconto"] !== NULL && $produto["desconto"] !== '0'){
            $desconto = $produto["valor"] * ($produto["desconto"]/100);
        }else{
            $desconto = 0;
        }
        return $desconto;
    }
    function calculaLucro($produto,$configuracao){
        if(isset($configuracao["lucro"]) && $configuracao["lucro"] !== NULL && $configuracao["lucro"] !== ""){
            $lucro = $produto["valor"] * ($configuracao["lucro"]/100);
        }else{
            $lucro = 0;
        }  
        return $lucro;
    }
    function formataPreco($produto, $lucro, $desconto){
        if(isset($produto)){
            echo($produto["nome"]. "<br>");
            if(isset($produto["desconto"])){
                echo("<span class='precovelho'>De: R$ ".number_format($produto['valor'] + $lucro, 2, ',', '.'). "</span><br>");
                echo("<span class='preconovo'>Por: R$ ".number_format($produto['valor'] + $lucro - $desconto, 2, ',', '.')."</span>");
            }else{
                echo("De: R$ ".number_format($produto['valor'] + $lucro, 2, ',', '.'));
            }
        }        
    }
?>
