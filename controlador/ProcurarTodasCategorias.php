<?php
    try{
        if(isset($painel) && $painel === TRUE){
            $antes = "../../";
        }else{
            if(isset($painel) && $painel === "INDEX"){
                $antes = "";
            }else{
                $antes = "../";
            }
        }
        require_once($antes."modelo/ModelCategoriaProduto.php");
        $modelo      = new ModelCategoriaProduto();
        $categoria   = new CategoriaProduto();
        $retornotudo = $modelo->procurarTodos();
    }catch(Exception $ex){
        echo("Erro causado por: $ex");
    }
?>