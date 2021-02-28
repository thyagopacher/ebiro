<?php

/**
* Executa calculo do frete usando webservice dos correios.
* @copyright  Phaneronsoft
* @author Marcelo Korjenioski - faleconosco@phaneronsoft.com
* @see http://www.phaneronsoft.com
* @filesource correios.php
* @version 1.1
*/

#####################################
# Código dos Servi�os dos Correios  #
#    FRETE PAC = 41106       #
#    FRETE SEDEX = 40010       #
#    FRETE SEDEX 10 = 40215       #
#    FRETE SEDEX HOJE = 40290    #
#    FRETE E-SEDEX = 81019       #
#    FRETE MALOTE = 44105       #
#    FRETE NORMAL = 41017       #
#   SEDEX A COBRAR = 40045       #
#####################################

// Definindo constantes

// Peso total do pacote em Quilos, caso seja menos de 1Kg, ex.: 300g, coloque 0.300
if(isset($_REQUEST["peso"])){
    $peso1      = str_replace(".", "", $_REQUEST["peso"]);
    $peso       = str_replace(",", ".", $peso1);          
}else{
    $peso = (double)0;
}
if(isset($_REQUEST["comprimento"])){
    $comprimento1      = str_replace(".", "", $_REQUEST["comprimento"]);
    $comprimento       = str_replace(",", ".", $comprimento1);  
}else{
    $comprimento = (double)0;
}
if(isset($_REQUEST["altura"])){
    $altura1      = str_replace(".", "", $_REQUEST["altura"]);
    $altura       = str_replace(",", ".", $altura1);  
}else{
    $altura = (double)0;
}
if(isset($_REQUEST["largura"])){
    $largura1      = str_replace(".", "", $_REQUEST["largura"]);
    $largura       = str_replace(",", ".", $largura1);  
}else{
    $largura = (double)0;
}
define('EMBALAGEM',0.00);

if($_POST) {
    if (isset($_POST['servico'])) {
        $cod_servico = $_POST['servico'];
    }
    // CEP de Origem, em geral o CEP da Loja
    $cep_origem = $dados_empresa["cep"];
    // CEP de Destino, voc� pode passar esse CEP por GET ou POST vindo de um formul�rio
    $cep_destino = eregi_replace("([^0-9])","",$_POST['cep-destino']);

    // URL de Consulta dos Correios
    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?StrRetorno=xml&nCdEmpresa=&sDsSenha=&nCdServico=$cod_servico&nVlPeso=$peso&sCepOrigem=$cep_origem&sCepDestino=$cep_destino&nCdFormato=1&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura";
    echo("<a href='$correios'>URL para consulta</a><br>");
    // Capta as informa��es da p�gina dos Correios
    $correios_info = file($correios);
    // Processa as informa��es vindas do site dos correios em um Array
    foreach($correios_info as $info) {
        // Busca a informa��o do Pre�o da Postagem
        if(preg_match("/\<Valor>(.*)\<\/Valor>/",$info,$tarifa)) {
            $total = $tarifa[1] + EMBALAGEM;
        }
        if(preg_match("/\<PrazoEntrega>(.*)\<\/PrazoEntrega>/",$info,$PrazoEntrega)) {
            $PrazoEntrega = $PrazoEntrega[1];
        }
        if(preg_match("/\<MsgErro>(.*)\<\/MsgErro>/",$info,$MsgErro)) {
            $msgerro = utf8_encode($MsgErro[1]);
        }        
    }
    // Neste exemplo estou colocando apenas PAC e SEDEX
    switch ($cod_servico) {
    case 41106:
        $nome_servico = " PAC ";
        break;
    case 40010:
        $nome_servico = " SEDEX ";
        break;
    case 40215:
        $nome_servico = " SEDEX 10";
        break;        
    case 40290:
        $nome_servico = " SEDEX HOJE";
        break;     
    case 44105:
        $nome_servico = " MALOTE ";
        break;      
}

// Caso venha valor de resposta � numerio e maior que o custo da embalagem sen�o ocorreu algum erro na solicita��o.
if(is_numeric($total) and ($total > $embalagem)) {
// Quando encontra o valor da postagem, exibe na p�gina formatando em padr�o de moeda 10,89
// Caso voc� n�o queira formatar basta comentar a linha abaixo que ser� exibido assim 10.89 e basta executar o comando abaixo
    $total = number_format($total,2,',','.');
    echo $nome_servico . $total . ' prazo entrega de ' . $PrazoEntrega . ' dia(s) ';
} else {
    echo "<br>Erro ao consultar causado por: $msgerro";
}
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php 
    $painel = TRUE;
    include("../includes/head.php");
    ?>
    <link href="../recursos/css/tema1/geral.css" type="text/css" rel="stylesheet" />
    <link href="../recursos/css/tema1/painel.css" type="text/css" rel="stylesheet" />    
    <title>Sistema para Calcular Frete SEDEX e PAC a partir de CEP informado</title>
</head>
<body>
        <?php 
        include("includes/topo.php");
        include("includes/menuLateral.php");
        ?>
        <div id="conteudo">
<h3>
<span>Pesquisa valor de frete</span>

</h3>
<form id="form-pesquisa-repasse" action="" method="post" onsubmit="submitForm(this); return false;">
    <fieldset>
    <legend>Filtrar Referência</legend>
        <p>
            <label>Peso:</label>
            <input required type="text" name="peso"/>
        </p>
        <p>
            <label>Altura:</label>
            <input required type="text" name="altura"/>
        </p>
        <p>
            <label>Comprimento:(maior que 16cm)</label>
            <input required type="text" name="comprimento"/>
        </p>
        <p>
            <label>Largura:(maior que 11cm)</label>
            <input required type="text" name="largura"/>
        </p>
        <p>
            <label>Envio</label>
            <select id="servico" name="servico" title="Serviços dos Correios">
                <option value="41106">PAC</option>
                <option value="40010">SEDEX</option>
                <option value="40215" title="Diversos trechos inativos">SEDEX 10</option>
                <option value="40290">SEDEX HOJE</option>
                <option value="44105">MALOTE</option>
            </select>
        </p>
        <p>
            <label>CEP Origem:</label>
            <input name="cep-origem" disabled title="CEP da empresa responsável pelo site" value="<?=$empresa["cep"]?>"/>
        </p>    
        <p>
            <label>CEP Destino</label>
            <input id="cep-destino" type="text" value="" maxlength="8"  title="CEP destino" name="cep-destino"/>
        </p>
        <p>
            <input type="submit" id="pesquisar" name="pesquisar" value="Pesquisar" />
        </p>
    </fieldset>
</form>
<span>* Digitar somente nómero no CEP</span>

<span id="value"></span>

        <script src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.0.3/prototype.js" type="text/javascript"></script>
        <script type="text/javascript">
        function submitForm(form) {
        /*
        usa m�todo request() da classe Form da prototype, que serializa os campos
        do formul�rio e submete (por POST como default) para a action especificada no form
        */
            form.request({
                onComplete: function(transport){
                /*
                se o retorno for diferente de -1, entende-se que n�o houve problemas, ent�o apaga-se
                os campos do formul�rio usando o m�todo reset() da classe Form
                */

                if(transport.responseText !=-1)  {
                    $('value').innerHTML = transport.responseText;
                } else {
                    form.reset();
                    $('value').innerHTML = 'Erro ao consultar';
                }
                }
            });
        return false;
        }

        </script>
    </div>
</body>
</html>
<?php
} // fim else

?>