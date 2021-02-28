/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function Tipo(tipo){
    var campo = "Nada escolhido";
    if(tipo === "Juridico"){
        campo = "<label>CNPJ:</label><input type='text' size='20' maxlength='14' onblur='return ValidarCNPJ(this)' name='cnpj' value=''/>"
    }
    if(tipo === "Fisico"){
        campo = "<label>CPF:</label><input type='text' onkeypress='return mascaraInteiro(event);' size='20' maxlength='11'  name='cpf' value=''/>"
    }
    document.getElementById("res").innerHTML = campo;
}

