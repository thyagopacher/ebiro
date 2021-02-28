<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ProcurarProduto") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/PesquisaProduto.js"></script>
        <title><?=$empresa["fantasia"]?> - Procurar Produto</title>
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
                    <fieldset>
                        <legend>Procurar Produto</legend>
                        <p>
                            <label>Nome:</label>
                            <input type="search" placeholder="Digite aqui o nome para pesquisa" name="nome" id="nome" size="50" maxlength="50"/>
                            <input type="hidden" name="submited" value="true"/>
                            <button onclick="procuraProduto();">Procurar</button>
                        </p> 
                        <p>
                            Fórmula:<br>
                            Final: Valor  - Desconto + Lucro
                        </p>
                    </fieldset>
                <div id="txtHint"><b>Informações dos produtos serão listadas aqui...</b></div>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
