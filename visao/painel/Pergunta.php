<?php
    $painel = TRUE;
    include("includes/validaLogin.php");    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Pergunta") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Pergunta</title>
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
            <form action="../../controlador/ControlePergunta.php" method="post" name="formpergunta">
                <fieldset>
                    <legend>Cadastro Pergunta</legend>
                    <input type="hidden" name="codpergunta" value="<?php if(isset($pergunta["codpergunta"])){echo($pergunta["codpergunta"]);}?>"/>
                    <p>
                        <label>Categoria:</label>
                        <select name="codcategoria">
                            <?php
                                if(mysql_num_rows($retornotudo) > 0){
                                    while($categoria = mysql_fetch_array($retornotudo)){
                                        if(isset($produto["codcategoria"]) && $produto["codcategoria"] === $categoria["codcategoria"]){
                                            echo("<option value='$categoria[codcategoria]' selected>".$categoria["nome"]."</option>");
                                        }else{
                                            echo("<option value='$categoria[codcategoria]'>".$categoria["nome"]."</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                            ?>
                        </select>
                    </p>                    
                    <p>
                        <label>Pergunta:</label>
                        <input type="text" required name="pergunta" size="100" maxlength="200" value="<?php if(isset($pergunta["pergunta"])){echo($pergunta["pergunta"]);}?>"/>
                    </p>
                    <p>
                        <label>Resposta:</label><br>
                        <textarea required name="resposta" cols="80" rows="5" placeholder="Digite aqui a resposta"><?php if(isset($pergunta["resposta"])){echo($pergunta["resposta"]);}?></textarea>
                    </p>                            
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <?php if(!isset($pergunta)){?>
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
