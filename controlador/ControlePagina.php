<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlePagina
 *
 * @author ebiro_2
 */
//    session_start();
    if(isset($painel) && $painel === TRUE && (!isset($antes) || $antes === "" || $antes === NULL)){
        $antes = "../../";    
    }else{
        if($painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    require_once($antes."modelo/ModelPagina.php");
    $modelo  = new ModelPagina();
    $pagina   = new Pagina();    
    if(isset($_REQUEST["codpagina"])){
        $pagina->setCodpagina($_REQUEST["codpagina"]);
    }      
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
        if(isset($_REQUEST["titulo"])){
            $pagina->setTitulo($_REQUEST["titulo"]);
        }     
      
        if(isset($_REQUEST["texto"])){
            $pagina->setTexto($_REQUEST["texto"]);
        }      

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($pagina);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($pagina);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($pagina->getCodpagina());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codpagina"])){
                            $retorno = $modelo->procurarObjeto($pagina->getCodpagina());
                        }
                    }else{
                        if($submit === "Procurar Titulo"){
                            if(isset($_REQUEST["titulo"])){
                                $retorno = $modelo->procurarTitulo($pagina->getTitulo());
                            }                            
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Titulo" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit página";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Pagina.php?codpagina=".$pagina->getCodpagina()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Pagina.php');</script>");  
            }
        }
    }

?>
