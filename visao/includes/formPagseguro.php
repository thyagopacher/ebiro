<?php if(isset($configuracao["emailpagseguro"]) && $configuracao["emailpagseguro"] !== NULL && $configuracao["emailpagseguro"] !== ""){?>
<form target="pagseguro" method="post" name="pagseguroproduto"
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
    <p class="botao"><a href="javascript: pagseguroproduto.submit()">envia para o carrinho</a></p>   
</form>                                
<?php }?>    