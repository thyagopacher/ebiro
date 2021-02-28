/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function Orcamento(codproduto){
    var campo = '';
    if(document.getElementById("res").innerHTML === ""){
        campo += "<form action='../controlador/EnviaOrcamento.php' class='orcamento' name='enviaOrcamento' method='post'>";
        campo += "<fieldset>";
        campo +=        "<legend>Pedido de orçamento</legend>";
        campo +=        "<input type='hidden' name='codproduto' value='" + codproduto + "'/>";
        campo +=        "<p>";
        campo +=            "<label>Nome:</label>";
        campo +=            "<input required type='text' title='Minimo 3 letras'  name='nome' pattern='[A-Za-z]{3}' size='30' maxlength='50'/>";
        campo +=        "</p>";
        campo +=        "<p>";
        campo +=            "<label>E-mail:</label>";
        campo +=            "<input required type='email' name='email' size='30' maxlength='50'/>";
        campo +=        "</p>";   
        campo +=        "<p>";
        campo +=            "<input type='submit' name='submit' value='Enviar'/>";
        campo +=        "</p>";
        campo +=    "</fieldset>";
        campo += "</form>";
    }
    document.getElementById('res').innerHTML = campo;
}
