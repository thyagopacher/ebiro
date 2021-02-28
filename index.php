<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        $painel = "INDEX";
        include("visao/includes/head.php");
        ?>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />
        <title><?=$empresa["fantasia"]?></title>
    </head>
    <body>
        <?php 
            include("visao/includes/topo.php");
        ?>
        <div id="conteudo">
            Bem vindo ao site
            
        </div>
        <?php include("visao/includes/rodape.php");?>
    </body>
</html>
