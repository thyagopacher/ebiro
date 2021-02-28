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
    $posicao = "meio";
    require_once($antes."controlador/ProcurarBannerPosicao.php");
?>
<div id="bannerMeio">
    <?php
            if($qtdbanner > 0){
                while($banners = mysql_fetch_array($retornobanners)){
                    if($banners["posicao"] === "meio"){
                        echo("<a href='$banners[linksite]'>");
                        echo("<img src='".$antes."visao/recursos/imagens/$banners[imagem]' title='Imagem banner'/>");
                        echo("</a>");
                    }
                }
            }else{
                echo("Nada encontrado");
            }     
    ?>
</div>