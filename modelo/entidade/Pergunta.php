<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pergunta
 *
 * @author ebiro_2
 */
class Pergunta {
    
    private $codpergunta;
    private $pergunta;
    private $resposta;
    private $codcategoria;
    
    public function getCodpergunta(){
        return $this->codpergunta;
    }
    public function setCodpergunta($codpergunta){
	$this->codpergunta = $codpergunta;                
    }    
    public function getPergunta(){
        return $this->pergunta;
    }
    public function setPergunta($pergunta){
	$this->pergunta = $pergunta;                
    }    
    public function getResposta(){
        return $this->resposta;
    }
    public function setResposta($resposta){
	$this->resposta = $resposta;                
    }   
    public function getCodcategoria(){
        return $this->codcategoria;
    }
    public function setCodcategoria($codcategoria){
	$this->codcategoria = $codcategoria;                
    }   
}

?>
