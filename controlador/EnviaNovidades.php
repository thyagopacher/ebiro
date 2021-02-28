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
    include($antes."modelo/ModelNovidades.php");
    $modelo    = new ModelNovidades();
    
    include($antes."modelo/ModelEmpresa.php");
    $modelo_empresa    = new ModelEmpresa();    
    $resultado_empresa = $modelo_empresa->procurar("select * from empresa");
    $empresa           = mysql_fetch_array($resultado_empresa);
    
    $resultado = $modelo->procurar("select * from novidades where status = 0");
    $assunto   = $empresa["fantasia"].$_REQUEST["titulo"];
    $mensagem  = $_REQUEST["texto"];
    if(mysql_num_rows($resultado) > 0){
        while($novidades = mysql_fetch_array($resultado)){
            mail($novidades["email"],$assunto,$mensagem); 
        }
        echo("<script>alert('Enviado com sucesso!');</script>");
        echo("<script>location.href='../visao/painel/Novidades.php';</script>");
    }else{
        echo("<script>alert('Ninguém cadastrado para receber novidades!');</script>");
    }        
?>