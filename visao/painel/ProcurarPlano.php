<?php
    $painel = TRUE;
    include("includes/validaLogin.php");    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ProcurarPlano") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Procurar Plano</title>
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
            <form action="" method="post" name="formplano">
                <fieldset>
                    <legend>Procurar Plano</legend>
                    <p>
                        <label>Plano:</label>
                        <input type="search" placeholder="Digite aqui a plano para pesquisa" name="plano" size="50" maxlength="50"/>
                    </p>    
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <input type="submit" name="submit" value="Procurar Plano"/>
                    </p>
                </fieldset>
            </form>
            <?php
                    $_REQUEST["submit"] = "Procurar Plano";
                    include("../../controlador/ControlePlano.php");
                    if(isset($retorno) && $retorno !== NULL && $retorno !== FALSE){?>
                           <table border="1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Plano</th>
                                        <th>Vl. Mensal</th>
                                        <th>Vl. Trimestral</th>
                                        <th>Vl. Semestral</th>
                                        <th>Vl. Anual</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if(mysql_num_rows($retorno) > 0){
                                while($plano = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td>". $plano["codplano"] ."</td>");
                                    echo("<td><a href='Plano.php?codplano=$plano[codplano]&submit=Procurar' title='Perfil da plano'>". $plano["descricao"] ."</a></td>");
                                    echo("<td>".number_format($plano['valor_mensal'], 2, ',', '.')."</td>");
                                    echo("<td>".number_format($plano['valor_trimenstral'], 2, ',', '.')."</td>");
                                    echo("<td>".number_format($plano['valor_semestral'], 2, ',', '.')."</td>");
                                    echo("<td>".number_format($plano['valor_anual'], 2, ',', '.')."</td>");
                                    echo("<td>");
                                    echo("<a class='btexcluir' title='Clique aqui para excluir' href='../../controlador/ControlePlano.php?submit=Excluir&codplano=$plano[codplano]'>X</a>");
                                    echo("<a href='Plano.php?codplano=$plano[codplano]'>Editar</a>");                                    
                                    echo("</td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                            </table>
                    <?php
                         }else{
                             echo("Sem retorno de listagem");
                         }
            ?>
            </div>
        </article>
    </body>
</html>