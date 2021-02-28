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

    require_once($antes."modelo/ModelConfiguracao.php");
    $modelo              = new ModelConfiguracao();
    $retornoconfiguracao = $modelo->procurarTodos();

?>