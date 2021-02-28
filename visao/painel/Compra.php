<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codcompra"])){
        include("../../controlador/ControleComprar.php");
        if(isset($retorno)){
            $compra = mysql_fetch_array($retorno);
        }else{
            $compra = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Compra") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Compra</title>
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
            <form action="../../controlador/ControleComprar.php" name="formComprar" method="post">
                <fieldset>
                    <legend>Gerenciamento de Comprar</legend>
                    <p>
                        <label>Data:</label>
                        <input required type="date" name="data" value="<?php if(isset($compra)){echo($compra["data"]);}?>"/>
                    </p>                   
                    <p>
                        <label>Funcionário:</label>
                        <input required type="text" name="funcionario" size="50" maxlength="50" value="<?php if(isset($compra)){echo($compra["nome"]);}?>"/>
                    </p>
                    <p>
                        <label>Produto:</label>
                        <input required type="text" name="compra" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($compra)){echo($compra["valor"]);}?>"/>
                    </p>                              
                    <p>
                        <?php if(!isset($compra)){?>
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
