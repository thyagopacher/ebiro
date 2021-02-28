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
    $_REQUEST["submit"] = "Procurar query";
    $_REQUEST["query"]   = "select * from formapagamento where status = 'SIM'";
    require_once($antes."controlador/ControleFormaPagamento.php");
    $formapagamento = $retorno;
    
    if($formapagamento !== NULL && $formapagamento !== FALSE && mysql_num_rows($formapagamento) > 0){
        while($forma = mysql_fetch_array($formapagamento)){
            echo("<img class='imgFormaPagamento' src='$caminho/recursos/imagens/$forma[logo]' alt='$forma[nome]' title='$forma[nome]'/>");
        }
    }else{
        echo("Nenhuma forma de pagamento cadastrada");
    }
?>
