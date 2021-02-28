<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Venda
 *
 * @author ebiro_2
 */
class Venda {
    
    private $codvenda;
    private $codcliente;
    private $data;
    
    public function getCodvenda(){
        return $this->codvenda;
    }
    
    public function setCodvenda($codvenda){
	$this->codvenda = $codvenda;                
    }    
    
    public function getcodcliente(){
        return $this->codcliente;
    }
    
    public function setcodcliente($codcliente){
	$this->codcliente = $codcliente;                
    }    

    public function getData(){
        return $this->data;
    }
    
    public function setData($data){
	$this->data = $data;                
    }   
    
}

?>
