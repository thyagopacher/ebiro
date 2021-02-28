<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlePermissaoCargo
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelMenu.php");
    $modelo_menu = new ModelMenu();
    
    require_once($antes."modelo/ModelPermissaoCargo.php");
    $modelo      = new ModelPermissaoCargo();
    $permissao   = new PermissaoCargo();    
    if(isset($_REQUEST["codpermissao"])){
        $permissao->setCodpermissao($_REQUEST["codpermissao"]);
        $dados = mysql_fetch_array($modelo->procurarObjeto($permissao->getCodpermissao()));
    }      

    if(isset($_REQUEST["submit"])){
        $retorno        = "";
        $submit         = $_REQUEST["submit"];   
        $resultado_menu = $modelo_menu->procurarTodos(); 
        if($resultado_menu !== NULL && $resultado_menu !== "" && mysql_num_rows($resultado_menu) > 0){
            $i = 0;
            if($submit === "Cadastrar"){
                $modelo->comando("delete from permissaocargo where codcargo = '".$_REQUEST["codcargo"]."'");
            }
            while($menu = mysql_fetch_array($resultado_menu)){
                if(isset($_REQUEST["menu". $i]) && $_REQUEST["menu". $i] !== NULL && $_REQUEST["menu". $i] !== ""){
                    $permissao->setCodmenu($_REQUEST["menu". $i]);
                    if(isset($_REQUEST["codcargo"])){
                        $permissao->setCodcargo($_REQUEST["codcargo"]);
                        $permissao->setStatus("SIM");
                        if($submit === "Cadastrar"){
                            $retorno = $modelo->inserirObjeto($permissao);
                        }else{
                            if($submit === "Editar"){
                                $retorno = $modelo->atualizarObjeto($permissao);
                            }
                        }
                    }
                }
                $i = $i + 1;
            }
        }
 
        if($submit === "Procurar"){
            if(isset($_REQUEST["codpermissao"])){
                $retorno = $modelo->procurarObjeto($permissao->getCodpermissao());
            }
        }else{
            if($submit === "Procurar Codmenu"){
                if(isset($_REQUEST["codmenu"])){
                    $retorno = $modelo->procurarCodmenu($permissao->getCodmenu());
                }                            
            }else{
                if($submit === "Procurar Codcargo"){
                    if(isset($_REQUEST["codcargo"])){
                        $retorno = $modelo->procurarCargo($_REQUEST["codcargo"]);
                    }
                }
            }
        }

        if($submit !== "Procurar Codmenu" && $submit !== "Procurar" && $submit !== "Procurar Codcargo" && $submit !== "Procurar Codmenu"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit permissão cargo";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar" || $submit === "Cadastrar"){
                echo ("<script>location.href=('../visao/painel/PermissaoCargo.php?codcargo=".$_REQUEST["codcargo"]."&submit=Procurar Codcargo');</script>");  
            }else{
                 echo("<script>location.href=('../visao/painel/PermissaoCargo.php');</script>");  
            }
        }
    }

?>
