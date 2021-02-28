<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codregra"])){
        include("../../controlador/ControleRegraDesconto.php");
        if(isset($retorno)){
            $regra = mysql_fetch_array($retorno);
        }else{
            $regra = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "RegraDesconto") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script>  
        <title><?=$empresa["fantasia"]?> - Regra de Desconto</title>
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
                <form action="../../controlador/ControleRegraDesconto.php" name="formRegraDesconto" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de regras</legend>
                        <input type="hidden" name="codregra" value="<?php if(isset($regra)){echo($regra["codregra"]);}?>"/>                  
                        <p>
                            <label>Nome:</label>
                            <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($regra)){echo($regra["nome"]);}?>"/>
                        </p>
                        <p>
                            <label>Tipo valor:</label>
                            <select name="tipovalor">
                                <?php if(isset($regra) && $regra["tipovalor"] === "Dinheiro"){ ?>
                                    <option selected>Dinheiro</option>
                                <?php }else{?>
                                    <option>Dinheiro</option>
                                <?php }?>
                                <?php if(isset($regra) && $regra["tipovalor"] === "Dinheiro"){ ?>
                                    <option selected>Porcentual</option>
                                <?php }else{?>
                                    <option>Porcentual</option>
                                <?php }?>
                            </select>
                        </p>   
                        <p>
                            <label>Valor:</label>
                            <input required type="text" name="valor" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($regra)){echo(number_format($regra['valor'], 2, ',', '.'));}?>"/>
                        </p>    
                        <p>
                            <label>Qtd. min:</label>
                            <input required type="number" name="qtdmin" size="5" maxlength="5" value="<?php if(isset($regra)){echo($regra["qtdmin"]);}else{echo("1");}?>"/>
                        </p>   
                        <p>
                            <label>Qtd. máx:</label>
                            <input required type="number" name="qtdmax" size="5" maxlength="5" value="<?php if(isset($regra)){echo($regra["qtdmax"]);}?>"/>
                        </p>                       
                        <p>
                            <?php if(!isset($regra)){?>
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
