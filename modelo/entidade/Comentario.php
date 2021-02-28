<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comprar
 *
 * @author ebiro_2
 */
class Comentario {
    
    private $codcomentario;
    private $nome;
    private $email;
    private $texto;
    private $status;
    private $codproduto;
    
    public function getCodcomentario(){
        return $this->codcomentario;
    }
    
    public function setCodcomentario($codcomentario){
	$this->codcomentario = $codcomentario;                
    }    
    
    public function getNome(){
        return $this->nome;
    }
    
    public function setNome($nome){
	$this->nome = $nome;                
    }    

    public function getEmail(){
        return $this->email;
    }
    
    public function setEmail($email){
	$this->email = $email;                
    }   

    public function getTexto(){
        return $this->texto;
    }
    
    public function setTexto($texto){
	$this->texto = $texto;                
    }      
    
    public function getStatus(){
        return $this->status;
    }
    
    public function setStatus($status){
	$this->status = $status;                
    }   
    
    public function getCodproduto(){
        return $this->codproduto;
    }
    
    public function setCodproduto($codproduto){
	$this->codproduto = $codproduto;                
    }      
}

?>
