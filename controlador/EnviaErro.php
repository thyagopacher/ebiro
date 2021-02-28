<?php
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    if(!isset($empresa) || $empresa["email"] === "" || $empresa["email"] === NULL){
        include($antes."modelo/ModelEmpresa.php");
        $modelo  = new ModelEmpresa();
        $empresa = mysql_fetch_array($modelo->procurar("select * from empresa"));
    }

    if(isset($empresa["email"]) && $empresa["email"] !== NULL && $empresa["email"] !== ""){  
        $assunto .= " Recebimento automático do site: ".$_SERVER['SERVER_NAME'];
        $email    = $empresa["email"];  
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";    
        $_SESSION["erro"] = $mensagem;
        mail("webmaster@ebiro.com.br",$assunto,$mensagem,$headers); 
        //mail("suporte@ebiro.com.br",$assunto,$mensagem,$headers); 
        echo("<script>location.href='javascript:history.back()';</script>"); 
    }
?>