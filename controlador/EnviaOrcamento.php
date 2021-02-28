<?php
/*
 * Envia novidades para todos cadastrados e ativos para receber novidades
 */
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    
    if(isset($_REQUEST["nome"])){
        $nome = $_REQUEST["nome"];
    }
    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
    }
    if(isset($_REQUEST["codproduto"])){
        $codproduto = $_REQUEST["codproduto"];
    }    
    include($antes."modelo/ModelEmpresa.php");
    $modelo_empresa    = new ModelEmpresa();    
    $resultado_empresa = $modelo_empresa->procurar("select * from empresa");
    $empresa           = mysql_fetch_array($resultado_empresa);
    $assunto           = "Orçamento de produto do site";
    $mensagem          = "$nome precisa de or&ccedil;amento do produto disponível no link: http://".$_SERVER['SERVER_NAME']."/venda/visao/Produto.php?codproduto=$codproduto ";
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";    
    mail($empresa["email"],$assunto,$mensagem,$headers); 
    echo("<script>alert('Enviado com sucesso!');</script>");
    echo("<script>location.href='../visao/Produto.php?codproduto=$codproduto';</script>");       
?>