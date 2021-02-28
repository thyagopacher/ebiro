<?php 
if(isset($produto["codproduto"])){
?>
    <a href="javascript: Orcamento('<?=$produto["codproduto"]?>')" class="botao">Abre orçamento</a>
    <div id="res"></div>
<?php 
}else{
    echo("Sem código produto não pode enviar orçamento");
}
?>