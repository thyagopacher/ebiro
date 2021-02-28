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
        $antes = "../";
    }
    include($antes."modelo/ModelCompra.php");
    $modelo = new ModelCompra();
    $itemcompra = new Compra();

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["coditem"])){
            $itemcompra->setCoditemcompra($_REQUEST["coditem"]);
        }        
        if(isset($_REQUEST["codproduto"])){
            $itemcompra->setNome($_REQUEST["codproduto"]);
        }
        if(isset($_REQUEST["codcompra"])){
            $itemcompra->setValor($_REQUEST["codcompra"]);
        }                
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($itemcompra);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($itemcompra);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($itemcompra->getCoditemcompra());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["coditem"])){
                            $retorno = $modelo->procurarObjeto($itemcompra->getCoditemcompra());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($itemcompra->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit item compra";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Comprar.php?coditem=".$itemcompra->getCoditemcompra()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Comprar.php');</script>");  
            }
        }
    }

?>
