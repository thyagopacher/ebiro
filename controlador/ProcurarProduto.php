<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    if(isset($_REQUEST["procurar"])){
        include("../modelo/ModelProduto.php");
        $filtro = $_REQUEST["procurar"];
        $query  = "select p.*,"
                . "(select p.valor*(lucro/100) from configuracao) as lucrofinal,"
                . "(p.valor * (p.desconto/100)) as descontofinal"
                . " from produto p "
                . " where p.nome like '%$filtro%' or "
                . " p.descricao like '%$filtro%' order by p.nome";
        $modelo                 = new ModelProduto();
        $retornoproduto         = $modelo->procurar($query);
        
        if(mysql_num_rows($retornoproduto) > 0){
         ?>
         <table>
            <thead>
                <tr>
                    <th style='border-right: 1px solid #777777;'>Código</th>
                    <th style='border-right: 1px solid #777777;'>Nome</th>
                    <th style='border-right: 1px solid #777777;'>Valor</th>
                    <th style='border-right: 1px solid #777777;'>Desconto</th>
                    <th style='border-right: 1px solid #777777;'>Lucro</th>
                    <th style='border-right: 1px solid #777777;'>Final</th>
                    <th style='border-right: 1px solid #777777;'>Vitrine</th>
                    <th style='border-right: 1px solid #777777;'>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
        <?php       
            $total = 0.0;
            $lucro = 0.0;
            $cor1  = "#E8E8E6";
            $cor2  = "white";
            while($produto = mysql_fetch_array($retornoproduto)){
                if($cor === $cor1){
                    $cor = $cor2;
                }else{
                    $cor = $cor1;
                }                
                $final = $produto['valor'] - $produto["descontofinal"] + $produto["lucrofinal"];
                $total = $produto["valor"] + $total;
                $lucro = $produto["lucrofinal"] + $lucro;
                if(strlen($produto["nome"]) > 25){
                    $produto["nome"] = substr(($produto["nome"]), 0, 25) . '...';
                }
                echo("<tr style='background: $cor'>");
                echo("<td style='border-right: 1px solid #777777;'>".($produto['codproduto'])."</td>");
                echo("<td style='border-right: 1px solid #777777;'><a href='Produto.php?codproduto=$produto[codproduto]' title='Clique para editar o produto'>".$produto["nome"] . "</a></td>");
                echo("<td style='border-right: 1px solid #777777;'>".number_format($produto['valor'], 2, ',', '.')."</td>");
                echo("<td style='border-right: 1px solid #777777;'>".number_format($produto["descontofinal"], 2, ',', '.')."</td>");
                echo("<td style='border-right: 1px solid #777777;'>".number_format($produto["lucrofinal"], 2, ',', '.')."</td>");
                if($final > $produto["valor"]){
                    echo("<td style='border-right: 1px solid #777777;'>".number_format($final, 2, ',', '.')."</td>");
                }else{
                    echo("<td style='border-right: 1px solid #777777;' title='Reveja o preço, está perdendo dinheiro!'>".number_format($final, 2, ',', '.')."</td>");
                }
                if(isset($produto["vitrine"]) && $produto["vitrine"] !== NULL && $produto["vitrine"] !== ""){
                    echo("<td style='border-right: 1px solid #777777;'>$produto[vitrine]</td>");
                }else{
                    echo("<td style='border-right: 1px solid #777777;'>NÃO</td>");
                }
                echo("<td style='border-right: 1px solid #777777;'>");
                echo("<a href='Produto.php?codproduto=$produto[codproduto]' title='Clique para editar o produto'><img src='../recursos/imagens/editar.gif'/></a>");
                echo("</td>");
                echo("<td><a class='btexcluir' href='../../controlador/ControleProduto.php?submit=Excluir&codproduto=$produto[codproduto]'>X</a></td>");
                echo("</tr>");
            }
             ?>
                <tfoot>
                    <tr>
                        <td style='border-right: 1px solid #777777;' title="Total em produtos">Total:</td>
                        <td style='border-right: 1px solid #777777;'><?=number_format($total, 2, ',', '.')?></td>
                    </tr>
                    <tr>
                        <td style='border-right: 1px solid #777777;' title="Total de lucro dos produtos">Lucro:</td>
                        <td style='border-right: 1px solid #777777;'><?=number_format($lucro, 2, ',', '.')?></td>
                    </tr>                    
                </tfoot>                  
            </tbody>
        </table>
<?php           
        }else{
            echo("Nada encontrado");
        }
    }
?>
