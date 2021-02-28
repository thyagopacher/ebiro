/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    function abreInput(){
        var indice = document.getElementById("indice").innerHTML;
        if(parseInt(indice) < 8){
            var segund = parseInt(indice) + 1;
            document.getElementById("indice").innerHTML = segund;
            if(indice === "0"){
                    indice = "1";
            }						
            var campo  = "<p><label>Imagem " + segund +"</label><input type='file' name='imagem" + segund +"'/></p>"
            document.getElementById("res").innerHTML += campo;
        }else{
            alert("Só pode abrir 8 imagens!");
        }
    }	

