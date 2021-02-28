<link href="<?=$antes?>visao/recursos/css/tema1/menuHorizontal.css" type="text/css" rel="stylesheet" />
<div id="menu_horizontal" align="center">
    	<ul class="menu">
                <li>
                    <a href="index.php">
                        Inicio<br>
                        <img src="<?=$caminho?>/recursos/imagens/Inicio.png" alt="Inicio" title="Inicio do painel administrativo"/>
                    </a>
                </li>            
                <li>
                    <a href="Contato.php" title="Formulário para contato de suporte">
                        Suporte<br>
                        <img src="<?=$caminho?>/recursos/imagens/Suporte.png" alt="Contato de Suporte"/>
                    </a>
                </li>
                <li>
                    <a href="Pessoa.php?codpessoa=<?=$_SESSION["codpessoa"]?>" title="Meu Perfil">
                        Meu Perfil<br>
                        <img src="<?=$caminho?>/recursos/imagens/Perfil.png" alt="Meu Perfil"/>
                    </a>
                </li>
                <li>
                    <a href="<?=$antes?>Chat" title="Entrar no seu chat do site">
                        Chat<br>
                        <img src="<?=$caminho?>/recursos/imagens/Chat.png" alt="Chat"/>
                    </a>
                </li>
                <li>
                    <a href="" title="Perguntas frequentes">FAQ'S<br>
                        <img src="<?=$caminho?>/recursos/imagens/FAQ.png" alt="Perguntas"/>
                    </a>
                </li>
        	<!--<li><a href="Configuracao.php" title="Configurações do site">Configuração</a></li>
                <li><a href="Frete.php" title="frete">Calcúlo de frete</a></li>-->
                <li>
                    <a href="../../controlador/Logout.php">
                        Sair<br>
                        <img src="<?=$caminho?>/recursos/imagens/Sair.png" title="Sair do sistema" alt="Sair do sistema"/>
                    </a>
                </li>
        </ul>
    </div>