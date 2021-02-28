<?php
    function verificaImagens($produto){
        $indice = 0;
        for($i = 1; $i < 9; $i++){
            if(!isset($produto["imagem". $i]) || $produto["imagem". $i] === "" || $produto["imagem". $i] === NULL){
                $indice = $i;
                break;
            }
        }
        return $indice;
    }

    include("includes/validaLogin.php");
    $painel = TRUE;
    if(isset($_REQUEST["codproduto"])){
        include("../../controlador/ProcurarProdutoCodigo.php");
        if(isset($retornoproduto)){
            $produto = mysql_fetch_array($retornoproduto);
            $indice  = verificaImagens($produto) - 1;
        }else{
            echo("Retorno sem preenchimento");
            $produto = NULL;
        }
    }
  
    if(isset($_SESSION["erro"]) && strstr($_SESSION["erro"], "Produto") === FALSE){
        $_SESSION["erro"] = "";
    }    
    include("../../controlador/ProcurarTodasCategorias.php");
    include("../../controlador/ProcurarTodasFabricantes.php");
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
                height: 1012px;
            }
        </style>
        <?php include("includes/javascriptMenulateral.php");?>            
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Mascara.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/tiny/CarregaEditor.js"></script>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/AbreInputFile.js"></script>
        <title><?=$empresa["fantasia"]?> - Produto</title>
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
                <form action="../../controlador/ControleProduto.php" name="formProduto" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend>Gerenciamento de produtos</legend>
                        <input type="hidden" name="codproduto" value="<?php if(isset($produto)){echo($produto["codproduto"]);}?>"/>
                        <p>
                            <label>Vitrine:</label>
                            <select name="vitrine" title="Aparece na página inicial, disponivel 5 posições">
                                <?php 
                                if(isset($produto) && isset($produto["vitrine"]) && $produto["vitrine"] === "SIM"){?>
                                    <option>NÃO</option>
                                    <option selected>SIM</option>
                                <?php 
                                }
                                if(isset($produto) && isset($produto["vitrine"]) && $produto["vitrine"] === "NÃO"){?>
                                    <option selected>NÃO</option>
                                    <option>SIM</option>                            
                               <?php
                                }
                                if((isset($produto) && ($produto["vitrine"] === NULL || $produto["vitrine"] === "")) || (!isset($produto) && $produto["vitrine"] !== "NÃO" && $produto["vitrine"] !== "SIM")){
                                ?>
                                    <option>NÃO</option>
                                    <option>SIM</option>                                 
                                <?php 
                                }?>
                            </select>
                        </p>                    
                        <p>
                            <label>Fabricante:</label>
                            <select name="codfabricante">
                                <?php
                                    if(mysql_num_rows($retornofabricantes) > 0){
                                        echo("<option>Nada escolhido</option>");
                                        while($fabricante = mysql_fetch_array($retornofabricantes)){
                                            if(isset($produto["codfabricante"]) && $produto["codfabricante"] === $fabricante["codfabricante"]){
                                                echo("<option value='$fabricante[codfabricante]' selected>".$fabricante["nome"]."</option>");
                                            }else{
                                                echo("<option value='$fabricante[codfabricante]'>".$fabricante["nome"]."</option>");
                                            }
                                        }
                                    }else{
                                        echo("<option>Nada encontrado</option>");
                                    }
                                ?>
                            </select>
                        </p>                     
                        <p>
                            <label>Categoria:</label>
                            <select name="codcategoria">
                                <?php
                                    if(mysql_num_rows($retornotudo) > 0){
                                        while($categoria = mysql_fetch_array($retornotudo)){
                                            if(isset($produto["codcategoria"]) && $produto["codcategoria"] === $categoria["codcategoria"]){
                                                echo("<option value='$categoria[codcategoria]' selected>".$categoria["nome"]."</option>");
                                            }else{
                                                echo("<option value='$categoria[codcategoria]'>".$categoria["nome"]."</option>");
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
                            <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($produto)){echo($produto["nome"]);}?>"/>
                        </p>
                        <p>
                            <label>Desconto(%):</label>
                            <input title="Coloque aqui o desconto para o produto" type="text" name="desconto" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['desconto'], 2, ',', '.'));}?>"/>
                        </p>                     
                        <p>
                            <label>Valor:</label>
                            <input required type="text" name="valor" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['valor'], 2, ',', '.'));}?>"/>
                        </p> 
                        <p>
                            Coloque as medidas abaixo caso deseje enviar pelos correios:<br>
                            <a target="_blank"  href="http://www.correios.com.br/produtosaz/produto.cfm?id=8560360B-5056-9163-895DA62922306ECA">
                                -Medidas para se utilizar padrão Correios
                            </a>
                        </p>
                        <p>
                            <label>Peso:</label>
                            <input type="text" name="peso" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['peso'], 2, ',', '.'));}?>"/>
                        </p>  
                        <p>
                            <label>Comprimento:</label>
                            <input type="text" name="comprimento" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['comprimento'], 2, ',', '.'));}?>"/>
                        </p> 
                        <p>
                            <label>Largura:</label>
                            <input type="text" name="largura" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['largura'], 2, ',', '.'));}?>"/>
                        </p>
                        <p>
                            <label>Altura:</label>
                            <input type="text" name="altura" size="10" maxlength="10" onKeyPress="return(MascaraMoeda(this,'.',',',event));"  value="<?php if(isset($produto)){echo(number_format($produto['altura'], 2, ',', '.'));}?>"/>
                        </p>                         
                        <p>
                            <label>Descrição:</label>
                            <textarea cols="50" rows="10" name="descricao"><?=$produto["descricao"]?></textarea>
                        </p>
