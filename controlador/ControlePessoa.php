<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlePessoa
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
        
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelPessoa.php");
    $modelo = new ModelPessoa();
    $pessoa = new Pessoa();
    
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];
        if(isset($_REQUEST["codpessoa"])){
            $pessoa->setCodpessoa($_REQUEST["codpessoa"]);
        }        
        if(isset($_REQUEST["nome"])){
            $pessoa->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["cpf"])){
            $pessoa->setCpf($_REQUEST["cpf"]);
            $resultado_pessoa = $modelo->procurar("select * from pessoa where cpf = '".$pessoa->getCpf()."'");
        }
        if(isset($_REQUEST["cep"])){
            $pessoa->setCep($_REQUEST["cep"]);
        }        
        if(isset($_REQUEST["tipologradouro"])){
            $pessoa->setTipologradouro($_REQUEST["tipologradouro"]);
        }
        if(isset($_REQUEST["logradouro"])){
            $pessoa->setLogradouro($_REQUEST["logradouro"]);
        }          
        if(isset($_REQUEST["numero"])){
            $pessoa->setNumero($_REQUEST["numero"]);
        }    
        if(isset($_REQUEST["bairro"])){
            $pessoa->setBairro($_REQUEST["bairro"]);
        }            
        if(isset($_REQUEST["cidade"])){
            $pessoa->setCidade($_REQUEST["cidade"]);
        }
        if(isset($_REQUEST["estado"])){
            $pessoa->setEstado($_REQUEST["estado"]);
        }     
        if(isset($_REQUEST["telefone"])){
            $pessoa->setTelefone($_REQUEST["telefone"]);
        }    
        if(isset($_REQUEST["celular"])){
            $pessoa->setCelular($_REQUEST["celular"]);
        }   
        if(isset($_REQUEST["email"])){
            $pessoa->setEmail($_REQUEST["email"]);
        } 
        if(isset($_REQUEST["login"])){
            $pessoa->setLogin($_REQUEST["login"]);
        } 
        if(isset($_REQUEST["senha"])){
            $pessoa->setSenha($_REQUEST["senha"]);
        }         
        if(isset($_REQUEST["cnpj"])){
            $pessoa->setCnpj($_REQUEST["cnpj"]);
            $resultado_pessoa = $modelo->procurar("select * from pessoa where cnpj = '".$pessoa->getCnpj()."'");
        }
        if(isset($_REQUEST["codtipo"])){
            $pessoa->setCodtipo($_REQUEST["codtipo"]);
        }
        if(isset($_REQUEST["codcargo"])){
            $pessoa->setCodcargo($_REQUEST["codcargo"]);
        }        
        if($submit === "Cadastrar"){
            if(isset($resultado_pessoa) && $resultado_pessoa !== NULL && $resultado_pessoa !== ""){
                $dados_pessoa = mysql_fetch_array($resultado_pessoa);
                if($dados_pessoa["codtipo"] === $pessoa->getCodtipo()){
                    echo("<script>alert(Você já está cadastrado para esse tipo, por favor tente outro!);</script>");
                    if(isset($_SESSION["codpessoa"]) && $_SESSION["tipo"] === "Funcionario"){
                        echo ("<script>location.href=('../visao/painel/Pessoa.php');</script>"); 
                    }else{
                        echo ("<script>location.href=('../visao/Pessoa.php');</script>"); 
                    }                    
                }
            }
            $retorno = $modelo->inserirObjeto($pessoa);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($pessoa);
            }else{
                if($submit === "Excluir"){
                    $todos   = $modelo->procurarTodos();
                    $qtd     = mysql_num_rows($todos);
                    if($qtd > 1){
                        $retorno = $modelo->excluirObjeto($pessoa->getCodpessoa());
                    }else{
                        $retorno = FALSE;
                    }
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codpessoa"])){
                            $retorno = $modelo->procurarObjeto($pessoa->getCodpessoa());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($pessoa->getNome());
                            }                            
                        }else{
                            if($submit === "Login"){
                                if(isset($_REQUEST["login"]) && isset($_REQUEST["senha"])){ 
                                    $login    = $_REQUEST["login"];
                                    $senha    = $_REQUEST["senha"];
                                    $retorno  = $modelo->validaLogin($login, $senha);
                                    $pessoa   = mysql_fetch_array($retorno);
                                    if($pessoa !== FALSE && isset($pessoa)){
                                        $_SESSION["codpessoa"]  = $pessoa["codpessoa"];
                                        $_SESSION["tipo"]       = $pessoa["tipo"];
                                        $_SESSION["codcargo"]   = $pessoa["codcargo"];
                                    }else{
                                        $retorno = FALSE;
                                    }
                                }else{
                                    $retorno = FALSE;
                                }
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
                if($submit === "Login" && !isset($_REQUEST["login"]) && !isset($_REQUEST["senha"])){
                    $mensagem = "Sem login e nem senha";
                }
            }
            if($retorno === FALSE){
                $mensagem = "Erro ao realizar comando de $submit em pessoa";
                include($antes."controlador/EnviaErro.php");
            }            
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar"){
                echo ("<script>location.href=('../visao/painel/Pessoa.php?codpessoa=".$pessoa->getCodpessoa()."&submit=Procurar');</script>");  
            }else{
                if($submit === "Login"){
                    echo("<script>location.href='../visao/painel/Home.php';</script>");
                }else{
                    echo ("<script>location.href=('../visao/painel/Pessoa.php?submit=Procurar Nome');</script>"); 
                }
            }
        }
    }

?>
