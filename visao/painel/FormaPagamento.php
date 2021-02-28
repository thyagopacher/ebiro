<?php
    $painel = TRUE;
    include("includes/validaLogin.php");
    if(isset($_REQUEST["codforma"])){
        include("../../controlador/ControleFormaPagamento.php");
        if(isset($retorno)){
            $formapagamento = mysql_fetch_array($retorno);
        }else{
            $formapagamento = NULL;
        }
    } 
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "FormaPagamento") === FALSE){
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
        <title><?=$empresa["fantasia"]?> - Formas de Pagamento</title>
    </head>
    <body>
        <header>
        <?php 
        include("includes/topo.php");
        ?>
        </header>
        <article>
            <?php include("includes/menuLateral.php");?>
            <div id="conteudo">
            <?php
            if(isset($_SESSION["erro"]) && $_SESSION["erro"] !== NULL && $_SESSION["erro"] !== ""){
                echo("<div id='erro'>");
                echo($_SESSION["erro"]);
                echo("</div>");
            }
            ?>            
            <form action="../../controlador/ControleFormaPagamento.php" name="formFormaPagamento" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de forma pagamentos</legend>
                    <input type="hidden" name="codforma" value="<?php if(isset($formapagamento)){echo($formapagamento["codforma"]);}?>"/>                  
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($formapagamento)){echo($formapagamento["nome"]);}?>"/>
                    </p>                      
                    <p>
                        <label>Logo:</label>
                        <input type="file" name="logo" accept="image/*"/>
                        <?php 
                        if(isset($formapagamento["logo"])){
                            echo("<img src='../recursos/imagens/$formapagamento[logo]' title='imagem logo' alt='imagem logo'/>");
                        }
                        ?>
                    </p>
<p>
                        <label>Status:</label>
                        <select name="status">
                            <?php 
                            if(isset($formapagamento) && isset($formapagamento["status"]) && $formapagamento["status"] === "SIM"){?>
                                <option>NÃO</option>
                                <option selected>SIM</option>
                            <?php 
                            }
                            if(isset($formapagamento) && isset($formapagamento["status"]) && $formapagamento["status"] === "NÃO"){?>
                                <option selected>NÃO</option>
                                <option>SIM</option>                            
                           <?php
                            }
                            if(($formapagamento["status"] === NULL) || (!isset($formapagamento) && $formapagamento["status"] !== "NÃO" && $formapagamento["status"] !== "SIM")){
                            ?>
                                <option title="Não ativa no site">NÃO</option>
                                <option title="Ativa no site">SIM</option>                                 
                            <?php 
                            }?>
                        </select>
                    </p>                                       
                    <p>
                        <?php if(!isset($formapagamento)){?>
                            <input type="submit" name="submit" value="Cadastrar"/>
                        <?php }else{?>
                            <input type="submit" name="submit" value="Editar"/>
                            <input type="submit" name="submit" value="Excluir"/>
                        <?php }?>
                    </p>
                </fieldset>
            </form>
            <?php
                    $painel             = TRUE;
                    $_REQUEST["submit"] = "Procurar Nome";
                    $_REQUEST["nome"]   = "";
                    include("../../controlador/ControleFormaPagamento.php");
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
                                        <th style='border-right: 1px solid #777777;'>Ativo</th>
                                        <th style='border-right: 1px solid #777777;'>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                    <?php
                            if($qtd > 0){
                                while($formapagamento = mysql_fetch_array($retorno)){
                                    echo("<tr>");
                                    echo("<td style='border-right: 1px solid #777777;'>". $formapagamento["codforma"] ."</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='FormaPagamento.php?codforma=$formapagamento[codforma]&submit=Procurar' title='Perfil da formapagamento'>". $formapagamento["nome"] ."</a></td>");
                                    if(isset($formapagamento["logo"])){
                                        echo("<td style='border-right: 1px solid #777777;'><img width='50' height='50' src='../recursos/imagens/$formapagamento[logo]' alt='Logo formapagamento $formapagamento[nome]' title='Logo formapagamento $formapagamento[nome]'/></td>");
                                    }else{
                                        echo("Sem imagem");
                                    }
                                    echo("<td style='border-right: 1px solid #777777;'>$formapagamento[status]</td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a href='FormaPagamento.php?codforma=$formapagamento[codforma]&submit=Procurar' title='Perfil da formapagamento'><img src='$caminho/recursos/imagens/editar.gif' alt='editar'</a></td>");
                                    echo("<td style='border-right: 1px solid #777777;'><a class='btexcluir' href='../../controlador/ControleFormaPagamento.php?codforma=$formapagamento[codforma]&submit=Excluir' title='Excluir da formapagamento'>X</a></td>");
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
