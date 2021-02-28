<html>
    <head>
        <?php include("includes/head.php");?>
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/modelo.css" type="text/css" media="screen">
        <link rel="stylesheet" href="<?=$caminho?>/recursos/css/tema1/menuDepartamentos.css"/>
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/cufon-yui.js"></script> 
        <script type="text/javascript" src="<?=$caminho?>/recursos/javascript/Aller.font.js"></script> 
<!--        <script type="text/javascript">
                Cufon.replace('ul.oe_menu div a',{hover: true});
                Cufon.replace('h1,h2,.oe_heading');
        </script> -->
        <title><?=$empresa["fantasia"]?> - Departamentos</title>
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
            require_once("../controlador/Departamentos.php");
            if($retcategorias !== NULL && $retcategorias !== FALSE && mysql_num_rows($retcategorias) > 0){
                while($categoria = mysql_fetch_array($retcategorias)){
                    echo("<div id='categoria'>");
                    echo("<a href='".$caminho2."/Categoria/$categoria[codcategoria]'><h4>".ucfirst(strtolower($categoria["nome"]))."</h4></a>");
                    echo("</div>");
                }
            }else{
                echo("Nada encontrado");
            }
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
