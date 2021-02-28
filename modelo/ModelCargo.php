<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCargo
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Cargo.php");

class ModelCargo {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Cargo $cargo){
        $this->conectar();
        $query = "insert into cargo (nome, salario)"
                . " values('".$cargo->getNome()."', '".$cargo->getSalario()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Cargo $cargo){
        $this->conectar();
        $query = "update cargo set nome = '".$cargo->getNome()."', "
                . " salario = '".$cargo->getSalario()."'"
                . " where codcargo = '".$cargo->getCodcargo()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcargo){
        $this->conectar();
        $query = "delete from cargo where codcargo = '$codcargo'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcargo){
        $this->conectar();
        $query = "select * from cargo where codcargo = '$codcargo'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select c.* , "
                . "(select count(*) from pessoa where codcargo = c.codcargo) as qtd,"
                . "(select count(*) * c.salario from pessoa where codcargo = c.codcargo) as total"
                . " from cargo c where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select c.* ,"
                . "(select count(*) from pessoa where codcargo = c.codcargo) as qtd,"
                . "(select count(*) * c.salario from pessoa where codcargo = c.codcargo) as total"
                . "  from cargo p";
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
