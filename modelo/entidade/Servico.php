<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Servico
 *
 * @author ebiro_2
 */
class Servico {
    
    private $codservico;
    private $nome;
    private $valor;
    
    public function getCodservico(){
        return $this->codservico;
    }
    public function setCodservico($codservico){
	$this->codservico = $codservico;                
    }    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
	$this->nome = $nome;                
    }
    public function getValor(){
        return $this->valor;
    }
    public function setValor($valor){
	$this->valor = $valor;                
    }       
}

?>
