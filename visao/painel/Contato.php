<?php
    $painel = TRUE;
    include("includes/validaLogin.php");   
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Contato") === FALSE){
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
        <style>
            article{
                height: 630px;
            }
        </style>
        <?php include("includes/javascriptMenulateral.php");?>            
        <title><?=$empresa["fantasia"]?> - Contato</title>
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
            <form action="../../controlador/EnviaContato.php" name="formContato" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Formulário de Contato</legend>
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value=""/>
                    </p>      
                    <p>
                        <label>E-mail:</label>
                        <input title="Opcional caso queira receber a resposta em outro e-mail" type="email" name="email" size="50" maxlength="50" value=""/>
                    </p>   
                    <p>
                        <label>Assunto:</label>
                        <select name="assunto">
                            <option>Dúvida</option>
                            <option>Sugestão</option>
                            <option>Reclamação</option>
                            <option>Erro no sistema</option>
                        </select>
                    </p>
                    <p>
                        <label>Mensagem:</label>
                        <textarea cols="80" rows="10" name="mensagem" required placeholder="Digite aqui a sua mensagem"></textarea>
                    </p>
                                      
                    <p>
                        <input type="submit" name="submit" value="Enviar"/>
                    </p>
                </fieldset>
            </form>
            Outros formas de contato:<br>
            Telefone: <?=$ebiro["telefone"];?><br>
            Celular: <?=$ebiro["celular"];?><br>
            -<a href="mailto: suporte@ebiro.com.br;webmaster@ebiro.com.br">E-mail(Clique aqui)</a><br>
            -Skype:
            <script type="text/javascript" src="http://cdn.dev.skype.com/uri/skype-uri.js"></script>
            <div id="SkypeButton_Call_ebiroweb_1" title="Suporte aqui">
              <script type="text/javascript">
                Skype.ui({
                  "name": "call",
                  "element": "SkypeButton_Call_ebiroweb_1",
                  "participants": ["ebiroweb"],
                  "imageSize": 30
                });
              </script>
            </div>       
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
