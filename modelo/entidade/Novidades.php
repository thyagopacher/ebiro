<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Novidades
 *
 * @author ebiro_2
 */
class Novidades {
    private $codnovidades;
    private $nome;
    private $email;

    public function getCodnovidades(){return $this->codnovidades;}
    public function setCodnovidades($codnovidades){$this->codnovidades = $codnovidades;}  
    public function getNome(){return $this->nome;}
    public function setNome($nome){$this->nome = $nome;}  
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email = $email;}     

}

?>
