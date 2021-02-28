<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codvenda"])){
        include("../../controlador/ControleVenda.php");
        if(isset($retorno)){
            $venda = mysql_fetch_array($retorno);
        }else{
            $venda = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Venda") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script>
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
            if(isset($_SESSION["erro"]) && $_SESSION["erro"] !== NULL && $_SESSION["erro"] !== ""){
                echo("<div id='erro'>");
                echo($_SESSION["erro"]);
                echo("</div>");
            }
            ?>   
            <div id="conteudo">
                <form action="../../controlador/ControleVenda.php" name="formVenda" method="post">
                    <fieldset>
                        <legend>Gerenciamento de Venda</legend>
                        <p>
                            <label>Data:</label>
                            <input required type="date" name="data" value="<?php if(isset($venda)){echo($venda["data"]);}?>"/>
                        </p>                     
                        <p>
                            <label>Cliente:</label>
                            <input required type="text" name="cliente" size="50" maxlength="50" value="<?php if(isset($venda)){echo($venda["cliente"]);}?>"/>
                        </p>                            
                        <p>
                            <?php if(!isset($venda)){?>
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
