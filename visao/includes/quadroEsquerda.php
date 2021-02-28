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
    $caminho2 = $site . $pasta . "/";
?>
<div id="quadroMini">
    <span>NEWSLETTER</span>
    <form action="<?=$antes?>controlador/ControleNovidades.php" method="post" name="cadastrar">
        <p>
            <label>Nome:</label>
            <input type="text" name="nome" required/>
        </p>
        <p>
            <label>E-mail:</label>
            <input type="email" name="email" required />
        </p>
        <p>
            <input type="submit" name="submit" value="Cadastrar"/>
        </p>
    </form> 
</div>

<div id="quadroMini">
    <span>TRABALHE CONOSCO</span>
    <a href="<?=$caminho2?>Trabalhe_conosco" title="Acessar formulário" class="botao">Acesse</a>
</div>