<?php
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
?>   
            <div id="quadro1">
                <h4>Produtos em oferta</h4>
                <?php
                include($antes."controlador/ProcurarProdutoVitrine.php");
                if(isset($retornoproduto) && mysql_num_rows($retornoproduto) > 0){
                    $i = 1;
                    while($produto = mysql_fetch_array($retornoproduto)){
                        $desconto = calculaDesconto($produto);
                        $lucro    = calculaLucro($produto, $configuracao)
                ?>     
                <div id="item">
                    <div align="center">
                        <img src="<?=$caminho?>/recursos/imagens/<?=$produto["imagem1"]?>" title="Imagem do produto"/>
                        <div id="informacoesItem">
                                <?php 
                                if(isset($produto)){
                                    echo($produto["nome"]. "<br>");
                                    $de    = $produto['valor'] + $lucro;
                                    $valor = 0.0; 
                                    if(isset($produto["desconto"]) && $produto["desconto"] !== "0"){
                                        $por   = $de - $desconto;
                                        $valor = $por; 
                                        echo("<span class='precovelho'>De: R$ ".number_format($de, 2, ',', '.'). "</span><br>");
                                        echo("<span class='preconovo'>Por: R$ ".number_format($por, 2, ',', '.')."</span>");
                                    }else{
                                        $valor = $de;
                                        echo("De: R$ ".number_format($de, 2, ',', '.'));
                                    }
                                }
                                if(isset($configuracao) && $configuracao["parcelasjuro"] !== NULL && $configuracao["parcelasjuro"] !== ""){
                                    if(isset($por) && $por !== NULL && $por !== ""){
                                        $parcela = $por / $configuracao["parcelasjuro"];
                                    }else{
                                        $parcela = $de / $configuracao["parcelasjuro"];
                                    }
                                ?>
                            <br><span class="parcela"><?=$configuracao["parcelasjuro"]?> X de <?=number_format($parcela, 2, ',', '.')?> sem juros</span><br>
                                <?php 
                                }
                                ?>
                                <p class="botao"><a href="<?=$caminho2?>/Produto/<?=$produto["codproduto"]?>">mais detalhes</a></p>
                                <?php if(isset($configuracao["emailpagseguro"]) && $configuracao["emailpagseguro"] !== NULL && $configuracao["emailpagseguro"] !== ""){?>
                                <form target="pagseguro" method="post" name="pagseguro<?=$i?>"
                                action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
                                    <input type="hidden" name="email_cobranca"
                                    value="<?=$configuracao["emailpagseguro"]?>" />
                                    <input type="hidden" name="tipo" value="CBR" />
                                    <input type="hidden" name="moeda" value="BRL" />
                                    <input type="hidden" name="item_id" value="<?=$produto["codproduto"]?>" />
                                    <input type="hidden" name="item_descr"
                                    value="<?=$produto["nome"]?>" />
                                    <input type="hidden" name="item_quant" value="1" />
                                    <input type="hidden" name="item_valor" value="<?=number_format($valor, 2, ',', '.')?>" />
                                    <input type="hidden" name="frete" value="0" />
                                    <input type="hidden" name="peso" value="0" />
                                    <p class="botao"><a href="javascript: pagseguro<?=$i?>.submit()">envia para o carrinho</a></p>   
                                </form>                                
                                <?php }?>                     
                        </div>
                    </div>
                </div> 
                <?php
                    $i = $i + 1;
                    }
                }else{
                    echo("Nada encontrado");
                }
                ?> 
            </div>
            <div id="quadro2">
                <h4>10 últimos produtos</h4>
                <?php 
                include($antes."controlador/ProcurarUltimosProdutos.php");
                if(isset($retornoproduto) && mysql_num_rows($retornoproduto) > 0){
                    $i = $i + 1;
                    while($produto = mysql_fetch_array($retornoproduto)){    
                        $desconto = calculaDesconto($produto);
                        $lucro    = calculaLucro($produto, $configuracao)
                ?>     
                <div id="item">
                    <div align="center">
                        <a href="<?=$caminho2?>/Produto/<?=$produto["codproduto"]?>" title="Visualize produto">
                            <img src="<?=$caminho?>/recursos/imagens/<?=$produto["imagem1"]?>" title="Imagem do produto"/>
                        </a>
                        <div id="informacoesItem">
                                <?php
                                if(isset($produto)){
                                    echo($produto["nome"]. "<br>");
                                    $de  = $produto['valor'] + $lucro;
                                    if(isset($produto["desconto"]) && $produto["desconto"] !== "0"){
                                        $por = $de - $desconto;
                                        echo("<span class='precovelho'>De: R$ ".number_format($de, 2, ',', '.'). "</span><br>");
                                        echo("<span class='preconovo'>Por: R$ ".number_format($por, 2, ',', '.')."</span>");
                                    }else{
                                        $por = "";
                                        echo("De: R$ ".number_format($de, 2, ',', '.'));
                                    }
                                }
                                if(isset($configuracao) && $configuracao["parcelasjuro"] !== NULL && $configuracao["parcelasjuro"] !== ""){
                                    if(isset($por) && $por !== NULL && $por !== ""){
                                        $parcela = $por / $configuracao["parcelasjuro"];
                                    }else{
                                        $parcela = $de / $configuracao["parcelasjuro"];
                                    }
                                ?>
                            <br><span class="parcela"><?=$configuracao["parcelasjuro"]?> X de <?=number_format($parcela, 2, ',', '.')?> sem juros</span><br>
                                <?php 
                                }
                                ?>
                                <p class="botao"><a href="<?=$caminho2?>/Produto/<?=$produto["codproduto"]?>">mais detalhes</a></p>
                                <?php if(isset($configuracao["emailpagseguro"]) && $configuracao["emailpagseguro"] !== NULL && $configuracao["emailpagseguro"] !== ""){?>
                                <form target="pagseguro" method="post" name="pagseguro<?=$i?>"
                                action="https://pagseguro.uol.com.br/checkout/checkout.jhtml">
                                    <input type="hidden" name="email_cobranca"
                                    value="<?=$configuracao["emailpagseguro"]?>" />
                                    <input type="hidden" name="tipo" value="CBR" />
                                    <input type="hidden" name="moeda" value="BRL" />
                                    <input type="hidden" name="item_id" value="<?=$produto["codproduto"]?>" />
                                    <input type="hidden" name="item_descr"
                                    value="<?=$produto["nome"]?>" />
                                    <input type="hidden" name="item_quant" value="1" />
                                    <input type="hidden" name="item_valor" value="<?=$produto["valor"]?>" />
                                    <input type="hidden" name="frete" value="0" />
                                    <input type="hidden" name="peso" value="0" />
                                    <p class="botao"><a href="javascript: pagseguro<?=$i?>.submit()">envia para o carrinho</a></p>   
                                </form>                                
                                <?php }?>          
                        </div>
                    </div>
                </div> 
                <?php
                    $i = $i + 1;
                    }
                }else{
                    echo("Nada encontrado");
                }
                ?>
            </div>