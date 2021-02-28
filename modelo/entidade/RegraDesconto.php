<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegraDesconto
 *
 * @author ebiro_2
 */
class RegraDesconto {
    private $codregra;
    private $nome;
    private $tipovalor;
    private $valor;
    private $qtdmin;
    private $qtdmax;

    public function getCodregra(){return $this->codregra;}
    public function setCodregra($codregra){$this->codregra = $codregra;}  
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}  
    public function getTipovalor(){return $this->tipovalor;}
    public function setTipovalor($tipovalor){$this->tipovalor = $tipovalor;}     
    public function getValor(){return $this->valor;}
    public function setValor($valor){$this->valor = $valor;}       
    public function getQtdmin(){return $this->qtdmin;}
    public function setQtdmin($qtdmin){$this->qtdmin = $qtdmin;}      
    public function getQtdmax(){return $this->qtdmax;}
    public function setQtdmax($qtdmax){$this->qtdmax = $qtdmax;}     

}

?>
