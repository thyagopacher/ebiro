<?php if(isset($configuracao["emailpagseguro"]) && $configuracao["emailpagseguro"] !== NULL && $configuracao["emailpagseguro"] !== ""){?>
<form target="pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post">
    <input type="hidden" name="email_cobranca" value="<?=$configuracao["emailpagseguro"]?>" />
    <input type="hidden" name="tipo" value="VER" />
    <input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/99x61-carrinho-assina.gif" name="submit" alt="Visualizar carrinho de compras" />
</form>
<?php } ?>