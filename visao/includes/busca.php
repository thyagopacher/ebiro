            <div id="busca">
                <div>
                    <ul id="oe_menu" class="oe_menu">
                        <li><a class="escuro categorias" href="#">Ver todos as categorias</a>
                            <?php
                            $_REQUEST["submit"] = "Procurar Nome";
                            require_once($antes."controlador/ControleCategoriaProduto.php");
                            $categorias2 = $retorno;                            
                            ?>
                            <div style="margin-top: 0px; margin-left: -80px; color: #00395C;border: 1px solid black;">
                                <ul>
                                    <?php if($categorias2 !== FALSE && $categorias2 !== NULL && $categorias2 !== "" && mysql_num_rows($categorias2) > 0){?>
                                    <?php   while($categoria = mysql_fetch_array($categorias2)){
                                                echo("<li><a class='departamentos' href='$caminho2/Categoria/$categoria[codcategoria]'>$categoria[nome]</a></li>"); 
                                          }
                                     }else{?>
                                    <li><a href="">Nada encontrado</a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <form action="<?=$caminho2?>/Categoria" method="post" name="procurar">
                        <input type="search" list="listabusca" placeholder="Pesquise aqui" name="procurar" size="50" maxlength="50"/>
                        <datalist id="listabusca">
                            <option>Sites</option>
                            <option>Sistemas ERP</option>
                            <option>Desenvolvimento WEB</option>
                        </datalist>                           
                        <input type="image" name="submit" src="<?=$caminho?>/recursos/imagens/lupa.png" alt="Buscar produtos"/>
                    </form>
                    <div class="escuro hora">
                        <div class="texto">Ofertas 24 horas</div>
                        <img class="relogio" src="<?=$caminho?>/recursos/imagens/relogio.png" alt=""/>
                    </div>                    

                </div>
            </div>