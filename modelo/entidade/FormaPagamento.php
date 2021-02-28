<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormaPagamento
 *
 * @author ebiro_2
 */
class FormaPagamento {
    
    private $codforma;
    private $logo;
    private $nome;
    private $status;
    
    public function getCodforma(){return $this->codforma;}
    public function setCodforma($codforma){$this->codforma = $codforma;}       
    public function getLogo(){return $this->logo;}
    public function setLogo($logo){$this->logo = $logo;}          
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}
    public function getStatus(){return $this->status;}
    public function setStatus($status){$this->status = $status;}
}

?>
