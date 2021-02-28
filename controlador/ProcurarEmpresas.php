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
    require_once($antes."modelo/ModelEmpresa.php");
    $modelo             = new ModelEmpresa();
    $categoria          = new Empresa();
    $retornoempresas    = $modelo->procurarTodos();
?>