<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ProcurarVenda") === FALSE){
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
            <form action="" method="post" name="formvenda">
                <fieldset>
                    <legend>Procurar Venda</legend>
                    <p>
                        <label>Data:</label>
                        <input type="date" name="nome" />
                    </p>                     
                    <p>
                        <label>Nome:</label>
                        <input type="text" placeholder="Digite aqui o nome para pesquisa do cliente" name="nome" size="50" maxlength="50"/>
                    </p>                  
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <input type="submit" name="submit" value="Procurar Nome"/>
                    </p>
                </fieldset>
            </form>
            <?php
                if($_POST && $_REQUEST["submited"] === "true"){
                    $painel = TRUE;
                    include("../../controlador/ControleVenda.php");
                    if(isset($retorno)){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Cliente</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($venda = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $venda["codvenda"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $venda["cliente"] ."</td>");
                                    echo("<td><a href='../../controlador/Venda.php?codvenda=$venda[codvenda]&submit=Procurar' title='Perfil da venda'>". $venda["data"] ."</a></td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                            </table>
                    <?php
                         }
                    }else{
                        echo("Retorno não setado no controlador");
                    }
            ?>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
