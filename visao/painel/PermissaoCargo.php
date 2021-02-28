<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codcargo"])){
        if(!isset($_REQUEST["submit"])){
            $_REQUEST["submit"] = "Procurar Codcargo";
        }
        include("../../controlador/ControlePermissaoCargo.php");
        $retornopermissoes = $retorno;
        $qtdpermissao      = mysql_num_rows($retornopermissoes);
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "PermissaoCargo") === FALSE){
        $_SESSION["erro"] = "";
    }     
    $_REQUEST["submit"] = "Procurar Nome";
    include("../../controlador/ControleMenu.php");
    $menus = $retorno;
    
    $_REQUEST["submit"] = "Procurar Nome";
    include("../../controlador/ControleCargo.php");
    $cargos = $retorno;    
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/PesquisaPermissao.js"></script>
        <title><?=$empresa["fantasia"]?> - Permissão Cargo</title>
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
                <form action="../../controlador/ControlePermissaoCargo.php" name="formPermissaoCargo" method="post">
                    <fieldset>
                        <legend>Gerenciamento de permissões do cargo</legend>

                         <p>
                            <label>Cargo:</label>
                            <select name="codcargo" id="codcargo" onchange="return procuraPermissao();">
                                <?php
                                if(mysql_num_rows($cargos) > 0){
                                    echo("<option>Nada escolhido</option>");
                                    while($cargo = mysql_fetch_array($cargos)){
                                        if(isset($_REQUEST["codcargo"]) && $_REQUEST["codcargo"] === $cargo["codcargo"]){
                                            echo("<option value='$cargo[codcargo]' selected>$cargo[nome]</option>");
                                        }else{
                                            echo("<option value='$cargo[codcargo]'>$cargo[nome]</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>                        
                        </p>

                        <label title="<?=$qtdpermissao?>">Menu:</label>
                        <div id="menus">
                            <?php
                            if($qtdpermissao > 0){
                                $i = 0;
                                while($perm = mysql_fetch_array($retornopermissoes)){
                                    $chave = "menu$i";
                                    if($perm["status"] === "SIM"){
                                        echo("<p><input type='checkbox' id='$chave' name='$chave' value='$perm[codmenu]' checked><span>$perm[nome]</span></p>");
                                    }else{
                                        echo("<p><input type='checkbox' id='$chave' name='$chave' value='$perm[codmenu]'><span>$perm[nome]</span></p>");
                                    }
                                    $i = $i + 1;
                                }

                            }else{
                                echo("Nada encontrado, por favor escolha um cargo para selecionar suas permissões!");
                            }
                            ?>
                        </div>

                        <p>
                            <?php if(!isset($permissao) || !isset($_REQUEST["codpermissao"])){?>
                                <input type="submit" name="submit" value="Cadastrar"/>
                            <?php }else{?>
                                <input type="submit" name="submit" value="Editar"/>
                                <input type="submit" name="submit" value="Excluir"/>
                            <?php }?>
                        </p>
                    </fieldset>
                </form>
            </div>
        </article>
        <?php //include("includes/rodape.php");?>
    </body>
</html>
