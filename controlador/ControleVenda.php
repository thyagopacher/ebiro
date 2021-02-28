<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleVenda
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelVenda.php");
    $modelo = new ModelVenda();
    $venda = new Venda();

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codvenda"])){
            $venda->setCodvenda($_REQUEST["codvenda"]);
        }        
        if(isset($_REQUEST["nome"])){
            $venda->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["valor"])){
            $venda->setValor($_REQUEST["valor"]);
        }      
        if(isset($_REQUEST["codcategoria"])){
            $venda->setCodcategoria($_REQUEST["codcategoria"]);
        }           
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($venda);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($venda);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($venda->getCodvenda());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codvenda"])){
                            $retorno = $modelo->procurarObjeto($venda->getCodvenda());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($venda->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit venda";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Venda.php?codvenda=".$venda->getCodvenda()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Venda.php');</script>");  
            }
        }
    }

?>
