<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author ebiro_2
 */
class Plano {
    
    private $codplano;
    private $descricao;
    private $valorMensal;
    private $valorSemestral;
    private $valorTrimenstral;
    private $valorAnual;
    private $codcategoria;
    public function getCodplano(){
        return $this->codplano;
    }
    public function setCodplano($codplano){
	$this->codplano = $codplano;                
    }    
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
	$this->descricao = $descricao;                
    }   
    public function getValorMensal(){
            return $this->valorMensal;
    }
    public function setValorMensal($valorMensal){
            $this->valorMensal = $valorMensal;
    }
    public function getValorSemestral(){
            return $this->valorSemestral;
    }
    public function setValorSemestral($valorSemestral){
            $this->valorSemestral = $valorSemestral;
    }
    public function getValorTrimenstral(){
            return $this->valorTrimenstral;
    }
    public function setValorTrimenstral($valorTrimenstral){
            $this->valorTrimenstral = $valorTrimenstral;
    }
    public function getValorAnual(){
            return $this->valorAnual;
    }
    public function setValorAnual($valorAnual){
            $this->valorAnual = $valorAnual;
    }
    public function getCodcategoria(){
            return $this->codcategoria;
    }
    public function setCodcategoria($codcategoria){
            $this->codcategoria = $codcategoria;
    }    
}

?>
