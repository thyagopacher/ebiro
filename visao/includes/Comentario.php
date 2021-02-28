            <form action="../controlador/ControleComentario.php" name="formComentario" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Digite aqui seu comentário</legend>
                    <?php 
                    if(isset($codproduto)){
                        echo("<input type='hidden' name='codproduto' value='$codproduto'/>");
                    }
                    ?>
                    <p>
                        <label>Nome:</label>
                        <input required type="text" name="nome" size="50" maxlength="50" value="<?php if(isset($comentario)){echo($comentario["nome"]);}?>"/>
                    </p>      
                    <p>
                        <label>E-mail:</label>
                        <input required type="email" name="email" size="50" maxlength="50" value="<?php if(isset($comentario)){echo($comentario["email"]);}?>"/>
                    </p>     
                    <p>
                        <label>Texto:</label>
                        <textarea cols="80" rows="10" name="texto" required placeholder="Digite aqui o texto de comentário">
                            <?php if(isset($comentario)){echo($comentario["texto"]);}?>
                        </textarea>
                    </p>
                                      
                    <p>
                        <input type="submit" name="submit" value="Cadastrar"/>
                    </p>
                </fieldset>
            </form>
