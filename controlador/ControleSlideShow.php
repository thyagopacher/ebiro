<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleSlideShow
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
        
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelSlideShow.php");
    $modelo    = new ModelSlideShow();
    $slideshow = new SlideShow();
    if(isset($_REQUEST["codslideshow"])){
        $slideshow->setCodslideshow($_REQUEST["codslideshow"]);
        $query        = "select * from slideshow where codslideshow = '".$slideshow->getCodslideshow()."'";
        $resultado    = $modelo->procurar($query);
        $dados_slide  = mysql_fetch_array($resultado);   
    }     
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem    = md5(uniqid(rand(), true)).'.jpg';
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];       
        if(isset($_REQUEST["titulo"])){
            $slideshow->setTitulo($_REQUEST["titulo"]);
        }
        if(isset($_REQUEST["link"])){
            $slideshow->setLink($_REQUEST["link"]);
        }       
        if(isset($_REQUEST["texto"])){
            $slideshow->setTexto($_REQUEST["texto"]);
        }        
        if(isset($_FILES["imagem"])){
            $nome = upload($_FILES["imagem"]);
            if($nome === "" && isset($dados_slide)){
                $nome = $dados_slide["imagem"];
            }  
            $slideshow->setImagem($nome);
        }                
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($slideshow);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($slideshow);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($slideshow->getCodslideshow());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codslideshow"])){
                            $retorno = $modelo->procurarObjeto($slideshow->getCodslideshow());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($slideshow->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit de slide show";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/SlideShow.php?codslideshow=".$slideshow->getCodslideshow()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/ListaSlideShow.php');</script>");  
            }
        }
    }

?>
