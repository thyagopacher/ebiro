<?php
    session_start();
    if(isset($_SESSION["codpessoa"])){
        echo("<script>location.href='Home.php';</script>");
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
        <?php 
        $painel = TRUE;
        include("../includes/head.php");
        ?>
        <link href="<?=$caminho?>/recursos/css/tema1/indexpainel.css" type="text/css" rel="stylesheet" />      
        <title>Painel administrativo - Ebirô Internet Solutions</title>
    </head>
    <body>
        <header>

        </header>
        <article>
            <form action="../../controlador/ControlePessoa.php" name="login" method="post" class="login">
                <div align="center">
                    <h4><img src="../recursos/imagens/logo_ebiro.png" alt="<?=$ebiro["fantasia"]?>"/></h4>
                </div>
                <div id="loginform" align="center">
                    <p>
                        <label>Nome do usuário</label><br>
                        <input required type="text" name="login" size="30" maxlength="30" title="Digite aqui seu nome de usuário"/>
                    </p>
                    <p>
                        <label>Senha</label><br>
                        <input required type="password" name="senha" size="30" maxlength="30" title="Digite aqui sua senha"/>
                    </p>  
                    <p>
                        <input type="image" name="submit" value="Login"/>
                    </p>
                </div>
            </form>
        </article>
    </body>
</html>
