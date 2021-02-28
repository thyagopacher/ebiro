<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codfabricante"])){
        include("../../controlador/ControleFabricante.php");
        if(isset($retorno)){
            $fabricante = mysql_fetch_array($retorno);
        }else{
            $fabricante = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Fabricante") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Fabricantes</title>
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
            <form action="../../controlador/ControleFabricante.php" name="formFabricante" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de fabricantes</legend>
                    <input type="hidden" name="codfabricante" value="<?php if(isset($fabricante)){echo($fabricante["codfabricante"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($fabricante)){echo($fabricante["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Logo:</label>
                        <input type="file" name="logo" accept="image/*"/>
                        <?php 
                        if(isset($fabricante["logo"])){
                            echo("<img width='50' height='50' src='../recursos/imagens/$fabricante[logo]' title='imagem logo' alt='imagem logo'/>");
                        }
                        ?>
                    </p>
                                      
                    <p>
                        <?php if(!isset($fabricante)){?>
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
                    include("../../controlador/ControleFabricante.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style="border-right: 1px solid #777777">Código</th>
                                        <th style="border-right: 1px solid #777777">Nome</th>
                                        <th style="border-right: 1px solid #777777">Qtd. Produtos</th>
                                        <th style="border-right: 1px solid #777777">Imagem</th>
                                        <th style="border-right: 1px solid #777777">Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                $total  = 0;
                                $total2 = 0;
                                while($fabricante = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $fabricante["codfabricante"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Fabricante.php?codfabricante=$fabricante[codfabricante]&submit=Procurar' title='Perfil da fabricante'>". $fabricante["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>".$fabricante["qtd"]."</td>");
                                    if(isset($fabricante["logo"])){
                                        echo("<td style='border-right: 1px solid #777777;'><img width='50' height='50' src='../recursos/imagens/$fabricante[logo]' alt='Logo fabricante $fabricante[nome]' title='Logo fabricante $fabricante[nome]'/></td>");
                                    }else{
                                        echo("<td style='border-right: 1px solid #777777;'>Sem imagem</td>");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Fabricante.php?codfabricante=$fabricante[codfabricante]&submit=Procurar' title='Perfil da fabricante'><img src='$caminho/recursos/imagens/editar.gif' alt='Editar Fabricante'/></a></td>");
                                    echo("<td><a class='btexcluir' href='../../controlador/ControleFabricante.php?codfabricante=$fabricante[codfabricante]&submit=Excluir' title='Excluir da fabricante'>X</a></td>");
                                    echo("</tr>");
                                    $total  = $total + $fabricante["qtd"];
                                    $total2 = $total2 + 1;
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                    <tfoot>
                                        <tr>
                                            <td style='border-right: 1px solid #777777;' title="Quantidade em pessoas">Total de Produtos:</td>
                                            <td style='border-right: 1px solid #777777;'><?=$total?></td>
                                        </tr>  
                                        <tr>
                                            <td style='border-right: 1px solid #777777;' title="Quantidade em pessoas">Total de Fabricantes:</td>
                                            <td style='border-right: 1px solid #777777;'><?=$total2?></td>
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
    </body>
</html>
