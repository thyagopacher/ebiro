<?php
    $_REQUEST["codcargo"] = $_SESSION["codcargo"];
    $_REQUEST["submit"]   = "Procurar Codcargo";
    require_once("../../controlador/ControlePermissaoCargo.php");
    $permissoes = $retorno;
    if($permissoes !== FALSE && mysql_num_rows($permissoes) > 0){
        echo("<ul class='quadros'>");
        while($permissao = mysql_fetch_array($permissoes)){
            if($permissao["quadro"] === "SIM"){
                echo("<li>");
                echo("<a href='$permissao[arquivo]'>");
                echo("<img src='../recursos/imagens/$permissao[icone]'/>");
                echo("<div align='center'>$permissao[menu]</div>");
                echo("</a>");
                echo("</li>");
            }
        }
        echo("</ul>");
    }
?>        
