<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleRegraDesconto
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelRegraDesconto.php");
    $modelo = new ModelRegraDesconto();
    $regra  = new RegraDesconto();
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codregra"])){
            $regra->setCodregra($_REQUEST["codregra"]);
        }        
        if(isset($_REQUEST["nome"])){
            $regra->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["valor"])){
            $regra->setValor($_REQUEST["valor"]);
        }            
        if(isset($_REQUEST["tipovalor"])){
            $regra->setTipovalor($_REQUEST["tipovalor"]);
        }            
        if(isset($_REQUEST["qtdmin"])){
            $regra->setQtdmin($_REQUEST["qtdmin"]);
        }            
        if(isset($_REQUEST["qtdmax"])){
            $regra->setQtdmax($_REQUEST["qtdmax"]);
        }        
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($regra);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($regra);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($regra->getCodregra());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codregra"])){
                            $retorno = $modelo->procurarObjeto($regra->getCodregra());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($regra->getNome());
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
                echo ("<script>location.href=('../visao/painel/RegraDesconto.php?codregra=".$regra->getCodregra()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/RegraDesconto.php');</script>");  
            }
        }
    }

?>
