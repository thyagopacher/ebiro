<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlePlano
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelPlano.php");
    
    $modelo = new ModelPlano();
    $plano = new Plano();

    if(isset($_REQUEST["submit"])){
        $retorno   = "";
        $submit = $_REQUEST["submit"];
        if(isset($_REQUEST["codcategoria"])){
            $plano->setCodcategoria($_REQUEST["codcategoria"]);
        }        
        if(isset($_REQUEST["descricao"])){
            $plano->setDescricao($_REQUEST["descricao"]);
        }
        if(isset($_REQUEST["valor_mensal"])){
            $valor0      = str_replace(".", "", $_REQUEST["valor_mensal"]);
            $valor       = str_replace(",", ".", $valor0);              
            $plano->setValorMensal($valor);
        }
        if(isset($_REQUEST["valor_trimenstral"])){
            $valor0      = str_replace(".", "", $_REQUEST["valor_trimenstral"]);
            $valor       = str_replace(",", ".", $valor0);               
            $plano->setValorTrimenstral($valor);
        }
        if(isset($_REQUEST["valor_semestral"])){
            $valor0      = str_replace(".", "", $_REQUEST["valor_semestral"]);
            $valor       = str_replace(",", ".", $valor0);               
            $plano->setValorSemestral($valor);
        }
        if(isset($_REQUEST["valor_anual"])){
            $valor0      = str_replace(".", "", $_REQUEST["valor_anual"]);
            $valor       = str_replace(",", ".", $valor0);               
            $plano->setValorAnual($valor);
        }        
        if(isset($_REQUEST["codplano"])){
            $plano->setCodplano($_REQUEST["codplano"]);
        }
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($plano);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($plano);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($plano->getCodplano());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codplano"])){
                            $retorno = $modelo->procurarObjeto($_REQUEST["codplano"]);
                        }
                    }else{
                        if($submit === "Procurar Plano"){
                            if(isset($_REQUEST["plano"])){
                                $descricao = $_REQUEST["plano"];
                            }else{
                                $descricao = "";
                            }                  
                            $retorno = $modelo->procurarDescricao($descricao);
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Plano"){
            if($submit !== "Procurar"){
                $mensagem = "";
                if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                    $mensagem = "$submit - realizado com sucesso";
                }else{
                    $mensagem = "Erro ao realizar comando de $submit";
                }
                echo ("<script>alert('$mensagem');</script>");
                if($submit === "Editar"){
                    echo ("<script>location.href=('../visao/painel/Plano.php?codplano=".$plano->getCodplano()."&submit=Procurar');</script>");  
                }else{
                    echo ("<script>location.href=('../visao/painel/Plano.php');</script>");  
                }
            }
        }
    }

?>
