<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_REQUEST["procurar"])){
        include("../modelo/ModelPessoa.php");
        $filtro = $_REQUEST["procurar"];
        $query  = "select p.*"
                . " from pessoa p "
                . " where p.nome like '%$filtro%' or "
                . " p.logradouro like '%$filtro%' or"
                . " p.cidade like '%$filtro%' or"
                . " p.estado like '%$filtro%' and"
                . " p.codtipo = '1' order by p.nome";
        $modelo        = new ModelPessoa();
        $retornopessoa = $modelo->procurar($query);
        if(mysql_num_rows($retornopessoa) > 0){?>
            <table>
                <thead>
                    <tr>
                        <th style='border-right: 1px solid #777777;'>Nome:</th>
                        <th style='border-right: 1px solid #777777;'>E-mail:</th>
                        <th style='border-right: 1px solid #777777;'>Telefone:</th>
                        <th style='border-right: 1px solid #777777;'>Celular:</th>
                        <th style='border-right: 1px solid #777777;'>Editar:</th>
                        <th>Excluir:</th>
                    </tr>
                </thead>
            <tbody>
          <?php
          while($pessoa = mysql_fetch_array($retornopessoa)){
                echo("<tr>");
                echo("<td style='border-right: 1px solid #777777;'><a title='Clique para ver informações da pessoa' href='Pessoa.php?codpessoa=$pessoa[codpessoa]&submit=Procurar'>".$pessoa["nome"]."</a></td>");
                echo("<td style='border-right: 1px solid #777777;'><a title='Clique para chamar programa de envio de e-mails' href='mailto:$pessoa[email]'>".$pessoa["email"]."</a></td>");
                echo("<td style='border-right: 1px solid #777777;'>".$pessoa["telefone"]."</td>");
                echo("<td style='border-right: 1px solid #777777;'>".$pessoa["celular"]."</td>");
                echo("<td style='border-right: 1px solid #777777;'><a href='Pessoa.php?codpessoa=$pessoa[codpessoa]&submit=Procurar'><img src='../recursos/imagens/editar.gif'/></a></td>");
                echo("<td><a title='Clique para excluir a pessoa' class='btexcluir' href='../../controlador/ControlePessoa.php?codpessoa=$pessoa[codpessoa]&submit=Excluir'>X</a></td>");
                echo("</tr>");
            }
            ?>
            </tbody>
            </table>
            <?php
        }else{
            echo("Nada encontrado");
        }
    }
?>
