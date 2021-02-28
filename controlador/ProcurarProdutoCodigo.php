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
    include($antes."modelo/ModelProduto.php");
    $modelo           = new ModelProduto();
    $query            = "select p.*,"
            . "(select nome from categoriaproduto where codcategoria = p.codcategoria) as categoria,"
            . "(select nome from fabricante where codfabricante = p.codfabricante) as fabricante,"
            . "(select logo from fabricante where codfabricante = p.codfabricante) as logofabricante"
            . " from produto p where codproduto = '$codproduto'";
    $retornoproduto   = $modelo->procurar($query);
?>