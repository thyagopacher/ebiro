<?php
    session_start();
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
    $retornobanners = $modelo->procurar("select * from banner where posicao = '$posicao'");
    if($retornobanners === FALSE){
        include($antes."controlador/EnviaErro.php");
    }else{
        $qtdbanner = mysql_num_rows($retornobanners);
    }
?>