<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_REQUEST["procurar"])){
        include("../modelo/ModelPermissaoCargo.php");
        
        $filtro = $_REQUEST["procurar"];
        $query  = "select p.*,"
                . "(select nome from cargo where codcargo = p.codcargo) as cargo,"
                . "(select nome from menu where codmenu = p.codmenu) as menu"
                . " from permissaocargo p "
                . " where (select nome from cargo where codcargo = p.codcargo) like '%$filtro%' or"
                . " (select nome from menu where codmenu = p.codmenu) like '%$filtro%'";
        $modelo                 = new ModelPermissaoCargo();
        $retornopermissao       = $modelo->procurar($query);
        if(mysql_num_rows($retornopermissao) > 0){
         ?>
         <table border="1">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Cargo</th>
                    <th>Menu</th>
                    <th>Status</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
        <?php           
            while($permissao = mysql_fetch_array($retornopermissao)){
                echo("<tr>");
                echo("<td><a href='PermissaoCargo.php?codpermissao=$permissao[codpermissao]' title='Clique para editar o permissao'>".$permissao["codpermissao"] . "</a></td>");
                echo("<td>".$permissao["cargo"]."</td>");
                echo("<td>".$permissao["menu"]."</td>");
                echo("<td>".$permissao["status"]."</td>");
                echo("<td><a href='../../controlador/ControlePermissaoCargo.php?submit=Excluir&codpermissao=$permissao[codpermissao]'>Excluir</a></td>");
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
