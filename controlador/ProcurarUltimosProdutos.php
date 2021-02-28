<?php
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    require_once($antes."modelo/ModelProduto.php");
    $modelo           = new ModelProduto();
    $query            = "select * from produto order by rand() desc limit 0,10";
    $retornoproduto   = $modelo->procurar($query);
?>