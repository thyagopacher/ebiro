<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ListaSlideShow") === FALSE){
        $_SESSION["erro"] = "";
    }     
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include("../includes/head.php");?>
        <link href="<?=$caminho?>/recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
        <link href="<?=$caminho?>recursos/css/tema1/menuLateral_2.css" type="text/css" rel="stylesheet" />
        <?php include("includes/javascriptMenulateral.php");?>            
        <title><?=$empresa["fantasia"]?> - Lista de Slide Show</title>
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
            <?php
                    $painel = TRUE;
                    include("../../controlador/ProcurarSlide.php");
                    if(isset($retornoslides)){
                        $qtd = mysql_num_rows($retornoslides);
                        echo("Encontrou $qtd resultados<br>");
             ?>
             -Clique no titulo para editar o slide<br>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Titulo</th>
                                        <th style='border-right: 1px solid #777777;'>Texto</th>
                                        <th style='border-right: 1px solid #777777;'>Imagem</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($slideshow = mysql_fetch_array($retornoslides)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $slideshow["codslideshow"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='SlideShow.php?codslideshow=$slideshow[codslideshow]&submit=Procurar' title='Perfil da slideshow'>". $slideshow["titulo"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $slideshow["texto"] ."</td>");
                                    if(isset($slideshow["imagem"]) && $slideshow["imagem"] !== NULL && $slideshow["imagem"] !== ""){
                                        echo("<td style='border-right: 1px solid #777777;'><img width='100' height='50' src='../recursos/imagens/$slideshow[imagem]' alt='Imagem slideshow' title='Imagem slideshow'/></td>");
                                    }else{
                                        echo("<td style='border-right: 1px solid #777777;'>Nada encontrado</td>");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'><a href='SlideShow.php?codslideshow=$slideshow[codslideshow]&submit=Procurar'><img src='$caminho/recursos/imagens/editar.gif' alt=''/></a></td>");
                                    echo("<td>");
                                    echo("<a class='btexcluir' href='../../controlador/ControleSlideShow.php?codslideshow=$slideshow[codslideshow]&submit=Excluir' title='Excluir de slideshow'>X</a>");
                                    echo("</td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                            </table>
                    <?php
                         }
            ?>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
