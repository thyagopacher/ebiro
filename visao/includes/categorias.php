            <?php 
                include($antes."controlador/ProcurarCatMestre.php");
                $categorias = $retornocategoria;
            ?>
            <div id="categorias">
                <div>
                    <?php
                    if(mysql_num_rows($categorias) > 0){
                        while($categoria = mysql_fetch_array($categorias)){
                            echo("<a title='Visualize produtos da categoria' href='$caminho2/Categoria/$categoria[codcategoria]'>$categoria[nome]</a>");
                        }
                    }else{
                        echo("Nenhuma categoria cadastrada");
                    }
                    ?>
                </div>
            </div>