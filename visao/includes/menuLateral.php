<?php
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
    require_once($antes."controlador/ProcurarCatMestre.php");
    require_once($antes."controlador/ProcurarSubcategoria.php");
    $caminho2 = $site . $pasta . "/";
?>
<div id="menu_lateral">
                <ul>
                    <?php 
                    if(isset($retornocategoria) && mysql_num_rows($retornocategoria) > 0){
                        while($categoria = mysql_fetch_array($retornocategoria)){
                            echo("<li>");
                            echo("<a href='".$caminho2."Categoria/$categoria[codcategoria]'>".ucfirst(strtolower($categoria["nome"]))."</a>");
                            $retornosub = procurarCategoria($categoria["codcategoria"]);
                            if(isset($retornosub) && mysql_num_rows($retornosub)){
                                echo("<ul>");
                                while($subcategoria = mysql_fetch_array($retornosub)){
                                    echo("<li><a href='".$caminho2."Categoria/$subcategoria[codcategoria]'>".$subcategoria["nome"]."</a></li>");
                                }
                                echo("</ul>");
                            }
                            echo("</li>");
                        }
                     }else{
                         echo("<li>Nenhuma categoria cadastrada</li>");
                     }
                     ?>                  
                </ul>
</div>