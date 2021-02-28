        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="UTF-8"/>
        <meta name="robots" content="ALL" />        
        <?php
            $site     = "http://".$_SERVER['SERVER_NAME'];
            $pasta    = "/novo/";
            $caminho  = $site.$pasta. "/visao/";
            $caminho2 = $site.$pasta;
            if(isset($painel) && $painel === TRUE){
                $antes = "../../";
            }else{
                if(isset($painel) && $painel === "INDEX"){
                    $antes = "";
                }else{
                    $antes = "../";
                }
            }
            require_once($antes."controlador/ProcurarConfiguracao.php");
            if(isset($retornoconfiguracao)){
                $configuracao = mysql_fetch_array($retornoconfiguracao);
            }
            $_REQUEST["submit"] = "Procurar";
            if(!isset($_REQUEST["codempresa"]) || $_REQUEST["codempresa"] === NULL || $_REQUEST["codempresa"] === ""){
                $_REQUEST["codempresa"] = "1";
            }
            require_once($antes."controlador/ProcurarEmpresa.php");
            if(isset($retorno)){
                $empresa = mysql_fetch_array($retorno);
            }
 
            require_once($antes."controlador/ControleEbiro.php");
        ?>
        <meta name="description" content="<?=$configuracao["descricao"];?>" />
        <meta name="keywords" content="<?=$configuracao["palavrachave"];?>" />
