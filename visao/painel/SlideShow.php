<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codslideshow"])){
        include("../../controlador/ControleSlideShow.php");
        if(isset($retorno)){
            $slideshow = mysql_fetch_array($retorno);
        }else{
            $slideshow = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "SlideShow") === FALSE){
        $_SESSION["erro"] = "";
    }     
    include("../../controlador/ProcurarTodasCategorias.php");
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
        <title><?=$empresa["fantasia"]?> - Slide Show</title>
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
            if(isset($_SESSION["erro"]) && $_SESSION["erro"] !== NULL && $_SESSION["erro"] !== ""){
                echo("<div id='erro'>");
                echo($_SESSION["erro"]);
                echo("</div>");
            }
            ?>        
            <form action="../../controlador/ControleSlideShow.php" name="formSlideShow" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de slideshows</legend>
                    <input type="hidden" name="codslideshow" value="<?=$slideshow["codslideshow"]?>"/>
                    <p>
                        <label>Título:</label>
                        <input type="text" name="titulo" size="80" maxlength="100" value="<?php if(isset($slideshow)){echo($slideshow["titulo"]);}?>"/>
                    </p>
                    <p>
                        <label>Link:</label>
                        <input type="text" name="link" size="80" value="<?php if(isset($slideshow)){echo($slideshow["link"]);}?>"/>
                    </p>                    
                    <p>
                        <label>Foto:</label>
                        <input type="file" name="imagem" accept="image/*"/>
                        <?php if(isset($slideshow)){echo("<img width='150' height='100' src='../recursos/imagens/$slideshow[imagem]' alt='Imagem slide' title='Imagem slide'/>");}?>
                    </p>
                    <p>
                        <label>Texto:</label>
                        <textarea cols="80" rows="10" name="texto"><?php if(isset($slideshow)){echo($slideshow["texto"]);}?></textarea>
                    </p>
                    <p>
                        <?php if(!isset($slideshow)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
