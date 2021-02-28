<?php
    if(isset($painel) && $painel === "INDEX"){
        $antes = "";
    }else{
        $antes = "../";
    }
    include($antes."controlador/ProcurarSlide.php");
?>

<div id="wrapper">
    <div>
            <div id="slideshow">
                    <ul id="slides">
                        <?php 
                        if(isset($retornoslides) && mysql_num_rows($retornoslides) > 0){
                            while($slideshow = mysql_fetch_array($retornoslides)){
                        ?>
                            <li>
                                <?php if((!isset($slideshow["imagem"]) || (isset($slideshow["imagem"]) && ($slideshow["imagem"] === NULL || $slideshow["imagem"] === ""))) && isset($slideshow["titulo"]) && isset($slideshow["texto"])){?>
                                    <div id="content">
                                            <h1><?=$slideshow["titulo"]?></h1>
                                            <p><?=$slideshow["texto"]?></p>
                                    </div>
                                <?php }?>
                                <?php if(isset($slideshow["imagem"]) && $slideshow["imagem"] !== NULL && $slideshow["imagem"] !== "" && isset($slideshow["titulo"]) && isset($slideshow["texto"])){?>
                                        <div id="caption">
                                                <img src="visao/recursos/imagens/<?=$slideshow["imagem"]?>" title="Imagem Slide Show <?=$slideshow["titulo"]?>" alt="Imagem Slide Show <?=$slideshow["titulo"]?>">
                                                <div>
                                                        <h3><?php echo($slideshow["titulo"]);?></h3>
                                                        <p><?=$slideshow["texto"]?></p>
                                                </div>
                                        </div>                                
                                <?php }?>
                                <?php if(isset($slideshow["imagem"]) && $slideshow["imagem"] !== NULL && $slideshow["imagem"] !== "" &&  !isset($slideshow["titulo"]) && !isset($slideshow["texto"])){?>
                                    <img src="visao/recursos/imagens/<?=$slideshow["imagem"]?>" alt="Coral Reef">
                                <?php }?>
                            </li>
                        <?php 
                            }
                        }else{
                            echo("Não encontrado");
                        }
                        ?>
                    </ul>
            </div>
    </div>
    <ol id="pagination" class="pagination">
        <?php 
        if(isset($retornoslides) && mysql_num_rows($retornoslides) > 0){
            $tam = 0;
            while($tam < mysql_num_rows($retornoslides)){
                echo("<li></li>");
                $tam = $tam + 1;
            }
        }else{
            echo("Nada encontrado");
        }
        ?>
    </ol>
</div>
<script>
var ss = new TINY.fader.init('ss', {
	id: 'slides',
	auto: 4,
	resume: true,
	navid: 'pagination',
	navEvent: 'mouseover',
	activeClass: 'current',
	pauseHover: true
});
</script>