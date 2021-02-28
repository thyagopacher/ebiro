<?php
    if(isset($painel) && $painel === TRUE){
        $antes = "../../";
    }else{
        if(isset($painel) && $painel === "INDEX"){
            $antes = "";
        }else{
            $antes = "../";
        }
    }
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
        $comprimento = (double)16;
    }
    if(isset($_REQUEST["altura"])){
        $altura1      = str_replace(".", "", $_REQUEST["altura"]);
        $altura       = str_replace(",", ".", $altura1);  
    }else{
        $altura = (double)2;
    }
    if(isset($_REQUEST["largura"])){
        $largura1      = str_replace(".", "", $_REQUEST["largura"]);
        $largura       = str_replace(",", ".", $largura1);  
    }else{
        $largura = (double)11;
    }
    define('EMBALAGEM',0.00);

    if (isset($_POST['servico'])) {
        $cod_servico = $_POST['servico'];
    }else{
        $cod_servico = "41106";
    }
    require_once($antes."modelo/ModelEmpresa.php");
    $modelo  = new ModelEmpresa();
    $empresa = mysql_fetch_array($modelo->procurar("select * from empresa where codempresa = '1'"));
    // CEP de Origem, em geral o CEP da Loja
    $cep_origem = $empresa["cep"];
    // CEP de Destino, voc� pode passar esse CEP por GET ou POST vindo de um formul�rio
    $cep_destino = $_REQUEST['cep'];
    // URL de Consulta dos Correios
    $correios = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?StrRetorno=xml&nCdEmpresa=&sDsSenha=&nCdServico=$cod_servico&nVlPeso=$peso&sCepOrigem=$cep_origem&sCepDestino=$cep_destino&nCdFormato=1&nVlComprimento=$comprimento&nVlAltura=$altura&nVlLargura=$largura";
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
        $total = "R$ ". number_format($total,2,',','.');
        echo $nome_servico . $total . ' prazo entrega de ' . $PrazoEntrega . ' dia(s) ';
    } else {
        echo "<br>Erro ao consultar causado por: $msgerro";
    }
