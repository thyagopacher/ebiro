<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleBanner
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
    include($antes."modelo/ModelBanner.php");
    $modelo = new ModelBanner();
    $banner = new Banner();
    if(isset($_REQUEST["codbanner"]) && $_REQUEST["codbanner"] !== NULL && $_REQUEST["codbanner"] !== ""){
        $banner->setCodbanner($_REQUEST["codbanner"]);
        $query        = "select * from banner where codbanner = '".$banner->getCodbanner()."'";
        $resultado    = $modelo->procurar($query);
        $dados_banner = mysql_fetch_array($resultado);
    }     
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem  = "banner_".md5(uniqid(rand(), true)).".jpg";
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }
    
    
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];       
        if(isset($_REQUEST["link"])){
            $banner->setLink($_REQUEST["link"]);
        }     
        if(isset($_REQUEST["posicao"])){
            $banner->setPosicao($_REQUEST["posicao"]);
        }          
        if(isset($_FILES["imagem"])){
            $nome = upload($_FILES["imagem"]);
            if($nome === "" && isset($dados_banner)){
                $nome = $dados_banner["imagem"];
            }  
            $banner->setImagem($nome);
        }      
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($banner);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($banner);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($banner->getCodbanner());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codbanner"])){
                            $retorno = $modelo->procurarObjeto($banner->getCodbanner());
                        }
                    }else{
                        if($submit === "Procurar Link"){
                            if(isset($_REQUEST["link"])){
                                $retorno = $modelo->procurarLink($banner->getLink());
                            }                            
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Link" && $submit !== "Procurar"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit banner";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Banner.php?codbanner=".$banner->getCodbanner()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Banner.php');</script>");  
            }
        }
    }

?>
