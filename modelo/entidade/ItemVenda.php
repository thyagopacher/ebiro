<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemVenda
 *
 * @author ebiro_2
 */
class ItemVenda {
    
    private $coditemvenda;
    private $codproduto;
    private $codvenda;
    
    public function getCoditemvenda(){
        return $this->coditemvenda;
    }
    
    public function setCoditemvenda($coditemvenda){
	$this->coditemvenda = $coditemvenda;                
    }    
    
    public function getCodproduto(){
        return $this->codproduto;
    }
    
    public function setCodproduto($codproduto){
	$this->codproduto = $codproduto;                
    }    

    public function getCodvenda(){
        return $this->codvenda;
    }
    
    public function setCodvenda($codvenda){
	$this->codvenda = $codvenda;                
    }   
    
}

?>
