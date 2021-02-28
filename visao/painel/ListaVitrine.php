<?php
    session_start();
    $painel = TRUE;
    include("includes/validaLogin.php");
    include("../../controlador/ProcurarProdutoVitrine.php");
    $produtos = $retornoproduto;
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ListaVitrine") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Lista Vitrine</title>
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
            if(mysql_num_rows($produtos) > 0){
                echo("<table>");
                echo("<thead>");
                echo("<tr>");
                echo("<th style='border-right: 1px solid #777777;'>Código</th>");
                echo("<th style='border-right: 1px solid #777777;'>Nome</th>");
                echo("<th style='border-right: 1px solid #777777;'>Valor</th>");
                echo("<th style='border-right: 1px solid #777777;'>Editar</th>");
                echo("<th title='Tirar da vitrine'>Excluir</th>");
                echo("</tr>");
                echo("</thead>");
                echo("<tbody>");
                $total = 0.0;
                while($produto = mysql_fetch_array($produtos)){
                    echo("<tr>");
                    echo("<td style='border-right: 1px solid #777777;'>$produto[codproduto]</td>");
                    echo("<td style='border-right: 1px solid #777777;'>$produto[nome]</td>");
                    echo("<td style='border-right: 1px solid #777777;'>".number_format($produto['valor'], 2, ',', '.')."</td>");
                    echo("<td style='border-right: 1px solid #777777;'><a href='Produto.php?codproduto=$produto[codproduto]' titile='Editar produto'><img src='$caminho/recursos/imagens/editar.gif' alt='editar'/></a></td>");
                    echo("<td><a title='Retira o produto da vitrine, mas não exclui ele do estoque' href='../../controlador/ControleProduto.php?codproduto=$produto[codproduto]&submit=Excluir Vitrine' class='btexcluir'>X</a></td>");
                    echo("</tr>");
                    $total = $total + $produto["valor"];
                }
                echo("</tbody>");
                ?>
                <tfoot>
                    <tr>
                        <td style='border-right: 1px solid #777777;' title="Total em produtos">Total:</td>
                        <td style='border-right: 1px solid #777777;'><?=number_format($total, 2, ',', '.')?></td>
                    </tr>                 
                </tfoot>                  
                <?php
                echo("</table>");
            }else{
                echo("Nada encontrado");
            }
?>                
                
            
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
