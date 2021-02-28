<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleTipoPessoa
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelTipoPessoa.php");
    $modelo  = new ModelTipoPessoa();
    $tipopessoa   = new TipoPessoa();    
    if(isset($_REQUEST["codtipo"])){
        $tipopessoa->setCodtipo($_REQUEST["codtipo"]);
        $dados = mysql_fetch_array($modelo->procurarObjeto($tipopessoa->getCodtipo()));
    }      

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
        if(isset($_REQUEST["nome"])){
            $tipopessoa->setNome($_REQUEST["nome"]);
        }     

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($tipopessoa);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($tipopessoa);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($tipopessoa->getCodtipo());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codtipo"])){
                            $retorno = $modelo->procurarObjeto($tipopessoa->getCodtipo());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($tipopessoa->getNome());
                            }                            
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Nome" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/TipoPessoa.php?submit=Procurar Nome');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/TipoPessoa.php');</script>");  
            }
        }
    }

?>
