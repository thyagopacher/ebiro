<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleMenu
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelMenu.php");
    $modelo = new ModelMenu();
    $menu  = new Menu();
    function upload($img, $menu){
        $menu    = str_replace(".php", "", $menu);  
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem  = "icone_$menu.jpg";
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }    
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codcategoria"])){
            $menu->setCodcategoria($_REQUEST["codcategoria"]);
        }          
        if(isset($_REQUEST["codmenu"])){
            $menu->setCodmenu($_REQUEST["codmenu"]);
        }        
        if(isset($_REQUEST["nome"])){
            $menu->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["arquivo"])){
            $menu->setArquivo($_REQUEST["arquivo"]);
        }                    
        if(isset($_FILES["icone"])){
            $nome = upload($_FILES["icone"], $_REQUEST["arquivo"]);
            $menu->setIcone($nome);
        }       
        if(isset($_REQUEST["quadro"])){
            $menu->setQuadro($_REQUEST["quadro"]);
        }          
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($menu);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($menu);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($menu->getCodmenu());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codmenu"])){
                            $retorno = $modelo->procurarObjeto($menu->getCodmenu());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(!isset($_REQUEST["nome"])){
                                $nome = "";
                            }else{
                                $nome = $_REQUEST["nome"];
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
                $mensagem = "Erro ao realizar comando de $submit Menu";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Menu.php?submit=Procurar Nome');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Menu.php');</script>");  
            }
        }
    }

?>
