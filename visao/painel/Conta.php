<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codconta"])){
        require_once("../../controlador/ControleConta.php");
        if(isset($retorno)){
            $conta = mysql_fetch_array($retorno);
        }else{
            $conta = NULL;
        }
    }    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Conta") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Conta</title>
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
            <form action="../../controlador/ControleConta.php" name="formConta" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de contas</legend>
                    <input type="hidden" name="codconta" value="<?php if(isset($conta)){echo($conta["codconta"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($conta)){echo($conta["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Valor:</label>
                        <input required type="text" name="valor" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($conta)){echo(number_format($conta['valor'], 2, ',', '.'));}?>"/>
                    </p> 
                    <p>
                        <label>Situação:</label>
                        <select name="situacao">
                            <option <?php if(isset($conta["situacao"]) && $conta["situacao"] === "PAGO"){echo("selected");}?>>PAGO</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "NÃO-PAGO"){echo("selected");}?>>NÃO-PAGO</option>
                        </select>
                    </p>     
                    <p>
                        <label>Vencimento:</label>
                        <input title="Data de cobrança da conta" required type="date" name="vencimento" value="<?php if(isset($conta)){echo($conta["vencimento"]);}?>"/>
                    </p>    
                    <p>
                        <label>Periodo</label>
                        <select name="periodo" title="Periodo de cobrança">
                            <option title="Para pagamentos em uma única vez" <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Sem"){echo("selected");}?>>Sem</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Mensal"){echo("selected");}?>>Mensal</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Bimestral"){echo("selected");}?>>Bimestral</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Trimestral"){echo("selected");}?>>Trimestral</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Semestral"){echo("selected");}?>>Semestral</option>
                            <option <?php if(isset($conta["periodo"]) && $conta["periodo"] === "Anual"){echo("selected");}?>>Anual</option>
                        </select>
                    </p>
                    <p>
                        <label>Parcela:</label>
                        <input type="number" name="parcela" value="<?=$conta["parcela"]?>"/>
                    </p>
                    <p>
                        <?php if(!isset($conta)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            <form action="" method="post" name="fconta">
                <fieldset>
                    <legend>Busca por:</legend>
                    <p>
                        <label>Situação:</label>
                        <select name="situacao">
                            <option>PAGO</option>
                            <option>NÃO-PAGO</option>
                        </select>
                    </p>
                    <p>
                        <input type="hidden" name="acao" value="ProcurarSit"/>
                        <input type="submit" name="submit" value="Procurar Situação"/>
                    </p>
                </fieldset>
            </form>
            <?php
                    $_REQUEST["acao"] = "ProcurarSit";
                    require_once("../../controlador/ControleConta.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Nome</th>
                                        <th style='border-right: 1px solid #777777;'>Valor</th>
                                        <th style='border-right: 1px solid #777777;'>Situação</th>
                                        <th style='border-right: 1px solid #777777;'>Vencimento</th>
                                        <th style='border-right: 1px solid #777777;'>Período</th>
                                        <th style='border-right: 1px solid #777777;'>Parcela</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                $total = 0.0;
                                while($conta = mysql_fetch_array($retorno)){
                                    $total = $total + $conta["valor"];
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $conta["codconta"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Conta.php?codconta=$conta[codconta]&submit=Procurar' title='Perfil da conta'>". $conta["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".number_format($conta['valor'], 2, ',', '.')."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".$conta['situacao']."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".strftime("%d/%m/%Y", strtotime(($conta["vencimento"])))."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>$conta[periodo]</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>$conta[parcela]</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Conta.php?codconta=$conta[codconta]&submit=Procurar' title='Perfil da conta'><img src='$caminho/recursos/imagens/editar.gif' alt='Editar'/></a></td>");
                                    echo("<td>");
                                    echo("<a class='btexcluir' href='../../controlador/ControleConta.php?codconta=$conta[codconta]&submit=Excluir' title='Excluir da conta'>X</a>");
                                    echo("</td>");
                                    echo("</tr>");
                                }
                                echo("<tfoot>");
                                echo("<tr>");
                                echo("<td>Total:</td>");
                                echo("<td>".number_format($total, 2, ',', '.')."</td>");
                                echo("</tr>");
                                echo("</tfoot>");
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
        <?php //include("includes/rodape.php");?>
    </body>
</html>
