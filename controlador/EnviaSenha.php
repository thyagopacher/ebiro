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

    if(isset($_REQUEST["email"])){
        $email = $_REQUEST["email"];
    }

    include($antes."modelo/ModelPessoa.php");
    $modelo_pessoa     = new ModelPessoa();    
    $resultado_pessoa  = $modelo_pessoa->procurar("select * from pessoa where email = '$email'");
    $pessoa            = mysql_fetch_array($resultado_pessoa);
    $resultado         = "";
    if(isset($pessoa) && $pessoa !== NULL && isset($pessoa["email"]) && $pessoa["email"] !== NULL){
        $assunto           = "Envio de senha do site";
        $mensagem          = "Seu login é $pessoa[login] e sua senha é: $pessoa[senha]";
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";    
        mail($pessoa["email"],$assunto,$mensagem,$headers); 
        $resultado = ("Enviado com sucesso!");
    }else{
        $resultado = "E-mail não consta no nosso servidor!";
    }
    echo("<script>alert('".$resultado."!');</script>");
    echo("<script>parent.jQuery.fancybox.close();</script>");
    //echo("<script>location.href='../visao/Entrar.php';</script>");
?>