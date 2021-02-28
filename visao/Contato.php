<!DOCTYPE html>
<html>
    <head>
        <?php include("includes/head.php");?>
        <title><?=$empresa["fantasia"]?> - Contato</title>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />
        <?php include("includes/mudaCor.php");?>       
    </head>
    <body>
        <?php 
        $painel = "NO-INDEX";
        include("includes/topo.php");
        ?>
        <div id="conteudo">
            <?php include("includes/Skype.php");?>
            <form action="<?=$caminho2?>/controlador/Contato.php" name="formContato" method="post">
                <fieldset>
                    <legend>Contato com a empresa</legend>
                    <p>
                        <label>Nome</label>
                        <input type="text" required name="nome" size="50" maxlength="50" pattern=".{3,}" placeholder="Digite aqui seu nome" title="Menos de 3 caracteres não serão aceitos"/>
                    </p>
                    <p>
                        <label>E-mail</label>
                        <input type="email" required name="email" size="50" maxlength="50" placeholder="Digite aqui um e-mail válido"/>
                    </p> 
                    <p>
                        <label>Assunto</label>
                        <input type="text" required name="assunto" list="listaassunto" size="50" maxlength="50" placeholder="Digite um assunto para sua mensagem" pattern=".{3,}" title="Menos de 3 caracteres não serão aceitos"/>
                    </p>
                    <datalist id="listaassunto">
                        <option>Elogio</option>
                        <option>Reclamação</option>
                        <option>Dúvida</option>
                    </datalist>
                    <p>
                        <label>Mensagem</label>
                        <textarea required cols="40" rows="10" name="mensagem"></textarea>
                    </p> 
                    <p>
                        <input type="submit" name="submit" title="Clique aqui para contato com a <?=$empresa["fantasia"]?>" value="Enviar"/>
                    </p>
                </fieldset>
            </form>
        </div>    
        <?php // include("includes/rodape.php");?>
    </body>
</html>
