<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Envio de emails com anexo
 */
try{
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    include($antes."modelo/ModelEmpresa.php");    
    $modelo                 = new ModelEmpresa();
    $resultado              = $modelo->procurar("select * from empresa");
    $empresa                = mysql_fetch_array($resultado);
    $email                  = $empresa["email"];
    $nome                   = $_POST["nome"];
    $telefone               = $_POST["telefone"];
    $celular                = $_POST["celular"];
    $cep                    = $_POST["cep"];
    $tipologradouro         = $_POST["tipologradouro"];
    $logradouro             = $_POST["logradouro"];
    $bairro                 = $_POST["bairro"];
    $cidade                 = $_POST["cidade"];
    $numero                 = $_POST["numero"];
    $estado                 = $_POST["estado"];
    $assunto                = "Envio de curriculo pelo site";
    $email_from             = $_POST["email"];
    $mensagemp = "$assunto:<br>$nome<br>$email<br>Telefone:$telefone<br>"
            . "Celular:$celular<br>$tipologradouro:$logradouro - $numero, $bairro<br>"
            . " $cep - $cidade,$estado<br>";
        //formato o campo da mensagem
    $mensagem = wordwrap( $mensagemp, 50, "<br>", 1);
    function validaEmail($email){
        if (!ereg("^([0-9,a-z,A-Z]+)([.,_]([0-9,a-z,A-Z]+))*[@]([0-9,a-z,A-Z]+)([.,_,-]([0-9,a-z,A-Z]+))*[.]([0-9,a-z,A-Z]){2}([0-9,a-z,A-Z])?$", $email)){
            echo"<center>Digite um email valido</center>";
            echo "<center><a href=\"java script:history.go(-1)\">Voltar</center></a>";
            exit;
        }	
    }
    function enviaEmail($email,$assunto,$mens,$headers){
        mail($email,$assunto,$mens,$headers); 
        echo "<script>alert('Email enviado com Sucesso!');</script>"; 
    }
    $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;
    if(isset($arquivo["name"]) && $arquivo["name"] !== ""){
        $fp    = fopen($_FILES["arquivo"]["tmp_name"],"rb");
        $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"])); 
        $anexo = base64_encode($anexo); 
        fclose($fp);
        $anexo = chunk_split($anexo); 
        $boundary = "XYZ-" . date("dmYis") . "-ZYX"; 
        $mens = "--$boundary\n";
        $mens .= "Content-Transfer-Encoding: 8bits\n";
        $mens .= "Content-Type: text/html; charset=\"utf-8\"\n\n"; //plain
        $mens .= "$mensagem\n";
        $mens .= "--$boundary\n";
        $mens .= "Content-Type: ".$arquivo["type"]."\n"; 
        $mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n"; 
        $mens .= "Content-Transfer-Encoding: base64\n\n"; 
        $mens .= "$anexo\n"; 
        $mens .= "--$boundary--\r\n"; 
        $headers = "MIME-Version: 1.0\n"; 
        $headers .= "From: \"$nome\" <$email_from>\r\n"; 
        $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n"; 
        $headers .= "$boundary\n";
        enviaEmail($email,$assunto,$mens,$headers);
        echo "<script>location.href='../Trabalhe_conosco';</script>"; 
    }else{
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: \"$nome\" <$email_from>\r\n";
        enviaEmail($email,$assunto,$mens,$headers);
        echo "<script>location.href='../Trabalhe_conosco';</script>"; 
    } 
}catch(Exception $ex){
    echo("Erro causado por: $ex");
}
?>  
