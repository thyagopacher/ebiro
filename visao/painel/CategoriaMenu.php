<?php
    try{
        $painel = TRUE;
        include("includes/validaLogin.php");
        if(isset($_REQUEST["codcategoria"])){
            include("../../controlador/ControleCategoriaMenu.php");
            if(isset($retorno) && $retorno !== FALSE){
                $categoria    = mysql_fetch_array($retorno);
                $nome         = $categoria["nome"];
                $codcategoria = $_REQUEST["codcategoria"];
            }else{
                $categoria = NULL;
            }
        }
    }catch(Exception $ex){
        echo("Erro causado por: $ex");
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "CategoriaMenu") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Categoria Menu</title>
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
            <form action="../../controlador/ControleCategoriaMenu.php" name="formCategoria" method="post">
                <fieldset>
                    <legend>Gerenciamento de categoria</legend>
                    <input type="hidden" name="codcategoria" value="<?php echo($codcategoria);?>"/>
                                         
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($_REQUEST["codcategoria"])){echo($nome);}?>"/>
                    </p>                             
                    <p>
                        <?php if(!isset($_REQUEST["codcategoria"])){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            -Clique sobre o nome para editar<br>
            <?php
                    $_REQUEST["submit"] = "Procurar Nome";
                    include("../../controlador/ControleCategoriaMenu.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Nome</th>
                                        <th style='border-right: 1px solid #777777;'>Qtd. Menus</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($categoria = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $categoria["codcategoria"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='CategoriaMenu.php?codcategoria=$categoria[codcategoria]&submit=Procurar' title='Perfil da categoria'>". $categoria["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".$categoria["qtd"]."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='CategoriaMenu.php?codcategoria=$categoria[codcategoria]&submit=Procurar' title='Perfil da categoria'><img src='$caminho/recursos/imagens/editar.gif' alt='bt editar'/></a></td>");
                                    echo("<td><a href='../../controlador/ControleCategoriaMenu.php?codcategoria=$categoria[codcategoria]&submit=Excluir' title='Excluir da categoria' class='btexcluir'>X</a></td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                            </table>
                    <?php
                         }else{
                             echo("Nada encontrado");
                         }
            ?>
            </div>
        </article>
    </body>
</html>
