<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_REQUEST["procurar"])){
        include("../modelo/ModelNovidades.php");
        $filtro = $_REQUEST["procurar"];
        $query  = "select * from novidades p "
                . " where p.nome like '%$filtro%' or "
                . " p.email like '%$filtro%'";
        $modelo         = new ModelNovidades();
        $retornonovidades = $modelo->procurar($query);
        if(mysql_num_rows($retornonovidades) > 0){
            echo("<table border='1'>");
            echo("<thread>");
            echo("<tr>");
            echo("<th>Nome</th>");
            echo("<th>E-mail</th>");
            echo("<th>Status</th>");
            echo("</tr>");
            echo("</thread>");
            echo("<tbody>");
            while($novidades = mysql_fetch_array($retornonovidades)){
                echo("<tr>");
                echo("<td>".$novidades["nome"]."</td>");
                echo("<td><a href='mailto:$novidades[email]'>".$novidades["email"]."</a></td>");
                if($novidades["status"] === '0'){
                    $status = "ativo";
                }else{
                    $status = "inativo";
                }
                echo("<td>".$status."</td>");
                echo("</tr>");
            }
            echo("</tbody>");
            echo("</table>");
        }else{
            echo("Nada encontrado de pessoas para novidades");
        }
    }
?>
