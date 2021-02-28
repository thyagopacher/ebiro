<div id="menu_lateral">
<?php
    $codcargo = $_SESSION["codcargo"];
    include("../../controlador/ProcurarMenuPermissao.php");
    
    $_REQUEST["submit"] = "Procurar Nome";
    $_REQUEST["nome"]   = "";
    include("../../controlador/ControleCategoriaMenu.php");
    $categorias = $retorno;
    
    if(mysql_num_rows($categorias) > 0){
        echo("<ul id='qm0' class='qmmc'>");
        while($categoria = mysql_fetch_array($categorias)){
            echo("<li>");
            $permissoes    = procurarMenu($codcargo, $categoria["codcategoria"]);
            $qtd_permissao = mysql_num_rows($permissoes);
            echo("<a class='qmparent'  href='#' title='$qtd menus permitidos dessa categoria'>$categoria[nome]</a>");  
            if($permissoes !== FALSE && $qtd_permissao > 0){
                echo("<ul>");
                while($permissao = mysql_fetch_array($permissoes)){
                    if($permissao["codcategoria"] === $categoria["codcategoria"]){
                        echo("<li><a href='$permissao[arquivo]'>$permissao[menu]</a></li>");
                    }
                }
                echo("</ul>");
            }     
            echo("</li>"); 
        }
        echo("</ul>");
        ?>
        <script type="text/javascript">qm_create(0,false,0,500,'all',false,false,false,false);</script>    
    <?php
    }
?>
</div>