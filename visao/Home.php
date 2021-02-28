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
        </script>            -->
        <title><?=$empresa["fantasia"]?> - Home</title>
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
            
        </article>
        <footer>
            <?php 
            include("includes/rodape1.php");
            include("includes/rodape2.php");
            ?>
        </footer>
    </body>
</html>
