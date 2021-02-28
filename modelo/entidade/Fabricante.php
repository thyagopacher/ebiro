<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fabricante
 *
 * @author ebiro_2
 */
class Fabricante {
    
    private $codfabricante;
    private $nome;
    private $logo;
    
    public function getCodfabricante(){return $this->codfabricante;}
    public function setCodfabricante($codfabricante){$this->codfabricante = $codfabricante;}       
    public function getLogo(){return $this->logo;}
    public function setLogo($logo){$this->logo = $logo;}      
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}     
 
}

?>
