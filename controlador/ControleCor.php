<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleCor
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    include($antes."modelo/ModelCor.php");
    $modelo  = new ModelCor();
    $cor   = new Cor();    
    if(isset($_REQUEST["codcor"])){
        $cor->setCodcor($_REQUEST["codcor"]);
    }      

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
          
        if(isset($_REQUEST["nome"])){
            $cor->setNome($_REQUEST["nome"]);
        }          
        if(isset($_REQUEST["valor"])){
            $cor->setValor($_REQUEST["valor"]);
        }      

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($cor);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($cor);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($cor->getCodcor());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcor"])){
                            $retorno = $modelo->procurarObjeto($cor->getCodcor());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $nome = $_REQUEST["nome"];
                            }else{
                                $nome = "";
                            }            
                            $retorno = $modelo->procurarNome($nome);
                        }
                    }
                }
            }
        }
        if(utf8_decode($submit) !== "Procurar Nome" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit cor";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Cor.php?codcor=".$cor->getCodcor()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Cor.php');</script>");   
            }
        }
    }

?>
