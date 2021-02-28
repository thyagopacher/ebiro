<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelCor
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Cor.php");

class ModelCor {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Cor $cor){
        $this->conectar();
        $query = "insert into cor (nome, valor)"
                . " values('".$cor->getNome()."', '".$cor->getValor()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Cor $cor){
        $this->conectar();
        $query = "update cor set nome = '".$cor->getNome()."', "
                . " valor = '".$cor->getValor()."'"
                . " where codcor = '".$cor->getCodcor()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codcor){
        $this->conectar();
        $query = "delete from cor where codcor = '$codcor'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codcor){
        $this->conectar();
        $query = "select * from cor where codcor = '$codcor'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select c.*  "
                . " from cor c where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select c.* "
                . "  from cor p";
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
