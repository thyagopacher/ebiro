<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleFormaPagamento
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
    include($antes."modelo/ModelFormaPagamento.php");
    $modelo = new ModelFormaPagamento();
    $forma  = new FormaPagamento();    
    if(isset($_REQUEST["codforma"])){
        $forma->setCodforma($_REQUEST["codforma"]);
        $dados_forma = mysql_fetch_array($modelo->procurarObjeto($forma->getCodforma()));
    }     
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem    = "forma_".md5(uniqid(rand(), true)).".jpg";
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];       
        if(isset($_REQUEST["nome"])){
            $forma->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["status"])){
            $forma->setStatus($_REQUEST["status"]);
        }        
        if(isset($_FILES["logo"])){
            $nome = upload($_FILES["logo"]);
            if($nome === NULL || $nome === ""){
                $nome = $dados_forma["logo"];
            }
            $forma->setLogo($nome);
        }      
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($forma);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($forma);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($forma->getCodforma());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codforma"])){
                            $retorno = $modelo->procurarObjeto($forma->getCodforma());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($forma->getNome());
                            }                            
                        }else{
                            if($submit === "Procurar query"){
                                if(isset($_REQUEST["query"])){
                                    $retorno = $modelo->procurar($_REQUEST["query"]);
                                }                                 
                            }
                        }
                    }
                }
            }
        }
        if($submit !== "Procurar Nome" && $submit !== "Procurar" && $submit !== "Procurar query"){
            $mensagem = "";
            if(!isset($retorno) || $retorno === NULL || $retorno !== FALSE){
                $mensagem = "$submit - realizado com sucesso";
            }else{
                $mensagem = "Erro ao realizar comando de $submit";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/FormaPagamento.php?codforma=".$forma->getCodforma()."&submit=Procurar');</script>");  
            }else{
                echo ("<script>location.href=('../visao/painel/FormaPagamento.php');</script>");  
            }
        }
    }

?>
