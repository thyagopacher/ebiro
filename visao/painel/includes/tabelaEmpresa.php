<?php
    $painel = "include";
    $_REQUEST["submit"] = "Procurar Nome";
    include("../../../controlador/ControleEmpresa.php");
    $empresas = $retorno;
    if($empresas !== FALSE && mysql_num_rows($empresas) > 0){
        ?>
        <table>
        <thead>
            <tr>
                <th style='border-right: 1px solid #777777;'>Código</th>
                <th style='border-right: 1px solid #777777;'>Nome</th>
                <th style='border-right: 1px solid #777777;'>Telefone</th>
                <th style='border-right: 1px solid #777777;'>Logradouro</th>
                <th style='border-right: 1px solid #777777;'>Número</th>
                <td style='border-right: 1px solid #777777;'>Editar</td>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
<?php
        while($empresa = mysql_fetch_array($empresas)){
            echo("<tr>");
            echo("<td style='border-right: 1px solid #777777;'>$empresa[codempresa]</td>");
            echo("<td style='border-right: 1px solid #777777;'>$empresa[fantasia]</td>");
            echo("<td style='border-right: 1px solid #777777;'>$empresa[telefone]</td>");
            echo("<td style='border-right: 1px solid #777777;'>$empresa[logradouro]</td>");
            echo("<td style='border-right: 1px solid #777777;'>$empresa[numero]</td>");
            echo("<td style='border-right: 1px solid #777777;'><a href='Empresa.php?codempresa=$empresa[codempresa]'><img src='../recursos/imagens/editar.gif'/ alt='Editar'></a></td>");
            echo("<td><a href='../../../controlador/ControleEmpresa.php?codempresa=$empresa[codempresa]' class='btexcluir'>X</a></td>");
            echo("</tr>");
        }
?>
        </tbody>
    </table>            
<?php
    }
?>