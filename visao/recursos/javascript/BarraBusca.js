/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function MudaCor(){
    if(document.body.scrollTop > 0){
        document.getElementById("barraBusca").style.background = "#00abf1";// barra vai para azul
    }else{
        document.getElementById("barraBusca").style.background = "white";
    }
}