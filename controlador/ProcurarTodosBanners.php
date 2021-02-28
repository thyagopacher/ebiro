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
    require_once($antes."modelo/ModelBanner.php");
    $modelo         = new ModelBanner();
    $banner         = new Banner();
    $retornobanners = $modelo->procurarTodos();
    
    $qtdbanner      = mysql_num_rows($retornobanners);
?>