<!DOCTYPE html>
<html>
    <head>
        <?php include("includes/head.php");?>
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/modelo.css" type="text/css" media="screen">
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/cufon-yui.js"></script> 
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Aller.font.js"></script> 
<!--        <script type="text/javascript">
                Cufon.replace('ul.oe_menu div a',{hover: true});
                Cufon.replace('h1,h2,.oe_heading');
        </script>         -->
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script> 
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/jquery.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Endereco.js"></script>
    </head>
    <body>
        <header>
            <?php 
            include("includes/topo.php");
            include("includes/categorias.php");
            include("includes/busca.php");
            ?>          
        </header>
        <article>
            <form action="<?=$caminho2?>/controlador/TrabalheConosco.php" method="post" name="formTrabalhe" enctype="multipart/form-data">
                <fieldset>
                    <legend>Trabalhe Conosco:</legend>
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50"/>
                    </p>
                    <p>
                        <label>E-mail:</label>
                        <input type="email" name="email" size="50" maxlength="50"/>
                    </p> 
                    <p>
                        <label>Telefone:</label>
                        <input required type="text" onkeypress="return MascaraTelefone(this, event);" name="telefone" size="15" maxlength="14"/>
                    </p>       
                    <p>
                        <label>Celular:</label>
                        <input required type="text" onkeypress="return MascaraTelefone(this, event);" name="celular" size="15" maxlength="14"/>
                    </p>   
                    <p>
                        <label>CEP:</label>
                        <input required type="text" name="cep" id="cep" size="8" maxlength="8" onblur="return getEndereco();"/>
                    </p>          
                    <p>
                        <label>Tipo Logradouro:</label>
                        <input required type="text" name="tipologradouro" id="tipologradouro" size="20" maxlength="20"/>
                    </p>    
                    <p>
                        <label>Logradouro:</label>
                        <input required type="text" name="logradouro" id="logradouro" size="50" maxlength="50"/>
                    </p>    
                    <p>
                        <label>Número:</label>
                        <input type="text" name="numero" size="10" maxlength="10"/>
                    </p>                   
                    <p>
                        <label>Bairro:</label>
                        <input required type="text" name="bairro" id="bairro" size="50" maxlength="50"/>
                    </p>       
                    <p>
                        <label>Cidade:</label>
                        <input required type="text" name="cidade" id="cidade" size="50" maxlength="50"/>
                    </p>     
                    <p>
                        <label>Estado:</label>
                        <input required type="text" name="estado" id="estado" size="5" maxlength="5"/>
                    </p>    
                    <p>
                        <label>Curriculo:</label>
                        <input type="file" name="arquivo" title="Selecine aqui seu curriculo" accept="application/msword, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document"/>
                    </p>
                    <p>
                        <input type="submit" name="submit" value="Enviar"/>
                    </p>
                </fieldset>
            </form>
         </article>
        <footer>
            <?php 
            include("includes/rodape1.php");
            include("includes/rodape2.php");
            ?>
        </footer>
    </body>
</html>