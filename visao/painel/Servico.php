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
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Servico") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script>
        <title><?=$empresa["fantasia"]?> - Empresa</title>
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
            <form action="../../controlador/ControleServico.php" name="formCategoria" method="post">
                <fieldset>
                    <legend>Gerenciamento de serviço</legend>
                    <input type="hidden" name="codservico" value="<?php echo($codservico);?>"/>                   
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($_REQUEST["codservico"])){echo($servico["nome"]);}?>"/>
                    </p>  
                    <p>
                        <label>Valor:</label>
                        <input required  type="text" name="valor" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($servico)){echo(number_format($servico['valor'], 2, ',', '.'));}?>"/>
                    </p>                    
                    <p>
                        <?php if(!isset($_REQUEST["codservico"])){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            -Clique sobre o nome para editar<br>
            <?php
                    $_REQUEST["submit"] = "Procurar Nome";
                    include("../../controlador/ControleServico.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table border="1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($servico = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td>". $servico["codservico"] ."</td>");
                                    echo("<td><a href='Servico.php?codservico=$servico[codservico]&submit=Procurar' title='Perfil da servico'>". $servico["nome"] ."</a></td>");
                                    echo("<td>".number_format($servico['valor'], 2, ',', '.')."</td>");
                                    echo("<td><a href='../../controlador/ControleServico.php?codservico=$servico[codservico]&submit=Excluir' title='Excluir da servico'>Excluir</a></td>");
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
    </body>
</html>