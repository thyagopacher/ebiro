<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comprar
 *
 * @author ebiro_2
 */
class Compra {
    
    private $codcompra;
    private $codfuncionario;
    private $data;
    
    public function getCodcompra(){
        return $this->codcompra;
    }
    
    public function setCodcompra($codcompra){
	$this->codcompra = $codcompra;                
    }    
    
    public function getCodfuncionario(){
        return $this->codfuncionario;
    }
    
    public function setCodfuncionario($codfuncionario){
	$this->codfuncionario = $codfuncionario;                
    }    

    public function getData(){
        return $this->data;
    }
    
    public function setData($data){
	$this->data = $data;                
    }   
    
}

?>
