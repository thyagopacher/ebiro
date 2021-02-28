<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codcor"])){
        include("../../controlador/ControleCor.php");
        if(isset($retorno)){
            $cor = mysql_fetch_array($retorno);
        }else{
            $cor = NULL;
        }
    }    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Cor") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Cor</title>
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
            <form action="../../controlador/ControleCor.php" name="formCor" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de cores</legend>
                    <input type="hidden" name="codcor" value="<?php if(isset($cor)){echo($cor["codcor"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($cor)){echo($cor["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Valor:</label>
                        <input required type="color" name="valor" size="10" maxlength="10" value="<?php if(isset($cor)){echo(($cor['valor']));}?>"/>
                    </p> 
                                      
                    <p>
                        <?php if(!isset($cor)){?>
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
                    include("../../controlador/ControleCor.php");
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
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($cor = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $cor["codcor"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Cor.php?codcor=$cor[codcor]&submit=Procurar' title='Perfil da cor'>". $cor["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".($cor['valor'])."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Cor.php?codcor=$cor[codcor]&submit=Procurar' title='Perfil da cor'><img src='$caminho/recursos/imagens/editar.gif' alt=''/></a></td>");
                                    echo("<td><a href='../../controlador/ControleCor.php?codcor=$cor[codcor]&submit=Excluir' title='Excluir da cor'>Excluir</a></td>");
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
        <?php //include("includes/rodape.php");?>
    </body>
</html>
