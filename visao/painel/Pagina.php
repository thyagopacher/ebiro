<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    include("../../controlador/ControlePagina.php");
    if(isset($_REQUEST["codpagina"])){
        if(isset($retorno)){
            $pagina = mysql_fetch_array($retorno);
        }else{
            $pagina = NULL;
        }
    }else{
        $pagina = NULL;
    }  
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Pagina") === FALSE){
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
        <link href="../recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
        <link href="<?=$caminho?>recursos/css/tema1/menuLateral_2.css" type="text/css" rel="stylesheet" />
        <?php include("includes/javascriptMenulateral.php");?>            
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/CarregaEditor.js"></script>
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
                <form action="../../controlador/ControlePagina.php" name="formPagina" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de páginas</legend>
                        <input type="hidden" name="codpagina" value="<?php if(isset($pagina)){echo($pagina["codpagina"]);}?>"/>                  
                        <p>
                            <label>Titulo:</label>
                            <input required type="text" name="titulo" size="50" maxlength="50" value="<?php if(isset($pagina)){echo($pagina["titulo"]);}?>"/>
                        </p>                      
                        <p>
                            <label>Texto:</label>
                            <textarea name="texto" cols="80" rows="10" placeholder="Digite aqui seu conteúdo"><?php if(isset($pagina)){echo($pagina["texto"]);}?></textarea>
                        </p> 

                        <p>
                            <?php if(!isset($pagina)){?>
                                <input type="submit" name="submit" value="Cadastrar"/>
                            <?php }else{?>
                                <input type="submit" name="submit" value="Editar"/>
                                <input type="submit" name="submit" value="Excluir"/>
                            <?php }?>
                        </p>
                    </fieldset>
                </form>
                <?php
                        include("../../controlador/ProcurarPaginas.php");
                        if(isset($retornopaginas) && $retornopaginas !== FALSE){
                            $qtd = mysql_num_rows($retornopaginas);
                            echo("Encontrou $qtd resultados<br>");
                 ?>
                               <table>
                                    <thead>
                                        <tr>
                                            <th style='border-right: 1px solid #777777;'>Código</th>
                                            <th style='border-right: 1px solid #777777;'>Título</th>
                                            <th style='border-right: 1px solid #777777;'>Editar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                        <?php
                                if($qtd > 0){
                                    while($pagina = mysql_fetch_array($retornopaginas)){
                                        echo("<tr>");
                                        echo("<td style='border-right: 1px solid #777777;'>". $pagina["codpagina"] ."</td>");
                                        echo("<td style='border-right: 1px solid #777777;'><a href='Pagina.php?codpagina=$pagina[codpagina]&submit=Procurar' title='Perfil da pagina'>". $pagina["titulo"] ."</a></td>");
                                        echo("<td style='border-right: 1px solid #777777;'><a href='Pagina.php?codpagina=$pagina[codpagina]&submit=Procurar' title='Perfil da pagina'><img src='$caminho/recursos/imagens/editar.gif' alt='Editar'/></a></td>");
                                        echo("<td><a class='btexcluir' href='../../controlador/ControlePagina.php?codpagina=$pagina[codpagina]&submit=Excluir' title='Excluir da pagina'>X</a></td>");
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
