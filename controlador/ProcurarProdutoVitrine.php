<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
    $query  = "select p.*,"
            . "(select p.valor*(lucro/100) from configuracao) as lucrofinal,"
            . "(p.valor * (p.desconto/100)) as descontofinal"
            . " from produto p "
            . " where "
            . " p.vitrine = 'SIM' order by rand() limit 0,5";
    $modelo                 = new ModelProduto();
    $retornoproduto         = $modelo->procurar($query);
?>
