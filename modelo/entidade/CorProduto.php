<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editorproduto.
 */

/**
 * Description of Corproduto
 *
 * @authorproduto ebiro_2
 */
class Corproduto {
    
    private $codcorproduto;
    private $codproduto;
    private $codcor;
    
    public function getCodcorproduto(){return $this->codcorproduto;}
    public function setCodcorproduto($codcorproduto){$this->codcorproduto = $codcorproduto;}       
    public function getCodproduto(){return $this->codproduto;}
    public function setCodproduto($codproduto){$this->codproduto = $codproduto;}      
    public function getCodcor(){return $this->codcor;}
    public function setCodcor($codcor){$this->codcor = $codcor;}     
 
}

?>
