<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pessoa
 *
 * @author ebiro_2
 */
class Pessoa {
    private $codpessoa;
    private $nome;
    private $cpf;
    private $cnpj;
    private $cep;
    private $tipologradouro;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $login;
    private $senha;
    private $telefone;
    private $celular;
    private $email;
    private $codtipo;
    private $codcargo;
    
    public function getCodpessoa(){
        return $this->codpessoa;
    }
    public function setCodpessoa($codpessoa){
	$this->codpessoa = $codpessoa;                
    }    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
	$this->nome = $nome;                
    }    
    public function getCpf(){return $this->cpf;}
    public function setCpf($cpf){$this->cpf = $cpf;}      
    public function setCnpj($cnpj){
	$this->cpf = $cnpj;                
    }   
    public function getCnpj(){
        return $this->cnpj;
    }
    public function getCep(){
        return $this->cep;
    }
    public function setCep($cep){
	$this->cep = $cep;                
    }  
    public function getTipologradouro(){
        return $this->tipologradouro;
    }
    public function setTipologradouro($tipologradouro){
	$this->tipologradouro = $tipologradouro;                
    }   
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
    
    public function getLogin(){
        return $this->login;
    }    
    
    public function setLogin($login){
	$this->login = $login;                
    }     
    
    public function getSenha(){
        return $this->senha;
    }    
    
    public function setSenha($senha){
	$this->senha = $senha;                
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
    
    public function getEmail(){
        return $this->email;
    }    
    
    public function setEmail($email){
	$this->email = $email;                
    }      
    
    public function getCodtipo(){
        return $this->codtipo;
    }    
    
    public function setCodtipo($codtipo){
	$this->codtipo = $codtipo;                
    }     
    
    public function getCodcargo(){
        return $this->codcargo;
    }    
    
    public function setCodcargo($codcargo){
	$this->codcargo = $codcargo;                
    }     
}

?>
