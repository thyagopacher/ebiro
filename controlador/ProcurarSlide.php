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
    include($antes."modelo/ModelSlideShow.php");
    $modelo        = new ModelSlideShow();
    $slideshow     = new SlideShow();
    $retornoslides = $modelo->procurarTodos();
?>