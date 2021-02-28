<html>
    <head>
        <?php include("includes/head.php");?>
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/modelo.css" type="text/css" media="screen">
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/buscar.css"/>
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/menuDepartamentos.css"/>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/cufon-yui.js"></script> 
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Aller.font.js"></script> 
        <title><?=$empresa["fantasia"]?> - Contéudo</title>
    </head>
    <body>
        <header>
            <?php 
            include("includes/topo.php");
            include("includes/categorias.php");
            include("includes/busca.php");
            ?>          
        </header>
        <article>
<?php
    $conteudo = "Nada informado para mostrar";
    if(isset($_REQUEST["page"])){
        if($_REQUEST["page"] === "QuemSomos"){
            $conteudo = $configuracao["quemsomos"];
        }else{
            $_REQUEST["submit"] = "Procurar Titulo";
            $_REQUEST["titulo"] = $_REQUEST["page"];
            if($_REQUEST["page"] === "Como_comprar"){
                $_REQUEST["titulo"] = "Como comprar";
            }
            if($_REQUEST["page"] === "Trocas_e_devolucoes"){
                $_REQUEST["titulo"] = "Trocas e devoluções";
            }     
            if($_REQUEST["page"] === "Seja_fornecedor"){
                $_REQUEST["titulo"] = "Seja nosso fornecedor";
            }    
            if($_REQUEST["page"] === "Principais_fornecedores"){
                $_REQUEST["titulo"] = "Principais fornecedores";
            }         
            if($_REQUEST["page"] === "Politica_de_Privacidade"){
                $_REQUEST["titulo"] = "Politica de Privacidade";
            }
      
            include("../controlador/ControlePagina.php");
            if(isset($retorno) && $retorno !== FALSE && $retorno !== NULL){
               $resultado = mysql_fetch_array($retorno);
               $conteudo  = "<h4>".$resultado["titulo"]."</h4>"
                       ."<p>".$resultado["texto"]."</p>";
            }else{
                echo("Nada encontrado");
            }
        }
    }
    echo($conteudo);
?>            
        </article>
        <footer>
            <?php 
            include("includes/rodape1.php");
            include("includes/rodape2.php");
            ?>
        </footer>
    </body>
</html>
