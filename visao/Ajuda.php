<?php
    if(!isset($_REQUEST["codpergunta"])){
        $_REQUEST["submit"] = "Procurar Pergunta";
    }else{
        $_REQUEST["submit"] = "Procurar";
    }
    include("../controlador/ControlePergunta.php");
    if(!isset($_REQUEST["codpergunta"])){
        $perguntas = $retorno;
    }else{
        $pergunta = mysql_fetch_array($retorno);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("includes/head.php");?>
        <title><?=$empresa["fantasia"]?> - Ajuda</title>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php 
        $painel = "NO-INDEX";
        include("includes/topo.php");
        ?>
        <div id="conteudo">
            <?php
            if(!isset($_REQUEST["codpergunta"])){
                if(mysql_num_rows($perguntas) > 0 && $perguntas !== FALSE && $perguntas !== NULL){
                    echo("<ul>");
                    while($pergunta = mysql_fetch_array($perguntas)){
                        echo("<li><a href='Ajuda/$pergunta[codpergunta]'>$pergunta[pergunta]</a></li>");
                    }
                    echo("</ul>");
                }else{
                    echo("Nada encontrado");
                }
            }else{
                echo("<h4>$pergunta[pergunta]</h4>");
                echo("<p>$pergunta[resposta]</p>");
            }
            ?>
        </div>    
        <?php
        include("includes/bannerLateral.php");
        include("includes/rodape.php");
        ?>
    </body>
</html>
