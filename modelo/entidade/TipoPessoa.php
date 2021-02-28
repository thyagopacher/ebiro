<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoPessoa
 *
 * @author ebiro_2
 */
class TipoPessoa {
    
    private $codtipo;
    private $nome;
    
    public function getCodtipo(){return $this->codtipo;}
    public function setCodtipo($codtipo){$this->codtipo = $codtipo;}         
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}     
 
}

?>
