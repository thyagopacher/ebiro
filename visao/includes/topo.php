<div id="grupo">
    <a href="<?=$caminho2?>">
        <img class="logo" src="<?=$caminho?>recursos/imagens/<?=$empresa["logo"]?>" alt="Logo da empresa"/>
    </a>
    <div id="menuSuperior">
        <p class="amaior">
            <img src="<?=$caminho?>/recursos/imagens/atendimento.png" alt="atendimento"/>
            <span>
                <script language="JavaScript" src="http://www.ebiro.com.br/venda/Chat/js/status_image.php?base_url=http://www.ebiro.com.br/venda/Chat&l=admin&x=1&deptid=1&text=Atendimento+Online"></script>         
            </span>
        </p>
        <p class="amaior">
            <a href="">
                <img src="<?=$caminho?>/recursos/imagens/televendas.png" alt="televendas"/>
                <span>Televendas: <?=$empresa["telefone"]?></span>
            </a>
        </p>
        <p class="amenor">
            <a href="<?=$caminho2?>/Localizacao">
                <img src="<?=$caminho?>/recursos/imagens/mapa.png" alt="Localização"/>
                <span>Loja mais próxima</span>
            </a>
        </p>
        <p class="amenor">
            <a href="<?=$caminho2?>/Entrar">
                <img src="<?=$caminho?>/recursos/imagens/conta.png" alt="Minha conta"/>
                <span>Minha conta login e senha</span>
            </a>
        </p>
        <p class="amenor"><a href="">Meus pedidos</a></p>
        <?php
        if(isset($configuracao) && isset($configuracao["emailpagseguro"]) && $configuracao["emailpagseguro"] !== NULL && $configuracao["emailpagseguro"] !== ""){?>
        <form target="pagseguro" name="pagseguro" action="https://pagseguro.uol.com.br/security/webpagamentos/webpagto.aspx" method="post">
            <input type="hidden" name="email_cobranca" value="<?=$configuracao["emailpagseguro"]?>" />
            <input type="hidden" name="tipo" value="VER" />
            <p class="amenor">
                <a href="javascript: pagseguro.submit()">
                    <img src="<?=$caminho?>/recursos/imagens/carrinho.png" alt="Meu carrinho"/>
                    <span>Carrinho</span>
                </a>
            </p>
        </form>
        <?php 
            }
        ?>        
    </div>
</div>

