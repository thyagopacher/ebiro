<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
    $modelo     = new ModelCategoriaProduto();
    $categoria  = new CategoriaProduto();
    $retcategorias = ($modelo->procurarTodos());
    
?>