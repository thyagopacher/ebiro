<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelPessoa
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Pessoa.php");

class ModelPessoa {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Pessoa $pessoa){
        $this->conectar();
        $query = "insert into pessoa (nome, cpf, cnpj, cep, tipologradouro,"
                . " logradouro, numero, bairro, cidade, estado, telefone, email, celular, login, senha, codcargo,codtipo)"
                . " values('".$pessoa->getNome()."', '".$pessoa->getCpf()."','".$pessoa->getCnpj()."',"
                . " '".$pessoa->getCep()."','".$pessoa->getTipologradouro()."','".$pessoa->getLogradouro()."',"
                . " '".$pessoa->getNumero()."', '".$pessoa->getBairro()."', '".$pessoa->getCidade()."',"
                . " '".$pessoa->getEstado()."', '".$pessoa->getTelefone()."', '".$pessoa->getEmail()."',"
                . " '".$pessoa->getCelular()."', '".$pessoa->getLogin()."', '".$pessoa->getSenha()."',"
                . " '".$pessoa->getCodcargo()."', '".$pessoa->getCodtipo()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Pessoa $pessoa){
        $this->conectar();
        $query = "update pessoa set nome = '".$pessoa->getNome()."', cpf = '".$pessoa->getCpf()."', cnpj = '".$pessoa->getCnpj()."',"
                . " cep = '".$pessoa->getCep()."', tipologradouro = '".$pessoa->getTipologradouro()."',"
                . " logradouro = '".$pessoa->getLogradouro()."', numero = '".$pessoa->getNumero()."',"
                . " bairro = '".$pessoa->getBairro()."', cidade = '".$pessoa->getCidade()."',"
                . " estado = '".$pessoa->getEstado()."', telefone = '".$pessoa->getTelefone()."',"
                . " email = '".$pessoa->getEmail()."', celular = '".$pessoa->getCelular()."',"
                . " login = '".$pessoa->getLogin()."', senha = '".$pessoa->getSenha()."',"
                . " codcargo = '".$pessoa->getCodcargo()."', codtipo = '".$pessoa->getCodtipo()."'"
                . " where codpessoa = '".$pessoa->getCodpessoa()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codpessoa){
        $this->conectar();
        $query = "delete from pessoa where codpessoa = '$codpessoa'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codpessoa){
        $this->conectar();
        $query = "select"
                . " p.*,"
                . "(select nome from tipopessoa where codtipo = p.codtipo) as tipo,"
                . "(select nome from cargo where codcargo = p.codcargo) as cargo"
                . " from pessoa p where codpessoa = '$codpessoa'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select"
                . " p.*,"
                . "(select nome from tipopessoa where codtipo = p.codtipo) as tipo,"
                . "(select nome from cargo where codcargo = p.codcargo) as cargo"
                . " from pessoa p where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select"
                . " p.*,"
                . "(select nome from tipopessoa where codtipo = p.codtipo) as tipo,"
                . "(select nome from cargo where codcargo = p.codcargo) as cargo"
                . " from pessoa p";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }   
    
    public function validaLogin($login, $senha){
        $this->conectar();
        $query = "select"
                . " p.*,"
                . "(select nome from tipopessoa where codtipo = p.codtipo) as tipo,"
                . "(select nome from cargo where codcargo = p.codcargo) as cargo"
                . " from pessoa p where p.login = '$login' and p.senha = '$senha'";
        $this->conexao->converteUTF8();
        return mysql_query($query); 
    } 
    
    public function procurar($query){
        $this->conectar();
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
}

?>
