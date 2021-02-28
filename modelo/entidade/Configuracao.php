<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configuracao
 *
 * @author ebiro_2
 */
class Configuracao {
    
    private $codconfiguracao;
    private $quemsomos;
    private $descricao;
    private $palavrachave;
    private $codempresa;
    private $emailpagseguro;
    private $cortopo;
    private $corrodape;
    private $corbody;
    private $lucro;
    private $fretecorreio;
    private $parcelasjuro;
    public function getCodconfiguracao(){return $this->codconfiguracao;}
    public function setCodconfiguracao($codconfiguracao){$this->codconfiguracao = $codconfiguracao;}       
    public function getQuemsomos(){return $this->quemsomos;}
    public function setQuemsomos($quemsomos){$this->quemsomos = $quemsomos;}          
    public function getDescricao(){return $this->descricao;}
    public function setDescricao($descricao){$this->descricao = $descricao;}
    public function getPalavrachave(){return $this->palavrachave;}
    public function setPalavrachave($palavrachave){$this->palavrachave = $palavrachave;}
    public function getCodempresa(){return $this->codempresa;}
    public function setCodempresa($codempresa){$this->codempresa = $codempresa;}  
    public function getEmailpagseguro(){return $this->emailpagseguro;}
    public function setEmailpagseguro($emailpagseguro){$this->emailpagseguro = $emailpagseguro;}     
    public function getCortopo(){return $this->cortopo;}
    public function setCortopo($cortopo){$this->cortopo = $cortopo;}      
    public function getCorrodape(){return $this->corrodape;}
    public function setCorrodape($corrodape){$this->corrodape = $corrodape;} 
    public function getCorbody(){return $this->corbody;}
    public function setCorbody($corbody){$this->corbody = $corbody;}       
    public function getLucro(){return $this->lucro;}
    public function setLucro($lucro){$this->lucro = $lucro;}       
    public function getFretecorreio(){return $this->fretecorreio;}
    public function setFretecorreio($fretecorreio){$this->fretecorreio = $fretecorreio;}          
    public function getParcelasjuro(){return $this->parcelasjuro;}
    public function setParcelasjuro($parcelasjuro){$this->parcelasjuro = $parcelasjuro;}        
}

?>
