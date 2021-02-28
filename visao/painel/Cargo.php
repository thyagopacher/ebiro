<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codcargo"])){
        include("../../controlador/ControleCargo.php");
        if(isset($retorno)){
            $cargo = mysql_fetch_array($retorno);
        }else{
            $cargo = NULL;
        }
    }    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Cargo") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Cargo</title>
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
            <form action="../../controlador/ControleCargo.php" name="formCargo" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de cargos</legend>
                    <input type="hidden" name="codcargo" value="<?php if(isset($cargo)){echo($cargo["codcargo"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($cargo)){echo($cargo["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Salário:</label>
                        <input required type="text" name="salario" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($cargo)){echo(number_format($cargo['salario'], 2, ',', '.'));}?>"/>
                    </p> 
                                      
                    <p>
                        <?php if(!isset($cargo)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            <?php
                    $_REQUEST["submit"] = "Procurar Nome";
                    $_REQUEST["nome"]   = "";
                    include("../../controlador/ControleCargo.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Nome</th>
                                        <th style='border-right: 1px solid #777777;'>Qtd. Pessoas</th>
                                        <th style='border-right: 1px solid #777777;'>Salário</th>
                                        <th style='border-right: 1px solid #777777;'>Total</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                $total = 0.0;
                                while($cargo = mysql_fetch_array($retorno)){
                                    $total = $total + $cargo["total"];
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $cargo["codcargo"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Cargo.php?codcargo=$cargo[codcargo]&submit=Procurar' title='Perfil da cargo'>". $cargo["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".$cargo["qtd"]."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".number_format($cargo['salario'], 2, ',', '.')."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".number_format($cargo['total'], 2, ',', '.')."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Cargo.php?codcargo=$cargo[codcargo]&submit=Procurar' title='Perfil da cargo'><img src='$caminho/recursos/imagens/editar.gif' alt=''/></a></td>");
                                    echo("<td><a class='btexcluir' href='../../controlador/ControleCargo.php?codcargo=$cargo[codcargo]&submit=Excluir' title='Excluir da cargo'>X</a></td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td title="Total da folha salarial a pagar">Total:</td>
                                        <td><?=number_format($total, 2, ',', '.')?></td>
                                    </tr>
                                </tfoot>                               
                            </table>
                    <?php
                         }else{
                             echo("Nada encontrado");
                         }
            ?> 
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
