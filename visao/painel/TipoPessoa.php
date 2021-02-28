<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codtipo"])){
        include("../../controlador/ControleTipoPessoa.php");
        if(isset($retorno)){
            $tipo = mysql_fetch_array($retorno);
        }else{
            $tipo = NULL;
        }
    }   
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "TipoPessoa") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Tipo Pessoa</title>
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
            <form action="../../controlador/ControleTipoPessoa.php" name="formTipoPessoa" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de tipos</legend>
                    <input type="hidden" name="codtipo" value="<?php if(isset($tipo)){echo($tipo["codtipo"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($tipo)){echo($tipo["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <?php if(!isset($tipo)){?>
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
                    include("../../controlador/ControleTipoPessoa.php");
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
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                $total = 0;
                                while($tipo = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $tipo["codtipo"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='TipoPessoa.php?codtipo=$tipo[codtipo]&submit=Procurar' title='Perfil da tipo'>". $tipo["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".$tipo["qtd"]."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='TipoPessoa.php?codtipo=$tipo[codtipo]&submit=Procurar' title='Perfil da tipo'><img src='$caminho/recursos/imagens/editar.gif' alt=''/></a></td>");
                                    echo("<td><a href='../../controlador/ControleTipoPessoa.php?codtipo=$tipo[codtipo]&submit=Excluir' title='Excluir da tipo'>Excluir</a></td>");
                                    echo("</tr>");
                                    $total = $total + $tipo["qtd"];
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                    <tfoot>
                                        <tr>
                                            <td style='border-right: 1px solid #777777;' title="Quantidade em pessoas">Total:</td>
                                            <td style='border-right: 1px solid #777777;'><?=$total?></td>
                                        </tr>                  
                                    </tfoot>                                       
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
