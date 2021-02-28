<?php
    $painel = TRUE;
    include("includes/validaLogin.php");    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Plano") === FALSE){
        $_SESSION["erro"] = "";
    }     
    if(isset($_REQUEST["codplano"])){
        $_REQUEST["submit"]   = "Procurar";
        include("../../controlador/ControlePlano.php");
        $plano = mysql_fetch_array($retorno);
    }
    $_REQUEST["submit"] = "Procurar Nome";
    $_REQUEST["nome"]   = "";
    include("../../controlador/ControleCategoriaPlano.php");    
    $categoriasplano = $retorno;    
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
        <title><?=$empresa["fantasia"]?> - Plano</title>
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
            <form action="../../controlador/ControlePlano.php" method="post" name="formplano">
                <fieldset>
                    <legend>Cadastro Plano</legend>
                    <input type="hidden" name="codplano" value="<?php if(isset($plano["codplano"])){echo($plano["codplano"]);}?>"/>
                    <p>
                        <label>Categoria:</label>
                        <select name="codcategoria">
                            <?php
                            if(isset($categoriasplano) && mysql_num_rows($categoriasplano) > 0 && $categoriasplano !== FALSE){
                                echo("<option>Nada escolhido</option>");
                                while($categoria = mysql_fetch_array($categoriasplano)){
                                    if(isset($plano) && $plano["codcategoria"] === $categoria["codcategoria"]){
                                        echo("<option value='$categoria[codcategoria]' selected>$categoria[nome]</option>");
                                    }else{
                                        echo("<option value='$categoria[codcategoria]'>$categoria[nome]</option>");
                                    }
                                }
                            }else{
                                echo("<option>Nada encontrado</option>");
                            }
                            ?>
                        </select>
                    </p>                    
                    <p>
                        <label>Descrição:</label>
                        <input type="text" required name="descricao" size="50" maxlength="50" value="<?php if(isset($plano["descricao"])){echo($plano["descricao"]);}?>"/>
                    </p>
                    <p>
                        <label>Valor Mensal:</label>
                        <input required type="text" name="valor_mensal" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($plano)){echo(number_format($plano['valor_mensal'], 2, ',', '.'));}?>"/>
                    </p>
                    <p>
                        <label>Valor Trimenstral:</label>
                        <input required type="text" name="valor_trimenstral" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($plano)){echo(number_format($plano['valor_trimenstral'], 2, ',', '.'));}?>"/>
                    </p>   
                    <p>
                        <label>Valor Semestral:</label>
                        <input required type="text" name="valor_semestral" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($plano)){echo(number_format($plano['valor_semestral'], 2, ',', '.'));}?>"/>
                    </p>
                    <p>
                        <label>Valor Anual:</label>
                        <input required type="text" name="valor_anual" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($plano)){echo(number_format($plano['valor_anual'], 2, ',', '.'));}?>"/>
                    </p>                     
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <?php if(!isset($plano)){?>
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
    </body>
</html>