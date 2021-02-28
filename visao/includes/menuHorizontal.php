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
    include($antes."controlador/ProcurarCatMestre.php");
    include($antes."controlador/ProcurarSubcategoria.php");
    $caminho2 = $site.$pasta ."/";
?>
<link href="<?=$caminho?>recursos/css/tema1/menuHorizontal.css" type="text/css" rel="stylesheet" />
<div id="menu_horizontal" align="center">
    	<ul class="menu">
                <li><a href="<?=$caminho2?>Departamentos">Ver todos os departamentos</a></li>
        	<li> 
                    <a href="<?=$caminho2?>Entrar" title="Entrar para realizar suas compras">Entrar</a>
                </li>
        	<li>
                    <a href="<?=$caminho2?>Quem_somos" title="Descrição da empresa dona da loja">Quem somos</a>
                </li>
        	<li>
                    <a href="<?=$caminho2?>Como_comprar" title="Manual de como realizar suas compras">Como Comprar</a>
                </li>
        	<li>
                    <a href="<?=$caminho2?>Localizacao" title="Localização da loja">Localização</a>
                </li>
        	<li>
                    <a href="<?=$caminho2?>Contato" title="Contato com o administrador de loja">Contato</a>
                </li>
        </ul>
    </div>