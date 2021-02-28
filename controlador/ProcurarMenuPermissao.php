<?php

    if(isset($painel) && $painel === TRUE){
        $antes = "../../";    
    }else{
        $antes = "../";
    }
    require_once($antes."modelo/ModelMenu.php");    
    function procurarMenu($codcargo, $codcategoria){
        $modelo     = new ModelMenu();
        $comando1   = "select pc.*,(select nome from menu where codmenu = pc.codmenu) as menu from permissaocargo pc where codcargo = '$codcargo'";
        echo($comando1);
        $resultado1 = $modelo->procurar($comando1);
        $dados      = mysql_fetch_array($resultado1);
        $situacao   = $dados["status"];
        if($situacao === "Todos"){
            $query = "select m.*, m.nome as menu from menu m where m.codcategoria = '$codcategoria' order by m.nome";
        }else{
            $query = "select m.*, m.nome as menu from menu m, permissaocargo pc where "
                    . "pc.codcargo  = '$codcargo' and m.codmenu = pc.codmenu and m.codcategoria = '$codcategoria' order by m.nome";
        }
        echo($query);
        return $modelo->procurar($query);
    }
?>