<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelServico
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Servico.php");

class ModelServico {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Servico $servico){
        $this->conectar();
        $query = "insert into servico (nome, valor)"
                . " values('".$servico->getNome()."', '".$servico->getValor()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Servico $servico){
        $this->conectar();
        $query = "update servico set nome = '".$servico->getNome()."', valor = '".$servico->getValor()."'"
                . " where codservico = '".$servico->getCodservico()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }  
    
    public function excluirObjeto($codservico){
        $this->conectar();
        $query = "delete from servico where codservico = '$codservico'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codservico){
        $this->conectar();
        $query = "select cp.* from servico cp where codservico = '$codservico'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select cp.*"
                . " from servico cp where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query = "select cp.* from servico cp order by nome";
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
