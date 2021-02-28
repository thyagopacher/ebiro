<!DOCTYPE html>
<html>
    <head>
        <?php 
            include("includes/head.php");
        ?>
        <link href="recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />    
        <style>
            #conteudo{
                min-height: 50px;
                width: auto;
            }
        </style>
    </head>
    <body>
        <div id="conteudo">
            <form action="<?=$caminho2?>/controlador/EnviaSenha.php" name="formSenha" method="post">
                <fieldset>
                    <legend>Enviar Senha:</legend>
                    <p>
                        <label>E-mail:</label>
                        <input type="email" name="email" size="50" maxlength="50"/>
                        <input type="submit" name="submit" value="Enviar"/>
                    </p>
                </fieldset>
            </form>
        </div>    
    </body>
</html>
