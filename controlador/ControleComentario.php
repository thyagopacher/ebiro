<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleComentario
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
    require_once($antes."modelo/ModelComentario.php");
    $modelo = new ModelComentario();
    $comentario = new Comentario();
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];

        if(isset($_REQUEST["codcomentario"])){
            $comentario->setCodcomentario($_REQUEST["codcomentario"]);
        }        
        if(isset($_REQUEST["nome"])){
            $comentario->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["status"])){
            $comentario->setStatus($_REQUEST["status"]);
        }
        if(isset($_REQUEST["email"])){
            $comentario->setEmail($_REQUEST["email"]);
        }        
        if(isset($_REQUEST["texto"])){
            $comentario->setTexto($_REQUEST["texto"]);
        }
        if(isset($_REQUEST["codproduto"])){
            $comentario->setCodproduto($_REQUEST["codproduto"]);
        }
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($comentario);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($comentario);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($comentario->getCodcomentario());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcomentario"])){
                            $retorno = $modelo->procurarObjeto($comentario->getCodcomentario());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($comentario->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit comentário";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Comentario.php?codcomentario=".$comentario->getCodcomentario()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Comentario.php');</script>");  
            }
        }
    }

?>
