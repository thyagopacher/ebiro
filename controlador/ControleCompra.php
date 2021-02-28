<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleComprar
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
    include($antes."modelo/ModelCompra.php");
    $modelo = new ModelCompra();
    $compra = new Compra();

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codcompra"])){
            $compra->setCodcompra($_REQUEST["codcompra"]);
        }        
        if(isset($_REQUEST["nome"])){
            $compra->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["valor"])){
            $compra->setValor($_REQUEST["valor"]);
        }      
        if(isset($_REQUEST["codcategoria"])){
            $compra->setCodcategoria($_REQUEST["codcategoria"]);
        }           
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($compra);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($compra);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($compra->getCodcompra());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcompra"])){
                            $retorno = $modelo->procurarObjeto($compra->getCodcompra());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($compra->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit compra";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Comprar.php?codcompra=".$compra->getCodcompra()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Comprar.php');</script>");  
            }
        }
    }

?>
