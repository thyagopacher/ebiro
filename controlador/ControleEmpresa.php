<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleEmpresa
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
            if(isset($painel) && $painel === "include"){
                $antes = "../../../";
            }else{
                $antes = "../";
            }
        }
    }
    require_once($antes."modelo/ModelEmpresa.php");
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        $imagem  = "logo.jpg";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }
        return $imagem;
    }
    $modelo = new ModelEmpresa();
    $empresa = new Empresa();
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codempresa"])){
            $empresa->setCodempresa($_REQUEST["codempresa"]);
        }        
        if(isset($_REQUEST["fantasia"])){
            $empresa->setFantasia($_REQUEST["fantasia"]);
        }
        if(isset($_REQUEST["razaosocial"])){
            $empresa->setRazaosocial($_REQUEST["razaosocial"]);
        }    
        if(isset($_REQUEST["cnpj"])){
            $empresa->setCnpj($_REQUEST["cnpj"]);
        }              
        if(isset($_REQUEST["cep"])){
            $empresa->setCep($_REQUEST["cep"]);
        }        
        if(isset($_REQUEST["tipologradouro"])){
            $empresa->setTipologradouro($_REQUEST["tipologradouro"]);
        }
        if(isset($_REQUEST["logradouro"])){
            $empresa->setLogradouro($_REQUEST["logradouro"]);
        }          
        if(isset($_REQUEST["numero"])){
            $empresa->setNumero($_REQUEST["numero"]);
        }    
        if(isset($_REQUEST["bairro"])){
            $empresa->setBairro($_REQUEST["bairro"]);
        }            
        if(isset($_REQUEST["cidade"])){
            $empresa->setCidade($_REQUEST["cidade"]);
        }
        if(isset($_REQUEST["estado"])){
            $empresa->setEstado($_REQUEST["estado"]);
        }     
        if(isset($_REQUEST["telefone"])){
            $empresa->setTelefone($_REQUEST["telefone"]);
        }   
        if(isset($_REQUEST["celular"])){
            $empresa->setCelular($_REQUEST["celular"]);
        }          
        if(isset($_REQUEST["fax"])){
            $empresa->setFax($_REQUEST["fax"]);
        }          
        if(isset($_REQUEST["email"])){
            $empresa->setEmail($_REQUEST["email"]);
        }          
        if(isset($_FILES["logo"])){
            $nome = upload($_FILES["logo"]);
            $empresa->setLogo($nome);
        }      
        if(isset($_REQUEST["codbanco"])){
            $empresa->setCodbanco($_REQUEST["codbanco"]);
        }
        if(isset($_REQUEST["agencia"])){
            $empresa->setAgencia($_REQUEST["agencia"]);
        }
        if(isset($_REQUEST["conta"])){
            $empresa->setConta($_REQUEST["conta"]);
        }
        if(isset($_REQUEST["digitov"])){
            $empresa->setDigitov($_REQUEST["digitov"]);
        }        
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($empresa);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($empresa);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($empresa->getCodempresa());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codempresa"])){
                            $retorno = $modelo->procurarObjeto($empresa->getCodempresa());
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
                $mensagem = "Erro ao realizar comando de $submit";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Cadastrar" || $submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Empresa.php?codempresa=".$_REQUEST["codempresa"]."');</script>");  
            }
            echo ("<script>location.href=('../visao/painel/Empresa.php');</script>");  
        }
    }

?>