<!--                        <p>
                            <label>Cor:</label>
                            <?php 
                            $_REQUEST["submit"] = "Procurar Nome";
                            require_once("../../controlador/ControleCor.php");
                            $cores  = $retorno;
                            $cores2 = $retorno;
                            ?>
                            <select name="cor1">
                                <?php
                                if(mysql_num_rows($cores) > 0){
                                    echo("<option>Nada encontrado</option>");
                                    while($cor = mysql_fetch_array($cores)){
                                        if($cor["nome"] === $produto["cor1"]){
                                            echo("<option selected>$cor[nome]</option>");
                                        }else{
                                            echo("<option>$cor[nome]</option>");
                                        }
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>
                        </p>-->
<!--                        <p>
                            <label>Cor 2:</label>                  
                            <select name="cor2">
                                <?php
                                if(mysql_num_rows($cores2) > 0){
                                    echo("<option>Nada encontrado</option>");
                                    while($cor = mysql_fetch_array($cores2)){
                                        echo("<option value='$cor[valor]'>$cor[nome]</option>");
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>
                        </p>
                        <p>
                            <label>Cor 3:</label>
                            <select name="cor3">
                                <?php
                                if(mysql_num_rows($cores) > 0){
                                    echo("<option>Nada encontrado</option>");
                                    while($cor = mysql_fetch_array($cores)){
                                        echo("<option value='$cor[valor]'>$cor[nome]</option>");
                                    }
                                }else{
                                    echo("<option>Nada encontrado</option>");
                                }
                                ?>
                            </select>
                        </p>                        -->
                        <div style="height: 20px;">
                            <?php if($indice < 8){?>
                            <a class="botao" title="Primeiro adicione antes para quantas imagens quer carregar, e somente depois selecione as imagens" style="float: right;height: 20px;" href="javascript: abreInput()">+</a>
                            <span style="float: left;">Imagens abertas:</span>
                                <?php if($indice <= 0){
                                    $indice = 1;
                                    ?>
                                    <div style="float: left; width: 10px;" title="Quantidade de inputs abertos" id="indice"><?=$indice?></div>
                                    <input type="file" name="imagem1" accept="image/*" title="Tamanho ideal 200px por 150px"/><br>
                                <?php }else{?>
                                    <div style="float: left; width: 10px;" title="Quantidade de inputs abertos" id="indice"><?=$indice?></div>
                              <?php }?>                        
                            <?php }?>   
                        </div>       
                        <?php if(isset($produto["imagem1"]) && $produto["imagem1"] !== NULL && $produto["imagem1"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 1:<br>(600px por 480px)</label><br>
                            <input type="file" name="imagem1" accept="image/*" title="Tamanho ideal 600px por 480px"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem1]' title='imagem 1' alt='imagem 1'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem1">X</a>
                        </p>
                        <?php }?>
                        <?php if(isset($produto["imagem2"]) && $produto["imagem2"] !== NULL && $produto["imagem2"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 2:</label><br>
                            <input type="file" name="imagem2" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem2]' title='imagem 2' alt='imagem 2'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem2">X</a>
                        </p> 
                        <?php }?>
                        <?php if(isset($produto["imagem3"]) && $produto["imagem3"] !== NULL && $produto["imagem3"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 3:</label><br>
                            <input type="file" name="imagem3" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem3]' title='imagem 3' alt='imagem 3'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem3">X</a>               
                        </p>
                        <?php }?> 
                        <?php if(isset($produto["imagem4"]) && $produto["imagem4"] !== NULL && $produto["imagem4"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 4:</label><br>
                            <input type="file" name="imagem4" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem4]' title='imagem 4' alt='imagem 4'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem4">X</a>                
                        </p>
                        <?php }?>  
                        <?php if(isset($produto["imagem5"]) && $produto["imagem5"] !== NULL && $produto["imagem5"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 5:</label><br>
                            <input type="file" name="imagem5" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem5]' title='imagem 5' alt='imagem 5'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem5">X</a>              
                        </p> 
                        <?php }?>  
                        <?php if(isset($produto["imagem6"]) && $produto["imagem6"] !== NULL && $produto["imagem6"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 6:</label><br>
                            <input type="file" name="imagem6" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem6]' title='imagem 6' alt='imagem 6'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem6">X</a>            
                        </p> 
                        <?php }?>     
                        <?php if(isset($produto["imagem7"]) && $produto["imagem7"] !== NULL && $produto["imagem7"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 7:</label><br>
                            <input type="file" name="imagem7" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem7]' title='imagem 7' alt='imagem 7'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem7">X</a>              
                        </p>
                        <?php }?>  
                        <?php if(isset($produto["imagem8"]) && $produto["imagem8"] !== NULL && $produto["imagem8"] !== ""){?>
                        <p style="width: 200px;">
                            <label>Imagem - 8:</label><br>
                            <input type="file" name="imagem8" accept="image/*"/><br>
                            <?php echo("<img width='150' height='100' src='../recursos/imagens/$produto[imagem8]' title='imagem 8' alt='imagem 8'/><br>");?>
                            <a class="btexcluir" href="../../controlador/ControleProduto.php?submit=Excluir Imagem&codproduto=<?=$produto["codproduto"]?>&ordem=imagem8">X</a>            
                        </p> 
                        <?php }?> 
                        <div id="res"></div> 
                        <p>
                            <?php if(!isset($produto)){?>
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
