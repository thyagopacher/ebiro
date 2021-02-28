<?php
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ProcurarPessoaSimples") === FALSE){
        $_SESSION["erro"] = "";
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <?php 
        $painel = TRUE;
        include("../includes/head.php");
        ?>
        <link href="<?=$caminho?>/recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />
        <link href="<?=$caminho?>/recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <?php 
            include("includes/topo.php");
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
            <form action="" method="post" name="formpessoa">
                <fieldset>
                    <legend>Procurar Pessoa</legend>
                    <p>
                        <label>Nome:</label>
                        <input type="text" placeholder="Digite aqui o nome para pesquisa" name="nome" size="50" maxlength="50"/>
                    </p>                  
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <input type="submit" name="submit" value="Procurar Nome"/>
                    </p>
                </fieldset>
            </form>
            <?php
                    include("../../controlador/ControlePessoa.php");
                    if(isset($retorno) && $retorno !== FALSE && $retorno !== NULL){?>
                           <table border="1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(mysql_num_rows($retorno) > 0){
                                        while($pessoa = mysql_fetch_array($retorno)){
                                            echo("<tr>");
                                            echo("<td>". $pessoa["codpessoa"] ."</td>");
                                            echo("<td><a href='Pessoa.php?codpessoa=$pessoa[codpessoa]&submit=Procurar' title='Perfil da pessoa'>". $pessoa["nome"] ."</a></td>");
                                            echo("<td>");
                                            echo("<a class='btexcluir' title='Clique aqui para excluir' href='../../controlador/ControlePessoa.php?submit=Excluir&codpessoa=$pessoa[codpessoa]'>X</a>");
                                            echo("<a href='Pessoa.php?codpessoa=$pessoa[codpessoa]'>Editar</a>");
                                            echo("</td>");
                                            echo("</tr>");
                                        } 
                                    }else{
                                        echo("Não encontrado");
                                    }
                                 ?>
                                </tbody>
                            </table>
                    <?php
                         }
            ?>
        </div>
        <?php include("includes/rodape.php");?>
    </body>
</html>
