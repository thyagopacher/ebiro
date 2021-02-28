<?php
    $painel = TRUE;
    include("includes/validaLogin.php");    
    if(isset($_REQUEST["codcategoria"])){
        include("../../controlador/ControleCategoriaPlano.php");
        if(isset($retorno) && $retorno !== FALSE){
            $categoria    = mysql_fetch_array($retorno);
            $nome         = $categoria["nome"];
            $codcategoria = $categoria["codcategoria"];
        }else{
            $categoria = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "CategoriaPlano") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Categoria Plano</title>
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
            <form action="../../controlador/ControleCategoriaPlano.php" name="formCategoria" method="post">
                <fieldset>
                    <legend>Gerenciamento de categoria</legend>
                    <input type="hidden" name="codcategoria" value="<?php echo($codcategoria);?>"/>
                                         
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php echo($nome)?>"/>
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
                    include("../../controlador/ControleCategoriaPlano.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table border="1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Qtd. Planos</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($categoria = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td>". $categoria["codcategoria"] ."</td>");
                                    echo("<td><a href='CategoriaPlano.php?codcategoria=$categoria[codcategoria]&submit=Procurar' title='Perfil da categoria'>". $categoria["nome"] ."</a></td>");
                                    echo("<td>".$categoria["qtd"]."</td>");
                                    echo("<td><a href='../../controlador/ControleCategoriaPlano.php?codcategoria=$categoria[codcategoria]&submit=Excluir' title='Excluir da categoria'>Excluir</a></td>");
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