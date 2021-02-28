<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelNovidades
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Novidades.php");

class ModelNovidades {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Novidades $novidades){
        $this->conectar();
        $query = "insert into novidades (nome, email)"
                . " values('".$novidades->getNome()."', '".$novidades->getEmail()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Novidades $novidades){
        $this->conectar();
        $query = "update novidades set nome = '".$novidades->getNome()."', email = '".$novidades->getEmail()."'"
                . " where codnovidades = '".$novidades->getCodnovidades()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codnovidades){
        $this->conectar();
        $query = "delete from novidades where codnovidades = '$codnovidades'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codnovidades){
        $this->conectar();
        $query = "select * from novidades where codnovidades = '$codnovidades'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select * from novidades where nome like '%$nome%' order by nome asc";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from novidades";
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
