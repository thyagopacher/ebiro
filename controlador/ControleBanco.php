<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleBanco
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
    include($antes."modelo/ModelBanco.php");
    $modelo = new ModelBanco();
    $banco  = new Banco();   
    
    if(isset($_REQUEST["codbanco"])){
        $banco->setCodbanco($_REQUEST["codbanco"]);
        $dados_banco = mysql_fetch_array($modelo->procurarObjeto($banco->getCodbanco()));
    }       
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem  = "banco_".md5(uniqid(rand(), true)).".jpg";
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }

    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];     
        if(isset($_REQUEST["nome"])){
            $banco->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["linksite"])){
            $banco->setLinksite($_REQUEST["linksite"]);
        }            
        if(isset($_REQUEST["txconta"])){
            $banco->setTxconta($_REQUEST["txconta"]);
        }            
        if(isset($_REQUEST["txboleto"])){
            $banco->setTxboleto($_REQUEST["txboleto"]);
        }            
        if(isset($_FILES["logo"])){
            $nome = upload($_FILES["logo"]);
            if($nome === ""){
                $nome = $dados_banco["logo"];
            }
            $banco->setLogo($nome);
        }      
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($banco);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($banco);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($banco->getCodbanco());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codbanco"])){
                            $retorno = $modelo->procurarObjeto($banco->getCodbanco());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($banco->getNome());
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
                $mensagem = "Erro ao realizar comando de $submit banco";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Banco.php?codbanco=".$banco->getCodbanco()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/Banco.php');</script>");  
            }
        }
    }

?>
