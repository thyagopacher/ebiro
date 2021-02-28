<?php
    include("includes/validaLogin.php");
    if(!isset($_REQUEST["codconfiguracao"])){
        $_REQUEST["codconfiguracao"] = '1';
        $_REQUEST["submit"]          = "Procurar";
    }  
    $painel = TRUE;
    require_once("../../controlador/ProcurarConfiguracao.php");
    if(isset($retornoconfiguracao)){
        $configuracao2 = mysql_fetch_array($retornoconfiguracao);
    }else{
        $configuracao2 = NULL;
    }   
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Configuracao") === FALSE){
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
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/CarregaEditor.js"></script>          
        <title><?=$empresa["fantasia"]?> - Configuração</title>
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
            <form action="../../controlador/ControleConfiguracao.php" name="formConfiguracao" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Gerenciamento de configuração</legend>
                    <input type="hidden" name="codconfiguracao" value="<?php if(isset($configuracao2)){echo($configuracao2["codconfiguracao"]);}?>"/>                                     
                    <p>
                        <label>Parcela S/ Juro:</label>
                        <input type="text" name="parcelasjuro" value="<?php if(isset($configuracao2)){echo($configuracao2["parcelasjuro"]);}?>"/>
                    </p>
                    <p>
                        <label>Lucro(%):</label>
                        <input required title="Porcentagem a ter de lucro para os produtos" type="text" name="lucro" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($configuracao2)){echo(number_format($configuracao2['lucro'], 2, ',', '.'));}?>"/>
                    </p>                     
                    <p>
                        <a href="https://pagseguro.uol.com.br/data/edit.jhtml#!taxes-data">Taxas e tarifas</a><br>
                        <label>E-mail PagSeguro:</label>
                        <input type="email" name="emailpagseguro" size="50" maxlength="50" title="Para liberação de compras via pagseguro" value="<?php if(isset($configuracao2)){echo($configuracao2["emailpagseguro"]);}?>"/>
                    </p>
                    <p>
                        <label>Cor body:</label>
                        <input type="color" name="corbody" value="<?php if(isset($configuracao2)){echo($configuracao2["corbody"]);}?>"/>
                    </p>                    
                    <p>
                        <label>Cor topo:</label>
                        <input type="color" name="cortopo" value="<?php if(isset($configuracao2)){echo($configuracao2["cortopo"]);}?>"/>
                    </p>
                    <p>
                        <label>Cor rodapé:</label>
                        <input type="color" name="corrodape" value="<?php if(isset($configuracao2)){echo($configuracao2["corrodape"]);}?>"/>
                    </p> 
                    <p>
                        <label>Cor original:</label>
                        <select name="cor">
                            <option>NÃO</option>
                            <option>SIM</option>
                        </select>
                    </p>
                    <p>
                        <label>Frete correios:</label>
                        <select name="fretecorreio">
                            <?php 
                            if(isset($configuracao2) && isset($configuracao2["fretecorreio"]) && $configuracao2["fretecorreio"] === "SIM"){?>
                                <option>NÃO</option>
                                <option selected>SIM</option>
                            <?php 
                            }
                            if(isset($configuracao2) && isset($configuracao2["fretecorreio"]) && $configuracao2["fretecorreio"] === "NÃO"){?>
                                <option selected>NÃO</option>
                                <option>SIM</option>                            
                           <?php
                            }
                            if(!isset($configuracao2) && $configuracao2["fretecorreio"] !== "NÃO" && $configuracao2["fretecorreio"] !== "SIM"){
                            ?>
                                <option>NÃO</option>
                                <option>SIM</option>                                 
                            <?php 
                            }?>
                        </select>
                    </p>                    
                    <p>
                        <label>Palavra chave:</label>
                        <textarea name="palavrachave" placeholder="Digite suas palavras chave aqui" cols="80" rows="10"><?php if(isset($configuracao2)){echo($configuracao2["palavrachave"]);}?></textarea>
                    </p> 
                    <p>
                        <label>Descrição:</label>
                        <textarea name="descricao" placeholder="Digite sua mini descrição aqui" cols="80" rows="10"><?php if(isset($configuracao2)){echo($configuracao2["descricao"]);}?></textarea>
                    </p> 
                    <p>
                        <label>Quem somos:</label>
                        <textarea name="quemsomos" placeholder="Digite o quem somos aqui" cols="80" rows="10"><?php if(isset($configuracao2)){echo($configuracao2["quemsomos"]);}?></textarea>
                    </p>                      
                                      
                    <p>
                        <?php if(!isset($configuracao2)){?>
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
