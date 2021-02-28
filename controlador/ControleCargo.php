<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleCargo
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
    include($antes."modelo/ModelCargo.php");
    $modelo  = new ModelCargo();
    $cargo   = new Cargo();    
    if(isset($_REQUEST["codcargo"])){
        $cargo->setCodcargo($_REQUEST["codcargo"]);
    }      

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
          
        if(isset($_REQUEST["nome"])){
            $cargo->setNome($_REQUEST["nome"]);
        }     
        $salario1      = str_replace(".", "", $_REQUEST["salario"]);
        $salario       = str_replace(",", ".", $salario1);          
        if(isset($_REQUEST["salario"])){
            $cargo->setSalario($salario);
        }      

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($cargo);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($cargo);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($cargo->getCodcargo());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcargo"])){
                            $retorno = $modelo->procurarObjeto($cargo->getCodcargo());
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
                $mensagem = "Erro ao realizar comando de $submit cargo";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Cargo.php?codcargo=".$cargo->getCodcargo()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Cargo.php');</script>");  
            }
        }
    }

?>
