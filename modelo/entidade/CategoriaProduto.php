<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoriaProduto
 *
 * @author ebiro_2
 */
class CategoriaProduto {
    
    private $codcategoria;
    private $nome;
    private $codmestre;
    
    public function getCodcategoria(){
        return $this->codcategoria;
    }
    
    public function setCodcategoria($codcategoria){
	$this->codcategoria = $codcategoria;                
    }    
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
	$this->nome = $nome;                
    }    

    public function getCodmestre(){
        return $this->codmestre;
    }
    
    public function setCodmestre($codmestre){
	$this->codmestre = $codmestre;                
    }        
}

?>
