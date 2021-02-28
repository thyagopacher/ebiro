<?php
    session_start();
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codmenu"])){
        include("../../controlador/ControleMenu.php");
        if(isset($retorno)){
            $menu = mysql_fetch_array($retorno);
        }else{
            $menu = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Menu") === FALSE){
        $_SESSION["erro"] = "";
    }  
    $_REQUEST["nome"]   = "";
    $_REQUEST["submit"] = "Procurar Nome";
    include("../../controlador/ControleCategoriaMenu.php");
    $retornotudo = $retorno;
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
        <title>Painel - Menu</title>
        <link href="../recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
        <link href="<?=$caminho?>recursos/css/tema1/menuLateral_2.css" type="text/css" rel="stylesheet" />
        <?php include("includes/javascriptMenulateral.php");?>            
        <script type="text/javascript" src="../recursos/javascript/Mascara.js"></script>
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
            <form action="../../controlador/ControleMenu.php" name="formMenu" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de menus</legend>
                    <input type="hidden" name="codmenu" value="<?php if(isset($menu)){echo($menu["codmenu"]);}?>"/>                  
                    <p>
                        <label>Categoria:</label>
                        <select name="codcategoria">
                            <?php
                                if(mysql_num_rows($retornotudo) > 0){
                                    while($categoria = mysql_fetch_array($retornotudo)){
                                        if(isset($produto["codcategoria"]) && $produto["codcategoria"] === $categoria["codcategoria"]){
                                            echo("<option value='$categoria[codcategoria]' selected>".$categoria["nome"]."</option>");
                                        }else{
                                            echo("<option value='$categoria[codcategoria]'>".$categoria["nome"]."</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                            ?>
                        </select>
                    </p>
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($menu)){echo($menu["nome"]);}?>"/>
                    </p>                     
                    <p>
                        <label>Arquivo:</label>
                        <input required type="text" name="arquivo" title="Nome do arquivo responsável pela funcionalidade" size="50" value="<?php if(isset($menu)){echo($menu["arquivo"]);}?>"/>
                    </p>   
                    <p>
                        <label>Icone:</label>
                        <input type="file" name="icone" accept="image/*"/>
                        <?php 
                        if(isset($menu["icone"])){
                            echo("<img class='logomini' src='../recursos/imagens/$menu[icone]' title='Imagem icone' alt='imagem icone'/>");
                        }
                        ?>
                    </p> 
                    <p>
                        <label>Quadro:</label>
                        <select name="quadro">
                            <?php if(isset($menu["quadro"]) && $menu["quadro"] === "SIM"){?>
                                <option selected>SIM</option>
                            <?php }else{?>
                                <option>SIM</option>
                            <?php }?>
                            <?php if(isset($menu["quadro"]) && $menu["quadro"] === "NÃO"){?>
                                <option selected>NÃO</option>
                            <?php }else{?>
                                <option>NÃO</option>
                            <?php }?>
                        </select>
                    </p>                      
                    <p>
                        <?php if(!isset($menu)){?>
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
                    require_once("../../controlador/ControleMenu.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Nome</th>
                                        <th style='border-right: 1px solid #777777;'>Arquivo</th>
                                        <th style='border-right: 1px solid #777777;'>Categoria</th>
                                        <th style='border-right: 1px solid #777777;'>Icone</th>
                                        <th style='border-right: 1px solid #777777;' title="Mostra no quadro principal">Quadro?</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($menu = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $menu["codmenu"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Menu.php?codmenu=$menu[codmenu]&submit=Procurar' title='Perfil da menu'>". $menu["nome"] ."</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'>$menu[arquivo]</td>");
                                    echo("<td style='border-right: 1px solid #777777;'>$menu[categoria]</td>");
                                    if(isset($menu["icone"])){
                                        echo("<td style='border-right: 1px solid #777777;'><img src='../recursos/imagens/$menu[icone]' alt='Imagem icone'/></td>");
                                    }else{
                                        echo("<td style='border-right: 1px solid #777777;'>Não tem</td>");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'>$menu[quadro]</td>");
                                    echo("<td><a href='../../controlador/ControleMenu.php?codmenu=$menu[codmenu]&submit=Excluir' title='Excluir da menu'>Excluir</a></td>");
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
