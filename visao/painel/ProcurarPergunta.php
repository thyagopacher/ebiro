<?php
    try{
        $painel = TRUE;
        include("includes/validaLogin.php");
        if(isset($_REQUEST["codservico"])){
            include("../../controlador/ControleServico.php");
            if(isset($retorno) && $retorno !== FALSE){
                $servico    = mysql_fetch_array($retorno);
                $codservico = $_REQUEST["codservico"];
                $valor      = $servico["valor"];
            }else{
                $servico = NULL;
            }
        }
    }catch(Exception $ex){
        echo("Erro causado por: $ex");
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "ProcurarPergunta") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Procurar Pergunta</title>
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
            <form action="" method="post" name="formpergunta">
                <fieldset>
                    <legend>Procurar Pergunta</legend>
                    <p>
                        <label>Pergunta:</label>
                        <input type="text" placeholder="Digite aqui a pergunta para pesquisa" name="pergunta" size="50" maxlength="50"/>
                    </p>    
                    <p>
                        <input type="hidden" name="submited" value="true"/>
                        <input type="submit" name="submit" value="Procurar Pergunta"/>
                    </p>
                </fieldset>
            </form>
            <?php
                    $_REQUEST["submit"] = "Procurar Pergunta";
                    include("../../controlador/ControlePergunta.php");
                    if(isset($retorno)){?>
                           <table border="1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Pergunta</th>
                                        <th>Categoria</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if(mysql_num_rows($retorno) > 0){
                                while($pergunta = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td>". $pergunta["codpergunta"] ."</td>");
                                    echo("<td><a href='Pergunta.php?codpergunta=$pergunta[codpergunta]&submit=Procurar' title='Perfil da pergunta'>". $pergunta["pergunta"] ."</a></td>");
                                    echo("<td>$pergunta[categoria]</td>");
                                    echo("<td>");
                                    echo("<a class='btexcluir' title='Clique aqui para excluir' href='../../controlador/ControlePergunta.php?submit=Excluir&codpergunta=$pergunta[codpergunta]'>X</a>");
                                    echo("<a href='Pergunta.php?codpergunta=$pergunta[codpergunta]'>Editar</a>");                                    
                                    echo("</td>");
                                    echo("</tr>");
                                } 
                            }else{
                                echo("Não encontrado");
                            }?>
                                </tbody>
                            </table>
                    <?php
                         }
            ?>
        </div>
        </article>
    </body>
</html>