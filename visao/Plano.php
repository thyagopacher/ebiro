<?php
    if(!isset($_REQUEST["codplano"])){
        $_REQUEST["submit"] = "Procurar Plano";
    }else{
        $_REQUEST["submit"] = "Procurar";
    }
    include("../controlador/ControlePlano.php");
    if(!isset($_REQUEST["codplano"])){
        $planos = $retorno;
    }else{
        $plano = mysql_fetch_array($retorno);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("includes/head.php");?>
        <title><?=$empresa["fantasia"]?> - Plano</title>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" /> 
        <?php include("includes/mudaCor.php");?>        
    </head>
    <body>
        <?php 
        $painel = "NO-INDEX";
        include("includes/topo.php");
        ?>
        <div id="conteudo">
            <?php
            if(!isset($_REQUEST["codplano"])){
                if(mysql_num_rows($planos) > 0 && $planos !== FALSE && $planos !== NULL){
                    echo("<ul>");
                    while($plano = mysql_fetch_array($planos)){
                        echo("<li><a href='Plano/$plano[codplano]'>$plano[descricao]</a></li>");
                    }
                    echo("</ul>");
                }else{
                    echo("Nada encontrado");
                }
            }else{
                echo("<h4>$plano[descricao]</h4>");
                echo("<p>");
                echo("Mensal:". number_format($plano[valor_mensal], 2, ',', '.') ."<br>");
                echo("Trimenstral:". number_format($plano[valor_trimenstral], 2, ',', '.') ."<br>");
                echo("Semestral:". number_format($plano[valor_semestral], 2, ',', '.') ."<br>");
                echo("Anual:". number_format($plano[valor_anual], 2, ',', '.') ."<br>");
                echo("</p>");
            }
            ?>            
        </div>    
        <?php include("includes/rodape.php");?>
    </body>
</html>
