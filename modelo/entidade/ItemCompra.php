<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemCompra
 *
 * @author ebiro_2
 */
class ItemCompra {
    
    private $coditemcompra;
    private $codproduto;
    private $codcompra;
    
    public function getCoditemcompra(){
        return $this->coditemcompra;
    }
    
    public function setCoditemcompra($coditemcompra){
	$this->coditemcompra = $coditemcompra;                
    }    
    
    public function getCodproduto(){
        return $this->codproduto;
    }
    
    public function setCodproduto($codproduto){
	$this->codproduto = $codproduto;                
    }    

    public function getCodcompra(){
        return $this->codcompra;
    }
    
    public function setCodcompra($codcompra){
	$this->codcompra = $codcompra;                
    }   
    
}

?>
