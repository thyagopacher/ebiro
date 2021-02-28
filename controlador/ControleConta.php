<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleConta
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
    require_once($antes."modelo/ModelConta.php");
    $modelo  = new ModelConta();
    $conta   = new Conta();    
    if(isset($_REQUEST["codconta"])){
        $conta->setCodconta($_REQUEST["codconta"]);
    }      

    if(isset($_REQUEST["submit"]) || isset($_REQUEST["acao"])){
        $retorno = "";
        $submit  = ($_REQUEST["submit"]);   
        if(isset($_REQUEST["acao"])){
            $submit = "";
        }
        if(isset($_REQUEST["nome"])){
            $conta->setNome($_REQUEST["nome"]);
        }     
        
        $valor1      = str_replace(".", "", $_REQUEST["valor"]);
        $valor       = str_replace(",", ".", $valor1);          
        if(isset($_REQUEST["valor"])){
            $conta->setValor($valor);
        }      
        if(isset($_REQUEST["situacao"])){
            $conta->setSituacao($_REQUEST["situacao"]);
        }    
        if(isset($_REQUEST["parcela"])){
            $conta->setParcela($_REQUEST["parcela"]);
        }   
        if(isset($_REQUEST["periodo"])){
            $conta->setPeriodo($_REQUEST["periodo"]);
        }      
        if(isset($_REQUEST["vencimento"])){
            $conta->setVencimento($_REQUEST["vencimento"]);
        }         
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($conta);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($conta);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($conta->getCodconta());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codconta"])){
                            $retorno = $modelo->procurarObjeto($conta->getCodconta());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $nome = $_REQUEST["nome"];
                            }else{
                                $nome = "";
                            }            
                            $retorno = $modelo->procurarNome($nome);
                        }else{
                            if($_REQUEST["acao"] === "ProcurarSit"){
                                if(isset($_REQUEST["situacao"])){
                                    $nome = $_REQUEST["situacao"];
                                }else{
                                    $nome = "";
                                }
                                $retorno = $modelo->procurarSituacao($nome);
                            }
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Nome" && $submit !== "Procurar" && $_REQUEST["acao"] !== "ProcurarSit"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit conta";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Conta.php?codconta=".$conta->getCodconta()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Conta.php');</script>");  
            }
        }
    }

?>
