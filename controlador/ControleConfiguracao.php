<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleConfiguracao
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
    include($antes."modelo/ModelConfiguracao.php");
    $modelo        = new ModelConfiguracao();
    $configuracao  = new Configuracao();
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codconfiguracao"])){
            $configuracao->setCodconfiguracao($_REQUEST["codconfiguracao"]);
        }        
        if(isset($_REQUEST["quemsomos"])){
            $configuracao->setQuemsomos($_REQUEST["quemsomos"]);
        }
        if(isset($_REQUEST["palavrachave"])){
            $configuracao->setPalavrachave($_REQUEST["palavrachave"]);
        }   
        if(isset($_REQUEST["descricao"])){
            $configuracao->setDescricao($_REQUEST["descricao"]);
        }     
        if(isset($_REQUEST["codempresa"])){
            $configuracao->setCodempresa($_REQUEST["codempresa"]);
        }      
        if(isset($_REQUEST["emailpagseguro"])){
            $configuracao->setEmailpagseguro($_REQUEST["emailpagseguro"]);
        }
        if(isset($_REQUEST["parcelasjuro"])){
            $configuracao->setParcelasjuro($_REQUEST["parcelasjuro"]);
        } 
        if(isset($_REQUEST["lucro"])){
            $lucro1 = str_replace(".", "", $_REQUEST["lucro"]);
            $lucro  = str_replace(",", ".", $lucro1);             
            $configuracao->setLucro($lucro);
        }         
        if(isset($_REQUEST["cor"])){
            $original = utf8_decode($_REQUEST["cor"]);
        }
        if($original === "SIM"){
            $configuracao->setCorbody("");
            $configuracao->setCortopo("");
            $configuracao->setCorrodape("");
        }else{            
            if(isset($_REQUEST["cortopo"]) && $original !== "SIM"){
                $configuracao->setCortopo($_REQUEST["cortopo"]);
            }
            if(isset($_REQUEST["corbody"]) && $original !== "SIM"){
                $configuracao->setCorbody($_REQUEST["corbody"]);
            }
            if(isset($_REQUEST["corrodape"]) && $original !== "SIM"){
                $configuracao->setCorrodape($_REQUEST["corrodape"]);
            }
        }
   
        if(isset($_REQUEST["fretecorreio"])){
            $configuracao->setFretecorreio($_REQUEST["fretecorreio"]);
        }        
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($configuracao);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($configuracao);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($configuracao->getCodconfiguracao());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codconfiguracao"])){
                            $retorno = $modelo->procurarObjeto($configuracao->getCodconfiguracao());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($configuracao->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit configuração";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Configuracao.php?codconfiguracao=".$configuracao->getCodconfiguracao()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Configuracao.php?codconfiguracao=".$configuracao->getCodconfiguracao()."&submit=Procurar');</script>");  
            }
        }
    }

?>
