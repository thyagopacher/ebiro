<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cor
 *
 * @author ebiro_2
 */
class Cor {
    
    private $codcor;
    private $nome;
    private $valor;
    
    public function getCodcor(){return $this->codcor;}
    public function setCodcor($codcor){$this->codcor = $codcor;}       
    public function getValor(){return $this->valor;}
    public function setValor($valor){$this->valor = $valor;}      
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}     
 
}

?>
