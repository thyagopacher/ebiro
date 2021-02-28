<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Banco
 *
 * @author ebiro_2
 */
class Banco {
    
    private $codbanco;
    private $linksite;
    private $logo;
    private $nome;
    private $txboleto;
    private $txconta;
    
    public function getCodbanco(){return $this->codbanco;}
    public function setCodbanco($codbanco){$this->codbanco = $codbanco;}       
    public function getLogo(){return $this->logo;}
    public function setLogo($logo){$this->logo = $logo;}      
    public function getLinksite(){return $this->linksite;}
    public function setLinksite($linksite){$this->linksite = $linksite;}     
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}
    public function getTxboleto(){return $this->txboleto;}
    public function setTxboleto($txboleto){$this->txboleto = $txboleto;}   
    public function getTxconta(){return $this->txconta;}
    public function setTxconta($txconta){$this->txconta = $txconta;}       
}

?>
