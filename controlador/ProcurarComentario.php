<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_REQUEST["procurar"])){
        include("../modelo/ModelComentario.php");
        $filtro = $_REQUEST["procurar"];
        $query  = "select p.*,"
                . " (select nome from produto where codproduto = p.codproduto) as produto"
                . " from comentario p "
                . " where p.nome like '%$filtro%' or "
                . " p.texto like '%$filtro%' or "
                . " p.status like '%$filtro%'";
        $modelo         = new ModelComentario();
        $retornocomentario = $modelo->procurar($query);
        if(mysql_num_rows($retornocomentario) > 0){
        ?>
         <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Comentário</th>
                    <th>Produto</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
        <?php
            echo("<tr>");
            while($comentario = mysql_fetch_array($retornocomentario)){
                echo("<td>$comentario[nome]</td>");
                echo("<td><a href='mailto:$comentario[email]'>$comentario[email]</a></td>");
                echo("<td><a href='Comentario.php?codcomentario=$comentario[codcomentario]&submit=Procurar' title='Clique para editar o comentario'>".$comentario["texto"] . "</a></td>");
                $status = "";
                if($comentario["status"] === 1){
                    $status = "NÃO";
                }else{
                    $status = "SIM";
                }
                if(isset($comentario["produto"])){
                    echo("<td><a href='Produto.php?codproduto=$comentario[codproduto]' title='Nome do produto'>".$comentario["produto"]."</a></td>");
                }else{
                    echo("<td>Não cadastrado</td>");
                }
                echo("<td>$status</td>");
            }
            echo("</tr>");
            ?>
            </tbody>
        </table>
<?php
        }else{
            echo("Nada encontrado");
        }
    }
?>
