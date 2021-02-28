<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleServico
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
        
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelServico.php");
    $modelo    = new ModelServico();
    $servico = new Servico();

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codservico"]) && $_REQUEST["codservico"] !== NULL && $_REQUEST["codservico"] !== ""){
            $servico->setCodservico($_REQUEST["codservico"]);
        }        
        if(isset($_REQUEST["nome"])){
            $servico->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["valor"])){
            $servico->setValor($_REQUEST["valor"]);
        }
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($servico);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($servico);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($servico->getCodservico());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codservico"])){
                            $retorno = $modelo->procurarObjeto($servico->getCodservico());
                        }else{
                            echo("Não pode procurar especificamente sem definir o código da servico");
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
        if($submit !== "Procurar Nome" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit em servico de produto";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Servico.php?codservico=".$servico->getCodservico()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Servico.php?submit=Procurar Nome');</script>");  
            }
        }
    }

?>
