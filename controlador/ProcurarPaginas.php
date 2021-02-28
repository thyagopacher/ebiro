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
    require_once($antes."modelo/ModelPagina.php");
    $modelo             = new ModelPagina();
    $categoria          = new Pagina();
    $retornopaginas     = $modelo->procurarTodos();
?>