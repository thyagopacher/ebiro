<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresa
 *
 * @author ebiro_2
 */
class Empresa {
    private $codempresa;
    private $razaosocial;
    private $fantasia;
    private $cnpj;
    private $cep;
    private $tipologradouro;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $telefone;
    private $celular;
    private $fax;
    private $email;
    private $logo;
    private $codbanco;
    private $agencia;
    private $conta;
    private $digitov;
    public function getCodbanco(){return $this->codbanco;}
    public function setCodbanco($codbanco){$this->codbanco = $codbanco;}     
    public function getAgencia(){return $this->agencia;}
    public function setAgencia($agencia){$this->agencia = $agencia;}     
    public function getConta(){return $this->conta;}
    public function setConta($conta){$this->conta = $conta;}      
    public function getCodempresa(){return $this->codempresa;}
    public function setCodempresa($codempresa){$this->codempresa = $codempresa;}  
    public function getCep(){return $this->cep;}
    public function setCep($cep){$this->cep = $cep;}  
    public function getFantasia(){return $this->fantasia;}
    public function setFantasia($fantasia){$this->fantasia = $fantasia;}     
    public function getCnpj(){return $this->cnpj;}
    public function setCnpj($cnpj){$this->cnpj = $cnpj;}       
    public function getLogo(){return $this->logo;}
    public function setLogo($logo){$this->logo = $logo;}      
    public function getRazaosocial(){return $this->razaosocial;}
    public function setRazaosocial($razaosocial){$this->razaosocial = $razaosocial;}    
    public function getDigitov(){return $this->digitov;}
    public function setDigitov($digitov){$this->digitov = $digitov;}   
    
    public function getTipologradouro(){ return $this->tipologradouro;}
    public function setTipologradouro($tipologradouro){$this->tipologradouro = $tipologradouro;}   
    public function getLogradouro(){
        return $this->logradouro;
    }
    public function setLogradouro($logradouro){
	$this->logradouro = $logradouro;                
    }    
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero($numero){
	$this->numero = $numero;                
    }      
    public function getBairro(){
        return $this->bairro;
    }    
    public function setBairro($bairro){
	$this->bairro = $bairro;                
    }    
    public function getCidade(){
        return $this->cidade;
    }    
    public function setCidade($cidade){
	$this->cidade = $cidade;                
    }        
    public function getEstado(){
        return $this->estado;
    }    
    public function setEstado($estado){
	$this->estado = $estado;                
    }   
    public function getTelefone(){
        return $this->telefone;
    }    
    public function setTelefone($telefone){
	$this->telefone = $telefone;                
    }       
    public function getCelular(){
        return $this->celular;
    }    
    public function setCelular($celular){
	$this->celular = $celular;                
    }  
    public function getFax(){
        return $this->fax;
    }    
    public function setFax($fax){
	$this->fax = $fax;                
    }
    public function getEmail(){
        return $this->email;
    }    
    public function setEmail($email){$this->email = $email;}      
}

?>
