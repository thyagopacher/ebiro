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
    require_once ($antes."modelo/ModelCategoriaProduto.php");

    function procurarCategoria($codcategoria){        
        $modelo              = new ModelCategoriaProduto();
        $query               = "select * from categoriaproduto where codmestre = '$codcategoria' order by nome";
        return $modelo->procurar($query);
    }
?>