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
    require_once($antes."modelo/ModelCorProduto.php");
    $modelo       = new ModelCorProduto();
    $corproduto   = new CorProduto();    
    if(isset($_REQUEST["codproduto"])){
        $corproduto->setCodproduto($_REQUEST["codproduto"]);
    }      
    if(isset($_REQUEST["codcorproduto"])){
        $corproduto->setCodcorproduto($_REQUEST["codcorproduto"]);
    } 
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
        if(isset($_REQUEST["codcor"])){
            $corproduto->setCodcor($_REQUEST["codcor"]);
        }          

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($corproduto);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($corproduto);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($corproduto->getCodcorproduto());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcorproduto"])){
                            $retorno = $modelo->procurarObjeto($cor->getCodcorproduto());
                        }
                    }else{
                        if($submit === "Procurar Codcor"){
                            if(isset($_REQUEST["codcor"])){
                                $codcor = $_REQUEST["codcor"];
                            }else{
                                $codcor = "";
                            }            
                            $retorno = $modelo->procurarCodcor($codcor);
                        }else{
                            if($submit === "Procurar Codproduto"){
                                $codproduto = $_REQUEST["codproduto"];
                                $retorno = $modelo->procurarCodProduto($codproduto);
                            }
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Codcor" && $submit !== "Procurar" && $submit !== "Procurar Codproduto"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit cor";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            echo ("<script>location.href=('../visao/painel/Produto.php?codproduto=".$_REQUEST["codproduto"]."');</script>");  
        }
    }

?>
