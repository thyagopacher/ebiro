<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cargo
 *
 * @author ebiro_2
 */
class Cargo {
    
    private $codcargo;
    private $nome;
    private $salario;
    
    public function getCodcargo(){return $this->codcargo;}
    public function setCodcargo($codcargo){$this->codcargo = $codcargo;}       
    public function getSalario(){return $this->salario;}
    public function setSalario($salario){$this->salario = $salario;}      
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}     
 
}

?>
