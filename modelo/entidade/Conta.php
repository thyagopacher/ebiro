<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conta
 *
 * @author ebiro_2
 */
class Conta {
    
    private $codconta;
    private $nome;
    private $valor;
    private $situacao;
    private $parcela;
    private $periodo;
    private $vencimento;
    public function getCodconta(){return $this->codconta;}
    public function setCodconta($codconta){$this->codconta = $codconta;}       
    public function getValor(){return $this->valor;}
    public function setValor($valor){$this->valor = $valor;}      
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}     
    public function getSituacao(){return $this->situacao;}
    public function setSituacao($situacao){$this->situacao = $situacao;}   
    public function getParcela(){return $this->parcela;}
    public function setParcela($parcela){$this->parcela = $parcela;}      
    public function getPeriodo(){return $this->periodo;}
    public function setPeriodo($periodo){$this->periodo = $periodo;}  
    public function getVencimento(){return $this->vencimento;}
    public function setVencimento($vencimento){$this->vencimento = $vencimento;}           
}

?>
