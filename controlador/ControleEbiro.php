<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleEbiro
 *
 * @author ebiro_2
 */
    
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        if($painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    include($antes."modelo/Conexao2.php");
    $conexao = new Conexao2();
    $conexao->conectar();
    $conexao->converteUTF8();
    $resultado_empresa = mysql_query("select * from empresa");
    $ebiro             = mysql_fetch_array($resultado_empresa);
    $conexao->desconectar();
?>
