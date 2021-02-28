<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleCategoriaPlano
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
        
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelCategoriaPlano.php");
    $modelo    = new ModelCategoriaPlano();
    $categoria = new CategoriaPlano();

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codcategoria"]) && $_REQUEST["codcategoria"] !== NULL && $_REQUEST["codcategoria"] !== ""){
            $categoria->setCodcategoria($_REQUEST["codcategoria"]);
        }        
        if(isset($_REQUEST["nome"])){
            $categoria->setNome($_REQUEST["nome"]);
        }

        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($categoria);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($categoria);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($categoria->getCodcategoria());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codcategoria"])){
                            $retorno = $modelo->procurarObjeto($_REQUEST["codcategoria"]);
                        }else{
                            echo("Não pode procurar especificamente sem definir o código da categoria");
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
                $mensagem = "Erro ao realizar comando de $submit em categoria de produto";
                include($antes."controlador/EnviaErro.php");                
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/CategoriaPlano.php?codcategoria=".$categoria->getCodcategoria()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/CategoriaPlano.php?submit=Procurar Nome');</script>");  
            }
        }
    }

?>
