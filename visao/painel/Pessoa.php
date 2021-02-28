<?php
    include("includes/validaLogin.php");
    $painel = TRUE;
    
    $_REQUEST["submit"] = "Procurar Nome";
    $_REQUEST["nome"]   = "";
    include("../../controlador/ControleCargo.php");    
    $cargos = $retorno;
    
    if(!isset($_REQUEST["submit"])){
        $_REQUEST["submit"] = "Procurar Nome";
    }
    $_REQUEST["nome"]   = "";
    include("../../controlador/ControleTipoPessoa.php");    
    $tipos = $retorno;    
    
    if(isset($_REQUEST["codpessoa"])){
        $_REQUEST["submit"] = "Procurar";
        include("../../controlador/ControlePessoa.php");
        if(isset($retorno)){
            $pessoa = mysql_fetch_array($retorno);
        }else{
            $pessoa = NULL;
        }
    }
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Pessoa") === FALSE){
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
        <style>
            article{
                height: 795px;
            }
        </style>        
        <?php include("includes/javascriptMenulateral.php");?>            
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/jquery.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Endereco.js"></script>
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
                <form action="../../controlador/ControlePessoa.php" name="formPessoa" method="post">
                    <fieldset>
                        <legend>Gerenciamento de pessoas</legend>
                        <input type="hidden" name="codpessoa" value="<?=$pessoa["codpessoa"];?>"/>
                        <p>
                            <label>Cargo:</label>
                            <select name="codcargo">
                                <?php
                                if(isset($cargos) && mysql_num_rows($cargos) > 0){
                                    echo("<option>Nada escolhido</option>");
                                    while($dados_cargo = mysql_fetch_array($cargos)){
                                        if(isset($pessoa) && $pessoa["codcargo"] === $dados_cargo["codcargo"]){
                                            echo("<option value='$dados_cargo[codcargo]' selected>$dados_cargo[nome]</option>");
                                        }else{
                                            echo("<option value='$dados_cargo[codcargo]'>$dados_cargo[nome]</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label>Tipo Pessoa:</label>
                            <select name="codtipo">
                                <?php
                                if(isset($tipos) && mysql_num_rows($tipos) > 0){
                                    echo("<option>Nada escolhido</option>");
                                    while($dados_tipo = mysql_fetch_array($tipos)){
                                        if(isset($pessoa) && $pessoa["codtipo"] === $dados_tipo["codtipo"]){
                                            echo("<option selected value='$dados_tipo[codtipo]'>$dados_tipo[nome]</option>");
                                        }else{
                                            echo("<option value='$dados_tipo[codtipo]'>$dados_tipo[nome]</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label>Nome:</label>
                            <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($pessoa)){echo($pessoa["nome"]);}?>"/>
                        </p>
                        <p>
                            <label>CPF:</label>
                            <input required type="text" onkeypress="return mascaraInteiro(event);" name="cpf" size="11" maxlength="11" value="<?php if(isset($pessoa)){echo($pessoa["cpf"]);}?>"/>
                        </p> 
                        <p>
                            <label>Login:</label>
                            <input type="text" name="login" size="50" maxlength="50"  value="<?php if(isset($pessoa)){echo($pessoa["login"]);}?>"/>
                        </p>
                        <p>
                            <label>Senha:</label>
                            <input pattern="[a-z]{5}" type="password" name="senha" size="20" maxlength="20"  value="<?php if(isset($pessoa)){echo($pessoa["senha"]);}?>"/>
                        </p>
                        <p>
                            <label>CEP:</label>
                            <input required type="text" name="cep" id="cep" size="8" maxlength="8" onblur="return getEndereco();"  value="<?php if(isset($pessoa)){echo($pessoa["cep"]);}?>"/>
                        </p>          
                        <p>
                            <label>Tipo Logradouro:</label>
                            <input required type="text" name="tipologradouro" id="tipologradouro" size="20" maxlength="20"  value="<?php if(isset($pessoa)){echo($pessoa["tipologradouro"]);}?>"/>
                        </p>    
                        <p>
                            <label>Logradouro:</label>
                            <input required type="text" name="logradouro" id="logradouro" size="50" maxlength="50" value="<?php if(isset($pessoa)){echo($pessoa["logradouro"]);}?>"/>
                        </p>    
                        <p>
                            <label>Número:</label>
                            <input type="text" name="numero" size="10" maxlength="10" value="<?php if(isset($pessoa)){echo($pessoa["numero"]);}?>"/>
                        </p>                   
                        <p>
                            <label>Bairro:</label>
                            <input required type="text" name="bairro" id="bairro" size="50" maxlength="50" value="<?php if(isset($pessoa)){echo($pessoa["bairro"]);}?>"/>
                        </p>       
                        <p>
                            <label>Cidade:</label>
                            <input required type="text" name="cidade" id="cidade" size="50" maxlength="50" value="<?php if(isset($pessoa)){echo($pessoa["cidade"]);}?>"/>
                        </p>     
                        <p>
                            <label>Estado:</label>
                            <input required type="text" name="estado" id="estado" size="5" maxlength="5"  value="<?php if(isset($pessoa)){echo($pessoa["estado"]);}?>"/>
                        </p>  
                        <p>
                            <label>E-mail:</label>
                            <input required type="email" name="email" size="50" maxlength="50"  value="<?php if(isset($pessoa)){echo($pessoa["email"]);}?>"/>
                        </p>                     
                        <p>
                            <label>Telefone:</label>
                            <input required type="text" onkeypress="return MascaraTelefone(this, event);" name="telefone" size="15" maxlength="14"  value="<?php if(isset($pessoa)){echo($pessoa["telefone"]);}?>"/>
                        </p>       
                        <p>
                            <label>Celular:</label>
                            <input required type="text" onkeypress="return MascaraTelefone(this, event);" name="celular" size="15" maxlength="14"  value="<?php if(isset($pessoa)){echo($pessoa["celular"]);}?>"/>
                        </p>                    
                        <p>
                            <?php if(!isset($pessoa)){?>
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
