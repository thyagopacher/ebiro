<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codproduto"])){
        include("../../controlador/ControlePagamentoEletronico.php");
        if(isset($retorno)){
            $produto = mysql_fetch_array($retorno);
        }else{
            $produto = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "PagamentoEletronico") === FALSE){
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
        <link href="../recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
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
            <?php include("includes/menuLateral.php");?>
            <div id="conteudo">
                <?php
                if(isset($_SESSION["erro"]) && $_SESSION["erro"] !== NULL && $_SESSION["erro"] !== ""){
                    echo("<div id='erro'>");
                    echo($_SESSION["erro"]);
                    echo("</div>");
                }
                ?>            
                <form action="../../controlador/ControlePagamentoEletronico.php" name="formPagamentoEletronico" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de pagamento eletronico</legend>
                        <input type="hidden" name="codproduto" value="<?php if(isset($produto)){echo($produto["codproduto"]);}?>"/>
                        <p>
                            <label>Nome:</label>
                            <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($produto)){echo($produto["taxa"]);}?>"/>
                        </p>
                        <p>
                            <label>Taxa:</label>
                            <input required type="text" name="taxa" size="5" maxlength="5" value="<?php if(isset($produto)){echo($produto["nome"]);}?>"/>
                        </p>                    
                        <p>
                            <label>E-mail:</label>
                            <textarea cols="100" rows="10" name="descricao"><?=$produto["descricao"]?></textarea>
                        </p>                 
                        <p>
                            <?php if(!isset($produto)){?>
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
