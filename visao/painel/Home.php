<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head.php");?>
        <link href="<?=$caminho?>/recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
        <link href="<?=$caminho?>recursos/css/tema1/menuLateral_2.css" type="text/css" rel="stylesheet" />
        <?php include("includes/javascriptMenulateral.php");?>          
        <title><?=$empresa["fantasia"]?> - Painel Home</title>
    </head>
    <body>
        <header>
        <?php 
        include("includes/topo.php");
        ?>
        </header>
        <article>
            <?php
            include("includes/menuLateral.php");
            ?>
            <div id="conteudo">
                
                <?php 
                if(isset($_SESSION["codpessoa"])){
                    $_REQUEST["codpessoa"] = $_SESSION["codpessoa"];
                    $_REQUEST["submit"]    = "Procurar";
                    include("../../controlador/ControlePessoa.php");
                    $pessoa = mysql_fetch_array($retorno);
                    echo("<span class='BemVindo'>Bem vindo ao sistema:  Conectado como - <a href='Pessoa.php?codpessoa=".$_SESSION["codpessoa"]."' title='Clique para editar perfil'>".$pessoa["nome"]."</a></span>");
                }                
                include("includes/quadros.php");
                ?>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
