<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codcomentario"])){
        include("../../controlador/ControleComentario.php");
        if(isset($retorno)){
            $comentario = mysql_fetch_array($retorno);
        }else{
            $comentario = NULL;
        }
    }    
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Comentario") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/CarregaEditor.js"></script>
        <title><?=$empresa["fantasia"]?> - Comentário</title>
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
            <form action="../../controlador/ControleComentario.php" name="formComentario" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de comentários</legend>
                    <input type="hidden" name="codcomentario" value="<?php if(isset($comentario)){echo($comentario["codcomentario"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($comentario)){echo($comentario["nome"]);}?>"/>
                    </p>      
                    <p>
                        <label>E-mail:</label>
                        <input required type="email" name="email" size="50" maxlength="50" value="<?php if(isset($comentario)){echo($comentario["email"]);}?>"/>
                    </p>     
                    <p>
                        <label>Texto:</label>
                        <textarea cols="80" rows="10" name="texto" required placeholder="Digite aqui o texto de comentário">
                            <?php if(isset($comentario)){echo($comentario["texto"]);}?>
                        </textarea>
                    </p>
                                      
                    <p>
                        <?php if(!isset($comentario)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
