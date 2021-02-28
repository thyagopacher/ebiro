<?php
    if(isset($_REQUEST["ordem"])){
        $order     = " order by ";
        if($_REQUEST["ordem"] === "Maior preço"){
            $order .= "valor desc";
        }   
        if($_REQUEST["ordem"] === "Menor preço"){
            $order .= "valor asc";
        } 
        if($_REQUEST["ordem"] === "Nome A-Z"){
            $order .= "nome asc";
        }
        if($_REQUEST["ordem"] === "Nome Z-A"){
            $order .= "nome desc";
        }        
    }
    if(isset($_REQUEST["codproduto"])){
        $codproduto = $_REQUEST["codproduto"];
        $filtro     = " and codproduto <> '$codproduto' ";
    }

    if(isset($_REQUEST["codcategoria"])){
        $codcategoria =  $_REQUEST["codcategoria"];
        $filtro       .= " and codcategoria = '$codcategoria' ";
    }
    if(isset($_REQUEST["codfabricante"])){
        $codfabricante  = $_REQUEST["codfabricante"];
        $filtro        .= " and codfabricante = '$codfabricante'";
    }
    if(isset($_REQUEST["procurar"])){
        $procurar =  $_REQUEST["procurar"];
        $filtro   .= " and nome like '%$procurar%' ";
    }
    $query    = "select p.*, (select nome from categoriaproduto where codcategoria = p.codcategoria)as categoria from produto p where 1 = 1 $filtro $order limit 0,12";
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    require_once($antes."modelo/ModelProduto.php");
    $modelo           = new ModelProduto();
    $produtocategoria = $modelo->procurar($query);
    
    if(isset($_REQUEST["codcategoria"])){
        $query         = "select codcategoria from categoriaproduto where codmestre = '".$_REQUEST["codcategoria"]."'";
        $resultado1    = $modelo->procurar($query);
        $subcategorias = "";
        $condicao      = "and";
        if($resultado1 !== FALSE && mysql_num_rows($resultado1) > 0){
            $i = 0;
            while($resultado = mysql_fetch_array($resultado1)){
                $subcategorias .= " $condicao codcategoria = '". $resultado["codcategoria"] . "'";
                $i              = $i + 1;
                $condicao       = "or";
            }
            $query            = "select * from produto where 1 = 1 $subcategorias or codcategoria = '" . $_REQUEST["codcategoria"] ."' limit 0,12";
            $produtocategoria = $modelo->procurar($query);            
        }
    }
?>