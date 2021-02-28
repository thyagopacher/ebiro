<?php
    session_start();
    $painel = TRUE;
    include("includes/validaLogin.php");    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Novidades") === FALSE){
        $_SESSION["erro"] = "";
    }     
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/CarregaEditor.js"></script>    
    </head>
    <body>
        <header>
        <?php 
        include("includes/topo.php");
        ?>
        </header>
        <article>
            <?php include("includes/menuLateral.php");?>
            <div id="conteudo">
                <?php
                if(isset($_SESSION["erro"]) && $_SESSION["erro"] !== NULL && $_SESSION["erro"] !== ""){
                    echo("<div id='erro'>");
                    echo($_SESSION["erro"]);
                    echo("</div>");
                }
                ?>            
                <form action="../../controlador/EnviaNovidades.php" name="formNovidades" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de novidades</legend>
                        <p>
                            <label>Titulo:</label>
                            <input required type="text" name="titulo" size="50" maxlength="50"/>
                        </p>
                        <p>
                            <label>Texto:</label>
                            <textarea name="texto" cols="80" rows="10" required></textarea>
                        </p>   
                        <p>
                            <input type="submit" name="submit" value="Enviar"/>
                        </p>
                    </fieldset>
                </form>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
