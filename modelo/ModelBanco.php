<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelBanco
 *
 * @author ebiro_2
 */

require_once("Conexao.php");
require_once("entidade/Banco.php");

class ModelBanco {

    public $conexao;

    public function conectar(){
        $this->conexao = new Conexao();
        $this->conexao->conectar();
    }    
    
    public function inserirObjeto(Banco $banco){
        $this->conectar();
        $query = "insert into banco (nome, logo, linksite, txconta, txboleto)"
                . " values('".$banco->getNome()."', '".$banco->getLogo()."',"
                . " '".$banco->getLinksite()."', '".$banco->getTxconta()."', '".$banco->getTxboleto()."');";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }
    
    public function atualizarObjeto(Banco $banco){
        $this->conectar();
        $query = "update banco set linksite = '".$banco->getLinksite()."', logo = '".$banco->getLogo()."', "
                . " nome = '".$banco->getNome()."', txconta = '".$banco->getTxconta()."', txboleto = '".$banco->getTxboleto()."'"
                . " where codbanco = '".$banco->getCodbanco()."'";
        $this->conexao->converteUTF8();
        return mysql_query($query);   
    }  
    
    public function excluirObjeto($codbanco){
        $this->conectar();
        $query = "delete from banco where codbanco = '$codbanco'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }     
    
    public function procurarObjeto($codbanco){
        $this->conectar();
        $query = "select * from banco where codbanco = '$codbanco'";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarNome($nome){
        $this->conectar();
        $query = "select b.* from banco b where nome like '%$nome%' order by nome";
        $this->conexao->converteUTF8();
        return mysql_query($query);  
    }       
    
    public function procurarTodos(){
        $this->conectar();
        $query     = "select * from banco order by nome";
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
