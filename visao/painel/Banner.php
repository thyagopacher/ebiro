<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codbanner"])){
        include("../../controlador/ControleBanner.php");
        if(isset($retorno)){
            $banner = mysql_fetch_array($retorno);
        }else{
            $banner = NULL;
        }
    }    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Banner") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Banner</title>
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
            <p>Número ideal máximo de banner: 11</p>
            <form action="../../controlador/ControleBanner.php" name="formBanner" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de banners</legend>
                    <input type="hidden" name="codbanner" value="<?php if(isset($banner)){echo($banner["codbanner"]);}?>"/>                  
                    <p>
                        <label>Posição:</label>
                        <select name="posicao">
                            <?php 
                            if(isset($banner) && isset($banner["posicao"]) && $banner["posicao"] === "meio"){?>
                                <option>direita</option>
                                <option selected>meio</option>
                                <option title="Abre na página inicial">popup</option>
                            <?php 
                            }
                            if(isset($banner) && isset($banner["posicao"]) && $banner["posicao"] === "direita"){?>
                                <option selected>direita</option>
                                <option>meio</option>   
                                <option title="Abre na página inicial">popup</option>
                           <?php
                            }
                            if(isset($banner) && isset($banner["posicao"]) && $banner["posicao"] === "popup"){?>
                                <option >direita</option>
                                <option>meio</option>   
                                <option selected title="Abre na página inicial">popup</option>
                           <?php
                            }                            
                            if((isset($banner) && (!isset($banner["posicao"]) || $banner["posicao"] === NULL || $banner["posicao"] === "")) || (!isset($banner) && $banner["posicao"] !== "direita" && $banner["posicao"] !== "meio")){
                            ?>
                                <option>direita</option>
                                <option>meio</option>      
                                <option title="Abre na página inicial">popup</option>
                            <?php 
                            }?>
                        </select>
                    </p>                    
                    <p>
                        <label>Link:</label>
                        <input required type="url" name="link" size="50" value="<?php if(isset($banner)){echo($banner["linksite"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Imagem:</label>
                        <input type="file" name="imagem" accept="image/*"/>
                        <?php 
                        if(isset($banner["imagem"])){
                            echo("<img width='100' height='50' src='../recursos/imagens/$banner[imagem]' title='imagem imagem' alt='imagem imagem'/>");
                        }
                        ?>
                    </p>
                                      
                    <p>
                        <?php if(!isset($banner)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            <?php
                    $_REQUEST["submit"] = "Procurar Link";
                    $_REQUEST["link"]   = "";
                    include("../../controlador/ControleBanner.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Link</th>
                                        <th style='border-right: 1px solid #777777;'>Imagem</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($banner = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $banner["codbanner"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Banner.php?codbanner=$banner[codbanner]&submit=Procurar' title='Perfil da banner'>". $banner["linksite"] ."</a></td>");
                                    if(isset($banner["imagem"])){
                                        echo("<td style='border-right: 1px solid #777777;'><img width='50' height='50' src='../recursos/imagens/$banner[imagem]' alt='Imagem banner' title='Imagem banner'/></td>");
                                    }else{
                                        echo("Sem imagem");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Banner.php?codbanner=$banner[codbanner]&submit=Procurar' title='Perfil da banner'>". $banner["linksite"] ."</a></td>");
                                    echo("<td><a href='Banner.php?codbanner=$banner[codbanner]&submit=Procurar'><img src='$caminho2/recursos/imagens/editar.gif' alt='Bt excluir'/></a></td>");
                                    echo("<td><a href='../../controlador/ControleBanner.php?codbanner=$banner[codbanner]&submit=Excluir' title='Excluir da banner'>Excluir</a></td>");
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
