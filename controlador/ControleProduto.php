<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleProduto
 *
 * @author ebiro_2
 */
    session_start();
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    include($antes."modelo/ModelProduto.php");
    $modelo  = new ModelProduto();
    $produto = new Produto();    
    if(isset($_REQUEST["codproduto"])){
        $produto->setCodproduto($_REQUEST["codproduto"]);
        $dados = mysql_fetch_array($modelo->procurarObjeto($produto->getCodproduto()));
    }      
    function upload($img){
        $caminho = "../visao/recursos/imagens/";
        if(isset($img) && $img !== NULL && !empty($img)
        && isset($img["name"]) && $img["name"] !== NULL && $img["name"] !== "" && isset($img["tmp_name"])){
            $imagem    = md5(uniqid(rand(), true)).'.jpg';
            $foto_cami = $img['tmp_name'];
            move_uploaded_file($foto_cami,$caminho.$imagem);
        }else{
            $imagem = "";
        }
        return $imagem;
    }
    function tiraMoeda($valor){
        return str_replace(",", ".", str_replace(".", "", $valor));           
    }
    if(isset($_REQUEST["submit"])){
        $retorno = "";
        $submit  = $_REQUEST["submit"];   
          
        if(isset($_REQUEST["nome"])){
            $produto->setNome($_REQUEST["nome"]);
        }
        if(isset($_REQUEST["descricao"])){
            $produto->setDescricao($_REQUEST["descricao"]);
        }                 
        if(isset($_REQUEST["valor"])){
            $produto->setValor(tiraMoeda($_REQUEST["valor"]));
        } 
        if(isset($_REQUEST["peso"])){
            $produto->setPeso(tiraMoeda($_REQUEST["peso"]));
        } 
        if(isset($_REQUEST["altura"])){
            $produto->setAltura(tiraMoeda($_REQUEST["altura"]));
        }         
        if(isset($_REQUEST["largura"])){
            $produto->setLargura(tiraMoeda($_REQUEST["largura"]));
        }         
        if(isset($_REQUEST["comprimento"])){
            $produto->setComprimento(tiraMoeda($_REQUEST["comprimento"]));
        }         
        if(isset($_REQUEST["desconto"])){            
            $produto->setDesconto(tiraMoeda($desconto));
        }else{
            $produto->setDesconto(0.0);
        }          
        if(isset($_REQUEST["codcategoria"])){
            $produto->setCodcategoria($_REQUEST["codcategoria"]);
        }
        if(isset($_REQUEST["codfabricante"])){
            $produto->setCodfabricante($_REQUEST["codfabricante"]);
        }  
        if(isset($_REQUEST["cor1"])){
            $produto->setCor1($_REQUEST["cor1"]);
        }  
        if(isset($_REQUEST["cor2"])){
            $produto->setCor2($_REQUEST["cor2"]);
        }  
        if(isset($_REQUEST["cor3"])){
            $produto->setCor3($_REQUEST["cor3"]);
        }             
        if(isset($_FILES["imagem1"])){
            $nome = upload($_FILES["imagem1"]);
            if($nome === ""){
                $nome = $dados["imagem1"];
            }
            $produto->setImagem1($nome);
        }      
        if(isset($_FILES["imagem2"])){
            $nome = upload($_FILES["imagem2"]);
            if($nome === ""){
                $nome = $dados["imagem2"];
            }
            $produto->setImagem2($nome);
        }
        if(isset($_FILES["imagem3"])){
            $nome = upload($_FILES["imagem3"]);
            if($nome === ""){
                $nome = $dados["imagem3"];
            }
            $produto->setImagem3($nome);
        } 
        if(isset($_FILES["imagem4"])){
            $nome = upload($_FILES["imagem4"]);
            if($nome === ""){
                $nome = $dados["imagem4"];
            }
            $produto->setImagem4($nome);
        } 
        if(isset($_FILES["imagem5"])){
            $nome = upload($_FILES["imagem5"]);
            if($nome === ""){
                $nome = $dados["imagem5"];
            }
            $produto->setImagem5($nome);
        }
        if(isset($_FILES["imagem6"])){
            $nome = upload($_FILES["imagem6"]);
            if($nome === ""){
                $nome = $dados["imagem6"];
            }
            $produto->setImagem6($nome);
        } 
        if(isset($_FILES["imagem7"])){
            $nome = upload($_FILES["imagem7"]);
            if($nome === ""){
                $nome = $dados["imagem7"];
            }
            $produto->setImagem7($nome);
        } 
        if(isset($_FILES["imagem8"])){
            $nome = upload($_FILES["imagem8"]);
            if($nome === ""){
                $nome = $dados["imagem8"];
            }
            $produto->setImagem8($nome);
        }    
        if(isset($_REQUEST["vitrine"])){
            $produto->setVitrine($_REQUEST["vitrine"]);
        }        
        if($submit === "Cadastrar"){
            $retorno = $modelo->inserirObjeto($produto);
        }else{
            if($submit === "Editar"){
                $retorno = $modelo->atualizarObjeto($produto);
            }else{
                if($submit === "Excluir"){
                    $retorno = $modelo->excluirObjeto($produto->getCodproduto());
                }else{
                    if($submit === "Procurar"){
                        if(isset($_REQUEST["codproduto"])){
                            $retorno = $modelo->procurarObjeto($produto->getCodproduto());
                        }
                    }else{
                        if($submit === "Procurar Nome"){
                            if(isset($_REQUEST["nome"])){
                                $retorno = $modelo->procurarNome($produto->getNome());
                            }                            
                        }else{
                            if($submit === "Excluir Imagem"){
                                $ordem   = $_REQUEST["ordem"]; 
                                $produto = $modelo->procurarObjeto($produto->getCodproduto());
                                $imagem  = $produto["$ordem"];
                                $comando = "update produto set $ordem = '' where codproduto = '".$_REQUEST["codproduto"]."'";
                                $retorno = $modelo->comando($comando);
                                if($retorno !== FALSE){
                                    unlink("../recursos/imagens/".$imagem);
                                }
                            }else{
                                if($submit === "Excluir Vitrine"){
                                    $codproduto = $_REQUEST["codproduto"];
                                    $retorno    = $modelo->comando("update produto set vitrine = 'NÃO' where codproduto = '$codproduto'");
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
                $mensagem = "Erro ao realizar comando de $submit produto";
                include($antes."controlador/EnviaErro.php");
            }
            echo ("<script>alert('$mensagem');</script>");
            if($submit === "Editar" || $submit === "Excluir" || $submit === "Cadastrar"){
                echo ("<script>location.href=('../visao/painel/ProcurarProduto.php');</script>");  
            }else{
                if($submit === "Excluir Imagem"){
                    echo ("<script>location.href=('../visao/painel/Produto.php?codproduto=".$_REQUEST["codproduto"]."&submit=Procurar');</script>");  
                }else{
                    if($submit === "Excluir Vitrine"){
                        echo ("<script>location.href=('../visao/painel/ListaVitrine.php');</script>");  
                    }else{
                        echo ("<script>location.href=('../visao/painel/Produto.php');</script>");  
                    }
                }
            }
        }
    }

?>
