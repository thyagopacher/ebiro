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
    require_once($antes."controlador/ProcurarEmpresa.php");
    $empresa      = mysql_fetch_array($retorno);
    if(isset($codcliente) && $codcliente !== NULL && $codcliente !== ""){
        $_REQUEST["codpessoa"] = $codcliente;
        $_REQUEST["submit"]    = "Procurar";
        require_once($antes."controlador/ControlePessoa.php");
        $cliente = mysql_fetch_array($retorno);
    }else{
        $cliente = NULL;
    }
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Itaú: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//

// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = 2.95;
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "2950,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = '12345678';  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto["numero_documento"] = '0123';	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"]    = "$cliente[nome]";
$dadosboleto["endereco1"] = "$cliente[tipologradouro]: $cliente[logradouro], $cliente[numero] - $cliente[bairro]";
$dadosboleto["endereco2"] = "$cliente[cidade] - $cliente[estado] -  CEP: $cliente[cep]";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja ".$empresa["fantasia"];
$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["instrucoes1"]    = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"]    = "- Receber até 10 dias após o vencimento";
$dadosboleto["instrucoes3"]    = "- Em caso de dúvidas entre em contato conosco: ".$empresa["email"];

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "$empresa[agencia]"; // Num da agencia, sem digito
$dadosboleto["conta"] = "$empresa[conta]";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "$empresa[digitov]"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"]   = "Pagamento do site". $_SERVER['SERVER_NAME'];
$dadosboleto["cpf_cnpj"]        = $empresa["cnpj"];
$dadosboleto["endereco"]        = $empresa["tipologradouro"] . " " . $empresa["logradouro"] . " - " . $empresa["numero"] . "," . $empresa["bairro"];
$dadosboleto["cidade_uf"]       = $empresa["cidade"] . " - " . $empresa["estado"];
$dadosboleto["cedente"]         = $empresa["razaosocial"];

// NÃO ALTERAR!
include("includes/funcoes_itau.php"); 
include("includes/layout_itau.php");
?>
