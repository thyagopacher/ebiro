/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function procuraFrete(){
    var cep        = document.getElementById("cep").value;
    if(cep === "" || cep === null){
        alert("Não pode pesquisar frete sem CEP!");
    }else{
        var codproduto = document.getElementById("codproduto").value;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200){
            document.getElementById("resultado_frete").innerHTML=xmlhttp.responseText;
          }
        };
        var url = "../controlador/ProcurarFrete.php?cep=" + cep + "&codproduto=" + codproduto;
        xmlhttp.open("GET", url,true);
        xmlhttp.send();
    }
}

