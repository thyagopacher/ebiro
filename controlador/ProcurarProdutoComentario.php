<?php
    if(isset($_REQUEST["codproduto"])){
        $codproduto = $_REQUEST["codproduto"];
    }else{
        die("Cod produto nao preenchido");
    }
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    include($antes."modelo/ModelComentario.php");
    $modelo            = new ModelComentario();
    $query             = "select * from comentario where codcomentario = '$codcomentario' and status = '0'";
    $retornocomentario = $modelo->procurar($query);
?>