<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleFabricante
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
    include($antes."modelo/ModelFabricante.php");
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "fabricante_".md5(uniqid(rand(), true)).".jpg";
        if(isset($img) && $img !== NULL){
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }
    $modelo = new ModelFabricante();
    $fabricante = new Fabricante();
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codfabricante"])){
            $fabricante->setCodfabricante($_REQUEST["codfabricante"]);
        }        
        if(isset($_REQUEST["nome"])){
            $fabricante->setNome($_REQUEST["nome"]);
        }          
        if(isset($_FILES["logo"])){
            $nome = upload($_FILES["logo"]);
            $fabricante->setLogo($nome);
        }      
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($fabricante);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($fabricante);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($fabricante->getCodfabricante());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codfabricante"])){
                            $retorno = $modelo->procurarObjeto($fabricante->getCodfabricante());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($fabricante->getNome());
                            }                            
                        }else{
                            if($submit === "Procurar Categoria"){
                                if(isset($_REQUEST["codcategoria"])){
                                    $retorno = $modelo->procurarCategoria($_REQUEST["codcategoria"]);
                                }
                            }
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Nome" && $submit !== "Procurar" && $submit !== "Procurar Categoria"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit fabricante";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Fabricante.php?codfabricante=".$fabricante->getCodfabricante()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Fabricante.php');</script>");  
            }
        }
    }

?>
