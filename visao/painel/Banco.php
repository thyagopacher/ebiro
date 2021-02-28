<?php
    session_start();
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codbanco"])){
        include("../../controlador/ControleBanco.php");
        if(isset($retorno)){
            $banco = mysql_fetch_array($retorno);
        }else{
            $banco = NULL;
        }
    }   
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Banco") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Banco</title>
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
                <form action="../../controlador/ControleBanco.php" name="formBanco" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de bancos</legend>
                        <input type="hidden" name="codbanco" value="<?php if(isset($banco)){echo($banco["codbanco"]);}?>"/>                  
                        <p>
                            <label>Nome:</label>
                            <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($banco)){echo($banco["nome"]);}?>"/>
                        </p> 
                        <p>
                            <label>Tx. Conta:</label>
                            <input type="text" name="txconta" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($banco) && isset($banco['txconta'])){echo(number_format($banco['txconta'], 2, ',', '.'));}?>"/>
                        </p> 
                        <p>
                            <label>Tx. Conta:</label>
                            <input type="text" name="txboleto" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($banco) && isset($banco['txboleto'])){echo(number_format($banco['txboleto'], 2, ',', '.'));}?>"/>
                        </p>                      
                        <p>
                            <label>Link:</label>
                            <input required type="url" name="linksite" size="100" value="<?php if(isset($banco)){echo($banco["linksite"]);}?>"/>
                        </p>                      
                        <p>
                            <label>Logo:</label>
                            <input type="file" name="logo" accept="image/*"/>
                            <?php 
                            if(isset($banco["logo"])){
                                echo("<img width='50' height='50' src='../recursos/imagens/$banco[logo]' title='imagem logo' alt='imagem logo'/>");
                            }
                            ?>
                        </p>

                        <p>
                            <?php if(!isset($banco)){?>
                                <input type="submit" name="submit" value="Cadastrar"/>
                            <?php }else{?>
                                <input type="submit" name="submit" value="Editar"/>
                                <input type="submit" name="submit" value="Excluir"/>
                            <?php }?>
                        </p>
                    </fieldset>
                </form>
            <?php
                    $_REQUEST["submit"] = "Procurar Nome";
                    $_REQUEST["nome"]   = "";
                    include("../../controlador/ControleBanco.php");
                    if(isset($retorno) && $retorno !== FALSE){
                        $qtd = mysql_num_rows($retorno);
                        echo("Encontrou $qtd resultados<br>");
             ?>
                           <table>
                                <thead>
                                    <tr>
                                        <th style='border-right: 1px solid #777777;'>Código</th>
                                        <th style='border-right: 1px solid #777777;'>Nome</th>
                                        <th style='border-right: 1px solid #777777;'>Imagem</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($banco = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $banco["codbanco"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Banco.php?codbanco=$banco[codbanco]&submit=Procurar' title='Perfil da banco'>". $banco["nome"] ."</a></td>");
                                    if(isset($banco["logo"])){
                                        echo("<td style='border-right: 1px solid #777777;'><img width='50' height='50' src='../recursos/imagens/$banco[logo]' alt='Logo banco $banco[nome]' title='Logo banco $banco[nome]'/></td>");
                                    }else{
                                        echo("Sem imagem");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'><a href='Banco.php?codbanco=$banco[codbanco]&submit=Procurar'><img src='$caminho/recursos/imagens/editar.gif'/></a></td>");
                                    echo("<td ><a class='btexcluir' href='../../controlador/ControleBanco.php?codbanco=$banco[codbanco]&submit=Excluir' title='Excluir da banco'>X</a></td>");
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
