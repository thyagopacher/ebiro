<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelEmpresa
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Empresa.php");

class ModelEmpresa {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Empresa $empresa){
        $this->conectar();
        $query = "insert into empresa (codbanco, agencia, conta, digitov, razaosocial, fantasia, cnpj, cep, tipologradouro,"
                . " logradouro, numero, bairro, cidade, estado, email, telefone, fax, celular)"
                . " values('".$empresa->getCodbanco()."', '".$empresa->getAgencia()."',"
                . " '".$empresa->getConta()."', '".$empresa->getDigitov()."','".$empresa->getRazaosocial()."', '".$empresa->getFantasia()."','".$empresa->getCnpj()."',"
                . " '".$empresa->getCep()."','".$empresa->getTipologradouro()."','".$empresa->getLogradouro()."',"
                . " '".$empresa->getNumero()."', '".$empresa->getBairro()."', '".$empresa->getCidade()."',"
                . " '".$empresa->getEstado()."', '".$empresa->getEmail()."','".$empresa->getTelefone()."',"
                . " '".$empresa->getFax()."', '".$empresa->getCelular()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Empresa $empresa){
        $this->conectar();
        $query = "update empresa set codbanco = '".$empresa->getCodbanco()."',"
                . " agencia = '".$empresa->getAgencia()."', conta = '".$empresa->getConta()."',"
                . " digitov = '".$empresa->getDigitov()."',"
                . " razaosocial = '".$empresa->getRazaosocial()."', logo = '".$empresa->getLogo()."',"
                . " fantasia = '".$empresa->getFantasia()."', cnpj = '".$empresa->getCnpj()."',"
                . " cep = '".$empresa->getCep()."', tipologradouro = '".$empresa->getTipologradouro()."',"
                . " logradouro = '".$empresa->getLogradouro()."', numero = '".$empresa->getNumero()."',"
                . " bairro = '".$empresa->getBairro()."', cidade = '".$empresa->getCidade()."',"
                . " estado = '".$empresa->getEstado()."', email = '".$empresa->getEmail()."',"
                . " telefone = '".$empresa->getTelefone()."', fax = '".$empresa->getFax()."',"
                . " celular = '".$empresa->getCelular()."' where codempresa = '".$empresa->getCodempresa()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query) or die(mysql_error());  
    }  
    
    public function excluirObjeto($codempresa){
        $this->conectar();
        $query = "delete from empresa where codempresa = '$codempresa'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codempresa){
        $this->conectar();
        $query = "select * from empresa where codempresa = '$codempresa'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select * from empresa where fantasia like '%$nome%' order by fantasia asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from empresa";
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
