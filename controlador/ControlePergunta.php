<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlePergunta
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelPergunta.php");
    $modelo = new ModelPergunta();
    $pergunta = new Pergunta();

    if(isset($_REQUEST["submit"])){
        $retorno   = "";
        $submit = $_REQUEST["submit"];
        if(isset($_REQUEST["pergunta"])){
            $pergunta->setPergunta($_REQUEST["pergunta"]);
        }
        if(isset($_REQUEST["codpergunta"])){
            $pergunta->setCodpergunta($_REQUEST["codpergunta"]);
        }
        if(isset($_REQUEST["codcategoria"])){
            $pergunta->setCodcategoria($_REQUEST["codcategoria"]);
        }
        if($submit === "Cadastrar" || $submit === "Editar"){
            $pergunta->setResposta($_REQUEST["resposta"]);
        }
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($pergunta);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($pergunta);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($pergunta->getCodpergunta());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codpergunta"])){
                            $retorno = $modelo->procurarObjeto($_REQUEST["codpergunta"]);
                        }
                    }else{
                        if($submit === "Procurar Pergunta"){
                            if(isset($_REQUEST["pergunta"])){
                                $pergunta = $_REQUEST["pergunta"];
                            }else{
                                $pergunta = "";
                            }  
                            $retorno = $modelo->procurarPergunta($pergunta);
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Pergunta" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit";
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Pergunta.php?codpergunta=".$pergunta->getCodpergunta()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Pergunta.php');</script>");  
            }
        }
    }

?>
