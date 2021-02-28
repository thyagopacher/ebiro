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
    require_once($antes."controlador/ProcurarTodosBanners.php");
    $banners = $retornobanners;
?>
<div id="bannerLateral">
    <div id="marqueecontainer" onmouseover="copyspeed=pausespeed;" onmouseout="copyspeed=marqueespeed;">
        <div id="vmarquee" style="position: absolute; width: 100px; margin-top: 6%;">    
            <?php
            if($qtdbanner > 0 && isset($banners) && !empty($banners) && $banners !== NULL && $banners !== ""){
                while($banner = mysql_fetch_array($banners)){
                    if($banner["posicao"] === "direita"){
                        echo("<a href='$banner[linksite]'>");
                        echo("<img width='100' height='80' src='".$caminho."recursos/imagens/$banner[imagem]' title='Imagem banner'/>");
                        echo("</a>");
                    }
                }
            }else{
                echo("Nada encontrado");
            }
            ?>
        </div>
    </div>
</div>