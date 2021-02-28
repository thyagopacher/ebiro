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
    require_once($antes."modelo/ModelCategoriaProduto.php");
    $modelo           = new ModelCategoriaProduto();
    $categoria        = new CategoriaProduto();
    $query            = "select * from categoriaproduto where codmestre is null or codmestre = ''";
    $retornocategoria = $modelo->procurar($query);
?>