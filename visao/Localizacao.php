<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("includes/head.php");
        ?>
        <title><?=$empresa["fantasia"]?></title>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" /> 
        <style>
            #mapa { 
                width: 640px;
                height: 200px;
                border: 10px solid #ccc;
                margin-bottom: 20px;
            }
        </style>
 <!--scripts necessários para abrir google maps api-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/jquery.min.js"></script> 
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/mapa.js"></script>   
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/jquery-ui.custom.min.js"></script>
        <?php
            include("includes/mudaCor.php");
        ?>        
    </head>
    <body>
        <?php 
        $painel = "NO-INDEX";
        include("includes/topo.php");
        ?>
        <div id="ladoEsquerdo">
            <?php
            include("includes/quadroEsquerda.php");
            ?>
        </div>
        <div id="conteudo">
            <?php 
            echo($empresa["tipologradouro"].",".
                    $empresa["logradouro"].",".
                    $empresa["numero"].",".
                    $empresa["cidade"]."-".
                    $empresa["estado"]
                    );
            ?>
            <input type="hidden" name="endereco" id="endereco" value="<?php echo($empresa["tipologradouro"].",".$empresa["logradouro"].",".$empresa["cidade"])?>"/>
            <input type="hidden" name="txtLatitude" id="txtLatitude" value=""/>
            <input type="hidden" name="txtLongitude" id="txtLongitude" value=""/>
            <h4>Mapa abaixo:</h4>
            <div id="mapa"></div>
            
        </div>    
        <?php
        include("includes/bannerLateral.php");
        include("includes/rodape.php");
        ?>
    </body>
</html>
